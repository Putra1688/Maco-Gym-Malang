<!-- ================= MAIN FULL-WIDTH SPLIT-SCREEN BMI SECTION ================= -->
<section id="bmi-page" class="w-full relative overflow-hidden bg-white text-zinc-800" x-data="macoBmiCalculator()">
    
    <!-- Full-width Edge-to-Edge Grid (Left: Muscular Background + Info | Right: Interactive Form / Result) -->
    <div class="w-full grid grid-cols-1 lg:grid-cols-12 min-h-[calc(100vh-106px)] border-b border-zinc-200">
        
        <!-- ================= LEFT HALF: FULL BACKGROUND MUSCULAR ATHLETE & INFO ================= -->
        <div class="lg:col-span-6 relative bg-zinc-950 text-white flex flex-col justify-between overflow-hidden p-6 sm:p-8 lg:p-10 xl:p-12 min-h-[520px]">
            
            <!-- Background Image of Muscular Man Covering 100% of Left Half -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/hero-fitness.jpg') }}" 
                     alt="Atlet Pria Berotot Maco Gym Malang" 
                     class="w-full h-full object-cover object-center filter brightness-90 contrast-105 scale-100">
                <!-- Layered Dark & Red Gradients for Maximum Legibility & Gym Aesthetic -->
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/85 to-zinc-950/65"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-zinc-950/90 via-zinc-950/75 to-transparent"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-red-600/25 rounded-full blur-3xl pointer-events-none"></div>
            </div>

            <!-- Left Content Area (Overlaid on Top of Background) -->
            <div class="relative z-10 flex flex-col h-full justify-between space-y-6 max-w-xl mx-auto lg:max-w-none lg:mx-0 w-full">
                <div>
                    <!-- Eyebrow Badge -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/80 border border-red-500/50 backdrop-blur-md mb-4 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-red-400 font-montserrat">
                            FITNESS & HEALTH TOOL
                        </span>
                    </div>

                    <!-- Heading -->
                    <h1 class="font-montserrat text-3xl sm:text-4xl lg:text-5xl font-black uppercase text-white tracking-tight leading-tight">
                        Tentang <span class="text-red-500 drop-shadow-[0_0_20px_rgba(239,68,68,0.5)]">BMI</span>
                    </h1>

                    <!-- Short Description -->
                    <p class="text-zinc-200 text-sm sm:text-base leading-relaxed mt-4 max-w-xl font-normal">
                        <strong class="text-white font-semibold">Body Mass Index (BMI)</strong> membantu menentukan apakah berat badan kamu ideal sesuai dengan tinggi badan.
                    </p>

                    <p class="text-zinc-300 text-sm sm:text-base leading-relaxed mt-2.5 max-w-xl font-normal">
                        Hasilnya, dapat memberikan gambaran awal tentang kondisi tubuhmu dan menjadi dasar untuk mulai menjaga atau memperbaiki pola hidup.
                    </p>

                    <!-- Toggle Button: Lihat Selengkapnya -->
                    <div class="mt-6">
                        <button type="button" 
                                @click="showDetails = !showDetails" 
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-md text-white font-bold text-xs sm:text-sm tracking-wide transition group cursor-pointer shadow-md">
                            <span x-text="showDetails ? 'Tutup Detail Informasi' : 'Lihat Selengkapnya'"></span>
                            <svg class="w-4 h-4 text-red-400 transform transition-transform duration-300 group-hover:translate-y-0.5" 
                                 :class="showDetails ? 'rotate-180' : ''" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Dropdown Informasi Detail BMI (Accordion Expand) -->
                    <div x-show="showDetails" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-3"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-3"
                         class="mt-6 pt-6 border-t border-zinc-800/90 space-y-4 text-left">
                        
                        <!-- 1. Rumus & Cara Cek BMI -->
                        <div class="bg-zinc-900/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-zinc-700/60 shadow-lg">
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="w-6 h-6 rounded-md bg-red-600 text-white flex items-center justify-center font-bold text-xs">
                                    1
                                </div>
                                <h3 class="font-montserrat font-bold text-sm text-white uppercase tracking-wide">
                                    Bagaimana Rumus & Cara Cek BMI?
                                </h3>
                            </div>
                            <p class="text-xs text-zinc-300 leading-relaxed mb-2">
                                Perhitungan Body Mass Index menggunakan standar resmi World Health Organization (WHO):
                            </p>
                            <div class="p-2.5 bg-black/60 border border-zinc-800 rounded-lg text-center font-mono text-xs sm:text-sm font-bold text-red-400">
                                BMI = Berat Badan (kg) ÷ [Tinggi Badan (m)]²
                            </div>
                            <p class="text-[11px] text-zinc-400 mt-2 leading-relaxed">
                                <strong>Contoh:</strong> Tinggi 170 cm (1.70 m), Berat 65 kg &rarr; 65 ÷ (1.70 × 1.70) = 65 ÷ 2.89 = <strong>22.5</strong> (Kategori Ideal / Normal).
                            </p>
                        </div>

                        <!-- 2. Panduan Hasil Perhitungan -->
                        <div class="bg-zinc-900/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-zinc-700/60 shadow-lg">
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="w-6 h-6 rounded-md bg-red-600 text-white flex items-center justify-center font-bold text-xs">
                                    2
                                </div>
                                <h3 class="font-montserrat font-bold text-sm text-white uppercase tracking-wide">
                                    Panduan Hasil Perhitungan
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-[11px] mt-2">
                                <div class="p-2.5 rounded-lg bg-sky-950/60 border border-sky-800/60">
                                    <div class="font-bold text-sky-400">&lt; 18.5 • Kurang (Underweight)</div>
                                    <div class="text-zinc-300 mt-0.5">Surplus kalori bersih & latihan hipertrofi beban.</div>
                                </div>
                                <div class="p-2.5 rounded-lg bg-emerald-950/60 border border-emerald-800/60">
                                    <div class="font-bold text-emerald-400">18.5 - 24.9 • Ideal (Normal)</div>
                                    <div class="text-zinc-300 mt-0.5">Pertahankan komposisi tubuh & gizi optimal.</div>
                                </div>
                                <div class="p-2.5 rounded-lg bg-amber-950/60 border border-amber-800/60">
                                    <div class="font-bold text-amber-400">25.0 - 29.9 • Berlebih (Overweight)</div>
                                    <div class="text-zinc-300 mt-0.5">Defisit kalori bertahap & kombinasi beban + kardio.</div>
                                </div>
                                <div class="p-2.5 rounded-lg bg-rose-950/60 border border-rose-800/60">
                                    <div class="font-bold text-rose-400">&ge; 30.0 • Obesitas (Obese)</div>
                                    <div class="text-zinc-300 mt-0.5">Program fat loss terstruktur bersama Personal Trainer.</div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Pengaruh Mengetahuinya -->
                        <div class="bg-zinc-900/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-zinc-700/60 shadow-lg">
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="w-6 h-6 rounded-md bg-red-600 text-white flex items-center justify-center font-bold text-xs">
                                    3
                                </div>
                                <h3 class="font-montserrat font-bold text-sm text-white uppercase tracking-wide">
                                    Apa Pengaruh Mengetahui Skor BMI Anda?
                                </h3>
                            </div>
                            <ul class="space-y-1.5 text-xs text-zinc-300">
                                <li class="flex items-start gap-1.5">
                                    <span class="text-red-500 font-bold">•</span>
                                    <span><strong>Pencegahan Penyakit Kronis:</strong> Memantau potensi risiko diabetes tipe 2, hipertensi, dan nyeri sendi lutut.</span>
                                </li>
                                <li class="flex items-start gap-1.5">
                                    <span class="text-red-500 font-bold">•</span>
                                    <span><strong>Panduan Target Latihan Gym:</strong> Menentukan apakah perlu fase <em>Cutting</em> (fat loss), <em>Bulking</em> (massa otot), atau <em>Recomposition</em>.</span>
                                </li>
                                <li class="flex items-start gap-1.5">
                                    <span class="text-red-500 font-bold">•</span>
                                    <span><strong>Tolok Ukur Evaluasi Progres:</strong> Dasar pengukuran berkala setiap 4 minggu saat berlatih di Maco Gym.</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Footer Note on Left Div -->
                <div class="pt-4 border-t border-white/10 flex items-center justify-between text-[11px] text-zinc-400">
                    <span>Maco Gym Malang • Fitness Club</span>
                    <span class="text-red-400 font-semibold">Pandanwangi & Lowokwaru</span>
                </div>
            </div>

        </div>

        <!-- ================= RIGHT HALF: FORM & RESULT (SWITCH TOGGLE) ================= -->
        <div class="lg:col-span-6 bg-white flex flex-col justify-start pt-5 sm:pt-7 lg:pt-8 pb-8 px-6 sm:px-10 lg:px-14 xl:px-16 relative">
            <div class="max-w-xl mx-auto w-full">
                
                <!-- ================= STATE 1: FORM PENGISIAN BMI (Tampil sebelum tombol cek ditekan) ================= -->
                <div x-show="!hasCalculated" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-98"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="space-y-4 sm:space-y-4.5">
                    
                    <!-- Form Header -->
                    <div class="border-b border-zinc-100 pb-3 sm:pb-3.5">
                        <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-zinc-100 text-zinc-700 text-[10px] font-bold uppercase tracking-wider mb-1.5">
                            <span>FORMULIR KALKULATOR</span>
                        </div>
                        <h2 class="font-montserrat font-black text-2xl sm:text-[28px] text-zinc-900 tracking-tight uppercase leading-snug">
                            Kalkulator <span class="text-red-600">BMI</span>
                        </h2>
                        <p class="text-zinc-500 text-xs mt-1 leading-relaxed font-sans">
                            Ingin tahu apakah berat badan kamu sudah ideal? Yuk, isi form di bawah dan hitung BMI kamu sekarang!
                        </p>
                    </div>

                    <!-- 1. Input Gender -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-2">
                            * Pilih Gender
                        </label>
                        <div class="grid grid-cols-2 gap-3.5">
                            
                            <!-- Laki-laki -->
                            <button type="button" 
                                    @click="gender = 'male'"
                                    :class="gender === 'male' 
                                        ? 'border-red-600 bg-red-50/60 ring-2 ring-red-600/20 shadow-sm' 
                                        : 'border-zinc-200 bg-zinc-50/60 hover:border-zinc-300 hover:bg-zinc-100/50'"
                                    class="flex flex-col items-center justify-center p-3 rounded-2xl border-2 transition-all relative cursor-pointer text-center group">
                                <div class="absolute top-2 right-2 w-3.5 h-3.5 rounded-full border flex items-center justify-center transition"
                                     :class="gender === 'male' ? 'border-red-600 bg-red-600' : 'border-zinc-300 bg-white'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white" x-show="gender === 'male'"></div>
                                </div>

                                <div class="w-11 h-11 mb-1 flex items-center justify-center">
                                    <svg class="w-10 h-10" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="32" cy="32" r="30" fill="#FEE2E2"/>
                                        <path d="M22 25C22 17 26 12 32 12C38 12 42 17 42 25C42 26 40 28 40 28H24C24 28 22 26 22 25Z" fill="#1F2937"/>
                                        <circle cx="32" cy="30" r="12" fill="#FBCFE8"/>
                                        <circle cx="28" cy="28" r="1.5" fill="#111827"/>
                                        <circle cx="36" cy="28" r="1.5" fill="#111827"/>
                                        <path d="M29 34C30.5 35.5 33.5 35.5 35 34" stroke="#DC2626" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M18 54C18 44 24 41 32 41C40 41 46 44 46 54" fill="#DC2626"/>
                                        <path d="M28 41L32 45L36 41" stroke="#FEE2E2" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-zinc-900 group-hover:text-red-600 transition">
                                    Laki-laki
                                </span>
                            </button>

                            <!-- Perempuan -->
                            <button type="button" 
                                    @click="gender = 'female'"
                                    :class="gender === 'female' 
                                        ? 'border-red-600 bg-red-50/60 ring-2 ring-red-600/20 shadow-sm' 
                                        : 'border-zinc-200 bg-zinc-50/60 hover:border-zinc-300 hover:bg-zinc-100/50'"
                                    class="flex flex-col items-center justify-center p-3 rounded-2xl border-2 transition-all relative cursor-pointer text-center group">
                                <div class="absolute top-2 right-2 w-3.5 h-3.5 rounded-full border flex items-center justify-center transition"
                                     :class="gender === 'female' ? 'border-red-600 bg-red-600' : 'border-zinc-300 bg-white'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white" x-show="gender === 'female'"></div>
                                </div>

                                <div class="w-11 h-11 mb-1 flex items-center justify-center">
                                    <svg class="w-10 h-10" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="32" cy="32" r="30" fill="#FEE2E2"/>
                                        <path d="M19 32C19 21 24 13 32 13C40 13 45 21 45 32C45 42 41 45 41 45H23C23 45 19 42 19 32Z" fill="#374151"/>
                                        <circle cx="32" cy="30" r="11" fill="#FDE68A"/>
                                        <path d="M22 25C24 17 28 15 32 15C36 15 40 17 42 25C39 21 35 20 32 20C29 20 25 21 22 25Z" fill="#1F2937"/>
                                        <circle cx="28" cy="29" r="1.5" fill="#111827"/>
                                        <circle cx="36" cy="29" r="1.5" fill="#111827"/>
                                        <path d="M30 35C31 36 33 36 34 35" stroke="#DC2626" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M20 54C20 44 25 42 32 42C39 42 44 44 44 54" fill="#E11D48"/>
                                        <path d="M29 39H35V43H29V39Z" fill="#FDE68A"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-zinc-900 group-hover:text-red-600 transition">
                                    Perempuan
                                </span>
                            </button>

                        </div>
                    </div>

                    <!-- 2. Input Tinggi Badan -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="bmiHeightInput" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                * Tinggi Badan
                            </label>
                            <span class="text-[10px] text-zinc-400">Satuan centimeter</span>
                        </div>
                        <div class="relative flex items-center">
                            <input id="bmiHeightInput"
                                   type="number"
                                   min="80"
                                   max="240"
                                   x-model.number="height"
                                   placeholder="Contoh: 170"
                                   class="w-full px-3.5 py-2.5 sm:py-3 bg-zinc-50 border border-zinc-300 rounded-xl text-zinc-900 text-sm font-semibold focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition pr-12">
                            <span class="absolute right-4 text-xs font-bold text-zinc-400 select-none">
                                cm
                            </span>
                        </div>
                    </div>

                    <!-- 3. Input Berat Badan -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="bmiWeightInput" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                * Berat Badan
                            </label>
                            <span class="text-[10px] text-zinc-400">Satuan kilogram</span>
                        </div>
                        <div class="relative flex items-center">
                            <input id="bmiWeightInput"
                                   type="number"
                                   min="20"
                                   max="250"
                                   step="0.5"
                                   x-model.number="weight"
                                   placeholder="Contoh: 65"
                                   class="w-full px-3.5 py-2.5 sm:py-3 bg-zinc-50 border border-zinc-300 rounded-xl text-zinc-900 text-sm font-semibold focus:outline-none focus:border-red-600 focus:bg-white focus:ring-2 focus:ring-red-600/20 transition pr-12">
                            <span class="absolute right-4 text-xs font-bold text-zinc-400 select-none">
                                kg
                            </span>
                        </div>
                    </div>

                    <!-- Validation warning if empty -->
                    <div x-show="errorMessage" class="p-2.5 rounded-xl bg-red-50 border border-red-200 text-red-600 text-xs font-semibold">
                        <span x-text="errorMessage"></span>
                    </div>

                    <!-- 4. Tombol Cek BMI -->
                    <div class="pt-1">
                        <button type="button" 
                                @click="calculateBMI()" 
                                class="w-full py-3.5 px-6 rounded-xl bg-red-600 hover:bg-red-700 active:scale-[0.99] text-white font-montserrat font-bold text-sm uppercase tracking-wider shadow-lg shadow-red-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer">
                            <span>Hitung BMI</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>

                    <p class="text-[10px] sm:text-[11px] text-zinc-400 text-center">
                        Hasil kalkulasi akan langsung menampilkan skor, klasifikasi WHO, rentang berat ideal, dan rekomendasi latihan.
                    </p>

                </div>

                <!-- ================= STATE 2: HASIL PERHITUNGAN BMI (Form hilang, hasil muncul) ================= -->
                <div x-show="hasCalculated" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-98"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="space-y-4 sm:space-y-4.5">
                    
                    <!-- Result Header -->
                    <div class="border-b border-zinc-100 pb-3 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 font-montserrat block">
                                HASIL ANALISIS
                            </span>
                            <h2 class="font-montserrat font-black text-2xl sm:text-[26px] text-zinc-900 tracking-tight uppercase leading-snug">
                                Skor <span class="text-red-600">BMI Kamu</span>
                            </h2>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 rounded-full bg-zinc-100 text-zinc-700 text-xs font-bold">
                                <span x-text="gender === 'male' ? '👨 Pria' : '👩 Wanita'"></span> • 
                                <span x-text="height + ' cm'"></span> / <span x-text="weight + ' kg'"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Big Score & Category Badge -->
                    <div class="p-4 sm:p-5 rounded-2xl bg-zinc-50 border border-zinc-200/90 text-center space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">
                            Indeks Massa Tubuh (BMI)
                        </span>
                        
                        <div class="text-5xl sm:text-6xl font-black font-montserrat tracking-tight" 
                             :class="categoryInfo.textColor" 
                             x-text="bmi">
                        </div>

                        <div>
                            <span class="inline-flex px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wide shadow-xs" 
                                  :class="categoryInfo.badgeClass" 
                                  x-text="categoryInfo.label">
                            </span>
                        </div>

                        <p class="text-xs text-zinc-600 leading-relaxed max-w-md mx-auto pt-1" 
                           x-text="categoryInfo.description">
                        </p>
                    </div>

                    <!-- Segmented Multi-Color Progress Gauge Bar -->
                    <div class="pt-1">
                        <div class="relative pt-6">
                            <div class="absolute top-0 transition-all duration-300 -translate-x-1/2 flex flex-col items-center pointer-events-none"
                                 :style="`left: ${pointerPosition}%`">
                                <span class="text-[10px] font-black px-1.5 py-0.5 rounded shadow text-white whitespace-nowrap" 
                                      :class="categoryInfo.bgBadge" 
                                      x-text="bmi"></span>
                                <div class="w-0 h-0 border-l-[4px] border-l-transparent border-r-[4px] border-r-transparent border-t-[5px]"
                                     :class="categoryInfo.arrowColor"></div>
                            </div>

                            <div class="h-3 w-full rounded-full overflow-hidden flex gap-0.5 bg-zinc-100 p-0.5 border border-zinc-200">
                                <div class="w-[28%] bg-sky-400 rounded-l-full" title="Kurus (< 18.5)"></div>
                                <div class="w-[32%] bg-emerald-500" title="Ideal (18.5 - 24.9)"></div>
                                <div class="w-[20%] bg-amber-400" title="Berlebih (25.0 - 29.9)"></div>
                                <div class="w-[20%] bg-rose-500 rounded-r-full" title="Obesitas (>= 30)"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-4 text-center text-[10px] font-bold text-zinc-400 mt-1.5">
                            <span>Kurus<br>&lt;18.5</span>
                            <span class="text-emerald-600 font-extrabold">Ideal<br>18.5-24.9</span>
                            <span>Berlebih<br>25-29.9</span>
                            <span>Obesitas<br>&ge;30</span>
                        </div>
                    </div>

                    <!-- Ideal Weight Range Box -->
                    <div class="p-3 sm:p-3.5 rounded-xl bg-zinc-50 border border-zinc-200 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-500 block">
                                Berat Badan Ideal Kamu:
                            </span>
                            <span class="text-xs text-zinc-400">
                                Berdasarkan tinggi <strong class="text-zinc-700" x-text="height + ' cm'"></strong>
                            </span>
                        </div>
                        <div class="text-lg sm:text-xl font-black text-zinc-900 font-montserrat" 
                             x-text="`${idealWeight.min} kg – ${idealWeight.max} kg`">
                        </div>
                    </div>

                    <!-- ACTION BUTTONS: HITUNG ULANG & KONSULTASI -->
                    <div class="space-y-2.5 pt-1">
                        <button type="button" 
                                @click="hasCalculated = false" 
                                class="w-full py-3 px-6 rounded-xl border-2 border-zinc-300 hover:border-red-600 hover:text-red-600 text-zinc-700 font-montserrat font-bold text-xs uppercase tracking-wider transition-all flex items-center justify-center gap-2 cursor-pointer bg-white">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>Hitung Ulang / Cek Lagi</span>
                        </button>

                        <a href="{{ route('home') }}#pricing" 
                           class="w-full py-3.5 px-6 rounded-xl bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider text-center shadow-lg shadow-red-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 block">
                            <span>Mulai Latihan di Maco Gym Malang &rarr;</span>
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>

