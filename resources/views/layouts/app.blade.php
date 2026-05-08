<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="@yield('meta_description', 'Website resmi SMA Negeri 3 Kediri – Layanan Bimbingan Konseling, informasi sekolah, dan program akademik unggulan.')">
    <meta name="keywords"    content="SMAN 3 Kediri, SMA Negeri 3 Kediri, Bimbingan Konseling, Kediri">
    <meta name="author"      content="SMA Negeri 3 Kediri">
    <meta property="og:title"       content="@yield('title', 'SMA Negeri 3 Kediri')">
    <meta property="og:description" content="@yield('meta_description', 'Website resmi SMA Negeri 3 Kediri')">
    <meta property="og:type"        content="website">

    <title>@yield('title', 'SMA Negeri 3 Kediri') – Portal Resmi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')

    <style>
        /* ── CSS Variables ─────────────────────────────────────────── */
        :root {
            --navy:      #0C084C;
            --navy-lt:   #1a1570;
            --gold:      #FFC81E;
            --gold-dk:   #e6b300;
            --soft-blue: #EEF7FF;
        }

        /* ── TOP NAVBAR ──────────────────────────────────────────────── */
        #top-navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 50;
            height: 68px;
            background: var(--navy);
            border-bottom: 1px solid rgba(255,255,255,.08);
            box-shadow: 0 4px 24px rgba(12,8,76,.35);
            display: flex;
            align-items: center;
        }
        .navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            width: 100%;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        /* Logo */
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            text-decoration: none;
            flex-shrink: 0;
        }
        .navbar-logo-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 2px 10px rgba(255,255,255,.2);
            flex-shrink: 0;
            overflow: hidden;
            padding: 3px;
        }
        .navbar-logo-icon span { color: var(--navy); font-weight: 900; font-size: 1.1rem; line-height: 1; }
        .navbar-logo-text p:first-child {
            font-size: .6rem; font-weight: 700; color: #c7d2fe;
            text-transform: uppercase; letter-spacing: .1em; line-height: 1; margin: 0 0 .15rem;
        }
        .navbar-logo-text p:last-child {
            font-size: .9rem; font-weight: 800; color: #fff; line-height: 1.1; margin: 0;
        }

        /* Desktop Nav Links */
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 0.15rem;
            list-style: none;
            margin: 0; padding: 0;
        }
        .navbar-links a {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .5rem 1rem;
            border-radius: .625rem;
            font-size: .875rem;
            font-weight: 600;
            color: #e0e7ff;
            text-decoration: none;
            transition: background .2s, color .2s;
            white-space: nowrap;
        }
        .navbar-links a:hover {
            color: var(--gold);
            background: rgba(255,200,30,.08);
        }
        .navbar-links a.active {
            background: rgba(255,200,30,.15);
            color: var(--gold);
            font-weight: 700;
        }
        .navbar-links a .nav-dot {
            width: 5px; height: 5px; border-radius: 50%;
            background: var(--gold);
            display: none;
            flex-shrink: 0;
        }
        .navbar-links a.active .nav-dot { display: inline-block; }

        /* Mobile hamburger */
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            padding: .5rem;
            border-radius: .5rem;
            cursor: pointer;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.1);
            transition: background .15s;
        }
        .nav-hamburger:hover { background: rgba(255,200,30,.15); }
        .nav-hamburger span {
            display: block;
            width: 22px; height: 2px;
            background: #EEF7FF;
            border-radius: 4px;
            transition: transform .25s, opacity .25s;
        }

        /* Mobile menu */
        #mobile-menu {
            display: none;
            position: fixed;
            top: 68px; left: 0; right: 0;
            background: var(--navy);
            border-bottom: 1px solid rgba(255,255,255,.08);
            box-shadow: 0 8px 24px rgba(12,8,76,.4);
            z-index: 49;
            padding: .75rem 1.5rem 1.25rem;
        }
        #mobile-menu.open { display: block; }
        #mobile-menu a {
            display: flex;
            align-items: center;
            gap: .6rem;
            padding: .75rem 1rem;
            border-radius: .75rem;
            font-size: .9rem;
            font-weight: 600;
            color: #e0e7ff;
            text-decoration: none;
            transition: background .15s, color .15s;
        }
        #mobile-menu a:hover { background: rgba(255,200,30,.1); color: var(--gold); }
        #mobile-menu a.active { background: rgba(255,200,30,.15); color: var(--gold); font-weight: 700; }

        @media (max-width: 768px) {
            .navbar-links { display: none; }
            .nav-hamburger { display: flex; }
        }

        /* ── PAGE BODY ──────────────────────────────────────────────── */
        body {
            background: var(--soft-blue);
            padding-top: 68px;
        }
    </style>
