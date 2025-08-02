<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FakultasSeeder extends Seeder
{
    public $fakultas = [
        [
            'nama' => 'Teknik',
            'inisial' => 'FATEK',
            'warna' => '#2E3B4E'
        ],
        [
            'nama' => 'Pertanian',
            'inisial' => 'FAPERTA',
            'warna' => '#7C9D4F'
        ],
        [
            'nama' => 'Hukum',
            'inisial' => 'FH',
            'warna' => '#5A3D2C'
        ],
        [
            'nama' => 'Kedokteran',
            'inisial' => 'FK',
            'warna' => '#D6C9B4'
        ],
        [
            'nama' => 'Keguruan dan Ilmu Pendidikan',
            'inisial' => 'FKIP',
            'warna' => '#F2A900'
        ],
        [
            'nama' => 'Ilmu Sosial dan Ilmu Politik',
            'inisial' => 'FISIP',
            'warna' => '#3B6D8C'
        ],
        [
            'nama' => 'Ekonomi dan Bisnis',
            'inisial' => 'FEBIS',
            'warna' => '#FF8C00'
        ],
        [
            'nama' => 'Perikanan dan Ilmu Kelautan',
            'inisial' => 'FPIK',
            'warna' => '#1F77B4'
        ],
        [
            'nama' => 'Sains dan Teknologi',
            'inisial' => 'FST',
            'warna' => '#FF5733'
        ],
        [
            'nama' => 'Program Studi Diluar Kampus Utama',
            'inisial' => 'PSDKU',
            'warna' => '#FFB6C1'
        ],
        [
            'nama' => 'Pascasarjana',
            'inisial' => 'Pasca',
            'warna' => '#4B0082'
        ],
    ];    
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->fakultas as $fakultas) {
            Fakultas::create([
                'nama' => $fakultas['nama'],
                'inisial' => $fakultas['inisial'],
                'warna' => $fakultas['warna'],
                'tanggal_didirikan' => '1963-04-23'
            ]);
        }
    }
}
