@extends('admin.layouts.admin')

@section('title', isset($material) ? 'Edit Materi' : 'Tambah Materi')
@section('page-title', isset($material) ? 'Edit Materi' : 'Tambah Materi Baru')
@section('breadcrumb')
    <a href="{{ route('admin.materials.index') }}">Materi</a>
    <span>/</span>
    {{ isset($material) ? 'Edit' : 'Tambah' }}
@endsection

@section('topbar-actions')
<a href="{{ route('admin.materials.index') }}" class="btn btn-secondary">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
    </svg>
    Kembali
</a>
@endsection

@section('content')

@php
$isEdit  = isset($material);
$action  = $isEdit
    ? route('admin.materials.update', $material)
    : route('admin.materials.store');
@endphp

<form id="main-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="card">
        <div class="card-header">
            <h2>{{ $isEdit ? '✏️ Edit Materi' : '📝 Form Materi Baru' }}</h2>
        </div>
        <div class="card-body" style="padding:2.5rem 3rem;">

            {{-- Validasi Error Global --}}
            @if($errors->any())
            <div class="alert alert-error" style="margin-bottom:1.5rem">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
                    <ul style="margin-top:.4rem;padding-left:1rem;font-size:.82rem">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif


            {{-- ── Judul ── --}}
            <div class="form-group">
                <label class="form-label" for="title">
                    Judul Materi <span class="required">*</span>
                </label>
                <input type="text"
                       id="title"
                       name="title"
                       class="form-control {{ $errors->has('title') ? 'error' : '' }}"
                       value="{{ old('title', $material->title ?? '') }}"
                       placeholder="Contoh: Adaptasi Lingkungan Sekolah Baru"
                       autocomplete="off"
                       required>
                @error('title')
                <div class="form-error">⚠ {{ $message }}</div>
                @enderror
            </div>

            {{-- ── Kategori Kelas ── --}}
            <div class="form-group">
                <label class="form-label" for="category">
                    Kategori Kelas <span class="required">*</span>
                </label>
                <div style="position:relative">
                    <select id="category"
                            name="category"
                            class="form-control {{ $errors->has('category') ? 'error' : '' }}"
                            required>
                        <option value="" disabled {{ old('category', $material->category ?? '') === '' ? 'selected' : '' }}>
                            — Pilih Jenjang Kelas —
                        </option>
                        <option value="kelas-10" {{ old('category', $material->category ?? '') === 'kelas-10' ? 'selected' : '' }}>
                            🌱 Kelas 10 – Fondasi & Adaptasi
                        </option>
                        <option value="kelas-11" {{ old('category', $material->category ?? '') === 'kelas-11' ? 'selected' : '' }}>
                            🚀 Kelas 11 – Eksplorasi & Pengembangan
                        </option>
                        <option value="kelas-12" {{ old('category', $material->category ?? '') === 'kelas-12' ? 'selected' : '' }}>
                            🎓 Kelas 12 – Persiapan & Masa Depan
                        </option>
                    </select>
                    <svg style="position:absolute;right:.875rem;top:50%;transform:translateY(-50%);pointer-events:none;color:#9ca3af"
                         width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                @error('category')
                <div class="form-error">⚠ {{ $message }}</div>
                @enderror
            </div>

            {{-- ── Deskripsi ── --}}
            <div class="form-group">
                <label class="form-label" for="description">
                    Deskripsi <span class="required">*</span>
                </label>
                <textarea id="description"
                          name="description"
                          class="form-control {{ $errors->has('description') ? 'error' : '' }}"
                          rows="8"
                          placeholder="Tuliskan ringkasan isi materi dan manfaatnya bagi siswa..."
                          required>{{ old('description', $material->description ?? '') }}</textarea>
                @error('description')
                <div class="form-error">⚠ {{ $message }}</div>
                @enderror
            </div>

            {{-- ── Upload File (kolom kanan) ── --}}
            <div class="form-group">
                <label class="form-label" for="file">
                    Upload Dokumen Materi
                    <span style="font-weight:400;color:#9ca3af">(opsional)</span>
                </label>

                {{-- File yang sudah ada (mode edit) --}}
                @if($isEdit && $material->hasFile())
                <div style="display:flex;align-items:center;gap:.75rem;padding:.875rem 1.125rem;background:rgba(12,8,76,.04);border:1px solid rgba(12,8,76,.12);border-radius:.75rem;margin-bottom:.875rem">
                    <div style="width:36px;height:36px;border-radius:.5rem;background:rgba(12,8,76,.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="18" height="18" fill="none" stroke="#0C084C" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div style="flex:1;min-width:0">
                        <div style="font-size:.78rem;font-weight:700;color:#0C084C;text-transform:uppercase;letter-spacing:.06em;margin-bottom:.15rem">File Terpasang</div>
                        <div style="font-size:.82rem;color:#6b7280;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ basename($material->file_path) }}</div>
                    </div>
                    <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank"
                       style="display:inline-flex;align-items:center;gap:.35rem;font-size:.78rem;color:#0C084C;font-weight:700;text-decoration:none;flex-shrink:0;padding:.4rem .875rem;border:1px solid rgba(12,8,76,.2);border-radius:.5rem;transition:background .15s;"
                       onmouseover="this.style.background='rgba(12,8,76,.06)'" onmouseout="this.style.background='transparent'">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Lihat
                    </a>
                </div>
                <label style="display:inline-flex;align-items:center;gap:.5rem;font-size:.82rem;cursor:pointer;margin-bottom:.875rem;padding:.4rem .75rem;border:1px solid #fee2e2;border-radius:.5rem;background:#fef2f2;">
                    <input type="checkbox" name="remove_file" value="1" {{ old('remove_file') ? 'checked' : '' }}
                           style="width:14px;height:14px;accent-color:#dc2626">
                    <span style="color:#dc2626;font-weight:600">Ganti / Hapus file ini</span>
                </label>
                @endif

                {{-- ── Area Upload Premium ── --}}
                <label for="file" id="dropzone"
                       style="display:block;border:2px dashed #d1d5db;border-radius:1rem;padding:2rem 1.5rem;
                              text-align:center;cursor:pointer;transition:all .25s;background:#fafafa;position:relative;"
                       onmouseover="this.style.borderColor='#0C084C';this.style.background='#EEF7FF'"
                       onmouseout="if(!window._filePicked){this.style.borderColor='#d1d5db';this.style.background='#fafafa'}">
                    <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx"
                           style="display:none" onchange="updateFileName(this)">

                    {{-- Ikon Upload SVG --}}
                    <div id="upload-icon-wrap" style="margin:0 auto 1rem;width:64px;height:64px;border-radius:1rem;background:rgba(12,8,76,.06);display:flex;align-items:center;justify-content:center;transition:background .25s;">
                        <svg width="30" height="30" fill="none" stroke="#0C084C" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                    </div>

                    {{-- Teks Panduan --}}
                    <p style="margin:0;font-size:.9rem;color:#374151;">
                        <strong id="file-name-display" style="color:#0C084C;">Klik untuk pilih file</strong>
                        <span style="color:#9ca3af;"> atau seret ke sini</span>
                    </p>
                    <p style="margin:.5rem 0 0;font-size:.75rem;color:#9ca3af;line-height:1.5;">
                        PDF, DOC, DOCX, PPT, PPTX &bull; Maks. <strong>10MB</strong>
                    </p>
                </label>

                @error('file')
                <div class="form-error">⚠ {{ $message }}</div>
                @enderror

                <div class="form-hint" style="display:flex;align-items:center;gap:.4rem;margin-top:.6rem;">
                    <svg width="13" height="13" fill="none" stroke="#9ca3af" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    File tersimpan di <code style="background:#EEF7FF;color:#0C084C;padding:.1rem .4rem;border-radius:.3rem;font-size:.78rem;">storage/app/public/materials/</code> dan dapat diakses publik.
                </div>
            </div>{{-- /upload --}}

            {{-- ── Link Game (kolom kiri baris 3) ── --}}
            <div class="form-group">
                <label class="form-label" for="game_link">
                    Link Permainan / Media Interaktif
                    <span style="font-weight:400;color:#9ca3af">(opsional)</span>
                </label>
                <div style="position:relative">
                    <span style="position:absolute;left:.875rem;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:.875rem">🎮</span>
                    <input type="url"
                           id="game_link"
                           name="game_link"
                           class="form-control {{ $errors->has('game_link') ? 'error' : '' }}"
                           style="padding-left:2.25rem"
                           value="{{ old('game_link', $material->game_link ?? '') }}"
                           placeholder="https://wordwall.net/play/...">
                </div>
                @error('game_link')
                <div class="form-error">⚠ {{ $message }}</div>
                @enderror
                <div class="form-hint">🔗 Masukkan URL lengkap (diawali https://) dari Wordwall, Kahoot, Quizizz, atau platform lainnya.</div>
            </div>

            <hr style="border:none;border-top:1px solid #f3f4f6;margin:1.5rem 0">

            {{-- ── Status Aktif ── --}}
            <div class="form-group" style="margin-bottom:0">
                <label class="form-label">Status Tampil</label>
                <div class="toggle-wrap">
                    <label class="toggle">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $material->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <span style="font-size:.875rem;color:#374151;font-weight:500">Tampilkan di halaman publik</span>
                </div>
                <div class="form-hint">Jika dinonaktifkan, materi tidak akan muncul di halaman Layanan.</div>
            </div>{{-- /Status --}}


            <hr style="border:none;border-top:1px solid #f3f4f6;margin:1.5rem 0">

            {{-- ── Submit Buttons ── --}}
            <div style="display:flex;gap:.75rem;align-items:center;">
                <button type="submit" form="main-form" class="btn btn-primary" style="min-width:160px;padding:.65rem 1.5rem;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $isEdit ? 'Simpan Perubahan' : 'Tambahkan Materi' }}
                </button>
                <a href="{{ route('admin.materials.index') }}" class="btn btn-secondary">Batal</a>

                @if($isEdit)
                <button type="submit" form="delete-form" class="btn btn-danger" style="margin-left:auto;"
                        onclick="return confirm('Yakin hapus materi ini? File terkait juga akan dihapus permanen.')">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Materi
                </button>
                @endif
            </div>{{-- /submit --}}

        </div>{{-- /card-body --}}
    </div>{{-- /card --}}
</form>{{-- /main-form --}}

{{-- Form Delete dipisah di luar form utama (nested form tidak valid HTML) --}}
@if($isEdit)
<form id="delete-form" method="POST" action="{{ route('admin.materials.destroy', $material) }}">
    @csrf @method('DELETE')
</form>
@endif
<script>
function updateFileName(input) {
    const display = document.getElementById('file-name-display');
    const zone    = document.getElementById('dropzone');
    const iconWrap = document.getElementById('upload-icon-wrap');

    if (input.files && input.files[0]) {
        const name = input.files[0].name;
        const size = (input.files[0].size / 1024 / 1024).toFixed(2);
        const ext  = name.split('.').pop().toUpperCase();

        display.textContent = name + '  (' + size + ' MB)';
        display.style.color = '#0C084C';

        // Ubah tampilan dropzone saat file terpilih
        zone.style.borderColor  = '#0C084C';
        zone.style.borderStyle  = 'solid';
        zone.style.background   = '#EEF7FF';
        iconWrap.style.background = 'rgba(255,200,30,.2)';
        iconWrap.querySelector('svg').setAttribute('stroke', '#0C084C');

        window._filePicked = true;
    } else {
        display.textContent    = 'Klik untuk pilih file';
        display.style.color    = '#0C084C';
        zone.style.borderColor = '#d1d5db';
        zone.style.borderStyle = 'dashed';
        zone.style.background  = '#fafafa';
        iconWrap.style.background = 'rgba(12,8,76,.06)';
        window._filePicked = false;
    }
}

// Drag and Drop visual feedback
const dz = document.getElementById('dropzone');
if (dz) {
    dz.addEventListener('dragover',  e => { e.preventDefault(); dz.style.borderColor='#0C084C'; dz.style.background='#EEF7FF'; });
    dz.addEventListener('dragleave', e => { if(!window._filePicked){dz.style.borderColor='#d1d5db'; dz.style.background='#fafafa';} });
    dz.addEventListener('drop',      e => { e.preventDefault(); if(e.dataTransfer.files.length){ document.getElementById('file').files=e.dataTransfer.files; updateFileName(document.getElementById('file')); } });
}
</script>
@endsection
