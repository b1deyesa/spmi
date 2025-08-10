<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Profil;
use App\Models\Jenjang;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SpectatorController extends Controller
{
    public function index()
    {
        $fakultas_all = Fakultas::all();
        $program_studis = ProgramStudi::orderBy('fakultas_id')->get();
           
        $akreditasi_data = $this->getAkreditasiData();
        $akreditasiCounts = $this->getAkreditasiCounts();
        $jumlah_terakreditasi = $akreditasiCounts['jumlah_terakreditasi'];
        $jumlah_belum = $akreditasiCounts['jumlah_belum'];
        $chartData = $this->getAkreditasiChartData();
        $jenjangData = $this->getJenjangData();
        $rankingKebijakan = $this->getRankingKebijakan();
        $rankingPenetapan = $this->getRankingPenetapan();
        $rankingProfil = $this->getRankingPengisianProfil();
        $podium = $this->getPodiumTop10();
        $fullRankings = $this->getPodiumAll();
        $dosens = $this->getTotalDosenAktifPerYear();
        $mahasiswas = $this->getTotalMahasiswaPerYear();
        $mahasiswa = $this->getTotalMahasiswaPerJenjang();
        $programStudiByStrata = $program_studis->groupBy(fn($prodi) => $prodi->jenjang->inisial);
        
        return view('spectator', [
            'fakultas_all' => $fakultas_all,
            'jumlah_terakreditasi' => $jumlah_terakreditasi,
            'jumlah_belum' => $jumlah_belum,
            'akreditasi_data' => $akreditasi_data,
            'programStudiByStrata' => $programStudiByStrata,
            'chartData' => $chartData,
            'jenjangData' => $jenjangData,
            'rankingKebijakan' => $rankingKebijakan,
            'rankingPenetapan' => $rankingPenetapan,
            'rankingProfil' => $rankingProfil,
            'podium' => $podium,
            'fullRankings' => $fullRankings,
            'dosens' => $dosens,
            'mahasiswas' => $mahasiswas,
            'mahasiswa' => $mahasiswa,
        ]);
    }
    
    private function getTotalDosenAktifPerYear()
    {
        $years = range(now()->year - 4, now()->year);
        $totalDosenPerYear = [];

        foreach ($years as $year) {
            $count = Dosen::where('tanggal_masuk', '<=', "$year-12-31")
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
    
    private function getTotalMahasiswaPerYear()
    {
        $years = range(now()->year - 4, now()->year);
        $totalMahasiswaPerYear = [];

        foreach ($years as $year) {
            $count = Mahasiswa::where('tanggal_masuk', '<=', "$year-12-31")
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
    
    private function getTotalMahasiswaPerJenjang()
    {
        $currentYear = now()->year;
        $years = range($currentYear - 4, $currentYear); // 5 tahun terakhir, dari tahun sekarang ke 4 tahun sebelumnya

        // Inisialisasi array untuk menyimpan jumlah mahasiswa per jenjang
        $mahasiswa = [];

        // Loop melalui setiap jenjang
        foreach (Jenjang::all() as $jenjang) {
            $mahasiswa[$jenjang->gelar] = array_fill_keys($years, 0); // Inisialisasi dengan tahun sebagai kunci
        }

        // Loop melalui setiap program studi
        foreach (ProgramStudi::all() as $prodi) {
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
    
    private function getRankingKebijakan()
    {
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

        $sorted = $ranking->sortByDesc('progress')->values();

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

        return $ranked;
    }
    
    private function getRankingPenetapan()
    {
        $ranking = Fakultas::withCount(['fakultasPenetapans', 'fakultasPenetapans as penetapan_diisi_count' => function($query) {
            $query->whereNotNull('tautan'); // Ganti 'tautan' dengan kolom yang relevan untuk penetapan
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

        $sorted = $ranking->sortByDesc('progress')->values();

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

        return $ranked;
    }

    private function getPodiumTop10()
    {
        // Bobot sesuai sistem F1 (25-18-15-12-10-8-6-4-2-1)
        $f1Points = [25, 18, 15, 12, 10, 8, 6, 4, 2, 1];
        
        // Dapatkan semua ranking yang diperlukan
        $rankingProfil = $this->getRankingPengisianProfil();
        $rankingKebijakan = $this->getRankingKebijakan();
        $rankingPenetapan = $this->getRankingPenetapan();

        // Gabungkan menjadi satu array dengan nama fakultas sebagai key
        $allRankings = [];
        
        $addToAllRankings = function($ranking, $type) use (&$allRankings, $f1Points) {
            foreach ($ranking as $item) {
                $fakultas = $item['data']['nama'];
                if (!isset($allRankings[$fakultas])) {
                    $allRankings[$fakultas] = [
                        'nama' => $fakultas,
                        'total_score' => 0,
                        'details' => []
                    ];
                }
                
                // Beri skor sesuai sistem F1
                $rank = $item['rank'];
                $score = isset($f1Points[$rank-1]) ? $f1Points[$rank-1] : 0;
                
                $allRankings[$fakultas]['total_score'] += $score;
                $allRankings[$fakultas]['details'][$type] = [
                    'rank' => $rank,
                    'score' => $score,
                    'progress' => $item['data']['progress'] ?? 0
                ];
            }
        };

        $addToAllRankings($rankingProfil, 'profil');
        $addToAllRankings($rankingKebijakan, 'kebijakan');
        $addToAllRankings($rankingPenetapan, 'penetapan');

        // Urutkan berdasarkan total skor tertinggi
        $sorted = collect($allRankings)->sortByDesc('total_score')->values();

        // Beri peringkat baru berdasarkan skor akumulasi
        $ranked = [];
        $currentRank = 1;
        $previousScore = null;
        
        foreach ($sorted as $item) {
            if ($previousScore !== null && $item['total_score'] == $previousScore) {
                $item['rank'] = $currentRank;
            } else {
                $item['rank'] = ++$currentRank;
            }
            
            $ranked[] = $item;
            $previousScore = $item['total_score'];
        }

        // Ambil top 10
        return array_slice($ranked, 0, 10);
    }
    
    private function getPodiumAll()
    {
        // Dapatkan semua fakultas dengan peringkat lengkap
        $allFakultas = Fakultas::all();
        
        // Dapatkan semua ranking yang diperlukan
        $rankingProfil = $this->getRankingPengisianProfil();
        $rankingKebijakan = $this->getRankingKebijakan();
        $rankingPenetapan = $this->getRankingPenetapan();

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

        // Gabungkan data ranking
        $fullRankings = [];
        
        foreach ($allFakultas as $fakultas) {
            $item = [
                'nama' => $fakultas->nama,
                'total_score' => 0,
                'details' => [
                    'profil' => ['rank' => null, 'progress' => 0],
                    'kebijakan' => ['rank' => null, 'progress' => 0],
                    'penetapan' => ['rank' => null, 'progress' => 0]
                ]
            ];
            
            // Cari data profil
            foreach ($rankingProfil as $rank) {
                if ($rank['data']['nama'] == $fakultas->nama) {
                    $item['details']['profil'] = [
                        'rank' => $rank['rank'],
                        'progress' => $rank['data']['progress']
                    ];
                    // Tambahkan poin berdasarkan peringkat
                    $item['total_score'] += $f1Points[$rank['rank']] ?? 0;
                    break;
                }
            }
            
            // Cari data kebijakan
            foreach ($rankingKebijakan as $rank) {
                if ($rank['data']['nama'] == $fakultas->nama) {
                    $item['details']['kebijakan'] = [
                        'rank' => $rank['rank'],
                        'progress' => $rank['data']['progress']
                    ];
                    // Tambahkan poin berdasarkan peringkat
                    $item['total_score'] += $f1Points[$rank['rank']] ?? 0;
                    break;
                }
            }
            
            // Cari data penetapan
            foreach ($rankingPenetapan as $rank) {
                if ($rank['data']['nama'] == $fakultas->nama) {
                    $item['details']['penetapan'] = [
                        'rank' => $rank['rank'],
                        'progress' => $rank['data']['progress']
                    ];
                    // Tambahkan poin berdasarkan peringkat
                    $item['total_score'] += $f1Points[$rank['rank']] ?? 0;
                    break;
                }
            }
            
            $fullRankings[] = $item;
        }

        // Urutkan berdasarkan total skor tertinggi
        $sorted = collect($fullRankings)->sortByDesc('total_score')->values();

        // Beri peringkat baru berdasarkan skor akumulasi
        $ranked = [];
        $currentRank = 1;
        
        foreach ($sorted as $index => $item) {
            if ($index > 0 && $item['total_score'] == $sorted[$index-1]['total_score']) {
                $item['rank'] = $ranked[$index-1]['rank'];
            } else {
                $item['rank'] = $currentRank;
            }
            
            $ranked[] = $item;
            $currentRank++;
        }

        return $ranked;
    }

    private function getAkreditasiData()
    {
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
        
        foreach ($orderedGelar as $gelar) {
            $prodis = ProgramStudi::whereHas('akreditasis', function($q) use ($gelar) {
                $q->where('gelar', $gelar)
                  ->where('akreditasi_program_studi.tanggal_berakhir', '>', now());
            })->get()->map(function($prodi) {
                $akreditasi = $prodi->akreditasis->first();
                $endDate = Carbon::parse($akreditasi->pivot->tanggal_berakhir);
                $diff = now()->diff($endDate);
                
                $prodi->sisa_waktu = $this->formatTimeRemaining($diff);
                $prodi->tanggal_berakhir = $endDate;
                
                return $prodi;
            });

            $akreditasi_data[] = [
                'gelar' => $gelar,
                'count' => $prodis->count(),
                'color' => $colorMap[$gelar],
                'prodis' => $prodis
            ];
        }

        $prodiBelum = ProgramStudi::doesntHave('akreditasis')->get();
        $prodiKadaluarsa = ProgramStudi::whereHas('akreditasis', function($q) {
            $q->where('akreditasi_program_studi.tanggal_berakhir', '<=', now());
        })->get();

        $prodiNonAktif = $prodiBelum->merge($prodiKadaluarsa);
        
        foreach ($prodis as $prodi) {
            foreach ($prodi->akreditasis as $akreditasi) {
                echo $prodi->nama . ': ' . $akreditasi->pivot->tanggal_berakhir . '<br>';
            }
        }
        
        $akreditasi_data[] = [
            'gelar' => 'Tidak Terakreditasi',
            'count' => $prodiNonAktif->count(),
            'color' => $colorMap['Tidak Terakreditasi'],
            'prodis' => $prodiNonAktif
        ];
        
        return $akreditasi_data;
    }

    private function getAkreditasiChartData()
    {
        $orderedGelar = ['Unggul', 'A', 'Baik Sekali', 'B', 'Baik', 'C', 'Tidak Terakreditasi'];
        $colorMap = [
            'Unggul' => '#1e3a8a',
            'A' => '#2563eb',
            'Baik Sekali' => '#0ea5e9',
            'B' => '#22c55e',
            'Baik' => '#fde047',
            'C' => '#facc15',
            'Tidak Terakreditasi' => '#f87171'
        ];
        
        $akreditasi_labels = [];
        $akreditasi_data = [];
        $akreditasi_colors = [];
        $datasets = [];

        // Ambil semua fakultas
        $fakultasList = Fakultas::with('programStudis.akreditasis')->get();

        // Inisialisasi datasets untuk setiap fakultas
        foreach ($fakultasList as $fakultas) {
            $datasets[] = [
                'label' => $fakultas->nama, // Nama fakultas sebagai label
                'data' => array_fill(0, count($orderedGelar), 0), // Inisialisasi data dengan 0
                'backgroundColor' => $fakultas->warna ?? '#000000', // Menggunakan warna dari database, default hitam jika tidak ada
            ];
        }

        foreach ($orderedGelar as $index => $gelar) {
            $countPerFakultas = [];

            foreach ($fakultasList as $fakultas) {
                if ($gelar === 'Tidak Terakreditasi') {
                    $count = $fakultas->programStudis()->doesntHave('akreditasis')->count() +
                            $fakultas->programStudis()->whereHas('akreditasis', function($query) {
                                $query->where('tanggal_berakhir', '<=', now());
                            })->count();
                } else {
                    $count = $fakultas->programStudis()->whereHas('akreditasis', function($query) use ($gelar) {
                        $query->where('gelar', $gelar)
                            ->where('tanggal_berakhir', '>', now());
                    })->count();
                }
                $countPerFakultas[] = $count; // Menyimpan jumlah prodi per fakultas
            }

            // Menyusun data untuk grafik
            $akreditasi_labels[] = $gelar;
            $akreditasi_data[] = array_sum($countPerFakultas); // Total untuk gelar ini
            $akreditasi_colors[] = $colorMap[$gelar];

            // Mengisi data untuk setiap fakultas dan gelar
            foreach ($fakultasList as $fakultasIndex => $fakultas) {
                $datasets[$fakultasIndex]['data'][$index] = $countPerFakultas[$fakultasIndex];
            }
        }
        
        return [
            'akreditasi_labels' => $akreditasi_labels,
            'akreditasi_data' => $akreditasi_data,
            'akreditasi_colors' => $akreditasi_colors,
            'datasets' => $datasets, // Menambahkan datasets
        ];
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
    
    private function getAkreditasiCounts()
    {
        $jumlah_terakreditasi = ProgramStudi::whereHas('akreditasis', function($query) {
            $query->where('tanggal_berakhir', '>', now());
        })->count();

        $jumlah_belum = ProgramStudi::doesntHave('akreditasis')->count();

        $jumlah_kadaluarsa = ProgramStudi::whereHas('akreditasis', function($query) {
            $query->where('tanggal_berakhir', '<=', now());
        })->count();

        $jumlah_belum += $jumlah_kadaluarsa;

        return [
            'jumlah_terakreditasi' => $jumlah_terakreditasi,
            'jumlah_belum' => $jumlah_belum,
        ];
    }
    
    private function getJenjangData()
    {
        $jenjang = Jenjang::withCount('programStudis')->get();
        
        $sortedJenjang = $jenjang->filter(fn($j) => $j->program_studis_count > 0)
                            ->sortByDesc('program_studis_count');
        
        return [
            'labels' => $sortedJenjang->pluck('inisial')->values()->toArray(),
            'data' => $sortedJenjang->pluck('program_studis_count')->values()->toArray(),
            'colors' => $sortedJenjang->pluck('warna')->values()->toArray()
        ];
    }

    private function getRankingPengisianProfil()
    {
        $totalProfil = Profil::count();

        $ranking = Fakultas::withCount(['fakultasProfils as filled_count' => function($query) {
            $query->whereNotNull('value');
        }])->get()->map(function($fakultas) use ($totalProfil) {
            return [
                'nama' => $fakultas->nama,
                'diisi' => $fakultas->filled_count,
                'total' => $totalProfil,
                'progress' => $totalProfil > 0 
                    ? round(($fakultas->filled_count / $totalProfil) * 100, 2)
                    : 0
            ];
        });

        $sorted = $ranking->sortByDesc('progress')->values();

        $ranked = [];
        $currentRank = 1;
        $previousProgress = null;

        foreach ($sorted as $index => $item) {
            if ($index > 0 && $item['progress'] == $previousProgress) {
                $ranked[$index]['rank'] = $ranked[$index-1]['rank'];
            } else {
                $ranked[$index]['rank'] = $currentRank;
            }

            $ranked[$index]['data'] = $item;
            $previousProgress = $item['progress'];
            $currentRank++;
        }

        return $ranked;
    }
    
    private function generateRandomColor($opacity = 1)
    {
        $r = mt_rand(0, 255);
        $g = mt_rand(0, 255);
        $b = mt_rand(0, 255);
        return "rgba($r, $g, $b, $opacity)";
    }
}
