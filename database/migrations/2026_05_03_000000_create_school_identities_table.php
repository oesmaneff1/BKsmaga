<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_identities', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['visi', 'misi', 'moto']);
            $table->text('content');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['type', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_identities');
    }
};
