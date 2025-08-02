<?php

namespace App\Livewire;

use App\Models\FakultasKebijakan;
use Livewire\Component;

class PengaturanKebijakanSpmi extends Component
{
    public FakultasKebijakan $fakultas_kebijakan;
    public $status_pengaturan;
    public $catatan;
    public $tanggal_ditetapkan;
    public $tautan;

    public function mount()
    {
        $this->status_pengaturan = $this->fakultas_kebijakan->pluck('status_pengaturan', 'id')->toArray();
        $this->catatan = $this->fakultas_kebijakan->catatan;
        $this->tanggal_ditetapkan = $this->fakultas_kebijakan->tanggal_ditetapkan;
        $this->tautan = $this->fakultas_kebijakan->tautan;
    }
    
    public function removeStatusPengaturan()
    {
        $this->fakultas_kebijakan->update([
            'catatan' => null,
            'tanggal_ditetapkan' => null,
            'tautan' => null
        ]);
        
        $this->fakultas_kebijakan->update(['status_pengaturan' => false]);
    }
    
    public function submit()
    {
        $this->validate([
            'tanggal_ditetapkan' => 'required',
            'tautan' => 'required'
        ]);
        
        $this->fakultas_kebijakan->update([
            'catatan' => $this->catatan,
            'tanggal_ditetapkan' => $this->tanggal_ditetapkan,
            'tautan' => $this->tautan
        ]);
        
        $this->fakultas_kebijakan->update(['status_pengaturan' => true]);
        
        return redirect()->route('dashboard.penetapan-pelaksanaan.pengaturan-kebijakan-spmi', ['fakultas' => $this->fakultas_kebijakan->fakultas]);
    }
    
    public function render()
    {
        return view('livewire.pengaturan-kebijakan-spmi', [
            'fakultas_kebijakan' => $this->fakultas_kebijakan
        ]);
    }
}
