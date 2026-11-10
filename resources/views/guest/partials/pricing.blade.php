<!-- Pricing Section (Clean Light Theme with Red Accents - 3 Main Cards) -->
<section id="pricing" class="py-24 bg-white border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <div class="flex items-center justify-center gap-3 mb-1">
                <span class="w-8 h-[2px] bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">MEMBERSHIP PACKAGES</span>
                <span class="w-8 h-[2px] bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-zinc-900 tracking-tight">
                CHOOSE YOUR <span class="text-red-600">PLAN</span>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600">
                Pilih paket membership terbaik yang sesuai kebutuhanmu. Harga transparan tanpa biaya registrasi tersembunyi.
            </p>
        </div>

        <!-- 3 Main Pricing Cards Container Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch max-w-6xl mx-auto">

            <!-- Card 1: BASIC PLAN (1 Bulan Reguler) -->
            <div class="pricing-card relative rounded-2xl bg-white border border-zinc-200 p-8 flex flex-col justify-between hover:border-zinc-300 shadow-sm hover:shadow-lg transition-all duration-300">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-zinc-500 text-center mb-4 font-montserrat">
                        BASIC PLAN
                    </h3>

                    <!-- Price -->
                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-black text-zinc-900 font-montserrat">Rp 175K</span>
                            <span class="text-xs text-zinc-500 font-bold">/bulan</span>
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
                    <a href="{{ route('register') }}" 
                       class="w-full py-3.5 px-4 rounded-xl font-bold text-xs uppercase tracking-wider bg-zinc-900 hover:bg-red-600 text-white transition-all text-center block shadow-sm">
                        PILIH PAKET INI
                    </a>
                </div>
            </div>

            <!-- Card 2: STANDARD / POPULAR PLAN (3 Bulan Hemat) - Highlighted with Angled Red POPULAR Badge -->
            <div class="pricing-card relative rounded-2xl bg-white border-2 border-red-600 p-8 flex flex-col justify-between shadow-xl shadow-red-600/15 transform md:-translate-y-2 transition-all duration-300 overflow-hidden">
                <!-- POPULAR Badge -->
                <div class="absolute top-4 right-4 bg-red-600 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded shadow">
                    POPULAR
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-red-600 text-center mb-4 font-montserrat">
                        STANDARD PLAN
                    </h3>

                    <!-- Price -->
                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-black text-zinc-900 font-montserrat">Rp 450K</span>
                            <span class="text-xs text-zinc-500 font-bold">/3 bulan</span>
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
                    <a href="{{ route('register') }}" 
                       class="w-full py-3.5 px-4 rounded-xl font-bold text-xs uppercase tracking-wider bg-red-600 hover:bg-red-700 text-white transition-all text-center block shadow-lg shadow-red-600/30">
                        PILIH PAKET INI
                    </a>
                </div>
            </div>

            <!-- Card 3: STUDENT SPECIAL PLAN (1 Bulan Mahasiswa) -->
            <div class="pricing-card relative rounded-2xl bg-white border border-zinc-200 p-8 flex flex-col justify-between hover:border-zinc-300 shadow-sm hover:shadow-lg transition-all duration-300">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-zinc-500 text-center mb-4 font-montserrat">
                        STUDENT PLAN (KTM)
                    </h3>

                    <!-- Price -->
                    <div class="text-center pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-3xl sm:text-4xl font-black text-zinc-900 font-montserrat">Rp 135K</span>
                            <span class="text-xs text-zinc-500 font-bold">/bulan</span>
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
                    <a href="{{ route('register') }}" 
                       class="w-full py-3.5 px-4 rounded-xl font-bold text-xs uppercase tracking-wider bg-zinc-900 hover:bg-red-600 text-white transition-all text-center block shadow-sm">
                        PILIH PAKET INI
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>
