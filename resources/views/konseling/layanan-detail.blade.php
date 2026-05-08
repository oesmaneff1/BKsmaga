@extends('layouts.app')

@section('title', 'Materi Bimbingan ' . $config['label'] . ' - BK SMAN 3 Kediri')
@section('meta_description', 'Daftar materi Bimbingan Klasikal ' . $config['label'] . ' – ' . $config['subtitle'] . ' untuk siswa SMAN 3 Kediri.')

@push('head')
<style>
/* ── Utility untuk halaman ini (inline-style proof) ──────────────── */
.detail-hero {
    background: {{ $config['gradient'] }};
    color: #fff;
    position: relative;
    overflow: hidden;
}
.detail-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 320px; height: 320px;
    background: rgba(255,255,255,.06);
    border-radius: 50%;
    pointer-events: none;
}
.detail-hero::after {
    content: '';
    position: absolute;
    bottom: -60px; left: -60px;
    width: 240px; height: 240px;
    background: rgba(0,0,0,.08);
    border-radius: 50%;
    pointer-events: none;
}
.hero-inner { position: relative; z-index: 1; }

/* Wave */
.hero-wave { display: block; width: 100%; margin-bottom: -2px; }

/* Pill badge materi */
.pill-materi {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: rgba(255,255,255,.2);
    border: 1px solid rgba(255,255,255,.3);
    border-radius: 99px;
    padding: .45rem 1.25rem;
    font-size: .85rem;
    font-weight: 700;
    color: #fff;
}
.pill-materi .dot {
    width: 8px; height: 8px;
    background: #facc15;
    border-radius: 50%;
    animation: pulse-dot 1.5s ease-in-out infinite;
}
@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: .6; transform: scale(.75); }
}

/* Emoji box */
.emoji-box {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 90px; height: 90px;
    background: rgba(255,255,255,.2);
    border: 1px solid rgba(255,255,255,.3);
    border-radius: 1.5rem;
    font-size: 3rem;
    backdrop-filter: blur(4px);
    margin-bottom: 1.25rem;
    transition: transform .3s;
}
.emoji-box:hover { transform: scale(1.08); }

/* Breadcrumb pill */
.crumb-pill {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    background: rgba(255,255,255,.15);
    border: 1px solid rgba(255,255,255,.25);
    border-radius: 99px;
    padding: .35rem 1rem;
    font-size: .82rem;
    font-weight: 600;
    color: rgba(255,255,255,.85);
    text-decoration: none;
    transition: all .2s;
    margin-bottom: 2rem;
}
.crumb-pill:hover { background: rgba(255,255,255,.25); color: #fff; }
.crumb-pill svg { transition: transform .2s; }
.crumb-pill:hover svg { transform: translateX(-3px); }

/* Nav tabs kelas */
.kelas-tabs {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: .625rem;
    margin-bottom: 3rem;
}
.kelas-tab {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .5rem 1.25rem;
    border-radius: 99px;
    font-size: .85rem;
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid #e5e7eb;
    color: #4b5563;
    background: #fff;
    transition: all .2s;
}
.kelas-tab:hover { border-color: {{ $config['badge_dot'] }}; color: {{ $config['badge_text'] }}; background: {{ $config['tag_bg'] }}; }
.kelas-tab.active {
    background: {{ $config['nav_active'] }};
    color: #fff;
    border-color: {{ $config['nav_active'] }};
    box-shadow: 0 4px 12px rgba(0,0,0,.15);
}

/* Card materi */
.materi-card {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f3f4f6;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform .25s, box-shadow .25s;
}
.materi-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,.1);
}
.card-accent { height: 4px; width: 100%; background: {{ $config['accent_line'] }}; }
.card-number {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px; height: 44px;
    border-radius: .875rem;
    font-size: .9rem;
    font-weight: 800;
    flex-shrink: 0;
    background: {{ $config['number_bg'] }};
    color: {{ $config['number_text'] }};
    transition: transform .2s;
}
.materi-card:hover .card-number { transform: scale(1.1); }
.card-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.35;
    transition: color .2s;
}
.materi-card:hover .card-title { color: {{ $config['badge_text'] }}; }
.kelas-tag {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    padding: .2rem .7rem;
    border-radius: 99px;
    font-size: .72rem;
    font-weight: 700;
    background: {{ $config['tag_bg'] }};
    color: {{ $config['tag_text'] }};
    border: 1px solid {{ $config['tag_border'] }};
    margin-top: .5rem;
}
.tag-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: {{ $config['badge_dot'] }};
}
.card-desc {
    color: #6b7280;
    font-size: .875rem;
    line-height: 1.65;
}

