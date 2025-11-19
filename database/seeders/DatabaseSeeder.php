<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Petugas::create([
            'nama_petugas' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'id_level' => '1',
        ]);

        // Petugas biasa
        Petugas::create([
            'nama_petugas' => 'Petugas Satu',
            'username' => 'petugas1',
            'password' => Hash::make('petugas123'),
            'id_level' => '2',
        ]);
    }
}
