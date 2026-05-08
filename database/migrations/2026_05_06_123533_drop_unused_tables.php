<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Hapus tabel-tabel yang sudah tidak digunakan di sistem baru.
     */
    public function up(): void
    {
        // Drop counseling_services (karena digantikan oleh sistem Materi & Counselor terpisah)
        Schema::dropIfExists('counseling_services');
        
        // Drop classical_services (karena skema data ditarik langsung dari model Material)
        Schema::dropIfExists('classical_services');
        
        // Drop school_profiles (hanya digunakan oleh counseling_services)
        Schema::dropIfExists('school_profiles');
    }

    /**
     * Reverse the migrations (Tidak direkomendasikan karena data akan hilang permanen).
     */
    public function down(): void
    {
        // Kosongkan down() karena ini adalah pembersihan permanen data redundan
    }
};
