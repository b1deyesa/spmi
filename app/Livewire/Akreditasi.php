<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Akreditasi as ModelsAkreditasi;
use App\Models\ProgramStudi;

class Akreditasi extends Component
{
    public ProgramStudi $program_studi;

    public $akreditasis;   // List pilihan akreditasi
    public $akreditasi_id; // ID akreditasi terpilih
    public $pivot_data = []; // Data dari tabel pivot

    public function mount()
    {
        // Ambil semua pilihan akreditasi
        $this->akreditasis = ModelsAkreditasi::all();

        // Ambil akreditasi pertama jika ada
        $first = $this->program_studi->akreditasis()->first();

        if ($first) {
            $this->akreditasi_id = $first->id;
            $this->pivot_data = [
                'tanggal_berlaku'   => $first->pivot->tanggal_berlaku,
                'tanggal_berakhir'  => $first->pivot->tanggal_berakhir,
                'nomor_sk'          => $first->pivot->nomor_sk,
                'is_internasional'  => (bool) $first->pivot->is_internasional,
            ];
        } else {
            // Default jika belum ada akreditasi
            $this->pivot_data = [
                'tanggal_berlaku'   => now()->toDateString(),
                'tanggal_berakhir'  => now()->addYears(5)->toDateString(),
                'nomor_sk'          => '',
                'is_internasional'  => false,
            ];
        }
    }

    public function updatedAkreditasiId()
    {
        if ($this->akreditasi_id) {
            // Gunakan sync supaya hanya ada 1 akreditasi untuk prodi ini
            $this->program_studi->akreditasis()->sync([
                $this->akreditasi_id => $this->pivot_data
            ]);
        } else {
            // Hapus semua akreditasi jika pilih "Tidak Terakreditasi"
            $this->program_studi->akreditasis()->detach();
        }
    }

    public function updatedPivotData()
    {
        if ($this->akreditasi_id) {
            $this->program_studi->akreditasis()->updateExistingPivot(
                $this->akreditasi_id,
                $this->pivot_data
            );
        }
    }

    public function render()
    {
        return view('livewire.akreditasi', [
            'program_studi' => $this->program_studi,
        ]);
    }
}