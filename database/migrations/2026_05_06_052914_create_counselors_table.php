<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel counselors untuk menyimpan data Tim BK SMAN 3 Kediri.
     */
    public function up(): void
    {
        Schema::create('counselors', function (Blueprint $table) {
            $table->id();

            $table->string('name');               // Nama lengkap beserta gelar, misal: "Dra. Endang S., M.Pd."
            $table->string('nip')->nullable();    // Nomor Induk Pegawai (boleh kosong untuk non-PNS)
            $table->string('role')->nullable();   // Jabatan singkat yang ditampilkan di kartu, misal: "Koordinator BK & Konselor"
            $table->string('photo')->nullable();  // Path relatif ke storage, misal: "counselors/foto.jpg"

            $table->enum('specialization', [
                'Koordinator Konselor',
                'Konselor Pribadi',
                'Konselor Akademik',
                'Konselor Sosial',
                'Konselor Karir',
            ])->default('Konselor Pribadi');      // Bidang spesialisasi utama

            $table->text('description')->nullable(); // Deskripsi singkat / spesialisasi detail
            $table->string('experience')->nullable(); // Contoh: "15+ Tahun"
            $table->json('skills')->nullable();      // Array skill/keahlian, misal: ["Konseling Pribadi","Mediasi Konflik"]

            $table->boolean('is_active')->default(true); // Untuk toggle tampil/sembunyi
            $table->integer('sort_order')->default(0);   // Urutan tampil di halaman Tim BK

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselors');
    }
};
