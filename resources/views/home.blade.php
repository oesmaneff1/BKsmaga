@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Website resmi SMA Negeri 3 Kediri – Layanan Bimbingan Konseling, informasi akademik, dan program unggulan.')

@section('content')

{{-- HERO --}}
<section class="relative bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white overflow-hidden min-h-[92vh] flex items-center">
    <div class="absolute inset-0 opacity-10"
         style="background-image:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 py-20 grid lg:grid-cols-2 gap-12 items-center">
        <div class="fade-up">
            <span class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-sm border border-white/25 text-yellow-300 text-xs font-semibold px-4 py-1.5 rounded-full mb-6">
                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                Penerimaan Peserta Didik Baru 2025/2026
            </span>
            <h1 class="font-serif text-4xl md:text-5xl xl:text-6xl font-bold leading-tight mb-5">
                Selamat Datang di<br>
                <span class="text-yellow-400">SMA Negeri 3</span><br>
                Kediri
            </h1>
            <p class="text-green-100 text-lg leading-relaxed mb-8 max-w-lg">
                Membentuk generasi unggul, berkarakter, dan berdaya saing global melalui pendidikan berkualitas dan layanan Bimbingan Konseling terpadu.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#layanan-bk" id="btn-hero-bk"
                   class="btn-ripple px-7 py-3.5 bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold rounded-xl shadow-lg transition-all duration-300 text-sm">
                    Layanan BK
                </a>
                <a href="#profil" id="btn-hero-profil"
                   class="px-7 py-3.5 border-2 border-white/40 hover:border-white hover:bg-white/10 text-white font-semibold rounded-xl transition-all duration-300 text-sm">
                    Profil Sekolah
                </a>
            </div>
            <div class="mt-10 grid grid-cols-3 gap-6">
                @foreach([['850+','Siswa Aktif'],['62','Tenaga Pendidik'],['A','Akreditasi']] as [$num,$label])
                <div class="text-center">
                    <p class="text-3xl font-extrabold text-yellow-400 counter-number">{{ $num }}</p>
                    <p class="text-green-200 text-xs mt-1">{{ $label }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Ilustrasi Sekolah --}}
        <div class="hidden lg:flex justify-center items-end relative fade-up fade-up-delay-1">
            <div class="relative w-full max-w-md">
                {{-- Gedung utama --}}
                <svg viewBox="0 0 460 340" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full drop-shadow-2xl">
                    <!-- Sky background -->
                    <rect width="460" height="340" rx="20" fill="#1a4731" fill-opacity="0.3"/>
                    <!-- Clouds -->
                    <ellipse cx="80" cy="50" rx="45" ry="22" fill="white" fill-opacity="0.15"/>
                    <ellipse cx="110" cy="44" rx="35" ry="18" fill="white" fill-opacity="0.2"/>
                    <ellipse cx="340" cy="60" rx="40" ry="20" fill="white" fill-opacity="0.15"/>
                    <ellipse cx="370" cy="55" rx="30" ry="16" fill="white" fill-opacity="0.2"/>
                    <!-- Ground -->
                    <rect x="0" y="280" width="460" height="60" rx="0" fill="#14532d" fill-opacity="0.6"/>
                    <!-- Grass -->
                    <ellipse cx="230" cy="280" rx="230" ry="12" fill="#16a34a" fill-opacity="0.5"/>
                    <!-- Main building body -->
                    <rect x="90" y="130" width="280" height="150" fill="#15803d" fill-opacity="0.85"/>
                    <!-- Roof -->
                    <polygon points="70,130 230,60 390,130" fill="#166534" fill-opacity="0.9"/>
                    <!-- Roof ridge cap -->
                    <polygon points="200,75 230,60 260,75 230,68" fill="#fbbf24" fill-opacity="0.9"/>
                    <!-- Flag pole -->
                    <rect x="227" y="30" width="6" height="50" fill="#fbbf24" fill-opacity="0.9"/>
                    <rect x="233" y="30" width="30" height="20" fill="#ef4444" fill-opacity="0.9"/>
                    <rect x="233" y="50" width="30" height="10" fill="white" fill-opacity="0.9"/>
                    <!-- Main door -->
                    <rect x="195" y="210" width="70" height="70" rx="35" fill="#052e16" fill-opacity="0.7"/>
                    <rect x="203" y="218" width="54" height="62" rx="27" fill="#14532d" fill-opacity="0.5"/>
                    <!-- Windows row 1 -->
                    <rect x="110" y="155" width="50" height="45" rx="5" fill="#bbf7d0" fill-opacity="0.3"/>
                    <rect x="115" y="160" width="40" height="35" rx="3" fill="#4ade80" fill-opacity="0.2"/>
                    <rect x="300" y="155" width="50" height="45" rx="5" fill="#bbf7d0" fill-opacity="0.3"/>
                    <rect x="305" y="160" width="40" height="35" rx="3" fill="#4ade80" fill-opacity="0.2"/>
                    <!-- Windows row 2 -->
                    <rect x="110" y="210" width="50" height="40" rx="5" fill="#bbf7d0" fill-opacity="0.3"/>
                    <rect x="300" y="210" width="50" height="40" rx="5" fill="#bbf7d0" fill-opacity="0.3"/>
                    <!-- Side wings -->
                    <rect x="20" y="175" width="70" height="105" rx="4" fill="#166534" fill-opacity="0.7"/>
                    <rect x="370" y="175" width="70" height="105" rx="4" fill="#166534" fill-opacity="0.7"/>
                    <!-- Wing windows -->
                    <rect x="33" y="192" width="44" height="35" rx="4" fill="#bbf7d0" fill-opacity="0.3"/>
                    <rect x="383" y="192" width="44" height="35" rx="4" fill="#bbf7d0" fill-opacity="0.3"/>
                    <rect x="33" y="235" width="44" height="35" rx="4" fill="#bbf7d0" fill-opacity="0.3"/>
                    <rect x="383" y="235" width="44" height="35" rx="4" fill="#bbf7d0" fill-opacity="0.3"/>
                    <!-- Trees -->
                    <rect x="35" y="240" width="8" height="40" fill="#052e16" fill-opacity="0.6"/>
                    <ellipse cx="39" cy="235" rx="20" ry="26" fill="#15803d" fill-opacity="0.8"/>
                    <rect x="415" y="240" width="8" height="40" fill="#052e16" fill-opacity="0.6"/>
                    <ellipse cx="419" cy="235" rx="20" ry="26" fill="#15803d" fill-opacity="0.8"/>
                    <!-- School sign board -->
                    <rect x="155" y="135" width="150" height="30" rx="4" fill="#fbbf24" fill-opacity="0.9"/>
                    <text x="230" y="156" text-anchor="middle" font-family="sans-serif" font-size="11" font-weight="bold" fill="#052e16">SMAN 3 KEDIRI</text>
                    <!-- Decorative stars -->
                    <circle cx="148" cy="90" r="3" fill="#fbbf24" fill-opacity="0.7"/>
                    <circle cx="312" cy="85" r="2" fill="#fbbf24" fill-opacity="0.7"/>
                    <circle cx="170" cy="70" r="2" fill="white" fill-opacity="0.5"/>
                </svg>
                {{-- Floating badges --}}
                <div class="absolute -top-4 -right-4 bg-yellow-400 text-green-900 text-xs font-bold px-4 py-2 rounded-2xl shadow-xl rotate-3">
                    Akreditasi A ⭐
                </div>
                <div class="absolute -bottom-2 -left-4 bg-white text-green-800 text-xs font-bold px-4 py-2 rounded-2xl shadow-xl -rotate-2">
                    Est. 1985 🏫
                </div>
            </div>
        </div>
    </div>

    {{-- Wave divider --}}
    <div class="wave-bottom">
        <svg viewBox="0 0 1200 70" preserveAspectRatio="none">
            <path d="M0,40 C300,80 900,0 1200,40 L1200,70 L0,70 Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- RUNNING TEXT --}}
