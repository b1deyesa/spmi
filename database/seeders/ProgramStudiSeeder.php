<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use Carbon\Carbon; // Import Carbon for date manipulation

class ProgramStudiSeeder extends Seeder
{
    /**
     * Data program studi beserta akreditasi.
     * Jenjang ID: 1 = S3, 2 = S2, 3 = Profesi, 4 = S1
     * Akreditasi ID: 1 = A, 2 = B, 3 = C, 4 = Baik, 5 = Baik Sekali, 6 = Unggul
     */
    public $program_studi = [
        ['fakultas_id' => 7, 'nama' => 'Manajemen', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => null], // Baik Sekali
        ['fakultas_id' => 7, 'nama' => 'Ekonomi Pembangunan', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-08-02'], // Baik Sekali
        ['fakultas_id' => 7, 'nama' => 'Akuntansi', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2029-03-08'], // Baik Sekali
        ['fakultas_id' => 3, 'nama' => 'Ilmu Hukum', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2027-06-27'], // Unggul
        ['fakultas_id' => 6, 'nama' => 'Ilmu Administrasi Negara', 'jenjang_id' => 4, 'akreditasi' => 1, 'tanggal_kadaluarsa' => '2025-09-30'], // A
        ['fakultas_id' => 6, 'nama' => 'Ilmu Komunikasi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2028-04-04'], // Baik
        ['fakultas_id' => 6, 'nama' => 'Sosiologi', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2028-12-05'], // B
        ['fakultas_id' => 6, 'nama' => 'Ilmu Pemerintahan', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2029-10-23'], // B
        ['fakultas_id' => 4, 'nama' => 'Pendidikan Dokter', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2027-08-11'], // Baik Sekali
        ['fakultas_id' => 4, 'nama' => 'Kedokteran Gigi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-01-24'], // Baik
        ['fakultas_id' => 4, 'nama' => 'Pendidikan Profesi Dokter Gigi', 'jenjang_id' => 3, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2027-01-25'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Jasmani, Kesehatan & Rekreasi', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-03-29'], // B
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Sejarah', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-11-01'], // B
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Bahasa Jerman', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-11-15'], // B
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Biologi', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-11-15'], // B
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Bahasa Dan Sastra Indonesia', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2027-08-15'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Profesi Guru', 'jenjang_id' => 3, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2027-09-11'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Bimbingan Dan Konseling', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-04-03'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Bahasa Inggris', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-06-26'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Kimia', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-06-26'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Fisika', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-07-10'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Guru Sekolah Dasar', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-07-24'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Luar Sekolah', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-07-24'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Matematika', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-07-24'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Administrasi Pendidikan', 'jenjang_id' => 1, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2029-08-18'], // Baik Sekali (S3)
        ['fakultas_id' => 5, 'nama' => 'Administrasi Pendidikan', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => null], // Baik (S1)
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Ekonomi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-08-18'], // Baik
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Pancasila Dan Kewarganegaraan', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2029-08-18'], // Baik Sekali
        ['fakultas_id' => 5, 'nama' => 'Pendidikan Akuntansi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2030-04-25'], // Baik
        ['fakultas_id' => 11, 'nama' => 'Pengelolaan Lahan', 'jenjang_id' => 2, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-09-15'], // B
        ['fakultas_id' => 11, 'nama' => 'Ilmu Kelautan', 'jenjang_id' => 2, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2025-10-20'], // Unggul
        ['fakultas_id' => 11, 'nama' => 'Manajemen Hutan', 'jenjang_id' => 2, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-11-17'], // B
        ['fakultas_id' => 11, 'nama' => 'Agribisnis', 'jenjang_id' => 2, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2026-03-10'], // Baik Sekali
        ['fakultas_id' => 11, 'nama' => 'Ilmu Ekonomi', 'jenjang_id' => 2, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-12-06'], // Baik
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Biologi', 'jenjang_id' => 2, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2028-10-11'], // B
        ['fakultas_id' => 11, 'nama' => 'Ilmu Hukum', 'jenjang_id' => 2, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2028-10-11'], // B
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Matematika', 'jenjang_id' => 2, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2028-10-29'], // Baik Sekali
        ['fakultas_id' => 11, 'nama' => 'Ilmu Pertanian', 'jenjang_id' => 2, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2028-12-05'], // Baik
        ['fakultas_id' => 11, 'nama' => 'Sosiologi', 'jenjang_id' => 2, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-03-13'], // Baik
        ['fakultas_id' => 11, 'nama' => 'Administrasi Publik', 'jenjang_id' => 2, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2029-04-10'], // Baik Sekali
        ['fakultas_id' => 11, 'nama' => 'Manajemen Sumberdaya Kelautan dan Pulau-pulau Kecil', 'jenjang_id' => 2, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2029-04-10'], // B
        ['fakultas_id' => 11, 'nama' => 'Ilmu Hukum', 'jenjang_id' => 1, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2029-08-14'], // B (S3)
        ['fakultas_id' => 11, 'nama' => 'Kimia', 'jenjang_id' => 2, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-09-17'], // Baik
        ['fakultas_id' => 11, 'nama' => 'Ilmu Kelautan', 'jenjang_id' => 1, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2029-09-17'], // B (S3)
        ['fakultas_id' => 11, 'nama' => 'Manajemen Pendidikan', 'jenjang_id' => 2, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2029-09-24'], // Baik Sekali
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Bahasa Jerman', 'jenjang_id' => 2, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2029-10-22'], // Baik Sekali
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Bahasa Inggris', 'jenjang_id' => 2, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2029-11-12'], // B
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Biologi', 'jenjang_id' => 1, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2030-02-11'], // Baik (S3)
        ['fakultas_id' => 11, 'nama' => 'Manajemen', 'jenjang_id' => 2, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2030-02-14'], // Baik Sekali
        ['fakultas_id' => 11, 'nama' => 'Ilmu Pertanian', 'jenjang_id' => 1, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2030-03-02'], // Baik (S3)
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Matematika', 'jenjang_id' => 1, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2030-03-05'], // Baik (S3)
        ['fakultas_id' => 11, 'nama' => 'Pendidikan Pancasila dan Kewarganegaraan', 'jenjang_id' => 2, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2028-08-27'], // Baik
        ['fakultas_id' => 8, 'nama' => 'Budidaya Perairan', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2025-12-30'], // Unggul
        ['fakultas_id' => 8, 'nama' => 'Agrobisnis Perikanan', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2026-05-21'], // B
        ['fakultas_id' => 8, 'nama' => 'Ilmu Kelautan', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2027-01-11'], // Unggul
        ['fakultas_id' => 8, 'nama' => 'Pemanfaatan Sumber Daya Perikanan', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2026-05-25'], // Unggul
        ['fakultas_id' => 8, 'nama' => 'Teknologi Hasil Perikanan', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2028-10-17'], // Unggul
        ['fakultas_id' => 8, 'nama' => 'Manajemen Sumber Daya Perairan', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2027-03-19'], // Unggul
        ['fakultas_id' => 2, 'nama' => 'Penyuluhan Pertanian', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-04-20'], // Baik
        ['fakultas_id' => 2, 'nama' => 'Ilmu Tanah', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-05-04'], // Baik
        ['fakultas_id' => 2, 'nama' => 'Pemuliaan Tanaman', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-05-25'], // Baik
        ['fakultas_id' => 2, 'nama' => 'Kehutanan', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2026-12-02'], // B
        ['fakultas_id' => 2, 'nama' => 'Teknologi Hasil Pertanian', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2026-12-28'], // B
        ['fakultas_id' => 2, 'nama' => 'Agroteknologi', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2028-12-20'], // B
        ['fakultas_id' => 2, 'nama' => 'Peternakan', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2029-03-13'], // B
        ['fakultas_id' => 2, 'nama' => 'Agribisnis', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2026-04-28'], // B
        ['fakultas_id' => 2, 'nama' => 'Ilmu Lingkungan', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2030-04-25'], // Baik
        ['fakultas_id' => 2, 'nama' => 'Pengelolaan Hutan', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-08-18'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Matematika (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-05-04'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Hukum (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-07-06'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Akuntansi (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-07-13'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Jasmani (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-07-21'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Hukum (Kampus Kab Maluku Barat Daya)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-08-03'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Peternakan (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-08-03'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Matematika (Kampus Kab Kepulauan Aru)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-08-24'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Akuntansi (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-09-15'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Guru Sekolah Dasar (kampus Kab Aru)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-10-26'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Bahasa Inggris (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-10-27'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Bahasa Inggris (Kampus Kab. Kepulauan Aru)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-11-03'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Guru Sekolah Dasar (Kampus Kab. Maluku Barat Daya)', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-12-15'], // Baik
        ['fakultas_id' => 10, 'nama' => 'Pendidikan Geografi', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2027-01-11'], // B
        ['fakultas_id' => 9, 'nama' => 'Matematika', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2028-02-14'], // Unggul
        ['fakultas_id' => 9, 'nama' => 'Biologi', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2026-11-25'], // Baik Sekali
        ['fakultas_id' => 9, 'nama' => 'Fisika', 'jenjang_id' => 4, 'akreditasi' => 6, 'tanggal_kadaluarsa' => '2027-12-21'], // Unggul
        ['fakultas_id' => 9, 'nama' => 'Ilmu Komputer', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2029-12-09'], // Baik Sekali
        ['fakultas_id' => 9, 'nama' => 'Bioteknologi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2030-03-02'], // Baik
        ['fakultas_id' => 9, 'nama' => 'Statistika', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2030-03-05'], // Baik
        ['fakultas_id' => 9, 'nama' => 'Kimia', 'jenjang_id' => 4, 'akreditasi' => 5, 'tanggal_kadaluarsa' => '2026-06-18'], // Baik Sekali
        ['fakultas_id' => 9, 'nama' => 'Farmasi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-03-10'], // Baik
        ['fakultas_id' => 9, 'nama' => 'Keselamatan dan Kesehatan Kerja', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-05-15'], // Baik
        ['fakultas_id' => 9, 'nama' => 'Rekayasa Instrumentasi dan Otomasi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-05-15'], // Baik
        ['fakultas_id' => 9, 'nama' => 'Sains Biomedis', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-04-08'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Mesin', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-10-07'], // B
        ['fakultas_id' => 1, 'nama' => 'Teknik Sistem Perkapalan', 'jenjang_id' => 4, 'akreditasi' => 2, 'tanggal_kadaluarsa' => '2025-10-07'], // B
        ['fakultas_id' => 1, 'nama' => 'Perencanaan Wilayah dan Kota', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2026-04-28'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Geofisika', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-08-20'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Perminyakan', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2027-12-20'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Geologi', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2028-06-27'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Industri', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-12-20'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Kimia', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-12-20'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Perkapalan', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-12-20'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Sipil', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-12-20'], // Baik
        ['fakultas_id' => 1, 'nama' => 'Teknik Transportasi Laut', 'jenjang_id' => 4, 'akreditasi' => 4, 'tanggal_kadaluarsa' => '2029-12-20'], // Baik
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->program_studi as $program_studi) {
            $prodi = ProgramStudi::create([
                'fakultas_id' => $program_studi['fakultas_id'],
                'jenjang_id' => $program_studi['jenjang_id'],
                'nama' => $program_studi['nama'],
                'tanggal_didirikan' => '1963-04-23'
            ]);

            $tanggal_kadaluarsa = $program_studi['tanggal_kadaluarsa'];
            $tanggal_berlaku = null;

            if ($tanggal_kadaluarsa) {
                $carbon_kadaluarsa = Carbon::parse($tanggal_kadaluarsa);
                $tanggal_berlaku = $carbon_kadaluarsa->subYears(5)->toDateString();
            }

            $prodi->akreditasis()->syncWithPivotValues(
                [$program_studi['akreditasi']],
                [
                    'tanggal_berakhir' => $tanggal_kadaluarsa,
                    'tanggal_berlaku' => $tanggal_berlaku
                ]
            );
        }
    }
}
