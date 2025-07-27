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
        Schema::table('places', function (Blueprint $table) {
            $table->foreignId('kecamatan_id')
                  ->nullable() // Izinkan NULL jika tempat bisa tanpa kecamatan (opsional)
                  ->constrained('kecamatans') // Referensi ke tabel 'kecamatans'
                  ->onUpdate('cascade') // Saat kecamatan diperbarui, update di sini
                  ->onDelete('set null'); // Saat kecamatan dihapus, set ID ini menjadi NULL (atau 'cascade' jika ingin menghapus tempat juga)

            // Kolom kelurahan_id
            $table->foreignId('kelurahan_id')
                  ->nullable() // Izinkan NULL jika tempat bisa tanpa kelurahan (opsional)
                  ->constrained('kelurahans') // Referensi ke tabel 'kelurahans'
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('places', function (Blueprint $table) {
            $table->dropForeign(['kecamatan_id']);
            $table->dropForeign(['kelurahan_id']);

            // Drop kolom-kolomnya
            $table->dropColumn('kecamatan_id');
            $table->dropColumn('kelurahan_id');
        });
    }
};
