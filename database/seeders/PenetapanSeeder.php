<?php

namespace Database\Seeders;

use App\Models\Penetapan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenetapanSeeder extends Seeder
{
    public $penetapan = [
        "Standar di aspek pendidikan",
        "Standar di aspek penelitian",
        "Standar di aspek pengabdian pada masyarakat",
        "Standar di aspek lainnya",
        "aspek pengelolaan organisasi",
        "aspek kemahasiswaan",
        "aspek sumber daya manusia",
        "aspek sarana prasarana",
        "aspek kerjasama",
        "aspek keuangan",
        "aspek kesejahteraan"
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->penetapan as $penetapan) {
            Penetapan::create([
                'nama' => $penetapan
            ]);
        }
    }
}
