<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminMaterialController;
use App\Http\Controllers\Admin\AdminCounselorController;
use App\Http\Controllers\ClassicalServiceController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes – BK SMAN 3 Kediri
|--------------------------------------------------------------------------
| Struktur:
|   1. Public  – Halaman yang dapat diakses semua pengunjung
|   2. Auth    – Autentikasi admin (login/logout)
|   3. Admin   – Panel manajemen (harus login)
*/
// TEMPORARY FIX FOR INFINITYFREE IMAGES
Route::get('/fix-storage', function () {
    $results = [];

    // 0. Clear Caches
    try {
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        $results[] = "✅ Cache berhasil dibersihkan.";
    } catch (\Exception $e) {}

    // 1. Move files to public/uploads
    $source = storage_path('app/public');
    $dest = public_path('uploads');

    if (file_exists($source)) {
        if (!file_exists($dest)) mkdir($dest, 0755, true);

        // Fungsi rekursif untuk copy/move
        $moveFiles = function($src, $dst) use (&$moveFiles, &$results) {
            $dir = opendir($src);
            if (!file_exists($dst)) mkdir($dst, 0755, true);
            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    if ( is_dir($src . '/' . $file) ) {
                        $moveFiles($src . '/' . $file, $dst . '/' . $file);
                    } else {
                        @rename($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        };

        $moveFiles($source, $dest);
        $results[] = "✅ Semua file dari storage telah dipindahkan ke folder public/uploads.";
    }

    return implode("<br>", $results) . "<br><br><b>Selesai! Silakan cek website Anda sekarang.</b>";
});

// ============================================================
// 1. PUBLIC ROUTES
// ============================================================

// ── Beranda ──────────────────────────────────────────────────
Route::get('/', function () {
    $jumlahMateriKelas10 = \App\Models\Material::active()->where('category', 'kelas-10')->count();
    $jumlahMateriKelas11 = \App\Models\Material::active()->where('category', 'kelas-11')->count();
    $jumlahMateriKelas12 = \App\Models\Material::active()->where('category', 'kelas-12')->count();

    return view('konseling.index', compact(
        'jumlahMateriKelas10',
        'jumlahMateriKelas11',
        'jumlahMateriKelas12'
    ));
})->name('beranda');

// ── Layanan Bimbingan Klasikal ────────────────────────────────
Route::prefix('layanan')->name('layanan')->group(function () {
    Route::get('/', [ClassicalServiceController::class, 'index']);
    Route::get('/{category}', [ClassicalServiceController::class, 'showCategory'])
        ->name('.category')
        ->where('category', 'kelas-10|kelas-11|kelas-12');
});

// ── Halaman Statis ────────────────────────────────────────────
Route::get('/tentang-bk', [PageController::class, 'visiMisi'])->name('visi-misi');

// ── Tim BK (data dari database) ───────────────────────────────
Route::get('/tim-bk', [CounselorController::class, 'index'])->name('tim-bk');



// ============================================================
// 2. AUTH ROUTES (Hanya untuk tamu / guest)
// ============================================================
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.post')
        ->middleware('throttle:6,1'); // Maksimal 6 percobaan per menit
});

Route::post('/logout', [AdminAuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ============================================================
// 3. ADMIN ROUTES (Harus login)
// ============================================================
Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard (redirect ke Materi)
        Route::get('/', fn () => redirect()->route('admin.materials.index'))
            ->name('dashboard');

        // ── Materi Bimbingan Klasikal ─────────────────────────
        Route::resource('materials', AdminMaterialController::class)
            ->except(['show']);

        Route::patch('materials/{material}/toggle', [AdminMaterialController::class, 'toggle'])
            ->name('materials.toggle');

        // ── Tim BK (Counselors) CRUD ──────────────────────────
        Route::resource('counselors', AdminCounselorController::class)
            ->except(['show']);

        // Toggle aktif/nonaktif konselor
        Route::patch('counselors/{counselor}/toggle', [AdminCounselorController::class, 'toggle'])
            ->name('counselors.toggle');
    });
