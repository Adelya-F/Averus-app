<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar data bisa masuk ke database
    protected $fillable = [
        'title',
        'message',
        'link',
        'is_read'
    ];
}