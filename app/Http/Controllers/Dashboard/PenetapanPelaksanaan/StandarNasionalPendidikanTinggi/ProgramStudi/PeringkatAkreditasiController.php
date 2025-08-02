<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class PeringkatAkreditasiController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));

        $akreditasi_fakultas = [];
        foreach ($fakultas->programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->akreditasis()->whereYear('akreditasi_program_studi.tanggal_berlaku', '<=', $year)->whereYear('akreditasi_program_studi.tanggal_berakhir', '>=', $year)->orderBy('akreditasi_program_studi.tanggal_berlaku', 'asc')->get()->last()?->gelar;
                $akreditasi_fakultas[$programStudi->id][$year] = $item ? $item : '';
            }
        }
                
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.peringkat-akreditasi', [
            'fakultas' => $fakultas,
            'years' => $years,
            'akreditasi_fakultas' => $akreditasi_fakultas
        ]);
    }
}
