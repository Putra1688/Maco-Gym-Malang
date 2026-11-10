<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Member Baru | Maco Gym Malang</title>
    <meta name="description" content="Daftarkan dirimu menjadi member Maco Gym Malang secara online. Proses cepat, harga transparan, dan akses langsung ke seluruh fasilitas gym.">

    <!-- Google Fonts: Plus Jakarta Sans & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/macogym.jpg') }}">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-zinc-800 antialiased selection:bg-red-600 selection:text-white font-sans min-h-screen flex flex-col">

    <!-- Navbar & Top Info Bar -->
    @include('guest.partials.navbar')

    <!-- Main Registration Section (Edge-to-Edge Split Screen matching BMI Page) -->
    <main class="flex-grow pt-[64px] sm:pt-[80px] lg:pt-[106px]">
        <section id="register-page" class="w-full relative overflow-hidden bg-white text-zinc-800">
            
            <!-- Full-width Edge-to-Edge Grid (Left: Gym Atmosphere & Info | Right: Interactive Registration Form) -->
            <div class="w-full grid grid-cols-1 lg:grid-cols-12 min-h-[calc(100vh-106px)] border-b border-zinc-200">
                
                <!-- ================= LEFT HALF: FULL BACKGROUND ATMOSPHERE & BENEFITS ================= -->
                <div class="lg:col-span-6 relative bg-zinc-950 text-white flex flex-col justify-between overflow-hidden p-6 sm:p-8 lg:p-10 xl:p-12 min-h-[520px]">
                    
                    <!-- Background Image Covering 100% of Left Half -->
                    <div class="absolute inset-0 z-0">
                        <img src="{{ asset('images/about-gym.jpg') }}" 
                             alt="Maco Gym Malang" 
                             class="w-full h-full object-cover object-center filter brightness-90 contrast-105 scale-100">
                        <!-- Layered Dark & Red Gradients for Gym Aesthetic & Legibility -->
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/85 to-zinc-950/65"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-zinc-950/90 via-zinc-950/75 to-transparent"></div>
                        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-red-600/25 rounded-full blur-3xl pointer-events-none"></div>
                    </div>

                    <!-- Left Content Area -->
                    <div class="relative z-10 flex flex-col h-full justify-between space-y-6 max-w-xl mx-auto lg:max-w-none lg:mx-0 w-full">
                        <div>
                            <!-- Eyebrow Badge -->
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/80 border border-red-500/50 backdrop-blur-md mb-4 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-red-400 font-montserrat">
                                    ONLINE REGISTRATION
                                </span>
                            </div>

                            <!-- Heading -->
                            <h1 class="font-montserrat text-3xl sm:text-4xl lg:text-5xl font-black uppercase text-white tracking-tight leading-tight">
                                Bergabung <span class="text-red-500 drop-shadow-[0_0_20px_rgba(239,68,68,0.5)]">Maco Gym</span>
                            </h1>

                            <!-- Short Description -->
                            <p class="text-zinc-200 text-sm sm:text-base leading-relaxed mt-4 max-w-xl font-normal">
                                Daftarkan dirimu secara online dan nikmati akses fasilitas gym terlengkap, bimbingan Coach profesional, dan atmosfer latihan berenergi tinggi di Kota Malang.
                            </p>

                            <!-- Member Benefits List -->
                            <div class="mt-6 pt-6 border-t border-zinc-800/90">
                                <span class="text-[10px] font-bold uppercase tracking-widest text-red-500 font-montserrat block mb-3">
                                    FASILITAS & BENEFIT MEMBER
                                </span>
                                <ul class="space-y-3.5 text-xs sm:text-sm text-zinc-200">
                                    <li class="flex items-start gap-3">
                                        <div class="w-5 h-5 rounded-full bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 mt-0.5 shadow-sm shadow-red-600/50">
                                            ✓
                                        </div>
                                        <span>Akses alat beban & cardio unlimited setiap hari (06:00 - 22:00 WIB).</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <div class="w-5 h-5 rounded-full bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 mt-0.5 shadow-sm shadow-red-600/50">
                                            ✓
                                        </div>
                                        <span>Locker room aman, shower air hangat, dan musholla bersih.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <div class="w-5 h-5 rounded-full bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 mt-0.5 shadow-sm shadow-red-600/50">
                                            ✓
                                        </div>
                                        <span>Free orientasi pemakaian alat gym bersama tim instruktur jaga.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <div class="w-5 h-5 rounded-full bg-red-600 text-white flex items-center justify-center font-bold text-xs shrink-0 mt-0.5 shadow-sm shadow-red-600/50">
                                            ✓
                                        </div>
                                        <span>Kartu member fisik resmi & pencatatan data keanggotaan terintegrasi.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Footer Note on Left Div -->
                        <div class="pt-4 border-t border-white/10 flex items-center justify-between text-[11px] text-zinc-400">
                            <span>Maco Gym Malang • Fitness Club</span>
                            <span class="text-red-400 font-semibold">Pandanwangi & Lowokwaru</span>
                        </div>
                    </div>

                </div>

                <!-- ================= RIGHT HALF: REGISTRATION FORM ================= -->
                <div class="lg:col-span-6 bg-white flex flex-col justify-start pt-5 sm:pt-7 lg:pt-8 pb-8 px-6 sm:px-10 lg:px-14 xl:px-16 relative">
                    <div class="max-w-xl mx-auto w-full">
                        
                        <!-- Form Header -->
                        <div class="border-b border-zinc-100 pb-3 sm:pb-3.5 mb-5">
                            <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-zinc-100 text-zinc-700 text-[10px] font-bold uppercase tracking-wider mb-1.5">
                                <span>FORMULIR PENDAFTARAN</span>
                            </div>
                            <h2 class="font-montserrat font-black text-2xl sm:text-[28px] text-zinc-900 tracking-tight uppercase leading-snug">
                                Pendaftaran <span class="text-red-600">Member</span>
                            </h2>
                            <p class="text-zinc-500 text-xs mt-1 leading-relaxed font-sans">
                                Lengkapi biodata pendaftaran kamu. Data akan otomatis tercatat di sistem Maco Gym dan diteruskan ke kasir untuk verifikasi pembayaran.
                            </p>
                        </div>

                        <!-- Flash Alerts (Success, Warning, Errors) -->
                        @if(session('success'))
                        <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs space-y-2">
                            <div class="flex items-center gap-2 font-bold font-montserrat">
                                <span class="w-5 h-5 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs">✓</span>
                                <span>{{ session('success') }}</span>
                            </div>
                            <p class="text-emerald-700">
                                WhatsApp resepsionis akan segera terbuka. Jika tidak terbuka otomatis, silakan klik tombol di bawah ini:
                            </p>
                            @if(session('wa_redirect_url'))
                            <div class="pt-1">
                                <a href="{{ session('wa_redirect_url') }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-lg shadow-sm transition">
                                    <span>Buka Chat WhatsApp Kasir</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if(session('warning'))
                        <div class="mb-5 p-4 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 text-xs flex items-start gap-2.5">
                            <span class="w-5 h-5 rounded-full bg-amber-500 text-zinc-950 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">!</span>
                            <div>
                                <strong class="font-bold block mb-0.5">Pemberitahuan Pendaftaran</strong>
                                <span>{{ session('warning') }}</span>
                            </div>
                        </div>
                        @endif

                        @if(session('info'))
                        <div class="mb-5 p-4 rounded-xl bg-blue-50 border border-blue-300 text-blue-900 text-xs space-y-2">
                            <div class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">i</span>
                                <div>
                                    <strong class="font-bold block mb-0.5">Data Sudah Terdaftar</strong>
                                    <span>{{ session('info') }}</span>
                                </div>
                            </div>
                            @if(session('wa_redirect_url'))
                            <div class="pt-1">
                                <a href="{{ session('wa_redirect_url') }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-lg transition">
                                    <span>Lanjut Konfirmasi via WhatsApp</span>
                                </a>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-300 text-red-900 text-xs">
                            <strong class="font-bold block mb-1">Mohon lengkapi formulir dengan benar:</strong>
                            <ul class="list-disc pl-5 space-y-0.5">
                                @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Form Pendaftaran -->
                        @php
                            $requestedPackage = request('package', old('package', '3 Month - Rp 375.000'));
                        @endphp
                        <form id="online-register-form"
                              action="{{ route('guest.register') }}"
                              method="POST"
                              onsubmit="handleRegistrationSubmit(this, event)"
                              class="space-y-4">
                            @csrf
                            
                            <!-- 1. Nama Lengkap & No WhatsApp -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="reg_name" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                                        Nama Lengkap <span class="text-red-600">*</span>
                                    </label>
                                    <input type="text"
                                           id="reg_name"
                                           name="name"
                                           required
                                           value="{{ old('name') }}"
                                           placeholder="Nama lengkap kamu"
                                           class="w-full bg-zinc-50 border border-zinc-300 rounded-xl px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition">
                                </div>

                                <div>
                                    <label for="reg_phone" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                                        Nomor WhatsApp <span class="text-red-600">*</span>
                                    </label>
                                    <input type="tel"
                                           id="reg_phone"
                                           name="phone"
                                           required
                                           value="{{ old('phone') }}"
                                           placeholder="081234567890"
                                           class="w-full bg-zinc-50 border border-zinc-300 rounded-xl px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition font-mono">
                                </div>
                            </div>

                            <!-- 2. Paket Membership & Gender -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="reg_package" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                                        Pilihan Paket <span class="text-red-600">*</span>
                                    </label>
                                    <select id="reg_package"
                                            name="package"
                                            required
                                            class="w-full bg-zinc-50 border border-zinc-300 rounded-xl px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition font-medium">
                                        
                                        <optgroup label="── Kategori: Membership ──">
                                            <option value="1 Month - Rp 130.000" {{ str_contains($requestedPackage, '1 Month') ? 'selected' : '' }}>
                                                1 Month (Rp 130.000)
                                            </option>
                                            <option value="3 Month - Rp 375.000" {{ str_contains($requestedPackage, '3 Month') ? 'selected' : '' }}>
                                                3 Month (Rp 375.000) - Terpopuler
                                            </option>
                                            <option value="6 Month - Rp 750.000" {{ str_contains($requestedPackage, '6 Month') ? 'selected' : '' }}>
                                                6 Month (Rp 750.000)
                                            </option>
                                            <option value="12 Month - Rp 1.450.000" {{ str_contains($requestedPackage, '12 Month') ? 'selected' : '' }}>
                                                12 Month (Rp 1.450.000) - 1 Tahun
                                            </option>
                                            <option value="Mahasiswa - Rp 110.000" {{ str_contains($requestedPackage, 'Mahasiswa') ? 'selected' : '' }}>
                                                Mahasiswa / KTM (Rp 110.000)
                                            </option>
                                            <option value="Pelajar (maksimal SMA) - Rp 100.000" {{ str_contains($requestedPackage, 'Pelajar') ? 'selected' : '' }}>
                                                Pelajar SMP/SMA (Rp 100.000)
                                            </option>
                                            <option value="Insidentil - Rp 30.000" {{ str_contains($requestedPackage, 'Insidentil') ? 'selected' : '' }}>
                                                Insidentil Harian (Rp 30.000)
                                            </option>
                                            <option value="Regular Membership - Rp 20.000" {{ str_contains($requestedPackage, 'Regular Membership') ? 'selected' : '' }}>
                                                Regular Membership / Kartu (Rp 20.000)
                                            </option>
                                        </optgroup>

                                        <optgroup label="── Kategori: Personal Trainer (Single Session) ──">
                                            <option value="1 PT (Single) - Rp 130.000" {{ str_contains($requestedPackage, '1 PT') && !str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                1 PT Single Session (Rp 130.000)
                                            </option>
                                            <option value="4 PT (Single) - Rp 520.000" {{ str_contains($requestedPackage, '4 PT') && !str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                4 PT Single Session (Rp 520.000 - 10 Hari)
                                            </option>
                                            <option value="8 PT (Single) - Rp 950.000" {{ str_contains($requestedPackage, '8 PT') && !str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                8 PT Single Session (Rp 950.000 - 20 Hari)
                                            </option>
                                            <option value="12 PT (Single) - Rp 1.150.000" {{ str_contains($requestedPackage, '12 PT') && !str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                12 PT Single Session (Rp 1.150.000 - 30 Hari)
                                            </option>
                                            <option value="16 PT (Single) - Rp 1.450.000" {{ str_contains($requestedPackage, '16 PT') && !str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                16 PT Single Session (Rp 1.450.000 - 40 Hari)
                                            </option>
                                            <option value="20 PT (Single) - Rp 1.850.000" {{ str_contains($requestedPackage, '20 PT') && !str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                20 PT Single Session (Rp 1.850.000 - 50-60 Hari)
                                            </option>
                                        </optgroup>

                                        <optgroup label="── Kategori: Personal Trainer (Couples Session) ──">
                                            <option value="1 PT (Couples) - Rp 210.000" {{ str_contains($requestedPackage, '1 PT') && str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                1 PT Couples Session (Rp 210.000 - 2 Orang)
                                            </option>
                                            <option value="4 PT (Couples) - Rp 950.000" {{ str_contains($requestedPackage, '4 PT') && str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                4 PT Couples Session (Rp 950.000 - 15 Hari)
                                            </option>
                                            <option value="8 PT (Couples) - Rp 1.200.000" {{ str_contains($requestedPackage, '8 PT') && str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                8 PT Couples Session (Rp 1.200.000 - 30 Hari)
                                            </option>
                                            <option value="12 PT (Couples) - Rp 1.850.000" {{ str_contains($requestedPackage, '12 PT') && str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                12 PT Couples Session (Rp 1.850.000 - 30 Hari)
                                            </option>
                                            <option value="16 PT (Couples) - Rp 2.150.000" {{ str_contains($requestedPackage, '16 PT') && str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                16 PT Couples Session (Rp 2.150.000 - 40 Hari)
                                            </option>
                                            <option value="20 PT (Couples) - Rp 2.650.000" {{ str_contains($requestedPackage, '20 PT') && str_contains($requestedPackage, 'Couples') ? 'selected' : '' }}>
                                                20 PT Couples Session (Rp 2.650.000 - 60 Hari)
                                            </option>
                                        </optgroup>

                                        <optgroup label="── Kategori: Tiket Tamu Harian Kasir ──">
                                            <option value="Daily Pass - Rp 25.000" {{ str_contains($requestedPackage, 'Daily Pass') ? 'selected' : '' }}>
                                                Daily Pass Harian Kasir (Rp 25.000)
                                            </option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div>
                                    <label for="reg_gender" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                                        Jenis Kelamin <span class="text-red-600">*</span>
                                    </label>
                                    <select id="reg_gender"
                                            name="gender"
                                            required
                                            class="w-full bg-zinc-50 border border-zinc-300 rounded-xl px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition">
                                        <option value="Laki-laki" {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <!-- 3. Alamat Domisili & Tanggal Mulai -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <div>
                                    <label for="reg_address" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                                        Alamat Domisili <span class="text-red-600">*</span>
                                    </label>
                                    <input type="text"
                                           id="reg_address"
                                           name="address"
                                           required
                                           value="{{ old('address') }}"
                                           placeholder="Contoh: Lowokwaru / Jl. Soekarno Hatta"
                                           class="w-full bg-zinc-50 border border-zinc-300 rounded-xl px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition">
                                </div>

                                <div>
                                    <label for="reg_start_date" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                                        Rencana Tanggal Mulai <span class="text-red-600">*</span>
                                    </label>
                                    <input type="date"
                                           id="reg_start_date"
                                           name="start_date"
                                           required
                                           value="{{ old('start_date', date('Y-m-d')) }}"
                                           class="w-full bg-zinc-50 border border-zinc-300 rounded-xl px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition font-mono">
                                </div>
                            </div>

                            <!-- 4. Catatan Tambahan -->
                            <div>
                                <label for="reg_notes" class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                                    Catatan Tambahan (Opsional)
                                </label>
                                <textarea id="reg_notes"
                                          name="notes"
                                          rows="2"
                                          placeholder="Misal: Mahasiswa UB semester 4, ada riwayat cedera bahu, ingin program pembentukan otot, dll."
                                          class="w-full bg-zinc-50 border border-zinc-300 rounded-xl px-4 py-2.5 sm:py-3 text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition">{{ old('notes') }}</textarea>
                            </div>

                            <!-- 5. Submit Button -->
                            <div class="pt-2">
                                <button type="submit"
                                        id="submit-register-btn"
                                        class="w-full py-3.5 px-6 rounded-xl bg-red-600 hover:bg-red-700 active:scale-[0.99] text-white font-montserrat font-bold text-sm uppercase tracking-wider shadow-lg shadow-red-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span id="btn-text">KIRIM PENDAFTARAN KE WHATSAPP ADMIN</span>
                                    <svg id="btn-icon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                                <p class="text-[11px] text-zinc-400 text-center mt-2.5">
                                    Data akan tersimpan aman di database Maco Gym dan dikonfirmasi kasir via WhatsApp.
                                </p>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <!-- ================= BOTTOM PROMOTIONAL BADGES ================= -->
            <div class="w-full bg-zinc-50 border-t border-zinc-200 py-10 sm:py-12">
                <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12 grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 items-stretch">
                    
                    <!-- Promo Badge 1 -->
                    <div class="rounded-3xl bg-zinc-950 text-white min-h-[300px] flex flex-col items-center justify-center p-6 sm:p-8 text-center relative overflow-hidden group shadow-2xl border border-zinc-800">
                        <div class="absolute inset-0 z-0">
                            <img src="{{ asset('images/about-gym.jpg') }}" 
                                 alt="Gym Facilities" 
                                 class="w-full h-full object-cover object-center filter brightness-35 contrast-125 group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/80 to-zinc-950/40"></div>
                            <div class="absolute -bottom-16 -right-16 w-48 h-48 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>
                        </div>
                        
                        <div class="relative z-10 text-center flex flex-col items-center">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600 text-white text-[10px] font-bold uppercase tracking-widest font-montserrat mb-3 shadow-md">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                <span>PAKET HEMAT MACO GYM</span>
                            </div>

                            <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-zinc-300 mb-1 font-sans">
                                Membership mulai dari
                            </span>
                            <div class="font-montserrat font-black text-3xl sm:text-4xl text-white mb-5 tracking-tight drop-shadow-md">
                                Rp 100 ribu<span class="text-sm sm:text-base font-bold text-red-500"> /bulan</span>
                            </div>
                            
                            <a href="{{ route('home') }}#pricing" 
                               class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/40 hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                                <span>Lihat Daftar Harga Resmi</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Promo Badge 2 -->
                    <div class="rounded-3xl bg-white border-2 border-zinc-200 hover:border-red-600 shadow-2xl min-h-[300px] flex flex-col items-center justify-center p-6 sm:p-8 text-center relative overflow-hidden group transition-all duration-500">
                        <div class="absolute -top-12 -right-12 w-40 h-40 bg-red-500/10 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-zinc-900/5 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="relative z-10 flex flex-col items-center">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-zinc-700 text-[10px] font-bold uppercase tracking-widest font-montserrat mb-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                <span>CUSTOMER SUPPORT</span>
                            </div>

                            <div class="w-14 h-14 rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                                    <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                                </svg>
                            </div>
                            
                            <h3 class="text-xl sm:text-2xl font-black text-zinc-900 font-montserrat uppercase tracking-tight mb-2 max-w-sm leading-snug">
                                Ingin Tahu Lebih Banyak Tentang <span class="text-red-600">Maco Gym</span>?
                            </h3>
                            <p class="text-xs sm:text-sm text-zinc-500 mb-6 max-w-sm leading-relaxed font-normal">
                                Tim resepsionis & coach kami siap bantu jawab semua pertanyaan kamu seputar fasilitas, program latihan, & membership.
                            </p>
                            
                            <a href="https://wa.me/6281250207403?text=Halo%20Maco%20Gym%20Malang,%20saya%20ingin%20tanya%20seputar%20membership%20dan%20fasilitas%20gym." 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-xl bg-zinc-950 hover:bg-red-600 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-zinc-950/20 hover:shadow-red-600/30 transition-all duration-200">
                                <svg class="w-4 h-4 text-emerald-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.044c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.072.043.419-.101.824z"/>
                                </svg>
                                <span>Hubungi Admin WhatsApp</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Script: Submit handler & WhatsApp auto-open -->
    <script>
        let isSubmitting = false;

        function handleRegistrationSubmit(form, event) {
            if (isSubmitting) {
                event.preventDefault();
                return false;
            }
            isSubmitting = true;

            const btn = document.getElementById('submit-register-btn');
            const btnText = document.getElementById('btn-text');
            if (btn && btnText) {
                btn.disabled = true;
                btnText.textContent = 'Menyimpan ke Sistem...';
            }
            return true;
        }

        // Jika terdapat session wa_redirect_url setelah submit, buka WhatsApp secara otomatis
        @if(session('wa_redirect_url'))
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.open("{{ session('wa_redirect_url') }}", '_blank');
            }, 600);
        });
        @endif

        // Mobile Nav Toggle Script
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
        });
    </script>
</body>
</html>
