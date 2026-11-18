<!-- Personal Trainer Section (Dark Theme Matching Footer with Red Accents & Bright Coach Photos) -->
<section id="trainers" class="py-24 bg-zinc-950 border-t border-zinc-900 relative overflow-hidden">
    <!-- Subtle Ambient Red Glow for Depth -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-red-600/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12 relative z-10">
        
        <!-- Header: Centered & Clean Title -->
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <div class="flex items-center justify-center gap-3 mb-1">
                <span class="w-8 h-[2px] bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-500 font-montserrat">COACHING STAFF</span>
                <span class="w-8 h-[2px] bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-white tracking-tight">
                OUR EXPERT <span class="text-red-600">TRAINERS</span>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-400 max-w-2xl mx-auto leading-relaxed">
                Dipandu langsung oleh pelatih berlisensi nasional & internasional untuk memastikan form latihan benar dan hasil yang maksimal.
            </p>
        </div>

        <!-- Trainers Container (Flexbox Centered for 1, 2, 3, or 4+ Trainers) -->
        <div class="flex flex-wrap justify-center gap-6 sm:gap-8">

            <!-- Trainer 1 -->
            <div class="group relative rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-red-500/60 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-2 shadow-xl hover:shadow-2xl hover:shadow-red-600/10 w-full sm:w-80 max-w-sm">
                <!-- Visual Area with Real Coach Photo -->
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-rangga.jpg') }}"
                         alt="Coach Rangga Pratama"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-montserrat text-base font-bold uppercase text-white group-hover:text-red-500 transition-colors">
                        Coach Rangga Pratama, S.Or
                    </h3>
                    <p class="text-xs text-red-500 font-semibold mt-0.5">Hypertrophy & Body Recomposition</p>

                    <p class="text-xs text-zinc-400 mt-2.5 leading-relaxed">
                        Spesialis program pembentukan massa otot kering dan adaptasi biomekanik latihan angkat beban.
                    </p>
                </div>
            </div>

            <!-- Trainer 2 -->
            <div class="group relative rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-red-500/60 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-2 shadow-xl hover:shadow-2xl hover:shadow-red-600/10 w-full sm:w-80 max-w-sm">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-kevin.jpg') }}"
                         alt="Coach Kevin Ardian"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-montserrat text-base font-bold uppercase text-white group-hover:text-red-500 transition-colors">
                        Coach Kevin Ardian, CPT
                    </h3>
                    <p class="text-xs text-red-500 font-semibold mt-0.5">Weight Management & HIIT</p>

                    <p class="text-xs text-zinc-400 mt-2.5 leading-relaxed">
                        Pakar fat loss terarah dengan kombinasi kardio fungsional dan pola nutrisi berkelanjutan.
                    </p>
                </div>
            </div>

            <!-- Trainer 3 -->
            <!-- <div class="group relative rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-red-500/60 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-2 shadow-xl w-full sm:w-80 max-w-sm">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-dimas.jpg') }}"
                         alt="Coach Dimas Wicaksono"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-montserrat text-base font-bold uppercase text-white group-hover:text-red-500 transition-colors">
                        Coach Dimas Wicaksono
                    </h3>
                    <p class="text-xs text-red-500 font-semibold mt-0.5">Strength & Powerlifting</p>

                    <p class="text-xs text-zinc-400 mt-2.5 leading-relaxed">
                        Membimbing teknik Squat, Bench Press, dan Deadlift dari level pemula hingga kompetisi.
                    </p>
                </div>
            </div> -->

            <!-- Trainer 4 -->
            <!-- <div class="group relative rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-red-500/60 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-2 shadow-xl w-full sm:w-80 max-w-sm">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ asset('images/trainers/coach-sarah.jpg') }}"
                         alt="Coach Sarah Melinda"
                         class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-montserrat text-base font-bold uppercase text-white group-hover:text-red-500 transition-colors">
                        Coach Sarah Melinda
                    </h3>
                    <p class="text-xs text-red-500 font-semibold mt-0.5">Female Fitness & Core Toning</p>

                    <p class="text-xs text-zinc-400 mt-2.5 leading-relaxed">
                        Bimbingan khusus wanita untuk mengencangkan glutes, posture alignment, perut kencang, dan kelenturan.
                    </p>
                </div>
            </div> -->

        </div>

    </div>
</section>