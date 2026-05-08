@extends('layouts.app')

@section('title', 'Layanan BK - SMAN 3 Kediri')
@section('meta_description', 'Berbagai layanan Bimbingan Konseling yang tersedia untuk siswa SMAN 3 Kediri, mulai dari konseling individu hingga bimbingan klasikal.')

@push('head')
<style>
/* ── Inline-safe styles untuk halaman Layanan ───────────────────── */
.layanan-hero {
    background: #0C084C;
    color: #fff;
    padding: 4rem 0;
    position: relative;
    overflow: hidden;
}
.layanan-hero::before {
    content:'';position:absolute;top:-100px;right:-100px;
    width:380px;height:380px;background:rgba(255,255,255,.05);
    border-radius:50%;pointer-events:none;
}
.layanan-hero::after {
    content:'';position:absolute;bottom:-80px;left:-60px;
    width:280px;height:280px;background:rgba(250,204,21,.08);
    border-radius:50%;pointer-events:none;
}
.hero-inner { position:relative;z-index:1; }

/* Stat strip */
.stat-pill {
    display:inline-flex;align-items:center;gap:.5rem;
    background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);
    border-radius:.75rem;padding:.5rem 1.25rem;
}
.stat-dot { width:8px;height:8px;border-radius:50%;background:#facc15;animation:pulse-s 1.5s ease-in-out infinite; }
@keyframes pulse-s { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.7)} }

/* Section header */
.section-badge {
    display:inline-block;color:#0C084C;font-weight:700;
    letter-spacing:.08em;text-transform:uppercase;font-size:.75rem;
    background:rgba(255,200,30,.18);border:1px solid rgba(255,200,30,.4);
    padding:.35rem 1.1rem;border-radius:99px;margin-bottom:.75rem;
}

/* Cards grid */
.cards-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(min(100%, 320px), 1fr));
    gap:2rem;
}

/* Card wrapper */
.kelas-card {
    background:#fff;
    border-radius:1.5rem;
    box-shadow:0 2px 12px rgba(0,0,0,.07);
    border:1px solid #e5e7eb;
    overflow:hidden;
    display:flex;flex-direction:column;
    transition:transform .3s, box-shadow .3s;
}
.kelas-card:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(0,0,0,.12); }

