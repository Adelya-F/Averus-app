<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Kita tambah kolom next_class_id setelah slug
            $table->unsignedBigInteger('next_class_id')->nullable()->after('slug');
            
            // Bikin foreign key supaya datanya sinkron dengan id di tabel kelas itu sendiri
            $table->foreign('next_class_id')->references('id')->on('kelas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropForeign(['next_class_id']);
            $table->dropColumn('next_class_id');
        });
    }
};