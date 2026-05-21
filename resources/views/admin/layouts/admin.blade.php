<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – BK SMAN 3 Kediri</title>
    <meta name="description" content="Panel Admin Bimbingan Konseling SMAN 3 Kediri">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            /* ── Brand Palette (Deep Navy + Gold) ── */
            --navy:      #0C084C;
            --navy-lt:   #1a1570;
            --navy-dk:   #07052e;
            --gold:      #FFC81E;
            --gold-dk:   #e6b300;
            --soft-blue: #EEF7FF;

            /* ── Neutrals ── */
            --gray-50:   #f9fafb;
            --gray-100:  #f3f4f6;
            --gray-200:  #e5e7eb;
            --gray-300:  #d1d5db;
            --gray-400:  #9ca3af;
            --gray-500:  #6b7280;
            --gray-600:  #4b5563;
            --gray-700:  #374151;
            --gray-800:  #1f2937;
            --gray-900:  #111827;

            /* ── Semantic ── */
            --red-50:    #fef2f2;
            --red-100:   #fee2e2;
            --red-500:   #ef4444;
            --red-600:   #dc2626;
            --red-700:   #b91c1c;

            --sidebar-w: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--soft-blue);
            color: var(--gray-800);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--navy);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            border-right: 1px solid rgba(255,255,255,.05);
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand .school-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .6rem;
            margin-bottom: .75rem;
        }
        .sidebar-brand .school-badge .logo-wrap {
            width: 80px; height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            padding: 6px;
            flex-shrink: 0;
            box-shadow: 0 4px 20px rgba(255,200,30,.35), 0 0 0 3px rgba(255,200,30,.25);
        }
        .sidebar-brand .school-badge .num {
            width: 80px; height: 80px;
            background: var(--gold);
            border-radius: 50%;
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--navy);
            display: none; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 20px rgba(255,200,30,.35);
        }
        .sidebar-brand .school-badge span { color: #c7d2fe; font-size: .72rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; }
        .sidebar-brand h1 { color: #fff; font-size: 1rem; font-weight: 800; line-height: 1.2; text-align: center; }
        .sidebar-brand p  { color: rgba(255,255,255,.45); font-size: .72rem; margin-top: .2rem; text-align: center; }

        .sidebar-nav { padding: 1rem .75rem; flex: 1; }
        .nav-label {
            color: rgba(255,255,255,.35);
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: .75rem .5rem .4rem;
        }
        .nav-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .625rem .75rem;
            border-radius: .625rem;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            transition: all .15s;
            margin-bottom: .15rem;
        }
        .nav-item:hover { background: rgba(255,200,30,.1); color: var(--gold); }
        .nav-item.active { background: rgba(255,200,30,.18); color: var(--gold); font-weight: 700; }
        .nav-item svg { opacity: .7; flex-shrink: 0; }
        .nav-item.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 1rem .75rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .user-card {
            display: flex; align-items: center; gap: .75rem;
            padding: .75rem;
            background: rgba(255,255,255,.07);
            border-radius: .75rem;
            border: 1px solid rgba(255,255,255,.08);
        }
        .user-avatar {
            width: 36px; height: 36px;
            background: var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: .875rem; color: var(--navy);
            flex-shrink: 0;
        }
        .user-card .user-name  { color: #fff; font-size: .8rem; font-weight: 600; line-height: 1; }
        .user-card .user-role  { color: rgba(255,255,255,.45); font-size: .7rem; margin-top: .2rem; }
        .logout-btn {
            display: flex; align-items: center; justify-content: center;
            margin-left: auto;
            width: 30px; height: 30px;
            background: rgba(255,255,255,.1);
            border: none; border-radius: .5rem;
            cursor: pointer; color: rgba(255,255,255,.6);
            transition: all .15s;
            flex-shrink: 0;
        }
        .logout-btn:hover { background: rgba(239,68,68,.3); color: #fff; }

        /* ── Main Content ───────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            padding: .875rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
            box-shadow: 0 1px 4px rgba(12,8,76,.06);
        }
        .topbar .page-title { font-size: 1.125rem; font-weight: 700; color: var(--navy); }
        .topbar .breadcrumb { display: flex; align-items: center; gap: .5rem; font-size: .8rem; color: var(--gray-400); margin-top: .15rem; }
        .topbar .breadcrumb a { color: var(--navy-lt); text-decoration: none; font-weight: 600; }
        .topbar .breadcrumb a:hover { color: var(--navy); }
        .topbar-actions { display: flex; align-items: center; gap: .75rem; }

        .content { padding: 2rem; flex: 1; }

        /* ── Alerts ─────────────────────────────────── */
        .alert {
            display: flex; align-items: flex-start; gap: .75rem;
            padding: .875rem 1.125rem;
            border-radius: .75rem;
            border: 1px solid transparent;
            margin-bottom: 1.5rem;
            font-size: .875rem;
        }
        .alert-success { background: rgba(255,200,30,.08); border-color: rgba(255,200,30,.3); color: var(--navy); }
        .alert-error   { background: var(--red-50);        border-color: var(--red-100);       color: var(--red-700); }

        /* ── Buttons ─────────────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .5rem 1rem;
            border-radius: .625rem;
            font-size: .875rem; font-weight: 600;
            text-decoration: none; border: none; cursor: pointer;
            transition: all .15s;
            line-height: 1.4;
        }
        .btn-primary   { background: var(--navy); color: #fff; }
        .btn-primary:hover { background: var(--navy-lt); box-shadow: 0 2px 12px rgba(12,8,76,.3); }
        .btn-secondary { background: #fff; color: var(--gray-700); border: 1px solid var(--gray-200); }
        .btn-secondary:hover { background: var(--gray-50); border-color: var(--gray-300); }
        .btn-danger    { background: var(--red-50); color: var(--red-600); border: 1px solid var(--red-100); }
        .btn-danger:hover { background: var(--red-100); }
        .btn-gold      { background: var(--gold); color: var(--navy); font-weight: 700; }
        .btn-gold:hover { background: var(--gold-dk); box-shadow: 0 2px 12px rgba(255,200,30,.4); }
        .btn-sm { padding: .35rem .75rem; font-size: .8rem; }
        .btn-icon { width: 34px; height: 34px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: .5rem; }

        /* ── Cards ───────────────────────────────────── */
        .card {
            background: #fff;
            border-radius: 1rem;
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(12,8,76,.05);
        }
        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h2 { font-size: 1rem; font-weight: 700; color: var(--navy); }
        .card-body { padding: 1.5rem; }

        /* ── Table ───────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            text-align: left;
            padding: .75rem 1rem;
            font-size: .75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .06em;
            color: var(--gray-500);
            background: var(--soft-blue);
            border-bottom: 1px solid var(--gray-200);
        }
        tbody td {
            padding: .875rem 1rem;
            font-size: .875rem;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: rgba(12,8,76,.02); }

        /* ── Badges ──────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: .3rem;
            padding: .25rem .625rem;
            border-radius: 99px;
            font-size: .72rem; font-weight: 700;
        }
        .badge-green  { background: rgba(255,200,30,.12); color: var(--navy); }
        .badge-gray   { background: var(--gray-100);      color: var(--gray-500); }
        .badge-yellow { background: rgba(255,200,30,.2);  color: #92640a; }
        .badge-dot { width: 6px; height: 6px; border-radius: 50%; }

        /* ── Forms ───────────────────────────────────── */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-size: .875rem; font-weight: 600;
            color: var(--navy);
            margin-bottom: .4rem;
        }
        .form-label .required { color: var(--red-500); margin-left: .15rem; }
        .form-control {
            width: 100%;
            padding: .625rem .875rem;
            border: 1px solid var(--gray-300);
            border-radius: .625rem;
            font-size: .9rem;
            color: var(--gray-800);
            font-family: inherit;
            transition: border-color .15s, box-shadow .15s;
            background: #fff;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--navy-lt);
            box-shadow: 0 0 0 3px rgba(12,8,76,.1);
        }
        .form-control.error { border-color: var(--red-500); }
        textarea.form-control { resize: vertical; min-height: 110px; }
        select.form-control { appearance: none; cursor: pointer; }
        .form-hint { font-size: .78rem; color: var(--gray-400); margin-top: .35rem; }
        .form-error { font-size: .78rem; color: var(--red-600); margin-top: .35rem; font-weight: 500; }

        /* File upload */
        .file-upload-area {
            border: 2px dashed var(--gray-300);
            border-radius: .75rem;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all .2s;
            background: var(--gray-50);
        }
        .file-upload-area:hover { border-color: var(--navy-lt); background: var(--soft-blue); }
        .file-upload-area input[type="file"] { display: none; }
        .file-upload-area p { font-size: .875rem; color: var(--gray-500); margin-top: .5rem; }
        .file-upload-area .file-name { font-weight: 600; color: var(--navy); }

        /* Toggle switch */
        .toggle-wrap { display: flex; align-items: center; gap: .75rem; }
        .toggle { position: relative; width: 44px; height: 24px; flex-shrink: 0; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; inset: 0;
            background: var(--gray-300);
            border-radius: 99px;
            cursor: pointer;
            transition: .2s;
        }
        .toggle-slider:before {
            content: '';
            position: absolute;
            width: 18px; height: 18px;
            left: 3px; top: 3px;
            background: #fff;
            border-radius: 50%;
            transition: .2s;
        }
        .toggle input:checked + .toggle-slider { background: var(--navy); }
        .toggle input:checked + .toggle-slider:before { transform: translateX(20px); }

        /* Form grid */
        .form-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }

        /* Pagination */
        .pagination { display: flex; gap: .35rem; align-items: center; justify-content: center; margin-top: 1.5rem; }
        .pagination a, .pagination span {
            padding: .4rem .75rem; border-radius: .5rem;
            font-size: .825rem; font-weight: 500;
            text-decoration: none;
            border: 1px solid var(--gray-200);
            color: var(--gray-600);
        }
        .pagination a:hover { background: var(--soft-blue); border-color: rgba(12,8,76,.15); color: var(--navy); }
        .pagination .active { background: var(--navy); color: #fff; border-color: var(--navy); }

        /* Stats card */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        .stat-card {
            background: #fff; border: 1px solid var(--gray-200);
            border-radius: .875rem; padding: 1.25rem 1.5rem;
            display: flex; align-items: center; gap: 1rem;
            box-shadow: 0 1px 4px rgba(12,8,76,.05);
            transition: box-shadow .2s;
        }
        .stat-card:hover { box-shadow: 0 4px 16px rgba(12,8,76,.1); }
        .stat-icon {
            width: 48px; height: 48px; border-radius: .75rem;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 1.5rem;
        }
        .stat-value { font-size: 1.75rem; font-weight: 800; color: var(--navy); line-height: 1; }
        .stat-label { font-size: .8rem; color: var(--gray-500); margin-top: .25rem; }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
        }

        /* ── Upload Progress Overlay ────────────────── */
        #upload-overlay {
            position: fixed;
            inset: 0;
            background: rgba(12, 8, 76, 0.85);
            backdrop-filter: blur(8px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #fff;
            transition: opacity 0.3s ease;
        }
        .progress-circle-wrap {
            position: relative;
            width: 140px;
            height: 140px;
            margin-bottom: 2rem;
        }
        .progress-circle-svg {
            transform: rotate(-90deg);
            width: 100%;
            height: 100%;
        }
        .progress-circle-bg {
            fill: none;
            stroke: rgba(255, 255, 255, 0.1);
            stroke-width: 8;
        }
        .progress-circle-bar {
            fill: none;
            stroke: var(--gold);
            stroke-width: 8;
            stroke-linecap: round;
            stroke-dasharray: 377;
            stroke-dashoffset: 377;
            transition: stroke-dashoffset 0.1s linear;
        }
        .progress-percentage {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gold);
        }
        .upload-text {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }
        .upload-subtext {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
        }

        @keyframes pulse-gold {
            0% { opacity: 1; }
            50% { opacity: 0.6; }
            100% { opacity: 1; }
        }
        .upload-text.animating { animation: pulse-gold 1.5s infinite; }
    </style>
