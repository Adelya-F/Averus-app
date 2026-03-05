<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'school', 'class', 'hobby', 'address',
        'phone', 'parent_name', 'parent_phone', 'favorite_subject',
        'instagram', 'tiktok', 'role', 'status', 'nip',
        'mata_pelajaran', 'tanggal_lahir', 'jenis_kelamin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date', // Penting agar bisa di-format di Blade
        ];
    }

    public function isAdmin() { return $this->role === 'admin'; }
    public function isSiswa() { return $this->role === 'siswa'; }
}