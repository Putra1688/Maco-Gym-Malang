<!-- ================= MAIN FULL-WIDTH SPLIT-SCREEN BMI SECTION ================= -->
<section id="bmi-page" class="w-full relative overflow-hidden bg-white text-zinc-800" x-data="macoBmiCalculator()">
    
    <!-- Full-width Edge-to-Edge Grid (Left: Muscular Background + Info | Right: Interactive Form / Result) -->
    <!-- Responsive layout: Form is order-1 on mobile/tablet so users can calculate immediately, side-by-side on lg+ -->
    <div class="w-full grid grid-cols-1 lg:grid-cols-12 min-h-[calc(100vh-64px)] sm:min-h-[calc(100vh-80px)] lg:min-h-[calc(100vh-106px)] border-b border-zinc-200">
        
        <!-- ================= RIGHT HALF: FORM & RESULT (SWITCH TOGGLE) ================= -->
        <!-- Placed first in DOM order for mobile, order-2 on lg screens -->
        <div class="order-1 lg:order-2 lg:col-span-6 bg-white flex flex-col justify-center py-6 sm:py-8 lg:py-10 px-4 xs:px-6 sm:px-8 lg:px-10 xl:px-14 relative border-b lg:border-b-0 border-zinc-200">
            <div class="max-w-xl mx-auto w-full">
                
                <!-- ================= STATE 1: FORM PENGISIAN BMI ================= -->
                <div x-show="!hasCalculated" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-98"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="space-y-4 sm:space-y-5">
                    
                    <!-- Form Header -->
                    <div class="border-b border-zinc-100 pb-3 sm:pb-3.5">
                        <!-- <div class="inline-flex items-center px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full bg-red-50 text-red-600 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider mb-2">
                            <span>FORMULIR KALKULATOR</span>
                        </div> -->
                        <h2 class="font-montserrat font-black text-xl xs:text-2xl sm:text-[28px] text-zinc-900 tracking-tight uppercase leading-snug">
                            Kalkulator <span class="text-red-600">BMI</span>
                        </h2>
                        <p class="text-zinc-500 text-xs sm:text-sm mt-1 leading-relaxed font-sans">
                            Ingin tahu apakah berat badan kamu sudah ideal? Yuk, pilih gender dan isi data fisikmu di bawah!
                        </p>
                    </div>

                    <!-- 1. Input Gender dengan Avatar Pria & Wanita -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 mb-2 sm:mb-2.5">
                            * Pilih Gender
                        </label>
                        <div class="grid grid-cols-2 gap-3 sm:gap-4">
                            
                            <!-- Laki-laki Button -->
                            <button type="button" 
                                    @click="gender = 'male'"
                                    :class="gender === 'male' 
                                        ? 'border-red-600 bg-red-50/70 ring-2 ring-red-600/25 shadow-md -translate-y-0.5' 
                                        : 'border-zinc-200 bg-zinc-50/70 hover:border-zinc-300 hover:bg-zinc-100/60'"
                                    class="flex flex-col items-center justify-center p-3 xs:p-3.5 sm:p-4 rounded-2xl border-2 transition-all relative cursor-pointer text-center group">
                                
                                <!-- Active Radio Dot Indicator -->
                                <div class="absolute top-2.5 right-2.5 w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border flex items-center justify-center transition"
                                     :class="gender === 'male' ? 'border-red-600 bg-red-600' : 'border-zinc-300 bg-white'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white" x-show="gender === 'male'"></div>
                                </div>

                                <!-- Avatar Pria (WebP) -->
                                <div class="w-14 h-14 xs:w-16 xs:h-16 sm:w-20 sm:h-20 mb-1.5 sm:mb-2 flex items-center justify-center">
                                    <img src="{{ asset('images/bmi/pria.webp') }}" 
                                         alt="Avatar Laki-laki" 
                                         class="w-full h-full object-contain filter drop-shadow-sm group-hover:scale-105 transition-transform duration-200">
                                </div>

                                <span class="text-xs sm:text-sm font-bold text-zinc-900 group-hover:text-red-600 transition">
                                    Laki-laki
                                </span>
                            </button>

                            <!-- Perempuan Button -->
                            <button type="button" 
                                    @click="gender = 'female'"
                                    :class="gender === 'female' 
                                        ? 'border-red-600 bg-red-50/70 ring-2 ring-red-600/25 shadow-md -translate-y-0.5' 
                                        : 'border-zinc-200 bg-zinc-50/70 hover:border-zinc-300 hover:bg-zinc-100/60'"
                                    class="flex flex-col items-center justify-center p-3 xs:p-3.5 sm:p-4 rounded-2xl border-2 transition-all relative cursor-pointer text-center group">
                                
                                <!-- Active Radio Dot Indicator -->
                                <div class="absolute top-2.5 right-2.5 w-3.5 h-3.5 sm:w-4 sm:h-4 rounded-full border flex items-center justify-center transition"
                                     :class="gender === 'female' ? 'border-red-600 bg-red-600' : 'border-zinc-300 bg-white'">
                                    <div class="w-1.5 h-1.5 rounded-full bg-white" x-show="gender === 'female'"></div>
                                </div>

                                <!-- Avatar Wanita (WebP) -->
                                <div class="w-14 h-14 xs:w-16 xs:h-16 sm:w-20 sm:h-20 mb-1.5 sm:mb-2 flex items-center justify-center">
                                    <img src="{{ asset('images/bmi/wanita.webp') }}" 
                                         alt="Avatar Perempuan" 
                                         class="w-full h-full object-contain filter drop-shadow-sm group-hover:scale-105 transition-transform duration-200">
                                </div>

                                <span class="text-xs sm:text-sm font-bold text-zinc-900 group-hover:text-red-600 transition">
                                    Perempuan
                                </span>
                            </button>

                        </div>
                    </div>

                    <!-- 2. Input Tinggi Badan (Slider + Kolom Input) -->
                    <div class="bg-zinc-50/80 rounded-2xl p-3.5 xs:p-4 sm:p-4.5 border border-zinc-200/90">
                        <div class="flex items-center justify-between mb-2">
                            <label for="bmiHeightInput" class="text-xs font-bold uppercase tracking-wider text-zinc-700 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7l4-4m0 0l4 4m-4-4v18m-4-4l4 4m0 0l4-4"/>
                                </svg>
                                <span>Tinggi Badan</span>
                            </label>
                            
                            <!-- Kolom Angka -->
                            <div class="relative flex items-center">
                                <input id="bmiHeightInput"
                                       type="number"
                                       min="80"
                                       max="240"
                                       x-model.number="height"
                                       class="w-20 text-right pr-8 py-1 sm:py-1.5 bg-white border border-zinc-300 rounded-lg text-zinc-900 text-xs sm:text-sm font-black focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20">
                                <span class="absolute right-2.5 text-[11px] sm:text-xs font-bold text-zinc-400 select-none">cm</span>
                            </div>
                        </div>

                        <!-- Range Slider Sync -->
                        <div class="pt-2 pb-1">
                            <input type="range" 
                                   min="100" 
                                   max="220" 
                                   step="1"
                                   x-model.number="height"
                                   class="w-full h-2 bg-zinc-200 rounded-lg appearance-none cursor-pointer accent-red-600 touch-pan-x">
                        </div>
                        <div class="flex justify-between text-[10px] font-semibold text-zinc-400">
                            <span>100 cm</span>
                            <span>160 cm</span>
                            <span>220 cm</span>
                        </div>
                    </div>

                    <!-- 3. Input Berat Badan (Slider + Kolom Input) -->
                    <div class="bg-zinc-50/80 rounded-2xl p-3.5 xs:p-4 sm:p-4.5 border border-zinc-200/90">
                        <div class="flex items-center justify-between mb-2">
                            <label for="bmiWeightInput" class="text-xs font-bold uppercase tracking-wider text-zinc-700 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                                <span>Berat Badan</span>
                            </label>
                            
                            <!-- Kolom Angka -->
                            <div class="relative flex items-center">
                                <input id="bmiWeightInput"
                                       type="number"
                                       min="20"
                                       max="250"
                                       step="0.5"
                                       x-model.number="weight"
                                       class="w-20 text-right pr-8 py-1 sm:py-1.5 bg-white border border-zinc-300 rounded-lg text-zinc-900 text-xs sm:text-sm font-black focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20">
                                <span class="absolute right-2.5 text-[11px] sm:text-xs font-bold text-zinc-400 select-none">kg</span>
                            </div>
                        </div>

                        <!-- Range Slider Sync -->
                        <div class="pt-2 pb-1">
                            <input type="range" 
                                   min="30" 
                                   max="180" 
                                   step="0.5"
                                   x-model.number="weight"
                                   class="w-full h-2 bg-zinc-200 rounded-lg appearance-none cursor-pointer accent-red-600 touch-pan-x">
                        </div>
                        <div class="flex justify-between text-[10px] font-semibold text-zinc-400">
                            <span>30 kg</span>
                            <span>105 kg</span>
                            <span>180 kg</span>
                        </div>
                    </div>

                    <!-- Validation warning if empty -->
                    <div x-show="errorMessage" class="p-3 rounded-xl bg-red-50 border border-red-200 text-red-600 text-xs font-semibold flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span x-text="errorMessage"></span>
                    </div>

                    <!-- 4. Tombol Cek BMI -->
                    <div class="pt-1">
                        <button type="button" 
                                @click="calculateBMI()" 
                                class="w-full py-3.5 sm:py-4 px-6 rounded-2xl bg-red-600 hover:bg-red-700 active:scale-[0.99] text-white font-montserrat font-bold text-xs sm:text-sm uppercase tracking-wider shadow-lg shadow-red-600/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer">
                            <span>Hitung BMI Sekarang</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- ================= STATE 2: HASIL PERHITUNGAN BMI (FIT HUB STYLE & FULLY RESPONSIVE) ================= -->
                <div x-show="hasCalculated" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-98"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="space-y-3.5 sm:space-y-4">
                    
                    <!-- Top Bar: Title & Tombol "Cek Ulang" -->
                    <div class="flex items-center justify-between pb-1 gap-2">
                        <h2 class="font-montserrat font-black text-xl xs:text-2xl text-zinc-900 tracking-tight">
                            Kalkulator BMI
                        </h2>
                        
                        <button type="button" 
                                @click="hasCalculated = false" 
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 sm:px-3.5 sm:py-1.5 rounded-xl border border-zinc-300 hover:border-zinc-400 bg-white text-zinc-700 text-[11px] sm:text-xs font-semibold shadow-xs hover:bg-zinc-50 transition cursor-pointer flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a5 5 0 0 1 5 5v2m0 0l-3-3m3 3l3-3M3 10l3-3m-3 3l3 3"/>
                            </svg>
                            <span>Cek Ulang</span>
                        </button>
                    </div>

                    <!-- User Parameters Summary Pill (Gender, Height, Weight) -->
                    <div class="flex flex-wrap items-center justify-center gap-3 sm:gap-6 py-2 border-y border-zinc-100 text-[11px] sm:text-xs font-bold text-zinc-600">
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs sm:text-sm">👤</span>
                            <span x-text="gender === 'male' ? 'Laki-Laki' : 'Perempuan'"></span>
                        </div>
                        <div class="h-3 w-px bg-zinc-200 hidden xs:block"></div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs sm:text-sm">↕</span>
                            <span x-text="height + ' cm'"></span>
                        </div>
                        <div class="h-3 w-px bg-zinc-200 hidden xs:block"></div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-xs sm:text-sm">⚖</span>
                            <span x-text="weight + ' kg'"></span>
                        </div>
                    </div>

                    <!-- HERO RESULT CARD + SEGMENTED PROGRESS BAR (Attached Together) -->
                    <div class="rounded-2xl overflow-hidden shadow-lg border border-zinc-200">
                        
                        <!-- Hero Banner with Category Accent Background & Torso Illustration -->
                        <div class="relative overflow-hidden p-4 xs:p-5 sm:p-7 min-h-[140px] xs:min-h-[155px] sm:min-h-[170px] flex items-center justify-between"
                             :class="categoryInfo.heroBg">
                            
                            <!-- Stylized Geometric Background Shapes -->
                            <div class="absolute -right-8 -bottom-8 w-44 sm:w-56 h-44 sm:h-56 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
                            <div class="absolute top-0 right-1/3 w-28 sm:w-32 h-full bg-gradient-to-l from-white/10 to-transparent skew-x-12 pointer-events-none"></div>
                            
                            <!-- Left: Category Title & Status -->
                            <div class="relative z-10 text-white flex-1 min-w-0 pr-2">
                                <span class="text-[11px] xs:text-xs sm:text-sm font-medium text-white/85 block mb-0.5 sm:mb-1">
                                    Berat Badan di Kategori
                                </span>
                                <div class="text-2xl xs:text-3xl sm:text-4xl lg:text-5xl font-black font-montserrat tracking-tight text-white drop-shadow-md break-words leading-tight"
                                     x-text="categoryInfo.label">
                                </div>
                                <div class="mt-2 inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-white/20 backdrop-blur-sm text-[10px] sm:text-[11px] font-bold text-white border border-white/20">
                                    <span>Skor BMI:</span>
                                    <strong x-text="bmi"></strong>
                                </div>
                            </div>

                            <!-- Right: Category Body Illustration (Fluid Responsive Dimensions) -->
                            <div class="relative z-10 w-24 xs:w-28 sm:w-36 md:w-44 h-32 xs:h-36 sm:h-44 md:h-48 flex items-end justify-center -mr-2 xs:-mr-1 -mb-4 xs:-mb-5 sm:-mb-7 flex-shrink-0">
                                <img :src="categoryInfo.illustration" 
                                     :alt="'Ilustrasi Badan ' + categoryInfo.label" 
                                     class="w-full h-full object-contain object-bottom filter drop-shadow-2xl">
                            </div>

                        </div>

                        <!-- 4 Connected Color Segments (Kurus, Ideal, Berlebih, Obesitas) -->
                        <div class="grid grid-cols-4 text-center text-[10px] xs:text-[11px] sm:text-xs font-bold text-white">
                            <div class="py-2 sm:py-2.5 bg-[#3B82F6] truncate px-0.5" title="Kurus (< 18.5)">
                                Kurus
                            </div>
                            <div class="py-2 sm:py-2.5 bg-[#16A34A] truncate px-0.5" title="Ideal (18.5 - 24.9)">
                                Ideal
                            </div>
                            <div class="py-2 sm:py-2.5 bg-[#F59E0B] truncate px-0.5" title="Berlebih (25.0 - 29.9)">
                                Berlebih
                            </div>
                            <div class="py-2 sm:py-2.5 bg-[#DC2626] truncate px-0.5" title="Obesitas (>= 30.0)">
                                Obesitas
                            </div>
                        </div>

                    </div>

                    <!-- Upward-pointing Triangle Arrow Indicator with Score Badge -->
                    <div class="relative h-9 mb-1 sm:mb-2 px-2">
                        <div class="absolute top-0 transition-all duration-300 -translate-x-1/2 flex flex-col items-center pointer-events-none"
                             :style="`left: ${pointerPosition}%`">
                            <!-- Triangle Arrow Pointing UP -->
                            <div class="w-0 h-0 border-l-[5px] sm:border-l-[6px] border-l-transparent border-r-[5px] sm:border-r-[6px] border-r-transparent border-b-[6px] sm:border-b-[7px] border-b-zinc-900"></div>
                            <!-- Value Badge -->
                            <span class="text-[10px] sm:text-[11px] font-black px-1.5 sm:px-2 py-0.5 rounded-md shadow-md text-white mt-0.5" 
                                  :class="categoryInfo.pointerBadgeClass" 
                                  x-text="bmi"></span>
                        </div>
                    </div>

                    <!-- RECOMMENDATION & ADVISORY BOX (Soft Mint / Light Green Background) -->
                    <div class="p-3.5 sm:p-5 rounded-2xl bg-[#EBFBF5] border border-[#A7F3D0] space-y-3 sm:space-y-3.5 text-zinc-800">
                        
                        <!-- Row 1: Target Ideal Weight Range -->
                        <div class="flex items-start gap-2.5">
                            <span class="text-base sm:text-lg flex-shrink-0 mt-0.5">🎯</span>
                            <div class="text-xs sm:text-sm leading-relaxed">
                                <span class="font-extrabold text-zinc-900" x-text="categoryInfo.recommendation"></span>
                            </div>
                        </div>

                        <!-- Row 2: Fat & Muscle Advisory -->
                        <div class="flex items-start gap-2.5">
                            <span class="text-base sm:text-lg flex-shrink-0 mt-0.5">⚠️</span>
                            <p class="text-xs sm:text-sm text-zinc-700 leading-relaxed">
                                Pastikan jumlah kadar lemak dan massa otot badan baik. Ketidakseimbangan dapat memicu penyakit dan mudah cedera. Cek lebih detil di <strong>Maco Gym</strong> untuk memastikan kondisimu optimal.
                            </p>
                        </div>

                        <!-- Consultation CTA Button -->
                        <div class="pt-1">
                            <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20sudah%20cek%20BMI%20saya%20dan%20ingin%20konsultasi%20program%20latihan%20gratis." 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-[#0D9488] hover:bg-[#0F766E] text-white font-bold text-xs sm:text-sm shadow-md shadow-[#0D9488]/20 transition">
                                <span>Konsultasi Gratis</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- ================= LEFT HALF: FULL BACKGROUND MUSCULAR ATHLETE & INFO ================= -->
        <!-- Placed second on mobile (order-2), first on lg screens (order-1) -->
        <div class="order-2 lg:order-1 lg:col-span-6 relative bg-zinc-950 text-white flex flex-col justify-between overflow-hidden p-6 sm:p-8 lg:p-10 xl:p-12 min-h-[460px] lg:min-h-[520px]">
            
            <!-- Background Image of Muscular Athlete Covering 100% of Left Half -->
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
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-red-950/80 border border-red-500/50 backdrop-blur-md mb-3 sm:mb-4 shadow-sm">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-red-400 font-montserrat">
                            FITNESS & HEALTH TOOL
                        </span>
                    </div>

                    <!-- Heading -->
                    <h1 class="font-montserrat text-2xl xs:text-3xl sm:text-4xl lg:text-5xl font-black uppercase text-white tracking-tight leading-tight">
                        Tentang <span class="text-red-500 drop-shadow-[0_0_20px_rgba(239,68,68,0.5)]">BMI</span>
                    </h1>

                    <!-- Short Description -->
                    <p class="text-zinc-200 text-xs sm:text-sm md:text-base leading-relaxed mt-3 sm:mt-4 max-w-xl font-normal">
                        <strong class="text-white font-semibold">Body Mass Index (BMI)</strong> membantu menentukan apakah berat badan kamu ideal sesuai dengan tinggi badan.
                    </p>

                    <p class="text-zinc-300 text-xs sm:text-sm md:text-base leading-relaxed mt-2 sm:mt-2.5 max-w-xl font-normal">
                        Hasilnya memberikan gambaran awal tentang proporsi tubuhmu dan menjadi dasar yang tepat untuk mulai menjaga atau memperbaiki pola latihan & nutrisi harian.
                    </p>

                    <!-- Toggle Button: Lihat Selengkapnya -->
                    <div class="mt-5 sm:mt-6">
                        <button type="button" 
                                @click="showDetails = !showDetails" 
                                class="inline-flex items-center gap-2 px-4 py-2 sm:py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 backdrop-blur-md text-white font-bold text-xs sm:text-sm tracking-wide transition group cursor-pointer shadow-md">
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
                         class="mt-5 sm:mt-6 pt-5 sm:pt-6 border-t border-zinc-800/90 space-y-4 text-left">
                        
                        <!-- 1. Rumus & Cara Cek BMI -->
                        <div class="bg-zinc-900/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-zinc-700/60 shadow-lg">
                            <div class="flex items-center gap-2.5 mb-2">
                                <div class="w-6 h-6 rounded-md bg-red-600 text-white flex items-center justify-center font-bold text-xs">
                                    1
                                </div>
                                <h3 class="font-montserrat font-bold text-xs sm:text-sm text-white uppercase tracking-wide">
                                    Bagaimana Rumus & Cara Cek BMI?
                                </h3>
                            </div>
                            <p class="text-xs text-zinc-300 leading-relaxed mb-2">
                                Perhitungan Body Mass Index menggunakan standar resmi World Health Organization (WHO):
                            </p>
                            <div class="p-2 sm:p-2.5 bg-black/60 border border-zinc-800 rounded-lg text-center font-mono text-xs sm:text-sm font-bold text-red-400 break-words">
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
                                <h3 class="font-montserrat font-bold text-xs sm:text-sm text-white uppercase tracking-wide">
                                    Panduan Kategori WHO
                                </h3>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-[10px] sm:text-[11px]">
                                <div class="p-2 rounded-lg bg-sky-950/60 border border-sky-800/50">
                                    <span class="font-bold text-sky-400 block">&lt; 18.5: Kurus</span>
                                    <span class="text-zinc-300">Underweight</span>
                                </div>
                                <div class="p-2 rounded-lg bg-emerald-950/60 border border-emerald-800/50">
                                    <span class="font-bold text-emerald-400 block">18.5 – 24.9: Ideal</span>
                                    <span class="text-zinc-300">Normal / Sehat</span>
                                </div>
                                <div class="p-2 rounded-lg bg-amber-950/60 border border-amber-800/50">
                                    <span class="font-bold text-amber-400 block">25.0 – 29.9: Berlebih</span>
                                    <span class="text-zinc-300">Overweight</span>
                                </div>
                                <div class="p-2 rounded-lg bg-rose-950/60 border border-rose-800/50">
                                    <span class="font-bold text-rose-400 block">&ge; 30.0: Obesitas</span>
                                    <span class="text-zinc-300">Obese</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer Note on Left Div -->
                <div class="pt-4 border-t border-white/10 flex flex-wrap items-center justify-between text-[11px] text-zinc-400 gap-2">
                    <span>Maco Gym Malang • Fitness Club</span>
                    <span class="text-red-400 font-semibold">Pandanwangi & Lowokwaru</span>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ================= PROMOTIONAL BADGES SECTION (FULLY RESPONSIVE) ================= -->
