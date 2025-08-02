<?php

namespace App\Livewire\Form;

use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\MonitoringIpkDanMasaStudiLulusanImport as Import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Route;

class MonitoringIpkDanMasaStudiLulusanImport extends Component
{    
    use WithFileUploads;
    
    public Fakultas $fakultas;
    public ProgramStudi $programStudi;
    public $year;
    public $file;
    
    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
        
        Excel::import(new Import($this->programStudi), $this->file);
        return redirect()->route('form.monitoring-ipk-dan-masa-studi-lulusan', ['fakultas' => $this->fakultas, 'programStudi' => $this->programStudi, 'year' => $this->year])->with('success', 'All good!');
    }
    
    public function close()
    {
        return redirect()->route('form.monitoring-ipk-dan-masa-studi-lulusan', ['fakultas' => request()->route('fakultas'), 'programStudi' => request()->route('programStudi'), 'year' => request()->route('year')]);
    }
    
    public function download()
    {
        $filePath = public_path('template/Monitoring IPK dan Masa Studi Lulusan.xlsx');
        return Response::download($filePath);
    }
    
    public function render()
    {
        return view('livewire.form.monitoring-ipk-dan-masa-studi-lulusan-import', [
            'fakultas' => $this->fakultas,
            'programStudi' => $this->programStudi,
            'year' => $this->year
        ]);
    }
}
