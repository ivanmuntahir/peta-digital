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
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id') // Foreign key ke tabel kecamatans
                  ->constrained('kecamatans') // Merujuk ke tabel 'kecamatans'
                  ->onDelete('cascade'); // Jika kecamatan dihapus, kelurahan ikut terhapus
            $table->string('name'); // Nama kelurahan/desa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahans');
    }
};