</head>
<body>

{{-- ── Sidebar ── --}}
<aside class="sidebar">
    <div class="sidebar-brand" style="text-align:center;">
        <div class="school-badge">
            <div class="logo-wrap">
                <img src="{{ asset('images/logo-sman3.png') }}"
                     id="sidebar-logo"
                     onerror="this.closest('.logo-wrap').style.display='none';document.getElementById('sidebar-logo-fallback').style.display='flex'"
                     alt="Logo SMAN 3 Kediri"
                     style="width:68px;height:68px;object-fit:contain;display:block;">
            </div>
            <span id="sidebar-logo-fallback" class="num" style="display:none;">3</span>
            <span>SMAN 3 Kediri</span>
        </div>
        <h1>Panel Admin BK</h1>
        <p>Bimbingan &amp; Konseling</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>
        <a href="{{ route('admin.materials.index') }}"
           class="nav-item {{ request()->routeIs('admin.materials.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Materi BK
        </a>
        <a href="{{ route('admin.counselors.index') }}"
           class="nav-item {{ request()->routeIs('admin.counselors.*') ? 'active' : '' }}">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Tim BK
        </a>

        <div class="nav-label" style="margin-top:.5rem;">Lihat Website</div>
        <a href="{{ route('layanan') }}" target="_blank" class="nav-item">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            Halaman Layanan
        </a>
        <a href="{{ url('/') }}" target="_blank" class="nav-item">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Beranda
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="user-role">Administrator</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin-left:auto;">
                @csrf
                <button type="submit" class="logout-btn" title="Logout">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- ── Main ── --}}
