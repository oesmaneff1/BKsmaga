<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolContact extends Model
{
    use HasFactory;

    protected $table = 'school_contacts';

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'school_name',
        'address',
        'phone',
        'email',
        'instagram_link',
        'youtube_link',
        'tiktok_link',
        'is_active',
    ];

    /**
     * Cast tipe data.
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ========================
    //  SCOPES
    // ========================

    /**
     * Scope: hanya entri yang aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ========================
    //  STATIC HELPERS
    // ========================

    /**
     * Ambil data kontak aktif pertama.
     * Jika belum ada data di DB, kembalikan default hardcoded
     * agar halaman tidak error saat migrasi belum dijalankan.
     */
    public static function getActive(): self
    {
        return static::active()->first() ?? new self([
            'school_name'    => 'Bimbingan Konseling SMAN 3 Kediri',
            'address'        => 'Jl. Mauni No 88, Bangsal, Kec. Pesantren, Kota Kediri, Provinsi Jawa Timur 64131',
            'phone'          => '(0354) 683809',
            'email'          => 'sman3kdr@sman3kediri.sch.id',
            'instagram_link' => 'https://www.instagram.com/bk_smaga_kediri/',
            'youtube_link'   => 'https://www.youtube.com/@sman3kediri',
            'tiktok_link'    => 'https://www.tiktok.com/@smagakediri_official',
            'is_active'      => true,
        ]);
    }
}
