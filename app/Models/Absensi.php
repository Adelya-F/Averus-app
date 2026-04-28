<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
    'nama_siswa',
    'kelas',
    'tanggal',
    'status'
    ];
}
