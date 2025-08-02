<?php

namespace App\Livewire\Form;

use Livewire\Component;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Toefl;
use Illuminate\Support\Facades\Validator;

class MonitoringSkorToeflLulusan extends Component
{
    public ProgramStudi $programStudi;
    public $mahasiswas;
    public $year;
    public $datas = [];
    public $datas_remove = [];
    
    public function mount()
    {
        $this->mahasiswas = $this->programStudi->mahasiswas()->pluck('nim', 'nim')->toJson();
        
        foreach ($this->programStudi->mahasiswas()->whereHas('toefl', function ($q) {$q->whereYear('tanggal_ujian', $this->year);})->get() as $mahasiswa) {
            $this->datas[] = [
                'id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'listening' => $mahasiswa->toefl?->first()->listening,
                'structure' => $mahasiswa->toefl?->first()->structure,
                'reading' => $mahasiswa->toefl?->first()->reading,
                'writting' => $mahasiswa->toefl?->first()->writting,
                'total_score' => $mahasiswa->toefl?->first()->total_score
            ];
        }
        
        if (count($this->datas) < 1) {
            $this->datas[] = [
                'id' => null,
                'nim' => null,
                'nama' => null,
                'listening' => null,
                'structure' => null,
                'reading' => null,
                'writting' => null,
                'total_score' => null
            ];
        } 
    }
    
    public function add()
    {   
        $this->datas[] = [
            'id' => null,
            'nim' => null,
            'nama' => null,
            'listening' => null,
            'structure' => null,
            'reading' => null,
            'writting' => null,
            'total_score' => null
        ];
    }
    
    public function remove($key)
    {
        $this->datas_remove[] = $this->datas[$key]['id'];        
        unset($this->datas[$key]);
        if (count($this->datas) == 0) {
            $this->datas[] = [
                'id' => null,
                'nim' => null,
                'nama' => null,
                'listening' => null,
                'structure' => null,
                'reading' => null,
                'writting' => null,
                'total_score' => null
            ];
        }
    }
    
    public function updatedDatas($value, $id)
    {
        list($index, $attribute) = explode('.', $id);

        if ($attribute === 'nama') {
            $this->datas[$index]['nama'] = $value;
        } elseif ($attribute === 'nim') {
            $this->datas[$index]['nama'] = Mahasiswa::where('nim', $value)?->first()?->nama;
        } else {
            $this->datas[$index][$attribute] = $value;
        }

        if (
            isset(
                $this->datas[$index]['listening'],
                $this->datas[$index]['structure'],
                $this->datas[$index]['reading'],
                $this->datas[$index]['writting']
            ) &&
            is_numeric($this->datas[$index]['listening']) &&
            is_numeric($this->datas[$index]['structure']) &&
            is_numeric($this->datas[$index]['reading']) &&
            is_numeric($this->datas[$index]['writting'])
        ) {
            $this->datas[$index]['total_score'] =
                $this->datas[$index]['listening'] +
                $this->datas[$index]['structure'] +
                $this->datas[$index]['reading'] +
                $this->datas[$index]['writting'];
        }
    }

    public function save()
    {
        $rules = [];
        $messages = [];
        
        foreach ($this->datas as $index => $data) {
            if (!empty(array_filter($data, fn($v) => !is_null($v)))) {
                $rules["datas.$index.nim"] = 'required|unique:toefls,mahasiswa_id,' . ($data['id'] ?? 'null');
                $rules["datas.$index.nama"] = 'required';
                $messages["datas.$index.nim.required"] = 'NIM tidak boleh kosong';
                $messages["datas.$index.nama.required"] = 'Nama tidak boleh kosong';
                $messages["datas.$index.nim.unique"] = 'NIM telah terdaftar';
            }
        }
        
        if (count($this->datas) > 1) {
            foreach ($this->datas as $index => $data) {
                $rules["datas.$index.nim"] = 'required|unique:toefls,mahasiswa_id,' . ($data['id'] ?? 'null');
                $rules["datas.$index.nama"] = 'required';
                $messages["datas.$index.nim.required"] = 'NIM tidak boleh kosong';
                $messages["datas.$index.nama.required"] = 'Nama tidak boleh kosong';
                $messages["datas.$index.nim.unique"] = 'NIM telah terdaftar';
            }
        }
        
        $validator = Validator::make(['datas' => $this->datas], $rules, $messages);
        
        if ($validator->fails()) {
            $this->setErrorBag($validator->getMessageBag());
            return;
        }
        
        foreach ($this->datas_remove as $id) {
            if ($id !== null) {
                Toefl::where('mahasiswa_id', $id)?->first()->delete();
            }
        }
        
        foreach ($this->datas as $data) {
            if (!empty(array_filter($data, fn($v) => !is_null($v)))) {
                if (!empty($data['id']) && Mahasiswa::where('id', $data['id'])->exists()) {
                    Mahasiswa::where('id', $data['id'])->update([
                        'nim' => $data['nim'],
                        'nama' => $data['nama'],
                    ]);
                } else {
                    $mahasiswa = Mahasiswa::updateOrCreate([
                        'program_studi_id' => $this->programStudi->id,
                        'nim' => $data['nim']
                    ], [
                        'nama' => $data['nama']
                    ]);
                }
                Toefl::updateOrCreate(
                    ['mahasiswa_id' => $data['id'] ?? $mahasiswa->id],
                    [
                        'listening' => $data['listening'],
                        'structure' => $data['structure'],
                        'reading' => $data['reading'],
                        'writting' => $data['writting'],
                        'total_score' => $data['total_score'],
                        'tanggal_ujian' => $this->year .'-01-01'
                    ]
                );
            }
        }
        
        return redirect()->route('form.monitoring-skor-toefl-lulusan', ['fakultas' => $this->programStudi->fakultas->id, 'programStudi' => $this->programStudi, 'year' => $this->year])->with('success','Berhasil Tambah Data');
    }
    
    public function render()
    {
        return view('livewire.form.monitoring-skor-toefl-lulusan', [
            'program_studi' => $this->programStudi,
            'year' => $this->year
        ]);
    }
}
