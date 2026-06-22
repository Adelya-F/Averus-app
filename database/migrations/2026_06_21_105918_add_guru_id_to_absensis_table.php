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
    Schema::table('absensis', function (Blueprint $table) {

        $table->foreignId('guru_id')
            ->after('user_id')
            ->nullable()
            ->constrained('users')
            ->cascadeOnDelete();

    });
}


public function down(): void
{
    Schema::table('absensis', function (Blueprint $table) {
        $table->dropForeign(['guru_id']);
        $table->dropColumn('guru_id');
    });
}
};
