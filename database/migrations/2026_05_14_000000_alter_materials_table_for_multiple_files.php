<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migration.
     *
     * Strategi:
     * 1. Migrasi data lama (file_path, game_link) ke format JSON baru.
     * 2. Hapus kolom lama.
     * 3. Tambahkan kolom baru: files (json), game_links (json), rpl_document (string?).
     */
    public function up(): void
    {
        // ── Langkah 1: Tambah kolom baru sementara (nullable agar tidak error) ──
        Schema::table('materials', function (Blueprint $table) {
            $table->json('files')->nullable()->after('category');
            $table->json('game_links')->nullable()->after('files');
            $table->string('rpl_document')->nullable()->after('game_links');
        });

        // ── Langkah 2: Migrasi data lama ke format JSON ──────────────────────
        // Ambil semua baris yang punya data lama lalu konversikan ke array JSON
        DB::table('materials')->get()->each(function ($material) {
            $files      = $material->file_path ? [$material->file_path] : [];
            $gameLinks  = $material->game_link  ? [$material->game_link]  : [];

            DB::table('materials')
                ->where('id', $material->id)
                ->update([
                    'files'      => json_encode($files),
                    'game_links' => json_encode($gameLinks),
                ]);
        });

        // ── Langkah 3: Hapus kolom lama ──────────────────────────────────────
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'game_link']);
        });
    }

    /**
     * Batalkan migration (rollback).
     *
     * Kembalikan ke skema lama: file_path (string) dan game_link (string).
     */
    public function down(): void
    {
        // ── Langkah 1: Tambah kembali kolom lama ─────────────────────────────
        Schema::table('materials', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('category');
            $table->string('game_link')->nullable()->after('file_path');
        });

        // ── Langkah 2: Kembalikan data dari JSON ke format lama ───────────────
        DB::table('materials')->get()->each(function ($material) {
            $files     = json_decode($material->files,      true) ?? [];
            $gameLinks = json_decode($material->game_links, true) ?? [];

            DB::table('materials')
                ->where('id', $material->id)
                ->update([
                    'file_path' => $files[0]     ?? null,
                    'game_link' => $gameLinks[0] ?? null,
                ]);
        });

        // ── Langkah 3: Hapus kolom baru ──────────────────────────────────────
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['files', 'game_links', 'rpl_document']);
        });
    }
};
