    <?php

    use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('register', function (Blueprint $table) {
            $table->id(); // bigint auto increment

            $table->unsignedBigInteger('user_id'); 
            $table->string('nama_lengkap');
            $table->string('sekolah');
            $table->string('kelas');
            $table->string('hobi')->nullable();
            $table->text('alamat_lengkap');
            $table->string('no_hp');
            $table->string('nama_ortu');
            $table->string('no_hp_ortu');
            $table->string('mapel_disukai');
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();

            $table->timestamps();

            // relasi ke tabel users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('register');
    }
};