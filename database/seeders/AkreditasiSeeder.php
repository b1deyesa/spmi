<?php

namespace Database\Seeders;

use App\Models\Akreditasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkreditasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public $gelar = [
        'A',
        'B',
        'C',
        'Baik',
        'Baik Sekali',
        'Unggul'
    ];
    
    public function run(): void
    {
        foreach ($this->gelar as $gelar) {
            Akreditasi::create([
                'gelar' => $gelar
            ]);
        }
    }
}
