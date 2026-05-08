@extends('layouts.app')

@section('title', 'Bimbingan Konseling SMAN 3 Kediri')
@section('meta_description', 'Unit Bimbingan Konseling SMAN 3 Kediri – Tim konselor profesional, layanan konseling individu, karir, dan akademik.')

@push('head')
{{-- ══════════════════════════════════════════════════════════════════
     SWIPER.JS — Hero Slider
     Dokumentasi: https://swiperjs.com/
══════════════════════════════════════════════════════════════════ --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<style>
    /* ── Hero Slider ───────────────────────────────────────────────── */
    #hero-swiper {
        width: 100%;
        height: 90vh;
        min-height: 560px;
        max-height: 860px;
        position: relative;
    }

    .hero-slide {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    /* ── Gambar Latar Belakang Slide ─────────────────────────────────
       PETUNJUK PENGGANTIAN GAMBAR:
       Untuk mengganti gambar placeholder, ganti nilai 'background-image'
       pada setiap .hero-slide-N di bawah ini dengan URL gambar asli Anda.
       Contoh: background-image: url("{{ asset('images/hero-slide-1.jpg') }}");
    ──────────────────────────────────────────────────────────────── */
    .hero-slide-1 {
        background-image: url("{{ asset('images/gambar-slide1.JPG') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .hero-slide-2 {
        background-image: url("{{ asset('images/gambar-slide2.JPG') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .hero-slide-3 {
        background-image: url("{{ asset('images/gambar-slide3.JPG') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* ── Overlay gelap di atas setiap slide ──────────────────────── */
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(12, 8, 76, 0.55); /* Deep Navy #0C084C @ 55% */
        z-index: 1;
    }

    /* ── Konten teks di dalam slide ─────────────────────────────── */
    .hero-content {
        position: absolute;
        inset: 0;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 2rem 1.5rem;
        color: #fff;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        padding: .4rem 1.25rem;
        border-radius: 99px;
        background: rgba(255, 200, 30, .18);
        border: 1px solid rgba(255, 200, 30, .4);
        color: #FFC81E;
        margin-bottom: 1.25rem;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity .6s .1s ease, transform .6s .1s ease;
    }
    .hero-title {
        font-family: 'Merriweather', serif;
        font-size: clamp(2rem, 5.5vw, 3.75rem);
        font-weight: 700;
        line-height: 1.15;
        margin-bottom: 1rem;
        max-width: 800px;
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .6s .25s ease, transform .6s .25s ease;
    }
    .hero-title span { color: #FFC81E; }
    .hero-desc {
        font-size: clamp(.9rem, 2vw, 1.1rem);
        color: rgba(255, 255, 255, .8);
        max-width: 560px;
        line-height: 1.75;
        margin-bottom: 2rem;
        opacity: 0;
        transform: translateY(24px);
        transition: opacity .6s .4s ease, transform .6s .4s ease;
    }
    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity .6s .55s ease, transform .6s .55s ease;
    }

    /* Animasi masuk saat slide aktif */
    .swiper-slide-active .hero-badge,
    .swiper-slide-active .hero-title,
    .swiper-slide-active .hero-desc,
    .swiper-slide-active .hero-actions {
        opacity: 1;
        transform: translateY(0);
    }

    /* ── Tombol CTA ──────────────────────────────────────────────── */
    .btn-hero-primary {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .875rem 2rem;
        border-radius: .875rem;
        font-size: .925rem;
        font-weight: 700;
        background: #FFC81E;
        color: #0C084C;
        text-decoration: none;
        box-shadow: 0 6px 20px rgba(255, 200, 30, .4);
        transition: background .2s, transform .2s, box-shadow .2s;
    }
    .btn-hero-primary:hover {
        background: #ffd84d;
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(255, 200, 30, .5);
    }
    .btn-hero-secondary {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .875rem 2rem;
        border-radius: .875rem;
        font-size: .925rem;
        font-weight: 600;
        border: 2px solid rgba(255, 255, 255, .35);
        color: #fff;
        text-decoration: none;
        transition: background .2s, border-color .2s, transform .2s;
    }
    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .6);
        transform: translateY(-2px);
    }

    /* ── Swiper Navigation Arrows ────────────────────────────────── */
    .hero-swiper-prev,
    .hero-swiper-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
        transition: background .2s, transform .2s;
        user-select: none;
    }
    .hero-swiper-prev { left: 1.5rem; }
    .hero-swiper-next { right: 1.5rem; }
    .hero-swiper-prev:hover,
    .hero-swiper-next:hover {
        background: rgba(255, 200, 30, .25);
        border-color: rgba(255, 200, 30, .5);
        transform: translateY(-50%) scale(1.08);
    }
    .hero-swiper-prev.swiper-button-disabled,
    .hero-swiper-next.swiper-button-disabled { opacity: .35; pointer-events: none; }

    /* ── Swiper Pagination Dots ──────────────────────────────────── */
    .hero-pagination {
        position: absolute;
        bottom: 1.75rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        gap: .5rem;
        align-items: center;
    }
    .hero-pagination .swiper-pagination-bullet {
        width: 8px; height: 8px;
        border-radius: 99px;
        background: rgba(255, 255, 255, .4);
        border: none;
        cursor: pointer;
        transition: width .3s, background .3s;
        display: inline-block;
    }
    .hero-pagination .swiper-pagination-bullet-active {
        width: 28px;
        background: #FFC81E;
    }

    /* ── Scroll indicator ────────────────────────────────────────── */
    .scroll-indicator {
        position: absolute;
        bottom: 4rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .35rem;
        color: rgba(255,255,255,.5);
        font-size: .65rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        animation: scrollBounce 2s ease-in-out infinite;
    }
    @keyframes scrollBounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50%       { transform: translateX(-50%) translateY(6px); }
    }

    @media (max-width: 640px) {
        .hero-swiper-prev { left: .75rem; }
        .hero-swiper-next { right: .75rem; }
        .hero-swiper-prev, .hero-swiper-next { width: 40px; height: 40px; }
    }
</style>
@endpush

@section('content')

{{-- ═══ HERO SLIDER ══════════════════════════════════════════════════ --}}
<div style="position:relative;">
    <div class="swiper" id="hero-swiper">
        <div class="swiper-wrapper">

            {{-- ────────────────────────────────────────────────────────
                 SLIDE 1
                 Ganti class "hero-slide-1" background-image di <style>
                 dengan foto sekolah / gedung SMAN 3 Kediri.
            ──────────────────────────────────────────────────────────── --}}
            <div class="swiper-slide hero-slide hero-slide-1">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <span class="hero-badge">
                        <span style="width:6px;height:6px;border-radius:50%;background:#FFC81E;display:inline-block;"></span>
                        Portal Resmi BK SMAN 3 Kediri
                    </span>
                    <h1 class="hero-title">
                        Bimbingan &amp; Konseling<br>
                        <span>SMAN 3 Kediri</span>
                    </h1>
                    <p class="hero-desc">
                        Kami hadir sebagai mitra terpercaya setiap siswa dalam perjalanan akademik,
                        karir, dan kehidupan pribadi menuju potensi terbaik.
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('layanan') }}" class="btn-hero-primary">
                            Lihat Layanan Kami
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('tim-bk') }}" class="btn-hero-secondary">
                            Kenali Tim BK
                        </a>
                    </div>
                </div>
            </div>

            {{-- ────────────────────────────────────────────────────────
                 SLIDE 2
                 Ganti class "hero-slide-2" background-image di <style>
                 dengan foto kegiatan konseling / ruang BK.
            ──────────────────────────────────────────────────────────── --}}
            <div class="swiper-slide hero-slide hero-slide-2">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <span class="hero-badge">
                        <span style="width:6px;height:6px;border-radius:50%;background:#FFC81E;display:inline-block;"></span>
                        Layanan Bimbingan Klasikal
                    </span>
                    <h1 class="hero-title">
                        Materi Terstruktur<br>
                        untuk <span>Setiap Jenjang Kelas</span>
                    </h1>
                    <p class="hero-desc">
                        Program bimbingan klasikal dirancang khusus untuk Kelas 10, 11, dan 12
                        — dilengkapi media interaktif dan permainan edukatif.
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('layanan') }}" class="btn-hero-primary">
                            Jelajahi Materi
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ────────────────────────────────────────────────────────
                 SLIDE 3
                 Ganti class "hero-slide-3" background-image di <style>
                 dengan foto siswa atau kegiatan sekolah.
            ──────────────────────────────────────────────────────────── --}}
            <div class="swiper-slide hero-slide hero-slide-3">
                <div class="hero-overlay"></div>
                <div class="hero-content">
                    <span class="hero-badge">
                        <span style="width:6px;height:6px;border-radius:50%;background:#FFC81E;display:inline-block;"></span>
                        Konseling Pribadi &amp; Karir
                    </span>
                    <h1 class="hero-title">
                        Siap Meraih<br>
                        <span>Masa Depan Terbaik</span>
                    </h1>
                    <p class="hero-desc">
                        Tim konselor profesional kami siap mendampingi perjalanan akademik dan karir
                        setiap siswa — dari kelas 10 hingga lulus.
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('visi-misi') }}" class="btn-hero-primary">
                            Seputar BK
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('tim-bk') }}" class="btn-hero-secondary">
                            Kenali Tim BK
                        </a>
                    </div>
                </div>
            </div>

        </div>{{-- /swiper-wrapper --}}

        {{-- Navigasi Panah --}}
        <div class="hero-swiper-prev" id="hero-prev" aria-label="Slide sebelumnya">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </div>
        <div class="hero-swiper-next" id="hero-next" aria-label="Slide berikutnya">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
        </div>

        {{-- Pagination Dots --}}
        <div class="hero-pagination" id="hero-pagination"></div>

        {{-- Scroll indicator --}}
        <div class="scroll-indicator">
            <span>Gulir</span>
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
        </div>
    </div>
