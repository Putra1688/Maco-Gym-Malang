<!-- Pricing & Membership Section -->
<section id="pricing" class="py-24 bg-zinc-950 relative overflow-hidden">
    <!-- Glow Effect -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-amber-500/10 blur-[150px] pointer-events-none rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 space-y-4">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-wider">
                Pilihan Paket & Investasi Kebugaran
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white uppercase tracking-tight">
                Harga Transparan, <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-300">Tanpa Biaya Tersembunyi</span>
            </h2>
            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                Pilih paket yang paling pas untuk tujuan kebugaran dan budget kamu. Tersedia harga bulanan reguler, tarif hemat khusus mahasiswa Malang, serta pendampingan Personal Trainer berlisensi.
            </p>

            <!-- Filter Buttons / Tabs -->
            <div class="pt-4 flex flex-wrap items-center justify-center gap-2">
                <button type="button" onclick="filterPricing('all')" id="btn-tab-all" class="pricing-tab-btn active px-4 py-2 rounded-xl text-xs sm:text-sm font-bold bg-amber-400 text-zinc-950 shadow-lg shadow-amber-500/20 transition-all">
                    Semua Paket
                </button>
                <button type="button" onclick="filterPricing('bulanan')" id="btn-tab-bulanan" class="pricing-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-zinc-900 text-zinc-300 hover:text-white border border-zinc-800 hover:border-zinc-700 transition-all">
                    Paket Bulanan
                </button>
                <button type="button" onclick="filterPricing('mahasiswa')" id="btn-tab-mahasiswa" class="pricing-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-zinc-900 text-zinc-300 hover:text-white border border-zinc-800 hover:border-zinc-700 transition-all">
                    🎓 Khusus Mahasiswa
                </button>
                <button type="button" onclick="filterPricing('pt')" id="btn-tab-pt" class="pricing-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold bg-zinc-900 text-zinc-300 hover:text-white border border-zinc-800 hover:border-zinc-700 transition-all">
                    🔥 Personal Trainer
                </button>
            </div>
        </div>

        <!-- Pricing Cards Container Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">

            <!-- Card 1: 1 Bulan Reguler (Bulanan) -->
            <div class="pricing-card package-bulanan relative rounded-3xl bg-zinc-900/90 border border-zinc-800 p-8 flex flex-col justify-between hover:border-zinc-600 transition-all duration-300 hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400 bg-zinc-800/80 px-3 py-1 rounded-md">
                            Membership Reguler
                        </span>
                        <span class="text-xs text-zinc-400 font-medium">Buka Tiap Hari</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">1 Bulan Reguler</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Pilihan fleksibel untuk memulai rutinitas latihan fisik.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-zinc-800">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">175.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ 30 Hari</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-300">
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Akses bebas seluruh alat tanpa batasan jam</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Gratis penggunaan loker penyimpanan & shower</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Akses musholla & parkir gratis aman ber-CCTV</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Free orientasi gym & pengenalan alat bagi pemula</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('1 Bulan Reguler - Rp 175.000')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-zinc-800 hover:bg-zinc-700 text-white transition-colors text-center border border-zinc-700">
                        Pilih Paket 1 Bulan
                    </button>
                </div>
            </div>

            <!-- Card 2: 3 Bulan Reguler (Bulanan - Best Value) -->
            <div class="pricing-card package-bulanan relative rounded-3xl bg-gradient-to-b from-zinc-800/90 via-zinc-900 to-zinc-950 border-2 border-amber-400 p-8 flex flex-col justify-between shadow-2xl shadow-amber-500/15 transform hover:-translate-y-2 transition-all duration-300">
                <!-- Highlight Badge -->
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-amber-400 to-yellow-400 text-zinc-950 text-xs font-black uppercase tracking-wider shadow-md">
                    ★ Paling Populer (Hemat)
                </div>

                <div>
                    <div class="flex items-center justify-between mb-4 mt-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-amber-400 bg-amber-400/10 px-3 py-1 rounded-md border border-amber-400/30">
                            Best Value Plan
                        </span>
                        <span class="text-xs text-amber-300 font-bold">Hemat Rp 75.000</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">3 Bulan Hemat</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Komitmen terbaik untuk transformasi tubuh yang nyata.</p>

                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">450.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ 90 Hari</span>
                    </div>
                    <div class="text-[11px] text-amber-400/90 font-medium mb-6 pb-6 border-b border-zinc-800">
                        Hanya setara <strong>Rp 150.000 / bulan</strong>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-200">
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Akses unlimited gym 90 hari tanpa jam batas</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Bonus 1x Body Composition & BMI Check</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Konsultasi program dasar latihan mingguan</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Fasilitas lengkap: Loker, Shower Hangat, Musholla</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Free Exclusive Shaker Bottle Maco Gym</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('3 Bulan Hemat - Rp 450.000')" class="w-full py-3.5 px-4 rounded-xl font-black text-sm bg-gradient-to-r from-amber-400 to-yellow-400 hover:from-amber-300 hover:to-yellow-300 text-zinc-950 shadow-lg shadow-amber-500/25 transition-all text-center">
                        Daftar Paket 3 Bulan &rarr;
                    </button>
                </div>
            </div>

            <!-- Card 3: 1 Bulan Mahasiswa (Mahasiswa) -->
            <div class="pricing-card package-mahasiswa relative rounded-3xl bg-zinc-900/90 border border-blue-500/40 p-8 flex flex-col justify-between hover:border-blue-400 transition-all duration-300 hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-400 bg-blue-500/10 px-3 py-1 rounded-md border border-blue-500/30">
                            🎓 Khusus Pelajar & Mahasiswa
                        </span>
                        <span class="text-xs text-blue-300 font-medium">Wajib KTM</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">1 Bulan Mahasiswa</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Tarif subsidi untuk mahasiswa UB, UM, UIN, Polinema, UMM, dll.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-zinc-800">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">135.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ 30 Hari</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-300">
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Akses penuh semua alat gym tanpa batasan jam</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Loker harian aman & kamar mandi shower bersih</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Wi-Fi kencang & area istirahat nyaman</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Cukup tunjukkan KTM fisik atau screenshot SIAKAD</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('1 Bulan Mahasiswa - Rp 135.000')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-500 text-white transition-colors text-center shadow-lg shadow-blue-600/20">
                        Pilih Paket Mahasiswa (1 Bln)
                    </button>
                </div>
            </div>

            <!-- Card 4: 3 Bulan Mahasiswa (Mahasiswa Super Hemat) -->
            <div class="pricing-card package-mahasiswa relative rounded-3xl bg-zinc-900/90 border border-blue-500/50 p-8 flex flex-col justify-between hover:border-blue-400 transition-all duration-300 hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-400 bg-blue-500/10 px-3 py-1 rounded-md border border-blue-500/30">
                            🎓 Semesteran Mahasiswa
                        </span>
                        <span class="text-xs text-emerald-400 font-bold">Termurah!</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">3 Bulan Mahasiswa</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Investasi hemat 1 semester untuk tubuh bugar dan atletis.</p>

                    <div class="flex items-baseline gap-1 mb-2">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">360.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ 90 Hari</span>
                    </div>
                    <div class="text-[11px] text-blue-400 font-medium mb-6 pb-6 border-b border-zinc-800">
                        Cuma setara <strong>Rp 120.000 / bulan</strong> (Hemat Rp 45.000)
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-300">
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Akses bebas seluruh alat selama 90 hari</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Semua fasilitas loker, shower air hangat, musholla</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Bebas latihan kapan pun (pagi, sore, atau malam)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-blue-400 font-bold">✓</span>
                            <span>Syarat hanya KTM aktif perguruan tinggi Malang</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('3 Bulan Mahasiswa - Rp 360.000')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-500 text-white transition-colors text-center shadow-lg shadow-blue-600/20">
                        Pilih 3 Bulan Mahasiswa
                    </button>
                </div>
            </div>

            <!-- Card 5: Starter Personal Trainer (5 Sesi) -->
            <div class="pricing-card package-pt relative rounded-3xl bg-zinc-900/90 border border-orange-500/40 p-8 flex flex-col justify-between hover:border-orange-400 transition-all duration-300 hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-orange-400 bg-orange-500/10 px-3 py-1 rounded-md border border-orange-500/30">
                            🔥 Personal Trainer Starter
                        </span>
                        <span class="text-xs text-zinc-400 font-medium">1-on-1 Coaching</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">PT 5 Sesi (Starter)</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Sempurna untuk pemula agar paham gerakan dan tidak cedera.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-zinc-800">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">600.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ 5 Sesi</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-300">
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>5 sesi latihan privat 1-on-1 bersama Certified Coach</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Koreksi biomekanik & form teknik angkatan beban</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Program pengenalan alat agar percaya diri saat latihan</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Jadwal latihan fleksibel disepakati dengan pelatih</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('Personal Trainer 5 Sesi - Rp 600.000')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-orange-600 hover:bg-orange-500 text-white transition-colors text-center shadow-lg shadow-orange-600/20">
                        Pilih PT Starter (5 Sesi)
                    </button>
                </div>
            </div>

            <!-- Card 6: Intensive PT (12 Sesi) - Rekomendasi Coach -->
            <div class="pricing-card package-pt relative rounded-3xl bg-gradient-to-b from-orange-950/40 via-zinc-900 to-zinc-950 border-2 border-orange-500 p-8 flex flex-col justify-between shadow-2xl shadow-orange-500/20 hover:-translate-y-2 transition-all duration-300">
                <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full bg-gradient-to-r from-orange-500 to-amber-500 text-white text-xs font-black uppercase tracking-wider shadow-md">
                    ★ Rekomendasi Transformasi Cepat
                </div>

                <div>
                    <div class="flex items-center justify-between mb-4 mt-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-orange-400 bg-orange-500/10 px-3 py-1 rounded-md border border-orange-500/30">
                            Intensive Body Transformation
                        </span>
                        <span class="text-xs text-amber-400 font-bold">Hasil Terbukti</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">PT 12 Sesi (Intensive)</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Target Fat Loss / Muscle Hypertrophy dalam 1 bulan terarah.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-zinc-800">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">1.250.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ 12 Sesi</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-200">
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>12 sesi pendampingan intensif bersama Certified Coach</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Customized Workout Routine sesuai target tubuh</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Panduan pola makan harian (Meal Plan & Kalori)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Evaluasi mingguan & tracking lingkar badan/lemak</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Konsultasi privat via WhatsApp 7 hari seminggu</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('Personal Trainer 12 Sesi - Rp 1.250.000')" class="w-full py-3.5 px-4 rounded-xl font-black text-sm bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-400 hover:to-amber-400 text-white shadow-lg shadow-orange-500/25 transition-all text-center">
                        Pilih PT Intensive (12 Sesi) &rarr;
                    </button>
                </div>
            </div>

            <!-- Card 7: Daily Pass & 24 Sesi PT Extra Cards inside Bulanan & PT filters -->
            <div class="pricing-card package-bulanan relative rounded-3xl bg-zinc-900/90 border border-zinc-800 p-8 flex flex-col justify-between hover:border-zinc-700 transition-all duration-300">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-zinc-400 bg-zinc-800 px-3 py-1 rounded-md">
                            Harian / Non-Member
                        </span>
                        <span class="text-xs text-zinc-400 font-medium">Bebas Datang</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">Daily Pass (Harian)</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Solusi bagi yang ingin coba-coba atau pengunjung luar kota.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-zinc-800">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">25.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ Sekali Datang</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-300">
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Akses semua alat gym seharian penuh</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Akses loker dan shower air hangat</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 font-bold">✓</span>
                            <span>Bebas datang langsung tanpa perlu booking</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('Daily Pass Harian - Rp 25.000')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-zinc-800 hover:bg-zinc-700 text-white transition-colors text-center border border-zinc-700">
                        Pilih Daily Pass
                    </button>
                </div>
            </div>

            <!-- Card 8: Pro Transformation PT (24 Sesi) -->
            <div class="pricing-card package-pt relative rounded-3xl bg-zinc-900/90 border border-orange-500/40 p-8 flex flex-col justify-between hover:border-orange-400 transition-all duration-300">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-orange-400 bg-orange-500/10 px-3 py-1 rounded-md border border-orange-500/30">
                            👑 Elite Transformation
                        </span>
                        <span class="text-xs text-amber-400 font-bold">2 Bulan Penuh</span>
                    </div>

                    <h3 class="text-2xl font-black text-white">PT 24 Sesi (Elite)</h3>
                    <p class="text-xs text-zinc-400 mt-1 mb-6">Program total re-komposisi tubuh dari nol sampai hasil maksimal.</p>

                    <div class="flex items-baseline gap-1 mb-6 pb-6 border-b border-zinc-800">
                        <span class="text-sm font-bold text-amber-400">Rp</span>
                        <span class="text-4xl font-black text-white">2.200.000</span>
                        <span class="text-xs text-zinc-400 font-medium">/ 24 Sesi</span>
                    </div>

                    <ul class="space-y-3 text-xs sm:text-sm text-zinc-300">
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>24 sesi latihan tatap muka (3x seminggu x 8 minggu)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Full Nutrition & Meal Blueprint terpersonalisasi</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Garansi progres teknik & peningkatan massa otot/fat loss</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-orange-400 font-bold">✓</span>
                            <span>Pendampingan 24/7 konsultasi nutrisi & suplemen</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-4">
                    <button type="button" onclick="selectPackage('Personal Trainer 24 Sesi - Rp 2.200.000')" class="w-full py-3.5 px-4 rounded-xl font-bold text-sm bg-orange-600 hover:bg-orange-500 text-white transition-colors text-center shadow-lg shadow-orange-600/20">
                        Pilih PT Elite (24 Sesi)
                    </button>
                </div>
            </div>

        </div>

        <!-- Custom / Annual Consultation Notice -->
        <div class="mt-12 p-6 rounded-2xl bg-zinc-900/60 border border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="space-y-1 text-center sm:text-left">
                <div class="text-white font-bold text-sm sm:text-base">Butuh Paket Tahunan atau Paket Komunitas / Kantor?</div>
                <div class="text-zinc-400 text-xs sm:text-sm">Kami menyediakan diskon korporat dan paket tahunan khusus dengan penawaran menarik.</div>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20tertarik%20dengan%20paket%20tahunan%20atau%20korporat."
               target="_blank"
               rel="noopener noreferrer"
               class="px-5 py-2.5 rounded-xl bg-zinc-800 hover:bg-zinc-700 text-amber-400 font-bold text-xs sm:text-sm border border-zinc-700 transition-colors whitespace-nowrap">
                Hubungi Kami via WA &rarr;
            </a>
        </div>

    </div>
