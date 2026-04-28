<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('inboxes', function (Blueprint $table) {
        $table->id();
        // ID Siswa yang menerima pesan (Biar ga nyasar ke Admin)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->string('title'); // Contoh: "Konfirmasi Kenaikan Kelas"
        $table->text('message'); // Contoh: "Selamat kamu terpilih naik kelas..."
        
        // Tipe pesan (Promotion = Naik Kelas, Info = Pesan Biasa)
        $table->string('type')->default('info'); 
        
        // Target kelas (Hanya terisi kalau tipenya promotion)
        $table->integer('target_class_id')->nullable(); 
        
        $table->string('link')->nullable(); 
        $table->boolean('is_confirmed')->default(false);
        $table->boolean('is_read')->default(false);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inboxes');
    }
};
