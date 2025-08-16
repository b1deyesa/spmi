<?php

namespace App\Http\Controllers\Api;

use App\Models\ProgramStudi;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $program_studis = ProgramStudi::select(
                'program_studis.id',
                'program_studis.nama as prodi_nama',
                'fakultas.nama as fakultas_nama',
                'akreditasis.gelar',
                'akreditasi_program_studi.tanggal_berlaku',
                'akreditasi_program_studi.tanggal_berakhir'
            )
            ->leftJoin('fakultas', 'program_studis.fakultas_id', '=', 'fakultas.id')
            ->leftJoin('akreditasi_program_studi', 'program_studis.id', '=', 'akreditasi_program_studi.program_studi_id')
            ->leftJoin('akreditasis', 'akreditasi_program_studi.akreditasi_id', '=', 'akreditasis.id')
            ->get()
            ->map(function ($item) {
                $today = Carbon::today();

                $gelar = $item->gelar ?? 'Tidak Terakreditasi';

                if ($item->tanggal_berakhir && Carbon::parse($item->tanggal_berakhir)->lt($today)) {
                    $gelar = 'Tidak Terakreditasi';
                }

                return [
                    'id'               => $item->id,
                    'nama'             => $item->prodi_nama,
                    'fakultas'         => $item->fakultas_nama,
                    'gelar'            => $gelar,
                    'tanggal_berlaku'  => $item->tanggal_berlaku,
                    'tanggal_berakhir' => $item->tanggal_berakhir,
                ];
            });


        return response()->json([
            'success' => true,
            'message' => 'List Program Studi',
            'data' => $program_studis
        ]);
    }
}
