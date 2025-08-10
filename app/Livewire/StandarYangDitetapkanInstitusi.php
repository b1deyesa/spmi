<?php

namespace App\Livewire;

use App\Models\FakultasPenetapan;
use Livewire\Component;

class StandarYangDitetapkanInstitusi extends Component
{
    public FakultasPenetapan $fakultas_penetapan;
    public $status_pengaturan;
    public $catatan;
    public $tautan;

    public function mount()
    {
        $this->status_pengaturan = $this->fakultas_penetapan->pluck('status_pengaturan', 'id')->toArray();
        $this->catatan = $this->fakultas_penetapan->catatan;
        $this->tautan = $this->fakultas_penetapan->tautan;
    }
    
    public function removeStatusPengaturan()
    {
        $this->fakultas_penetapan->update([
            'catatan' => null,
            'tautan' => null
        ]);
        
        $this->fakultas_penetapan->update(['status_pengaturan' => false]);
    }
    
    public function submit()
    {
        $this->validate([
            'tautan' => 'required'
        ]);
        
        $this->fakultas_penetapan->update([
            'catatan' => $this->catatan,
            'tautan' => $this->tautan
        ]);
        
        $this->fakultas_penetapan->update(['status_pengaturan' => true]);
        
        return redirect()->route('dashboard.penetapan-pelaksanaan.standar-yang-ditetapkan-institusi', ['fakultas' => $this->fakultas_penetapan->fakultas]);
    }
    
    public function render()
    {
        return view('livewire.standar-yang-ditetapkan-institusi', [
            'fakultas_penetapan' => $this->fakultas_penetapan
        ]);
    }
}
