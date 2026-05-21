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
    public function index(Request $request): View
    {
        $query = Material::query();

        // Filter by kategori kelas
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sort by date: newest (default) or oldest
        $sort = $request->input('sort', 'desc');
        $query->orderBy('created_at', $sort === 'asc' ? 'asc' : 'desc');

        $materials = $query->paginate(15)->withQueryString();

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
     * Mendukung multi-file, multi-game_link, dan opsional rpl_document.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // ── Metadata Materi ───────────────────────────────────────────
            'title'              => 'required|string|max:255',
            'description'        => 'required|string',
            'category'           => 'required|in:kelas-10,kelas-11,kelas-12',

            // ── File Materi (maks. 3, wajib ada minimal 1) ───────────────
            'files'              => 'required|array|max:3',
            'files.*'            => 'file|mimes:pdf,doc,docx,ppt,pptx|max:10240',

            // ── Tautan Game (opsional, maks. 3) ───────────────
            'game_links'         => 'nullable|array|max:3',
            'game_links.*'       => 'nullable|url',

            // ── Dokumen RPL (opsional) ────────────────────────────────────
            'rpl_document'       => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'title.required'         => 'Judul materi wajib diisi.',
            'description.required'   => 'Deskripsi materi wajib diisi.',
            'category.required'      => 'Kategori kelas wajib dipilih.',
            'category.in'            => 'Kategori tidak valid.',
            'files.required'         => 'Minimal satu file materi wajib diunggah.',
            'files.array'            => 'Format file tidak valid.',
            'files.max'              => 'Maksimal 3 file yang dapat diunggah.',
            'files.*.file'           => 'Setiap item harus berupa file.',
            'files.*.mimes'          => 'File harus berformat PDF, DOC, DOCX, PPT, atau PPTX.',
            'files.*.max'            => 'Ukuran setiap file maksimal 10MB.',
            'game_links.array'       => 'Format tautan tidak valid.',
            'game_links.max'         => 'Maksimal 3 tautan permainan.',
            'game_links.*.url'       => 'Setiap tautan harus berupa URL yang valid (diawali https://).',
            'rpl_document.mimes'     => 'Dokumen RPL harus berformat PDF, DOC, atau DOCX.',
            'rpl_document.max'       => 'Ukuran dokumen RPL maksimal 10MB.',
        ]);

        // ── 1. Upload semua file materi ke public/uploads ─────────────────
        $savedFiles = [];
        foreach ($request->file('files', []) as $file) {
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/materials'), $filename);
            $savedFiles[] = 'materials/' . $filename;
        }

        // ── 2. Upload dokumen RPL ke public/uploads/rpl_docs ─────────────
        $rplPath = null;
        if ($request->hasFile('rpl_document')) {
            $file = $request->file('rpl_document');
            $filename = 'RPL_' . time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/rpl_docs'), $filename);
            $rplPath = 'rpl_docs/' . $filename;
        }

        // ── 3. Simpan ke database ─────────────────────────────────────────
        Material::create([
            'title'        => $request->input('title'),
            'description'  => $request->input('description'),
            'category'     => $request->input('category'),
            'files'        => $savedFiles,
            'game_links'   => array_values(array_filter($request->input('game_links', []), fn($link) => !empty($link))),
            'rpl_document' => $rplPath,
            'is_active'    => $request->input('is_active', '0') === '1',
        ]);

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi "' . $request->input('title') . '" berhasil ditambahkan.');
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
     * Mendukung penambahan/penggantian file, penghapusan file tertentu,
     * update multi-game_link, dan opsional rpl_document.
     */
    public function update(Request $request, Material $material): RedirectResponse
    {
        $request->validate([
            // ── Metadata Materi ───────────────────────────────────────────
            'title'              => 'required|string|max:255',
            'description'        => 'required|string',
            'category'           => 'required|in:kelas-10,kelas-11,kelas-12',

            // ── File Materi Baru (opsional saat update) ───────────────────
            'files'              => 'nullable|array|max:3',
            'files.*'            => 'file|mimes:pdf,doc,docx,ppt,pptx|max:10240',

            // ── Index file lama yang ingin dihapus ────────────────────────
            'remove_files'       => 'nullable|array',
            'remove_files.*'     => 'integer',

            // ── Tautan Game (opsional) ───────────────────────────────────────────────
            'game_links'         => 'nullable|array|max:3',
            'game_links.*'       => 'nullable|url',

            // ── Dokumen RPL (opsional) ────────────────────────────────────
            'rpl_document'       => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'remove_rpl'         => 'nullable|boolean',
        ], [
            'title.required'         => 'Judul materi wajib diisi.',
            'description.required'   => 'Deskripsi materi wajib diisi.',
            'category.required'      => 'Kategori kelas wajib dipilih.',
            'category.in'            => 'Kategori tidak valid.',
            'files.max'              => 'Maksimal 3 file yang dapat diunggah.',
            'files.*.mimes'          => 'File harus berformat PDF, DOC, DOCX, PPT, atau PPTX.',
            'files.*.max'            => 'Ukuran setiap file maksimal 10MB.',
            'game_links.max'         => 'Maksimal 3 tautan permainan.',
            'game_links.*.url'       => 'Setiap tautan harus berupa URL yang valid (diawali https://).',
            'rpl_document.mimes'     => 'Dokumen RPL harus berformat PDF, DOC, atau DOCX.',
            'rpl_document.max'       => 'Ukuran dokumen RPL maksimal 10MB.',
        ]);

        // ── 1. Mulai dari daftar file yang sudah ada ──────────────────────
        $existingFiles = $material->files ?? [];

        // ── 2. Hapus file lama yang dipilih user untuk dihapus ────────────
        $indicesToRemove = $request->input('remove_files', []);
        foreach ($indicesToRemove as $index) {
            if (isset($existingFiles[$index])) {
                @unlink(public_path('uploads/' . $existingFiles[$index]));
                unset($existingFiles[$index]);
            }
        }
        // Re-index array setelah penghapusan
        $existingFiles = array_values($existingFiles);

        // ── 3. Upload dan tambahkan file baru ke public/uploads ───────────
        foreach ($request->file('files', []) as $file) {
            if (count($existingFiles) < 3) {
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->move(public_path('uploads/materials'), $filename);
                $existingFiles[] = 'materials/' . $filename;
            }
        }

        // ── 4. Handle dokumen RPL ─────────────────────────────────────────
        $rplPath = $material->rpl_document;

        // Hapus RPL lama jika user centang "hapus dokumen RPL"
        if ($request->boolean('remove_rpl') && $rplPath) {
            @unlink(public_path('uploads/' . $rplPath));
            $rplPath = null;
        }

        // Upload RPL baru jika ada
        if ($request->hasFile('rpl_document')) {
            if ($rplPath) {
                @unlink(public_path('uploads/' . $rplPath));
            }
            $file = $request->file('rpl_document');
            $filename = 'RPL_' . time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/rpl_docs'), $filename);
            $rplPath = 'rpl_docs/' . $filename;
        }

        // ── 5. Simpan perubahan ke database ───────────────────────────────
        $material->update([
            'title'        => $request->input('title'),
            'description'  => $request->input('description'),
            'category'     => $request->input('category'),
            'files'        => $existingFiles,
            'game_links'   => array_values(array_filter($request->input('game_links', []), fn($link) => !empty($link))),
            'rpl_document' => $rplPath,
            'is_active'    => $request->input('is_active', '0') === '1',
        ]);

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi "' . $request->input('title') . '" berhasil diperbarui.');
    }

    /**
     * Hapus materi beserta seluruh file-nya dari storage.
     */
    public function destroy(Material $material): RedirectResponse
    {
        $title = $material->title;

        // ── Hapus semua file materi dari public/uploads ──────────────────
        foreach ($material->files ?? [] as $filePath) {
            @unlink(public_path('uploads/' . $filePath));
        }

        // ── Hapus dokumen RPL dari public/uploads ─────────────────────────
        if ($material->rpl_document) {
            @unlink(public_path('uploads/' . $material->rpl_document));
        }

        $material->delete();

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Materi "' . $title . '" berhasil dihapus.');
    }

    /**
     * Download dokumen RPL — HANYA untuk admin yang sudah login.
     * File disimpan di private storage (storage/app/rpl_docs/),
     * tidak bisa diakses langsung melalui URL publik.
     */
    public function downloadRpl(Material $material)
    {
        if (!$material->rpl_document) {
            abort(404, 'Dokumen RPL tidak tersedia untuk materi ini.');
        }

        $path = public_path('uploads/' . $material->rpl_document);

        if (!file_exists($path)) {
            abort(404, 'File dokumen RPL tidak ditemukan di server.');
        }

        $fileName = 'RPL_' . str_replace(' ', '_', $material->title) . '.' . pathinfo($path, PATHINFO_EXTENSION);

        return response()->download($path, $fileName);
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
