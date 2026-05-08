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
        Schema::create('classical_services', function (Blueprint $table) {
            $table->id();
            $table->string('class_level');        // Contoh: "Kelas 10", "Kelas 11", "Kelas 12"
            $table->string('title');              // Judul materi bimbingan klasikal
            $table->text('description');          // Ringkasan isi materi
            $table->string('game_link')->nullable(); // URL tautan media/permainan interaktif
            $table->string('game_title')->nullable(); // Nama permainan / label tombol
            $table->boolean('is_active')->default(true); // Tampilkan/sembunyikan materi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classical_services');
    }
};
