<?php

namespace Database\Seeders;

use App\Models\Kebijakan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KebijakanSeeder extends Seeder
{
    public $kebijakan = [
        'Pengaturan pengelolaan SPMI UPPS',
        'Pengaturan organisasi pengelola SPMI UPPS',
        'Pengaturan terkait pelaksanaan standar dalam SPMI UPPS',
        'Pengaturan terkait evaluasi pelaksanaan standar',
        'Pengaturan terkait pengendalian pelaksanaan standar',
        'Pengaturan terkait peningkatan standar dalam SPMI UPPS'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->kebijakan as $kebijakan) {
            Kebijakan::create([
                'nama' => $kebijakan
            ]);
        }
    }
}
