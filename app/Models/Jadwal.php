<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
    'guru',
    'hari',
    'tanggal',
    'jam',
    'mapel',
    'pengajar'
];
}
