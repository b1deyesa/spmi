<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProgramProfesiController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));
        $programStudis = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Profesi'))->get();

        $jenjang_profesi = [];
        foreach ($programStudis as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_profesi[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.program-profesi', [
            'programStudis' => $programStudis,
            'years' => $years,
            'jenjang_profesi' => $jenjang_profesi
        ]);
    }
}
