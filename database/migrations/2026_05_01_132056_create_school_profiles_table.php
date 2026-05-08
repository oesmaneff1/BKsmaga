<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel school_profiles untuk menyimpan profil sekolah
     * yang memiliki layanan Bimbingan Konseling (BK).
     */
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();

            // Identitas Sekolah
            $table->string('school_name', 150)->comment('Nama lengkap sekolah');
            $table->string('npsn', 20)->unique()->nullable()->comment('Nomor Pokok Sekolah Nasional');
            $table->string('school_type', 50)->comment('Jenis sekolah: SMP, SMA, SMK, dll');
            $table->string('accreditation', 5)->nullable()->comment('Akreditasi sekolah: A, B, C, dll');

            // Lokasi
            $table->string('address')->comment('Alamat lengkap sekolah');
            $table->string('village', 100)->nullable()->comment('Kelurahan / Desa');
            $table->string('district', 100)->nullable()->comment('Kecamatan');
            $table->string('city', 100)->comment('Kota / Kabupaten');
            $table->string('province', 100)->comment('Provinsi');
            $table->string('postal_code', 10)->nullable()->comment('Kode pos');

            // Kontak
            $table->string('phone', 20)->nullable()->comment('Nomor telepon sekolah');
            $table->string('email')->nullable()->comment('Email resmi sekolah');
            $table->string('website')->nullable()->comment('Website sekolah');

            // Informasi BK
            $table->unsignedSmallInteger('total_counselors')->default(0)->comment('Jumlah guru BK aktif');
            $table->unsignedSmallInteger('total_students')->default(0)->comment('Jumlah siswa aktif');
            $table->text('vision')->nullable()->comment('Visi sekolah');
            $table->text('mission')->nullable()->comment('Misi sekolah');
            $table->text('bk_program_description')->nullable()->comment('Deskripsi program BK sekolah');

            // Status
            $table->enum('status', ['active', 'inactive', 'pending'])
                  ->default('active')
                  ->comment('Status keaktifan profil sekolah');

            $table->timestamps();
            $table->softDeletes();

            // Index
            $table->index('school_type');
            $table->index('city');
            $table->index('province');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
