<?php

namespace App\Livewire\Form;

use App\Models\Dosen;
use Livewire\Component;
use App\Models\ProgramStudi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class MonitoringJumlahMahasiswaBimbinganAkademikDosen extends Component
{
    public ProgramStudi $programStudi;
    public $year;
    public $dosens;
    public $datas = [];
    public $datas_remove = [];
    
    public function mount()
    {
        $this->dosens = $this->programStudi->dosens()->pluck('nid', 'nid')->toJson();
        
        foreach ($this->programStudi->dosens()->get() as $dosen) {
            $this->datas[] = [
                'id' => $dosen->id,
                'nid' => $dosen->nid,
                'nama' => $dosen->nama,
                'tahun_ajaran' => $dosen->tahun_ajaran,
                'total' => $dosen->total
            ];
        }
        
        if (count($this->datas) < 1) {
            $this->datas[] = [
                'id' => null,
                'nim' => null,
                'nama' => null,
                'ipk' => null,
                'lama_studi' => null
            ];
        }
    }
    
    public function add()
    {
        $this->datas[] = [
            'id' => null,
            'nim' => null,
            'nama' => null,
            'ipk' => null,
            'lama_studi' => null
        ];
    }

    public function updated()
    {
        foreach ($this->datas as $index => $data) {
            $dosen = Dosen::where('nim', $data['nim'])?->first();
            if ($dosen) {
                $this->datas[$index]['nama'] = $dosen?->nama;
            }
        }
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
                'ipk' => null,
                'lama_studi' => null
            ];
        }
    }
    
    public function save()
    {
        $rules = [];
        $messages = [];
        
        foreach ($this->datas as $index => $data) {
            if (!empty(array_filter($data, fn($v) => !is_null($v)))) {
                if (is_null($data['id'])) {
                    $rules["datas.$index.nim"] = 'required';
                } else {
                    $rules["datas.$index.nim"] = 'required|unique:dosens,nim,' . ($data['id'] ?? 'null');
                }
                $rules["datas.$index.nama"] = 'required';
                $messages["datas.$index.nim.required"] = 'NIM tidak boleh kosong';
                $messages["datas.$index.nama.required"] = 'Nama tidak boleh kosong';
                $messages["datas.$index.nim.unique"] = 'NIM telah terdaftar';
            }
        }
        
        if (count($this->datas) > 1) {
            foreach ($this->datas as $index => $data) {
                if (is_null($data['id'])) {
                    $rules["datas.$index.nim"] = 'required';
                } else {
                    $rules["datas.$index.nim"] = 'required|unique:dosens,nim,' . ($data['id'] ?? 'null');
                }
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
                Dosen::where('id', $id)->update([
                    'tanggal_masuk' => null,
                    'tanggal_lulus' => null
                ]);
            }
        }
        
        foreach ($this->datas as $data) {
            if (!empty(array_filter($data, fn($v) => !is_null($v)))) {
                if (!empty($data['id']) && Dosen::where('id', $data['id'])->exists()) {
                    Dosen::where('id', $data['id'])->update([
                        'nim' => $data['nim'],
                        'nama' => $data['nama'],
                        'ipk' => $data['ipk'],
                        'tanggal_masuk' => (int)$this->year - (int)$data['lama_studi'] .'-01-01',
                        'tanggal_lulus' => $this->year .'-01-01'
                    ]);
                } else {
                    Dosen::updateOrCreate([
                        'program_studi_id' => $this->programStudi->id,
                        'nim' => $data['nim']
                    ], [
                        'nama' => $data['nama'],
                        'ipk' => $data['ipk'],
                        'tanggal_masuk' => (int)$this->year - (int)$data['lama_studi'] .'-01-01',
                        'tanggal_lulus' => $this->year .'-01-01'
                    ]);
                }
            }
        }
        
        return redirect()->route('form.monitoring-ipk-dan-masa-studi-lulusan', ['fakultas' => $this->programStudi->fakultas->id, 'programStudi' => $this->programStudi, 'year' => $this->year])->with('success','Berhasil Tambah Data');
    }
    
    public function render()
    {
        return view('livewire.form.monitoring-jumlah-mahasiswa-bimbingan-akademik-dosen', [
            'program_studi' => $this->programStudi,
            'year' => $this->year
        ]);
    }
}
