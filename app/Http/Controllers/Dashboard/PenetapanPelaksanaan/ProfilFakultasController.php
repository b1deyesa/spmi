<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Akreditasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Models\Mahasiswa;

class ProfilFakultasController extends Controller
{
    public function index(Fakultas $fakultas, $year)
    {   
        $program_studi = $fakultas->programStudis()->whereYear('tanggal_didirikan', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_ditutup', '>=', $year)->orWhereNull('tanggal_ditutup'))->with(['akreditasis' => fn($q) => $q->whereYear('akreditasi_program_studi.tanggal_berlaku', '<=', $year)->whereYear('akreditasi_program_studi.tanggal_berakhir', '>=', $year)->orderByDesc('akreditasi_program_studi.tanggal_berlaku')])->get();
        $akreditasi = Akreditasi::all()->pluck('gelar')->mapWithKeys(fn($gelar) => [$gelar => $program_studi->filter(fn($prodi) => optional($prodi->akreditasis->first())->gelar === $gelar)->count()])->toArray();
        $akreditasi['Belum Akreditasi'] = $program_studi->filter(fn($prodi) => $prodi->akreditasis->isEmpty())->count();
        $akreditasi['Internasional'] = $program_studi->filter(fn($prodi) => $prodi->akreditasis->first() && $prodi->akreditasis->first()->pivot->is_internasional === true)->count();
        $dosen = Dosen::whereIn('program_studi_id', $program_studi->pluck('id'))->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_keluar', '>=', $year)->orWhereNull('tanggal_keluar'))->count();
        
        $mahasiswa = array_fill_keys(Jenjang::pluck('gelar', 'id')->toArray(), 0);
        foreach ($fakultas->programStudis as $prodi) {
            if ($gelar = $prodi->jenjang->gelar) {
                $mahasiswa[$gelar] += $prodi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->count();
            }
        }
        $mahasiswa['Diploma'] = $mahasiswa['Diploma Satu'] + $mahasiswa['Diploma Dua'] + $mahasiswa['Diploma Tiga'];
        unset($mahasiswa['Diploma Satu'], $mahasiswa['Diploma Dua'], $mahasiswa['Diploma Tiga']);
        $mahasiswa['Total'] = array_sum($mahasiswa);
        $program_studi = $program_studi->count();

        return view('dashboard.penetapan-pelaksanaan.profil-fakultas', [
            'fakultas' => $fakultas,
            'akreditasi' => $akreditasi,
            'program_studi' => $program_studi,
            'dosen' => $dosen,
            'mahasiswa' => $mahasiswa
        ]);
    }
}
