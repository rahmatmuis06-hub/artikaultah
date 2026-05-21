<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi untuk membuat tabel harapans.
     */
    public function up(): void
    {
        Schema::create('harapans', function (Blueprint $table) {
            $table->id();
            $table->string('isi');                  // isi harapan/doa
            $table->integer('urutan')->default(0);  // urutan tampil
            $table->boolean('aktif')->default(true); // tampil atau tidak
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('harapans');
    }
};
