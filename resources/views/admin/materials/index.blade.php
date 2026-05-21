@extends('admin.layouts.admin')

@section('title', 'Kelola Materi BK')
@section('page-title', 'Materi Bimbingan Klasikal')
@section('breadcrumb', 'Materi')

@section('topbar-actions')
<a href="{{ route('admin.materials.create') }}" class="btn btn-primary">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>
    Tambah Materi
</a>
@endsection

@section('content')

@php
$stats = [
    ['label' => 'Total Materi', 'value' => App\Models\Material::count(),                    'icon' => '📄', 'bg' => 'rgba(12,8,76,.06)',   'color' => '#0C084C'],
    ['label' => 'Materi Aktif', 'value' => App\Models\Material::where('is_active',true)->count(),  'icon' => '✅', 'bg' => 'rgba(255,200,30,.15)', 'color' => '#7a5000'],
    ['label' => 'Nonaktif',     'value' => App\Models\Material::where('is_active',false)->count(), 'icon' => '⏸', 'bg' => '#f3f4f6',              'color' => '#6b7280'],
];
@endphp

{{-- Stats --}}
<div class="stats-grid">
    @foreach($stats as $s)
    <div class="stat-card">
        <div class="stat-icon" style="background:{{ $s['bg'] }};font-size:1.5rem">{{ $s['icon'] }}</div>
        <div>
            <div class="stat-value" style="color:{{ $s['color'] }}">{{ $s['value'] }}</div>
            <div class="stat-label">{{ $s['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- hidden form for filter submission --}}
<form method="GET" action="{{ route('admin.materials.index') }}" id="filter-form">
    <input type="hidden" name="category" id="f-category" value="{{ request('category') }}">
    <input type="hidden" name="sort"     id="f-sort"     value="{{ request('sort','desc') }}">
</form>

{{-- Table --}}
<div class="card">
    <div class="card-header">
        <h2>Daftar Materi</h2>
        <span style="font-size:.8rem;color:#9ca3af">{{ $materials->total() }} materi &bull; klik baris untuk detail</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Judul Materi</th>

                    {{-- Filter Kelas di header --}}
                    <th>
                        <div style="display:flex;align-items:center;gap:.4rem">
                            <span>Kelas</span>
                            <select onchange="setFilter('category', this.value)"
                                    style="border:1px solid #e5e7eb;border-radius:.4rem;padding:.15rem .4rem;font-size:.72rem;color:#374151;background:#fff;cursor:pointer;font-weight:600"
                                    title="Filter kelas">
                                <option value="" {{ !request('category') ? 'selected' : '' }}>Semua</option>
                                <option value="kelas-10" {{ request('category')=='kelas-10' ? 'selected' : '' }}>Kelas 10</option>
                                <option value="kelas-11" {{ request('category')=='kelas-11' ? 'selected' : '' }}>Kelas 11</option>
                                <option value="kelas-12" {{ request('category')=='kelas-12' ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                        </div>
                    </th>

                    {{-- Sort Tanggal di header --}}
                    <th>
                        <div style="display:flex;align-items:center;gap:.5rem">
                            <span>Tanggal Upload</span>
                            @php $currentSort = request('sort', 'desc'); @endphp
                            <a href="{{ route('admin.materials.index', array_merge(request()->query(), ['sort' => $currentSort === 'desc' ? 'asc' : 'desc'])) }}"
                               title="{{ $currentSort === 'desc' ? 'Sekarang: Terbaru. Klik untuk Terlama' : 'Sekarang: Terlama. Klik untuk Terbaru' }}"
                               style="display:inline-flex;align-items:center;color:#9ca3af;text-decoration:none;transition:color .15s;flex-shrink:0"
                               onmouseover="this.style.color='#0C084C'" onmouseout="this.style.color='#9ca3af'">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {{-- Arrow up: active (darker) when sort=asc --}}
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $currentSort === 'asc' ? '2.8' : '1.8' }}"
                                          stroke="{{ $currentSort === 'asc' ? '#0C084C' : '#9ca3af' }}"
                                          d="M5 15l7-7 7 7"/>
                                </svg>
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin-left:-4px">
                                    {{-- Arrow down: active (darker) when sort=desc --}}
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="{{ $currentSort === 'desc' ? '2.8' : '1.8' }}"
                                          stroke="{{ $currentSort === 'desc' ? '#0C084C' : '#9ca3af' }}"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </a>
                        </div>
                    </th>

                    <th>Status</th>
                    <th style="width:120px;text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $material)
                @php
                    $catColors = [
                        'kelas-10' => ['#dcfce7','#15803d'],
                        'kelas-11' => ['#d1fae5','#065f46'],
                        'kelas-12' => ['#ccfbf1','#0f766e'],
                    ];
                    $cc = $catColors[$material->category] ?? ['#f3f4f6','#4b5563'];

                    // Encode data untuk modal
                    $modalData = [
                        'id'          => $material->id,
                        'title'       => $material->title,
                        'category'    => $material->category_label,
                        'description' => $material->description,
                        'files'       => array_map(fn($f) => ['name' => basename($f), 'url' => asset('uploads/'.$f)], $material->files ?? []),
                        'links'       => $material->game_links ?? [],
                        'rpl'         => $material->rpl_document ? ['name' => basename($material->rpl_document), 'url' => route('admin.materials.rpl.download', $material)] : null,
                        'date'        => $material->created_at->translatedFormat('d F Y'),
                    ];
                @endphp
                <tr class="mat-row" onclick="openModal({{ json_encode($modalData) }})" style="cursor:pointer">
                    <td style="color:#9ca3af;font-size:.8rem">{{ $materials->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="font-weight:600;color:#111827;max-width:340px;line-height:1.35">{{ $material->title }}</div>
                        <div style="margin-top:.25rem;display:flex;gap:.4rem;flex-wrap:wrap">
                            @if($material->hasFile())
                            <span style="font-size:.7rem;background:#f0fdf4;color:#15803d;padding:.15rem .5rem;border-radius:4px;font-weight:600">
                                📎 {{ count($material->files) }} File
                            </span>
                            @endif
                            @if($material->hasGameLink())
                            <span style="font-size:.7rem;background:#eff6ff;color:#1d4ed8;padding:.15rem .5rem;border-radius:4px;font-weight:600">
                                🔗 {{ count($material->game_links) }} Link
                            </span>
                            @endif
                            @if($material->rpl_document)
                            <span style="font-size:.7rem;background:#faf5ff;color:#7c3aed;padding:.15rem .5rem;border-radius:4px;font-weight:600">
                                🔒 RPL
                            </span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="badge" style="background:{{ $cc[0] }};color:{{ $cc[1] }}">
                            <span class="badge-dot" style="background:{{ $cc[1] }}"></span>
                            {{ $material->category_label }}
                        </span>
                    </td>
                    <td>
                        <div style="font-size:.82rem;color:#374151;font-weight:500">
                            {{ $material->created_at->format('d/m/Y') }}
                        </div>
                        <div style="font-size:.72rem;color:#9ca3af">{{ $material->created_at->diffForHumans() }}</div>
                    </td>
                    <td onclick="event.stopPropagation()">
                        <form method="POST" action="{{ route('admin.materials.toggle', $material) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <button type="submit" style="background:none;border:none;cursor:pointer;padding:0" title="Toggle status">
                                @if($material->is_active)
                                <span class="badge badge-green"><span class="badge-dot" style="background:#16a34a"></span>Aktif</span>
                                @else
                                <span class="badge badge-gray"><span class="badge-dot" style="background:#9ca3af"></span>Nonaktif</span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td onclick="event.stopPropagation()">
                        <div style="display:flex;align-items:center;justify-content:center;gap:.4rem">
                            <a href="{{ route('admin.materials.edit', $material) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.materials.destroy', $material) }}"
                                  onsubmit="return confirm('Hapus materi ini? File terkait juga akan dihapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Hapus">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:3rem;color:#9ca3af">
                        <div style="font-size:2.5rem;margin-bottom:.75rem">📭</div>
                        <div style="font-weight:600;color:#6b7280">Belum ada materi</div>
                        <div style="font-size:.8rem;margin-top:.3rem">Mulai dengan menambahkan materi pertama.</div>
                        <a href="{{ route('admin.materials.create') }}" class="btn btn-primary" style="margin-top:1rem">+ Tambah Materi Pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($materials->hasPages())
    <div style="padding:1rem 1.5rem;border-top:1px solid #f3f4f6">
        {{ $materials->links() }}
    </div>
    @endif
</div>

{{-- ══ MODAL DETAIL MATERI ══════════════════════════════════════════ --}}
<div id="mat-modal-overlay" onclick="closeModal()"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9998;backdrop-filter:blur(3px);animation:fadeIn .2s ease"></div>

<div id="mat-modal"
     style="display:none;position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);
            width:min(640px,94vw);max-height:88vh;overflow-y:auto;
            background:#fff;border-radius:1.25rem;box-shadow:0 24px 64px rgba(0,0,0,.18);
            z-index:9999;animation:slideUp .25s ease">

    {{-- Modal Header --}}
    <div style="padding:1.5rem 1.75rem 1rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:flex-start;gap:1rem">
        <div style="flex:1;min-width:0">
            <div id="modal-badge" style="margin-bottom:.5rem"></div>
            <h3 id="modal-title" style="font-size:1.1rem;font-weight:800;color:#111827;line-height:1.3;margin:0"></h3>
            <div id="modal-date" style="font-size:.75rem;color:#9ca3af;margin-top:.35rem"></div>
        </div>
        <button onclick="closeModal()"
                style="background:#f3f4f6;border:none;border-radius:.6rem;width:34px;height:34px;cursor:pointer;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#6b7280;font-size:1.1rem;transition:background .15s"
                onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">✕</button>
    </div>

    {{-- Modal Body --}}
    <div style="padding:1.25rem 1.75rem 1.75rem">

        {{-- Deskripsi --}}
        <div style="margin-bottom:1.25rem">
            <div class="modal-section-label">📝 Deskripsi</div>
            <div style="background:#f8faff;border:1px solid #e5e7eb;border-radius:.75rem;padding:1rem 1.125rem;max-height:140px;overflow-y:auto;">
                <p id="modal-desc" style="font-size:.875rem;color:#374151;line-height:1.75;margin:0;
                                          word-break:break-word;overflow-wrap:anywhere;white-space:normal"></p>
            </div>
        </div>

        {{-- File Materi --}}
        <div id="modal-files-section" style="margin-bottom:1.25rem">
            <div class="modal-section-label">📎 File Materi</div>
            <div id="modal-files"></div>
        </div>

        {{-- Link Permainan --}}
        <div id="modal-links-section" style="margin-bottom:1.25rem">
            <div class="modal-section-label">🔗 Link Permainan / Media</div>
            <div id="modal-links"></div>
        </div>

        {{-- Dokumen RPL --}}
        <div id="modal-rpl-section">
            <div class="modal-section-label">🔒 Dokumen RPL <span style="font-size:.7rem;font-weight:400;color:#9ca3af">(hanya admin)</span></div>
            <div id="modal-rpl"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<style>
.mat-row:hover { background: #f8faff; }
.mat-row:hover td:first-child { border-left: 3px solid #0C084C; }

.modal-section-label {
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #9ca3af;
    margin-bottom: .6rem;
}

.modal-file-item {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .65rem 1rem;
    background: #f8faff;
    border: 1px solid #e5e7eb;
    border-radius: .65rem;
    margin-bottom: .45rem;
    text-decoration: none;
    color: #374151;
    font-size: .82rem;
    font-weight: 500;
    transition: all .15s;
}
.modal-file-item:hover { background: #EEF7FF; border-color: #0C084C; color: #0C084C; }

.modal-link-item {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .65rem 1rem;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: .65rem;
    margin-bottom: .45rem;
    text-decoration: none;
    color: #1d4ed8;
    font-size: .82rem;
    font-weight: 500;
    transition: all .15s;
    word-break: break-all;
}
.modal-link-item:hover { background: #dbeafe; }

.modal-rpl-item {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .65rem 1rem;
    background: #faf5ff;
    border: 1px solid #e9d5ff;
    border-radius: .65rem;
    text-decoration: none;
    color: #7c3aed;
    font-size: .82rem;
    font-weight: 500;
    transition: all .15s;
}
.modal-rpl-item:hover { background: #ede9fe; }

@keyframes fadeIn  { from { opacity:0 } to { opacity:1 } }
@keyframes slideUp { from { opacity:0; transform:translate(-50%,-46%) } to { opacity:1; transform:translate(-50%,-50%) } }
</style>

<script>
// Filter: update hidden input dan submit form
function setFilter(key, value) {
    document.getElementById('f-' + key).value = value;
    document.getElementById('filter-form').submit();
}

function openModal(data) {
    document.getElementById('modal-title').textContent = data.title;
    document.getElementById('modal-date').textContent  = '📅 Diunggah: ' + data.date;
    document.getElementById('modal-desc').textContent  = data.description || '(Tidak ada deskripsi)';

    // Badge kategori
    const catColor = {'Kelas 10': ['#dcfce7','#15803d'], 'Kelas 11': ['#d1fae5','#065f46'], 'Kelas 12': ['#ccfbf1','#0f766e']};
    const cc = catColor[data.category] || ['#f3f4f6','#4b5563'];
    document.getElementById('modal-badge').innerHTML =
        `<span style="display:inline-flex;align-items:center;gap:.35rem;font-size:.72rem;font-weight:700;padding:.2rem .65rem;border-radius:99px;background:${cc[0]};color:${cc[1]}">`+
        `<span style="width:6px;height:6px;border-radius:50%;background:${cc[1]};display:inline-block"></span>${data.category}</span>`;

    // File Materi
    const filesEl = document.getElementById('modal-files');
    const filesSection = document.getElementById('modal-files-section');
    if (data.files && data.files.length > 0) {
        filesEl.innerHTML = data.files.map((f, i) =>
            `<a href="${f.url}" target="_blank" class="modal-file-item">`+
            `<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`+
            `<span style="flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">File ${i+1} — ${f.name}</span>`+
            `<svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>`
        ).join('');
        filesSection.style.display = '';
    } else {
        filesSection.style.display = 'none';
    }

    // Link Permainan
    const linksEl = document.getElementById('modal-links');
    const linksSection = document.getElementById('modal-links-section');
    if (data.links && data.links.length > 0) {
        linksEl.innerHTML = data.links.map((l, i) =>
            `<a href="${l}" target="_blank" class="modal-link-item">`+
            `<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>`+
            `<span style="flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis">Link ${i+1} — ${l}</span>`+
            `<svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>`
        ).join('');
        linksSection.style.display = '';
    } else {
        linksSection.style.display = 'none';
    }

    // RPL
    const rplEl = document.getElementById('modal-rpl');
    const rplSection = document.getElementById('modal-rpl-section');
    if (data.rpl) {
        rplEl.innerHTML =
            `<a href="${data.rpl.url}" target="_blank" class="modal-rpl-item">`+
            `<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>`+
            `<span style="flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${data.rpl.name}</span>`+
            `<span style="background:#ede9fe;color:#7c3aed;font-size:.65rem;padding:.15rem .45rem;border-radius:4px;font-weight:700;flex-shrink:0">🔒 Unduh</span></a>`;
        rplSection.style.display = '';
    } else {
        rplSection.style.display = 'none';
    }

    // Tampilkan modal
    document.getElementById('mat-modal-overlay').style.display = 'block';
    document.getElementById('mat-modal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('mat-modal-overlay').style.display = 'none';
    document.getElementById('mat-modal').style.display = 'none';
    document.body.style.overflow = '';
}

// Tutup dengan Escape
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endpush
