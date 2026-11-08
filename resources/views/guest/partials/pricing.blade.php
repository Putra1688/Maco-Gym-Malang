<!-- Pricing Section (Clean Light Theme with Red Accents) -->
<section id="pricing" class="py-24 bg-white border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <div class="flex items-center justify-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">MEMBERSHIP PACKAGES</span>
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-zinc-900 tracking-tight">
                CHOOSE YOUR PLAN
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600">
                Pilih paket membership terbaik yang sesuai kebutuhanmu. Harga transparan tanpa biaya registrasi tersembunyi.
            </p>

            <!-- Filter Buttons / Tabs -->
            <div class="pt-4 flex flex-wrap items-center justify-center gap-2">
                <button type="button" onclick="filterPricing('all')" id="btn-tab-all" class="pricing-tab-btn px-4 py-2 rounded-md text-xs font-bold uppercase tracking-wider bg-red-600 text-white shadow-md shadow-red-600/25 transition-all">
                    SEMUA PAKET
                </button>
                <button type="button" onclick="filterPricing('bulanan')" id="btn-tab-bulanan" class="pricing-tab-btn px-4 py-2 rounded-md text-xs font-bold uppercase tracking-wider bg-zinc-100 text-zinc-700 hover:text-zinc-900 border border-zinc-200 transition-all">
                    BULANAN REGULER
                </button>
                <button type="button" onclick="filterPricing('mahasiswa')" id="btn-tab-mahasiswa" class="pricing-tab-btn px-4 py-2 rounded-md text-xs font-bold uppercase tracking-wider bg-zinc-100 text-zinc-700 hover:text-zinc-900 border border-zinc-200 transition-all">
                    🎓 PROMO MAHASISWA
                </button>
                <button type="button" onclick="filterPricing('pt')" id="btn-tab-pt" class="pricing-tab-btn px-4 py-2 rounded-md text-xs font-bold uppercase tracking-wider bg-zinc-100 text-zinc-700 hover:text-zinc-900 border border-zinc-200 transition-all">
                    🔥 PERSONAL TRAINER
                </button>
            </div>
        </div>

        <!-- Pricing Cards Container Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">

            <!-- Card 1: BASIC PLAN (1 Bulan Reguler) -->
            <div class="pricing-card package-bulanan relative rounded-2xl bg-white border border-zinc-200 p-8 flex flex-col justify-between hover:border-zinc-300 shadow-sm hover:shadow-lg transition-all duration-300">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-zinc-500 text-center mb-4">
                        BASIC PLAN
                    </h3>

                    <!-- Price -->
                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-bold text-zinc-900">Rp 175K</span>
                            <span class="text-xs text-zinc-500 font-bold">/month</span>
                        </div>
                        <span class="text-[11px] text-zinc-500 mt-1 block">Akses 30 Hari Penuh</span>
                    </div>

                    <!-- Checklist -->
                    <ul class="space-y-3.5 text-xs text-zinc-600">
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Gym Access Unlimited 06:00 - 22:00</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Basic & Advanced Equipment</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Locker Room & Hot Shower Access</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Free Fitness & Equipment Orientation</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-zinc-100">
                    <button type="button" onclick="selectPackage('1 Bulan Reguler - Rp 175.000')" class="w-full py-3 px-4 rounded-md font-bold text-xs uppercase tracking-wider bg-zinc-900 hover:bg-red-600 text-white transition-colors">
                        CHOOSE PLAN
                    </button>
                </div>
            </div>

            <!-- Card 2: STANDARD / POPULAR PLAN (3 Bulan Hemat) - Highlighted with Angled Red POPULAR Badge -->
            <div class="pricing-card package-bulanan relative rounded-2xl bg-white border-2 border-red-600 p-8 flex flex-col justify-between shadow-xl shadow-red-600/10 transform lg:-translate-y-2 transition-all duration-300 overflow-hidden">
                <!-- POPULAR Badge -->
                <div class="absolute top-4 right-4 bg-red-600 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded shadow">
                    POPULAR
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-red-600 text-center mb-4">
                        STANDARD PLAN
                    </h3>

                    <!-- Price -->
                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-bold text-zinc-900">Rp 450K</span>
                            <span class="text-xs text-zinc-500 font-bold">/3 months</span>
                        </div>
                        <span class="text-[11px] text-red-600 font-bold mt-1 block">Setara Rp 150.000 /bulan (Hemat Rp 75k)</span>
                    </div>

                    <!-- Checklist -->
                    <ul class="space-y-3.5 text-xs text-zinc-700">
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Gym Access Unlimited (90 Hari)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>All Equipment & Cardio Theater</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Locker, Hot Shower & Musholla</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Personal Assessment & BMI Tracking</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Free Exclusive Shaker Bottle Maco Gym</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-zinc-100">
                    <button type="button" onclick="selectPackage('3 Bulan Hemat - Rp 450.000')" class="w-full py-3 px-4 rounded-md font-bold text-xs uppercase tracking-wider bg-red-600 hover:bg-red-700 text-white transition-colors shadow-lg shadow-red-600/25">
                        CHOOSE PLAN
                    </button>
                </div>
            </div>

            <!-- Card 3: STUDENT SPECIAL PLAN (1 Bulan Mahasiswa) -->
            <div class="pricing-card package-mahasiswa relative rounded-2xl bg-white border border-zinc-200 p-8 flex flex-col justify-between hover:border-zinc-300 shadow-sm hover:shadow-lg transition-all duration-300">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-zinc-500 text-center mb-4">
                        STUDENT PLAN (KTM)
                    </h3>

                    <!-- Price -->
                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-bold text-zinc-900">Rp 135K</span>
                            <span class="text-xs text-zinc-500 font-bold">/month</span>
                        </div>
                        <span class="text-[11px] text-zinc-500 mt-1 block">Khusus Mahasiswa & Pelajar Malang</span>
                    </div>

                    <!-- Checklist -->
                    <ul class="space-y-3.5 text-xs text-zinc-600">
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Gym Access Unlimited Seharian Penuh</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>All Equipment Bebas Dipakai Kapan Saja</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Locker Room & Shower Air Hangat</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Cukup Tunjukkan KTM (UB/UM/Polinema/UIN/dll)</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-zinc-100">
                    <button type="button" onclick="selectPackage('1 Bulan Mahasiswa - Rp 135.000')" class="w-full py-3 px-4 rounded-md font-bold text-xs uppercase tracking-wider bg-zinc-900 hover:bg-red-600 text-white transition-colors">
                        CHOOSE PLAN
                    </button>
                </div>
            </div>

            <!-- Extra Card: 3 Bulan Mahasiswa (Student Semester) -->
            <div class="pricing-card package-mahasiswa relative rounded-2xl bg-white border border-zinc-200 p-8 flex flex-col justify-between hover:border-zinc-300 shadow-sm hover:shadow-lg transition-all duration-300">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-red-600 text-center mb-4">
                        3 BULAN MAHASISWA
                    </h3>

                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-bold text-zinc-900">Rp 360K</span>
                            <span class="text-xs text-zinc-500 font-bold">/3 months</span>
                        </div>
                        <span class="text-[11px] text-red-600 font-bold mt-1 block">Hanya Rp 120.000 /bulan (Termurah!)</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-zinc-600">
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Akses 90 Hari Penuh Tanpa Batas Jam</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Semua Alat Gym & Fasilitas Loker Shower</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Paket Terbaik untuk 1 Semester Aktif Kuliah</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-zinc-100">
                    <button type="button" onclick="selectPackage('3 Bulan Mahasiswa - Rp 360.000')" class="w-full py-3 px-4 rounded-md font-bold text-xs uppercase tracking-wider bg-zinc-900 hover:bg-red-600 text-white transition-colors">
                        CHOOSE PLAN
                    </button>
                </div>
            </div>

            <!-- Extra Card: PT 12 Sesi (Intensive Transformation) -->
            <div class="pricing-card package-pt relative rounded-2xl bg-white border border-zinc-200 p-8 flex flex-col justify-between hover:border-zinc-300 shadow-sm hover:shadow-lg transition-all duration-300">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-red-600 text-center mb-4">
                        PT 12 SESI (INTENSIVE)
                    </h3>

                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-bold text-zinc-900">Rp 1.250K</span>
                            <span class="text-xs text-zinc-500 font-bold">/12 sessions</span>
                        </div>
                        <span class="text-[11px] text-zinc-500 mt-1 block">Rekomendasi Coach untuk Transformasi Cepat</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-zinc-600">
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>12 Sesi Pendampingan 1-on-1 dengan Certified Coach</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Personalized Meal Plan & Nutrition Guidance</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Evaluasi Mingguan & Koreksi Form Biomekanik</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-zinc-100">
                    <button type="button" onclick="selectPackage('Personal Trainer 12 Sesi - Rp 1.250.000')" class="w-full py-3 px-4 rounded-md font-bold text-xs uppercase tracking-wider bg-red-600 hover:bg-red-700 text-white transition-colors shadow-lg shadow-red-600/25">
                        CHOOSE PLAN
                    </button>
                </div>
            </div>

            <!-- Extra Card: Daily Pass Harian -->
            <div class="pricing-card package-bulanan relative rounded-2xl bg-white border border-zinc-200 p-8 flex flex-col justify-between hover:border-zinc-300 shadow-sm hover:shadow-lg transition-all duration-300">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-zinc-500 text-center mb-4">
                        DAILY PASS (HARIAN)
                    </h3>

                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-bold text-zinc-900">Rp 25K</span>
                            <span class="text-xs text-zinc-500 font-bold">/visit</span>
                        </div>
                        <span class="text-[11px] text-zinc-500 mt-1 block">Sekali Datang Tanpa Kewajiban Member</span>
                    </div>

                    <ul class="space-y-3.5 text-xs text-zinc-600">
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Akses Seharian Penuh ke Seluruh Alat</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Termasuk Fasilitas Loker & Kamar Bilas</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-600 font-bold">✓</span>
                            <span>Langsung Datang ke Kasir Maco Gym</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-8 pt-6 border-t border-zinc-100">
                    <button type="button" onclick="selectPackage('Daily Pass Harian - Rp 25.000')" class="w-full py-3 px-4 rounded-md font-bold text-xs uppercase tracking-wider bg-zinc-900 hover:bg-red-600 text-white transition-colors">
                        CHOOSE PLAN
                    </button>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Filter Script -->
<script>
    function filterPricing(category) {
        const cards = document.querySelectorAll('.pricing-card');
        const buttons = document.querySelectorAll('.pricing-tab-btn');

        buttons.forEach(btn => {
            btn.classList.remove('bg-red-600', 'text-white', 'shadow-md', 'shadow-red-600/25');
            btn.classList.add('bg-zinc-100', 'text-zinc-700');
        });

        const activeBtn = document.getElementById(`btn-tab-${category}`);
        if (activeBtn) {
            activeBtn.classList.remove('bg-zinc-100', 'text-zinc-700');
            activeBtn.classList.add('bg-red-600', 'text-white', 'shadow-md', 'shadow-red-600/25');
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
        const regSection = document.getElementById('cara-daftar');
        if (regSection) {
            regSection.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>