<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Harga Personal Trainer Single | Maco Gym Malang</title>
    <meta name="description" content="Paket latihan privat 1-on-1 Personal Trainer resmi Maco Gym Malang. Bimbingan instruktur profesional, koreksi gerakan, dan program terukur.">

    <!-- Google Fonts: Plus Jakarta Sans & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/macogym.jpg') }}">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-zinc-50 text-zinc-900 antialiased selection:bg-red-600 selection:text-white font-sans min-h-screen flex flex-col">

    <!-- Navbar & Top Info Bar -->
    @include('guest.partials.navbar')

    <!-- Main Content -->
    <main class="flex-grow pt-[64px] sm:pt-[80px] lg:pt-[106px]">

        <!-- Breadcrumb & Header Hero -->
        <section class="bg-zinc-950 text-white py-12 sm:py-16 relative overflow-hidden border-b border-zinc-800">
            <!-- Background Image with Dark Contrast Overlay -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/trainers/coach-kevin.jpg') }}"
                     alt="Personal Trainer Single Maco Gym"
                     class="w-full h-full object-cover object-top filter brightness-[0.25] contrast-125">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/80 to-transparent"></div>
            </div>

            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-2 text-xs font-mono text-zinc-400 mb-6">
                    <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Beranda</a>
                    <span>/</span>
                    <a href="{{ route('home') }}#pricing" class="hover:text-red-500 transition-colors">Pricing</a>
                    <span>/</span>
                    <span class="text-white font-bold">Personal Trainer Single</span>
                </nav>

                <!-- Header Title -->
                <div class="max-w-3xl space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/80 border border-red-500/40 text-red-400 text-xs font-mono font-bold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        1-ON-1 PRIVATE COACHING
                    </div>
                    <h1 class="font-montserrat text-3xl sm:text-5xl font-black uppercase tracking-tight text-white">
                        PERSONAL TRAINER <span class="text-red-600">SINGLE</span>
                    </h1>
                    <p class="text-sm sm:text-base text-zinc-300 leading-relaxed font-sans">
                        Program bimbingan privat eksklusif 1 orang dengan 1 personal trainer profesional Maco Gym Malang. Target kebugaran, koreksi biomekanik gerak, dan hasil yang terukur optimal.
                    </p>
                </div>
            </div>
        </section>

        <!-- Pricing Content Container -->
        <section class="py-12 sm:py-16">
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

                <!-- Catatan Ketentuan Resmi Banner -->
                <div class="bg-red-950/30 border border-red-600/30 rounded-2xl p-5 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-red-600/20 text-red-600 flex items-center justify-center shrink-0 border border-red-600/30">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-montserrat font-black text-sm uppercase tracking-wider text-red-600">
                                Ketentuan Resmi Sesi Personal Trainer
                            </h2>
                            <p class="text-xs sm:text-sm text-zinc-700 mt-1">
                                <strong class="text-zinc-900 font-semibold">Durasi latihan 1–1,5 jam per kedatangan</strong> untuk seluruh klien yang menggunakan jasa Personal Trainer Maco Gym Malang. Program ditujukan khusus untuk <span class="font-semibold text-zinc-900">1 orang dengan 1 trainer</span>.
                            </p>
                        </div>
                    </div>
                    <div class="text-xs font-mono text-zinc-600 shrink-0 bg-white px-3 py-1.5 rounded-lg border border-zinc-200">
                        1 Klien : 1 Trainer
                    </div>
                </div>

                <!-- Official Price Table Card -->
                <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                    <div class="p-5 sm:p-7 border-b border-zinc-200 bg-zinc-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded bg-red-600 shrink-0"></span>
                                <h2 class="font-montserrat text-lg sm:text-xl font-black uppercase text-zinc-900 tracking-tight">
                                    Daftar Paket Personal Trainer (Single)
                                </h2>
                            </div>
                            <p class="text-xs text-zinc-500 mt-1">
                                Pilihan paket sesi privat fleksibel mulai dari single trial hingga paket transformasi 20 sesi.
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[11px] font-mono font-bold bg-zinc-200 text-zinc-800 self-start sm:self-auto shrink-0">
                            Transparan & Tanpa Hidden Fee
                        </span>
                    </div>

                    <!-- Comparison Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-zinc-50 text-[10px] uppercase font-mono tracking-wider text-zinc-500 border-b border-zinc-200">
                                <tr>
                                    <th class="px-5 py-3.5">Jumlah Sesi</th>
                                    <th class="px-5 py-3.5">Masa Aktif</th>
                                    <th class="px-5 py-3.5">Harga Resmi</th>
                                    <th class="px-5 py-3.5 hidden md:table-cell">Efektif / Sesi</th>
                                    <th class="px-5 py-3.5 hidden sm:table-cell">Rekomendasi Tujuan</th>
                                    <th class="px-5 py-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200 text-zinc-800">
                                <!-- 1 PT -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">1 PT (Single)</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">1 Sesi Latihan</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">-</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 130.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600 hidden md:table-cell">Rp 130.000 / sesi</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden sm:table-cell">Trial sesi perdana atau koreksi teknik spesifik</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '1 PT (Single) - Rp 130.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-sm">
                                            <span>Pilih</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 4 PT -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">4 PT (Single)</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">4 Sesi Latihan</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs font-semibold text-zinc-800">10 hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 520.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600 hidden md:table-cell">Rp 137.500 / sesi</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden sm:table-cell">Adaptasi latihan & pengenalan split program</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '4 PT (Single) - Rp 520.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-sm">
                                            <span>Pilih</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 8 PT -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">8 PT (Single)</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">8 Sesi Latihan</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs font-semibold text-zinc-800">20 hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 950.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600 hidden md:table-cell">Rp 118.750 / sesi</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden sm:table-cell">Fokus penguasaan form & peningkatan stamina</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '8 PT (Single) - Rp 950.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-sm">
                                            <span>Pilih</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 12 PT (Highlight / Populer) -->
                                <tr class="bg-red-50/40 hover:bg-red-50/70 transition-colors border-l-4 border-l-red-600">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-montserrat font-bold text-base text-zinc-900">12 PT (Single)</span>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-red-600 text-white uppercase tracking-wider">
                                                Populer
                                            </span>
                                        </div>
                                        <div class="text-[11px] text-zinc-500 font-mono">12 Sesi Latihan (1 Bulan)</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs font-bold text-red-700">30 hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-xl text-red-600">Rp 1.150.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs font-bold text-zinc-800 hidden md:table-cell">Rp 95.833 / sesi</td>
                                    <td class="px-5 py-4 text-xs text-zinc-700 hidden sm:table-cell">Program 1 bulan intensif: fat loss / muscle building</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '12 PT (Single) - Rp 1.150.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-sm">
                                            <span>Daftar</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 16 PT -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">16 PT (Single)</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">16 Sesi Latihan</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs font-semibold text-zinc-800">40 hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 1.450.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600 hidden md:table-cell">Rp 90.625 / sesi</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden sm:table-cell">Konsistensi jangka menengah & hipertrofi otot</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '16 PT (Single) - Rp 1.450.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-sm">
                                            <span>Pilih</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 20 PT (Best Value) -->
                                <tr class="bg-zinc-50/50 hover:bg-zinc-100/60 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-montserrat font-bold text-base text-zinc-900">20 PT (Single)</span>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-900 text-white uppercase tracking-wider">
                                                Best Value
                                            </span>
                                        </div>
                                        <div class="text-[11px] text-zinc-500 font-mono">20 Sesi Latihan (2 Bulan)</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs font-semibold text-zinc-800">50–60 hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 1.850.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs font-semibold text-zinc-800 hidden md:table-cell">Rp 92.500 / sesi</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden sm:table-cell">Total body transformation & evaluasi progres menyeluruh</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '20 PT (Single) - Rp 1.850.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-sm">
                                            <span>Pilih</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Keunggulan Program PT Single -->
                <div class="bg-zinc-900 text-white rounded-2xl p-6 sm:p-8 shadow-sm">
                    <h3 class="font-montserrat font-bold text-sm sm:text-base uppercase tracking-wider text-red-500 mb-5">
                        KEUNGGULAN PROGRAM PERSONAL TRAINER 1-ON-1:
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 text-xs sm:text-sm text-zinc-300">
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-2 text-white font-bold text-sm">
                                <span class="text-red-500 text-base leading-none">✓</span>
                                <span>1 Klien, 1 Fokus Penuh</span>
                            </div>
                            <p class="text-zinc-400 text-xs">
                                Pelatih mendampingi setiap repetisi, memastikan tempo, beban, dan pernapasan benar tanpa terbagi perhatiannya.
                            </p>
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-2 text-white font-bold text-sm">
                                <span class="text-red-500 text-base leading-none">✓</span>
                                <span>Koreksi Form & Biomekanik</span>
                            </div>
                            <p class="text-zinc-400 text-xs">
                                Meminimalisir risiko cedera dan memaksimalkan aktivasi otot sasaran dengan koreksi postur secara langsung.
                            </p>
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-2 text-white font-bold text-sm">
                                <span class="text-red-500 text-base leading-none">✓</span>
                                <span>Program Latihan Kustom</span>
                            </div>
                            <p class="text-zinc-400 text-xs">
                                Modifikasi menu latihan harian disesuaikan dengan kapasitas tubuh, mobilitas sendi, dan tujuan spesifik Anda.
                            </p>
                        </div>
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-2 text-white font-bold text-sm">
                                <span class="text-red-500 text-base leading-none">✓</span>
                                <span>Jadwal Fleksibel</span>
                            </div>
                            <p class="text-zinc-400 text-xs">
                                Jadwal latihan disepakati langsung bersama trainer Anda sesuai ketersediaan waktu luang harian.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation between Categories & WhatsApp Floating Contact -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-zinc-200">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-xs font-mono text-zinc-500 uppercase tracking-wider">Kategori Lain:</span>
                        <a href="{{ route('pricing.membership') }}"
                           class="px-4 py-2 rounded-lg bg-white hover:bg-zinc-100 text-zinc-800 border border-zinc-300 font-montserrat font-bold text-xs uppercase tracking-wider transition-colors">
                            &larr; Membership Reguler
                        </a>
                        <a href="{{ route('pricing.pt-couples') }}"
                           class="px-4 py-2 rounded-lg bg-white hover:bg-zinc-100 text-zinc-800 border border-zinc-300 font-montserrat font-bold text-xs uppercase tracking-wider transition-colors">
                            Personal Trainer Couples &rarr;
                        </a>
                    </div>

                    <a href="https://wa.me/6281250207403?text={{ urlencode('Halo Admin Maco Gym, saya ingin menanyakan informasi paket Personal Trainer Single (1-on-1).') }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-all shadow-sm">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>Konsultasi Trainer via WhatsApp</span>
                    </a>
                </div>

            </div>
        </section>

    </main>

    <!-- Footer -->
    <x-footer />

</body>
</html>
