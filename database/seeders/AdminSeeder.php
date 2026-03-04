<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini kalau Hash merah
use App\Models\User; // Tambahkan ini manual kalau User merah

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Tambahkan 'status' => 'accepted' supaya admin nggak kena cegat rute sendiri
        User::updateOrCreate(
            ['email' => 'admin@bimbel.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'accepted', 
            ]
        );
    }
}