/* Buttons */
.btn-materi {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    padding: .6rem 1.25rem;
    border-radius: .75rem;
    font-size: .85rem;
    font-weight: 700;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all .2s;
    font-family: inherit;
}
.btn-solid {
    background: {{ $config['nav_active'] }};
    color: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
}
.btn-solid:hover {
    filter: brightness(1.1);
    box-shadow: 0 4px 16px rgba(0,0,0,.2);
    transform: translateY(-1px);
}
.btn-outline {
    background: #fff;
    color: {{ $config['badge_text'] }};
    border: 2px solid {{ $config['badge_dot'] }};
}
.btn-outline:hover {
    background: {{ $config['tag_bg'] }};
    transform: translateY(-1px);
}
.btn-disabled {
    background: #f9fafb;
    color: #9ca3af;
    border: 1px solid #e5e7eb;
    cursor: default;
}

/* Empty state */
.empty-state { text-align: center; padding: 6rem 1rem; }
.empty-icon {
    width: 80px; height: 80px;
    background: #f3f4f6;
    border-radius: 1.25rem;
    display: flex; align-items: center; justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 1.25rem;
}

/* Footer info */
.footer-info {
    text-align: center;
    margin-top: 3.5rem;
    padding-top: 2rem;
    border-top: 1px solid #f3f4f6;
}
.btn-back {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .75rem 2rem;
    border-radius: 1rem;
    font-size: .9rem;
    font-weight: 700;
    text-decoration: none;
    background: {{ $config['nav_active'] }};
    color: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,.18);
    transition: all .2s;
    margin-top: 1rem;
}
.btn-back:hover { filter: brightness(1.1); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.2); }
.btn-back svg { transition: transform .2s; }
.btn-back:hover svg { transform: translateX(-3px); }
</style>
@endpush

@section('content')

{{-- ═══ HERO ═══════════════════════════════════════════════════════════════ --}}
<section class="detail-hero">
    <div class="hero-inner max-w-7xl mx-auto px-6 py-14">

        {{-- Breadcrumb --}}
        <div>
            <a href="{{ route('layanan') }}" class="crumb-pill">
                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Layanan
            </a>
        </div>

        {{-- Content tengah --}}
        <div style="text-align:center">
            <div class="emoji-box">{{ $config['emoji'] }}</div>

            {{-- Badge subtitle --}}
            <div style="margin-bottom:.75rem">
                <span style="display:inline-block;background:rgba(250,204,21,.2);border:1px solid rgba(250,204,21,.4);color:#fde68a;font-size:.75rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;padding:.35rem 1.1rem;border-radius:99px;">
                    {{ $config['subtitle'] }}
                </span>
            </div>

            <h1 style="font-size:clamp(2rem,5vw,3.5rem);font-weight:900;line-height:1.1;margin-bottom:1rem;">
                Materi Bimbingan
                <span style="color:#fde047;">{{ $config['label'] }}</span>
            </h1>

            <p style="color:rgba(255,255,255,.7);font-size:1rem;max-width:500px;margin:0 auto 1.5rem;line-height:1.65;">
                Materi terstruktur yang dirancang untuk mendukung perkembangan siswa
                {{ $config['label'] }} di SMAN 3 Kediri.
            </p>

            <div class="pill-materi">
                <span class="dot"></span>
                {{ $materials->count() }} Materi Tersedia
            </div>
        </div>
    </div>

    {{-- Wave transisi --}}
    <svg class="hero-wave" viewBox="0 0 1440 40" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 40L1440 40L1440 0C1080 32 360 32 0 0L0 40Z" fill="#f9fafb"/>
    </svg>
