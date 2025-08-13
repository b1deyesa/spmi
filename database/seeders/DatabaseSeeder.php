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
        
        // Fakultas::factory(10)->create();
        // ProgramStudi::factory(20)->create();
        // Dosen::factory(100)->create();
        // Mahasiswa::factory(300)->create();
        
        $deo = User::factory()->create([
            'role_id' => 1,
            'name' => 'Imagodeo Bideyesa',
            'email' => 'bideyesa@gmail.com',
            'password' => Hash::make('magox1905'),
        ]);
        $deo->fakultases()->sync([5,7,10]);
        
        $users = [
            ['name' => 'Paul', 'email' => 'paul@example.com', 'role_id' => 1, 'fakultas_id' => [11]],
            ['name' => 'Johan', 'email' => 'johan@example.com', 'role_id' => 1, 'fakultas_id' => [1]],
            ['name' => 'Arman', 'email' => 'arman@example.com', 'role_id' => 1, 'fakultas_id' => [3]],
            ['name' => 'Lisye', 'email' => 'lisye@example.com', 'role_id' => 1, 'fakultas_id' => [5]],
            ['name' => 'Nova', 'email' => 'nova@example.com', 'role_id' => 1, 'fakultas_id' => [7]],
            ['name' => 'Jufri', 'email' => 'jufri@example.com', 'role_id' => 2, 'fakultas_id' => [1]],
            ['name' => 'James', 'email' => 'james@example.com', 'role_id' => 2, 'fakultas_id' => [1]],
            ['name' => 'Bruri', 'email' => 'bruri@example.com', 'role_id' => 1, 'fakultas_id' => [8]],
            ['name' => 'FKIP', 'email' => 'fkip@sipenjamu.com', 'role_id' => 1, 'fakultas_id' => [5]],
            ['name' => 'Asesor', 'email' => 'asesor@sipenjamu.com', 'role_id' => 1, 'fakultas_id' => [1,2,3,4,5,6,7,8,9,10,11]],
        ];

        foreach ($users as $data) {
            $user = User::factory()->create([
                'role_id' => $data['role_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('sipenjamu2025'),
            ]);

            if ($data['fakultas_id']) {
                $user->fakultases()->sync($data['fakultas_id']);
            }
        }
        
        $prodiIds = [1, 2, 3, 4, 5, 6]; // Pastikan ID ini sudah ada di tabel program_studis

        foreach ($prodiIds as $i => $id) {
            $programStudi = ProgramStudi::find($id);

            if (!$programStudi) {
                continue; // Lewatkan kalau tidak ditemukan
            }

            // Buat data akreditasi inline (melalui relasi pivot)
            $programStudi->akreditasis()->sync([
                [
                    'akreditasi_id' => rand(1,6),
                    'tanggal_berlaku' => ($i % 2 === 0) ? '2022-01-01' : '2015-01-01',
                    'tanggal_berakhir' => ($i % 2 === 0) ? '2027-01-01' : '2020-01-01',
                    'nomor_sk' => 'SK-00' . $id . '/ABC',
                    'is_internasional' => false,
                ],
            ], false); // false agar tidak menghapus yang lain
        }
    }
}
