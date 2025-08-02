<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class JumlahDosenController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));

        $jumlah_dosen = [];
        foreach ($fakultas->programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->dosens()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_keluar', '>=', $year)->orWhereNull('tanggal_keluar'))->count();
                $jumlah_dosen[$programStudi->id][$year] = $item ? $item : '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.jumlah-dosen', [
            'fakultas' => $fakultas,
            'years' => $years,
            'jumlah_dosen' => $jumlah_dosen
        ]);
    }
}
