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
    Schema::table('users', function (Blueprint $table) {
        // Kita tambah kolom nip, unik, dan ditaruh setelah kolom id
        $table->string('nip')->unique()->after('id')->nullable();
        
        // Opsional: Kalau kamu butuh field lain seperti phone & address di tabel users
        // $table->string('phone')->nullable();
        // $table->text('address')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('nip');
    });
}
};
