<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jadwal extends Model
{
    // Sesuaikan fillable dengan migration terbaru (pake kelas_id)
    protected $fillable = [
        'user_id', 
        'kelas_id', 
        'mapel_id', 
        'hari', 
        'jam_mulai', 
        'jam_selesai'
    ];

    // Relasi ke Guru (User yang mengajar)
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Kelas (Bukan ke siswa satuan lagi)
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke Mata Pelajaran
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}