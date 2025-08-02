<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MonitoringIpkDanMasaStudiLulusanImport implements ToModel, WithHeadingRow
{
    protected $programStudi;

    public function __construct($programStudi)
    {
        $this->programStudi = $programStudi;
    }
    
    public function headingRow(): int
    {
        return 4;
    }
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        if (empty(array_filter($row))) {
            return null;
        }
        
        Mahasiswa::updateOrCreate(
            ['nim' => $row['nim']],
            [
                'program_studi_id' => $this->programStudi->id,
                'nama' => $row['nama_lulusan'],
                'ipk' => str_replace(',', '.', $row['ipk']),
                'tanggal_masuk' => Carbon::parse($row['tanggal_lulus'])->format('Y') - $row['lama_studi'] .'-01-01',
                'tanggal_lulus' => Carbon::parse($row['tanggal_lulus'])->format('Y-m-d')
            ]
        );
    
        return null;
    }
}
