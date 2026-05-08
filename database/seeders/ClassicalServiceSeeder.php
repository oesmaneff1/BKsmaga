<?php

namespace Database\Seeders;

use App\Models\ClassicalService;
use Illuminate\Database\Seeder;

class ClassicalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // ─── Kelas 10 ────────────────────────────────────────────────────
            [
                'class_level' => 'Kelas 10',
                'title'       => 'Mengenal Diri Sendiri: Potensi dan Kekuatan',
                'description' => 'Materi ini membantu siswa baru mengenali kekuatan, kelemahan, minat, dan bakat yang dimiliki. Melalui refleksi diri dan aktivitas interaktif, siswa diajak membangun kesadaran diri yang positif sebagai fondasi perkembangan pribadi.',
                'game_link'   => 'https://quizlet.com/id/781234567/mengenal-diri-sendiri-flash-cards/',
                'game_title'  => 'Kuis Kartu: Siapa Aku?',
                'is_active'   => true,
            ],
            [
                'class_level' => 'Kelas 10',
                'title'       => 'Adaptasi Lingkungan Sekolah Baru',
                'description' => 'Transisi dari SMP ke SMA membawa tantangan tersendiri. Materi ini membekali siswa dengan strategi adaptasi sosial, cara membangun pertemanan sehat, dan mengelola ekspektasi di lingkungan baru.',
                'game_link'   => 'https://wordwall.net/id/resource/adaptasi-siswa-baru',
                'game_title'  => 'Permainan Skenario Adaptasi',
                'is_active'   => true,
            ],
            [
                'class_level' => 'Kelas 10',
                'title'       => 'Manajemen Waktu dan Kebiasaan Belajar Efektif',
                'description' => 'Siswa belajar teknik manajemen waktu seperti metode Pomodoro dan time-blocking, serta cara membangun rutinitas belajar yang konsisten untuk menghadapi padatnya jadwal SMA.',
                'game_link'   => 'https://kahoot.it/challenge/manajemen-waktu-kelas10',
                'game_title'  => 'Kahoot: Tantangan Waktu!',
                'is_active'   => true,
            ],

            // ─── Kelas 11 ────────────────────────────────────────────────────
            [
                'class_level' => 'Kelas 11',
                'title'       => 'Eksplorasi Minat dan Karir Masa Depan',
                'description' => 'Materi ini memandu siswa kelas 11 untuk mengeksplorasi berbagai bidang karir sesuai minat dan bakat. Siswa dikenalkan dengan alat tes minat karir serta gambaran prospek profesi di era digital.',
                'game_link'   => 'https://quizlet.com/id/801234567/eksplorasi-karir-indonesia-flash-cards/',
                'game_title'  => 'Kuis Peta Karir Indonesia',
                'is_active'   => true,
            ],
            [
                'class_level' => 'Kelas 11',
                'title'       => 'Kesehatan Mental Remaja: Mengelola Stres dan Emosi',
                'description' => 'Membahas pentingnya kesehatan mental, mengenali tanda-tanda stres akademik, dan berbagai teknik regulasi emosi yang dapat dipraktikkan sehari-hari oleh siswa. Termasuk teknik pernapasan dan mindfulness dasar.',
                'game_link'   => 'https://wordwall.net/id/resource/kesehatan-mental-remaja',
                'game_title'  => 'Permainan: Thermometer Emosi',
                'is_active'   => true,
            ],
            [
                'class_level' => 'Kelas 11',
                'title'       => 'Keterampilan Komunikasi dan Asertivitas',
                'description' => 'Siswa belajar membedakan komunikasi pasif, agresif, dan asertif. Materi ini dilengkapi dengan role-play skenario nyata untuk melatih kemampuan menyampaikan pendapat secara tepat dan menghargai orang lain.',
                'game_link'   => 'https://kahoot.it/challenge/komunikasi-asertif-kelas11',
                'game_title'  => 'Kahoot: Pilih Gayamu!',
                'is_active'   => true,
            ],

            // ─── Kelas 12 ────────────────────────────────────────────────────
            [
                'class_level' => 'Kelas 12',
                'title'       => 'Strategi Sukses SNBT dan SNBP',
                'description' => 'Panduan lengkap mengenai jalur masuk perguruan tinggi negeri: perbedaan SNBT dan SNBP, cara memilih program studi yang tepat, teknik belajar untuk TPS dan TKA, serta cara membaca statistik daya tampung PTN.',
                'game_link'   => 'https://quizlet.com/id/821234567/simulasi-snbt-tps-flash-cards/',
                'game_title'  => 'Simulasi Kuis TPS SNBT',
                'is_active'   => true,
            ],
            [
                'class_level' => 'Kelas 12',
                'title'       => 'Perencanaan Karir dan Studi Lanjut',
                'description' => 'Membantu siswa memetakan pilihan setelah lulus: kuliah, vokasi, kerja, atau wirausaha. Dilengkapi dengan panduan mencari beasiswa, membaca prospek kerja jurusan, dan membuat rencana karir 5 tahun ke depan.',
                'game_link'   => 'https://wordwall.net/id/resource/perencanaan-karir-kelas12',
                'game_title'  => 'Permainan: Peta Jalan Hidupku',
                'is_active'   => true,
            ],
            [
                'class_level' => 'Kelas 12',
                'title'       => 'Kesiapan Mental Menghadapi Ujian dan Perpisahan',
                'description' => 'Materi ini mempersiapkan siswa secara mental untuk menghadapi tekanan ujian akhir dan fase perpisahan dengan teman serta sekolah. Membahas cara mengelola kecemasan ujian, bersyukur, dan membangun optimisme untuk babak kehidupan selanjutnya.',
                'game_link'   => 'https://kahoot.it/challenge/kesiapan-mental-kelas12',
                'game_title'  => 'Kahoot: Siap Ujian, Siap Masa Depan!',
                'is_active'   => true,
            ],
        ];

        foreach ($data as $item) {
            $item['category'] = match ($item['class_level']) {
                'Kelas 10' => 'kelas-10',
                'Kelas 11' => 'kelas-11',
                'Kelas 12' => 'kelas-12',
                default => null,
            };

            ClassicalService::updateOrCreate(
                ['class_level' => $item['class_level'], 'title' => $item['title']],
                $item
            );
        }

        $this->command->info('✅ ClassicalServiceSeeder: ' . count($data) . ' materi bimbingan klasikal berhasil ditambahkan.');
    }
}
