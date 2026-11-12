<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fasilitas Gym & Program Latihan | Maco Gym Malang</title>
    <meta name="description" content="Jelajahi fasilitas lengkap Maco Gym Malang: Free Weights Zone, Plate-Loaded Machines, Cardio Theater, Shower Air Hangat, Musholla Ber-AC, dan program latihan terarah.">
    <meta name="keywords" content="fasilitas gym malang, alat gym lengkap malang, program latihan fitness malang, kelas gym mahasiswa malang, personal trainer malang">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Fasilitas Gym & Program Latihan | Maco Gym Malang">
    <meta property="og:description" content="Peralatan beban lengkap, cardio theater, locker room bersih air hangat, musholla ber-AC, dan bimbingan Coach profesional di Malang.">
    <meta property="og:image" content="{{ asset('images/about-gym.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/macogym.jpg') }}">

    <!-- Font Awesome 6 Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-zinc-800 antialiased selection:bg-red-600 selection:text-white font-sans min-h-screen flex flex-col">

    <!-- Navbar & Top Info Bar -->
    @include('guest.partials.navbar')

    <!-- Main Content Area with Fullscreen Hero Matching Home Banner -->
    <main class="flex-grow">

        <!-- ================= 1. HERO SECTION & BREADCRUMB ================= -->
        <section class="relative h-[100dvh] min-h-[520px] max-h-[920px] flex flex-col justify-center overflow-hidden bg-zinc-950 text-white pt-20 sm:pt-24 lg:pt-28 pb-6 border-b border-zinc-200">
            <!-- Background Image with Directional Dark Gradient (Exact Match with Home Hero) -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/about-gym.jpg') }}"
                     alt="Fasilitas Maco Gym Malang"
                     class="w-full h-full object-cover object-center filter brightness-50 contrast-105">
                <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/90 sm:via-zinc-950/80 to-transparent w-full md:w-3/4 lg:w-3/5 pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/90 via-zinc-950/30 to-transparent pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
            </div>

            <div class="relative z-10 w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12 my-auto text-left flex flex-col items-start space-y-4 sm:space-y-5">
                
                <!-- Breadcrumb -->
                <nav aria-label="Breadcrumb">
                    <ol class="flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-zinc-400">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Beranda</a>
                        </li>
                        <li>
                            <span class="text-zinc-600">/</span>
                        </li>
                        <li class="text-red-500 font-bold" aria-current="page">
                            Fasilitas & Program
                        </li>
                    </ol>
                </nav>

                <div class="max-w-3xl space-y-4">
                    <!-- Eyebrow Tagline -->
                    <div class="inline-flex items-center gap-2.5">
                        <span class="w-6 h-[2px] bg-red-500"></span>
                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-red-500 font-montserrat">
                            STANDAR ALAT & KENYAMANAN MEMBER
                        </span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="font-montserrat text-3xl sm:text-5xl lg:text-6xl font-black uppercase text-white tracking-tight leading-tight">
                        FASILITAS LENGKAP & <br>
                        <span class="text-red-600 drop-shadow-[0_0_25px_rgba(239,68,68,0.4)]">PROGRAM LATIHAN</span>
                    </h1>

                    <!-- Lead Paragraph -->
                    <p class="text-sm sm:text-base text-zinc-300 leading-relaxed font-normal pt-1 max-w-2xl">
                        Maco Gym Malang menyediakan zonasi latihan terstruktur, mesin beban berkualitas, area kardio modern, serta fasilitas pendukung yang bersih dan nyaman untuk mendukung target fisikmu setiap hari.
                    </p>

                    <!-- Quick Action Buttons -->
                    <div class="pt-4 flex flex-wrap items-center gap-3.5">
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/30 transition transform hover:-translate-y-0.5">
                            <span>DAFTAR MEMBER SEKARANG</span>
                            <svg class="w-4 h-4 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>

                        <a href="{{ route('home') }}#pricing"
                           class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-zinc-900/90 hover:bg-white hover:text-zinc-950 border border-zinc-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition">
                            <span>LIHAT HARGA PAKET</span>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ================= 2. ZONA & FASILITAS LENGKAP (8 ZONASI DETAIL) ================= -->
        <section id="zonasi-fasilitas" class="py-20 lg:py-24 bg-white border-b border-zinc-200">
            <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
                
                <!-- Section Header (Clean Centered Athletic Hierarchy) -->
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                    <div class="flex items-center justify-center gap-3 mb-1">
                        <span class="w-8 h-[2px] bg-red-600"></span>
                        <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">GYM FACILITIES</span>
                        <span class="w-8 h-[2px] bg-red-600"></span>
                    </div>
                    <h2 class="font-montserrat text-3xl sm:text-5xl font-black uppercase text-zinc-900 tracking-tight">
                        8 ZONASI FASILITAS <span class="text-red-600">MACO GYM</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-zinc-600 max-w-2xl mx-auto leading-relaxed">
                        Seluruh area dirancang ergonomis dengan sirkulasi udara dingin dan ruang gerak lapang agar sesi latihanmu aman, fokus, dan efektif.
                    </p>
                </div>

                <!-- 8 Facilities Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Fac 1: Free Weights Zone -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-dumbbell"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 01</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Zona Beban Bebas</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Free Weights Zone
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Dumbbell set presisi dari bobot 1 kg hingga 50 kg, Olympic Barbells standar kompetisi, Incline/Flat Bench kokoh, dan Squat Racks heavy-duty.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Rubber floor tebal antislip
                        </div>
                    </div>

                    <!-- Fac 2: Plate-Loaded & Selectorized Machines -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-weight-hanging"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 02</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Mesin Beban Isolasi</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Plate-Loaded Machines
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Smith Machine aman, 45-Degree Leg Press, Hack Squat, Lat Pulldown, Cable Crossover ganda, dan Seated Row dengan jalur gerak biomekanik stabil.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Beban plate & pin teratur
                        </div>
                    </div>

                    <!-- Fac 3: Cardio Theater -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-heart-pulse"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 03</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Kardio & Stamina</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Cardio Theater
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Treadmill auto-incline peredam getaran, Elliptical Trainer low-impact, Spinning Bike kecepatan tinggi, dan Stairmaster untuk melatih daya tahan kardiovaskular.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Monitor detak jantung & jarak
                        </div>
                    </div>

                    <!-- Fac 4: Functional & Calisthenics Zone -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-fire-flame-curved"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 04</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Latihan Fungsional</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Functional Zone
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Battle Ropes berat, variasi Kettlebell cast iron, Plyometric Jump Boxes, Slam Balls, Resistance Bands, dan Pull-Up Rig untuk kelincahan tubuh.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Latihan mobilitas & calisthenics
                        </div>
                    </div>

                    <!-- Fac 5: Locker & Shower Air Hangat -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-shower"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 05</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Kenyamanan & Kebersihan</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Locker & Hot Shower
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Loker pribadi berkunci aman untuk menyimpan barang berharga, ruang bilas shower air hangat bersih, wastafel terawat, dan cermin grooming luas.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Rutin dibersihkan setiap sesi
                        </div>
                    </div>

                    <!-- Fac 6: Musholla Ber-AC -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-mosque"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 06</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Ibadah Nyaman</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Musholla Ber-AC
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Ruang ibadah terpisah yang tenang, sejuk berpendingin AC, dilengkapi sajadah bersih dan tempat wudhu khusus agar ibadah tetap tepat waktu saat jadwal latihan.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Sajadah, mukena & wudhu bersih
                        </div>
                    </div>

                    <!-- Fac 7: Protein & Supplement Bar -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-bottle-water"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 07</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Nutrisi & Pemulihan</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Protein & Supplement Bar
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Tersedia shaker Whey Protein segar racikan dingin, Pre-Workout penambah fokus, BCAA intra-workout, snack energi berprotein, dan air mineral dingin di meja resepsionis.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Ready-to-drink post workout
                        </div>
                    </div>

                    <!-- Fac 8: Full AC & High-Energy Audio -->
                    <div class="group p-6 sm:p-7 rounded-2xl bg-zinc-50 border border-zinc-200 hover:border-red-600 hover:bg-white transition-all duration-300 shadow-xs hover:shadow-xl flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center text-xl group-hover:bg-red-600 transition-colors shadow-sm">
                                    <i class="fa-solid fa-volume-high"></i>
                                </div>
                                <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">ZONE 08</span>
                            </div>
                            <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Atmosfer Latihan</span>
                            <h3 class="font-montserrat text-lg font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors mb-2">
                                Full AC & Audio System
                            </h3>
                            <p class="text-xs text-zinc-600 leading-relaxed mb-4 font-normal">
                                Udara sejuk berpendingin AC bebas pengap dan sirkulasi bersih, dipadukan alunan playlist musik workout berenergi tinggi untuk menjaga ritme latihan tetap maksimal.
                            </p>
                        </div>
                        <div class="pt-3 border-t border-zinc-200/80 text-[11px] text-zinc-500 font-mono">
                            ✓ Buka setiap hari 06:00 - 22:00
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ================= 3. PROGRAM LATIHAN & KELAS KEBUGARAN (6 PROGRAM UNGGULAN) ================= -->
        <section id="program-kelas" class="py-20 lg:py-24 bg-zinc-50 border-b border-zinc-200">
            <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">

                <!-- Header (Clean Line Accent instead of dots) -->
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                    <div class="flex items-center justify-center gap-3 mb-1">
                        <span class="w-8 h-[2px] bg-red-600"></span>
                        <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">FITNESS PROGRAMS & CLASSES</span>
                        <span class="w-8 h-[2px] bg-red-600"></span>
                    </div>
                    <h2 class="font-montserrat text-3xl sm:text-5xl font-black uppercase text-zinc-900 tracking-tight">
                        PILIHAN PROGRAM <span class="text-red-600">LATIHAN TERARAH</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-zinc-600 max-w-2xl mx-auto leading-relaxed">
                        Setiap orang memiliki target tubuh yang berbeda. Di Maco Gym, kamu bebas memilih pola latihan yang sesuai dengan kebutuhan fisikmu.
                    </p>
                </div>

                <!-- 6 Programs Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Program 1: Strength & Powerbuilding -->
                    <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/programs/strength.jpg') }}"
                                 alt="Strength and Powerbuilding Maco Gym"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                            <div>
                                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Kekuatan Murni</span>
                                <h3 class="font-montserrat text-xl font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                                    Strength & Powerbuilding
                                </h3>
                                <p class="text-xs text-zinc-600 leading-relaxed mt-2 font-normal">
                                    Fokus pada gerakan compound lift fundamental: Barbell Back Squat, Flat Bench Press, dan Deadlift untuk membangun kepadatan tulang serta kekuatan saraf otot.
                                </p>
                            </div>
                            <div class="pt-4 border-t border-zinc-100 space-y-2">
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Target:</span>
                                    <strong class="text-zinc-800">Kekuatan & Massa Otot</strong>
                                </div>
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Durasi Sesi:</span>
                                    <strong class="text-zinc-800">45 - 60 Menit</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program 2: Fat Loss & HIIT Conditioning -->
                    <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/programs/weightloss.jpg') }}"
                                 alt="Fat Loss & HIIT Conditioning Maco Gym"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                            <div>
                                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Pembakaran Kalori</span>
                                <h3 class="font-montserrat text-xl font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                                    Fat Loss & HIIT Conditioning
                                </h3>
                                <p class="text-xs text-zinc-600 leading-relaxed mt-2 font-normal">
                                    Kombinasi sirkuit beban fungsional dan kardio interval yang memicu pembakaran kalori bahkan setelah selesai berolahraga (efek EPOC) tanpa mengorbankan massa otot.
                                </p>
                            </div>
                            <div class="pt-4 border-t border-zinc-100 space-y-2">
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Target:</span>
                                    <strong class="text-zinc-800">Penurunan Lemak Tubuh</strong>
                                </div>
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Durasi Sesi:</span>
                                    <strong class="text-zinc-800">35 - 50 Menit</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program 3: Hypertrophy & Muscle Sculpting -->
                    <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/programs/muscle.jpg') }}"
                                 alt="Hypertrophy Program Maco Gym"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                            <div>
                                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Pembentukan Tubuh</span>
                                <h3 class="font-montserrat text-xl font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                                    Hypertrophy & Muscle Sculpting
                                </h3>
                                <p class="text-xs text-zinc-600 leading-relaxed mt-2 font-normal">
                                    Rancangan repetisi 8-12 reps dengan kontrol tempo beban pada mesin isolasi dan kabel untuk mempertegas garis otot bahu, dada, punggung, serta kaki secara proporsional.
                                </p>
                            </div>
                            <div class="pt-4 border-t border-zinc-100 space-y-2">
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Target:</span>
                                    <strong class="text-zinc-800">Bentuk Tubuh & Proporsi</strong>
                                </div>
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Durasi Sesi:</span>
                                    <strong class="text-zinc-800">50 - 70 Menit</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program 4: Functional Mobility & Active Recovery -->
                    <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/programs/flexibility.jpg') }}"
                                 alt="Functional Mobility Maco Gym"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                            <div>
                                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Mobilitas Sendi</span>
                                <h3 class="font-montserrat text-xl font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                                    Mobility & Active Recovery
                                </h3>
                                <p class="text-xs text-zinc-600 leading-relaxed mt-2 font-normal">
                                    Rangkaian peregangan dinamis, penguatan otot penopang tulang belakang (core), dan perbaikan rentang gerak sendi untuk mencegah nyeri pinggang serta pegal setelah latihan.
                                </p>
                            </div>
                            <div class="pt-4 border-t border-zinc-100 space-y-2">
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Target:</span>
                                    <strong class="text-zinc-800">Kelenturan & Bebas Cedera</strong>
                                </div>
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Durasi Sesi:</span>
                                    <strong class="text-zinc-800">30 - 45 Menit</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program 5: Student & Beginner Orientation -->
                    <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/about-gym.jpg') }}"
                                 alt="Beginner and Student Gym Orientation"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                            <div>
                                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Ramah Pemula</span>
                                <h3 class="font-montserrat text-xl font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                                    Student & Beginner Orientation
                                </h3>
                                <p class="text-xs text-zinc-600 leading-relaxed mt-2 font-normal">
                                    Program khusus bagi member baru atau mahasiswa yang baru pertama kali masuk gym. Staff instruktur akan mendampingi pengenalan fungsi setiap alat dan tata krama gym.
                                </p>
                            </div>
                            <div class="pt-4 border-t border-zinc-100 space-y-2">
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Target:</span>
                                    <strong class="text-zinc-800">Edukasi Alat & Percaya Diri</strong>
                                </div>
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Biaya:</span>
                                    <strong class="text-emerald-600">Gratis untuk Member Baru</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Program 6: 1-on-1 Personal Trainer Coaching -->
                    <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('images/trainers/coach-rangga.jpg') }}"
                                 alt="Personal Trainer Maco Gym"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                            <div>
                                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 block mb-1">Privat & Terarah</span>
                                <h3 class="font-montserrat text-xl font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                                    1-on-1 Personal Coaching
                                </h3>
                                <p class="text-xs text-zinc-600 leading-relaxed mt-2 font-normal">
                                    Pendampingan privat intensif bersama pelatih berlisensi. Setiap repetisi, pengaturan beban progresif, dan pola nutrisi harian diawasi secara eksklusif.
                                </p>
                            </div>
                            <div class="pt-4 border-t border-zinc-100 space-y-2">
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Target:</span>
                                    <strong class="text-zinc-800">Hasil Cepat & Form Presisi</strong>
                                </div>
                                <div class="flex items-center justify-between text-xs text-zinc-500 font-mono">
                                    <span>Paket:</span>
                                    <strong class="text-red-600">12 Sesi / 30 Hari</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ================= 4. TIM COACH BERLISENSI ================= -->
        <section class="py-20 lg:py-24 bg-white border-b border-zinc-200">
            <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">

                <!-- Section Header (Clean Centered Athletic Hierarchy) -->
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                    <div class="flex items-center justify-center gap-3 mb-1">
                        <span class="w-8 h-[2px] bg-red-600"></span>
                        <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">CERTIFIED COACHES</span>
                        <span class="w-8 h-[2px] bg-red-600"></span>
                    </div>
                    <h2 class="font-montserrat text-3xl sm:text-5xl font-black uppercase text-zinc-900 tracking-tight">
                        DIDUKUNG OLEH <span class="text-red-600">COACH BERPENGALAMAN</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-zinc-600 max-w-2xl mx-auto leading-relaxed">
                        Form latihan yang benar adalah kunci utama menghindari cedera. Tim coach Maco Gym siap memberikan koreksi teknik dan konsultasi program.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Coach 1 -->
                    <div class="p-5 rounded-2xl bg-zinc-50 border border-zinc-200 flex flex-col justify-between space-y-4 hover:border-red-500/60 transition shadow-xs">
                        <div class="h-64 rounded-xl overflow-hidden relative">
                            <img src="{{ asset('images/trainers/coach-rangga.jpg') }}" alt="Coach Rangga" class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase text-red-600">Head Coach</span>
                            <h4 class="font-montserrat font-bold text-base text-zinc-900 uppercase">Coach Rangga Pratama, S.Or</h4>
                            <p class="text-xs text-zinc-500 mt-1">Spesialis Hypertrophy & Body Recomposition (APKI Certified).</p>
                        </div>
                    </div>

                    <!-- Coach 2 -->
                    <div class="p-5 rounded-2xl bg-zinc-50 border border-zinc-200 flex flex-col justify-between space-y-4 hover:border-red-500/60 transition shadow-xs">
                        <div class="h-64 rounded-xl overflow-hidden relative">
                            <img src="{{ asset('images/trainers/coach-kevin.jpg') }}" alt="Coach Kevin" class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase text-red-600">Senior Coach</span>
                            <h4 class="font-montserrat font-bold text-base text-zinc-900 uppercase">Coach Kevin Ardian, CPT</h4>
                            <p class="text-xs text-zinc-500 mt-1">Pakar Fat Loss & High Intensity Cardio (NASM Certified).</p>
                        </div>
                    </div>

                    <!-- Coach 3 -->
                    <div class="p-5 rounded-2xl bg-zinc-50 border border-zinc-200 flex flex-col justify-between space-y-4 hover:border-red-500/60 transition shadow-xs">
                        <div class="h-64 rounded-xl overflow-hidden relative">
                            <img src="{{ asset('images/trainers/coach-sarah.jpg') }}" alt="Coach Maya" class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase text-red-600">Female Specialist</span>
                            <h4 class="font-montserrat font-bold text-base text-zinc-900 uppercase">Coach Maya Septiani, CSN</h4>
                            <p class="text-xs text-zinc-500 mt-1">Program Glutes, Core Strength & Konsultasi Pola Makan Sehat.</p>
                        </div>
                    </div>

                    <!-- Coach 4 -->
                    <div class="p-5 rounded-2xl bg-zinc-50 border border-zinc-200 flex flex-col justify-between space-y-4 hover:border-red-500/60 transition shadow-xs">
                        <div class="h-64 rounded-xl overflow-hidden relative">
                            <img src="{{ asset('images/trainers/coach-dimas.jpg') }}" alt="Coach Dimas" class="w-full h-full object-cover object-top">
                        </div>
                        <div>
                            <span class="text-[10px] font-mono font-bold uppercase text-red-600">Power Coach</span>
                            <h4 class="font-montserrat font-bold text-base text-zinc-900 uppercase">Coach Dimas Wahyu, CSCS</h4>
                            <p class="text-xs text-zinc-500 mt-1">Spesialis Angkat Beban Berat & Adaptasi Mobilitas Gerak Sendi.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ================= 5. CALL TO ACTION BANNER ================= -->
        <section class="py-16 sm:py-20 bg-zinc-950 text-white relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10 text-center space-y-6">
                <div class="flex items-center justify-center gap-3">
                    <span class="w-8 h-[2px] bg-red-600"></span>
                    <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-500 font-montserrat">
                        GABUNG SEKARANG JUGA
                    </span>
                    <span class="w-8 h-[2px] bg-red-600"></span>
                </div>

                <h2 class="font-montserrat text-3xl sm:text-5xl font-black uppercase text-white tracking-tight max-w-2xl mx-auto leading-tight">
                    SIAP MEMULAI LATIHAN DI <span class="text-red-600">MACO GYM MALANG</span>?
                </h2>

                <p class="text-xs sm:text-sm text-zinc-400 max-w-xl mx-auto leading-relaxed font-normal">
                    Dapatkan akses bebas fasilitas setiap hari, tarif mahasiswa mulai Rp 135 ribu/bulan, tanpa biaya pendaftaran tersembunyi.
                </p>

                <div class="pt-4 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('register') }}"
                       class="px-8 py-3.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/30 transition transform hover:-translate-y-0.5">
                        DAFTAR MEMBER ONLINE
                    </a>

                    <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym,%20saya%20ingin%20tanya%20seputar%20fasilitas%20dan%20membership."
                       target="_blank"
                       rel="noopener noreferrer"
                       class="px-8 py-3.5 rounded-xl bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition">
                        HUBUNGI ADMIN WHATSAPP
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- Pre-Footer Banner & Footer (Shared Component) -->
    <x-footer />

    <!-- Header Scroll & Mobile Nav Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    const isHidden = mobileMenu.classList.contains('hidden');
                    mobileMenu.classList.toggle('hidden', !isHidden);
                    if (hamburgerIcon) hamburgerIcon.classList.toggle('hidden', isHidden);
                    if (closeIcon) closeIcon.classList.toggle('hidden', !isHidden);
                });
            }

            const header = document.getElementById('main-header');
            if (header) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 30) {
                        header.classList.add('shadow-md');
                    } else {
                        header.classList.remove('shadow-md');
                    }
                });
            }
        });
    </script>
</body>
</html>

