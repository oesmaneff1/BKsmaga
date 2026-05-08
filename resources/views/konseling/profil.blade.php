@extends('layouts.app')

@section('title', 'Profil Tim Bimbingan Konseling - SMAN 3 Kediri')
@section('meta_description', 'Kenali tim guru Bimbingan Konseling SMAN 3 Kediri yang siap mendampingi perjalanan akademik dan karir Anda.')

@section('content')

{{-- ═══ HERO ══════════════════════════════════════════════════════════════ --}}
<section class="relative text-center overflow-hidden" style="background:#0C084C; padding: 7rem 1.5rem 5rem;">
    <div class="absolute inset-0" style="background:radial-gradient(ellipse at 50% 0%, rgba(99,102,241,.18) 0%, transparent 70%); pointer-events:none;"></div>
    <div class="absolute top-0 right-0 w-72 h-72 rounded-full" style="background:rgba(255,200,30,.04); transform:translate(30%,-40%);"></div>
    <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full" style="background:rgba(255,200,30,.04); transform:translate(-30%,40%);"></div>

    <div class="relative z-10 max-w-4xl mx-auto">
        {{-- Badge --}}
        <div style="display:inline-flex;align-items:center;gap:.5rem;padding:.4rem 1.25rem;border-radius:99px;background:rgba(255,200,30,.12);border:1px solid rgba(255,200,30,.3);color:#FFC81E;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;margin-bottom:1.75rem;">
            STRUKTUR TIM BK
        </div>

        <h1 style="font-family:'Merriweather',serif;font-size:clamp(2.2rem,5vw,3.75rem);font-weight:700;line-height:1.15;color:#fff;margin-bottom:1.25rem;">
            Profil <span style="color:#FFC81E;">Tim BK</span>
        </h1>

        <div style="width:5rem;height:3px;background:#FFC81E;border-radius:99px;margin:0 auto 1.75rem;"></div>

        <p style="font-size:1rem;line-height:1.85;color:rgba(255,255,255,.82);max-width:640px;margin:0 auto;">
            Mengenal lebih dekat guru Bimbingan Konseling SMAN 3 Kediri yang berdedikasi untuk membantu siswa meraih potensi maksimal.
        </p>
    </div>
</section>

{{-- ═══ PENGANTAR UNIT ══════════════════════════════════════════════════════ --}}
<section style="padding:3rem 1.5rem 1rem;background:#fff;">
    <div style="max-width:860px;margin:0 auto;text-align:center;">
        <div style="display:inline-flex;align-items:center;gap:.5rem;padding:.4rem 1.1rem;border-radius:99px;background:#EEF7FF;border:1px solid rgba(12,8,76,.15);color:#0C084C;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;margin-bottom:1.25rem;">
            GURU BIMBINGAN KONSELING
        </div>
        <h2 style="font-family:'Merriweather',serif;font-size:clamp(1.5rem,2.8vw,2.2rem);font-weight:700;color:#0C084C;margin-bottom:.75rem;">
            Kenali Tim Konselor Kami
        </h2>
        <p style="color:#6b7280;font-size:1rem;line-height:1.7;max-width:560px;margin:0 auto;">
            Tim konselor berpengalaman dan bersertifikat yang siap mendampingi setiap siswa SMAN 3 Kediri.
        </p>
    </div>
</section>

