<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AkreditasiProgramStudiRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Kalau ingin semua user bisa akses, return true
        // Kalau ingin dibatasi, bisa pakai logic auth di sini
        return true;
    }

    public function rules(): array
    {
        return [
            'program_studi_id'   => 'required|exists:program_studis,id',
            'akreditasi_id'      => 'required|exists:akreditasis,id',
            'tanggal_berlaku'    => 'required|date',
            'tanggal_berakhir'   => 'required|date|after_or_equal:tanggal_berlaku',
            'nomor_sk'           => 'required|string|max:255',
            'is_internasional'   => 'boolean'
        ];
    }
}
