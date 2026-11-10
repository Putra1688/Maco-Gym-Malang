<!-- Pricing Section (Official Price List Categories) -->
<section id="pricing" class="py-20 sm:py-24 bg-white border-t border-zinc-200 relative">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16 space-y-3">
            <div class="flex items-center justify-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">OFFICIAL PRICE LIST</span>
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-4xl lg:text-5xl font-black uppercase text-zinc-900 tracking-tight">
                CHOOSE YOUR <span class="text-red-600">PLAN</span>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600 max-w-2xl mx-auto leading-relaxed">
                Pilihan program keanggotaan gym dan sesi latihan privat bersama Coach profesional Maco Gym Malang. Transparan, terjangkau, dan tanpa biaya tersembunyi.
            </p>
        </div>

        <!-- 3 Main Category Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 items-stretch">

            <!-- Kategori 1: MEMBERSHIP -->
            <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-600 transition-all duration-300 shadow-sm hover:shadow-xl hover:shadow-red-600/10 flex flex-col justify-between overflow-hidden">
                <div>
                    <!-- Representative Image -->
                    <div class="relative h-56 sm:h-60 w-full overflow-hidden bg-zinc-900">
                        <img src="{{ asset('images/about-gym.jpg') }}"
                             alt="Membership Maco Gym Malang"
                             class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 filter brightness-90 contrast-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-red-600 text-white shadow-md">
                            KEANGGOTAAN GYM
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7">
                        <h3 class="font-montserrat text-xl sm:text-2xl font-black uppercase text-zinc-900 tracking-tight mb-2 group-hover:text-red-600 transition-colors">
                            MEMBERSHIP
                        </h3>
                        <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed mb-6 font-sans">
                            Pilihan keanggotaan gym untuk reguler, mahasiswa, dan pelajar.
                        </p>

                        <!-- Key Highlights -->
                        <div class="space-y-2.5 pt-4 border-t border-zinc-100 text-xs text-zinc-700">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Akses alat beban & cardio unlimited</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Pilihan periode 1, 3, 6, dan 12 bulan</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Tarif hemat khusus pelajar & mahasiswa</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="p-6 sm:p-7 pt-0">
                    <a href="{{ route('pricing.membership') }}"
                       class="w-full py-3.5 px-5 rounded-xl bg-zinc-900 group-hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center justify-center gap-2 shadow-sm group-hover:shadow-md group-hover:shadow-red-600/30">
                        <span>LIHAT DETAIL PAKET</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Kategori 2: PERSONAL TRAINER SINGLE -->
            <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-600 transition-all duration-300 shadow-sm hover:shadow-xl hover:shadow-red-600/10 flex flex-col justify-between overflow-hidden">
                <div>
                    <!-- Representative Image -->
                    <div class="relative h-56 sm:h-60 w-full overflow-hidden bg-zinc-900">
                        <img src="{{ asset('images/trainers/coach-kevin.jpg') }}"
                             alt="Personal Trainer Single Maco Gym"
                             class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-90 contrast-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-zinc-900 text-white border border-zinc-700 shadow-md">
                            1-ON-1 COACHING
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7">
                        <h3 class="font-montserrat text-xl sm:text-2xl font-black uppercase text-zinc-900 tracking-tight mb-2 group-hover:text-red-600 transition-colors">
                            PERSONAL TRAINER SINGLE
                        </h3>
                        <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed mb-6 font-sans">
                            Program latihan personal dengan satu trainer untuk satu orang.
                        </p>

                        <!-- Key Highlights -->
                        <div class="space-y-2.5 pt-4 border-t border-zinc-100 text-xs text-zinc-700">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Privat 1 klien bersama 1 Coach bersertifikat</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Durasi 1–1,5 jam setiap kedatangan</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Pilihan paket 1, 4, 8, 12, 16, hingga 20 sesi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="p-6 sm:p-7 pt-0">
                    <a href="{{ route('pricing.pt-single') }}"
                       class="w-full py-3.5 px-5 rounded-xl bg-zinc-900 group-hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center justify-center gap-2 shadow-sm group-hover:shadow-md group-hover:shadow-red-600/30">
                        <span>LIHAT DETAIL PAKET</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Kategori 3: PERSONAL TRAINER COUPLES -->
            <div class="group bg-white rounded-2xl border border-zinc-200 hover:border-red-600 transition-all duration-300 shadow-sm hover:shadow-xl hover:shadow-red-600/10 flex flex-col justify-between overflow-hidden">
                <div>
                    <!-- Representative Image -->
                    <div class="relative h-56 sm:h-60 w-full overflow-hidden bg-zinc-900">
                        <img src="{{ asset('images/programs/flexibility.jpg') }}"
                             alt="Personal Trainer Couples Maco Gym"
                             class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 filter brightness-90 contrast-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-mono font-bold uppercase tracking-wider bg-zinc-900 text-white border border-zinc-700 shadow-md">
                            PARTNER WORKOUT
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 sm:p-7">
                        <h3 class="font-montserrat text-xl sm:text-2xl font-black uppercase text-zinc-900 tracking-tight mb-2 group-hover:text-red-600 transition-colors">
                            PERSONAL TRAINER COUPLES
                        </h3>
                        <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed mb-6 font-sans">
                            Program latihan personal untuk dua orang bersama satu trainer.
                        </p>

                        <!-- Key Highlights -->
                        <div class="space-y-2.5 pt-4 border-t border-zinc-100 text-xs text-zinc-700">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Latihan berdua (pasangan/sahabat) 1 Coach</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Durasi 1–1,5 jam setiap kedatangan</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-600 shrink-0"></span>
                                <span>Tarif lebih hemat dengan motivasi berdua</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="p-6 sm:p-7 pt-0">
                    <a href="{{ route('pricing.pt-couples') }}"
                       class="w-full py-3.5 px-5 rounded-xl bg-zinc-900 group-hover:bg-red-600 text-white font-montserrat font-bold text-xs uppercase tracking-wider transition-all duration-200 flex items-center justify-center gap-2 shadow-sm group-hover:shadow-md group-hover:shadow-red-600/30">
                        <span>LIHAT DETAIL PAKET</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <!-- Trust & Transparency Footer Note -->
        <div class="mt-12 text-center text-xs text-zinc-500 font-mono">
            <span>* Semua harga resmi, transparan, dan dapat diverifikasi langsung di resepsionis Maco Gym Malang.</span>
        </div>

    </div>
</section>