{{-- ═══ KARTU TIM BK ════════════════════════════════════════════════════════ --}}
<section style="padding:2.5rem 1.5rem 5rem;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;">

        {{-- Hierarki Unit --}}
        <div style="text-align:center;margin-bottom:2.5rem;">
            <div style="display:inline-flex;align-items:center;gap:.6rem;padding:.6rem 1.5rem;border-radius:99px;background:#0C084C;color:#FFC81E;font-size:.82rem;font-weight:700;box-shadow:0 4px 16px rgba(12,8,76,.25);">
                🏫 Unit Bimbingan Konseling SMAN 3 Kediri
            </div>
            <div style="width:1px;height:1.5rem;background:rgba(12,8,76,.2);margin:.5rem auto 0;"></div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem;">
            @foreach([
                [
                    'name'   => 'Dra. Endang S., M.Pd.',
                    'role'   => 'Koordinator BK & Konselor',
                    'desc'   => 'Spesialisasi dalam konseling pribadi dan manajemen stres.',
                    'badge'  => 'Koordinator',
                    'icon'   => '👩‍🏫',
                    'skills' => ['Konseling Pribadi','Manajemen Stres','Mediasi Konflik'],
                    'exp'    => '20+ Tahun',
                    'highlight' => true,
                ],
                [
                    'name'   => 'Ahmad Fauzi, S.Psi.',
                    'role'   => 'Konselor Karir',
                    'desc'   => 'Membantu pemetaan minat, bakat, dan pemilihan karir siswa.',
                    'badge'  => 'Konselor Karir',
                    'icon'   => '👨‍💼',
                    'skills' => ['Tes RIASEC','Bimbingan PTN/PTS','Perencanaan Karir'],
                    'exp'    => '12+ Tahun',
                    'highlight' => false,
                ],
                [
                    'name'   => 'Siti Aisyah, M.Psi.',
                    'role'   => 'Konselor Akademik',
                    'desc'   => 'Pendampingan kesulitan belajar dan peningkatan motivasi akademik.',
                    'badge'  => 'Konselor Akademik',
                    'icon'   => '👩‍🎓',
                    'skills' => ['Konseling Belajar','Motivasi Akademik','Psikologi Pendidikan'],
                    'exp'    => '10+ Tahun',
                    'highlight' => false,
                ],
            ] as $guru)
            <div style="background:#fff;border-radius:1.5rem;overflow:hidden;box-shadow:0 8px 32px rgba(12,8,76,.09);border:1px solid rgba(12,8,76,.07);display:flex;flex-direction:column;transition:transform .25s,box-shadow .25s;"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 18px 44px rgba(12,8,76,.15)'"
                 onmouseout="this.style.transform='';this.style.boxShadow='0 8px 32px rgba(12,8,76,.09)'">

                {{-- Card Header: Deep Navy --}}
                <div style="background:#0C084C;padding:2.25rem 1.5rem 1.75rem;display:flex;flex-direction:column;align-items:center;text-align:center;position:relative;overflow:hidden;">
                    <div style="position:absolute;width:8rem;height:8rem;border-radius:50%;background:rgba(255,255,255,.05);top:-3rem;right:-2rem;"></div>
                    <div style="position:absolute;width:5rem;height:5rem;border-radius:50%;background:rgba(255,255,255,.05);bottom:-1.5rem;left:-1rem;"></div>

                    {{-- Avatar --}}
                    <div style="position:relative;margin-bottom:1rem;z-index:1;">
                        <div style="width:6rem;height:6rem;border-radius:50%;background:rgba(255,255,255,.12);border:3px solid {{ $guru['highlight'] ? '#FFC81E' : 'rgba(255,255,255,.25)' }};display:flex;align-items:center;justify-content:center;font-size:2.75rem;box-shadow:0 4px 16px rgba(0,0,0,.2);">
                            {{ $guru['icon'] }}
                        </div>
                        {{-- Badge posisi --}}
                        <span style="position:absolute;bottom:-8px;left:50%;transform:translateX(-50%);background:{{ $guru['highlight'] ? '#FFC81E' : 'rgba(255,255,255,.15)' }};color:{{ $guru['highlight'] ? '#0C084C' : '#fff' }};font-size:.62rem;font-weight:800;text-transform:uppercase;letter-spacing:.06em;padding:.22rem .75rem;border-radius:99px;white-space:nowrap;border:{{ $guru['highlight'] ? 'none' : '1px solid rgba(255,255,255,.3)' }};">
                            {{ $guru['badge'] }}
                        </span>
                    </div>

                    {{-- Nama & Jabatan --}}
                    <h3 style="color:#fff;font-size:1.1rem;font-weight:700;margin:1rem 0 .25rem;position:relative;z-index:1;">{{ $guru['name'] }}</h3>
                    <p style="color:rgba(255,255,255,.7);font-size:.82rem;position:relative;z-index:1;">{{ $guru['role'] }}</p>
                </div>

                {{-- Card Body: Putih --}}
                <div style="padding:1.5rem 1.75rem;flex-grow:1;display:flex;flex-direction:column;gap:1rem;">
                    {{-- Pengalaman --}}
                    <div style="display:flex;align-items:center;justify-content:center;gap:.4rem;">
                        <span style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#9ca3af;">Pengalaman:</span>
                        <span style="font-size:.8rem;font-weight:700;color:#0C084C;">{{ $guru['exp'] }}</span>
                    </div>

                    {{-- Deskripsi --}}
                    <p style="color:#6b7280;font-size:.875rem;line-height:1.75;text-align:center;margin:0;">
                        {{ $guru['desc'] }}
                    </p>

                    {{-- Keahlian chips --}}
                    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:.5rem;">
                        @foreach($guru['skills'] as $skill)
                        <span style="font-size:.72rem;font-weight:600;padding:.25rem .75rem;border-radius:99px;background:#EEF7FF;color:#0C084C;border:1px solid rgba(12,8,76,.12);">
                            {{ $skill }}
                        </span>
                        @endforeach
                    </div>

                    {{-- CTA --}}
                    <a href="{{ route('layanan') }}"
                       style="display:flex;align-items:center;justify-content:center;gap:.5rem;width:100%;padding:.8rem 1.25rem;border-radius:1rem;background:#FFC81E;color:#0C084C;font-size:.875rem;font-weight:700;text-decoration:none;margin-top:.5rem;box-shadow:0 3px 12px rgba(255,200,30,.3);transition:background .2s,transform .2s;"
                       onmouseover="this.style.background='#ffd84d';this.style.transform='scale(1.02)'"
                       onmouseout="this.style.background='#FFC81E';this.style.transform=''">
                        📋 Lihat Layanan BK
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ INFO LOKASI ══════════════════════════════════════════════════════════ --}}
<section style="padding:1rem 1.5rem 5rem;background:#fff;">
    <div style="max-width:860px;margin:0 auto;">
        <div style="background:#0C084C;border-radius:1.5rem;padding:2rem 2.5rem;display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;box-shadow:0 8px 32px rgba(12,8,76,.2);">
            <div style="width:3rem;height:3rem;border-radius:1rem;background:rgba(255,200,30,.15);border:1px solid rgba(255,200,30,.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:1.4rem;">
                📍
            </div>
            <div style="flex:1;">
                <p style="color:#FFC81E;font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;margin:0 0 .3rem;">Lokasi Ruang BK</p>
                <p style="color:#fff;font-size:1rem;font-weight:600;margin:0 0 .2rem;">Lantai 1 Gedung Utama SMAN 3 Kediri</p>
                <p style="color:rgba(255,255,255,.7);font-size:.875rem;margin:0;">Buka Senin s.d. Jumat, 07.00–14.00 WIB</p>
            </div>
        </div>
    </div>
</section>

@endsection
