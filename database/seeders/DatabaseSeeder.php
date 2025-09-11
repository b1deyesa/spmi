<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([
            AkreditasiSeeder::class,
            JenjangSeeder::class,
            FakultasSeeder::class,
            ProgramStudiSeeder::class,
            KebijakanSeeder::class,
            RoleSeeder::class,
            ProfilSeeder::class,
            PenetapanSeeder::class,
        ]);
        
        // // Fakultas::factory(10)->create();
        // // ProgramStudi::factory(20)->create();
        // // Dosen::factory(100)->create();
        // // Mahasiswa::factory(300)->create();
        
        $deo = User::factory()->create([
            'role_id' => 1,
            'name' => 'Imagodeo Bideyesa',
            'email' => 'bideyesa@gmail.com',
            'password' => Hash::make('magox1905'),
        ]);
        
        $deo->fakultases()->sync([5,7,10]);
        
        $fakultas = [
            ['nama' => 'Teknik', 'inisial' => 'FATEK', 'warna' => '#2E3B4E'],
            ['nama' => 'Pertanian', 'inisial' => 'FAPERTA', 'warna' => '#7C9D4F'],
            ['nama' => 'Hukum', 'inisial' => 'FH', 'warna' => '#5A3D2C'],
            ['nama' => 'Kedokteran', 'inisial' => 'FK', 'warna' => '#D6C9B4'],
            ['nama' => 'Keguruan dan Ilmu Pendidikan', 'inisial' => 'FKIP', 'warna' => '#F2A900'],
            ['nama' => 'Ilmu Sosial dan Ilmu Politik', 'inisial' => 'FISIP', 'warna' => '#3B6D8C'],
            ['nama' => 'Ekonomi dan Bisnis', 'inisial' => 'FEBIS', 'warna' => '#FF8C00'],
            ['nama' => 'Perikanan dan Ilmu Kelautan', 'inisial' => 'FPIK', 'warna' => '#1F77B4'],
            ['nama' => 'Sains dan Teknologi', 'inisial' => 'FST', 'warna' => '#FF5733'],
            ['nama' => 'Program Studi Diluar Kampus Utama', 'inisial' => 'PSDKU', 'warna' => '#FFB6C1'],
            ['nama' => 'Pascasarjana', 'inisial' => 'Pasca', 'warna' => '#4B0082'],
        ];
        
        $users = [
            ['name' => 'Paul', 'email' => 'paul@example.com', 'role_id' => 1, 'fakultas_id' => [11]],
            ['name' => 'Johan', 'email' => 'johan@example.com', 'role_id' => 1, 'fakultas_id' => [1]],
            ['name' => 'Arman', 'email' => 'arman@example.com', 'role_id' => 1, 'fakultas_id' => [3]],
            ['name' => 'Lisye', 'email' => 'lisye@example.com', 'role_id' => 1, 'fakultas_id' => [5]],
            ['name' => 'Nova', 'email' => 'nova@example.com', 'role_id' => 1, 'fakultas_id' => [7]],
            ['name' => 'Jufri', 'email' => 'jufri@example.com', 'role_id' => 2, 'fakultas_id' => [1]],
            ['name' => 'James', 'email' => 'james@example.com', 'role_id' => 2, 'fakultas_id' => [1]],
            ['name' => 'Bruri', 'email' => 'bruri@example.com', 'role_id' => 1, 'fakultas_id' => [8]],
            ['name' => 'FKIP', 'email' => 'fkip@esipenjamu.com', 'role_id' => 1, 'fakultas_id' => [5]],
            ['name' => 'FKIP', 'email' => 'asesor@esipenjamu.com', 'role_id' => 1, 'fakultas_id' => [1,2]],
        ];
        
        
        foreach ($fakultas as $index => $f) {
            $email = strtolower($f['inisial']) . '@unpatti.ac.id';
            $password = $f['inisial'] . rand(1000, 9999);
        
            $users[] = [
                'name' => $f['nama'],
                'email' => $email,
                'password' => $password,
                'role_id' => 1, // role default fakultas
                'fakultas_id' => [$index + 1],
            ];
        }
        
        foreach ($users as $data) {
            $user = User::factory()->create([
                'role_id' => $data['role_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('sipenjamu-demo'),
            ]);

            if ($data['fakultas_id']) {
                $user->fakultases()->sync($data['fakultas_id']);
            }
        }
        
        User::find(9)->fakultases()->sync([1,2,3,4,5,6,7,8,9,10,11]);
        
    }
}