/* Card headers — fixed per card */
.card-hd-10 { background: #0C084C; }
.card-hd-11 { background: #0C084C; }
.card-hd-12 { background: #0C084C; }

.card-header-inner {
    padding:2.5rem 2rem;
    position:relative;overflow:hidden;
    text-align:center;
}
.card-header-inner::before {
    content:'';position:absolute;top:-2rem;right:-2rem;
    width:8rem;height:8rem;background:rgba(255,255,255,.1);
    border-radius:50%;pointer-events:none;
}
.card-header-inner::after {
    content:'';position:absolute;bottom:-1rem;left:-1.5rem;
    width:6rem;height:6rem;background:rgba(255,255,255,.06);
    border-radius:50%;pointer-events:none;
}
.card-header-inner > * { position:relative;z-index:1; }

.emoji-wrap {
    display:inline-flex;align-items:center;justify-content:center;
    width:5rem;height:5rem;
    background:rgba(255,255,255,.2);border:1px solid rgba(255,255,255,.3);
    border-radius:1rem;font-size:2.5rem;margin-bottom:1.25rem;
    backdrop-filter:blur(4px);
}
.card-hd-title { color:#fff;font-size:1.5rem;font-weight:800;line-height:1.2; }
.card-hd-sub   { color:rgba(255,255,255,.75);font-size:.8rem;font-weight:500;margin-top:.25rem; }
.count-pill {
    display:inline-flex;align-items:center;gap:.5rem;
    background:rgba(255,255,255,.2);border:1px solid rgba(255,255,255,.3);
    border-radius:99px;padding:.4rem 1.25rem;margin-top:1.25rem;
    color:#fff;font-size:.82rem;font-weight:700;
}

/* Tags — fixed per kelas */
.tag-10 { background:rgba(255,200,30,.15);color:#0C084C;border:1px solid rgba(255,200,30,.3); }
.tag-11 { background:rgba(255,200,30,.15);color:#0C084C;border:1px solid rgba(255,200,30,.3); }
.tag-12 { background:rgba(255,200,30,.15);color:#0C084C;border:1px solid rgba(255,200,30,.3); }
.kelas-tag {
    display:inline-flex;align-items:center;gap:.4rem;
    font-size:.75rem;font-weight:700;
    padding:.25rem .75rem;border-radius:99px;
}
.tag-dot-10 { width:6px;height:6px;border-radius:50%;background:#FFC81E;display:inline-block; }
.tag-dot-11 { width:6px;height:6px;border-radius:50%;background:#FFC81E;display:inline-block; }
.tag-dot-12 { width:6px;height:6px;border-radius:50%;background:#FFC81E;display:inline-block; }

/* Stat row */
.stat-row {
    display:flex;align-items:center;justify-content:space-between;
    font-size:.875rem;border-top:1px solid #f3f4f6;padding-top:1rem;
}
.stat-icon-10 { color:#FFC81E; }
.stat-icon-11 { color:#FFC81E; }
.stat-icon-12 { color:#FFC81E; }

/* Buttons — Golden Yellow with Navy text */
.btn-10 { background:#FFC81E;color:#0C084C; }
.btn-10:hover { background:#ffd84d; }
.btn-11 { background:#FFC81E;color:#0C084C; }
.btn-11:hover { background:#ffd84d; }
.btn-12 { background:#FFC81E;color:#0C084C; }
.btn-12:hover { background:#ffd84d; }
.btn-kelas {
    display:inline-flex;align-items:center;justify-content:center;gap:.5rem;
    width:100%;padding:.875rem 1.5rem;
    border-radius:1rem;font-size:.875rem;font-weight:700;
    text-decoration:none;border:none;cursor:pointer;
    transition:all .2s;box-shadow:0 2px 8px rgba(0,0,0,.12);
    font-family:inherit;
}
.btn-kelas:hover { transform:scale(1.02);box-shadow:0 6px 20px rgba(0,0,0,.18); }
.btn-kelas:active { transform:scale(.98); }
.btn-arrow { transition:transform .2s; }
.kelas-card:hover .btn-arrow { transform:translateX(4px); }
</style>
@endpush

@section('content')

{{-- ═══ HERO ══════════════════════════════════════════════════════════════ --}}
<section class="layanan-hero">
    <div class="hero-inner max-w-7xl mx-auto px-6 text-center">

        <span style="display:inline-block;background:rgba(255,200,30,.15);border:1px solid rgba(255,200,30,.3);color:#FFC81E;font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:.35rem 1.1rem;border-radius:99px;margin-bottom:1rem;">
            Program Unggulan
        </span>

        <h1 style="font-size:clamp(2rem,5vw,3.25rem);font-weight:900;line-height:1.1;margin-bottom:1rem;">
            Layanan <span style="color:#FFC81E;">Bimbingan Klasikal</span>
        </h1>

        <p style="color:rgba(255,255,255,.75);max-width:560px;margin:0 auto 2.5rem;font-size:1rem;line-height:1.7;">
            Materi bimbingan terstruktur yang dirancang khusus untuk setiap tingkatan kelas,
            dilengkapi media permainan interaktif yang menyenangkan.
        </p>

        {{-- Stat strip --}}
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:.75rem;">
            @foreach(['Kelas 10','Kelas 11','Kelas 12'] as $lvl)
            @php
                $materiCount = match($lvl) {
                    'Kelas 10' => $jumlahMateriKelas10 ?? 0,
                    'Kelas 11' => $jumlahMateriKelas11 ?? 0,
                    'Kelas 12' => $jumlahMateriKelas12 ?? 0,
                    default => 0,
                };
            @endphp
            <div class="stat-pill">
                <span class="stat-dot"></span>
                <span style="font-size:.875rem;font-weight:600;color:#fff;">{{ $lvl }}</span>
                <span style="color:rgba(255,255,255,.6);font-size:.8rem;">· {{ $materiCount }} Materi</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ GRID BIMBINGAN KLASIKAL ══════════════════════════════════════════ --}}
<section style="padding:5rem 0;background:#f9fafb;">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Section Header --}}
        <div style="text-align:center;margin-bottom:3.5rem;">
            <span class="section-badge">Program Unggulan</span>
            <h2 style="font-size:clamp(1.75rem,4vw,2.5rem);font-weight:800;color:#0C084C;margin-bottom:.75rem;line-height:1.2;">
                Layanan <span style="color:#FFC81E;">Bimbingan Klasikal</span>
            </h2>
            <p style="color:#6b7280;max-width:520px;margin:0 auto;font-size:.95rem;line-height:1.7;">
                Materi bimbingan terstruktur yang dirancang khusus untuk setiap jenjang kelas,
                dilengkapi media interaktif dan permainan edukatif.
            </p>
        </div>

        {{-- Cards Grid --}}
        <div class="cards-grid">

            @php
            $cardConfig = [
                [
                    'level'      => 'Kelas 10',
                    'category'   => 'kelas-10',
                    'emoji'      => '🌱',
                    'subtitle'   => 'Fondasi & Adaptasi',
                    'desc'       => 'Materi dirancang membantu siswa baru beradaptasi dengan lingkungan sekolah, membangun karakter, dan mengenali potensi diri sejak dini.',
                    'highlights' => ['Adaptasi Lingkungan', 'Pengenalan Diri', 'Manajemen Emosi'],
                    'hd_class'   => 'card-hd-10',
                    'tag_class'  => 'tag-10',
                    'tag_dot'    => 'tag-dot-10',
                    'btn_class'  => 'btn-10',
                    'icon_class' => 'stat-icon-10',
                ],
                [
                    'level'      => 'Kelas 11',
                    'category'   => 'kelas-11',
                    'emoji'      => '🚀',
                    'subtitle'   => 'Eksplorasi & Pengembangan',
                    'desc'       => 'Mendorong siswa mengeksplorasi minat dan bakat, mengembangkan keterampilan sosial, serta mulai merencanakan masa depan akademik dan karir.',
                    'highlights' => ['Eksplorasi Karir', 'Keterampilan Sosial', 'Perencanaan Studi'],
                    'hd_class'   => 'card-hd-11',
                    'tag_class'  => 'tag-11',
                    'tag_dot'    => 'tag-dot-11',
                    'btn_class'  => 'btn-11',
                    'icon_class' => 'stat-icon-11',
                ],
                [
                    'level'      => 'Kelas 12',
                    'category'   => 'kelas-12',
                    'emoji'      => '🎓',
                    'subtitle'   => 'Persiapan & Masa Depan',
                    'desc'       => 'Mempersiapkan siswa menghadapi ujian akhir, seleksi perguruan tinggi, dan transisi menuju kehidupan setelah lulus dengan percaya diri.',
                    'highlights' => ['Persiapan SNBT', 'Seleksi PTN/PTS', 'Manajemen Stres'],
                    'hd_class'   => 'card-hd-12',
                    'tag_class'  => 'tag-12',
                    'tag_dot'    => 'tag-dot-12',
                    'btn_class'  => 'btn-12',
                    'icon_class' => 'stat-icon-12',
                ],
            ];
            @endphp

            @foreach($cardConfig as $card)
            @php 
                $count = match($card['level']) {
                    'Kelas 10' => $jumlahMateriKelas10 ?? 0,
                    'Kelas 11' => $jumlahMateriKelas11 ?? 0,
                    'Kelas 12' => $jumlahMateriKelas12 ?? 0,
                    default => 0,
                };
            @endphp

            <div class="kelas-card">

                {{-- Header gradien --}}
                <div class="{{ $card['hd_class'] }}">
                    <div class="card-header-inner">
                        <div class="emoji-wrap">{{ $card['emoji'] }}</div>
                        <div class="card-hd-title">{{ $card['level'] }}</div>
                        <div class="card-hd-sub">{{ $card['subtitle'] }}</div>
                        <div class="count-pill">
                            <span style="width:8px;height:8px;border-radius:50%;background:#facc15;animation:pulse-s 1.5s ease-in-out infinite;flex-shrink:0;display:inline-block;"></span>
                            {{ $count }} Materi Tersedia
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div style="flex:1;padding:1.75rem 2rem;display:flex;flex-direction:column;gap:1.25rem;">

                    {{-- Deskripsi --}}
                    <p style="color:#4b5563;font-size:.875rem;line-height:1.7;margin:0;">
                        {{ $card['desc'] }}
                    </p>

                    {{-- Tag highlights --}}
                    <div style="display:flex;flex-wrap:wrap;gap:.5rem;">
                        @foreach($card['highlights'] as $tag)
                        <span class="kelas-tag {{ $card['tag_class'] }}">
                            <span class="{{ $card['tag_dot'] }}"></span>
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>

                    {{-- Stat row --}}
                    <div class="stat-row">
                        <div style="display:flex;align-items:center;gap:.5rem;color:#6b7280;">
                            <svg class="{{ $card['icon_class'] }}" width="16" height="16" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span style="font-size:.82rem;">Total materi aktif</span>
                        </div>
                        <span style="font-size:1.25rem;font-weight:800;color:#111827;">{{ $count }}</span>
                    </div>

                    {{-- Tombol --}}
                    <a href="{{ route('layanan.category', ['category' => $card['category']]) }}"
                       class="btn-kelas {{ $card['btn_class'] }}">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Lihat Materi {{ $card['level'] }}
                        <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