<div class="bg-green-700 text-white py-3 overflow-hidden">
    <div class="flex items-center gap-0">
        <span class="shrink-0 bg-yellow-400 text-green-900 text-xs font-bold px-4 py-1 mr-4 z-10">INFO</span>
        <div class="overflow-hidden flex-1">
            <div class="marquee-track flex gap-16 whitespace-nowrap text-sm">
                @foreach(array_fill(0,2,['Selamat datang di website resmi SMA Negeri 3 Kediri','PPDB 2025/2026 dibuka mulai 1 Juni 2025','Pendaftaran ekstrakulikuler batch 2 dibuka','Konseling BK tersedia setiap hari sekolah pukul 07.00–14.00','Kunjungi ruang BK di lantai 1 gedung utama']) as $texts)
                    @foreach($texts as $text)
                        <span class="mx-8">📢 {{ $text }}</span>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- STATS BAR --}}
<section class="py-10 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
                ['icon'=>'🎓','value'=>'850+','label'=>'Siswa Aktif','color'=>'green'],
                ['icon'=>'👩‍🏫','value'=>'62','label'=>'Tenaga Pendidik','color'=>'blue'],
                ['icon'=>'🏆','value'=>'120+','label'=>'Prestasi','color'=>'yellow'],
                ['icon'=>'📚','value'=>'18','label'=>'Ekstrakurikuler','color'=>'purple'],
            ] as $stat)
            <div class="flex items-center gap-4 p-5 rounded-2xl bg-gray-50 hover:bg-green-50 transition-colors group">
                <span class="text-3xl">{{ $stat['icon'] }}</span>
                <div>
                    <p class="text-2xl font-extrabold text-green-800 counter-number">{{ $stat['value'] }}</p>
                    <p class="text-xs text-gray-500 font-medium">{{ $stat['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- LAYANAN BK --}}
<section id="layanan-bk" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-xs font-semibold text-green-600 uppercase tracking-widest bg-green-100 px-4 py-1.5 rounded-full">Bimbingan Konseling</span>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-gray-900">Layanan BK <span class="text-green-700">Kami</span></h2>
            <p class="mt-3 text-gray-500 max-w-xl mx-auto text-sm leading-relaxed">Kami hadir untuk membimbing siswa tumbuh secara holistik — akademik, sosial, karir, dan pribadi.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['emoji'=>'🧑‍🤝‍🧑','title'=>'Konseling Individu','desc'=>'Sesi tatap muka rahasia bersama konselor untuk masalah pribadi, akademik, maupun sosial.','badge'=>'Tersedia','color'=>'green'],
                ['emoji'=>'👥','title'=>'Konseling Kelompok','desc'=>'Diskusi kelompok terarah untuk mengembangkan keterampilan sosial dan menyelesaikan masalah bersama.','badge'=>'Tersedia','color'=>'green'],
                ['emoji'=>'📖','title'=>'Bimbingan Akademik','desc'=>'Pendampingan perencanaan belajar, remedial, dan strategi menghadapi ujian nasional.','badge'=>'Tersedia','color'=>'green'],
                ['emoji'=>'💼','title'=>'Bimbingan Karir','desc'=>'Eksplorasi minat bakat, informasi PTN/PTS, dan perencanaan masa depan siswa.','badge'=>'Tersedia','color'=>'green'],
                ['emoji'=>'👨‍👩‍👧','title'=>'Konsultasi Orang Tua','desc'=>'Pertemuan orang tua/wali dengan konselor untuk membahas perkembangan putra-putri.','badge'=>'Janji Temu','color'=>'yellow'],
                ['emoji'=>'📬','title'=>'Laporan Anonim','desc'=>'Sampaikan permasalahan secara anonim melalui kotak saran digital yang aman dan terjamin.','badge'=>'Online 24 Jam','color'=>'blue'],
            ] as $s)
            <div class="service-card bg-white rounded-2xl p-6 shadow-sm border border-gray-100 group cursor-pointer">
                <div class="w-14 h-14 rounded-2xl bg-green-50 group-hover:bg-green-100 flex items-center justify-center text-2xl mb-4 transition-colors">
                    {{ $s['emoji'] }}
                </div>
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-gray-900 text-base">{{ $s['title'] }}</h3>
                    <span class="text-xs font-semibold px-2 py-1 rounded-full ml-2 shrink-0
                        {{ $s['color']==='green' ? 'bg-green-100 text-green-700' : ($s['color']==='yellow' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700') }}">
                        {{ $s['badge'] }}
                    </span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $s['desc'] }}</p>
                <a href="#" class="mt-4 inline-flex items-center gap-1 text-green-700 font-semibold text-sm hover:gap-2 transition-all">
                    Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ABOUT / VISI MISI --}}
