@extends('layouts.app')
@section('title', 'Tim BK - SMAN 3 Kediri')

@section('content')

{{-- ═══ HERO ════════════════════════════════════════════════════════ --}}
<section class="relative text-center overflow-hidden"
         style="background:#0C084C;padding:7rem 1.5rem 5rem;">
    <div class="absolute inset-0 pointer-events-none"
         style="background:radial-gradient(ellipse at 50% 0%,rgba(99,102,241,.18) 0%,transparent 70%);"></div>
    <div class="relative z-10 max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-5 py-1.5 rounded-full mb-7"
             style="background:rgba(255,200,30,.12);border:1px solid rgba(255,200,30,.3);">
            <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:#FFC81E;"></span>
            <span class="text-xs font-bold uppercase tracking-widest" style="color:#FFC81E;">Profil & Struktur Organisasi</span>
        </div>
        <h1 class="font-bold leading-tight mb-5" style="font-size:clamp(2rem,5vw,3.5rem);color:#fff;">
            Sistem Layanan <span style="color:#FFC81E;">Bimbingan Konseling</span>
        </h1>
        <div class="mx-auto mb-7 rounded-full" style="width:5rem;height:3px;background:#FFC81E;"></div>
        <p class="leading-relaxed mx-auto"
           style="font-size:1rem;color:rgba(255,255,255,.75);max-width:560px;">
            Mengenal alur organisasi dan para profesional berdedikasi yang siap mendampingi
            setiap perjalanan akademik dan pribadi siswa SMAN 3 Kediri.
        </p>
    </div>
</section>

