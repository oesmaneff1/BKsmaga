<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClassicalServiceController extends Controller
{
    /**
     * Tampilkan halaman Layanan BK dengan data Bimbingan Klasikal
     * yang dikelompokkan per tingkat kelas.
     */
    public function index(): View
    {
        // Hitung total materi per kategori secara real-time dari tabel materials
        $jumlahMateriKelas10 = Material::active()->where('category', 'kelas-10')->count();
        $jumlahMateriKelas11 = Material::active()->where('category', 'kelas-11')->count();
        $jumlahMateriKelas12 = Material::active()->where('category', 'kelas-12')->count();

        return view('konseling.layanan', compact(
            'jumlahMateriKelas10',
            'jumlahMateriKelas11',
            'jumlahMateriKelas12'
        ));
    }

    /**
     * Tampilkan halaman detail materi per kategori kelas.
     *
     * @param  string  $category  Salah satu: 'kelas-10', 'kelas-11', 'kelas-12'
     */
    public function showCategory(string $category): View|RedirectResponse
    {
        // Konfigurasi tampilan per kategori — menggunakan inline CSS agar tidak
        // bergantung pada Tailwind JIT scanner yang tidak bisa mendeteksi class dinamis.
        $config = [
            'kelas-10' => [
                'label'         => 'Kelas 10',
                'subtitle'      => 'Fondasi & Adaptasi',
                'emoji'         => '🌱',
                // Inline CSS values — Deep Navy + Golden Yellow palette
                'gradient'      => '#0C084C',
                'btn_style'     => 'background:#FFC81E;color:#0C084C;font-weight:700;',
                'btn_hover'     => '#ffd84d',
                'badge_bg'      => 'rgba(255,200,30,.15)',
                'badge_text'    => '#0C084C',
                'badge_dot'     => '#FFC81E',
                'tag_bg'        => 'rgba(255,200,30,.12)',
                'tag_text'      => '#0C084C',
                'tag_border'    => 'rgba(255,200,30,.35)',
                'number_bg'     => 'rgba(255,200,30,.15)',
                'number_text'   => '#0C084C',
                'accent_line'   => '#FFC81E',
                'nav_active'    => '#0C084C',
            ],
            'kelas-11' => [
                'label'         => 'Kelas 11',
                'subtitle'      => 'Eksplorasi & Pengembangan',
                'emoji'         => '🚀',
                'gradient'      => '#0C084C',
                'btn_style'     => 'background:#FFC81E;color:#0C084C;font-weight:700;',
                'btn_hover'     => '#ffd84d',
                'badge_bg'      => 'rgba(255,200,30,.15)',
                'badge_text'    => '#0C084C',
                'badge_dot'     => '#FFC81E',
                'tag_bg'        => 'rgba(255,200,30,.12)',
                'tag_text'      => '#0C084C',
                'tag_border'    => 'rgba(255,200,30,.35)',
                'number_bg'     => 'rgba(255,200,30,.15)',
                'number_text'   => '#0C084C',
                'accent_line'   => '#FFC81E',
                'nav_active'    => '#0C084C',
            ],
            'kelas-12' => [
                'label'         => 'Kelas 12',
                'subtitle'      => 'Persiapan & Masa Depan',
                'emoji'         => '🎓',
                'gradient'      => '#0C084C',
                'btn_style'     => 'background:#FFC81E;color:#0C084C;font-weight:700;',
                'btn_hover'     => '#ffd84d',
                'badge_bg'      => 'rgba(255,200,30,.15)',
                'badge_text'    => '#0C084C',
                'badge_dot'     => '#FFC81E',
                'tag_bg'        => 'rgba(255,200,30,.12)',
                'tag_text'      => '#0C084C',
                'tag_border'    => 'rgba(255,200,30,.35)',
                'number_bg'     => 'rgba(255,200,30,.15)',
                'number_text'   => '#0C084C',
                'accent_line'   => '#FFC81E',
                'nav_active'    => '#0C084C',
            ],
        ];

        // Redirect ke /layanan jika kategori tidak dikenal
        if (!array_key_exists($category, $config)) {
            return redirect()->route('layanan');
        }

        // Ambil materi aktif berdasarkan kategori, urutkan berdasarkan judul
        $materials = Material::active()
            ->forCategory($category)
            ->orderBy('title')
            ->get();

        return view('konseling.layanan-detail', [
            'category'  => $category,
            'config'    => $config[$category],
            'materials' => $materials,
        ]);
    }
}