</head>
<body class="font-sans text-gray-800 antialiased">

    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    {{--  TOP NAVBAR                                                         --}}
    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    <nav id="top-navbar" role="navigation" aria-label="Navigasi utama">
        <div class="navbar-inner">

            {{-- Logo --}}
            <a href="{{ route('beranda') }}" class="navbar-logo">
                <div class="navbar-logo-icon" style="background:transparent;box-shadow:none;overflow:hidden;padding:2px;">
                    {{-- Logo sekolah: ganti logo-sman3.png di public/images/ --}}
                    <img src="{{ asset('images/logo-sman3.png') }}"
                         id="navbar-logo-img"
                         onerror="this.style.display='none';document.getElementById('navbar-logo-fallback').style.display='flex'"
                         alt="Logo SMAN 3 Kediri"
                         style="width:36px;height:36px;object-fit:contain;display:block;">
                    <span id="navbar-logo-fallback"
                          style="display:none;width:36px;height:36px;border-radius:10px;background:#FFC81E;color:#0C084C;font-weight:900;font-size:1.1rem;align-items:center;justify-content:center;">3</span>
                </div>
                <div class="navbar-logo-text">
                    <p>Bimbingan Konseling</p>
                    <p>SMAN 3 Kediri</p>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <ul class="navbar-links">
                <li>
                    <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">
                        <span class="nav-dot"></span>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('visi-misi') }}" class="{{ request()->routeIs('visi-misi') ? 'active' : '' }}">
                        <span class="nav-dot"></span>
                        Seputar BK
                    </a>
                </li>
                <li>
                    <a href="{{ route('tim-bk') }}" class="{{ request()->routeIs('tim-bk') ? 'active' : '' }}">
                        <span class="nav-dot"></span>
                        Tim BK
                    </a>
                </li>
                <li>
                    <a href="{{ route('layanan') }}" class="{{ request()->routeIs('layanan*') ? 'active' : '' }}">
                        <span class="nav-dot"></span>
                        Layanan
                    </a>
                </li>
            </ul>

            {{-- Mobile Hamburger --}}
            <button class="nav-hamburger" id="hamburger-btn"
                    onclick="toggleMobileMenu()"
                    aria-label="Toggle menu"
                    aria-expanded="false"
                    aria-controls="mobile-menu">
                <span id="hb-top"></span>
                <span id="hb-mid"></span>
                <span id="hb-bot"></span>
            </button>
        </div>
    </nav>

    {{-- Mobile Dropdown Menu --}}
    <div id="mobile-menu" role="menu">
        <a href="{{ route('beranda') }}"  class="{{ request()->routeIs('beranda')   ? 'active' : '' }}">🏠 Beranda</a>
        <a href="{{ route('visi-misi') }}" class="{{ request()->routeIs('visi-misi') ? 'active' : '' }}">🎯 Seputar BK</a>
        <a href="{{ route('tim-bk') }}"  class="{{ request()->routeIs('tim-bk')    ? 'active' : '' }}">👨‍🏫 Tim BK</a>
        <a href="{{ route('layanan') }}"  class="{{ request()->routeIs('layanan*')  ? 'active' : '' }}">📋 Layanan</a>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    {{--  KONTEN UTAMA                                                       --}}
    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    <main>
        @yield('content')
    </main>

    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    {{--  FOOTER                                                             --}}
    {{-- ═══════════════════════════════════════════════════════════════════ --}}
    <footer style="background:#0C084C;color:#e0e7ff;flex-shrink:0;">

        {{-- Garis Aksen Atas --}}
        <div style="height:4px;background:linear-gradient(90deg,#0C084C,#FFC81E,#0C084C);"></div>

        {{-- Badan Footer --}}
        <div style="max-width:1280px;margin:0 auto;padding:3.5rem 1.5rem 2.5rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:2.5rem;">

            {{-- Kolom 1: Branding --}}
            <div style="display:flex;flex-direction:column;gap:1rem;">
                <div style="display:flex;align-items:center;gap:.75rem;">
                    {{-- Logo sekolah footer --}}
                    <div style="width:48px;height:48px;border-radius:12px;background:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;padding:4px;overflow:hidden;">
                        <img src="{{ asset('images/logo-sman3.png') }}"
                             id="footer-logo-img"
                             onerror="this.style.display='none';document.getElementById('footer-logo-fallback').style.display='flex'"
                             alt="Logo SMAN 3 Kediri"
                             style="width:40px;height:40px;object-fit:contain;display:block;">
                        <span id="footer-logo-fallback"
                              style="display:none;width:40px;height:40px;border-radius:8px;background:#FFC81E;color:#0C084C;font-weight:900;font-size:1.1rem;align-items:center;justify-content:center;">3</span>
                    </div>
                    <div>
                        <p style="font-size:.6rem;font-weight:700;color:#c7d2fe;text-transform:uppercase;letter-spacing:.1em;margin:0 0 .15rem;">Bimbingan Konseling</p>
                        <p style="font-size:.95rem;font-weight:800;color:#fff;margin:0;">SMAN 3 Kediri</p>
                    </div>
                </div>
                <p style="color:#c7d2fe;font-size:.85rem;line-height:1.7;margin:0;">
                    Mendampingi setiap siswa dalam perjalanan akademik, karir, dan kehidupan pribadi menuju potensi terbaik mereka.
                </p>
                <div style="display:flex;gap:.5rem;">
                    <a href="{{ $contact->instagram_link ?? '#' }}" target="_blank" aria-label="Instagram"
                       style="width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;"
                       onmouseover="this.style.background='#e1306c'" onmouseout="this.style.background='rgba(255,255,255,.1)'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="{{ $contact->youtube_link ?? '#' }}" target="_blank" aria-label="YouTube"
                       style="width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,.1);display:flex;align-items:center;justify-content:center;"
                       onmouseover="this.style.background='#ff0000'" onmouseout="this.style.background='rgba(255,255,255,.1)'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Navigasi --}}
            <div>
                <h3 style="font-size:.7rem;font-weight:700;color:#FFC81E;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;padding-bottom:.5rem;border-bottom:1px solid rgba(255,255,255,.08);">Navigasi</h3>
                <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:.6rem;">
                    @foreach([['beranda','Beranda'],['visi-misi','Seputar BK'],['tim-bk','Tim BK'],['layanan','Layanan BK']] as [$r,$l])
                    <li><a href="{{ route($r) }}" style="color:#e0e7ff;font-size:.875rem;text-decoration:none;display:flex;align-items:center;gap:.5rem;transition:color .15s;" onmouseover="this.style.color='#FFC81E'" onmouseout="this.style.color='#e0e7ff'">
                        <span style="width:5px;height:5px;border-radius:50%;background:#FFC81E;flex-shrink:0;display:inline-block;"></span>{{ $l }}
                    </a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Kolom 3: Lokasi --}}
            <div>
                <h3 style="font-size:.7rem;font-weight:700;color:#FFC81E;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;padding-bottom:.5rem;border-bottom:1px solid rgba(255,255,255,.08);">Lokasi</h3>
                <p style="color:#c7d2fe;font-size:.875rem;line-height:1.7;margin:0 0 .75rem;">
                    {{ $contact->address ?? 'Jl. Mauni No 88, Bangsal, Kec. Pesantren, Kota Kediri, Jawa Timur 64131' }}
                </p>
                <a href="https://maps.google.com/?q=SMAN+3+Kediri" target="_blank"
                   style="display:inline-flex;align-items:center;gap:.4rem;font-size:.78rem;font-weight:600;color:#FFC81E;text-decoration:none;">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat di Google Maps
                </a>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div>
                <h3 style="font-size:.7rem;font-weight:700;color:#FFC81E;text-transform:uppercase;letter-spacing:.1em;margin:0 0 1rem;padding-bottom:.5rem;border-bottom:1px solid rgba(255,255,255,.08);">Kontak</h3>
                <div style="display:flex;flex-direction:column;gap:.75rem;">
                    <div>
                        <p style="font-size:.65rem;font-weight:700;color:#a5b4fc;text-transform:uppercase;letter-spacing:.08em;margin:0 0 .2rem;">Telepon</p>
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $contact->phone ?? '0354683809') }}" style="color:#fff;font-size:.875rem;font-weight:600;text-decoration:none;">{{ $contact->phone ?? '(0354) 683809' }}</a>
                    </div>
                    <div>
                        <p style="font-size:.65rem;font-weight:700;color:#a5b4fc;text-transform:uppercase;letter-spacing:.08em;margin:0 0 .2rem;">Email</p>
                        <a href="mailto:{{ $contact->email ?? 'sman3kdr@sman3kediri.sch.id' }}" style="color:#fff;font-size:.875rem;font-weight:600;text-decoration:none;word-break:break-all;">{{ $contact->email ?? 'sman3kdr@sman3kediri.sch.id' }}</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div style="border-top:1px solid rgba(255,255,255,.08);padding:1rem 1.5rem;">
            <div style="max-width:1280px;margin:0 auto;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.5rem;">
                <p style="font-size:.78rem;color:#818cf8;margin:0;">© {{ date('Y') }} <span style="color:#fff;font-weight:600;">{{ $contact->school_name ?? 'BK SMAN 3 Kediri' }}</span>. Semua hak dilindungi.</p>
                <p style="font-size:.78rem;color:#818cf8;margin:0;">Dikembangkan oleh <span style="color:#FFC81E;font-weight:600;">Tim IT SMAN 3 Kediri</span></p>
            </div>
        </div>
    </footer>

    {{-- Back to Top --}}
    <button id="back-to-top" aria-label="Kembali ke atas"
            style="position:fixed;bottom:1.5rem;right:1.5rem;width:44px;height:44px;border-radius:50%;background:#166534;color:#fff;border:none;cursor:pointer;box-shadow:0 4px 16px rgba(22,101,52,.4);display:flex;align-items:center;justify-content:center;opacity:0;visibility:hidden;transition:all .3s;z-index:40;"
            onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#166534'">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    @stack('scripts')
    <script>
    // ─── Mobile Menu Toggle ──────────────────────────────────────────────────
    let mobileMenuOpen = false;

    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const btn  = document.getElementById('hamburger-btn');
        mobileMenuOpen = !mobileMenuOpen;

        if (mobileMenuOpen) {
            menu.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
        } else {
            menu.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
        }
    }

    // Close mobile menu on route change (link click)
    document.querySelectorAll('#mobile-menu a').forEach(a => {
        a.addEventListener('click', () => {
            document.getElementById('mobile-menu').classList.remove('open');
            mobileMenuOpen = false;
        });
    });

    // ─── Back to Top ─────────────────────────────────────────────────────────
    (() => {
        const btt = document.getElementById('back-to-top');
        if (!btt) return;
        window.addEventListener('scroll', () => {
            const past = window.scrollY > 300;
            btt.style.opacity    = past ? '1' : '0';
            btt.style.visibility = past ? 'visible' : 'hidden';
        });
        btt.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    })();
    </script>
</body>
</html>
