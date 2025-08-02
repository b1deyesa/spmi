<?php

namespace Database\Seeders;

use App\Models\Profil;
use App\Models\ProfilCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    public $profils = [
        [
            'category' => 'Identitas UPPS',
            'items' => [
                ['label' => 'Nama UPPS', 'type' => 'text'],
                ['label' => 'Nama Perguruan Tinggi', 'type' => 'text'],
                ['label' => 'Fakultas/Departemen', 'type' => 'text'],
                ['label' => 'Alamat Lengkap', 'type' => 'textarea'],
                ['label' => 'Email & Telepon', 'type' => 'text'],
                ['label' => 'Website Resmi', 'type' => 'text'],
            ],
        ],
        [
            'category' => 'Visi, Misi, Tujuan, dan Strategi (VMTS)',
            'items' => [
                ['label' => 'Visi UPPS', 'type' => 'textarea'],
                ['label' => 'Misi UPPS', 'type' => 'textarea'],
                ['label' => 'Tujuan UPPS', 'type' => 'textarea'],
                ['label' => 'Strategi Pencapaian', 'type' => 'textarea'],
            ],
        ],
        [
            'category' => 'Struktur Organisasi',
            'items' => [
                ['label' => 'Struktur Organisasi UPPS', 'type' => 'textarea'],
                ['label' => 'Nama dan Jabatan Pimpinan', 'type' => 'textarea'],
                ['label' => 'Tugas Pokok dan Fungsi (Tupoksi)', 'type' => 'textarea'],
            ],
        ],
        [
            'category' => 'Sumber Daya Manusia',
            'items' => [
                ['label' => 'Jumlah Dosen Tetap di UPPS', 'type' => 'number'],
                ['label' => 'Kualifikasi Akademik Dosen', 'type' => 'textarea'],
                ['label' => 'Rasio Dosen : Mahasiswa', 'type' => 'text'],
                ['label' => 'Ketersediaan Tenaga Kependidikan', 'type' => 'textarea'],
            ],
        ],
        [
            'category' => 'Sarana dan Prasarana',
            'items' => [
                ['label' => 'Ruang Kelas', 'type' => 'number'],
                ['label' => 'Laboratorium / Studio', 'type' => 'number'],
                ['label' => 'Perpustakaan', 'type' => 'number'],
                ['label' => 'Fasilitas IT dan Internet', 'type' => 'textarea'],
                ['label' => 'Aksesibilitas bagi Difabel', 'type' => 'textarea'],
            ],
        ],
        [
            'category' => 'Tata Pamong dan Penjaminan Mutu',
            'items' => [
                ['label' => 'Sistem Tata Pamong', 'type' => 'textarea'],
                ['label' => 'Sistem Penjaminan Mutu Internal (SPMI)', 'type' => 'textarea'],
                ['label' => 'Tim Penjaminan Mutu', 'type' => 'textarea'],
                ['label' => 'Dokumen SPMI', 'type' => 'textarea'],
            ],
        ],
        [
            'category' => 'Keuangan dan Pendanaan',
            'items' => [
                ['label' => 'Sumber Pendanaan UPPS', 'type' => 'textarea'],
                ['label' => 'Rencana dan Realisasi Anggaran', 'type' => 'textarea'],
                ['label' => 'Kemandirian Keuangan', 'type' => 'textarea'],
            ],
        ],
        [
            'category' => 'Capaian dan Kinerja UPPS',
            'items' => [
                ['label' => 'Capaian Kinerja Akademik dan Non-akademik', 'type' => 'textarea'],
                ['label' => 'Kerjasama (MoU, MoA)', 'type' => 'textarea'],
                ['label' => 'Prestasi Dosen dan Mahasiswa', 'type' => 'textarea'],
                ['label' => 'Publikasi Ilmiah dan HKI', 'type' => 'textarea'],
            ],
        ],
        [
            'category' => 'Program Pengembangan',
            'items' => [
                ['label' => 'Program Strategis 5 Tahun', 'type' => 'textarea'],
                ['label' => 'Roadmap Pengembangan UPPS', 'type' => 'textarea'],
                ['label' => 'Rencana Pengembangan SDM dan Infrastruktur', 'type' => 'textarea'],
            ],
        ],
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->profils as $profil) {
            $category = ProfilCategory::create([
                'nama' => $profil['category']
            ]);
            foreach ($profil['items'] as $item) {
                Profil::create([
                    'profil_category_id' => $category->id,
                    'label' => $item['label'],
                    'type' => $item['type']
                ]);
            }
        }
    }
}
