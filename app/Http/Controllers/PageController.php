<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SchoolIdentity;

class PageController extends Controller
{
    /**
     * Halaman Visi, Misi & Moto.
     *
     * Mengambil semua data dari tabel school_identities,
     * mengelompokkannya per type, lalu mengirim ke view.
     */
    public function visiMisi(): View
    {
        // Satu query → kelompokkan di PHP (efisien, hanya 1 DB call)
        $all = SchoolIdentity::active()
                             ->ordered()
                             ->get();

        // Pengelompokan per type
        $visi = $all->firstWhere('type', SchoolIdentity::TYPE_VISI);
        $misi = $all->where('type', SchoolIdentity::TYPE_MISI)->values();
        $moto = $all->firstWhere('type', SchoolIdentity::TYPE_MOTO);

        return view('konseling.visimisi', compact('visi', 'misi', 'moto'));
    }
}
