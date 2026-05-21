<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolContact;

class SchoolContactSeeder extends Seeder
{
    /**
     * Seed data kontak resmi Bimbingan Konseling SMAN 3 Kediri.
     */
    public function run(): void
    {
        SchoolContact::updateOrCreate(
            // Kunci unik: gunakan school_name agar tidak duplikat
            ['school_name' => 'Bimbingan Konseling SMAN 3 Kediri'],
            [
                'address'        => 'Jl. Mauni No 88, Bangsal, Kec. Pesantren, Kota Kediri, Provinsi Jawa Timur 64131',
                'phone'          => '(0354) 683809',
                'email'          => 'sman3kdr@sman3kediri.sch.id',
                'instagram_link' => 'https://www.instagram.com/bk_smaga_kediri/',
                'youtube_link'   => 'https://www.youtube.com/@sman3kediri',
                'tiktok_link'    => 'https://www.tiktok.com/@smagakediri_official',
                'is_active'      => true,
            ]
        );

        $this->command->info('✅ SchoolContact seeded: Bimbingan Konseling SMAN 3 Kediri');
    }
}
