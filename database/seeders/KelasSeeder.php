<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
{
    // 1. Buat dulu semua kelasnya
    $k10 = \App\Models\Kelas::create(['nama_kelas' => 'KELAS 10', 'slug' => 'kelas-10']);
    $k11 = \App\Models\Kelas::create(['nama_kelas' => 'KELAS 11', 'slug' => 'kelas-11']);
    $k12 = \App\Models\Kelas::create(['nama_kelas' => 'KELAS 12', 'slug' => 'kelas-12']);

    // 2. Baru set alur kenaikannya (Update)
    $k10->update(['next_class_id' => $k11->id]);
    $k11->update(['next_class_id' => $k12->id]);
    // Kelas 12 biarkan NULL karena targetnya Kelulusan
}
}