</div>




{{-- ═══ STATISTIK LAYANAN / MATERI ════════════════════════════════ --}}
<section class="py-12 relative -mt-6 z-20" style="background:#EEF7FF;">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Card Kelas 10 --}}
            <div class="bg-white rounded-2xl p-6 flex items-center justify-between hover:shadow-lg transition-all" style="border:1px solid rgba(12,8,76,.08);box-shadow:0 2px 12px rgba(12,8,76,.06);">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#0C084C;">Kelas 10</p>
                    <p class="text-gray-500 text-sm">Fondasi &amp; Adaptasi</p>
                </div>
                <div class="font-bold text-3xl px-4 py-3 rounded-xl" style="background:rgba(255,200,30,.12);color:#0C084C;">
                    <span>{{ $jumlahMateriKelas10 ?? 0 }}</span>
                </div>
            </div>

            {{-- Card Kelas 11 --}}
            <div class="bg-white rounded-2xl p-6 flex items-center justify-between hover:shadow-lg transition-all" style="border:1px solid rgba(12,8,76,.08);box-shadow:0 2px 12px rgba(12,8,76,.06);">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#0C084C;">Kelas 11</p>
                    <p class="text-gray-500 text-sm">Eksplorasi &amp; Karir</p>
                </div>
                <div class="font-bold text-3xl px-4 py-3 rounded-xl" style="background:rgba(255,200,30,.12);color:#0C084C;">
                    <span>{{ $jumlahMateriKelas11 ?? 0 }}</span>
                </div>
            </div>

            {{-- Card Kelas 12 --}}
            <div class="bg-white rounded-2xl p-6 flex items-center justify-between hover:shadow-lg transition-all" style="border:1px solid rgba(12,8,76,.08);box-shadow:0 2px 12px rgba(12,8,76,.06);">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#0C084C;">Kelas 12</p>
                    <p class="text-gray-500 text-sm">Persiapan &amp; Masa Depan</p>
                </div>
                <div class="font-bold text-3xl px-4 py-3 rounded-xl" style="background:rgba(255,200,30,.12);color:#0C084C;">
                    <span>{{ $jumlahMateriKelas12 ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ═══ FAQ ════════════════════ --}}
