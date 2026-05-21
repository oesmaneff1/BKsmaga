@extends('layouts.app')

@section('title', 'Seputar BK - SMAN 3 Kediri')
@section('meta_description', 'Tentang layanan Bimbingan dan Konseling (BK) di SMAN 3 Kediri.')

@section('content')

{{-- ═══ HERO ══════════════════════════════════════════════════════════════ --}}
<section class="relative text-center overflow-hidden" style="background:#0C084C; padding: 7rem 1.5rem 5rem;">
    <div class="absolute top-0 left-0 w-full h-full" style="background:radial-gradient(ellipse at 50% 0%, rgba(99,102,241,.18) 0%, transparent 70%); pointer-events:none;"></div>
    <div class="absolute top-0 right-0 w-72 h-72 rounded-full" style="background:rgba(255,200,30,.04); transform:translate(30%,-40%);"></div>
    <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full" style="background:rgba(255,200,30,.04); transform:translate(-30%,40%);"></div>

    <div class="relative z-10 max-w-4xl mx-auto">
        {{-- Badge --}}
        <div style="display:inline-flex;align-items:center;gap:.5rem;padding:.4rem 1.25rem;border-radius:99px;background:rgba(255,200,30,.12);border:1px solid rgba(255,200,30,.3);color:#FFC81E;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;margin-bottom:1.75rem;">
            SEPUTAR BK SMAN 3 KEDIRI
        </div>

        <h1 style="font-family:'Merriweather',serif;font-size:clamp(2.2rem,5vw,3.75rem);font-weight:700;line-height:1.15;color:#fff;margin-bottom:1.25rem;">
            Mengenal <span style="color:#FFC81E;">Bimbingan &amp; Konseling</span>
        </h1>

        <div style="width:5rem;height:3px;background:#FFC81E;border-radius:99px;margin:0 auto 2rem;"></div>

        <h2 style="font-size:1.2rem;font-weight:700;color:#fff;margin-bottom:1rem;">
            Apa itu Bimbingan dan Konseling?
        </h2>
        <p style="font-size:1rem;line-height:1.85;color:rgba(255,255,255,.82);max-width:720px;margin:0 auto;">
            "Bimbingan dan Konseling (BK) bukanlah tempat hukuman atau 'polisi sekolah' bagi siswa yang bermasalah. Sebaliknya, BK adalah layanan profesional dan sahabat siswa yang hadir untuk membantu kamu mengenali potensi diri, merencanakan masa depan, serta menemukan solusi atas berbagai tantangan yang sedang kamu hadapi. Tujuan utama kami adalah mendampingi kamu mencapai perkembangan yang optimal dan kemandirian dalam menjalani masa sekolah."
        </p>
    </div>
</section>