</section>

{{-- ═══ KONTEN ══════════════════════════════════════════════════════════════ --}}
<section style="background:#f9fafb;padding:3.5rem 0 4rem;">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Navigasi antar kelas --}}
        <div class="kelas-tabs">
            @foreach([
                'kelas-10' => ['🌱', 'Kelas 10'],
                'kelas-11' => ['🚀', 'Kelas 11'],
                'kelas-12' => ['🎓', 'Kelas 12'],
            ] as $cat => [$icon, $lbl])
            <a href="{{ route('layanan.category', ['category' => $cat]) }}"
               class="kelas-tab {{ $category === $cat ? 'active' : '' }}">
                <span>{{ $icon }}</span>
                {{ $lbl }}
            </a>
            @endforeach
        </div>

        @if($materials->isEmpty())
        {{-- Empty State --}}
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <h2 style="font-size:1.2rem;font-weight:700;color:#374151;margin-bottom:.5rem">
                Belum Ada Materi
            </h2>
            <p style="color:#9ca3af;font-size:.875rem;max-width:280px;margin:0 auto">
                Materi untuk <strong style="color:#6b7280">{{ $config['label'] }}</strong>
                sedang disiapkan oleh tim BK.
            </p>
            <a href="{{ route('layanan') }}" class="btn-back" style="display:inline-flex;margin-top:2rem;">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Layanan
            </a>
        </div>

        @else

        {{-- Grid Materi 2 Kolom --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(min(100%,440px),1fr));gap:1.5rem;">
            @foreach($materials as $material)
            <div class="materi-card">

                {{-- Garis aksen atas --}}
                <div class="card-accent"></div>

                {{-- Header card --}}
                <div style="padding:1.5rem 1.75rem 1.25rem;">
                    <div style="display:flex;align-items:flex-start;gap:1rem;">
                        <div class="card-number">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div class="card-title">{{ $material->title }}</div>
                            <div>
                                <span class="kelas-tag">
                                    <span class="tag-dot"></span>
                                    {{ $config['label'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div style="margin:0 1.75rem;border-top:1px solid #f9fafb;"></div>

                {{-- Deskripsi --}}
                <div style="padding:1.25rem 1.75rem;flex:1;">
                    <p class="card-desc">{{ $material->description }}</p>
                </div>

                {{-- Action buttons --}}
                <div style="padding:1.25rem 1.75rem 1.75rem;display:flex;flex-wrap:wrap;gap:.65rem;">

                    {{-- Tombol Unduh Materi — tampil jika ada file_path --}}
                    @if($material->hasFile())
                    <a href="{{ asset('uploads/' . $material->file_path) }}"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-materi btn-solid">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Unduh Materi
                    </a>
                    @endif

                    {{-- Tombol Mainkan Game — tampil jika ada game_link --}}
                    @if($material->hasGameLink())
                    <a href="{{ $material->game_link }}"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-materi btn-outline">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Mainkan Game
                    </a>
                    @endif

                    {{-- Fallback jika tidak ada file maupun link --}}
                    @if(!$material->hasFile() && !$material->hasGameLink())
                    <span class="btn-materi btn-disabled">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Segera Hadir
                    </span>
                    @endif

                </div>
            </div>
            @endforeach
        </div>

        {{-- Footer info --}}
        <div class="footer-info">
            <p style="color:#9ca3af;font-size:.875rem;">
                Menampilkan <strong style="color:#374151;">{{ $materials->count() }}</strong>
                materi aktif untuk <strong style="color:#374151;">{{ $config['label'] }}</strong>
            </p>
            <a href="{{ route('layanan') }}" class="btn-back">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Semua Layanan
            </a>
        </div>

        @endif
    </div>
</section>

@endsection
