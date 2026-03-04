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
        $table->string('title');   // Contoh: "Pendaftaran Baru"
        $table->text('message');   // Contoh: "Budi (SMA 1) baru saja mendaftar"
        $table->string('link');    // Isinya: route('admin.verifikasi')
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
