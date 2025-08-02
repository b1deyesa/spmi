<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    public $role = [
        'admin',
        'spectator',
        'user'
    ];
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->role as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
