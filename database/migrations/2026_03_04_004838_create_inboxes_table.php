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
        $table->string('title');   
        $table->text('message');   
        $table->string('link')->nullable(); // Ditambah nullable agar tidak error jika kosong
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
