<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini

class Kelas extends Model
{
    // Tambahkan 'next_class_id' ke dalam fillable
    protected $fillable = ['nama_kelas', 'slug', 'next_class_id'];

    // Relasi: Satu kelas punya banyak siswa (User)
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'kelas_id');
    }

    /**
     * Relasi ke Dirinya Sendiri: 
     * Untuk tahu kelas ini kalau naik kelas larinya ke mana.
     */
    public function nextClass(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'next_class_id');
    }
}