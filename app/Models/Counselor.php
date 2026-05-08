<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Counselor extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'photo',
        'specialization',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Pilihan jabatan untuk dropdown form admin.
     */
    public static array $jabatanOptions = [
        'Koordinator BK',
        'Guru BK',
    ];

    /**
     * Accessor: URL foto profil yang siap dipakai di <img src="...">.
     */
    public function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->photo
                ? asset('uploads/' . $this->photo)
                : null,
        );
    }

    /**
     * Scope: hanya konselor aktif, diurutkan berdasarkan sort_order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }
}
