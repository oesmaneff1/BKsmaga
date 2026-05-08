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
        Schema::table('classical_services', function (Blueprint $table) {
            $table->string('category')->nullable()->after('class_level'); // misalnya: kelas-10
        });

        // Update existing rows
        \Illuminate\Support\Facades\DB::table('classical_services')
            ->where('class_level', 'Kelas 10')->update(['category' => 'kelas-10']);
        \Illuminate\Support\Facades\DB::table('classical_services')
            ->where('class_level', 'Kelas 11')->update(['category' => 'kelas-11']);
        \Illuminate\Support\Facades\DB::table('classical_services')
            ->where('class_level', 'Kelas 12')->update(['category' => 'kelas-12']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classical_services', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
