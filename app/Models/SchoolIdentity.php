<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;

class SchoolIdentity extends Model
{
    use HasFactory;

    protected $table = 'school_identities';

    protected $fillable = [
        'type',
        'content',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    // ── Konstanta tipe ────────────────────────────────────────────────────
    const TYPE_VISI = 'visi';
    const TYPE_MISI = 'misi';
    const TYPE_MOTO = 'moto';

    // ── Scopes ───────────────────────────────────────────────────────────

    /** Hanya record yang aktif */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Filter berdasarkan tipe */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /** Urutkan berdasarkan kolom order */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // ── Static helpers ───────────────────────────────────────────────────

    /**
     * Ambil semua data sekaligus dan kelompokkan per type.
     * Return: ['visi' => Collection, 'misi' => Collection, 'moto' => Collection]
     */
    public static function allGrouped(): array
    {
        $all = static::active()->ordered()->get();

        return [
            'visi' => $all->where('type', self::TYPE_VISI)->values(),
            'misi' => $all->where('type', self::TYPE_MISI)->values(),
            'moto' => $all->where('type', self::TYPE_MOTO)->values(),
        ];
    }

    /**
     * Ambil satu record visi (record pertama yang aktif).
     */
    public static function getVisi(): ?self
    {
        return static::active()->ofType(self::TYPE_VISI)->ordered()->first();
    }

    /**
     * Ambil semua baris misi aktif, terurut.
     */
    public static function getMisi(): Collection
    {
        return static::active()->ofType(self::TYPE_MISI)->ordered()->get();
    }

    /**
     * Ambil satu record moto (record pertama yang aktif).
     */
    public static function getMoto(): ?self
    {
        return static::active()->ofType(self::TYPE_MOTO)->ordered()->first();
    }

    // ── Accessor ─────────────────────────────────────────────────────────

    /** Label human-readable untuk tipe */
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            self::TYPE_VISI => 'Visi Sekolah',
            self::TYPE_MISI => 'Misi Sekolah',
            self::TYPE_MOTO => 'Moto Sekolah',
            default         => ucfirst($this->type),
        };
    }
}
