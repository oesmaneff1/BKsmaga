<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah kolom specialization dari enum lama menjadi enum baru
     * dengan pilihan: 'Koordinator BK' | 'Guru BK'
     * Sekaligus hapus kolom description, experience, skills yang tidak dipakai.
     */
    public function up(): void
    {
        // Langkah 1: Ubah ke string dulu agar bisa menampung nilai lama
        DB::statement("ALTER TABLE counselors MODIFY specialization VARCHAR(100) NOT NULL DEFAULT 'Guru BK'");

        // Langkah 2: Migrasi data lama ke nilai baru
        DB::table('counselors')->where('specialization', 'Koordinator Konselor')
            ->update(['specialization' => 'Koordinator BK']);
        DB::table('counselors')->whereNotIn('specialization', ['Koordinator BK'])
            ->update(['specialization' => 'Guru BK']);

        // Langkah 3: Ubah ke enum baru
        DB::statement("ALTER TABLE counselors MODIFY specialization ENUM('Koordinator BK','Guru BK') NOT NULL DEFAULT 'Guru BK'");

        // Langkah 4: Hapus kolom yang tidak dipakai lagi
        Schema::table('counselors', function (Blueprint $table) {
            $table->dropColumn(['description', 'experience', 'skills']);
        });
    }

    /**
     * Rollback ke skema lama jika diperlukan.
     */
    public function down(): void
    {
        Schema::table('counselors', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->string('experience')->nullable();
            $table->json('skills')->nullable();
        });

        DB::statement("ALTER TABLE counselors MODIFY specialization ENUM('Koordinator Konselor','Konselor Pribadi','Konselor Akademik','Konselor Sosial','Konselor Karir') NOT NULL DEFAULT 'Konselor Pribadi'");
    }
};
