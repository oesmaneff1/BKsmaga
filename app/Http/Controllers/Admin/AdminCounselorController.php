<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCounselorController extends Controller
{
    /**
     * Tampilkan daftar semua konselor di panel admin.
     */
    public function index()
    {
        $counselors = Counselor::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.counselors.index', compact('counselors'));
    }

    /**
     * Tampilkan form tambah konselor baru.
     */
    public function create()
    {
        $jabatanOptions = Counselor::$jabatanOptions;

        return view('admin.counselors.create', compact('jabatanOptions'));
    }

    /**
     * Simpan konselor baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'nip'            => 'required|string|max:50',
            'specialization' => 'required|in:Koordinator BK,Guru BK',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'name.required'           => 'Nama lengkap wajib diisi.',
            'nip.required'            => 'NIP wajib diisi.',
            'specialization.required' => 'Jabatan wajib dipilih.',
            'specialization.in'       => 'Pilihan jabatan tidak valid.',
            'photo.image'             => 'File harus berupa gambar.',
            'photo.max'               => 'Ukuran foto maksimal 2MB.',
        ]);

        // ── Upload foto (Paksa ke public/uploads) ───────────────────
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/counselors'), $filename);
            $validated['photo'] = 'counselors/' . $filename;
        }

        $validated['is_active'] = $request->input('is_active', '0') === '1';

        Counselor::create($validated);

        return redirect()->route('admin.counselors.index')
            ->with('success', 'Konselor berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit konselor.
     */
    public function edit(Counselor $counselor)
    {
        $jabatanOptions = Counselor::$jabatanOptions;

        return view('admin.counselors.edit', compact('counselor', 'jabatanOptions'));
    }

    /**
     * Perbarui data konselor di database.
     */
    public function update(Request $request, Counselor $counselor)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'nip'            => 'required|string|max:50',
            'specialization' => 'required|in:Koordinator BK,Guru BK',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'name.required'           => 'Nama lengkap wajib diisi.',
            'nip.required'            => 'NIP wajib diisi.',
            'specialization.required' => 'Jabatan wajib dipilih.',
            'specialization.in'       => 'Pilihan jabatan tidak valid.',
            'photo.image'             => 'File harus berupa gambar.',
            'photo.max'               => 'Ukuran foto maksimal 2MB.',
        ]);

        // ── Upload foto baru (Paksa ke public/uploads) ──────────────
        if ($request->hasFile('photo')) {
            // Hapus yang lama jika ada
            if ($counselor->photo) {
                @unlink(public_path('uploads/' . $counselor->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/counselors'), $filename);
            $validated['photo'] = 'counselors/' . $filename;
        } else {
            unset($validated['photo']);
        }

        $validated['is_active'] = $request->input('is_active', '0') === '1';

        $counselor->update($validated);

        return redirect()->route('admin.counselors.index')
            ->with('success', 'Data konselor berhasil diperbarui!');
    }

    /**
     * Hapus konselor beserta foto profilnya.
     */
    public function destroy(Counselor $counselor)
    {
        if ($counselor->photo) {
            Storage::disk('public')->delete($counselor->photo);
        }

        $counselor->delete();

        return redirect()->route('admin.counselors.index')
            ->with('success', 'Konselor berhasil dihapus.');
    }

    /**
     * Toggle status aktif/nonaktif konselor.
     */
    public function toggle(Counselor $counselor)
    {
        $counselor->update(['is_active' => ! $counselor->is_active]);

        $status = $counselor->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Konselor berhasil {$status}.");
    }
}
