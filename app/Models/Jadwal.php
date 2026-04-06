<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'jadwals';

    protected $fillable = [
        'user_id', 
        'mapel_id', 
        'hari', 
        'jam_mulai', 
        'jam_selesai'
    ];

    // Relasi ke Guru (User)
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Mata Pelajaran (Mapel)
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}