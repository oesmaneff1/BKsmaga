<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class AdminMaterialController extends Controller
{
    /**
     * Daftar semua materi (index).
     */
    public function index(): View
    {
        $materials = Material::orderBy('category')
            ->orderBy('title')
            ->paginate(15);

        return view('admin.materials.index', compact('materials'));
    }

    /**
     * Form tambah materi baru.
     */
    public function create(): View
    {
        return view('admin.materials.create');
    }

    /**
     * Simpan materi baru ke database.
     * Upload file dokumen ke storage Laravel jika ada.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|in:kelas-10,kelas-11,kelas-12',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240', // maks 10MB
            'game_link'   => 'nullable|url|max:500',
        ], [
            'title.required'       => 'Judul materi wajib diisi.',
            'description.required' => 'Deskripsi materi wajib diisi.',
            'category.required'    => 'Kategori kelas wajib dipilih.',
            'category.in'          => 'Kategori tidak valid.',
            'file.mimes'           => 'File harus berformat PDF, DOC, DOCX, PPT, atau PPTX.',
            'file.max'             => 'Ukuran file maksimal 10MB.',
            'game_link.url'        => 'Format link permainan tidak valid (harus diawali https://).',
        ]);

        // Upload file (Paksa ke public/uploads)
        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materials'), $filename);
            $filePath = 'materials/' . $filename;
        }

        Material::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'category'    => $validated['category'],
            'file_path'   => $filePath,
            'game_link'   => $validated['game_link'] ?? null,
            'is_active'   => $request->input('is_active', '0') === '1',
        ]);

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi "' . $validated['title'] . '" berhasil ditambahkan.');
    }

    /**
     * Form edit materi.
     */
    public function edit(Material $material): View
    {
        return view('admin.materials.edit', compact('material'));
    }

    /**
     * Update materi di database.
     */
    public function update(Request $request, Material $material): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category'    => 'required|in:kelas-10,kelas-11,kelas-12',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'game_link'   => 'nullable|url|max:500',
        ]);

        // Jika ada file baru (Paksa ke public/uploads)
        $filePath = $material->file_path;
        if ($request->hasFile('file')) {
            if ($filePath) {
                @unlink(public_path('uploads/' . $filePath));
            }
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materials'), $filename);
            $filePath = 'materials/' . $filename;
        }

        // Hapus file jika user centang "hapus file"
        if ($request->boolean('remove_file') && $filePath) {
            @unlink(public_path('uploads/' . $filePath));
            $filePath = null;
        }

        $material->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'category'    => $validated['category'],
            'file_path'   => $filePath,
            'game_link'   => $validated['game_link'] ?? null,
            'is_active'   => $request->input('is_active', '0') === '1',
        ]);

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi "' . $validated['title'] . '" berhasil diperbarui.');
    }

    /**
     * Hapus materi beserta file-nya dari storage.
     */
    public function destroy(Material $material): RedirectResponse
    {
        $title = $material->title;

        // Hapus file dokumen dari public jika ada
        if ($material->file_path) {
            @unlink(public_path('uploads/' . $material->file_path));
        }

        $material->delete();

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi "' . $title . '" berhasil dihapus.');
    }

    /**
     * Toggle status aktif/nonaktif materi.
     */
    public function toggle(Material $material): RedirectResponse
    {
        $material->update(['is_active' => !$material->is_active]);

        $status = $material->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', 'Materi "' . $material->title . '" berhasil ' . $status . '.');
    }
}
