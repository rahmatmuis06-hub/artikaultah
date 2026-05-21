<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel videos.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');                     // nama file asli
            $table->string('path');                          // path ke file di storage
            $table->string('thumbnail')->nullable();         // path thumbnail (opsional)
            $table->integer('urutan')->default(0);           // urutan galeri
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