{{-- ══ STYLE: Exact Match Org Chart Engine ══════════════════════════════ --}}
<style>
    /* ── Node Styling ── */
    .node {
        background-color: #FFC81E;
        color: #0C084C;
        font-weight: 800; /* font-extrabold */
        border-radius: 0.5rem; /* rounded-lg */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); /* shadow-md */
        border: 2px solid #0C084C;
        text-transform: uppercase;
        font-size: 0.85rem;
        position: absolute;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        line-height: 1.2;
        transition: all 0.3s ease;
    }
    .node:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(12, 8, 76, 0.15); }

    /* ── Sharp Lines (4px Black/Deep Blue) ── */
    .line-solid-v { width: 4px; background-color: #050A30; position: absolute; z-index: 0; }
    .line-solid-h { height: 4px; background-color: #050A30; position: absolute; z-index: 0; }
    .line-dashed-v { width: 4px; border-left: 4px dashed #050A30; position: absolute; z-index: 0; }
    .line-dashed-h { height: 4px; border-top: 4px dashed #050A30; position: absolute; z-index: 0; }
    
    /* ── Custom Scrollbar ── */
    .org-scroll-container::-webkit-scrollbar { height: 6px; }
    .org-scroll-container::-webkit-scrollbar-track { background: rgba(12, 8, 76, 0.05); border-radius: 10px; }
    .org-scroll-container::-webkit-scrollbar-thumb { background: rgba(12, 8, 76, 0.2); border-radius: 10px; }
    .org-scroll-container::-webkit-scrollbar-thumb:hover { background: #0C084C; }
</style>

{{-- ═══ ORGANISASI PELAYANAN BK (EXACT REPLICA) ══════════════ --}}
<section class="py-24 px-6 relative" style="background:#EEF7FF;">
    <div class="max-w-[1450px] mx-auto">
        
        {{-- Header --}}
        <div class="text-center mb-20">
            <h2 class="mb-4 leading-tight" style="font-family:'Merriweather', serif; font-size:clamp(1.8rem, 4vw, 2.8rem); color:#0C084C; font-weight:800;">
                Organisasi Pelayanan<br>
                <span style="color:#FFC81E; -webkit-text-stroke: 1px #0C084C;">Bimbingan dan Konseling</span>
            </h2>
            <div class="mx-auto mt-6 rounded-full" style="width:4rem; height:4px; background:#FFC81E;"></div>
        </div>

        {{-- Scroll Container Responsif --}}
        <div class="w-full overflow-x-auto pb-8 org-scroll-container">
            
            {{-- Ultra-Wide Canvas to fill the website view --}}
            <div class="relative mx-auto" style="width: 1400px; height: 650px; min-width: 1400px;">
                
                {{-- ═══ THE NODES ═══ --}}
                <div class="node" style="left: 610px; top: 0px; width: 180px; height: 45px; font-size: 0.75rem;">KADIS PENDIDIKAN</div>
                <div class="node" style="left: 1040px; top: 80px; width: 220px; height: 45px; font-size: 0.75rem;">PENGAWAS SEKOLAH<br>BIDANG B K</div>
                <div class="node" style="left: 160px; top: 160px; width: 180px; height: 45px; font-size: 0.75rem;">KOMITE SEKOLAH</div>
                <div class="node" style="left: 610px; top: 160px; width: 180px; height: 45px; font-size: 0.75rem;">KEPALA SEKOLAH</div>
                <div class="node" style="left: 160px; top: 240px; width: 180px; height: 45px; font-size: 0.75rem;">WAKASEK</div>
                <div class="node" style="left: 1060px; top: 240px; width: 180px; height: 45px; font-size: 0.75rem;">KOORDINATOR BK</div>
                <div class="node" style="left: 1060px; top: 320px; width: 180px; height: 45px; font-size: 0.75rem;">KEPALA TATA USAHA</div>
                <div class="node" style="left: 160px; top: 420px; width: 180px; height: 45px; font-size: 0.7rem;">GURU<br>MATA PELAJARAN</div>
                <div class="node" style="left: 610px; top: 420px; width: 180px; height: 45px; font-size: 0.75rem;">WALI KELAS</div>
                <div class="node" style="left: 1060px; top: 420px; width: 180px; height: 45px; font-size: 0.75rem;">GURU PEMBIMBING</div>
                <div class="node" style="left: 150px; top: 540px; width: 1100px; height: 50px; font-size: 1.2rem; letter-spacing: 1em;">S I S W A</div>

                {{-- ═══ THE LINES ═══ --}}
                <div class="line-solid-v" style="left: 700px; top: 45px; height: 115px;"></div>
                <div class="line-solid-h" style="left: 700px; top: 103px; width: 340px;"></div>
                <div class="line-solid-v" style="left: 700px; top: 205px; height: 185px;"></div>
                <div class="line-solid-h" style="left: 340px; top: 263px; width: 360px;"></div>
                <div class="line-solid-h" style="left: 700px; top: 263px; width: 360px;"></div>
                <div class="line-solid-h" style="left: 700px; top: 343px; width: 360px;"></div>
                
                <div class="line-solid-h" style="left: 250px; top: 390px; width: 904px;"></div>
                <div class="line-solid-v" style="left: 250px; top: 390px; height: 30px;"></div>
                <div class="line-solid-v" style="left: 700px; top: 390px; height: 30px;"></div>
                <div class="line-solid-v" style="left: 1150px; top: 390px; height: 30px;"></div>
                
                <div class="line-solid-v" style="left: 700px; top: 465px; height: 75px; z-index: 5;"></div>

                <div class="line-dashed-v" style="left: 1150px; top: 125px; height: 58px;"></div>
                <div class="line-dashed-h" style="left: 790px; top: 183px; width: 364px;"></div>
                <div class="line-dashed-h" style="left: 340px; top: 183px; width: 270px;"></div>
                <div class="line-dashed-h" style="left: 340px; top: 443px; width: 270px;"></div>
                <div class="line-dashed-h" style="left: 790px; top: 443px; width: 270px;"></div>
                
                <div class="line-dashed-v" style="left: 270px; top: 465px; height: 30px;"></div>
                <div class="line-dashed-v" style="left: 1130px; top: 465px; height: 30px;"></div>
                <div class="line-dashed-h" style="left: 270px; top: 495px; width: 864px;"></div>

            </div>
        </div>
    </div>
</section>

{{-- ═══ KONTEN TIM BK ═══════════════════════════════════════════════ --}}
<section class="pt-24 px-6" style="background:#F8FAFF; border-top: 1px solid #edf2f7; padding-bottom: 50px;">
    <div class="w-full max-w-7xl mx-auto">

        @if(!$koordinator && $gurus->isEmpty())
        <div class="text-center py-24">
            <div class="text-6xl mb-5">👥</div>
            <h2 class="text-2xl font-bold mb-3" style="color:#0C084C;">Data Tim BK Belum Tersedia</h2>
            <p class="text-gray-500 max-w-sm mx-auto">Data konselor sedang dalam proses pengisian oleh administrator.</p>
        </div>
        @else

        <div class="text-center mb-24">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-4" style="background:rgba(255,200,30,0.1); border:1px solid rgba(255,200,30,0.2);">
                <span class="w-2 h-2 rounded-full" style="background:#FFC81E;"></span>
                <span class="text-[0.65rem] font-bold uppercase tracking-[0.2em]" style="color:#0C084C;">Konselor Profesional</span>
            </div>
            <h2 class="mb-4" style="font-family:'Merriweather', serif; font-size:clamp(2rem, 5vw, 3.2rem); color:#0C084C; font-weight:900;">
                Profil Guru <span style="color:#FFC81E;">BK</span>
            </h2>
            <p class="text-gray-500 font-medium text-sm tracking-wide">Pendamping Setia Siswa SMAN 3 Kediri Menuju Masa Depan</p>
            <div class="mx-auto mt-8 rounded-full" style="width:6rem; height:4px; background:#0C084C;"></div>
        </div>

        {{-- Koordinator BK --}}
        @if($koordinator)
        <div class="flex flex-col items-center" style="margin-bottom: 25px;">
            <div class="bk-card" style="width:320px; height:420px;">
                @if($koordinator->photo)
                    <img class="bk-card__photo" src="{{ asset('uploads/' . $koordinator->photo) }}" alt="{{ $koordinator->name }}">
                @else
                    <div class="bk-card__fallback">👩‍🏫</div>
                @endif
                <div class="bk-card__overlay"></div>
                <div class="bk-card__body">
                    <div class="bk-card__name" style="font-size:1.25rem;">{{ $koordinator->name }}</div>
                    <span class="bk-card__badge bk-card__badge--gold">{{ $koordinator->specialization }}</span>
                    <div class="bk-card__nip">
                        <span class="font-bold opacity-80">NIP.</span> {{ $koordinator->nip ?: 'Tidak tersedia' }}
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Anggota Tim BK --}}
        @if($gurus->isNotEmpty())
        <div class="w-full flex justify-center">
            <div class="flex flex-wrap justify-center gap-8" style="max-width: 1220px;">
            @foreach($gurus as $guru)
            <div class="bk-card" style="width:280px; height:380px;">
                @if($guru->photo)
                    <img class="bk-card__photo" src="{{ asset('uploads/' . $guru->photo) }}" alt="{{ $guru->name }}">
                @else
                    <div class="bk-card__fallback" style="font-size:5rem;">👤</div>
                @endif
                <div class="bk-card__overlay"></div>
                <div class="bk-card__body">
                    <div class="bk-card__name">{{ $guru->name }}</div>
                    <span class="bk-card__badge bk-card__badge--navy">{{ $guru->specialization }}</span>
                    <div class="bk-card__nip">
                        <span class="font-bold opacity-80">NIP.</span> {{ $guru->nip ?: 'Tidak tersedia' }}
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
        @endif
        @endif
    </div>
</section>

{{-- ══ STYLE ════════════════════════════════════════════════════════ --}}
<style>
    /* ── Node Box (Jabatan) ── */
    .node-box {
        background: #FFC81E;
        color: #0C084C;
        font-weight: 800;
        padding: 0.85rem 1.5rem;
        border-radius: 0.85rem;
        box-shadow: 0 4px 12px rgba(12, 8, 76, 0.15);
        border: 2px solid #0C084C;
        text-align: center;
        text-transform: uppercase;
        font-size: 0.82rem;
        position: relative;
        z-index: 10;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
        min-width: 150px;
        white-space: nowrap;
        letter-spacing: 0.02em;
    }
    .node-box:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 12px 30px rgba(12, 8, 76, 0.2);
    }

    /* ── Garis Penghubung ── */
    .line-v { width: 3px; background: #0C084C; position: absolute; left: 50%; transform: translateX(-50%); z-index: 0; }
    .line-h { height: 3px; background: #0C084C; position: absolute; z-index: 0; }
    .line-h-dashed { height: 2px; border-top: 3px dashed #0C084C; position: absolute; z-index: 0; }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar { height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: rgba(12, 8, 76, 0.05); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(12, 8, 76, 0.2); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #0C084C; }

    /* ── Kartu Konselor ────────────────────────────────── */
    .bk-card {
        position: relative;
        overflow: hidden;
        border-radius: 2rem;
        cursor: pointer;
        box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        transition: all .4s cubic-bezier(0.4, 0, 0.2, 1);
        background: #0C084C;
    }
    .bk-card:hover { box-shadow: 0 24px 60px rgba(0,0,0,0.22); transform: translateY(-8px) scale(1.02); }
    .bk-card__photo { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center top; transition: transform .8s ease; }
    .bk-card:hover .bk-card__photo { transform: scale(1.1); }
    .bk-card__fallback { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-size: 6rem; background: linear-gradient(160deg,#0C084C 0%,#1e1a7a 100%); }
    .bk-card__overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(12,8,76,0.95) 0%, rgba(12,8,76,0.7) 40%, rgba(12,8,76,0.2) 70%, transparent 100%); transition: all .5s ease; }
    .bk-card:hover .bk-card__overlay { background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 50%, transparent 100%); }
    .bk-card__body { position: absolute; bottom: 0; left: 0; right: 0; padding: 1.75rem; transition: all .4s ease; }
    .bk-card__name { color: #fff; font-size: 1.15rem; font-weight: 800; line-height: 1.2; margin-bottom: .5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.5); }
    .bk-card__badge { display: inline-block; padding: .25rem 1rem; border-radius: 99px; font-size: .7rem; font-weight: 700; margin-bottom: .75rem; letter-spacing: .05em; }
    .bk-card__badge--navy { background: rgba(255,255,255,0.15); color: #fff; }
    .bk-card__badge--gold { background: #FFC81E; color: #0C084C; }
    .bk-card__nip { color: rgba(255,255,255,0.8); font-size: .75rem; display: flex; align-items: center; gap: .4rem; }
    .bk-card__crown { position: absolute; top: 1.25rem; left: 50%; transform: translateX(-50%); background: rgba(255,200,30,0.9); color: #0C084C; font-size: .65rem; font-weight: 800; text-transform: uppercase; padding: .35rem 1.25rem; border-radius: 99px; z-index: 10; backdrop-filter: blur(8px); white-space: nowrap; }
</style>

@endsection
