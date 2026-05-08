<?php

namespace App\Http\Controllers;

use App\Models\Counselor;

class CounselorController extends Controller
{
    /**
     * Tampilkan halaman publik Tim BK.
     * Data dipisah menjadi koordinator dan anggota tim.
     */
    public function index()
    {
        // Ambil satu koordinator (ditampilkan secara khusus/featured)
        $koordinator = Counselor::active()
            ->where('specialization', 'Koordinator BK')
            ->first();

        // Ambil semua guru BK selain koordinator
        $gurus = Counselor::active()
            ->where('specialization', '!=', 'Koordinator BK')
            ->get();

        return view('profil', compact('koordinator', 'gurus'));
    }
}
