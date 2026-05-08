<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel counseling_services untuk menyimpan layanan
     * Bimbingan Konseling (BK) yang tersedia di sekolah.
     */
    public function up(): void
    {
        Schema::create('counseling_services', function (Blueprint $table) {
            $table->id();

            // Relasi ke profil sekolah
            $table->foreignId('school_profile_id')
                  ->constrained('school_profiles')
                  ->onDelete('cascade')
                  ->comment('ID sekolah yang menyediakan layanan ini');

            // Informasi Layanan
            $table->string('title', 200)->comment('Judul / nama layanan BK');
            $table->string('slug', 220)->nullable()->comment('Slug URL-friendly dari judul layanan');
            $table->text('description')->comment('Deskripsi lengkap layanan BK');
            $table->text('short_description')->nullable()->comment('Deskripsi singkat (untuk preview/card)');

            // Kategori Layanan BK
            $table->enum('category', [
                'individual',       // Konseling Individu
                'group',            // Konseling Kelompok
                'academic',         // Bimbingan Akademik
                'career',           // Bimbingan Karir
                'social',           // Bimbingan Sosial
                'personal',         // Bimbingan Pribadi
                'crisis',           // Layanan Krisis / Darurat
                'parent',           // Konsultasi Wali / Orang Tua
                'other'             // Lainnya
            ])->default('individual')->comment('Kategori layanan BK');

            // Jadwal & Durasi
            $table->string('schedule_days', 100)->nullable()->comment('Hari tersedia, contoh: Senin-Jumat');
            $table->time('schedule_start')->nullable()->comment('Jam mulai layanan');
            $table->time('schedule_end')->nullable()->comment('Jam selesai layanan');
            $table->unsignedSmallInteger('duration_minutes')->nullable()->comment('Estimasi durasi per sesi (menit)');

            // Media & Metode
            $table->string('mode', 50)->nullable()->comment('Mode layanan: tatap_muka, online, hybrid');
            $table->string('platform')->nullable()->comment('Platform online jika mode = online, contoh: Zoom, Google Meet');
            $table->string('image_path')->nullable()->comment('Path gambar / icon layanan');

            // Kapasitas
            $table->unsignedSmallInteger('max_participants')->nullable()->comment('Jumlah maksimal peserta per sesi');
            $table->boolean('requires_registration')->default(false)->comment('Apakah membutuhkan pendaftaran terlebih dahulu');

            // Status Ketersediaan
            $table->enum('availability_status', [
                'available',        // Tersedia & bisa diakses
                'full',             // Penuh / kuota habis
                'on_hold',          // Sementara ditunda
                'unavailable',      // Tidak tersedia
                'coming_soon'       // Segera hadir
            ])->default('available')->comment('Status ketersediaan layanan saat ini');

            // Prioritas & Urutan
            $table->unsignedTinyInteger('sort_order')->default(0)->comment('Urutan tampil layanan (ascending)');
            $table->boolean('is_featured')->default(false)->comment('Tampilkan sebagai layanan unggulan');
            $table->boolean('is_active')->default(true)->comment('Aktif atau tidak ditampilkan');

            // Metadata
            $table->unsignedInteger('view_count')->default(0)->comment('Jumlah kali dilihat');
            $table->timestamp('last_updated_availability')->nullable()->comment('Terakhir kali status ketersediaan diubah');

            $table->timestamps();
            $table->softDeletes();

            // Indexes untuk performa query
            $table->index('category');
            $table->index('availability_status');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('sort_order');
            $table->unique(['school_profile_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_services');
    }
};