{{-- ═══ 4 BIDANG LAYANAN ════════════════════════════════════════════════════ --}}
<section style="padding:5rem 1.5rem; background:#fff;">
    <div style="max-width:1200px;margin:0 auto;">

        <div style="text-align:center;margin-bottom:3.5rem;">
            <div style="display:inline-flex;align-items:center;gap:.5rem;padding:.4rem 1.1rem;border-radius:99px;background:#EEF7FF;border:1px solid rgba(12,8,76,.15);color:#0C084C;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.12em;margin-bottom:1rem;">
                FOKUS KAMI
            </div>
            <h2 style="font-family:'Merriweather',serif;font-size:clamp(1.6rem,3vw,2.4rem);font-weight:700;color:#0C084C;margin-bottom:.75rem;">
                4 Bidang Layanan Bimbingan dan Konseling
            </h2>
            <p style="color:#6b7280;font-size:1rem;max-width:560px;margin:0 auto;line-height:1.7;">
                Untuk memastikan setiap aspek perkembanganmu terdukung dengan baik, layanan BK berfokus pada empat bidang utama:
            </p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.75rem;">
            @foreach([
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>','title'=>'Bidang Pribadi','desc'=>'Membantu kamu mengenali diri sendiri, membangun kepercayaan diri, mengelola emosi, serta mengatasi masalah personal yang mungkin mengganggu keseharianmu.'],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>','title'=>'Bidang Sosial','desc'=>'Mendampingi kamu dalam mengembangkan keterampilan berinteraksi, membangun komunikasi yang sehat dengan teman sebaya maupun lingkungan sekitar, dan menyelesaikan konflik sosial.'],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>','title'=>'Bidang Belajar','desc'=>'Memberikan dukungan agar kamu bisa menemukan gaya belajar yang tepat, meningkatkan motivasi, mengatur waktu, serta mengatasi berbagai kesulitan akademis di sekolah.'],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>','title'=>'Bidang Karir','desc'=>'Membimbing kamu untuk memetakan minat dan bakat, memberikan wawasan tentang pilihan studi lanjut (perguruan tinggi), serta merencanakan langkah karir yang sesuai dengan potensimu di masa depan.'],
            ] as $bidang)
            <div style="background:#fff;border-radius:1.5rem;overflow:hidden;box-shadow:0 8px 32px rgba(12,8,76,.09);border:1px solid rgba(12,8,76,.06);display:flex;flex-direction:column;transition:transform .25s,box-shadow .25s;"
                 onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 40px rgba(12,8,76,.14)'"
                 onmouseout="this.style.transform='';this.style.boxShadow='0 8px 32px rgba(12,8,76,.09)'">
                {{-- Card Header --}}
                <div style="background:#0C084C;padding:2.25rem 1.5rem;display:flex;flex-direction:column;align-items:center;text-align:center;position:relative;overflow:hidden;">
                    <div style="position:absolute;width:7rem;height:7rem;border-radius:50%;background:rgba(255,255,255,.05);top:-2rem;right:-2rem;"></div>
                    <div style="position:absolute;width:5rem;height:5rem;border-radius:50%;background:rgba(255,255,255,.05);bottom:-1.5rem;left:-1rem;"></div>
                    <div style="width:4rem;height:4rem;border-radius:1rem;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;margin-bottom:1rem;position:relative;z-index:1;">
                        <svg width="28" height="28" fill="none" stroke="white" viewBox="0 0 24 24">{!! $bidang['icon'] !!}</svg>
                    </div>
                    <h3 style="color:#fff;font-size:1.25rem;font-weight:700;position:relative;z-index:1;">{!! $bidang['title'] !!}</h3>
                </div>
                {{-- Card Body --}}
                <div style="padding:1.75rem;flex-grow:1;text-align:center;">
                    <p style="color:#6b7280;font-size:.9rem;line-height:1.8;">{!! $bidang['desc'] !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ ASAS-ASAS ════════════════════════════════════════════════════════════ --}}
