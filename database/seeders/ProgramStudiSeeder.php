<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramStudiSeeder extends Seeder
{
    public $program_studi = [
        ['fakultas_id' => 7, 'nama' => 'Manajemen', 'jenjang_id' => 4],
        ['fakultas_id' => 7, 'nama' => 'Ekonomi Pembangunan', 'jenjang_id' => 4],
        ['fakultas_id' => 7, 'nama' => 'Akuntansi', 'jenjang_id' => 4],
        ['fakultas_id' => 3, 'nama' => 'Ilmu Hukum', 'jenjang_id' => 4],
        ['fakultas_id' => 6, 'nama' => 'Ilmu Administrasi Negara', 'jenjang_id' => 4],
        ['fakultas_id' => 6, 'nama' => 'Ilmu Komunikasi', 'jenjang_id' => 4],
        ['fakultas_id' => 6, 'nama' => 'Sosiologi', 'jenjang_id' => 4],
        ['fakultas_id' => 6, 'nama' => 'Ilmu Pemerintahan', 'jenjang_id' => 4],
        ['fakultas_id' => 4, 'nama' => 'Dokter', 'jenjang_id' => 3],
        ['fakultas_id' => 4, 'nama' => 'Kedokteran', 'jenjang_id' => 4],
        ['fakultas_id' => 4, 'nama' => 'Dokter Gigi', 'jenjang_id' => 3],
        ['fakultas_id' => 4, 'nama' => 'Dokter Gigi', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Jasmani, Kesehatan Dan Rekreasi', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Sejarah', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Bahasa Jerman', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Biologi', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Bahasa Dan Sastra Indonesia', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Profesi Guru', 'jenjang_id' => 3],
        ['fakultas_id' => 5, 'nama' => 'Bimbingan Dan Konseling', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Bahasa Inggris', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Kimia', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Fisika', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Guru Sekolah Dasar', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Luar Sekolah', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Matematika', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Administrasi Pendidikan', 'jenjang_id' => 1],
        ['fakultas_id' => 5, 'nama' => 'Administrasi Pendidikan', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Ekonomi', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Pancasila Dan Kewarganegaraan', 'jenjang_id' => 4],
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Akuntansi', 'jenjang_id' => 4],
        ['fakultas_id' => 11, 'nama' => 'Pengelolaan Lahan', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Ilmu Kelautan', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Manajemen Hutan', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Agribisnis', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Ilmu Ekonomi', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Biologi', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Ilmu Hukum', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Matematika', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Ilmu Pertanian', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Sosiologi', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Administrasi Publik', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Manajemen Sumberdaya Kelautan Dan Pulau-pulau Kecil', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Ilmu Hukum', 'jenjang_id' => 1],
        ['fakultas_id' => 11, 'nama' => 'Kimia', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Ilmu Kelautan', 'jenjang_id' => 1],
        ['fakultas_id' => 11, 'nama' => 'Manajemen Pendidikan', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Bahasa Jerman', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Bahasa Inggris', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Biologi', 'jenjang_id' => 1],
        ['fakultas_id' => 11, 'nama' => 'Manajemen', 'jenjang_id' => 2],
        ['fakultas_id' => 11, 'nama' => 'Ilmu Pertanian', 'jenjang_id' => 1],
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Matematika', 'jenjang_id' => 1],
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Pancasila dan Kewarganegaraan', 'jenjang_id' => 2],
        ['fakultas_id' => 8, 'nama' => 'Budidaya Perairan', 'jenjang_id' => 4],
        ['fakultas_id' => 8, 'nama' => 'Agrobisnis Perikanan', 'jenjang_id' => 4],
        ['fakultas_id' => 8, 'nama' => 'Ilmu Kelautan', 'jenjang_id' => 4],
        ['fakultas_id' => 8, 'nama' => 'Pemanfaatan Sumber Daya Perikanan', 'jenjang_id' => 4],
        ['fakultas_id' => 8, 'nama' => 'Teknologi Hasil Perikanan', 'jenjang_id' => 4],
        ['fakultas_id' => 8, 'nama' => 'Manajemen Sumber Daya Perairan', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Penyuluhan Pertanian', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Ilmu Tanah', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Pemuliaan Tanaman', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Kehutanan', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Teknologi Hasil Pertanian', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Agroteknologi', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Peternakan', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Agribisnis', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Ilmu Lingkungan', 'jenjang_id' => 4],
        ['fakultas_id' => 2, 'nama' => 'Pengelolaan Hutan', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Matematika (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Hukum (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Akuntansi (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Jasmani (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Hukum (Kampus Kab Maluku Barat Daya)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Peternakan (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Matematika (Kampus Kab Kepulauan Aru)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Akuntansi (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Guru Sekolah Dasar (kampus Kab Aru)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Bahasa Inggris (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Bahasa Inggris (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Guru Sekolah Dasar (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4],
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Geografi', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Matematika', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Biologi', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Fisika', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Ilmu Komputer', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Bioteknologi', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Statistika', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Kimia', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Farmasi', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Keselamatan dan Kesehatan Kerja', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Rekayasa Instrumentasi dan Otomasi', 'jenjang_id' => 4],
        ['fakultas_id' => 9, 'nama' => 'Sains Biomedis', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Mesin', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Sistem Perkapalan', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Perencanaan Wilayah Dan Kota', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Geofisika', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Perminyakan', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Geologi', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Industri', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Kimia', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Perkapalan', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Sipil', 'jenjang_id' => 4],
        ['fakultas_id' => 1, 'nama' => 'Teknik Transportasi Laut', 'jenjang_id' => 4],
    ];
    
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->program_studi as $program_studi) {
            ProgramStudi::create([
                'fakultas_id' => $program_studi['fakultas_id'],
                'jenjang_id' => $program_studi['jenjang_id'],
                'nama' => $program_studi['nama'],
                'tanggal_didirikan' => '1963-04-23'
            ]);
        }
    }
}
