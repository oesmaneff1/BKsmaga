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
    ['label' => 'Total Materi', 'value' => App\Models\Material::count(),                     'icon' => '📄', 'bg' => 'rgba(12,8,76,.06)',  'color' => '#0C084C'],
    ['label' => 'Materi Aktif', 'value' => App\Models\Material::where('is_active', true)->count(),  'icon' => '✅', 'bg' => 'rgba(255,200,30,.15)', 'color' => '#7a5000'],
    ['label' => 'Nonaktif',     'value' => App\Models\Material::where('is_active', false)->count(), 'icon' => '⏸',  'bg' => '#f3f4f6',              'color' => '#6b7280'],
];
@endphp

{{-- Stats --}}
<div class="stats-grid">
    @foreach($stats as $s)
    <div class="stat-card">
        <div class="stat-icon" style="background:{{ $s['bg'] }}; font-size:1.5rem;">{{ $s['icon'] }}</div>
        <div>
            <div class="stat-value" style="color:{{ $s['color'] }}">{{ $s['value'] }}</div>
            <div class="stat-label">{{ $s['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Table --}}
<div class="card">
    <div class="card-header">
        <h2>Daftar Materi</h2>
        <span style="font-size:.8rem;color:#6b7280;">{{ $materials->total() }} total materi</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Judul Materi</th>
                    <th>Kategori</th>
                    <th>File</th>
                    <th>Link Game</th>
                    <th>Status</th>
                    <th style="width:140px; text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $material)
                <tr>
                    <td style="color:#9ca3af;font-size:.8rem">{{ $materials->firstItem() + $loop->index }}</td>
                    <td>
                        <div style="font-weight:600;color:#111827;max-width:280px;line-height:1.3">{{ $material->title }}</div>
                        <div style="font-size:.78rem;color:#9ca3af;margin-top:.2rem;overflow:hidden;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical">{{ $material->description }}</div>
                    </td>
                    <td>
                        @php
                        $catColors = ['kelas-10' => ['#dcfce7','#15803d'], 'kelas-11' => ['#d1fae5','#065f46'], 'kelas-12' => ['#ccfbf1','#0f766e']];
                        $cc = $catColors[$material->category] ?? ['#f3f4f6','#4b5563'];
                        @endphp
                        <span class="badge" style="background:{{ $cc[0] }};color:{{ $cc[1] }}">
                            <span class="badge-dot" style="background:{{ $cc[1] }}"></span>
                            {{ $material->category_label }}
                        </span>
                    </td>
                    <td>
                        @if($material->hasFile())
                        <a href="{{ asset('uploads/' . $material->file_path) }}" target="_blank"
                           style="display:inline-flex;align-items:center;gap:.3rem;font-size:.8rem;color:#15803d;text-decoration:none;font-weight:600;"
                           title="{{ $material->file_path }}">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                            Ada File
                        </a>
                        @else
                        <span style="color:#d1d5db;font-size:.8rem">–</span>
                        @endif
                    </td>
                    <td>
                        @if($material->hasGameLink())
                        <a href="{{ $material->game_link }}" target="_blank"
                           style="display:inline-flex;align-items:center;gap:.3rem;font-size:.8rem;color:#2563eb;text-decoration:none;font-weight:600;">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Lihat Link
                        </a>
                        @else
                        <span style="color:#d1d5db;font-size:.8rem">–</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.materials.toggle', $material) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <button type="submit" style="background:none;border:none;cursor:pointer;padding:0" title="Klik untuk toggle status">
                                @if($material->is_active)
                                <span class="badge badge-green"><span class="badge-dot" style="background:#16a34a"></span>Aktif</span>
                                @else
                                <span class="badge badge-gray"><span class="badge-dot" style="background:#9ca3af"></span>Nonaktif</span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;justify-content:center;gap:.4rem">
                            {{-- Edit --}}
                            <a href="{{ route('admin.materials.edit', $material) }}" class="btn btn-secondary btn-sm btn-icon" title="Edit">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            {{-- Hapus --}}
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
                    <td colspan="7" style="text-align:center;padding:3rem;color:#9ca3af">
                        <div style="font-size:2.5rem;margin-bottom:.75rem">📭</div>
                        <div style="font-weight:600;color:#6b7280">Belum ada materi</div>
                        <div style="font-size:.8rem;margin-top:.3rem">Mulai dengan menambahkan materi pertama.</div>
                        <a href="{{ route('admin.materials.create') }}" class="btn btn-primary" style="margin-top:1rem">
                            + Tambah Materi Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($materials->hasPages())
    <div style="padding:1rem 1.5rem; border-top:1px solid #f3f4f6">
        {{ $materials->links() }}
    </div>
    @endif
</div>

@endsection
