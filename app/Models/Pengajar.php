<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;


    protected $table = 'pengajar';


    protected $fillable = [
        'nip',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'mata_pelajaran'
    ];
}