<!-- ================= PROMOTIONAL BADGES SECTION (MACO GYM STYLE) ================= -->
<section class="py-12 sm:py-16 lg:py-20 bg-zinc-50 border-b border-zinc-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 items-stretch">
            
            <!-- Promo Badge 1: Membership Mulai dari Rp135 ribu/bulan (Maco Gym Dark & Red Style) -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[16/9] min-h-[300px] flex flex-col justify-end p-6 sm:p-8 text-white group border-2 border-zinc-900 hover:border-red-600 transition-all duration-500 bg-zinc-950">
                <!-- Background Gym Photo -->
                <img src="{{ asset('images/about-gym.jpg') }}" 
                     alt="Maco Gym Membership Promo" 
                     class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 brightness-75 contrast-105">
                <!-- Dark Gradient Overlay with Red Ambient Glow -->
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/75 to-zinc-950/30"></div>
                <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-red-600/30 rounded-full blur-2xl pointer-events-none"></div>
                
                <!-- Promo Content -->
                <div class="relative z-10 text-center flex flex-col items-center">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600 text-white text-[10px] font-bold uppercase tracking-widest font-montserrat mb-3 shadow-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                        <span>PAKET HEMAT MACO GYM</span>
                    </div>

                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-zinc-300 mb-1 font-sans">
                        Membership mulai dari
                    </span>
                    <div class="font-montserrat font-black text-3xl sm:text-4xl text-white mb-5 tracking-tight drop-shadow-md">
                        Rp 135 ribu<span class="text-sm sm:text-base font-bold text-red-500"> /bulan</span>
                    </div>
                    
                    <a href="{{ route('home') }}#pricing" 
                       class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/40 hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                        <span>Lihat Paket Membership</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Promo Badge 2: Ingin tahu lebih banyak tentang Maco Gym? (Maco Gym Clean White & Red Style) -->
            <div class="rounded-3xl bg-white border-2 border-zinc-200 hover:border-red-600 shadow-2xl min-h-[300px] flex flex-col items-center justify-center p-6 sm:p-8 text-center relative overflow-hidden group transition-all duration-500">
                <!-- Ambient Glow Accents -->
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-red-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-zinc-900/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col items-center">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-zinc-700 text-[10px] font-bold uppercase tracking-widest font-montserrat mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                        <span>CUSTOMER SUPPORT</span>
                    </div>

                    <!-- Headset / Support Icon -->
                    <div class="w-14 h-14 rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-center justify-center mb-3 shadow-sm group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        </svg>
                    </div>
                    
                    <!-- Title & Description -->
                    <h3 class="text-xl sm:text-2xl font-black text-zinc-900 font-montserrat uppercase tracking-tight mb-2 max-w-sm leading-snug">
                        Ingin Tahu Lebih Banyak Tentang <span class="text-red-600">Maco Gym</span>?
                    </h3>
                    <p class="text-xs sm:text-sm text-zinc-500 mb-6 max-w-sm leading-relaxed font-normal">
                        Tim resepsionis & coach kami siap bantu jawab semua pertanyaan kamu seputar fasilitas, program latihan, & membership.
                    </p>
                    
                    <!-- WhatsApp CTA Button (Maco Gym Dark & Red Style with WhatsApp Icon) -->
                    <a href="https://wa.me/6281250207403?text=Halo%20Maco%20Gym%20Malang,%20saya%20ingin%20tanya%20seputar%20membership%20dan%20fasilitas%20gym." 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-xl bg-zinc-950 hover:bg-red-600 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-zinc-950/20 hover:shadow-red-600/30 transition-all duration-200">
                        <!-- WhatsApp Icon -->
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

