<?php

namespace Database\Seeders;

use App\Models\Jenjang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
     public $jenjang = [
        [
            'gelar' => 'Doktor',
            'inisial' => 'S3',
            'warna' => '#2E86AB'
        ],
        [
            'gelar' => 'Magister',
            'inisial' => 'S2',
            'warna' => '#1B9C85'
        ],
        [
            'gelar' => 'Profesi',
            'inisial' => 'Profesi',
            'warna' => '#F39C12'
        ],
        [
            'gelar' => 'Sarjana',
            'inisial' => 'S1',
            'warna' => '#E74C3C'
        ],
        [
            'gelar' => 'Sarjana Terapan',
            'inisial' => 'S1 Terapan',
            'warna' => '#9B59B6'
        ],
        [
            'gelar' => 'Diploma Tiga',
            'inisial' => 'D3',
            'warna' => '#3498DB'
        ],
        [
            'gelar' => 'Diploma Dua',
            'inisial' => 'D2',
            'warna' => '#F1C40F'
        ],
        [
            'gelar' => 'Diploma Satu',
            'inisial' => 'D1',
            'warna' => '#E67E22'
        ]
    ];    
    
    public function run(): void
    {
        foreach ($this->jenjang as $jenjang) {
            Jenjang::create([
                'gelar' => $jenjang['gelar'],
                'inisial' => $jenjang['inisial'],
                'warna' => $jenjang['warna'],
            ]);
        }
    }
}
