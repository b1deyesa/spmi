<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Akreditasi;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akreditasi_per_year = $this->getAkreditasiPerYear(5, 5);

        return response()->json([
            'success' => true,
            'message' => 'List Program Studi per Tahun',
            'data'    => $akreditasi_per_year
        ]);
    }

    private function getAkreditasiPerYear(int $yearsBack = 5, int $yearsForward = 5)
    {
        $today = Carbon::today();
        $startYear = $today->year - $yearsBack;
        $endYear   = $today->year + $yearsForward;

        // Semua akreditasi + prodi terkait
        $akreditasis = Akreditasi::with(['programStudis'])->get();

        // Semua prodi
        $allProgramStudis = ProgramStudi::all();

        $result = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            $yearData = $akreditasis->map(function ($akreditasi) use ($year) {
                $programs = $akreditasi->programStudis->filter(function ($item) use ($year) {
                    $start = Carbon::parse($item->pivot->tanggal_berlaku)->year;
                    $end   = Carbon::parse($item->pivot->tanggal_berakhir)->year;
                    return $start <= $year && $end >= $year;
                })->map(function ($item) {
                    return [
                        'prodi_id'         => $item->id,
                        'nama'             => $item->nama,
                        'tanggal_berlaku'  => $item->pivot->tanggal_berlaku,
                        'tanggal_berakhir' => $item->pivot->tanggal_berakhir,
                        'nomor_sk'         => $item->pivot->nomor_sk,
                        'is_internasional' => $item->pivot->is_internasional,
                    ];
                })->values();

                return [
                    'akreditasi'    => $akreditasi->gelar,
                    'program_studi' => $programs->isEmpty() ? [] : $programs,
                ];
            })->values();

            // Cari prodi yang tidak punya akreditasi sama sekali
            $prodiWithoutAkreditasi = $allProgramStudis->filter(function ($prodi) use ($akreditasis) {
                return !$akreditasis->flatMap->programStudis->contains('id', $prodi->id);
            })->map(function ($prodi) {
                return [
                    'prodi_id'         => $prodi->id,
                    'nama'             => $prodi->nama,
                    'tanggal_berlaku'  => null,
                    'tanggal_berakhir' => null,
                    'nomor_sk'         => null,
                    'is_internasional' => null,
                ];
            })->values();

            // Tambahkan kategori "Tidak Terakreditasi"
            $yearData->push([
                'akreditasi'    => 'Tidak Terakreditasi',
                'program_studi' => $prodiWithoutAkreditasi,
            ]);

            $result[$year] = $yearData;
        }

        return $result;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