</section>

<!-- Script for Pricing Filter and Selection -->
<script>
    function filterPricing(category) {
        const cards = document.querySelectorAll('.pricing-card');
        const buttons = document.querySelectorAll('.pricing-tab-btn');

        buttons.forEach(btn => {
            btn.classList.remove('active', 'bg-amber-400', 'text-zinc-950', 'shadow-lg', 'shadow-amber-500/20');
            btn.classList.add('bg-zinc-900', 'text-zinc-300');
        });

        const activeBtn = document.getElementById(`btn-tab-${category}`);
        if (activeBtn) {
            activeBtn.classList.remove('bg-zinc-900', 'text-zinc-300');
            activeBtn.classList.add('active', 'bg-amber-400', 'text-zinc-950', 'shadow-lg', 'shadow-amber-500/20');
        }

        cards.forEach(card => {
            if (category === 'all') {
                card.style.display = 'flex';
            } else if (card.classList.contains(`package-${category}`)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function selectPackage(packageName) {
        const selectEl = document.getElementById('selected_package');
        if (selectEl) {
            for (let i = 0; i < selectEl.options.length; i++) {
                if (selectEl.options[i].text.includes(packageName.split(' - ')[0])) {
                    selectEl.selectedIndex = i;
                    break;
                }
            }
        }
        // Scroll smoothly to registration
        const regSection = document.getElementById('cara-daftar');
        if (regSection) {
            regSection.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>

