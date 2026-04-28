<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Martin Edwards
        User::create([
            'name'             => 'MARTIN EDWARDS',
            'email'            => 'martin@gmail.com',
            'password'         => Hash::make('martincortis'), // Pakai Hash::make biar aman
            'role'             => 'siswa',
            'status'           => 'accepted',
            'school'           => 'SMAN 8 BANDUNG',
            'kelas_id'         => 1, // Pastikan ID 1 ada di tabel kelas
            'hobby'            => 'Rap',
            'address'          => 'JLN. Cortis',
            'phone'            => '088999998899',
            'parent_name'      => 'mari',
            'parent_phone'     => '088998766543',
            'favorite_subject' => 'Bahasa inggris',
            'instagram'        => 'martinCoer',
            'tiktok'           => 'martinCoer',
            'tanggal_lahir'    => '2008-03-20',
        ]);

        // 2. Data Kamu (Buat Tes Login)
        User::create([
            'name'             => 'Annisa',
            'email'            => 'annisa@averus.com',
            'password'         => Hash::make('password123'),
            'role'             => 'siswa',
            'status'           => 'accepted',
            'school'           => 'Vocational High School',
            'kelas_id'         => 1,
            'address'          => 'Bandung',
            'phone'            => '08123456789',
            'parent_name'      => 'Ortu Annisa',
            'parent_phone'     => '08129876543',
            'favorite_subject' => 'Web Development',
        
        ]);
    }
}