<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Models\Jenjang;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramDoktorController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));
        $programStudis = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Doktor'))->get();

        $jenjang_doktor = [];
        foreach ($programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_doktor[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.program-doktor', [
            'programStudis' => $programStudis,
            'years' => $years,
            'jenjang_doktor' => $jenjang_doktor
        ]);
    }
}
