@extends('layouts.app')

@section('title', 'Struktur Organisasi BK - SMAN 3 Kediri')

@section('content')

{{-- ══ STYLE: Premium Org Chart Engine ══════════════════════════════ --}}
<style>
    :root {
        --primary: #0C084C;
        --accent: #FFC81E;
        --secondary: #EEF7FF;
        --line-weight: 3px;
    }

    /* ── Node Styling ── */
    .node {
        background-color: #FFC81E;
        color: #0C084C;
        font-weight: 800; /* font-extrabold */
        border-radius: 0.5rem; /* rounded-lg */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); /* shadow-md */
        padding-top: 0.75rem; padding-bottom: 0.75rem; /* py-3 */
        padding-left: 1.5rem; padding-right: 1.5rem; /* px-6 */
        text-align: center;
        border: 2px solid #0C084C;
        text-transform: uppercase;
        font-size: 0.82rem;
        position: relative;
        z-index: 10;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
        min-width: 160px;
        white-space: nowrap;
        letter-spacing: 0.02em;
    }
    .node:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(12, 8, 76, 0.15); }

    /* ── Garis Komando (Solid) ── */
    .line-command-v { width: var(--line-weight); background: var(--primary); position: absolute; left: 50%; transform: translateX(-50%); z-index: 0; }
    .line-command-h { height: var(--line-weight); background: var(--primary); position: absolute; z-index: 0; }

    /* ── Garis Koordinasi (Dashed) ── */
    .line-coord-h { height: 0; border-top: var(--line-weight) dashed var(--primary); position: absolute; z-index: 0; }
    
    /* ── Custom Scrollbar ── */
    .org-scroll-container::-webkit-scrollbar { height: 6px; }
    .org-scroll-container::-webkit-scrollbar-track { background: rgba(12, 8, 76, 0.05); border-radius: 10px; }
    .org-scroll-container::-webkit-scrollbar-thumb { background: rgba(12, 8, 76, 0.2); border-radius: 10px; }
    .org-scroll-container::-webkit-scrollbar-thumb:hover { background: var(--primary); }
</style>

<section class="py-24 px-6 min-h-screen" style="background:var(--secondary);">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header --}}
        <div class="text-center mb-16">
            <h1 class="font-black mb-2" style="font-size:2.75rem; color:var(--primary); letter-spacing:-0.03em;">Struktur Organisasi</h1>
            <p class="text-gray-500 font-bold uppercase tracking-widest text-xs">Sistem Komando & Koordinasi SMAN 3 Kediri</p>
            <div class="mx-auto mt-5 rounded-full" style="width:4rem; height:4px; background:var(--primary);"></div>
        </div>

        {{-- Mobile Hint --}}
        <div class="md:hidden flex justify-center mb-6">
            <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 flex items-center gap-2 animate-pulse">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                <span class="text-[10px] font-black uppercase text-gray-500">Geser untuk melihat struktur</span>
            </div>
        </div>

        {{-- Scroll Container Responsif --}}
        <div class="w-full overflow-x-auto pb-12 org-scroll-container">
            
            {{-- Canvas Bagan (Minimal width 1000px untuk memastikan garis tajam) --}}
            <div class="relative mx-auto py-10 min-w-[1000px]" style="max-width: 1000px;">
                
                {{-- CENTRAL SPINE (Solid Command Path) --}}
                <div class="line-command-v top-0" style="height: 100px;"></div>

                {{-- LEVEL 1: KADIS --}}
                <div class="relative flex justify-center mb-16">
                    <div class="node" style="border-width:3px; min-width: 200px;">Kadis Pendidikan</div>
                    <div class="line-command-v h-16 top-full"></div>
                </div>

                {{-- LEVEL 2: KEPSEK & KOORDINASI --}}
                <div class="relative w-full flex justify-center items-center mb-24 px-20">
                    {{-- KOMITE (Coordination) --}}
                    <div class="relative">
                        <div class="node" style="background:#fff;">Komite Sekolah</div>
                        <div class="line-coord-h w-20 top-1/2 left-full"></div>
                    </div>

                    {{-- KEPALA SEKOLAH (Command Hub) --}}
                    <div class="relative mx-20">
                        <div class="node" style="min-width: 220px; border-width:3px;">Kepala Sekolah</div>
                        {{-- Spinal Column continues down to Wali Kelas --}}
                        <div class="line-command-v h-[360px] top-full"></div>
                    </div>

                    {{-- PENGAWAS BK (Coordination) --}}
                    <div class="relative">
                        <div class="line-coord-h w-20 top-1/2 right-full"></div>
                        <div class="node" style="background:#fff;">Pengawas Sekolah</div>
                    </div>
                </div>

                {{-- LEVEL 3: WAKASEK & KOORDINATOR --}}
                <div class="relative w-full mb-32" style="height: 140px;">
                    {{-- WAKASEK (Command Left) --}}
                    <div class="absolute right-1/2 top-4 flex items-center pr-12">
                        <div class="node" style="background:#fff;">Wakasek</div>
                        <div class="line-command-h w-12 left-full"></div>
                    </div>

                    {{-- KOORDINATOR BK & TU (Command Right with Elbow) --}}
                    <div class="absolute left-1/2 top-4 pl-12">
                        <div class="line-command-h w-12 right-full top-6"></div>
                        <div class="flex flex-col items-start gap-12">
                            <div class="node" style="background:var(--primary); color:#fff; min-width:180px;">Koordinator BK</div>
                            {{-- Vertical part of elbow --}}
                            <div class="absolute left-8 top-12 h-14 w-[3px]" style="background:var(--primary);"></div>
                            <div class="node mt-4" style="background:var(--secondary); border-style:dashed;">Kepala Tata Usaha</div>
                        </div>
                    </div>
                </div>

                {{-- LEVEL 4: PELAKSANA (Guru) --}}
                <div class="relative w-full mb-28 pt-10">
                    {{-- Spreader Command --}}
                    <div class="line-command-h w-[70%] top-0 left-1/2 -translate-x-1/2"></div>
                    <div class="line-command-v h-10 top-0 left-[15%]"></div>
                    <div class="line-command-v h-10 top-0 left-1/2"></div>
                    <div class="line-command-v h-10 top-0 right-[15%] left-auto translate-x-1/2"></div>

                    <div class="flex flex-row justify-between items-center px-10">
                        <div class="node text-[0.75rem] px-4" style="background:#fff;">Guru Mata Pelajaran</div>
                        {{-- WALI KELAS (Central Command Hub) --}}
                        <div class="node" style="background:#FF9F43; color:#fff;">Wali Kelas</div>
                        <div class="node text-[0.75rem] px-4" style="background:#fff;">Guru Pembimbing</div>
                    </div>

                    {{-- Team Coordination Bar --}}
                    <div class="absolute -bottom-10 left-[15%] right-[15%] h-0 border-b-[3px] border-dashed" style="border-color:var(--primary);"></div>
                    
                    {{-- Final Command Line to Siswa --}}
                    <div class="line-command-v h-20 top-full"></div>
                </div>

                {{-- LEVEL 5: TARGET (SISWA) --}}
                <div class="relative flex justify-center mt-8">
                    <div class="node w-full max-w-2xl py-6 text-2xl tracking-[1em] font-black" 
                         style="background:var(--accent); border-width:4px; border-radius: 1.5rem; box-shadow: 0 15px 40px rgba(12,8,76,0.18);">
                        SISWA
                    </div>
                </div>

            </div>{{-- /Canvas --}}
        </div>{{-- /Scroll Container --}}

    </div>
</section>

@endsection
