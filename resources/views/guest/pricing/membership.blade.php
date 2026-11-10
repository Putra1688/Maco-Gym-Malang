<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Harga Membership Resmi | Maco Gym Malang</title>
    <meta name="description" content="Daftar harga keanggotaan gym resmi Maco Gym Malang. Paket reguler, mahasiswa, dan pelajar lengkap, transparan, dan tanpa biaya tersembunyi.">

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
                <img src="{{ asset('images/about-gym.jpg') }}"
                     alt="Maco Gym Membership"
                     class="w-full h-full object-cover object-center filter brightness-[0.25] contrast-125">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/80 to-transparent"></div>
            </div>

            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-2 text-xs font-mono text-zinc-400 mb-6">
                    <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Beranda</a>
                    <span>/</span>
                    <a href="{{ route('home') }}#pricing" class="hover:text-red-500 transition-colors">Pricing</a>
                    <span>/</span>
                    <span class="text-white font-bold">Membership</span>
                </nav>

                <!-- Header Title -->
                <div class="max-w-3xl space-y-3">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/80 border border-red-500/40 text-red-400 text-xs font-mono font-bold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        OFFICIAL GYM MEMBERSHIP
                    </div>
                    <h1 class="font-montserrat text-3xl sm:text-5xl font-black uppercase tracking-tight text-white">
                        DAFTAR HARGA <span class="text-red-600">MEMBERSHIP</span>
                    </h1>
                    <p class="text-sm sm:text-base text-zinc-300 leading-relaxed font-sans">
                        Pilihan paket keanggotaan resmi Maco Gym Malang untuk umum, mahasiswa, dan pelajar. Akses penuh ke seluruh fasilitas kebugaran dengan harga transparan dan fasilitas lengkap.
                    </p>
                </div>
            </div>
        </section>

        <!-- Pricing Content Container -->
        <section class="py-12 sm:py-16">
            <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

                <!-- 1. MEMBERSHIP REGULER -->
                <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                    <div class="p-5 sm:p-7 border-b border-zinc-200 bg-zinc-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded bg-red-600 shrink-0"></span>
                                <h2 class="font-montserrat text-lg sm:text-xl font-black uppercase text-zinc-900 tracking-tight">
                                    1. Membership Reguler
                                </h2>
                            </div>
                            <p class="text-xs text-zinc-500 mt-1">
                                Paket keanggotaan umum dengan akses gym tanpa batas waktu setiap hari (06:00 - 22:00 WIB).
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[11px] font-mono font-bold bg-zinc-200 text-zinc-800 self-start sm:self-auto shrink-0">
                            Akses Penuh Fasilitas
                        </span>
                    </div>

                    <!-- Comparison Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-zinc-50 text-[10px] uppercase font-mono tracking-wider text-zinc-500 border-b border-zinc-200">
                                <tr>
                                    <th class="px-5 py-3.5">Paket</th>
                                    <th class="px-5 py-3.5">Masa Aktif</th>
                                    <th class="px-5 py-3.5">Tarif Resmi</th>
                                    <th class="px-5 py-3.5 hidden md:table-cell">Setara per Bulan</th>
                                    <th class="px-5 py-3.5 hidden sm:table-cell">Keunggulan</th>
                                    <th class="px-5 py-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 font-sans">
                                <!-- 1 Month -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">1 Month</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">Paket Fleksibel Bulanan</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">30 Hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 130.000</span>
                                    </td>
                                    <td class="px-5 py-4 text-xs font-mono text-zinc-500 hidden md:table-cell">Rp 130.000 / bln</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden sm:table-cell">Tanpa komitmen jangka panjang</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '1 Month - Rp 130.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-xs">
                                            <span>Daftar</span>
                                            <span>&rarr;</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 3 Month (Popular) -->
                                <tr class="bg-red-50/40 hover:bg-red-50/70 transition-colors border-l-4 border-l-red-600">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="font-montserrat font-bold text-base text-zinc-900">3 Month</div>
                                            <span class="px-2 py-0.5 rounded text-[9px] font-montserrat font-extrabold uppercase bg-red-600 text-white">POPULAR</span>
                                        </div>
                                        <div class="text-[11px] text-red-600 font-mono font-semibold">Paling Banyak Dipilih</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-700 font-bold">90 Hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-xl text-red-600">Rp 375.000</span>
                                    </td>
                                    <td class="px-5 py-4 text-xs font-mono text-zinc-700 font-semibold hidden md:table-cell">Rp 125.000 / bln</td>
                                    <td class="px-5 py-4 text-xs text-zinc-700 hidden sm:table-cell">Hemat Rp 15.000 dibanding bulanan</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '3 Month - Rp 375.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-sm shadow-red-600/30">
                                            <span>Daftar</span>
                                            <span>&rarr;</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 6 Month -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">6 Month</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">Paket Setengah Tahun</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">180 Hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 750.000</span>
                                    </td>
                                    <td class="px-5 py-4 text-xs font-mono text-zinc-500 hidden md:table-cell">Rp 125.000 / bln</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden sm:table-cell">Konsistensi latihan 6 bulan penuh</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '6 Month - Rp 750.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-xs">
                                            <span>Daftar</span>
                                            <span>&rarr;</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- 12 Month -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="font-montserrat font-bold text-base text-zinc-900">12 Month</div>
                                            <span class="px-2 py-0.5 rounded text-[9px] font-montserrat font-bold uppercase bg-zinc-100 text-zinc-800 border border-zinc-200">MAX SAVINGS</span>
                                        </div>
                                        <div class="text-[11px] text-zinc-500 font-mono">Paket 1 Tahun Penuh</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">365 Hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 1.450.000</span>
                                    </td>
                                    <td class="px-5 py-4 text-xs font-mono text-zinc-500 hidden md:table-cell">~Rp 120.800 / bln</td>
                                    <td class="px-5 py-4 text-xs text-emerald-600 font-semibold hidden sm:table-cell">Tarif tahunan paling hemat</td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => '12 Month - Rp 1.450.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-900 hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-xs">
                                            <span>Daftar</span>
                                            <span>&rarr;</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 2. MEMBERSHIP KHUSUS PELAJAR & MAHASISWA -->
                <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                    <div class="p-5 sm:p-7 border-b border-zinc-200 bg-zinc-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded bg-blue-600 shrink-0"></span>
                                <h2 class="font-montserrat text-lg sm:text-xl font-black uppercase text-zinc-900 tracking-tight">
                                    2. Membership Khusus Pelajar dan Mahasiswa
                                </h2>
                            </div>
                            <p class="text-xs text-zinc-500 mt-1">
                                Tarif spesial keanggotaan bersubsidi untuk mendukung kebugaran generasi muda Kota Malang.
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[11px] font-mono font-bold bg-blue-50 text-blue-700 border border-blue-200 self-start sm:self-auto shrink-0">
                            Wajib Kartu Pelajar / KTM
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-zinc-50 text-[10px] uppercase font-mono tracking-wider text-zinc-500 border-b border-zinc-200">
                                <tr>
                                    <th class="px-5 py-3.5">Kategori Pelajar / Mahasiswa</th>
                                    <th class="px-5 py-3.5">Masa Aktif</th>
                                    <th class="px-5 py-3.5">Tarif Resmi</th>
                                    <th class="px-5 py-3.5 hidden md:table-cell">Persyaratan Bukti</th>
                                    <th class="px-5 py-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 font-sans">
                                <!-- Mahasiswa -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">Mahasiswa</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">Diploma / Sarjana Aktif</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">30 Hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-xl text-blue-600">Rp 110.000</span>
                                        <span class="text-xs text-zinc-500 font-mono">/ bln</span>
                                    </td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden md:table-cell">
                                        Wajib menunjukkan KTM aktif atau tangkapan layar SIAKAD saat verifikasi di kasir.
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => 'Mahasiswa - Rp 110.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-xs">
                                            <span>Daftar</span>
                                            <span>&rarr;</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Pelajar maksimal SMA -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">Pelajar (maksimal SMA)</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">Siswa SMP / SMA / SMK Sederajat</div>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">30 Hari</td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-xl text-blue-600">Rp 100.000</span>
                                        <span class="text-xs text-zinc-500 font-mono">/ bln</span>
                                    </td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden md:table-cell">
                                        Wajib menunjukkan Kartu Pelajar aktif yang sah saat verifikasi di kasir.
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => 'Pelajar (maksimal SMA) - Rp 100.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-colors shadow-xs">
                                            <span>Daftar</span>
                                            <span>&rarr;</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Syarat & Ketentuan Mahasiswa & Pelajar Note -->
                    <div class="p-4 sm:p-5 bg-blue-50/50 border-t border-blue-100 flex items-start gap-3 text-xs text-blue-900">
                        <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="leading-relaxed">
                            <strong class="font-bold">Ketentuan Verifikasi Pelajar & Mahasiswa:</strong>
                            Pendaftaran online dapat dilakukan langsung. Sebelum kartu fisik diaktifkan di resepsionis Maco Gym, calon member wajib memperlihatkan identitas pelajar/mahasiswa aktif asli kepada staf kasir.
                        </div>
                    </div>
                </div>

                <!-- 3. BIAYA TAMBAHAN & INSIDENTIL -->
                <div class="bg-white rounded-2xl border border-zinc-200 shadow-sm overflow-hidden">
                    <div class="p-5 sm:p-7 border-b border-zinc-200 bg-zinc-50/50">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded bg-zinc-800 shrink-0"></span>
                            <h2 class="font-montserrat text-lg sm:text-xl font-black uppercase text-zinc-900 tracking-tight">
                                3. Biaya Tambahan / Insidentil
                            </h2>
                        </div>
                        <p class="text-xs text-zinc-500 mt-1">
                            Informasi biaya administrasi pendaftaran awal dan akses latihan harian non-member.
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-zinc-50 text-[10px] uppercase font-mono tracking-wider text-zinc-500 border-b border-zinc-200">
                                <tr>
                                    <th class="px-5 py-3.5">Layanan</th>
                                    <th class="px-5 py-3.5">Tarif Resmi</th>
                                    <th class="px-5 py-3.5">Frekuensi Bayar</th>
                                    <th class="px-5 py-3.5 hidden md:table-cell">Keterangan</th>
                                    <th class="px-5 py-3.5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 font-sans">
                                <!-- Regular Membership (Joining Fee) -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">Regular Membership (Joining Fee)</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">Biaya Pendaftaran & Kartu Member</div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 20.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">1x di Awal</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden md:table-cell">
                                        Biaya administrasi dan pencetakan ID card fisik resmi member Maco Gym. Hanya dibayar sekali saat bergabung perdana.
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => 'Regular Membership - Rp 20.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-800 font-montserrat font-bold text-xs uppercase tracking-wider transition-colors border border-zinc-300">
                                            <span>Registrasi</span>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Insidentil -->
                                <tr class="hover:bg-zinc-50/80 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-montserrat font-bold text-base text-zinc-900">Insidentil</div>
                                        <div class="text-[11px] text-zinc-500 font-mono">Tiket Harian Non-Member</div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="font-montserrat font-black text-lg text-zinc-900">Rp 30.000</span>
                                    </td>
                                    <td class="px-5 py-4 font-mono text-xs text-zinc-600">Per Kedatangan</td>
                                    <td class="px-5 py-4 text-xs text-zinc-600 hidden md:table-cell">
                                        Akses 1 sesi latihan ke seluruh area gym & shower air hangat untuk tamu non-member tanpa ikatan langganan.
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('register', ['package' => 'Insidentil - Rp 30.000']) }}"
                                           class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-800 font-montserrat font-bold text-xs uppercase tracking-wider transition-colors border border-zinc-300">
                                            <span>Pilih</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Fasilitas Seluruh Member (Facility Highlights) -->
                <div class="bg-zinc-900 text-white rounded-2xl p-6 sm:p-8 shadow-sm">
                    <h3 class="font-montserrat font-bold text-sm sm:text-base uppercase tracking-wider text-red-500 mb-4">
                        FASILITAS SUDAH TERMASUK DALAM SELURUH PAKET MEMBERSHIP:
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs sm:text-sm text-zinc-300">
                        <div class="flex items-start gap-2.5">
                            <span class="text-red-500 font-bold text-base leading-none">✓</span>
                            <span>Unlimited Gym Access (Senin - Minggu 06:00 - 22:00 WIB)</span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="text-red-500 font-bold text-base leading-none">✓</span>
                            <span>Semua alat beban standar internasional & cardio theater</span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="text-red-500 font-bold text-base leading-none">✓</span>
                            <span>Locker room aman, shower air hangat, & musholla</span>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="text-red-500 font-bold text-base leading-none">✓</span>
                            <span>Free orientasi pengenalan alat bagi pemula</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation between Categories & WhatsApp Floating Contact -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-zinc-200">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-xs font-mono text-zinc-500 uppercase tracking-wider">Kategori Lain:</span>
                        <a href="{{ route('pricing.pt-single') }}"
                           class="px-4 py-2 rounded-lg bg-white hover:bg-zinc-100 text-zinc-800 border border-zinc-300 font-montserrat font-bold text-xs uppercase tracking-wider transition-colors">
                            Personal Trainer Single &rarr;
                        </a>
                        <a href="{{ route('pricing.pt-couples') }}"
                           class="px-4 py-2 rounded-lg bg-white hover:bg-zinc-100 text-zinc-800 border border-zinc-300 font-montserrat font-bold text-xs uppercase tracking-wider transition-colors">
                            Personal Trainer Couples &rarr;
                        </a>
                    </div>

                    <a href="https://wa.me/6281250207403?text={{ urlencode('Halo Admin Maco Gym, saya ingin menanyakan informasi paket Membership resmi.') }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-all shadow-sm">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>Konsultasi via WhatsApp</span>
                    </a>
                </div>

            </div>
        </section>

    </main>

    <!-- Footer -->
    <x-footer />

</body>
</html>