<section id="profil" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-14 items-center">
        <div>
            <span class="text-xs font-semibold text-green-600 uppercase tracking-widest bg-green-100 px-4 py-1.5 rounded-full">Tentang Kami</span>
            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                Sekolah Unggulan<br><span class="text-green-700">Kota Kediri</span>
            </h2>
            <p class="mt-4 text-gray-600 leading-relaxed">
                SMA Negeri 3 Kediri berdiri sejak 1985 dan telah meluluskan ribuan alumni berprestasi. Dengan akreditasi A dari BAN-S/M, kami berkomitmen menghadirkan pendidikan bermutu tinggi yang menyentuh aspek akademik, karakter, dan spiritual siswa.
            </p>
            <div class="mt-8 space-y-4">
                @foreach([
                    ['🎯','Visi','Menjadi sekolah unggul bertaraf nasional yang menghasilkan lulusan beriman, berilmu, dan berakhlak mulia.'],
                    ['🚀','Misi','Menyelenggarakan pembelajaran inovatif berbasis teknologi, pengembangan karakter, dan kemitraan dengan orang tua serta masyarakat.'],
                ] as [$icon,$title,$text])
                <div class="flex gap-4 p-5 rounded-2xl bg-gray-50 hover:bg-green-50 transition-colors">
                    <span class="text-2xl shrink-0 mt-0.5">{{ $icon }}</span>
                    <div>
                        <h4 class="font-bold text-green-800 mb-1">{{ $title }}</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $text }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach([
                ['bg-green-700','🏆','Prestasi Nasional','Juara lomba sains & olahraga tingkat provinsi dan nasional'],
                ['bg-green-800','🎨','Ekskul Aktif','18 kegiatan ekstrakurikuler seni, olahraga, dan akademik'],
                ['bg-yellow-500','💻','Lab Modern','Laboratorium komputer, sains, dan bahasa berteknologi terkini'],
                ['bg-green-600','📡','Internet Cepat','WiFi tersebar di seluruh area sekolah untuk mendukung belajar'],
            ] as [$bg,$icon,$title,$desc])
            <div class="{{ $bg }} text-white rounded-2xl p-6 hover:scale-105 transition-transform cursor-default shadow">
                <span class="text-3xl mb-3 block">{{ $icon }}</span>
                <h4 class="font-bold text-base mb-1">{{ $title }}</h4>
                <p class="text-white/80 text-xs leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BERITA TERKINI --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs font-semibold text-green-600 uppercase tracking-widest bg-green-100 px-4 py-1.5 rounded-full">Informasi</span>
                <h2 class="mt-4 text-3xl font-bold text-gray-900">Berita <span class="text-green-700">Terkini</span></h2>
            </div>
            <a href="#" class="text-green-700 font-semibold text-sm hover:underline hidden sm:block">Lihat Semua →</a>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['📅','10 Apr 2025','Peringatan Hari Pendidikan Nasional','SMAN 3 Kediri memperingati Hari Pendidikan Nasional dengan upacara khidmat dan berbagai lomba antar kelas.'],
                ['🏅','5 Apr 2025','Juara 1 OSN Matematika Tingkat Kota','Siswa kami meraih juara pertama Olimpiade Sains Nasional bidang Matematika tingkat Kota Kediri.'],
                ['📣','28 Mar 2025','Sosialisasi PPDB 2025/2026','Sekolah mengadakan sosialisasi penerimaan peserta didik baru tahun ajaran 2025/2026 untuk calon siswa.'],
            ] as [$icon,$date,$title,$excerpt])
            <article class="news-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                <div class="bg-gradient-to-br from-green-600 to-green-800 h-40 flex items-center justify-center">
                    <span class="text-6xl">{{ $icon }}</span>
                </div>
                <div class="p-6">
                    <p class="text-xs text-green-600 font-semibold mb-2">{{ $date }}</p>
                    <h3 class="font-bold text-gray-900 mb-2 leading-snug">{{ $title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3">{{ $excerpt }}</p>
                    <a href="#" class="mt-4 inline-flex items-center gap-1 text-green-700 font-semibold text-sm hover:gap-2 transition-all">
                        Baca Selengkapnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA KONTAK --}}
<section class="py-16 bg-gradient-to-r from-green-800 to-green-700 text-white">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan atau Konsultasi?</h2>
        <p class="text-green-100 mb-8 leading-relaxed">Tim Bimbingan Konseling kami siap membantu. Hubungi kami atau kunjungi ruang BK di sekolah.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="#" class="btn-ripple px-8 py-3.5 bg-yellow-400 hover:bg-yellow-300 text-green-900 font-bold rounded-xl shadow-lg transition-all">
                📞 Hubungi Sekarang
            </a>
            <a href="#" class="px-8 py-3.5 border-2 border-white/40 hover:bg-white/10 text-white font-semibold rounded-xl transition-all">
                📬 Kirim Pesan Anonim
            </a>
        </div>
    </div>
</section>

@endsection
