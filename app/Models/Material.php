<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan model ini.
     */
    protected $table = 'materials';

    /**
     * Kolom yang boleh diisi secara massal (mass assignment).
     *
     * - title        : judul materi bimbingan
     * - description  : deskripsi / ringkasan isi materi
     * - category     : jenjang kelas ('kelas-10', 'kelas-11', 'kelas-12')
     * - files        : array path file dokumen (PDF, PPT, dsb.) — format JSON
     * - game_links   : array URL tautan permainan / media interaktif — format JSON
     * - rpl_document : path dokumen RPL (opsional)
     * - is_active    : tampilkan atau sembunyikan materi
     */
    protected $fillable = [
        'title',
        'description',
        'category',
        'files',
        'game_links',
        'rpl_document',
        'is_active',
    ];

    /**
     * Cast tipe data kolom ke tipe PHP yang sesuai.
     * Kolom JSON akan otomatis dikonversi menjadi array PHP.
     */
    protected $casts = [
        'is_active'  => 'boolean',
        'files'      => 'array',
        'game_links' => 'array',
    ];

    // ─── Scopes ──────────────────────────────────────────────────────────────

    /**
     * Scope: hanya materi yang aktif (is_active = true).
     *
     * Penggunaan: Material::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: filter berdasarkan kategori kelas.
     *
     * Penggunaan: Material::forCategory('kelas-10')->get()
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category  Salah satu dari: 'kelas-10', 'kelas-11', 'kelas-12'
     */
    public function scopeForCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    /**
     * Kembalikan label kelas yang mudah dibaca manusia.
     *
     * Contoh: 'kelas-10' → 'Kelas 10'
     */
    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'kelas-10' => 'Kelas 10',
            'kelas-11' => 'Kelas 11',
            'kelas-12' => 'Kelas 12',
            default    => ucfirst(str_replace('-', ' ', $this->category)),
        };
    }

    /**
     * Cek apakah materi ini memiliki setidaknya satu file dokumen.
     */
    public function hasFile(): bool
    {
        return !empty($this->files) && count($this->files) > 0;
    }

    /**
     * Cek apakah materi ini memiliki setidaknya satu tautan permainan.
     */
    public function hasGameLink(): bool
    {
        return !empty($this->game_links) && count($this->game_links) > 0;
    }

    /**
     * Ambil file pertama (primary file) dari array files.
     * Berguna untuk backward compatibility dengan tampilan yang hanya butuh 1 file.
     */
    public function getPrimaryFileAttribute(): ?string
    {
        return $this->files[0] ?? null;
    }

    /**
     * Ambil game link pertama (primary link) dari array game_links.
     */
    public function getPrimaryGameLinkAttribute(): ?string
    {
        return $this->game_links[0] ?? null;
    }
}
