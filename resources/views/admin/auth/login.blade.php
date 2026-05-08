<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – BK SMAN 3 Kediri</title>
    <meta name="description" content="Login Panel Admin Bimbingan Konseling SMAN 3 Kediri">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:      #0C084C;
            --navy-lt:   #1a1570;
            --navy-dk:   #07052e;
            --gold:      #FFC81E;
            --red-500:   #ef4444;
            --red-50:    #fef2f2;
            --red-100:   #fee2e2;
            --red-600:   #dc2626;
            --gray-100:  #f3f4f6;
            --gray-200:  #e5e7eb;
            --gray-300:  #d1d5db;
            --gray-400:  #9ca3af;
            --gray-500:  #6b7280;
            --gray-600:  #4b5563;
            --gray-700:  #374151;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--navy-dk);
            overflow: hidden;
        }

        /* ── Latar animasi partikel ────────────────────── */
        .bg-decoration {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }
        .bg-decoration::before {
            content: '';
            position: absolute;
            top: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(26,21,112,.5) 0%, transparent 70%);
            border-radius: 50%;
            animation: float1 8s ease-in-out infinite;
        }
        .bg-decoration::after {
            content: '';
            position: absolute;
            bottom: -20%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,200,30,.12) 0%, transparent 70%);
            border-radius: 50%;
            animation: float2 10s ease-in-out infinite;
        }
        .bg-circle-3 {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(12,8,76,.4) 0%, transparent 60%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        @keyframes float1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(30px, 40px) scale(1.08); }
        }
        @keyframes float2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(-40px, -30px) scale(1.06); }
        }

        /* ── Wrapper ────────────────────────────────────── */
        .page {
            position: relative;
            z-index: 1;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* ── Card Login ─────────────────────────────────── */
        .login-card {
            background: rgba(255,255,255,.97);
            border-radius: 1.5rem;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,.4), 0 0 0 1px rgba(255,255,255,.1);
        }

        /* ── Card Header ────────────────────────────────── */
        .card-header {
            background: linear-gradient(135deg, var(--navy-dk) 0%, var(--navy) 60%, var(--navy-lt) 100%);
            padding: 2.5rem 2rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: -30px; right: -30px;
            width: 120px; height: 120px;
            background: rgba(255,255,255,.07);
            border-radius: 50%;
        }
        .card-header::after {
            content: '';
            position: absolute;
            bottom: -20px; left: -20px;
            width: 80px; height: 80px;
            background: rgba(255,255,255,.05);
            border-radius: 50%;
        }
        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 99px;
            padding: .3rem .75rem .3rem .3rem;
            margin-bottom: 1.25rem;
        }
        .brand-badge .logo-img-wrap {
            width: 30px; height: 30px;
            background: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            padding: 2px;
        }
        .brand-badge .num {
            width: 30px; height: 30px;
            background: var(--gold);
            border-radius: 50%;
            font-size: .8rem;
            font-weight: 900;
            color: var(--navy);
            display: none; align-items: center; justify-content: center;
        }
        .brand-badge span { color: rgba(255,255,255,.9); font-size: .78rem; font-weight: 600; }
        .card-header h1 { color: #fff; font-size: 1.6rem; font-weight: 800; position: relative; z-index: 1; }
        .card-header p  { color: rgba(255,255,255,.65); font-size: .82rem; margin-top: .4rem; position: relative; z-index: 1; }

        /* ── Card Body ──────────────────────────────────── */
        .card-body { padding: 2rem; }

        /* ── Alert ──────────────────────────────────────── */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: .65rem;
            padding: .875rem 1rem;
            border-radius: .75rem;
            margin-bottom: 1.5rem;
            font-size: .85rem;
        }
        .alert-error {
            background: var(--red-50);
            border: 1px solid var(--red-100);
            color: var(--red-600);
        }
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: var(--green-700);
        }

        /* ── Form ───────────────────────────────────────── */
        .form-group { margin-bottom: 1.125rem; }
        .form-label {
            display: block;
            font-size: .82rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: .4rem;
            letter-spacing: .01em;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: .875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: .7rem .875rem .7rem 2.75rem;
            border: 1.5px solid var(--gray-200);
            border-radius: .75rem;
            font-size: .9rem;
            color: #111827;
            font-family: inherit;
            transition: border-color .15s, box-shadow .15s, background .15s;
            background: #fafafa;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--navy-lt);
            box-shadow: 0 0 0 3px rgba(12,8,76,.1);
            background: #fff;
        }
        .form-input.error {
            border-color: var(--red-500);
            background: var(--red-50);
        }
        .form-input.error:focus {
            box-shadow: 0 0 0 3px rgba(239,68,68,.1);
        }
        .form-error {
            display: flex;
            align-items: center;
            gap: .35rem;
            font-size: .775rem;
            color: var(--red-600);
            margin-top: .35rem;
            font-weight: 500;
        }

        /* Toggle password visibility */
        .toggle-pw {
            position: absolute;
            right: .875rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--gray-400);
            padding: .2rem;
            border-radius: .375rem;
            transition: color .15s;
        }
        .toggle-pw:hover { color: var(--navy); }

        /* Remember me */
        .remember-row {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: 1.5rem;
        }
        .remember-row input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--navy);
            cursor: pointer;
        }
        .remember-row label {
            font-size: .83rem;
            color: var(--gray-600);
            cursor: pointer;
            user-select: none;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: .8rem;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-lt) 100%);
            color: #fff;
            border: none;
            border-radius: .875rem;
            font-size: .95rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(12,8,76,.3);
            letter-spacing: .01em;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, var(--navy-lt) 0%, var(--navy-dk) 100%);
            box-shadow: 0 6px 20px rgba(12,8,76,.4);
            transform: translateY(-1px);
        }
        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(12,8,76,.2);
        }
        .btn-login:disabled {
            opacity: .7;
            cursor: not-allowed;
            transform: none;
        }

        /* Card Footer */
        .card-footer {
            padding: 1rem 2rem 1.5rem;
            text-align: center;
            border-top: 1px solid var(--gray-100);
        }
        .card-footer a {
            font-size: .82rem;
            color: var(--navy-lt);
            text-decoration: none;
            font-weight: 600;
        }
        .card-footer a:hover { color: var(--navy); text-decoration: underline; }
        .card-footer span { color: var(--gray-400); font-size: .82rem; }
    </style>
