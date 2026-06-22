<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahkan ini

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'school',
        'kelas_id', 
        'mapel_id', 
        'hobby',
        'address',
        'phone',
        'parent_name',
        'parent_phone',
        'favorite_subject',
        'instagram',
        'tiktok',
        'role',
        'status',
        'nip',
        'mata_pelajaran',
        'tanggal_lahir',
        'jenis_kelamin',
        'avatar',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }

    /**
     * Relasi ke Tabel Kelas
     * Siswa memiliki satu kelas (Many-to-One)
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Role helpers
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    public function isPengajar()
    {
        return $this->role === 'pengajar';
    }

    /**
     * Relasi untuk mendapatkan jadwal
     */
    public function jadwals()
    {
        if ($this->isSiswa()) {
            // Siswa melihat jadwal berdasarkan kelas mereka
            return $this->hasMany(Jadwal::class, 'kelas_id', 'kelas_id');
        }

        if ($this->isPengajar()) {
            // Pengajar melihat jadwal berdasarkan user_id mereka
            return $this->hasMany(Jadwal::class, 'user_id');
        }

        return null;
    }

    // app/Models/User.php

    public function mapel()
    {
        // Pastikan 'mapel_id' di sini adalah nama kolom di database tabel 'users'
        return $this->belongsTo(\App\Models\Mapel::class, 'mapel_id', 'id');
    }
}