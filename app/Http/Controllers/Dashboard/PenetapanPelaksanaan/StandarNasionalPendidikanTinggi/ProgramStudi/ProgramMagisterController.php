<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProgramMagisterController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));
        $programStudis = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Magister'))->get();

        $jenjang_magister = [];
        foreach ($programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_magister[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.program-magister', [
            'programStudis' => $programStudis,
            'years' => $years,
            'jenjang_magister' => $jenjang_magister
        ]);
    }
}
