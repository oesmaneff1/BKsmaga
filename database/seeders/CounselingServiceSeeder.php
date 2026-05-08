<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolProfile;
use App\Models\CounselingService;

class CounselingServiceSeeder extends Seeder
{
    public function run(): void
    {
        // ── Buat / ambil profil sekolah ──────────────────────────────
        $school = SchoolProfile::firstOrCreate(
            ['npsn' => '20535372'],
            [
                'school_name'           => 'SMA Negeri 3 Kediri',
                'school_type'           => 'SMA',
                'accreditation'         => 'A',
                'address'               => 'Jl. Mayjend Sungkono No.24',
                'city'                  => 'Kediri',
                'province'              => 'Jawa Timur',
                'postal_code'           => '64129',
                'phone'                 => '(0354) 771330',
                'email'                 => 'sman3kediri@gmail.com',
                'website'               => 'https://sman3kediri.sch.id',
                'total_counselors'      => 4,
                'total_students'        => 850,
                'vision'                => 'Menjadi sekolah unggul bertaraf nasional yang menghasilkan lulusan beriman, berilmu, dan berakhlak mulia.',
                'mission'               => 'Menyelenggarakan pembelajaran inovatif berbasis teknologi, pengembangan karakter, dan kemitraan dengan orang tua serta masyarakat.',
                'bk_program_description'=> 'Program BK SMAN 3 Kediri dirancang untuk mendampingi siswa dalam aspek akademik, sosial, karir, dan pribadi secara holistik.',
                'status'                => 'active',
            ]
        );

        // ── Data layanan BK ──────────────────────────────────────────
        $services = [

            // ─ KONSELING INDIVIDU ────────────────────────────────────
            [
                'title'               => 'Konseling Individu',
                'slug'                => 'konseling-individu',
                'description'         => 'Sesi tatap muka rahasia antara siswa dan konselor profesional untuk membahas permasalahan pribadi, akademik, sosial, atau emosional. Setiap sesi berlangsung 45–60 menit dan bersifat sangat rahasia. Konselor akan membantu siswa memahami masalah, mengeksplorasi pilihan, dan menyusun rencana tindakan yang tepat.',
                'short_description'   => 'Sesi privat bersama konselor untuk permasalahan pribadi, akademik, maupun sosial yang bersifat rahasia.',
                'category'            => 'individual',
                'schedule_days'       => 'Senin – Jumat',
                'schedule_start'      => '08:00:00',
                'schedule_end'        => '14:00:00',
                'duration_minutes'    => 60,
                'mode'                => 'tatap_muka',
                'max_participants'    => 1,
                'requires_registration'=> true,
                'availability_status' => 'available',
                'sort_order'          => 1,
                'is_featured'         => true,
                'is_active'           => true,
            ],

            // ─ KONSELING KELOMPOK ────────────────────────────────────
            [
                'title'               => 'Konseling Kelompok',
                'slug'                => 'konseling-kelompok',
                'description'         => 'Sesi diskusi terarah dalam kelompok kecil (5–8 siswa) bersama konselor. Membantu siswa mengembangkan keterampilan interpersonal, berbagi pengalaman, dan belajar dari perspektif teman sebaya dalam lingkungan yang aman dan supportif.',
                'short_description'   => 'Diskusi kelompok kecil untuk mengembangkan keterampilan sosial dan menyelesaikan masalah bersama.',
                'category'            => 'group',
                'schedule_days'       => 'Selasa & Kamis',
                'schedule_start'      => '13:00:00',
                'schedule_end'        => '14:30:00',
                'duration_minutes'    => 90,
                'mode'                => 'tatap_muka',
                'max_participants'    => 8,
                'requires_registration'=> true,
                'availability_status' => 'available',
                'sort_order'          => 2,
                'is_featured'         => true,
                'is_active'           => true,
            ],

            // ─ BIMBINGAN AKADEMIK ────────────────────────────────────
            [
                'title'               => 'Bimbingan Akademik',
                'slug'                => 'bimbingan-akademik',
                'description'         => 'Layanan pendampingan akademik yang meliputi perencanaan belajar, strategi menghadapi ujian, remedial, dan konsultasi pemilihan jurusan kuliah. Konselor bekerja sama dengan guru mata pelajaran untuk memastikan siswa dapat mencapai potensi akademik terbaiknya.',
                'short_description'   => 'Pendampingan perencanaan belajar, strategi ujian, dan pemilihan jurusan kuliah.',
                'category'            => 'academic',
                'schedule_days'       => 'Senin – Jumat',
                'schedule_start'      => '07:30:00',
                'schedule_end'        => '14:00:00',
                'duration_minutes'    => 45,
                'mode'                => 'tatap_muka',
                'max_participants'    => 1,
                'requires_registration'=> false,
                'availability_status' => 'available',
                'sort_order'          => 3,
                'is_featured'         => false,
                'is_active'           => true,
            ],

            // ─ BIMBINGAN KARIR ───────────────────────────────────────
            [
                'title'               => 'Bimbingan Karir',
                'slug'                => 'bimbingan-karir',
                'description'         => 'Program eksplorasi minat, bakat, dan perencanaan karir jangka panjang. Mencakup tes minat bakat (RIASEC), informasi berbagai jurusan PTN/PTS, beasiswa, dan dunia kerja. Siswa akan dibantu menyusun rencana studi dan karir yang sesuai dengan potensi dan passion mereka.',
                'short_description'   => 'Eksplorasi minat bakat, info jurusan PTN/PTS, beasiswa, dan perencanaan masa depan.',
                'category'            => 'career',
                'schedule_days'       => 'Rabu & Jumat',
                'schedule_start'      => '09:00:00',
                'schedule_end'        => '12:00:00',
                'duration_minutes'    => 60,
                'mode'                => 'tatap_muka',
                'max_participants'    => 1,
                'requires_registration'=> true,
                'availability_status' => 'available',
                'sort_order'          => 4,
                'is_featured'         => true,
                'is_active'           => true,
            ],

            // ─ BIMBINGAN SOSIAL ──────────────────────────────────────
            [
                'title'               => 'Bimbingan Sosial',
                'slug'                => 'bimbingan-sosial',
                'description'         => 'Layanan untuk membantu siswa mengatasi permasalahan dalam hubungan sosial seperti konflik dengan teman, bullying, atau kesulitan beradaptasi di lingkungan sekolah. Konselor menggunakan pendekatan mediasi dan pelatihan keterampilan sosial.',
                'short_description'   => 'Bantuan mengatasi konflik sosial, bullying, dan adaptasi di lingkungan sekolah.',
                'category'            => 'social',
                'schedule_days'       => 'Senin, Rabu, Jumat',
                'schedule_start'      => '10:00:00',
                'schedule_end'        => '13:00:00',
                'duration_minutes'    => 50,
                'mode'                => 'tatap_muka',
                'max_participants'    => 3,
                'requires_registration'=> false,
                'availability_status' => 'available',
                'sort_order'          => 5,
                'is_featured'         => false,
                'is_active'           => true,
            ],

            // ─ KONSULTASI ORANG TUA ──────────────────────────────────
            [
                'title'               => 'Konsultasi Orang Tua / Wali',
                'slug'                => 'konsultasi-orang-tua',
                'description'         => 'Pertemuan antara orang tua/wali murid dengan konselor untuk membahas perkembangan putra-putri secara menyeluruh. Meliputi perkembangan akademik, perilaku, sosial, dan rencana masa depan. Tersedia dalam format tatap muka maupun online melalui Zoom/Google Meet.',
                'short_description'   => 'Pertemuan wali murid dengan konselor untuk membahas perkembangan putra-putri.',
                'category'            => 'parent',
                'schedule_days'       => 'Selasa & Kamis',
                'schedule_start'      => '09:00:00',
                'schedule_end'        => '11:00:00',
                'duration_minutes'    => 45,
                'mode'                => 'hybrid',
                'platform'            => 'Zoom / Google Meet',
                'max_participants'    => 2,
                'requires_registration'=> true,
                'availability_status' => 'available',
                'sort_order'          => 6,
                'is_featured'         => false,
                'is_active'           => true,
            ],

            // ─ KOTAK PESAN ANONIM ────────────────────────────────────
            [
                'title'               => 'Kotak Pesan Anonim',
                'slug'                => 'kotak-pesan-anonim',
                'description'         => 'Layanan pengaduan dan curhatan anonim yang aman untuk siswa yang belum siap bertatap muka. Pesan akan diterima dan direspons oleh konselor dalam 1×24 jam. Identitas pengirim terjaga sepenuhnya. Tersedia untuk melaporkan bullying, kekerasan, atau permasalahan sensitif lainnya.',
                'short_description'   => 'Kirim pesan atau pengaduan secara anonim. Konselor merespons dalam 1×24 jam.',
                'category'            => 'personal',
                'schedule_days'       => 'Setiap Hari',
                'schedule_start'      => '00:00:00',
                'schedule_end'        => '23:59:00',
                'duration_minutes'    => null,
                'mode'                => 'online',
                'platform'            => 'Portal Web Sekolah',
                'max_participants'    => null,
                'requires_registration'=> false,
                'availability_status' => 'available',
                'sort_order'          => 7,
                'is_featured'         => true,
                'is_active'           => true,
            ],

            // ─ LAYANAN KRISIS ────────────────────────────────────────
            [
                'title'               => 'Layanan Krisis / Darurat',
                'slug'                => 'layanan-krisis',
                'description'         => 'Respons cepat untuk situasi darurat psikologis seperti krisis emosional, potensi self-harm, atau situasi berbahaya lainnya. Tim konselor terlatih siap menangani dengan pendekatan yang sensitif dan profesional. Hubungi langsung ruang BK atau nomor darurat sekolah.',
                'short_description'   => 'Respons darurat untuk krisis emosional dan psikologis. Konselor terlatih siap membantu.',
                'category'            => 'crisis',
                'schedule_days'       => 'Senin – Jumat (Jam Sekolah)',
                'schedule_start'      => '07:00:00',
                'schedule_end'        => '15:30:00',
                'duration_minutes'    => null,
                'mode'                => 'tatap_muka',
                'max_participants'    => 1,
                'requires_registration'=> false,
                'availability_status' => 'available',
                'sort_order'          => 8,
                'is_featured'         => false,
                'is_active'           => true,
            ],
        ];

        // ── Insert ke database ───────────────────────────────────────
        foreach ($services as $data) {
            CounselingService::updateOrCreate(
                [
                    'school_profile_id' => $school->id,
                    'slug'              => $data['slug'],
                ],
                array_merge($data, [
                    'school_profile_id'          => $school->id,
                    'last_updated_availability'  => now(),
                ])
            );
        }

        $this->command->info('✅ ' . count($services) . ' layanan BK berhasil di-seed untuk ' . $school->school_name);
    }
}
