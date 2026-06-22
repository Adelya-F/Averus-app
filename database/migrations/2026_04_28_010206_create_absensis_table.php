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

        $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');

        $table->dateTime('tanggal');

        $table->time('jam_masuk')->nullable();

        $table->string('status')->default('Hadir');

        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};