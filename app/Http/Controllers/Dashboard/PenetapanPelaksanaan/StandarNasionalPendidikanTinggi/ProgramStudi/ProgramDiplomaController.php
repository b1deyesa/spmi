<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProgramDiplomaController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $years = range(date('Y') - 2, date('Y'));
        
        $programStudis_diploma_satu = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Diploma Satu'))->get();
        $jenjang_diploma_satu = [];
        foreach ($programStudis_diploma_satu as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_diploma_satu[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        $programStudis_diploma_dua = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Diploma Dua'))->get();
        $jenjang_diploma_dua = [];
        foreach ($programStudis_diploma_dua as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_diploma_dua[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        $programStudis_diploma_tiga = $fakultas->programStudis()->whereHas('jenjang', fn($query) => $query->where('gelar', 'Diploma Tiga'))->get();
        $jenjang_diploma_tiga = [];
        foreach ($programStudis_diploma_tiga as $programStudi) {
            foreach ($years as $year) {
                $item = $programStudi->mahasiswas()->whereYear('tanggal_masuk', '<=', $year)->where(fn($q) => $q->whereYear('tanggal_lulus', '>=', $year)->orWhereNull('tanggal_lulus'))->where('isPutus', false)->count();
                $jenjang_diploma_tiga[$programStudi->id][$year] = $item ?: '';
            }
        }
        
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.program-diploma', [
            'programStudis_diploma_satu' => $programStudis_diploma_satu,
            'programStudis_diploma_dua' => $programStudis_diploma_dua,
            'programStudis_diploma_tiga' => $programStudis_diploma_tiga,
            'years' => $years,
            'jenjang_diploma_satu' => $jenjang_diploma_satu,
            'jenjang_diploma_dua' => $jenjang_diploma_dua,
            'jenjang_diploma_tiga' => $jenjang_diploma_tiga
        ]);
    }
}
