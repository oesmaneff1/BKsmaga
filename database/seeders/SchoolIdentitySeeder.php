<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolIdentity;

class SchoolIdentitySeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama agar seeder bisa dijalankan ulang (idempoten)
        SchoolIdentity::truncate();

        // ── VISI ─────────────────────────────────────────────────────────
        SchoolIdentity::create([
            'type'      => 'visi',
            'content'   => 'Membentuk Insan yang Beriman, Bertaqwa, Berakhlak Mulia, Berdaya Saing Global, dan Peduli Lingkungan',
            'order'     => 1,
            'is_active' => true,
        ]);

        // ── MISI (tiap poin = 1 baris) ───────────────────────────────────
        $misiItems = [
            'Meningkatkan kegiatan kerokhanian secara berkala, efektif dan efisien sehingga dapat mengembangkan kecerdasan spiritual serta kecerdasan emosional.',
            'Meningkatkan prestasi akademik melalui pengembangan standar ketuntasan pembelajaran.',
            'Memvariasikan model pembelajaran untuk mendorong peserta didik aktif, kreatif, efektif dan menyenangkan.',
            'Menyelenggarakan pembelajaran yang mengacu pada inovasi dan perkembangan global berbasis Teknologi Informatika dan Komunikasi (TIK/ICT).',
            'Menumbuhkembangkan jiwa kerja sama dengan semua komponen sekolah dalam mengelola sekolah secara mandiri, inovatif dan terbuka.',
            'Mengembangkan pembelajaran life skill sesuai potensi peserta didik, sekolah, dan daerah.',
            'Memantapkan kredibilitas sekolah melalui prestasi akademis dan non akademis secara berkelanjutan.',
            'Meningkatkan jalinan kerja sama untuk pengembangan institusi dengan unsur-unsur terkait.',
            'Meningkatkan kepekaan dan kepedulian terhadap lingkungan alam sekitar dalam kehidupan sosial masyarakat.',
        ];

        foreach ($misiItems as $idx => $poin) {
            SchoolIdentity::create([
                'type'      => 'misi',
                'content'   => $poin,
                'order'     => $idx + 1,
                'is_active' => true,
            ]);
        }

        // ── MOTO ─────────────────────────────────────────────────────────
        // Format: "moto utama|terjemahan|deskripsi" dipisah delimiter
        // sehingga view bisa memecahnya tanpa kolom tambahan.
        SchoolIdentity::create([
            'type'      => 'moto',
            'content'   => json_encode([
                'motto'       => 'Nothing but achievement.',
                'translation' => 'Tidak ada yang lain selain prestasi',
                'description' => 'Moto ini mencerminkan harapan dan komitmen sekolah bahwa segala sesuatu di SMAN 3 Kediri diarahkan untuk mencapai prestasi yang tinggi, baik dalam bidang akademik maupun non-akademik.',
            ], JSON_UNESCAPED_UNICODE),
            'order'     => 1,
            'is_active' => true,
        ]);

        $this->command->info('✅  SchoolIdentity seeded: 1 visi, ' . count($misiItems) . ' misi, 1 moto.');
    }
}
