<!-- Personal Trainer Section (Clean Light Theme with Red Accents & Bright Coach Photos) -->
<section id="trainers" class="py-24 bg-zinc-50 border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2 h-2 rounded-full bg-red-600"></span>
                    <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">COACHING STAFF</span>
                </div>
                <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-zinc-900 tracking-tight">
                    OUR EXPERT <span class="text-red-600">TRAINERS</span>
                </h2>
            </div>
            <div>
                <p class="text-xs sm:text-sm text-zinc-600 max-w-md">
                    Dipandu langsung oleh pelatih berlisensi nasional & internasional untuk memastikan form latihan benar dan hasil yang maksimal.
                </p>
            </div>
        </div>

        <!-- 4 Trainers Grid with Real Athletic Photos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Trainer 1 -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-2 shadow-sm hover:shadow-xl">
                <!-- Visual Area with Real Coach Photo -->
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-rangga.jpg') }}"
                         alt="Coach Rangga Pratama"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    
                    <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-wider bg-red-600 text-white px-2.5 py-0.5 rounded shadow">
                        Head Coach
                    </span>
                    <span class="absolute top-3 right-3 text-[10px] font-semibold text-white bg-black/80 backdrop-blur-sm px-2.5 py-0.5 rounded border border-white/20">
                        7+ Th Exp
                    </span>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                            Coach Rangga Pratama, S.Or
                        </h3>
                        <p class="text-xs text-red-600 font-semibold mt-0.5">Hypertrophy & Body Recomposition</p>
                        
                        <div class="mt-2 text-[10px] font-bold text-zinc-700 bg-zinc-100 px-2 py-1 rounded border border-zinc-200 inline-block">
                            APKI Certified & Sarjana Olahraga
                        </div>

                        <p class="text-xs text-zinc-600 mt-2.5 leading-relaxed">
                            Spesialis program pembentukan massa otot kering dan adaptasi biomekanik latihan angkat beban.
                        </p>
                    </div>

                    <div class="pt-3 border-t border-zinc-100">
                        <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20tertarik%20untuk%20konsultasi%20dengan%20Coach%20Rangga."
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-md text-xs font-bold uppercase tracking-wider bg-zinc-100 hover:bg-red-600 text-zinc-800 hover:text-white border border-zinc-200 hover:border-red-600 transition-colors">
                            <span>KONSULTASI COACH</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Trainer 2 -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-2 shadow-sm hover:shadow-xl">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-kevin.jpg') }}"
                         alt="Coach Kevin Ardian"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                    <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-wider bg-red-600 text-white px-2.5 py-0.5 rounded shadow">
                        Senior Coach
                    </span>
                    <span class="absolute top-3 right-3 text-[10px] font-semibold text-white bg-black/80 backdrop-blur-sm px-2.5 py-0.5 rounded border border-white/20">
                        5+ Th Exp
                    </span>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                            Coach Kevin Ardian, CPT
                        </h3>
                        <p class="text-xs text-red-600 font-semibold mt-0.5">Weight Management & HIIT</p>
                        
                        <div class="mt-2 text-[10px] font-bold text-zinc-700 bg-zinc-100 px-2 py-1 rounded border border-zinc-200 inline-block">
                            NASM Certified Personal Trainer
                        </div>

                        <p class="text-xs text-zinc-600 mt-2.5 leading-relaxed">
                            Pakar fat loss terarah dengan kombinasi kardio fungsional dan pola nutrisi berkelanjutan.
                        </p>
                    </div>

                    <div class="pt-3 border-t border-zinc-100">
                        <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20tertarik%20untuk%20konsultasi%20dengan%20Coach%20Kevin."
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-md text-xs font-bold uppercase tracking-wider bg-zinc-100 hover:bg-red-600 text-zinc-800 hover:text-white border border-zinc-200 hover:border-red-600 transition-colors">
                            <span>KONSULTASI COACH</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Trainer 3 -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-2 shadow-sm hover:shadow-xl">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-dimas.jpg') }}"
                         alt="Coach Dimas Wicaksono"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                    <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-wider bg-red-600 text-white px-2.5 py-0.5 rounded shadow">
                        Strength Coach
                    </span>
                    <span class="absolute top-3 right-3 text-[10px] font-semibold text-white bg-black/80 backdrop-blur-sm px-2.5 py-0.5 rounded border border-white/20">
                        6+ Th Exp
                    </span>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                            Coach Dimas Wicaksono
                        </h3>
                        <p class="text-xs text-red-600 font-semibold mt-0.5">Strength & Powerlifting</p>
                        
                        <div class="mt-2 text-[10px] font-bold text-zinc-700 bg-zinc-100 px-2 py-1 rounded border border-zinc-200 inline-block">
                            National Powerlifting Champion 2023
                        </div>

                        <p class="text-xs text-zinc-600 mt-2.5 leading-relaxed">
                            Membimbing teknik Squat, Bench Press, dan Deadlift dari level pemula hingga kompetisi.
                        </p>
                    </div>

                    <div class="pt-3 border-t border-zinc-100">
                        <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20tertarik%20untuk%20konsultasi%20dengan%20Coach%20Dimas."
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-md text-xs font-bold uppercase tracking-wider bg-zinc-100 hover:bg-red-600 text-zinc-800 hover:text-white border border-zinc-200 hover:border-red-600 transition-colors">
                            <span>KONSULTASI COACH</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Trainer 4 -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-2 shadow-sm hover:shadow-xl">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-sarah.jpg') }}"
                         alt="Coach Sarah Melinda"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    
                    <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-wider bg-red-600 text-white px-2.5 py-0.5 rounded shadow">
                        Female Coach
                    </span>
                    <span class="absolute top-3 right-3 text-[10px] font-semibold text-white bg-black/80 backdrop-blur-sm px-2.5 py-0.5 rounded border border-white/20">
                        4+ Th Exp
                    </span>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between space-y-4">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 group-hover:text-red-600 transition-colors">
                            Coach Sarah Melinda
                        </h3>
                        <p class="text-xs text-red-600 font-semibold mt-0.5">Female Fitness & Core Toning</p>
                        
                        <div class="mt-2 text-[10px] font-bold text-zinc-700 bg-zinc-100 px-2 py-1 rounded border border-zinc-200 inline-block">
                            Female Functional & Pilates Spec
                        </div>

                        <p class="text-xs text-zinc-600 mt-2.5 leading-relaxed">
                            Bimbingan khusus wanita untuk mengencangkan glutes, posture alignment, perut kencang, dan kelenturan.
                        </p>
                    </div>

                    <div class="pt-3 border-t border-zinc-100">
                        <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20tertarik%20untuk%20konsultasi%20dengan%20Coach%20Sarah."
                           target="_blank"
                           rel="noopener noreferrer"
                           class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-md text-xs font-bold uppercase tracking-wider bg-zinc-100 hover:bg-red-600 text-zinc-800 hover:text-white border border-zinc-200 hover:border-red-600 transition-colors">
                            <span>KONSULTASI COACH</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>