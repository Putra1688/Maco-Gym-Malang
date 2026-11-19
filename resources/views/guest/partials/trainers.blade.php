<!-- Personal Trainer & Coaching Programs Section -->
<section id="trainers" class="py-16 sm:py-20 lg:py-24 bg-zinc-950 border-t border-zinc-900 relative overflow-hidden">
    <!-- Subtle Ambient Red Glow for Depth -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-red-600/10 blur-[130px] rounded-full pointer-events-none"></div>

    <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header: Centered & Clean Title with "OUR TRAINERS" Context -->
        <div class="text-center max-w-2xl mx-auto mb-14 sm:mb-16 lg:mb-20 space-y-2.5">
            <div class="flex items-center justify-center gap-2.5 mb-1">
                <span class="w-6 h-[2px] bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-500 font-montserrat">EXPERT TRAINERS & PROGRAMS</span>
                <span class="w-6 h-[2px] bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-2xl sm:text-4xl font-bold uppercase text-white tracking-tight">
                OUR EXPERT <span class="text-red-600">TRAINERS</span>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-400 max-w-xl mx-auto leading-relaxed">
                Bimbingan langsung personal trainer profesional bersertifikasi dengan kurikulum latihan terstruktur untuk memaksimalkan hasil latihanmu.
            </p>
        </div>

        <!-- 2-COLUMN HORIZONTAL SPLIT: MATCHING HEADERS & SEJAJAR -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

            <!-- ================= SISI KIRI: PERSONAL TRAINER (lg:col-span-7) ================= -->
            <div class="lg:col-span-7 flex flex-col">
                <!-- Subheader: Matching Style with Right Side -->
                <div class="pb-3.5 border-b border-zinc-800/80 mb-5">
                    <h3 class="font-montserrat font-black text-2xl sm:text-3xl text-white tracking-tight uppercase leading-none">
                        PERSONAL
                    </h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="font-montserrat font-black text-lg sm:text-xl text-red-500 uppercase tracking-wide">
                            TRAINER:
                        </span>
                        <span class="w-12 h-[2px] bg-red-600 rounded-full"></span>
                    </div>
                </div>

                <!-- Trainer Cards Grid (Slightly nudged down for optical alignment) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 mt-2 sm:mt-2.5">
                    
                    <!-- Trainer 1: Coach Rangga -->
                    <div class="group relative rounded-2xl bg-zinc-900/90 border border-zinc-800 hover:border-red-500/60 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1 shadow-lg hover:shadow-xl hover:shadow-red-600/10">
                        <!-- Coach Photo Area -->
                        <div class="relative h-56 sm:h-60 overflow-hidden bg-zinc-950">
                            <img src="{{ asset('images/trainers/coach-rangga.jpg') }}"
                                 alt="Coach Rangga Pratama"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-transparent to-transparent"></div>
                        </div>

                        <div class="p-4 sm:p-5 flex flex-col flex-1 justify-between bg-zinc-900">
                            <div>
                                <h4 class="font-montserrat text-sm sm:text-base font-bold uppercase text-white group-hover:text-red-500 transition-colors">
                                    Coach Rangga Pratama, S.Or
                                </h4>
                                <p class="text-xs text-red-500 font-semibold mt-0.5">
                                    Hypertrophy & Biomechanics
                                </p>
                                <p class="text-xs text-zinc-400 mt-2 leading-relaxed">
                                    Spesialis pembentukan massa otot terarah, koreksi teknik angkat beban, dan program hypertrophy dari level pemula hingga lanjutan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Trainer 2: Coach Kevin -->
                    <div class="group relative rounded-2xl bg-zinc-900/90 border border-zinc-800 hover:border-red-500/60 overflow-hidden flex flex-col transition-all duration-300 hover:-translate-y-1 shadow-lg hover:shadow-xl hover:shadow-red-600/10">
                        <!-- Coach Photo Area -->
                        <div class="relative h-56 sm:h-60 overflow-hidden bg-zinc-950">
                            <img src="{{ asset('images/trainers/coach-kevin.jpg') }}"
                                 alt="Coach Kevin Ardian"
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900 via-transparent to-transparent"></div>
                        </div>

                        <div class="p-4 sm:p-5 flex flex-col flex-1 justify-between bg-zinc-900">
                            <div>
                                <h4 class="font-montserrat text-sm sm:text-base font-bold uppercase text-white group-hover:text-red-500 transition-colors">
                                    Coach Kevin Ardian, CPT
                                </h4>
                                <p class="text-xs text-red-500 font-semibold mt-0.5">
                                    Weight Loss & Conditioning
                                </p>
                                <p class="text-xs text-zinc-400 mt-2 leading-relaxed">
                                    Pakar penurunan kadar lemak tubuh, kardio terstruktur, bimbingan pola makan harian, dan pembentukan stamina prima.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================= SISI KANAN: PROGRAM UNTUK (lg:col-span-5) ================= -->
            <div class="lg:col-span-5 flex flex-col">
                <!-- Subheader: Right-aligned with Program Card -->
                <div class="pb-3.5 border-b border-zinc-800/80 mb-5 flex flex-col items-end text-right">
                    <h3 class="font-montserrat font-black text-2xl sm:text-3xl text-white tracking-tight uppercase leading-none">
                        PROGRAM
                    </h3>
                    <div class="flex items-center justify-end gap-2 mt-1">
                        <span class="w-12 h-[2px] bg-red-600 rounded-full"></span>
                        <span class="font-montserrat font-black text-lg sm:text-xl text-red-500 uppercase tracking-wide">
                            UNTUK:
                        </span>
                    </div>
                </div>

                <!-- Program Card -->
                <div class="relative rounded-2xl sm:rounded-3xl bg-gradient-to-br from-zinc-900 via-zinc-950 to-black border border-zinc-800 hover:border-red-600/50 p-4 sm:p-5 shadow-xl transition-all duration-300 overflow-hidden group">
                    
                    <!-- Decorative subtle watermark & glow -->
                    <div class="absolute -top-14 -right-14 w-44 h-44 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>

                    <!-- 6 Items with Terracotta/Red Circular Icons -->
                    <div class="space-y-2.5">
                        
                        <!-- Item 1: Pembentukan Massa Otot -->
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-zinc-900/60 hover:bg-zinc-800/80 border border-zinc-800/60 hover:border-red-500/30 transition-all duration-200 group/item">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-600 to-[#9e3a2b] text-white flex items-center justify-center shrink-0 shadow-md shadow-red-900/30 border border-red-400/30 group-hover/item:scale-105 transition-transform">
                                <!-- Dumbbell / Muscle Icon -->
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 5v14M18 5v14M2 9v6M22 9v6M6 12h12M4 7h4M16 7h4M4 17h4M16 17h4"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <span class="font-montserrat font-extrabold text-xs text-zinc-100 group-hover/item:text-white uppercase tracking-wide block leading-snug">
                                    PEMBENTUKAN MASSA OTOT
                                </span>
                                <span class="text-[10px] text-zinc-400">Hypertrophy, progresif beban & volume optimal</span>
                            </div>
                        </div>

                        <!-- Item 2: Menurunkan BB -->
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-zinc-900/60 hover:bg-zinc-800/80 border border-zinc-800/60 hover:border-red-500/30 transition-all duration-200 group/item">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-600 to-[#9e3a2b] text-white flex items-center justify-center shrink-0 shadow-md shadow-red-900/30 border border-red-400/30 group-hover/item:scale-105 transition-transform">
                                <!-- Scale / Timbangan Icon -->
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="4" />
                                    <circle cx="12" cy="10" r="3" />
                                    <path d="M12 10l1.5-1.5" />
                                    <path d="M8 17h8" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <span class="font-montserrat font-extrabold text-xs text-zinc-100 group-hover/item:text-white uppercase tracking-wide block leading-snug">
                                    MENURUNKAN BB
                                </span>
                                <span class="text-[10px] text-zinc-400">Defisit kalori aman & metabolisme tetap terjaga</span>
                            </div>
                        </div>

                        <!-- Item 3: Fat Lost Program -->
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-zinc-900/60 hover:bg-zinc-800/80 border border-zinc-800/60 hover:border-red-500/30 transition-all duration-200 group/item">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-600 to-[#9e3a2b] text-white flex items-center justify-center shrink-0 shadow-md shadow-red-900/30 border border-red-400/30 group-hover/item:scale-105 transition-transform">
                                <!-- Waist Silhouette Icon -->
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 4c3 4 3 12 0 16" />
                                    <path d="M18 4c-3 4-3 12 0 16" />
                                    <path d="M8 12h8" />
                                    <path d="M10 8h4" />
                                    <path d="M10 16h4" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <span class="font-montserrat font-extrabold text-xs text-zinc-100 group-hover/item:text-white uppercase tracking-wide block leading-snug">
                                    FAT LOST PROGRAM
                                </span>
                                <span class="text-[10px] text-zinc-400">Pembakaran lemak terarah pada perut & pinggang</span>
                            </div>
                        </div>

                        <!-- Item 4: Free Konsultasi Seputaran Dunia Gym -->
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-zinc-900/60 hover:bg-zinc-800/80 border border-zinc-800/60 hover:border-red-500/30 transition-all duration-200 group/item">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-600 to-[#9e3a2b] text-white flex items-center justify-center shrink-0 shadow-md shadow-red-900/30 border border-red-400/30 group-hover/item:scale-105 transition-transform">
                                <!-- Chat Bubble Icon -->
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                    <path d="M8 10h.01M12 10h.01M16 10h.01" stroke-width="3" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <span class="font-montserrat font-extrabold text-xs text-zinc-100 group-hover/item:text-white uppercase tracking-wide block leading-snug">
                                    FREE KONSULTASI SEPUTARAN DUNIA GYM
                                </span>
                                <span class="text-[10px] text-zinc-400">Konsultasi penggunaan alat & jadwal latihan rutin</span>
                            </div>
                        </div>

                        <!-- Item 5: Program Pola Makan -->
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-zinc-900/60 hover:bg-zinc-800/80 border border-zinc-800/60 hover:border-red-500/30 transition-all duration-200 group/item">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-600 to-[#9e3a2b] text-white flex items-center justify-center shrink-0 shadow-md shadow-red-900/30 border border-red-400/30 group-hover/item:scale-105 transition-transform">
                                <!-- Fork & Knife Icon -->
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2v6a3 3 0 0 1-3 3 3 3 0 0 1-3-3V2" />
                                    <path d="M15 11v11" />
                                    <path d="M5 2v8a3 3 0 0 0 3 3 3 3 0 0 0 3-3V2" />
                                    <path d="M8 13v9" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <span class="font-montserrat font-extrabold text-xs text-zinc-100 group-hover/item:text-white uppercase tracking-wide block leading-snug">
                                    PROGRAM POLA MAKAN
                                </span>
                                <span class="text-[10px] text-zinc-400">Bimbingan nutrisi, asupan protein harian & diet</span>
                            </div>
                        </div>

                        <!-- Item 6: Program, Latihan dan Teknik Yang Benar -->
                        <div class="flex items-center gap-3 p-2 rounded-xl bg-zinc-900/60 hover:bg-zinc-800/80 border border-zinc-800/60 hover:border-red-500/30 transition-all duration-200 group/item">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-600 to-[#9e3a2b] text-white flex items-center justify-center shrink-0 shadow-md shadow-red-900/30 border border-red-400/30 group-hover/item:scale-105 transition-transform">
                                <!-- Checklist / Clipboard Icon -->
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="18" x="5" y="3" rx="2" />
                                    <path d="M9 3v2a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V3" />
                                    <path d="m9 11 2 2 4-4" />
                                    <path d="m9 16 2 2 4-4" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <span class="font-montserrat font-extrabold text-xs text-zinc-100 group-hover/item:text-white uppercase tracking-wide block leading-snug">
                                    PROGRAM, LATIHAN & TEKNIK BENAR
                                </span>
                                <span class="text-[10px] text-zinc-400">Postur tepat, biomekanik & pencegahan cedera</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- ================= KONSULTASI DI TENGAH DENGAN JARAK PROPER ================= -->
        <div class="mt-12 sm:mt-16 text-center flex flex-col items-center justify-center">
            <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym,%20saya%20ingin%20konsultasi%20mengenai%20Program%20Latihan%20dan%20Personal%20Trainer."
               target="_blank"
               rel="noopener noreferrer"
               class="group inline-flex items-center justify-center gap-2.5 px-8 py-3.5 sm:py-4 rounded-xl bg-red-600 hover:bg-red-700 active:scale-[0.99] text-white font-montserrat font-bold text-xs sm:text-sm uppercase tracking-wider shadow-xl shadow-red-600/25 hover:shadow-red-600/40 transition-all duration-300">
                <span>KONSULTASI PROGRAM & TRAINER VIA WHATSAPP</span>
                <svg class="w-4 h-4 text-white group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
            <p class="text-xs text-zinc-400 mt-3 max-w-md">
                Konsultasi gratis seputar target fisik, pola makan, dan pemilihan personal trainer langsung dengan tim Maco Gym.
            </p>
        </div>

    </div>
</section>
