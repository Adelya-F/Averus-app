<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',         // ID Siswa yang menerima
        'title',
        'message',
        'type',            // Contoh: 'info' atau 'promotion' (kenaikan kelas)
        'target_class_id', // ID kelas tujuan kalau dia naik kelas
        'is_confirmed',    // Status apakah siswa sudah klik "Setuju"
        'is_read',
        'link'
    ];

    // Relasi: Pesan ini punya siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Kelas tujuan kenaikan
    public function targetClass()
    {
        return $this->belongsTo(Kelas::class, 'target_class_id');
    }
}