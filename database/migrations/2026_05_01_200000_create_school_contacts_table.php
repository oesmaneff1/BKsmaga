<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel school_contacts untuk menyimpan informasi kontak
     * dan media sosial resmi Bimbingan Konseling SMAN 3 Kediri.
     */
    public function up(): void
    {
        Schema::create('school_contacts', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('school_name', 200)
                  ->default('Bimbingan Konseling SMAN 3 Kediri')
                  ->comment('Nama unit / sekolah yang ditampilkan');

            // Lokasi
            $table->string('address', 300)
                  ->default('Jl. Mauni No 88, Bangsal, Kec. Pesantren, Kota Kediri, Provinsi Jawa Timur 64131')
                  ->comment('Alamat lengkap sekolah');

            // Kontak
            $table->string('phone', 30)
                  ->default('(0354) 683809')
                  ->comment('Nomor telepon resmi');

            $table->string('email', 150)
                  ->default('sman3kdr@sman3kediri.sch.id')
                  ->comment('Email resmi sekolah');

            // Tautan Media Sosial
            $table->string('instagram_link', 300)
                  ->default('https://www.instagram.com/smagakediri.official/')
                  ->comment('URL profil Instagram resmi');

            $table->string('youtube_link', 300)
                  ->default('https://www.youtube.com/@sman3kediri')
                  ->comment('URL kanal YouTube resmi');

            $table->string('tiktok_link', 300)
                  ->default('https://www.tiktok.com/@smagakediri_official')
                  ->comment('URL profil TikTok resmi');

            // Status aktif
            $table->boolean('is_active')
                  ->default(true)
                  ->comment('Apakah entri kontak ini aktif digunakan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_contacts');
    }
};
