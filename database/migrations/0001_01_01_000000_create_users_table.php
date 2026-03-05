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
        Schema::create('users', function (Blueprint $table) {
    $table->id();

    // Kredensial Login Utama
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');

    // Data Form Averus

    $table->string('school')->nullable();
    $table->string('class')->nullable();
    $table->string('hobby')->nullable();
    $table->text('address')->nullable();
    $table->string('phone')->nullable();
    $table->string('parent_name')->nullable();
    $table->string('parent_phone')->nullable();
    $table->string('favorite_subject')->nullable();
    $table->string('instagram')->nullable();
    $table->string('tiktok')->nullable();
    $table->string('status')->default('pending');

    // Role
    $table->string('role')->default('siswa')->index();

    // 🔥 Tambahan Data Pengajar (WAJIB di dalam sini)
    $table->string('nip')->nullable()->unique();
    $table->string('mata_pelajaran')->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('jenis_kelamin')->nullable();

    $table->rememberToken();
    $table->timestamps();
});
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};