<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        // ID Guru (yang ngajar)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
        
        // ID Kelas (Biar sekali input, semua siswa di kelas itu dapet jadwalnya)
        $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade'); 
        
        // ID Mapel
        $table->foreignId('mapel_id')->constrained('mapels')->onDelete('cascade'); 
        
        $table->string('hari'); 
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->timestamps();
    });

}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};