<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kelas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kelas'); // Contoh: "10 SMA" atau "12 SMK"
        $table->string('slug');       // Contoh: "10-sma" (untuk URL nanti)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
