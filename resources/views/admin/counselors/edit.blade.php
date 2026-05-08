@extends('admin.layouts.admin')

@section('title', 'Edit Konselor')
@section('page-title', 'Edit Data Konselor')
@section('breadcrumb', 'Tim BK / Edit')

@section('topbar-actions')
<a href="{{ route('admin.counselors.index') }}" class="btn btn-secondary">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
    </svg>
    Kembali
</a>
@endsection

@section('content')

@if($errors->any())
<div class="alert alert-error" style="margin-bottom:1.5rem;">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div>
        <div style="font-weight:600;margin-bottom:.25rem;">Mohon perbaiki kesalahan berikut:</div>
        <ul style="padding-left:1.25rem;font-size:.85rem;">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header">
        <div style="display:flex;align-items:center;gap:1rem;">
            {{-- Mini card preview di header --}}
            <div style="width:36px;height:48px;border-radius:.5rem;overflow:hidden;
                        border:2px solid #0C084C;flex-shrink:0;background:#EEF7FF;">
                @if($counselor->photo)
                    <img src="{{ Storage::url($counselor->photo) }}"
                         alt="{{ $counselor->name }}"
                         class="w-full h-full object-cover object-top">
                @else
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">👤</div>
                @endif
            </div>
            <div>
                <h2 style="margin:0;">Edit: {{ $counselor->name }}</h2>
                <span style="font-size:.78rem;color:#6b7280;">{{ $counselor->specialization }}</span>
            </div>
        </div>
    </div>

    <form id="main-form"
          method="POST"
          action="{{ route('admin.counselors.update', $counselor) }}"
          enctype="multipart/form-data"
          style="padding:2.5rem 3rem;">
        @csrf
        @method('PUT')

        {{-- ── Nama + Jabatan ────────────────────────────────────── --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.25rem;">

            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="name">
                    Nama Lengkap <span class="required">*</span>
                </label>
                <input type="text" id="name" name="name"
                       class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                       value="{{ old('name', $counselor->name) }}"
                       placeholder="Contoh: Dra. Endang Supriyati, M.Pd."
                       required>
                @error('name')<div class="form-error">⚠ {{ $message }}</div>@enderror
            </div>

            <div class="form-group" style="margin-bottom:0;">
                <label class="form-label" for="specialization">
                    Jabatan <span class="required">*</span>
                </label>
                <div style="position:relative;">
                    <select id="specialization" name="specialization"
                            class="form-control {{ $errors->has('specialization') ? 'error' : '' }}"
                            required>
                        @foreach($jabatanOptions as $opt)
                            <option value="{{ $opt }}"
                                    {{ old('specialization', $counselor->specialization) === $opt ? 'selected' : '' }}>
                                {{ $opt }}
                            </option>
                        @endforeach
                    </select>
                    <svg style="position:absolute;right:.875rem;top:50%;transform:translateY(-50%);pointer-events:none;color:#9ca3af;"
                         width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
                @error('specialization')<div class="form-error">⚠ {{ $message }}</div>@enderror
            </div>
        </div>

        {{-- ── NIP (wajib) ────────────────────────────────────────── --}}
        <div class="form-group">
            <label class="form-label" for="nip">
                NIP <span class="required">*</span>
            </label>
            <input type="text" id="nip" name="nip"
                   class="form-control {{ $errors->has('nip') ? 'error' : '' }}"
                   value="{{ old('nip', $counselor->nip) }}"
                   placeholder="Contoh: 197204151998012001"
                   maxlength="50" required>
            @error('nip')<div class="form-error">⚠ {{ $message }}</div>@enderror
        </div>

        {{-- ── Foto Profil ────────────────────────────────────────── --}}
        <div class="form-group">
            <label class="form-label">
                Ganti Foto Profil
                <span style="font-weight:400;color:#9ca3af;">(Biarkan kosong untuk tidak mengubah)</span>
            </label>

            {{-- Panduan ukuran --}}
            <div style="display:flex;align-items:flex-start;gap:1.25rem;margin-bottom:1rem;
                        padding:.9rem 1.1rem;border-radius:.75rem;
                        background:rgba(12,8,76,.04);border:1px solid rgba(12,8,76,.08);">
                {{-- Current photo preview (rasio 3:4) --}}
                <div style="flex-shrink:0;width:66px;height:88px;border-radius:.75rem;
                            overflow:hidden;border:2px solid #0C084C;background:#f3f4f6;">
                    @if($counselor->photo)
                        <img src="{{ Storage::url($counselor->photo) }}"
                             alt="Foto saat ini"
                             style="width:100%;height:100%;object-fit:cover;object-position:center top;">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;
                                    background:linear-gradient(160deg,#0C084C,#1e1a7a);font-size:1.8rem;">🖼</div>
                    @endif
                </div>
                <div style="font-size:.82rem;color:#374151;line-height:1.6;">
                    <div style="font-weight:700;color:#0C084C;margin-bottom:.25rem;">📐 Panduan Ukuran Foto</div>
                    <div>Foto ditampilkan sebagai <strong>background penuh kartu</strong> berukuran <strong>220 × 300 px</strong> (rasio 3:4, potret).</div>
                    <div style="margin-top:.35rem;">
                        ✅ <strong>Rasio ideal</strong>: 3:4 &nbsp;|&nbsp;
                        ✅ <strong>Resolusi min</strong>: 440 × 600 px &nbsp;|&nbsp;
                        ✅ <strong>Maks. 5MB</strong>
                    </div>
                    <div style="margin-top:.35rem;color:#6b7280;">
                        Format: JPG, PNG, WEBP &nbsp;·&nbsp;
                        {{ $counselor->photo ? 'Upload foto baru untuk mengganti foto saat ini.' : 'Belum ada foto — sangat disarankan untuk mengupload.' }}
                    </div>
                </div>
            </div>

            {{-- Dropzone --}}
            <label for="photo" id="dropzone"
                   style="display:flex;align-items:center;gap:1.5rem;
                          border:2px dashed #d1d5db;border-radius:1rem;
                          padding:1.25rem 1.75rem;cursor:pointer;
                          transition:all .25s;background:#fafafa;"
                   onmouseover="this.style.borderColor='#0C084C';this.style.background='#EEF7FF'"
                   onmouseout="this.style.borderColor='#d1d5db';this.style.background='#fafafa'">

                <div id="preview-wrap"
                     style="flex-shrink:0;width:66px;height:88px;border-radius:.75rem;
                            overflow:hidden;border:2px solid #e5e7eb;background:#f3f4f6;
                            display:flex;align-items:center;justify-content:center;
                            transition:border-color .2s;">
                    <img id="photo-preview" src="" alt=""
                         style="width:100%;height:100%;object-fit:cover;object-position:center top;display:none;">
                    <svg id="photo-placeholder" width="28" height="28" fill="none" stroke="#9ca3af" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>

                <div>
                    <div style="font-weight:600;color:#0C084C;margin-bottom:.2rem;" id="photo-label">
                        {{ $counselor->photo ? 'Klik untuk ganti foto' : 'Klik untuk pilih foto profil' }}
                    </div>
                    <div style="font-size:.78rem;color:#9ca3af;">JPG · PNG · WEBP · Maks. 5MB · Rasio ideal 3:4</div>
                </div>

                <input type="file" id="photo" name="photo"
                       accept="image/jpeg,image/png,image/webp"
                       style="display:none;" onchange="previewPhoto(this)">
            </label>
            @error('photo')<div class="form-error">⚠ {{ $message }}</div>@enderror
        </div>

        <hr style="border:none;border-top:1px solid #f3f4f6;margin:1.5rem 0;">

        {{-- ── Toggle + Tombol ────────────────────────────────────── --}}
        <div style="display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;">
            <div class="toggle-wrap">
                <label class="toggle">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $counselor->is_active) ? 'checked' : '' }}>
                    <span class="toggle-slider"></span>
                </label>
                <span style="font-size:.875rem;font-weight:600;color:#374151;">Konselor Aktif</span>
            </div>
            <div style="margin-left:auto;display:flex;gap:.75rem;">
                <button type="submit" form="delete-counselor-form"
                        class="btn btn-danger" style="padding:.65rem 1.25rem;"
                        onclick="return confirm('Hapus {{ addslashes($counselor->name) }}? Foto juga akan dihapus.')">
                    🗑️ Hapus
                </button>
                <a href="{{ route('admin.counselors.index') }}" class="btn btn-secondary" style="padding:.65rem 1.25rem;">Batal</a>
                <button type="submit" class="btn btn-primary" style="padding:.65rem 1.75rem;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </form>
</div>

{{-- Form Delete (dipisah di luar form utama) --}}
<form id="delete-counselor-form"
      method="POST"
      action="{{ route('admin.counselors.destroy', $counselor) }}">
    @csrf @method('DELETE')
</form>

@endsection

@push('scripts')
<script>
function previewPhoto(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img  = document.getElementById('photo-preview');
        const ph   = document.getElementById('photo-placeholder');
        const wrap = document.getElementById('preview-wrap');
        img.src = e.target.result;
        img.style.display = 'block';
        if (ph) ph.style.display = 'none';
        wrap.style.borderColor = '#0C084C';
        document.getElementById('photo-label').textContent = file.name;
    };
    reader.readAsDataURL(file);
}
</script>
@endpush
