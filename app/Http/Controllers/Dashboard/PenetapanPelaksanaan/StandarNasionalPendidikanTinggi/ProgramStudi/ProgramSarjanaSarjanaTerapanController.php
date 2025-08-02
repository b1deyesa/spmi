<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProgramSarjanaSarjanaTerapanController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));
        
        $programStudis_sarjana = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Sarjana'))->get();
        $jenjang_sarjana = [];
        foreach ($programStudis_sarjana as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_sarjana[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        $programStudis_terapan = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Sarjana Terapan'))->get();
        $jenjang_terapan = [];
        foreach ($programStudis_terapan as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_terapan[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.program-sarjana-sarjana-terapan', [
            'programStudis_sarjana' => $programStudis_sarjana,
            'programStudis_terapan' => $programStudis_terapan,
            'years' => $years,
            'jenjang_sarjana' => $jenjang_sarjana,
            'jenjang_terapan' => $jenjang_terapan
        ]);   
    }
}