</head>
<body>

<div class="bg-decoration"></div>
<div class="bg-circle-3"></div>

<div class="page">
    <div class="login-card">

        {{-- ── Header ── --}}
        <div class="card-header">
            <div style="display:flex;justify-content:center;margin-bottom:.1rem">
                <div class="brand-badge">
                    <div class="logo-img-wrap">
                        <img src="{{ asset('images/logo-sman3.png') }}"
                             id="login-logo"
                             onerror="this.closest('.logo-img-wrap').style.display='none';document.getElementById('login-logo-fallback').style.display='flex'"
                             alt="Logo SMAN 3 Kediri"
                             style="width:26px;height:26px;object-fit:contain;display:block;">
                    </div>
                    <span id="login-logo-fallback" class="num" style="display:none;">3</span>
                    <span>SMAN 3 Kediri</span>
                </div>
            </div>
            <h1>Panel Admin BK</h1>
            <p>Bimbingan & Konseling · Sistem Manajemen Materi</p>
        </div>

        {{-- ── Body ── --}}
        <div class="card-body">

            {{-- Flash: logout success --}}
            @if(session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            {{-- Error global --}}
            @if($errors->has('email'))
            <div class="alert alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $errors->first('email') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" id="login-form">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                               value="{{ old('email') }}"
                               placeholder="admin@example.com"
                               autocomplete="email"
                               autofocus
                               required>
                    </div>
                    @error('email')
                    <div class="form-error">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                               placeholder="••••••••"
                               autocomplete="current-password"
                               required>
                        <button type="button" class="toggle-pw" onclick="togglePassword()" id="pw-toggle-btn" aria-label="Tampilkan password">
                            {{-- Eye icon (default: tampilkan) --}}
                            <svg id="eye-show" width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{-- Eye-off icon (hidden by default) --}}
                            <svg id="eye-hide" width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <div class="form-error">
                        <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/>
                        </svg>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">Ingat saya di perangkat ini</label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="submit-btn">
                    Masuk ke Panel Admin
                </button>
            </form>
        </div>

        {{-- ── Footer ── --}}
        <div class="card-footer">
            <span>© {{ date('Y') }} SMAN 3 Kediri · </span>
            <a href="{{ route('beranda') }}">Kembali ke Website</a>
        </div>
    </div>
</div>

<script>
// Toggle tampilkan/sembunyikan password
function togglePassword() {
    const pw   = document.getElementById('password');
    const show = document.getElementById('eye-show');
    const hide = document.getElementById('eye-hide');
    const btn  = document.getElementById('pw-toggle-btn');

    if (pw.type === 'password') {
        pw.type = 'text';
        show.style.display = 'none';
        hide.style.display = 'block';
        btn.setAttribute('aria-label', 'Sembunyikan password');
    } else {
        pw.type = 'password';
        show.style.display = 'block';
        hide.style.display = 'none';
        btn.setAttribute('aria-label', 'Tampilkan password');
    }
}

// Disable tombol submit saat form di-submit (cegah double-click)
document.getElementById('login-form').addEventListener('submit', function () {
    const btn = document.getElementById('submit-btn');
    btn.disabled = true;
    btn.textContent = 'Memproses...';
});
</script>

</body>
</html>
