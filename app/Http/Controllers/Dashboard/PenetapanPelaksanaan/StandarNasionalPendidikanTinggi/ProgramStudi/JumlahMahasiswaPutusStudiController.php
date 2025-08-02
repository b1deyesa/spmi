<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class JumlahMahasiswaPutusStudiController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));

        $putus_studi_fakultas = [];
        foreach ($fakultas->programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_lulus', $year)->where('isPutus', true)->count();
                $putus_studi_fakultas[$programStudi->id][$year] = $item ? $item : '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.jumlah-mahasiswa-putus-studi', [
            'fakultas' => $fakultas,
            'years' => $years,
            'putus_studi_fakultas' => $putus_studi_fakultas
        ]);
    }
}
