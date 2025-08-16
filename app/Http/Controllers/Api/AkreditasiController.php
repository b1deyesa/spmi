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
        $today = Carbon::today();

        $akreditasi = Akreditasi::with(['programStudis' => function ($q) use ($today) {
            $q->wherePivot('tanggal_berakhir', '>=', $today);
        }])->get()
        ->map(function ($akreditasi) {
            return [
                'akreditasi' => $akreditasi->gelar,
                'program_studi' => $akreditasi->programStudis->map(function ($item) {
                    return [
                        'prodi_id' => $item->id,
                        'nama'     => $item->nama,
                        'tanggal_berlaku'  => $item->pivot->tanggal_berlaku,
                        'tanggal_berakhir' => $item->pivot->tanggal_berakhir,
                        'nomor_sk'         => $item->pivot->nomor_sk,
                        'is_internasional' => $item->pivot->is_internasional
                    ];
                })
            ];
        });
        
        return response()->json([
            'success' => true,
            'message' => 'List Program Studi',
            'data' => $akreditasi
        ]);
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