<!-- Alpine.js Calculator Logic Script -->
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('macoBmiCalculator', () => ({
        gender: 'male',
        height: 170,
        weight: 65,
        hasCalculated: false, // Default false: form aktif, hasil belum keluar
        showDetails: false,   // Accordion dropdown di div kiri
        errorMessage: '',

        calculateBMI() {
            this.errorMessage = '';
            if (!this.height || this.height < 50 || this.height > 250) {
                this.errorMessage = 'Mohon masukkan tinggi badan yang valid (50 - 250 cm).';
                return;
            }
            if (!this.weight || this.weight < 20 || this.weight > 300) {
                this.errorMessage = 'Mohon masukkan berat badan yang valid (20 - 300 kg).';
                return;
            }

            // Form hilang, hasil keluar
            this.hasCalculated = true;
        },

        // Rumus: Berat Badan (kg) / (Tinggi Badan (m))^2
        get bmi() {
            if (!this.height || !this.weight || this.height <= 0) return 0;
            const h = this.height / 100;
            return parseFloat((this.weight / (h * h)).toFixed(1));
        },

        // Klasifikasi WHO
        get categoryInfo() {
            const val = this.bmi;
            if (val < 18.5) {
                return {
                    label: 'Kurus (Underweight)',
                    badgeClass: 'bg-sky-100 text-sky-800 border border-sky-300',
                    textColor: 'text-sky-600',
                    bgBadge: 'bg-sky-500',
                    arrowColor: 'border-t-sky-500',
                    description: 'Berat badan Anda berada di bawah rata-rata ideal. Sangat disarankan program surplus kalori padat nutrisi dan latihan beban hipertrofi bersama Coach Maco Gym untuk menaikkan massa otot.'
                };
            } else if (val <= 24.9) {
                return {
                    label: 'Ideal (Normal)',
                    badgeClass: 'bg-emerald-100 text-emerald-800 border border-emerald-300',
                    textColor: 'text-emerald-600',
                    bgBadge: 'bg-emerald-500',
                    arrowColor: 'border-t-emerald-500',
                    description: 'Luar biasa! Komposisi berat badan Anda berada pada rentang ideal yang sehat. Pertahankan konsistensi latihan gym, stamina fisik, dan pola makan bergizi seimbang.'
                };
            } else if (val <= 29.9) {
                return {
                    label: 'Berlebih (Overweight)',
                    badgeClass: 'bg-amber-100 text-amber-800 border border-amber-300',
                    textColor: 'text-amber-600',
                    bgBadge: 'bg-amber-500',
                    arrowColor: 'border-t-amber-500',
                    description: 'Berat badan Anda berada di atas ambang batas normal. Mulai atur defisit kalori harian dan perbanyak kombinasi latihan beban + kardio di Maco Gym untuk membakar timbunan lemak.'
                };
            } else {
                return {
                    label: 'Obesitas (Obese)',
                    badgeClass: 'bg-rose-100 text-rose-800 border border-rose-300',
                    textColor: 'text-rose-600',
                    bgBadge: 'bg-rose-500',
                    arrowColor: 'border-t-rose-500',
                    description: 'Kategori ini memiliki risiko lebih tinggi terhadap gangguan metabolik dan persendian. Disarankan berkonsultasi dengan Personal Trainer Maco Gym untuk pendampingan fat-loss bertahap dan aman bagi sendi.'
                };
            }
        },

        // Rentang berat badan ideal: (18.5 * h^2) s/d (24.9 * h^2)
        get idealWeight() {
            if (!this.height || this.height <= 0) return { min: 0, max: 0 };
            const h = this.height / 100;
            return {
                min: (18.5 * h * h).toFixed(1),
                max: (24.9 * h * h).toFixed(1)
            };
        },

        // Posisi jarum pada skala gauge 12 - 38
        get pointerPosition() {
            const minScale = 12;
            const maxScale = 38;
            const clamped = Math.min(Math.max(this.bmi, minScale), maxScale);
            return ((clamped - minScale) / (maxScale - minScale) * 100).toFixed(1);
        }
    }));
});
</script>