<section style="padding:5rem 1.5rem;background:#EEF7FF;overflow-x:hidden;">
    <div style="max-width:1200px;margin:0 auto;box-sizing:border-box;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <h2 style="font-family:'Merriweather',serif;font-size:clamp(1.6rem,3vw,2.4rem);font-weight:700;color:#0C084C;margin-bottom:.75rem;">
                Asas-Asas Bimbingan dan Konseling
            </h2>
            <p style="color:#6b7280;font-size:1rem;max-width:560px;margin:0 auto;line-height:1.7;">
                Dalam memberikan layanan, kami memegang teguh komitmen profesional melalui asas-asas berikut agar kamu merasa aman dan nyaman:
            </p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.5rem;box-sizing:border-box;">
            @foreach([
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>','title'=>'Kerahasiaan','desc'=>'Segala informasi, cerita, dan keluh kesah yang kamu bagikan kepada guru BK akan dijaga kerahasiaannya dengan sangat ketat.','highlight'=>true],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>','title'=>'Kesukarelaan','desc'=>'Hadir tanpa adanya unsur paksaan. Siswa diharapkan datang dengan sukarela dan ikhlas.','highlight'=>false],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>','title'=>'Keterbukaan','desc'=>'Saling terbuka dan jujur dalam memberikan informasi, sehingga proses konseling bisa berjalan efektif.','highlight'=>false],
                ['icon'=>'<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>','title'=>'Kemandirian','desc'=>'Bertujuan agar kamu pada akhirnya mampu berdiri sendiri, berani mengambil keputusan, dan bertanggung jawab atas pilihan yang kamu buat.','highlight'=>false],
            ] as $asas)
            <div style="background:#fff;border-radius:1.5rem;overflow:hidden;box-shadow:0 6px 24px rgba(12,8,76,.07);border:1px solid rgba(12,8,76,.06);display:flex;flex-direction:column;position:relative;transition:transform .25s,box-shadow .25s;"
                 onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 14px 36px rgba(12,8,76,.13)'"
                 onmouseout="this.style.transform='';this.style.boxShadow='0 6px 24px rgba(12,8,76,.07)'">
                @if($asas['highlight'])
                <span style="position:absolute;top:.85rem;right:.85rem;background:#FFC81E;color:#0C084C;font-size:.62rem;font-weight:800;text-transform:uppercase;letter-spacing:.08em;padding:.25rem .65rem;border-radius:99px;z-index:10;">Paling Utama</span>
                @endif
                <div style="background:#0C084C;padding:1.75rem 1.5rem;display:flex;flex-direction:column;align-items:center;text-align:center;">
                    <div style="width:3.25rem;height:3.25rem;border-radius:.875rem;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;margin-bottom:.875rem;">
                        <svg width="24" height="24" fill="none" stroke="{{ $asas['highlight'] ? '#FFC81E' : 'white' }}" viewBox="0 0 24 24">{!! $asas['icon'] !!}</svg>
                    </div>
                    <h3 style="color:#fff;font-size:1.1rem;font-weight:700;">{!! $asas['title'] !!}</h3>
                </div>
                <div style="padding:1.5rem;text-align:center;flex-grow:1;">
                    <p style="color:#6b7280;font-size:.875rem;line-height:1.8;">{!! $asas['desc'] !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ FUNGSI ═══════════════════════════════════════════════════════════════ --}}
<section style="padding:5rem 1.5rem;background:#fff;overflow:hidden;">
    <div style="max-width:860px;margin-left:auto;margin-right:auto;">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <h2 style="font-family:'Merriweather',serif;font-size:clamp(1.6rem,3vw,2.4rem);font-weight:700;color:#0C084C;margin-bottom:.75rem;">
                Fungsi Bimbingan dan Konseling
            </h2>
            <p style="color:#6b7280;font-size:1rem;line-height:1.7;">
                Kehadiran layanan BK di sekolah dirancang untuk menjalankan beberapa fungsi krusial:
            </p>
        </div>

        @foreach([
            ['title'=>'Pemahaman','desc'=>'Membantu siswa, guru, dan orang tua untuk lebih memahami potensi, bakat, minat, serta karakteristik kondisi siswa.'],
            ['title'=>'Pencegahan (Preventif)','desc'=>'Memberikan antisipasi dan edukasi agar siswa terhindar dari berbagai masalah yang menghambat.'],
            ['title'=>'Pengentasan (Kuratif)','desc'=>'Memberikan bantuan dan intervensi langsung untuk membantu siswa keluar dari permasalahan.'],
            ['title'=>'Pemeliharaan dan Pengembangan','desc'=>'Menjaga hal-hal positif yang sudah ada pada diri siswa dan terus mengembangkannya secara berkelanjutan.'],
        ] as $fungsi)
        <div style="margin-bottom:1.25rem;padding:1.5rem 1.75rem;background:#EEF7FF;border-radius:1.25rem;border:1px solid rgba(12,8,76,.07);">
            <table style="width:100%;border-collapse:collapse;">
                <tr>
                    <td style="width:2.5rem;vertical-align:top;padding-right:1.25rem;">
                        <div style="width:2.5rem;height:2.5rem;border-radius:.75rem;background:#0C084C;display:flex;align-items:center;justify-content:center;">
                            <svg width="18" height="18" fill="none" stroke="#FFC81E" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </td>
                    <td style="vertical-align:top;">
                        <h3 style="color:#0C084C;font-size:1.05rem;font-weight:700;margin:0 0 .35rem 0;">{!! $fungsi['title'] !!}</h3>
                        <p style="color:#6b7280;font-size:.9rem;line-height:1.75;margin:0;">{!! $fungsi['desc'] !!}</p>
                    </td>
                </tr>
            </table>
        </div>
        @endforeach
    </div>
</section>

@endsection
