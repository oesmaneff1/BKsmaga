@extends('admin.layouts.admin')

@section('title', 'Kelola Tim BK')
@section('page-title', 'Tim Bimbingan Konseling')
@section('breadcrumb', 'Tim BK')

@section('topbar-actions')
<a href="{{ route('admin.counselors.create') }}" class="btn btn-primary">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
    </svg>
    Tambah Konselor
</a>
@endsection

@section('content')

@php
use App\Models\Counselor;
$stats = [
    ['label' => 'Total Konselor', 'value' => Counselor::count(),                       'icon' => '👥', 'bg' => 'rgba(12,8,76,.06)',    'color' => '#0C084C'],
    ['label' => 'Aktif',          'value' => Counselor::where('is_active', true)->count(),  'icon' => '✅', 'bg' => 'rgba(255,200,30,.15)', 'color' => '#7a5000'],
    ['label' => 'Nonaktif',       'value' => Counselor::where('is_active', false)->count(), 'icon' => '⏸', 'bg' => '#f3f4f6',              'color' => '#6b7280'],
];
@endphp

{{-- Stats --}}
<div class="stats-grid">
    @foreach($stats as $s)
    <div class="stat-card">
        <div class="stat-icon" style="background:{{ $s['bg'] }};font-size:1.5rem;">{{ $s['icon'] }}</div>
        <div>
            <div class="stat-value" style="color:{{ $s['color'] }}">{{ $s['value'] }}</div>
            <div class="stat-label">{{ $s['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Flash Message --}}
@if(session('success'))
<div class="alert alert-success" style="margin-bottom:1.5rem;">
    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
</div>
@endif

{{-- ── CSS Card Admin ────────────────────────────────────────────── --}}
<style>
    .adm-card {
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
        background: #0C084C;
        box-shadow: 0 4px 20px rgba(0,0,0,.10);
        transition: box-shadow .35s ease, transform .35s ease;
        width: 220px;
        height: 300px;
        flex-shrink: 0;
    }
    .adm-card:hover {
        box-shadow: 0 16px 48px rgba(0,0,0,.2);
        transform: translateY(-5px) scale(1.02);
    }
    .adm-card__photo {
        position: absolute; inset: 0;
        width: 100%; height: 100%;
        object-fit: cover; object-position: center top;
        transition: transform .6s cubic-bezier(.4,0,.2,1);
    }
    .adm-card:hover .adm-card__photo { transform: scale(1.07); }

    .adm-card__fallback {
        position: absolute; inset: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 4.5rem;
        background: linear-gradient(160deg,#0C084C,#1e1a7a);
    }
    /* Overlay default: navy kuat di bawah */
    .adm-card__overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            to top,
            rgba(12,8,76,.97) 0%,
            rgba(12,8,76,.80) 40%,
            rgba(12,8,76,.20) 65%,
            transparent 100%
        );
        transition: background .45s ease;
    }
    /* Hover: overlay hampir hilang */
    .adm-card:hover .adm-card__overlay {
        background: linear-gradient(
            to top,
            rgba(0,0,0,.7) 0%,
            rgba(0,0,0,.25) 45%,
            transparent 100%
        );
    }
    .adm-card__body {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 1rem 1rem .9rem;
    }
    .adm-card__name {
        color: #fff;
        font-size: .92rem;
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: .3rem;
        text-shadow: 0 2px 6px rgba(0,0,0,.5);
    }
    .adm-card__badge {
        display: inline-block;
        padding: .18rem .7rem;
        border-radius: 99px;
        font-size: .65rem;
        font-weight: 700;
        margin-bottom: .55rem;
        letter-spacing: .03em;
    }
    .adm-card__badge--gold  { background: #FFC81E; color: #0C084C; }
    .adm-card__badge--navy  { background: rgba(255,255,255,.15); color: #fff; }

    /* Status pill pojok kanan atas */
    .adm-card__status {
        position: absolute;
        top: .75rem; right: .75rem;
        font-size: .62rem; font-weight: 700;
        padding: .22rem .65rem;
        border-radius: 99px;
        z-index: 10;
        backdrop-filter: blur(6px);
    }
    .adm-card__status--active   { background: rgba(255,200,30,.85); color:#0C084C; }
    .adm-card__status--inactive { background: rgba(255,255,255,.25); color:#fff; }

    /* Tombol aksi: muncul saat hover */
    .adm-card__actions {
        position: absolute;
        top: .75rem; left: .75rem;
        display: flex; gap: .4rem;
        opacity: 0;
        transform: translateY(-4px);
        transition: opacity .3s ease, transform .3s ease;
        z-index: 20;
    }
    .adm-card:hover .adm-card__actions {
        opacity: 1;
        transform: translateY(0);
    }
    .adm-action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px;
        border-radius: .6rem;
        border: none; cursor: pointer;
        font-size: .8rem;
        font-weight: 700;
        text-decoration: none;
        backdrop-filter: blur(8px);
        transition: background .2s;
    }
    .adm-action-btn--edit   { background: rgba(255,255,255,.85); color: #0C084C; }
    .adm-action-btn--edit:hover { background: #fff; }
    .adm-action-btn--del    { background: rgba(220,38,38,.8); color: #fff; }
    .adm-action-btn--del:hover { background: rgba(220,38,38,1); }
</style>

{{-- ── Card Grid ─────────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-header">
        <h2>Daftar Konselor</h2>
        <span style="font-size:.8rem;color:#6b7280;">{{ $counselors->count() }} konselor terdaftar</span>
    </div>
    <div style="padding:1.5rem;">

        @if($counselors->isEmpty())
        <div style="text-align:center;padding:4rem 1.5rem;">
            <div style="font-size:3rem;margin-bottom:1rem;">👥</div>
            <div style="font-weight:600;color:#6b7280;margin-bottom:.75rem;">Belum ada data konselor</div>
            <a href="{{ route('admin.counselors.create') }}" class="btn btn-primary">
                + Tambah Konselor Pertama
            </a>
        </div>
        @else

        <div style="display:flex;flex-wrap:wrap;justify-content:flex-start;gap:1.25rem;">
            @foreach($counselors as $counselor)

            <div class="adm-card">

                {{-- Status pill --}}
                <span class="adm-card__status {{ $counselor->is_active ? 'adm-card__status--active' : 'adm-card__status--inactive' }}">
                    {{ $counselor->is_active ? '● Aktif' : '● Nonaktif' }}
                </span>

                {{-- Tombol aksi (muncul saat hover) --}}
                <div class="adm-card__actions">
                    <a href="{{ route('admin.counselors.edit', $counselor) }}"
                       class="adm-action-btn adm-action-btn--edit"
                       title="Edit">✏️</a>
                    <form method="POST" action="{{ route('admin.counselors.destroy', $counselor) }}"
                          onsubmit="return confirm('Hapus {{ addslashes($counselor->name) }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="adm-action-btn adm-action-btn--del" title="Hapus">🗑️</button>
                    </form>
                    <form method="POST" action="{{ route('admin.counselors.toggle', $counselor) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="adm-action-btn" style="background:rgba(255,255,255,.2);color:#fff;"
                                title="{{ $counselor->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            {{ $counselor->is_active ? '⏸' : '▶' }}
                        </button>
                    </form>
                </div>

                {{-- Foto --}}
                @if($counselor->photo)
                    <img class="adm-card__photo"
                         src="{{ $counselor->photoUrl }}"
                         alt="{{ $counselor->name }}">
                @else
                    <div class="adm-card__fallback">👤</div>
                @endif

                {{-- Overlay --}}
                <div class="adm-card__overlay"></div>

                {{-- Teks --}}
                <div class="adm-card__body">
                    <div class="adm-card__name">{{ $counselor->name }}</div>
                    <span class="adm-card__badge {{ $counselor->specialization === 'Koordinator BK' ? 'adm-card__badge--gold' : 'adm-card__badge--navy' }}">
                        {{ $counselor->specialization }}
                    </span>
                    <div style="font-size:.7rem;color:rgba(255,255,255,.65);font-weight:500;">
                        @if($counselor->nip) NIP: {{ $counselor->nip }}
                        @else <span style="font-style:italic;">NIP: —</span>
                        @endif
                    </div>
                </div>

            </div>{{-- /adm-card --}}
            @endforeach
        </div>
        @endif

    </div>
</div>

@endsection
