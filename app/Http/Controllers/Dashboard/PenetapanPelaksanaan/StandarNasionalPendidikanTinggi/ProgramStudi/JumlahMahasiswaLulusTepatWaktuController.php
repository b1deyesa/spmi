<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class JumlahMahasiswaLulusTepatWaktuController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));

        $lulusan_tepat_waktu_fakultas = [];
        foreach ($fakultas->programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_lulus', $year)->where('isPutus', false)->whereRaw('YEAR(tanggal_lulus) - YEAR(tanggal_masuk) <= 4')->count();
                $lulusan_tepat_waktu_fakultas[$programStudi->id][$year] = $item ? $item : '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.jumlah-mahasiswa-lulus-tepat-waktu', [
            'fakultas' => $fakultas,
            'years' => $years,
            'lulusan_tepat_waktu_fakultas' => $lulusan_tepat_waktu_fakultas
        ]);
    }
}
