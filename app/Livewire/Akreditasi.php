<?php

namespace App\Livewire;

use App\Models\Akreditasi as ModelsAkreditasi;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Akreditasi extends Component
{
    public ProgramStudi $program_studi;
    public $akreditasis;
    public $akreditasi_id;
    public $pivot_data = [];

    protected $rules = [
        'akreditasi_id'               => 'nullable|exists:akreditasis,id',
        'pivot_data.tanggal_berlaku'  => 'required|date',
        'pivot_data.tanggal_berakhir' => 'required|date|after_or_equal:pivot_data.tanggal_berlaku',
        'pivot_data.nomor_sk'         => 'required|string|max:255',
        'pivot_data.is_internasional' => 'boolean'
    ];

    public function mount()
    {
        $this->akreditasis = ModelsAkreditasi::all();

        $first = $this->program_studi->akreditasis()->first();

        if ($first) {
            $this->akreditasi_id = $first->id;
            $this->pivot_data = [
                'tanggal_berlaku'  => $first->pivot->tanggal_berlaku,
                'tanggal_berakhir' => $first->pivot->tanggal_berakhir,
                'nomor_sk'         => $first->pivot->nomor_sk,
                'is_internasional' => (bool) $first->pivot->is_internasional,
            ];
        } else {
            $this->resetPivotData();
        }
    }

    public function updatedAkreditasiId()
    {
        if ($this->akreditasi_id) {
            $this->validate();

            // Update pivot langsung di database
            $this->program_studi->akreditasis()->sync([
                $this->akreditasi_id => $this->pivot_data
            ]);

            // Kirim juga ke API
            Http::post(url('/api/akreditasi-program-studi'), [
                'program_studi_id'  => $this->program_studi->id,
                'akreditasi_id'     => $this->akreditasi_id,
                'tanggal_berlaku'   => $this->pivot_data['tanggal_berlaku'],
                'tanggal_berakhir'  => $this->pivot_data['tanggal_berakhir'],
                'nomor_sk'          => $this->pivot_data['nomor_sk'],
                'is_internasional'  => $this->pivot_data['is_internasional'],
            ]);
        } else {
            $this->program_studi->akreditasis()->detach();
            $this->resetPivotData();
        }
    }

    public function updatedPivotData()
    {
        if ($this->akreditasi_id) {
            $this->validate();

            // Update pivot di DB
            $this->program_studi->akreditasis()->updateExistingPivot(
                $this->akreditasi_id,
                $this->pivot_data
            );

            // Update juga lewat API
            Http::put(url("/api/akreditasi-program-studi/{$this->program_studi->id}"), [
                'program_studi_id'  => $this->program_studi->id,
                'akreditasi_id'     => $this->akreditasi_id,
                'tanggal_berlaku'   => $this->pivot_data['tanggal_berlaku'],
                'tanggal_berakhir'  => $this->pivot_data['tanggal_berakhir'],
                'nomor_sk'          => $this->pivot_data['nomor_sk'],
                'is_internasional'  => $this->pivot_data['is_internasional'],
            ]);
        }
    }

    private function resetPivotData()
    {
        $this->pivot_data = [
            'tanggal_berlaku'  => now()->toDateString(),
            'tanggal_berakhir' => now()->addYears(5)->toDateString(),
            'nomor_sk'         => '',
            'is_internasional' => false,
        ];
    }

    public function render()
    {
        return view('livewire.akreditasi', [
            'program_studi' => $this->program_studi,
        ]);
    }
}