<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapels';
    protected $fillable = ['nama_mapel'];

    // Relasi: Satu mapel bisa muncul di banyak jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'mapel_id');
    }
}