<section class="py-16 bg-white" x-data="{ open: null }">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="inline-block text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-3" style="background:rgba(255,200,30,.15);color:#0C084C;">FAQ</span>
            <h2 class="text-3xl font-bold" style="color:#0C084C;">Pertanyaan <span style="color:#FFC81E;-webkit-text-stroke:1px #0C084C;">Umum</span></h2>
            <p class="text-gray-500 mt-2 text-sm">Jawaban atas pertanyaan yang sering diajukan siswa seputar layanan BK.</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-3">
            @foreach([
                ['Apakah konseling bersifat rahasia?','Ya, sepenuhnya rahasia. Informasi yang disampaikan siswa kepada konselor tidak akan disebarluaskan tanpa izin, kecuali dalam kondisi yang membahayakan keselamatan.'],
                ['Bagaimana cara mendaftar konseling individu?','Datang langsung ke ruang BK di lantai 1 gedung utama, atau minta form pendaftaran dari wali kelas. Tidak diperlukan biaya apapun.'],
                ['Apakah orang tua harus hadir saat konseling?','Tidak harus. Siswa dapat datang sendiri. Orang tua dilibatkan hanya jika diperlukan dan atas persetujuan siswa.'],
                ['Apa itu Kotak Pesan Anonim?','Layanan pengaduan digital yang memungkinkan siswa menyampaikan masalah tanpa mengungkap identitas. Konselor akan merespons dalam 1×24 jam.'],
                ['Apakah ada bimbingan untuk persiapan SNBT/SNBP?','Ya, layanan Bimbingan Karir mencakup informasi jurusan, pemilihan PTN/PTS, strategi SNBT/SNBP, dan pencarian beasiswa.'],
            ] as $idx => [$q, $a])
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                <button @click="open === {{ $idx }} ? open = null : open = {{ $idx }}"
                        class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-gray-50 transition-colors"
                        :aria-expanded="open === {{ $idx }}">
                    <span class="font-semibold text-gray-800 text-sm pr-4">{{ $q }}</span>
                    <svg class="w-5 h-5 text-green-600 shrink-0 transition-transform duration-300"
                         :class="open === {{ $idx }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open === {{ $idx }}"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2">
                    <div class="px-6 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-50 pt-4">
                        {{ $a }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══ CTA KONTAK ══════════════════════════════════════════════════ --}}
