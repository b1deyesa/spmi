<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresentaseMahasiswaLulusDenganIpk2Controller extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));

        $jumlah_lulusan = [];
        foreach ($fakultas->programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_lulus', $year)->where('ipk', '>=', '2')->where('isPutus', false)->count();
                $jumlah_lulusan[$programStudi->id][$year] = $item ? $item : '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.presentase-mahasiswa-lulus-dengan-ipk-2', [
            'fakultas' => $fakultas,
            'years' => $years,
            'jumlah_lulusan' => $jumlah_lulusan
        ]);
    }
}
