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
     * - title       : judul materi bimbingan
     * - description : deskripsi / ringkasan isi materi
     * - category    : jenjang kelas ('kelas-10', 'kelas-11', 'kelas-12')
     * - file_path   : path file dokumen (PDF, PPT, dsb.)
     * - game_link   : URL tautan permainan / media interaktif
     * - is_active   : tampilkan atau sembunyikan materi
     */
    protected $fillable = [
        'title',
        'description',
        'category',
        'file_path',
        'game_link',
        'is_active',
    ];

    /**
     * Cast tipe data kolom ke tipe PHP yang sesuai.
     */
    protected $casts = [
        'is_active' => 'boolean',
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
     * Cek apakah materi ini memiliki file dokumen.
     */
    public function hasFile(): bool
    {
        return !empty($this->file_path);
    }

    /**
     * Cek apakah materi ini memiliki tautan permainan.
     */
    public function hasGameLink(): bool
    {
        return !empty($this->game_link);
    }
}
