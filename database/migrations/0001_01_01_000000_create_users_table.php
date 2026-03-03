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

            // Data Form Averus (Semua dibuat nullable agar Admin/User lain tidak wajib isi)
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

            // Role Management (Default 'siswa')
            // Ditambahkan index() supaya query pencarian role lebih cepat
            $table->string('role')->default('siswa')->index();

            $table->rememberToken();
            $table->timestamps();
        });

        // Tabel bawaan Laravel (Jangan dihapus)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
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