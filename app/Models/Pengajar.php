<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    protected $fillable = [
    'nip',
    'nama',
    'email',
    'no_hp',
    'alamat',
    'mata_pelajaran',
    'tanggal_lahir',
    'jenis_kelamin'
];
}
