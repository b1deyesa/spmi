<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Profil;
use App\Models\Jenjang; 
use App\Models\Fakultas; 
use App\Models\ProgramStudi;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;

class IndexController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $fakultas_all = Fakultas::all();
        $jenjang = Jenjang::all();

        $program_studis = ProgramStudi::orderBy('fakultas_id')->get();
        
        $akreditasi_fakultas = null;
        $program_studis_fakultas = null;
        
        $dosens_fakultas = $this->getTotalDosenAktifPerYearForFakultas($fakultas);
        $mahasiswas_fakultas = $this->getTotalMahasiswaPerYearForFakultas($fakultas);
        $mahasiswa_fakultas = $this->getTotalMahasiswaPerJenjangForFakultas($fakultas);
        
        $akreditasi_fakultas = $this->getAkreditasiDataForFakultas($fakultas);
        $jumlah_lulusan_fakultas = $this->getJumlahLulusanForFakultas($fakultas);
        $presentase_lulus_ipk3 = $this->getPresentaseMahasiswaLulusDenganIpk3($fakultas);
        $presentase_lulus_ipk2 = $this->getPresentaseMahasiswaLulusDenganIpk2($fakultas);
        $progres_kebijakan = $this->getProgresKebijakan($fakultas);
        $progres_penetapan = $this->getProgresPenetapan($fakultas);
        $progres_profil = $this->getProgresProfil($fakultas);
        $program_studis_fakultas = $fakultas->programStudis()->orderBy('fakultas_id')->get();
        $podiumData = $this->getPodiumAll($fakultas);

        $programStudiByStrata = $program_studis->groupBy(fn($prodi) => $prodi->jenjang->inisial);
        
        return view('dashboard.index', [
            'fakultas' => $fakultas,
            'fakultas_all' => $fakultas_all,
            'program_studis' => $program_studis,
            'jenjang' => $jenjang,
            'programStudiByStrata' => $programStudiByStrata,
            'akreditasi_fakultas' => $akreditasi_fakultas,
            'jumlah_lulusan_fakultas' => $jumlah_lulusan_fakultas,
            'presentase_lulus_ipk3' => $presentase_lulus_ipk3,
            'presentase_lulus_ipk2' => $presentase_lulus_ipk2,
            'progres_kebijakan' => $progres_kebijakan,
            'progres_penetapan' => $progres_penetapan,
            'progres_profil' => $progres_profil,
            'program_studis_fakultas' => $program_studis_fakultas,
            'dosens_fakultas' => $dosens_fakultas,
            'mahasiswas_fakultas' => $mahasiswas_fakultas,
            'mahasiswa_fakultas' => $mahasiswa_fakultas,
            'podiumData' => $podiumData,
        ]);        
    }
    
    private function getProgresKebijakan(Fakultas $fakultas)
    {
        // Menghitung jumlah kebijakan dan kebijakan yang diisi untuk semua fakultas
        $ranking = Fakultas::withCount(['fakultasKebijakans', 'fakultasKebijakans as kebijakan_diisi_count' => function($query) {
            $query->whereNotNull('tautan');
        }])->get()->map(function($fakultas) {
            return [
                'nama' => $fakultas->nama,
                'diisi' => $fakultas->kebijakan_diisi_count,
                'total' => $fakultas->fakultas_kebijakans_count,
                'progress' => $fakultas->fakultas_kebijakans_count > 0 
                    ? round(($fakultas->kebijakan_diisi_count / $fakultas->fakultas_kebijakans_count) * 100, 2)
                    : 0
            ];
        });

        // Mengurutkan berdasarkan progress
        $sorted = $ranking->sortByDesc('progress')->values();

        // Menyusun ranking
        $ranked = [];
        $currentRank = 1;

        for ($i = 0; $i < count($sorted); $i++) {
            if ($i == 0 || $sorted[$i]['progress'] != $sorted[$i - 1]['progress']) {
                $ranked[$i]['rank'] = $currentRank;
            } else {
                $ranked[$i]['rank'] = $ranked[$i - 1]['rank'];
            }

            $ranked[$i]['data'] = $sorted[$i];
            $currentRank++;
        }

        // Mengonversi $ranked menjadi koleksi untuk menggunakan firstWhere
        $rankedCollection = collect($ranked);

        // Mencari posisi fakultas yang diberikan
        $fakultasData = $rankedCollection->firstWhere('data.nama', $fakultas->nama);

        // Mengembalikan hanya data fakultas yang diminta
        return [
            'rank' => $fakultasData['rank'] ?? null,
            'progress' => $fakultasData['data']['progress'] ?? 0,
            'total' => $fakultasData['data']['total'] ?? 0,
            'diisi' => $fakultasData['data']['diisi'] ?? 0,
        ];
    }
    
    private function getProgresPenetapan(Fakultas $fakultas)
    {
        // Menghitung jumlah kebijakan dan kebijakan yang diisi untuk semua fakultas
        $ranking = Fakultas::withCount(['fakultasPenetapans', 'fakultasPenetapans as penetapan_diisi_count' => function($query) {
            $query->whereNotNull('tautan');
        }])->get()->map(function($fakultas) {
            return [
                'nama' => $fakultas->nama,
                'diisi' => $fakultas->penetapan_diisi_count,
                'total' => $fakultas->fakultas_penetapans_count,
                'progress' => $fakultas->fakultas_penetapans_count > 0 
                    ? round(($fakultas->penetapan_diisi_count / $fakultas->fakultas_penetapans_count) * 100, 2)
                    : 0
            ];
        });

        // Mengurutkan berdasarkan progress
        $sorted = $ranking->sortByDesc('progress')->values();

        // Menyusun ranking
        $ranked = [];
        $currentRank = 1;

        for ($i = 0; $i < count($sorted); $i++) {
            if ($i == 0 || $sorted[$i]['progress'] != $sorted[$i - 1]['progress']) {
                $ranked[$i]['rank'] = $currentRank;
            } else {
                $ranked[$i]['rank'] = $ranked[$i - 1]['rank'];
            }

            $ranked[$i]['data'] = $sorted[$i];
            $currentRank++;
        }

        // Mengonversi $ranked menjadi koleksi untuk menggunakan firstWhere
        $rankedCollection = collect($ranked);

        // Mencari posisi fakultas yang diberikan
        $fakultasData = $rankedCollection->firstWhere('data.nama', $fakultas->nama);

        // Mengembalikan hanya data fakultas yang diminta
        return [
            'rank' => $fakultasData['rank'] ?? null,
            'progress' => $fakultasData['data']['progress'] ?? 0,
            'total' => $fakultasData['data']['total'] ?? 0,
            'diisi' => $fakultasData['data']['diisi'] ?? 0,
        ];
    }
    
    private function getProgresProfil(Fakultas $fakultas)
    {
        // Menghitung jumlah kebijakan dan kebijakan yang diisi untuk semua fakultas
        $ranking = Fakultas::withCount(['fakultasProfils', 'fakultasProfils as profil_diisi_count' => function($query) {
            $query->whereNotNull('value');
        }])->get()->map(function($fakultas) {
            return [
                'nama' => $fakultas->nama,
                'diisi' => $fakultas->profil_diisi_count,
                'total' => $fakultas->fakultas_profils_count,
                'progress' => $fakultas->fakultas_profils_count > 0 
                    ? round(($fakultas->profil_diisi_count / $fakultas->fakultas_profils_count) * 100, 2)
                    : 0
            ];
        });

        // Mengurutkan berdasarkan progress
        $sorted = $ranking->sortByDesc('progress')->values();

        // Menyusun ranking
        $ranked = [];
        $currentRank = 1;

        for ($i = 0; $i < count($sorted); $i++) {
            if ($i == 0 || $sorted[$i]['progress'] != $sorted[$i - 1]['progress']) {
                $ranked[$i]['rank'] = $currentRank;
            } else {
                $ranked[$i]['rank'] = $ranked[$i - 1]['rank'];
            }

            $ranked[$i]['data'] = $sorted[$i];
            $currentRank++;
        }

        // Mengonversi $ranked menjadi koleksi untuk menggunakan firstWhere
        $rankedCollection = collect($ranked);

        // Mencari posisi fakultas yang diberikan
        $fakultasData = $rankedCollection->firstWhere('data.nama', $fakultas->nama);

        // Mengembalikan hanya data fakultas yang diminta
        return [
            'rank' => $fakultasData['rank'] ?? null,
            'progress' => $fakultasData['data']['progress'] ?? 0,
            'total' => $fakultasData['data']['total'] ?? 0,
            'diisi' => $fakultasData['data']['diisi'] ?? 0,
        ];
    }
    
    private function getTotalDosenAktifPerYearForFakultas($fakultas)
    {
        $years = range(now()->year - 4, now()->year);
        $totalDosenPerYear = [];

        foreach ($years as $year) {
            $count = Dosen::where('tanggal_masuk', '<=', "$year-12-31")
                ->whereHas('programStudi', function ($query) use ($fakultas) {
                    $query->where('fakultas_id', $fakultas->id);
                })
                ->where(function($query) use ($year) {
                    $query->whereNull('tanggal_keluar')
                        ->orWhere('tanggal_keluar', '>=', "$year-01-01");
                })
                ->count();

            $totalDosenPerYear[$year] = $count;
        }
        
        return [
            'labels' => array_keys($totalDosenPerYear),
            'data' => array_values($totalDosenPerYear),
        ];
    }

    private function getTotalMahasiswaPerYearForFakultas($fakultas)
    {
        $years = range(now()->year - 4, now()->year);
        $totalMahasiswaPerYear = [];

        foreach ($years as $year) {
            $count = Mahasiswa::where('tanggal_masuk', '<=', "$year-12-31")
                ->whereHas('programStudi', function ($query) use ($fakultas) {
                    $query->where('fakultas_id', $fakultas->id);
                })
                ->where(function($query) use ($year) {
                    $query->whereNull('tanggal_lulus')
                        ->orWhere('tanggal_lulus', '>=', "$year-01-01");
                })
                ->count();

            $totalMahasiswaPerYear[$year] = $count;
        }
        
        return [
            'labels' => array_keys($totalMahasiswaPerYear),
            'data' => array_values($totalMahasiswaPerYear),
        ];
    }

    private function getTotalMahasiswaPerJenjangForFakultas($fakultas)
    {
        $currentYear = now()->year;
        $years = range($currentYear - 4, $currentYear); // 5 tahun terakhir, dari tahun sekarang ke 4 tahun sebelumnya

        // Inisialisasi array untuk menyimpan jumlah mahasiswa per jenjang
        $mahasiswa = [];

        // Loop melalui setiap jenjang
        foreach (Jenjang::all() as $jenjang) {
            $mahasiswa[$jenjang->gelar] = array_fill_keys($years, 0); // Inisialisasi dengan tahun sebagai kunci
        }

        // Loop melalui setiap program studi yang terkait dengan fakultas
        $programStudis = ProgramStudi::where('fakultas_id', $fakultas->id)->get();

        foreach ($programStudis as $prodi) {
            $gelar = $prodi->jenjang->gelar ?? null;
            if (!$gelar) continue;

            foreach ($years as $year) {
                // Hitung mahasiswa aktif di tahun $year untuk prodi ini
                $count = $prodi->mahasiswas()
                    ->whereYear('tanggal_masuk', '<=', $year) // Mahasiswa yang masuk sebelum atau pada tahun ini
                    ->where(function($query) use ($year) {
                        $query->whereYear('tanggal_lulus', '>=', $year) // Mahasiswa yang lulus setelah atau pada tahun ini
                            ->orWhereNull('tanggal_lulus'); // Atau mahasiswa yang belum lulus
                    })
                    ->count();

                $mahasiswa[$gelar][$year] += $count; // Tambahkan ke jumlah per jenjang
            }
        }

        // Menggabungkan jumlah untuk Diploma Satu, Dua, dan Tiga menjadi satu entri Diploma
        if (isset($mahasiswa['Diploma Satu'], $mahasiswa['Diploma Dua'], $mahasiswa['Diploma Tiga'])) {
            foreach ($years as $year) {
                $mahasiswa['Diploma'][$year] = $mahasiswa['Diploma Satu'][$year] + $mahasiswa['Diploma Dua'][$year] + $mahasiswa['Diploma Tiga'][$year];
            }
            // Menghapus entri untuk Diploma Satu, Dua, dan Tiga
            unset($mahasiswa['Diploma Satu'], $mahasiswa['Diploma Dua'], $mahasiswa['Diploma Tiga']);
        }

        return $mahasiswa;
    }

    private function getAkreditasiDataForFakultas(Fakultas $fakultas, array $years = null)
    {
        if ($years === null) {
            $years = [now()->year];
        }

        $orderedGelar = ['Unggul', 'A', 'Baik Sekali', 'B', 'Baik', 'C'];
        $colorMap = [
            'Unggul' => '#1e3a8a',
            'A' => '#2563eb',
            'Baik Sekali' => '#0ea5e9',
            'B' => '#22c55e',
            'Baik' => '#fde047',
            'C' => '#facc15',
            'Tidak Terakreditasi' => '#f87171'
        ];

        $akreditasi_data = [];
        $jumlah_terakreditasi = 0;
        $jumlah_belum = 0;
        $chart_labels = [];
        $chart_data = [];
        $chart_colors = [];
        
        // Process each accreditation level
        foreach ($orderedGelar as $gelar) {
            $prodis = $fakultas->programStudis()
                ->whereHas('akreditasis', function($q) use ($gelar, $years) {
                    $q->where('gelar', $gelar)
                    ->where(function($query) use ($years) {
                        foreach ($years as $year) {
                            $query->orWhere(function($q) use ($year) {
                                $q->whereYear('akreditasi_program_studi.tanggal_berlaku', '<=', $year)
                                    ->whereYear('akreditasi_program_studi.tanggal_berakhir', '>=', $year);
                            });
                        }
                    });
                })
                ->get()
                ->map(function($prodi) use ($years) {
                    $akreditasi = $prodi->akreditasis()
                        ->where(function($q) use ($years) {
                            foreach ($years as $year) {
                                $q->orWhere(function($query) use ($year) {
                                    $query->whereYear('akreditasi_program_studi.tanggal_berlaku', '<=', $year)
                                        ->whereYear('akreditasi_program_studi.tanggal_berakhir', '>=', $year);
                                });
                            }
                        })
                        ->orderBy('akreditasi_program_studi.tanggal_berlaku', 'asc')
                        ->first();

                    if ($akreditasi) {
                        $endDate = Carbon::parse($akreditasi->pivot->tanggal_berakhir);
                        $prodi->sisa_waktu = $this->formatTimeRemaining(now()->diff($endDate));
                        $prodi->tanggal_berakhir = $endDate;
                    }
                    return $prodi;
                });

            $count = $prodis->count();
            $jumlah_terakreditasi += $count;

            $chart_labels[] = $gelar;
            $chart_data[] = $count;
            $chart_colors[] = $colorMap[$gelar];

            $akreditasi_data[] = [
                'gelar' => $gelar,
                'count' => $count,
                'color' => $colorMap[$gelar],
                'prodis' => $prodis
            ];
        }

        // Get non-active programs (replacing getNonActiveProdis)
        $prodiBelum = $fakultas->programStudis()
            ->doesntHave('akreditasis')
            ->get();

        $prodiKadaluarsa = $fakultas->programStudis()
            ->whereHas('akreditasis', function($q) use ($years) {
                $q->where(function($query) use ($years) {
                    foreach ($years as $year) {
                        $query->orWhere(function($q) use ($year) {
                            $q->whereYear('akreditasi_program_studi.tanggal_berakhir', '<', $year);
                        });
                    }
                });
            })
            ->get();

        $prodiNonAktif = $prodiBelum->merge($prodiKadaluarsa);
        $jumlah_belum = $prodiNonAktif->count();

        // Add non-accredited to chart if exists
        if ($jumlah_belum > 0) {
            $chart_labels[] = 'Tidak Terakreditasi';
            $chart_data[] = $jumlah_belum;
            $chart_colors[] = $colorMap['Tidak Terakreditasi'];
        }

        $akreditasi_data[] = [
            'gelar' => 'Tidak Terakreditasi',
            'count' => $jumlah_belum,
            'color' => $colorMap['Tidak Terakreditasi'],
            'prodis' => $prodiNonAktif
        ];

        return [
            'akreditasi_data' => $akreditasi_data,
            'jumlah_terakreditasi' => $jumlah_terakreditasi,
            'jumlah_belum' => $jumlah_belum,
            'chart_data' => [
                'labels' => $chart_labels,
                'data' => $chart_data,
                'colors' => $chart_colors
            ]
        ];
    }

    private function getJumlahLulusanForFakultas(Fakultas $fakultas)
    {
        // Define the range of years (last 5 years)
        $years = range(date('Y') - 4, date('Y'));
        $currentYear = date('Y');

        // Initialize arrays to hold the data
        $total_lulusan_per_year = array_fill_keys($years, 0);
        $tepat_waktu_lulusan_per_year = array_fill_keys($years, 0);
        $putus_studi_fakultas = []; // Array untuk menyimpan jumlah mahasiswa putus studi
        
        // Initialize arrays for current year data
        $current_year_total = [];
        $current_year_tepat_waktu = [];
        $current_year_putus_studi = []; // Array untuk menyimpan jumlah mahasiswa putus studi tahun ini
        $program_studi_labels = [];

        // Process each program study
        foreach ($fakultas->programStudis as $programStudi) {
            $program_studi_labels[] = $programStudi->nama;

            foreach ($years as $year) {
                // Total graduates
                $total = $programStudi->mahasiswas()
                    ->whereYear('tanggal_lulus', $year)
                    ->where('isPutus', false)
                    ->count();

                // Graduates who finished on time (assuming standard study duration is 4 years)
                $tepat_waktu = $programStudi->mahasiswas()
                    ->whereYear('tanggal_lulus', $year)
                    ->where('isPutus', false)
                    ->whereRaw('YEAR(tanggal_lulus) - YEAR(tanggal_masuk) <= 4')
                    ->count();

                // Count students who dropped out
                $putus_studi = $programStudi->mahasiswas()
                    ->whereYear('tanggal_lulus', $year)
                    ->where('isPutus', true)
                    ->count();

                // Store data
                $total_lulusan_per_year[$year] += $total;
                $tepat_waktu_lulusan_per_year[$year] += $tepat_waktu;
                $putus_studi_fakultas[$programStudi->id][$year] = $putus_studi;

                // Store current year data
                if ($year == $currentYear) {
                    $current_year_total[$programStudi->id] = $total;
                    $current_year_tepat_waktu[$programStudi->id] = $tepat_waktu;
                    $current_year_putus_studi[$programStudi->id] = $putus_studi; // Simpan data putus studi tahun ini
                }
            }
        }

        // Warna tetap per dataset
        $color_total = '#3B82F6'; // biru
        $color_tepat_waktu = '#10B981'; // hijau
        $color_putus_studi = '#FF5733'; // merah untuk putus studi

        // Generate random colors for each program study
        $program_studi_colors = [];
        foreach ($fakultas->programStudis as $programStudi) {
            $program_studi_colors[$programStudi->id] = $this->generateRandomColor(0.7); // Assign random color
        }

        // Prepare datasets for current year with unique colors for each program study
        $current_year_datasets = [];
        foreach ($fakultas->programStudis as $programStudi) {
            $current_year_datasets[] = [
                'label' => $programStudi->nama,
                'data' => [$current_year_total[$programStudi->id] ?? 0], // Use 0 if no data
                'backgroundColor' => $program_studi_colors[$programStudi->id],
            ];
        }

        // Prepare current year data for program study
        $current_year_lulusan_prodi = [
            'labels' => $program_studi_labels,
            'data' => array_values($current_year_total),
            'colors' => array_values($program_studi_colors),
        ];

        // Prepare data for pie chart of students who dropped out
        $current_year_putus_studi_prodi = [
            'labels' => $program_studi_labels,
            'data' => array_values($current_year_putus_studi),
            'colors' => array_values($program_studi_colors),
        ];

        return [
            'total_lulusan' => [
                'chart_data' => [
                    'labels' => array_map('strval', $years),
                    'datasets' => [
                        [
                            'label' => 'Total Lulusan',
                            'data' => array_values($total_lulusan_per_year),
                            'backgroundColor' => $color_total,
                        ],
                        [
                            'label' => 'Lulusan Tepat Waktu',
                            'data' => array_values($tepat_waktu_lulusan_per_year),
                            'backgroundColor' => $color_tepat_waktu,
                        ],
                    ],
                ],
            ],
            'current_year_lulusan' => [
                'chart_data' => [
                    'labels' => $program_studi_labels,
                    'datasets' => [
                        [
                            'label' => 'Total',
                            'data' => array_values($current_year_total),
                            'backgroundColor' => $color_total,
                        ],
                        [
                            'label' => 'Tepat Waktu',
                            'data' => array_values($current_year_tepat_waktu),
                            'backgroundColor' => $color_tepat_waktu,
                        ]
                    ],
                ],
            ],
            'current_year_lulusan_prodi' => $current_year_lulusan_prodi, // Tambahkan array baru
            'current_year_putus_studi_prodi' => $current_year_putus_studi_prodi, // Tambahkan array untuk putus studi
        ];
    }
    
    public function getPresentaseMahasiswaLulusDenganIpk3(Fakultas $fakultas)
    {
        $years = range(date('Y') - 4, date('Y'));
        $programStudis = $fakultas->programStudis;

        $labels = $years;
        $datasets = [];

        // Generate warna random untuk tiap prodi
        $colors = [];
        foreach ($programStudis as $programStudi) {
            $colors[$programStudi->id] = $this->generateRandomColor(0.7);
        }

        foreach ($programStudis as $programStudi) {
            $persentasePerTahun = [];
            foreach ($years as $year) {
                $totalLulusan = $programStudi->mahasiswas()
                    ->whereYear('tanggal_lulus', $year)
                    ->where('isPutus', false)
                    ->count();

                $lulusIpk3 = $programStudi->mahasiswas()
                    ->whereYear('tanggal_lulus', $year)
                    ->where('ipk', '>=', 3)
                    ->where('isPutus', false)
                    ->count();

                $persentase = $totalLulusan > 0 ? $lulusIpk3 : 0;
                $persentasePerTahun[] = round($persentase, 2);
            }

            $datasets[] = [
                'label' => $programStudi->nama,
                'data' => $persentasePerTahun,
                'backgroundColor' => $colors[$programStudi->id],
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }
    
    public function getPresentaseMahasiswaLulusDenganIpk2(Fakultas $fakultas)
    {
        $years = range(date('Y') - 4, date('Y'));
        $programStudis = $fakultas->programStudis;

        $labels = $years;
        $datasets = [];

        // Generate warna random untuk tiap prodi
        $colors = [];
        foreach ($programStudis as $programStudi) {
            $colors[$programStudi->id] = $this->generateRandomColor(0.7);
        }

        foreach ($programStudis as $programStudi) {
            $persentasePerTahun = [];
            foreach ($years as $year) {
                $totalLulusan = $programStudi->mahasiswas()
                    ->whereYear('tanggal_lulus', $year)
                    ->where('isPutus', false)
                    ->count();

                $lulusIpk2 = $programStudi->mahasiswas()
                    ->whereYear('tanggal_lulus', $year)
                    ->where('ipk', '>=', 2)
                    ->where('ipk', '<', 3)
                    ->where('isPutus', false)
                    ->count();

                $persentase = $totalLulusan > 0 ? $lulusIpk2 : 0; // Menghitung jumlah lulus dengan IPK antara 2.0 dan 3.0
                $persentasePerTahun[] = round($persentase, 2);
            }

            $datasets[] = [
                'label' => $programStudi->nama,
                'data' => $persentasePerTahun,
                'backgroundColor' => $colors[$programStudi->id],
            ];
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }

    private function generateRandomColor($opacity = 1)
    {
        $r = mt_rand(0, 255);
        $g = mt_rand(0, 255);
        $b = mt_rand(0, 255);
        return "rgba($r, $g, $b, $opacity)";
    }
    
    private function formatTimeRemaining($diff)
    {
        $parts = [];
        if ($diff->y > 0) $parts[] = $diff->y . ' tahun';
        if ($diff->m > 0) $parts[] = $diff->m . ' bulan';
        if ($diff->d > 0) {
            $weeks = floor($diff->d / 7);
            $days = $diff->d % 7;
            if ($weeks > 0) $parts[] = $weeks . ' minggu';
            if ($days > 0) $parts[] = $days . ' hari';
        }
        
        return empty($parts) ? 'Kurang dari 1 hari' : implode(' ', $parts);
    }
    
    private function getPodiumAll(Fakultas $fakultas)
    {
        // Bobot poin F1
        $f1Points = [
            1 => 25,
            2 => 18,
            3 => 15,
            4 => 12,
            5 => 10,
            6 => 8,
            7 => 6,
            8 => 4,
            9 => 2,
            10 => 1
        ];

        // Inisialisasi array untuk menyimpan semua fakultas
        $fullRankings = [];

        // Dapatkan semua fakultas untuk menghitung ranking keseluruhan
        $allFakultas = Fakultas::all();

        foreach ($allFakultas as $fak) {
            $item = [
                'nama' => $fak->nama,
                'total_score' => 0,
                'details' => [
                    'profil' => ['rank' => null, 'progress' => 0],
                    'kebijakan' => ['rank' => null, 'progress' => 0],
                    'penetapan' => ['rank' => null, 'progress' => 0]
                ]
            ];

            // Ambil data progres untuk masing-masing kategori
            $rankingProfil = $this->getProgresProfil($fak);
            $rankingKebijakan = $this->getProgresKebijakan($fak);
            $rankingPenetapan = $this->getProgresPenetapan($fak);

            // Mengisi detail dan menghitung total score
            $item['details']['profil'] = [
                'rank' => $rankingProfil['rank'],
                'progress' => $rankingProfil['progress']
            ];
            $item['total_score'] += $f1Points[$rankingProfil['rank']] ?? 0;

            $item['details']['kebijakan'] = [
                'rank' => $rankingKebijakan['rank'],
                'progress' => $rankingKebijakan['progress']
            ];
            $item['total_score'] += $f1Points[$rankingKebijakan['rank']] ?? 0;

            $item['details']['penetapan'] = [
                'rank' => $rankingPenetapan['rank'],
                'progress' => $rankingPenetapan['progress']
            ];
            $item['total_score'] += $f1Points[$rankingPenetapan['rank']] ?? 0;

            $fullRankings[] = $item;
        }

        // Urutkan berdasarkan total skor tertinggi
        $sorted = collect($fullRankings)->sortByDesc('total_score')->values();

        // Beri peringkat baru berdasarkan skor akumulasi
        $ranked = [];
        $currentRank = 1;

        foreach ($sorted as $index => $item) {
            if ($index > 0 && $item['total_score'] == $sorted[$index - 1]['total_score']) {
                $item['rank'] = $ranked[$index - 1]['rank'];
            } else {
                $item['rank'] = $currentRank;
            }

            $ranked[] = $item;
            $currentRank++;
        }

        // Mencari fakultas yang diberikan dan menambahkannya ke hasil
        $fakultasData = collect($ranked)->firstWhere('nama', $fakultas->nama);
        $fakultasData['rank'] = $fakultasData['rank'] ?? null; // Menyimpan rank fakultas yang diberikan

        return [
            'overall_rankings' => $ranked, // Mengembalikan semua peringkat
            'fakultas_data' => $fakultasData // Mengembalikan data fakultas yang diminta
        ];
    }
}
