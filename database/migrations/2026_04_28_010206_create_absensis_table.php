<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            // relasi ke user (siswa)
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // tanggal + jam
            $table->dateTime('tanggal');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};