<div class="main">

    {{-- Topbar --}}
    <div class="topbar">
        <div>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Admin</a>
                <span>/</span>
                @yield('breadcrumb', 'Dashboard')
            </div>
        </div>
        <div class="topbar-actions">
            @yield('topbar-actions')
        </div>
    </div>

    {{-- Content --}}
    <div class="content">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="alert alert-success">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </div>
</div>

{{-- ── Global Upload Overlay ── --}}
<div id="upload-overlay">
    <div class="progress-circle-wrap">
        <svg class="progress-circle-svg" viewBox="0 0 130 130">
            <circle class="progress-circle-bg" cx="65" cy="65" r="60"></circle>
            <circle id="progress-bar" class="progress-circle-bar" cx="65" cy="65" r="60"></circle>
        </svg>
        <div id="progress-text" class="progress-percentage">0%</div>
    </div>
    <div class="upload-text animating">Sedang Mengunggah...</div>
    <div id="upload-file-info" class="upload-subtext">Mohon tunggu sebentar</div>
</div>

<script>
    /**
     * Menangani form submission dengan progress bar
     */
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form[enctype="multipart/form-data"]');
        const overlay = document.getElementById('upload-overlay');
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        const fileInfo = document.getElementById('upload-file-info');
        const uploadText = document.querySelector('.upload-text');

        const circumference = 2 * Math.PI * 60; // r=60

        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // Hanya aktif jika ada file yang dipilih pada input file
                const fileInputs = form.querySelectorAll('input[type="file"]');
                let hasFile = false;
                fileInputs.forEach(input => {
                    if (input.files.length > 0) hasFile = true;
                });

                if (!hasFile) return; // Jalankan submit standar jika tidak ada file baru

                e.preventDefault();

                // Disable submit button untuk mencegah double click
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) submitBtn.disabled = true;

                const formData = new FormData(form);
                const xhr = new XMLHttpRequest();

                // Reset UI
                overlay.style.display = 'flex';
                progressBar.style.strokeDashoffset = circumference;
                progressText.innerText = '0%';
                uploadText.innerText = 'Sedang Mengunggah...';

                // Ambil nama file pertama untuk info
                let activeFileName = '';
                fileInputs.forEach(input => {
                    if (input.files.length > 0) activeFileName = input.files[0].name;
                });
                fileInfo.innerText = activeFileName;

                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percent = Math.round((e.loaded / e.total) * 100);
                        const offset = circumference - (percent / 100 * circumference);
                        progressBar.style.strokeDashoffset = offset;
                        progressText.innerText = percent + '%';

                        if (percent === 100) {
                            uploadText.innerText = 'Memproses data...';
                        }
                    }
                });

                xhr.addEventListener('load', function() {
                    const finalUrl   = xhr.responseURL;
                    const formAction = form.action;

                    // XHR otomatis follow redirect. Jika URL akhir berbeda dari action form
                    // berarti server sudah redirect (sukses) → ikuti URL tersebut.
                    if (finalUrl && finalUrl !== formAction) {
                        window.location.href = finalUrl;
                        return;
                    }

                    // Status 2xx tanpa redirect juga dianggap sukses
                    if (xhr.status >= 200 && xhr.status < 300) {
                        window.location.href = finalUrl || form.action;
                        return;
                    }

                    // Status 422 (validation error)
                    if (xhr.status === 422) {
                        overlay.style.display = 'none';
                        if (submitBtn) submitBtn.disabled = false;
                        
                        try {
                            const response = JSON.parse(xhr.responseText);
                            let errorMessages = '';
                            if (response.errors) {
                                for (let field in response.errors) {
                                    errorMessages += '- ' + response.errors[field].join('\n- ') + '\n';
                                }
                            } else if (response.message) {
                                errorMessages = response.message;
                            }
                            alert('Gagal menyimpan. Terdapat kesalahan:\n\n' + errorMessages);
                        } catch (e) {
                            alert('Terjadi kesalahan validasi, periksa kembali isian form Anda.');
                        }
                        return;
                    }

                    // Status 4xx/5xx lainnya
                    if (xhr.status >= 400) {
                        overlay.style.display = 'none';
                        if (submitBtn) submitBtn.disabled = false;
                        alert('Terjadi kesalahan pada server (Error ' + xhr.status + '). Silakan coba lagi.');
                        return;
                    }
                });

                xhr.addEventListener('error', function() {
                    overlay.style.display = 'none';
                    if (submitBtn) submitBtn.disabled = false;
                    alert('Koneksi terputus saat mengunggah.');
                });

                xhr.open('POST', form.action);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.send(formData);
            });
        });
    });
</script>

@stack('scripts')
</body>
</html>