<section class="py-10 sm:py-16 lg:py-20 bg-zinc-50 border-b border-zinc-200">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6 lg:gap-8 items-stretch">
            
            <!-- Promo Badge 1: Membership Mulai dari Rp130 ribu/bulan -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl min-h-[260px] sm:min-h-[300px] flex flex-col justify-end p-5 sm:p-8 text-white group border-2 border-zinc-900 hover:border-red-600 transition-all duration-500 bg-zinc-950">
                <img src="{{ asset('images/about-gym.jpg') }}" 
                     alt="Maco Gym Membership Promo" 
                     class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700 brightness-75 contrast-105">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/75 to-zinc-950/30"></div>
                <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-red-600/30 rounded-full blur-2xl pointer-events-none"></div>
                
                <div class="relative z-10 text-center flex flex-col items-center">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-red-600 text-white text-[10px] font-bold uppercase tracking-widest font-montserrat mb-2.5 sm:mb-3 shadow-md">
                        <span>PAKET HEMAT MACO GYM</span>
                    </div>

                    <span class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-zinc-300 mb-1 font-sans">
                        Membership mulai dari
                    </span>
                    <div class="font-montserrat font-black text-2xl xs:text-3xl sm:text-4xl text-white mb-4 sm:mb-5 tracking-tight drop-shadow-md">
                        Rp 130 ribu<span class="text-xs sm:text-sm md:text-base font-bold text-red-500"> /bulan</span>
                    </div>
                    
                    <a href="{{ route('home') }}#pricing" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/40 hover:-translate-y-0.5 active:translate-y-0 transition duration-200">
                        <span>Lihat Paket Membership</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Promo Badge 2: Ingin tahu lebih banyak tentang Maco Gym? -->
            <div class="rounded-3xl bg-white border-2 border-zinc-200 hover:border-red-600 shadow-2xl min-h-[260px] sm:min-h-[300px] flex flex-col items-center justify-center p-5 sm:p-8 text-center relative overflow-hidden group transition-all duration-500">
                <div class="absolute -top-12 -right-12 w-40 h-40 bg-red-500/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-zinc-900/5 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col items-center w-full">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-zinc-100 border border-zinc-200 text-zinc-700 text-[10px] font-bold uppercase tracking-widest font-montserrat mb-2.5 sm:mb-3">
                        <span>CUSTOMER SUPPORT</span>
                    </div>

                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-center justify-center mb-2.5 sm:mb-3 shadow-sm group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                            <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-lg xs:text-xl sm:text-2xl font-black text-zinc-900 font-montserrat uppercase tracking-tight mb-2 max-w-sm leading-snug">
                        Ingin Tahu Lebih Banyak Tentang <span class="text-red-600">Maco Gym</span>?
                    </h3>
                    <p class="text-xs sm:text-sm text-zinc-500 mb-4 sm:mb-6 max-w-sm leading-relaxed font-normal">
                        Tim resepsionis & coach kami siap bantu jawab semua pertanyaan kamu seputar fasilitas, program latihan, & membership.
                    </p>
                    
                    <a href="https://wa.me/6281250207403?text=Halo%20Maco%20Gym%20Malang,%20saya%20ingin%20tanya%20seputar%20membership%20dan%20fasilitas%20gym." 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl bg-zinc-950 hover:bg-red-600 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-zinc-950/20 hover:shadow-red-600/30 transition-all duration-200">
                        <svg class="w-4 h-4 text-emerald-400 group-hover:text-white transition-colors flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
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
        height: 167,
        weight: 60,
        hasCalculated: false,
        showDetails: false,
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

            this.hasCalculated = true;

            // Auto-scroll slightly on mobile to result if needed
            if (window.innerWidth < 1024) {
                this.$nextTick(() => {
                    const el = document.getElementById('bmi-page');
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            }
        },

        // Rumus Standar WHO: Berat Badan (kg) / (Tinggi Badan (m))^2
        get bmi() {
            if (!this.height || !this.weight || this.height <= 0) return 0;
            const h = this.height / 100;
            return parseFloat((this.weight / (h * h)).toFixed(1));
        },

        // Klasifikasi WHO, Banner Gradients & Ilustrasi Badan Sesuai Gender
        get categoryInfo() {
            const val = this.bmi;
            const min = this.idealWeight.min;
            const max = this.idealWeight.max;
            const genderPrefix = this.gender === 'female' ? 'wanita' : 'pria';
            const bmiImgBase = '{{ asset("images/bmi") }}';

            if (val < 18.5) {
                return {
                    label: 'Kurus',
                    heroBg: 'bg-gradient-to-r from-[#1e3a8a] via-[#1d4ed8] to-[#2563eb]',
                    illustration: `${bmiImgBase}/${genderPrefix}_kurus.webp`,
                    pointerBadgeClass: 'bg-[#3B82F6]',
                    recommendation: `Tingkatkan berat badanmu ke rentang ${min} – ${max} kg dengan surplus kalori bergizi & latihan beban.`
                };
            } else if (val <= 24.9) {
                return {
                    label: 'Ideal',
                    heroBg: 'bg-gradient-to-r from-[#0f405b] via-[#155e75] to-[#0e7490]',
                    illustration: `${bmiImgBase}/${genderPrefix}_ideal.webp`,
                    pointerBadgeClass: 'bg-[#16A34A]',
                    recommendation: `Pertahankan berat badanmu di ${min} – ${max} kg dengan rutin berolahraga.`
                };
            } else if (val <= 29.9) {
                return {
                    label: 'Berlebih',
                    heroBg: 'bg-gradient-to-r from-[#78350f] via-[#b45309] to-[#d97706]',
                    illustration: `${bmiImgBase}/${genderPrefix}_berlebih.webp`,
                    pointerBadgeClass: 'bg-[#F59E0B]',
                    recommendation: `Turunkan berat badanmu ke rentang ideal ${min} – ${max} kg dengan defisit kalori & latihan rutin.`
                };
            } else {
                return {
                    label: 'Obesitas',
                    heroBg: 'bg-gradient-to-r from-[#881337] via-[#be123c] to-[#e11d48]',
                    illustration: `${bmiImgBase}/${genderPrefix}_obesitas.webp`,
                    pointerBadgeClass: 'bg-[#DC2626]',
                    recommendation: `Turunkan berat badanmu bertahap menuju rentang ${min} – ${max} kg bersama pendampingan coach.`
                };
            }
        },

        // Rentang berat badan ideal: (18.5 * h^2) s/d (24.9 * h^2)
        get idealWeight() {
            if (!this.height || this.height <= 0) return { min: '0', max: '0' };
            const h = this.height / 100;
            return {
                min: (18.5 * h * h).toFixed(1).replace('.', ','),
                max: (24.9 * h * h).toFixed(1).replace('.', ',')
            };
        },

        // Posisi Pin Panah akurat mengikuti 4 segmen dengan batas aman tepi (5% s/d 95%)
        get pointerPosition() {
            const val = this.bmi;
            if (val < 18.5) {
                // Kurus: 12 s/d 18.5 dipetakan ke 5% s/d 23%
                const pct = 5 + ((val - 12) / (18.5 - 12)) * 18;
                return Math.max(5, Math.min(23, pct)).toFixed(1);
            } else if (val <= 24.9) {
                // Ideal: 18.5 s/d 24.9 dipetakan ke 26% s/d 49%
                const pct = 26 + ((val - 18.5) / (24.9 - 18.5)) * 23;
                return Math.max(26, Math.min(49, pct)).toFixed(1);
            } else if (val <= 29.9) {
                // Berlebih: 25.0 s/d 29.9 dipetakan ke 51% s/d 74%
                const pct = 51 + ((val - 25.0) / (29.9 - 25.0)) * 23;
                return Math.max(51, Math.min(74, pct)).toFixed(1);
            } else {
                // Obesitas: 30.0 s/d 38.0 dipetakan ke 76% s/d 95%
                const pct = 76 + ((val - 30.0) / (38.0 - 30.0)) * 19;
                return Math.max(76, Math.min(95, pct)).toFixed(1);
            }
        }
    }));
});
</script>
