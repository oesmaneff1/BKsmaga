<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration: buat tabel materials.
     *
     * Tabel ini menyimpan materi Bimbingan Klasikal per jenjang kelas.
     * Setiap materi dapat memiliki dokumen (file_path) dan/atau
     * tautan permainan interaktif (game_link).
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();

            // Judul materi bimbingan
            $table->string('title');

            // Deskripsi / ringkasan isi materi
            $table->text('description');

            // Kategori jenjang kelas (hanya 3 nilai yang diizinkan)
            $table->enum('category', ['kelas-10', 'kelas-11', 'kelas-12']);

            // Path file dokumen (PDF, PPT, dsb.) — opsional
            $table->string('file_path')->nullable();

            // URL tautan permainan / media interaktif — opsional
            $table->string('game_link')->nullable();

            // Flag aktif/nonaktif untuk menyembunyikan materi tanpa menghapus
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Batalkan migration: hapus tabel materials.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
