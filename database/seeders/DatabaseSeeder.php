<?php

namespace Database\Seeders;

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
        ]);
        
        // Fakultas::factory(10)->create();
        // ProgramStudi::factory(20)->create();
        // Dosen::factory(100)->create();
        // Mahasiswa::factory(300)->create();
        
        $user = User::factory()->create([
            'role_id' => 1,
            'name' => 'Imagodeo Bideyesa',
            'email' => 'bideyesa@gmail.com',
            'password' => Hash::make('magox1905'),
        ]);
        
        $user->fakultases()->sync([5,7,10]);
        
        
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