<section class="py-20 text-white" style="background:#0C084C;">
    <div class="max-w-4xl mx-auto px-4 text-center">
        {{-- Dekorasi --}}
        <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-6" style="background:rgba(255,200,30,.15);color:#FFC81E;border:1px solid rgba(255,200,30,.25);">
            <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#FFC81E;"></span>
            Hubungi Kami
        </div>
        <h2 class="text-3xl md:text-4xl font-bold mb-4" style="color:#fff;">Siap Memulai Perjalananmu?</h2>
        <p class="mb-10 max-w-xl mx-auto leading-relaxed" style="color:#a5b4fc;">
            Tim BK SMAN 3 Kediri siap mendampingi kamu. Jangan ragu untuk datang — ruang kami selalu terbuka.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            {{-- CTA Utama: Golden Yellow --}}
            <a href="{{ route('layanan') }}"
               class="btn-ripple inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold shadow-lg transition-all text-sm"
               style="background:#FFC81E;color:#0C084C;"
               onmouseover="this.style.background='#ffd84d'" onmouseout="this.style.background='#FFC81E'">
                📋 Lihat Semua Layanan
            </a>
            {{-- CTA Sekunder --}}
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $contact->phone ?? '0354683809') }}"
               class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-semibold transition-all text-sm"
               style="border:2px solid rgba(255,255,255,.2);color:#EEF7FF;"
               onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'">
                📞 {{ $contact->phone ?? '(0354) 683809' }}
            </a>
        </div>
    </div>
</section>



@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const heroSwiper = new Swiper('#hero-swiper', {
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        loop: true,
        speed: 900,
        navigation: {
            prevEl: '#hero-prev',
            nextEl: '#hero-next',
        },
        pagination: {
            el: '#hero-pagination',
            clickable: true,
            bulletClass: 'swiper-pagination-bullet',
            bulletActiveClass: 'swiper-pagination-bullet-active',
        },
        a11y: {
            prevSlideMessage: 'Slide sebelumnya',
            nextSlideMessage: 'Slide berikutnya',
        },
    });
</script>
@endpush
