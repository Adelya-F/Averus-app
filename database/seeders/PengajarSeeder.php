<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class PengajarSeeder extends Seeder
{

public function run(): void
{
    User::create([
        'name' => 'Pengajar 1',
        'email' => 'pengajar1@gmail.com',
        'password' => Hash::make('12345678'),
        'role' => 'pengajar'
    ]);
}
}
