<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fasilitas Lengkap & Peralatan Gym | Maco Gym Malang</title>
    <meta name="description" content="Jelajahi fasilitas resmi dan peralatan modern Maco Gym Malang: Power Rack, Leg Press, Chest Press, Treadmill, Free Refill Water, Locker Room, dan Maco Cafe.">
    <meta name="keywords" content="fasilitas gym malang, alat gym lengkap malang, alat fitness maco gym, maco gym cafe, treadmill malang, power rack malang">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Fasilitas Lengkap & Peralatan Gym | Maco Gym Malang">
    <meta property="og:description" content="Peralatan beban lengkap standar komersial, cardio theater, locker room bersih, water dispenser gratis, dan Maco Cafe di Malang.">
    <meta property="og:image" content="{{ asset('images/showroom/room-4.png') }}">

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

        <!-- ================= 1. HERO SECTION & BREADCRUMB (Background: room-4) ================= -->
        <section class="relative min-h-[620px] lg:min-h-[700px] flex flex-col justify-center overflow-hidden bg-zinc-950 text-white pt-24 sm:pt-28 lg:pt-32 pb-16 sm:pb-20 lg:pb-24 border-b border-zinc-800">
            <!-- Background Image with Directional Dark Gradient (room-4.png) -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/showroom/room-4.png') }}"
                     alt="Fasilitas Maco Gym Malang"
                     class="w-full h-full object-cover object-center filter brightness-65 contrast-105">
                
                <!-- Responsive Directional Dark Gradient Overlay -->
                <div class="hidden md:block absolute inset-0 z-1 pointer-events-none bg-gradient-to-r from-zinc-950 via-zinc-950/90 to-transparent w-4/5 lg:w-3/5"></div>
                <div class="block md:hidden absolute inset-0 z-1 pointer-events-none bg-gradient-to-r from-zinc-950/85 via-zinc-950/60 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/30 to-transparent pointer-events-none"></div>
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
                            Fasilitas Gym
                        </li>
                    </ol>
                </nav>

                <div class="max-w-3xl space-y-4">
                    <!-- Eyebrow Tagline with Standard Red Lines -->
                    <div class="inline-flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-red-600"></span>
                        <span class="text-xs font-bold uppercase tracking-[0.2em] text-red-500 font-montserrat">
                            STANDAR ALAT & FASILITAS GYM
                        </span>
                        <span class="w-8 h-[2px] bg-red-600"></span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="font-montserrat text-3xl sm:text-5xl lg:text-6xl font-black uppercase text-white tracking-tight leading-tight">
                        FASILITAS LENGKAP & <br>
                        <span class="text-red-600 drop-shadow-[0_0_25px_rgba(239,68,68,0.4)]">ALAT OLAHRAGA MODERN</span>
                    </h1>

                    <!-- Lead Paragraph -->
                    <p class="text-sm sm:text-base text-zinc-300 leading-relaxed font-normal pt-1 max-w-2xl">
                        Maco Gym Malang menyediakan peralatan gym berstandar komersial, mesin beban isolasi presisi, area kardio modern, serta fasilitas pendukung kenyamanan lengkap untuk mendukung performa latihan terbaikmu setiap hari.
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

        <!-- ================= 2. DAFTAR LENGKAP FASILITAS & ALAT GYM MACO GYM ================= -->
        @php
            $facilities = [
                [
                    'title' => 'Multi-Function Power Rack & Squat Station',
                    'category' => 'Strength & Heavy Lifting',
                    'image' => 'images/facilities/Multi-Function Power Rack.jpeg',
                    'description' => 'Fasilitas rak beban multifungsi standar heavy-duty untuk latihan compound fundamental seperti Barbell Squat, Overhead Press, Bench Press, dan Rack Pull. Dilengkapi safety spotter arm kokoh dan multi-angle pull up grip untuk keamanan latihan beban bebas maksimal.',
                    'highlight' => 'Safety Spotter Arm & Multi-Grip Pull Up',
                ],
                [
                    'title' => '45-Degree Incline Leg Press Machine',
                    'category' => 'Lower Body Machine',
                    'image' => 'images/facilities/Leg Press.jpeg',
                    'description' => 'Mesin leg press sudut 45 derajat dengan lintasan rel bantalan linier halus untuk melatih kekuatan paha depan (quadriceps), paha belakang (hamstrings), dan glutes dengan kapasitas beban tinggi tanpa memberikan beban kompresi berlebih pada tulang belakang.',
                    'highlight' => 'Kapasitas Beban Berat & Safety Lock Presisi',
                ],
                [
                    'title' => 'Chest Press Machine',
                    'category' => 'Chest & Upper Body',
                    'image' => 'images/facilities/Chest press.jpeg',
                    'description' => 'Mesin isolasi otot dada dengan pin beban terintegrasi yang mudah diatur. Pegangan tangan ganda memungkinkan variasi cengkeraman netral maupun lebar untuk aktivasi maksimal otot pectoral secara aman dan stabil bagi pemula hingga profesional.',
                    'highlight' => 'Biomekanik Gerak Ergonomis & Pin Beban',
                ],
                [
                    'title' => 'Lat Pulldown & Seated Cable Station',
                    'category' => 'Back & Latissimus Dorsi',
                    'image' => 'images/facilities/Lat pull down.jpeg',
                    'description' => 'Stasiun kabel vertikal presisi tinggi untuk melatih otot punggung (latissimus dorsi, rhomboids, dan trapezius). Bantalan paha dapat disesuaikan tinggi-rendahnya untuk stabilitas posisi saat menarik beban, membantu membentuk siluet punggung V-Taper yang tegap.',
                    'highlight' => 'Kabel Presisi Halus & Bantalan Paha Adjustable',
                ],
                [
                    'title' => 'Seated Shoulder Press Machine',
                    'category' => 'Shoulder & Deltoids',
                    'image' => 'images/facilities/Shoulder press.jpeg',
                    'description' => 'Mesin dorong bahu dengan posisi duduk bersandar ergonomis untuk melatih ketiga bagian otot deltoid. Mengurangi tekanan pada sendi rotator cuff sekaligus memungkinkan penambahan beban progresif dengan lintasan gerak yang seimbang.',
                    'highlight' => 'Sandaran Ergonomis & Form Gerak Terarah',
                ],
                [
                    'title' => 'Leg Extension & Quadriceps Machine',
                    'category' => 'Leg Isolation',
                    'image' => 'images/facilities/Leg Extension.jpeg',
                    'description' => 'Mesin isolasi paha depan dengan bantalan busa empuk berkepadatan tinggi. Roller pergelangan kaki dan sudut sandaran dapat disetel secara personal sesuai panjang tungkai, sangat efektif untuk definisi otot paha serta stabilitas tempurung lutut.',
                    'highlight' => 'Roller Adjustable & Full Range of Motion',
                ],
                [
                    'title' => 'Assisted Chin-Up & Dip Station',
                    'category' => 'Calisthenics & Bodyweight',
                    'image' => 'images/facilities/Chin Assist Station.jpeg',
                    'description' => 'Alat bantu gerakan angkat badan (pull-up) dan celup (dips) yang dilengkapi platform lutut dengan counterweight penopang beban. Membantu member yang belum sanggup mengangkat bobot tubuh penuh agar bisa melakukan repetisi pull-up dan dips dengan teknik sempurna.',
                    'highlight' => 'Counterweight Assist Platform & Multi-Grip',
                ],
                [
                    'title' => 'Inner & Outer Thigh (Adductor / Abductor)',
                    'category' => 'Glutes & Hip Mobility',
                    'image' => 'images/facilities/InnerOuter Thigh Machine.jpeg',
                    'description' => 'Mesin paha 2-in-1 dengan bantalan lutut yang dapat diputar 180 derajat untuk melatih otot paha bagian dalam (adductor) maupun pinggul dan glutes bagian luar (abductor). Membantu pembentukan kaki kencang, stabilitas pinggul, dan postur bawah tubuh yang seimbang.',
                    'highlight' => 'Rotary Knee Pad & Dual Exercise Function',
                ],
                [
                    'title' => 'Precision Dumbbell Set & Free Weight Rack',
                    'category' => 'Free Weights Zone',
                    'image' => 'images/facilities/Dumbles Set.jpeg',
                    'description' => 'Koleksi dumbbell karet padat lengkap mulai dari bobot teringan untuk pemanasan/toning hingga beban berat untuk latihan hipertrofi intensif. Tertata rapi di atas rak baja bertingkat anti selip agar area latihan tetap teratur, aman, dan mudah diakses oleh member.',
                    'highlight' => 'Bobot Lengkap & Rak Bertingkat Rapi',
                ],
                [
                    'title' => 'Commercial Grade Treadmill',
                    'category' => 'Cardio Theater',
                    'image' => 'images/facilities/Treadmill.jpeg',
                    'description' => 'Treadmill komersial premium dengan sistem suspensi peredam kejut bantalan lari yang empuk guna melindungi sendi lutut dan tumit. Dilengkapi pengaturan kecepatan halus, auto-incline otomatis, serta sensor pengukur detak jantung untuk sesi kardio dan fat loss yang optimal.',
                    'highlight' => 'Shock Absorption Deck & Auto-Incline',
                ],
                [
                    'title' => 'Maco Cafe & Chilled Refreshment Cooler',
                    'category' => 'Maco Cafe & Nutrisi',
                    'image' => 'images/facilities/kulkas.png',
                    'description' => 'Kulkas pendingin khusus Maco Cafe yang menyediakan berbagai minuman dingin segar, susu protein siap minum, minuman isotonik elektrolit, dan air mineral dingin. Memudahkan member memenuhi asupan nutrisi, hidrasi, dan pemulihan energi tepat setelah sesi latihan selesai.',
                    'highlight' => 'Minuman Protein Dingin & Isotonik Segar',
                ],
                [
                    'title' => 'Fitness Nutrition & Supplement Station',
                    'category' => 'Maco Cafe & Nutrisi',
                    'image' => 'images/facilities/suplemen.jpg',
                    'description' => 'Penyediaan aneka suplemen kebugaran dan nutrisi berenergi resmi di kasir Maco Gym Malang. Tersedia Whey Protein sachet, Creatine IsoPower penambah tenaga & ketahanan otot, High Protein Bar, Soyjoy, serta aneka suplemen bernutrisi tinggi untuk menunjang performa latihan dan pemulihan otot (recovery) maksimal.',
                    'highlight' => 'Whey Protein, Creatine & High Protein Bar',
                ],
                [
                    'title' => 'Free Refill Mineral Water Station',
                    'category' => 'Fasilitas Hidrasi Member',
                    'image' => 'images/facilities/Free Refil Water Dispenser.jpeg',
                    'description' => 'Dispenser air minum higienis dengan sistem filter modern yang menyediakan pilihan air dingin, normal, dan panas. Bebas dinikmati dan diisi ulang tanpa batas (free refill) oleh seluruh member Maco Gym untuk menjaga hidrasi tubuh tetap prima selama berolahraga.',
                    'highlight' => 'Free Refill Sepuasnya (Dingin & Panas)',
                ],
                [
                    'title' => 'Loker Pribadi & Ruang Penyimpanan Aman',
                    'category' => 'Keamanan & Kenyamanan',
                    'image' => 'images/facilities/Loker.jpeg',
                    'description' => 'Fasilitas loker penyimpanan individu dengan sistem penguncian aman dan berventilasi baik. Member dapat menitipkan tas, pakaian ganti, helm, sepatu, serta barang berharga lainnya dengan tenang dan nyaman saat fokus menjalani sesi latihan di lantai gym.',
                    'highlight' => 'Loker Bersih, Kokoh & Berkunci Aman',
                ],
                [
                    'title' => 'Freshened-Up Room & Ruang Ganti Bersih',
                    'category' => 'Ruang Ganti & Bilas',
                    'image' => 'images/facilities/Freshened up room.jpeg',
                    'description' => 'Ruang ganti dan bilas yang senantiasa bersih, harum, dan higienis. Dilengkapi cermin grooming luas, pencahayaan terang, dan tata ruang yang rapi agar member dapat menyegarkan diri kembali dengan nyaman sebelum melanjutkan aktivitas harian.',
                    'highlight' => 'Selalu Higienis, Bersih & Harum',
                ],
            ];
            $facilitiesWithAsset = array_map(function ($f) {
                $f['asset_url'] = asset($f['image']);

                return $f;
            }, $facilities);
        @endphp

        <section id="daftar-fasilitas"
                 class="py-20 lg:py-24 bg-zinc-50 border-b border-zinc-200"
                 x-data="{
                     modalOpen: false,
                     currentIndex: 0,
                     items: @js($facilitiesWithAsset),
                     openModal(index) {
                         this.currentIndex = index;
                         this.modalOpen = true;
                         document.body.classList.add('overflow-hidden');
                     },
                     closeModal() {
                         this.modalOpen = false;
                         document.body.classList.remove('overflow-hidden');
                     },
                     next() {
                         this.currentIndex = (this.currentIndex + 1) % this.items.length;
                     },
                     prev() {
                         this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
                     }
                 }"
                 @keydown.escape.window="closeModal()"
                 @keydown.arrow-right.window="modalOpen && next()"
                 @keydown.arrow-left.window="modalOpen && prev()">
            <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
                
                <!-- Section Header (Centered Clean Athletic Hierarchy) -->
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                    <div class="flex items-center justify-center gap-3 mb-1">
                        <span class="w-8 h-[2px] bg-red-600"></span>
                        <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">
                            GYM FACILITIES & EQUIPMENT
                        </span>
                        <span class="w-8 h-[2px] bg-red-600"></span>
                    </div>
                    <h2 class="font-montserrat text-3xl sm:text-5xl font-black uppercase text-zinc-900 tracking-tight">
                        FASILITAS & ALAT OLAHRAGA <span class="text-red-600">MACO GYM</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-zinc-600 max-w-2xl mx-auto leading-relaxed">
                        Dokumentasi seluruh peralatan kebugaran, mesin latihan beban, cardio, serta sarana kenyamanan yang tersedia langsung di Maco Gym Malang. Klik pada gambar untuk melihat foto resolusi penuh.
                    </p>
                </div>

                <!-- 15 Facilities Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($facilities as $facility)
                        <div @click="openModal({{ $loop->index }})"
                             class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-600 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl cursor-pointer">
                            
                            <!-- Image Container with Hover Fullscreen Indicator -->
                            <div class="relative h-64 sm:h-72 overflow-hidden bg-zinc-950">
                                <img src="{{ asset($facility['image']) }}"
                                     alt="{{ $facility['title'] }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                                <!-- Overlay Hover Badge -->
                                <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4">
                                    <div class="px-4 py-2.5 rounded-full bg-black/80 backdrop-blur-md border border-white/20 text-white text-xs font-bold font-montserrat uppercase tracking-wider flex items-center gap-2 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300 shadow-2xl">
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                                        </svg>
                                        <span>Lihat Gambar Penuh</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div class="p-6 sm:p-7 flex flex-col flex-1 justify-between">
                                <div>
                                    <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 mb-1.5">
                                        {{ $facility['category'] }}
                                    </div>
                                    <h3 class="font-montserrat text-lg sm:text-xl font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors leading-snug">
                                        {{ $facility['title'] }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed mt-2.5 font-normal">
                                        {{ $facility['description'] }}
                                    </p>
                                </div>

                                <div class="pt-4 mt-5 border-t border-zinc-100 flex items-center justify-between text-xs">
                                    <span class="text-zinc-500 font-medium text-[11px] truncate max-w-[210px]">
                                        {{ $facility['highlight'] }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 font-bold text-red-600 font-montserrat uppercase tracking-wider text-[11px] group-hover:translate-x-1 transition-transform">
                                        <span>Perbesar</span>
                                        <span>&rarr;</span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

            <!-- ================= LIGHTBOX / FULLSCREEN MODAL ================= -->
            <div x-show="modalOpen"
                 x-cloak
                 style="display: none;"
                 class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 md:p-8"
                 role="dialog"
                 aria-modal="true"
                 :aria-label="items[currentIndex]?.title">

                <!-- Backdrop Overlay with Fade -->
                <div x-show="modalOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="closeModal()"
                     class="fixed inset-0 bg-black/90 backdrop-blur-md"></div>

                <!-- Modal Window Container -->
                <div x-show="modalOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                     class="relative w-full max-w-5xl max-h-[92vh] flex flex-col bg-zinc-950 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl z-10">

                    <!-- Top Bar: Counter & Close Button -->
                    <div class="px-4 sm:px-6 py-3.5 bg-zinc-900/90 border-b border-zinc-800/80 flex items-center justify-between shrink-0">
                        <div class="flex items-center gap-2.5">
                            <span class="inline-block w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                            <span class="text-xs font-mono font-bold uppercase tracking-wider text-zinc-300">
                                <span class="text-red-500 font-montserrat" x-text="items[currentIndex]?.category"></span>
                                <span class="text-zinc-600 mx-1.5">•</span>
                                <span x-text="'Foto ' + (currentIndex + 1) + ' dari ' + items.length"></span>
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- Prev / Next Desktop buttons in header -->
                            <button @click="prev()"
                                    type="button"
                                    class="hidden sm:inline-flex p-1.5 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-zinc-300 hover:text-white transition cursor-pointer"
                                    title="Foto Sebelumnya (Panah Kiri)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button @click="next()"
                                    type="button"
                                    class="hidden sm:inline-flex p-1.5 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-zinc-300 hover:text-white transition cursor-pointer"
                                    title="Foto Selanjutnya (Panah Kanan)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            
                            <!-- Close Button -->
                            <button @click="closeModal()"
                                    type="button"
                                    class="px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider flex items-center gap-1.5 transition cursor-pointer shadow-sm"
                                    title="Tutup (Esc)">
                                <span>Tutup</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Image Display Stage with Floating Prev / Next Controls -->
                    <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[260px] sm:min-h-[380px] max-h-[58vh] sm:max-h-[66vh]">
                        <img :src="items[currentIndex]?.asset_url"
                             :alt="items[currentIndex]?.title"
                             class="w-full h-full max-h-[58vh] sm:max-h-[66vh] object-contain select-none">

                        <!-- Floating Left Navigation Arrow -->
                        <button @click.stop="prev()"
                                type="button"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/60 hover:bg-red-600 text-white flex items-center justify-center transition border border-white/20 backdrop-blur-sm cursor-pointer shadow-xl group"
                                title="Foto Sebelumnya (Panah Kiri)">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <!-- Floating Right Navigation Arrow -->
                        <button @click.stop="next()"
                                type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/60 hover:bg-red-600 text-white flex items-center justify-center transition border border-white/20 backdrop-blur-sm cursor-pointer shadow-xl group"
                                title="Foto Selanjutnya (Panah Kanan)">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Bottom Info Footer (Title, Highlight, Description) -->
                    <div class="p-4 sm:p-6 bg-zinc-950 border-t border-zinc-800/80 shrink-0 space-y-2">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5">
                            <h3 class="font-montserrat text-base sm:text-xl font-bold uppercase text-white tracking-tight"
                                x-text="items[currentIndex]?.title"></h3>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-950/80 border border-red-800/60 text-red-400 text-xs font-mono font-bold uppercase tracking-wider self-start sm:self-auto shrink-0"
                                  x-show="items[currentIndex]?.highlight"
                                  x-text="items[currentIndex]?.highlight"></span>
                        </div>
                        <p class="text-xs sm:text-sm text-zinc-300 leading-relaxed font-normal max-h-24 overflow-y-auto"
                           x-text="items[currentIndex]?.description"></p>
                    </div>

                </div>
            </div>
        </section>

        <!-- ================= 3. CALL TO ACTION BANNER ================= -->
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
                    Dapatkan akses bebas ke seluruh fasilitas dan peralatan gym setiap hari mulai pukul 06:00 - 22:00 WIB, dengan tarif mahasiswa terjangkau dan tanpa biaya pendaftaran tersembunyi.
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
