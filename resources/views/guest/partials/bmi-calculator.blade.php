<section id="bmi" class="py-20 bg-zinc-100 text-zinc-800 relative overflow-hidden">
    <!-- Ambient Background Lighting -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-red-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-12 max-w-6xl relative z-10" x-data="macoBmiCalculator()">
        
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-100 border border-red-200 mb-3">
                <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                <span class="text-[11px] font-bold uppercase tracking-widest text-red-700 font-montserrat">
                    FREE FITNESS TOOL
                </span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-4xl lg:text-5xl font-black uppercase text-zinc-900 tracking-tight leading-tight">
                KALKULATOR <span class="text-red-600">BMI</span>
            </h2>
            <p class="mt-3 text-zinc-600 text-sm sm:text-base leading-relaxed">
                Ketahui indeks massa tubuh Anda secara instan dan dapatkan rekomendasi berat badan ideal untuk memulai transformasi fisik Anda.
            </p>
        </div>

        <!-- Calculator Grid Card -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <!-- Left Side: Interactive Controls Form -->
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-xl shadow-zinc-950/5 border border-zinc-200/80 p-6 sm:p-10 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-6 mb-6 border-b border-zinc-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600 font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-montserrat font-bold text-lg text-zinc-900 uppercase tracking-wide">
                                    Parameter Tubuh
                                </h3>
                                <p class="text-xs text-zinc-500">Geser slider atau ketik angka langsung</p>
                            </div>
                        </div>

                        <!-- Reset Button -->
                        <button type="button" 
                                @click="resetValues()" 
                                class="text-xs font-semibold text-zinc-400 hover:text-red-600 transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </button>
                    </div>

                    <!-- 1. Gender Selection -->
                    <div class="mb-7">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-600 mb-3">
                            Pilih Jenis Kelamin
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <button type="button" 
                                    @click="gender = 'male'"
                                    :class="gender === 'male' 
                                        ? 'border-red-600 bg-red-50 text-red-700 shadow-sm ring-2 ring-red-600/20' 
                                        : 'border-zinc-200 text-zinc-700 hover:border-zinc-300 bg-zinc-50/50'"
                                    class="flex items-center justify-center gap-3 py-3.5 px-4 rounded-2xl border-2 font-bold text-sm transition-all duration-150">
                                <span class="text-2xl">👨</span>
                                <span>Laki-laki</span>
                            </button>
                            
                            <button type="button" 
                                    @click="gender = 'female'"
                                    :class="gender === 'female' 
                                        ? 'border-red-600 bg-red-50 text-red-700 shadow-sm ring-2 ring-red-600/20' 
                                        : 'border-zinc-200 text-zinc-700 hover:border-zinc-300 bg-zinc-50/50'"
                                    class="flex items-center justify-center gap-3 py-3.5 px-4 rounded-2xl border-2 font-bold text-sm transition-all duration-150">
                                <span class="text-2xl">👩</span>
                                <span>Perempuan</span>
                            </button>
                        </div>
                    </div>

                    <!-- 2. Height Input (Slider + Number) -->
                    <div class="mb-7">
                        <div class="flex justify-between items-center mb-3">
                            <label for="bmiHeight" class="text-xs font-bold uppercase tracking-wider text-zinc-600">
                                Tinggi Badan
                            </label>
                            <div class="inline-flex items-center bg-zinc-100 rounded-xl px-3 py-1 border border-zinc-200 focus-within:border-red-500 focus-within:ring-2 focus-within:ring-red-500/20 transition">
                                <input id="bmiHeight"
                                       type="number" 
                                       min="100" 
                                       max="230" 
                                       x-model.number="height"
                                       class="w-16 text-right font-black text-zinc-900 bg-transparent text-base focus:outline-none">
                                <span class="text-xs font-bold text-zinc-500 ml-1.5">cm</span>
                            </div>
                        </div>

                        <!-- Range Track Slider -->
                        <div class="relative py-2">
                            <input type="range" 
                                   min="100" 
                                   max="220" 
                                   step="1"
                                   x-model.number="height"
                                   class="w-full h-2.5 bg-zinc-200 rounded-lg appearance-none cursor-pointer accent-red-600">
                        </div>
                        <div class="flex justify-between text-[11px] font-semibold text-zinc-400 mt-1">
                            <span>100 cm</span>
                            <span>160 cm</span>
                            <span>220 cm</span>
                        </div>
                    </div>

                    <!-- 3. Weight Input (Slider + Number) -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-3">
                            <label for="bmiWeight" class="text-xs font-bold uppercase tracking-wider text-zinc-600">
                                Berat Badan
                            </label>
                            <div class="inline-flex items-center bg-zinc-100 rounded-xl px-3 py-1 border border-zinc-200 focus-within:border-red-500 focus-within:ring-2 focus-within:ring-red-500/20 transition">
                                <input id="bmiWeight"
                                       type="number" 
                                       min="30" 
                                       max="180" 
                                       step="0.5"
                                       x-model.number="weight"
                                       class="w-16 text-right font-black text-zinc-900 bg-transparent text-base focus:outline-none">
                                <span class="text-xs font-bold text-zinc-500 ml-1.5">kg</span>
                            </div>
                        </div>

                        <!-- Range Track Slider -->
                        <div class="relative py-2">
                            <input type="range" 
                                   min="30" 
                                   max="180" 
                                   step="0.5"
                                   x-model.number="weight"
                                   class="w-full h-2.5 bg-zinc-200 rounded-lg appearance-none cursor-pointer accent-red-600">
                        </div>
                        <div class="flex justify-between text-[11px] font-semibold text-zinc-400 mt-1">
                            <span>30 kg</span>
                            <span>105 kg</span>
                            <span>180 kg</span>
                        </div>
                    </div>
                </div>

                <!-- Info note footer -->
                <div class="pt-4 border-t border-zinc-100 text-xs text-zinc-500 flex items-center gap-2">
                    <svg class="w-4 h-4 text-zinc-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Standar perhitungan menggunakan klasifikasi resmi World Health Organization (WHO).</span>
                </div>
            </div>

            <!-- Right Side: Real-time Feedback Result Card -->
            <div class="lg:col-span-5 flex flex-col justify-between gap-6">
                
                <!-- Main Score Card -->
                <div class="bg-white rounded-3xl shadow-xl shadow-zinc-950/5 border border-zinc-200/80 p-6 sm:p-8 flex-1">
                    <span class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 block mb-1">
                        HASIL SKOR BMI ANDA
                    </span>

                    <!-- Big Score & Category Badge -->
                    <div class="flex items-baseline gap-3 my-4">
                        <span class="text-6xl sm:text-7xl font-black tracking-tight" 
                              :class="categoryInfo.textColor" 
                              x-text="bmi"></span>
                        <div class="inline-flex px-3.5 py-1.5 rounded-full text-xs font-extrabold uppercase tracking-wide" 
                             :class="categoryInfo.badgeClass" 
                             x-text="categoryInfo.label">
                        </div>
                    </div>

                    <!-- Category Insight Description -->
                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed mb-6" 
                       x-text="categoryInfo.description">
                    </p>

                    <!-- Segmented Multi-Color Progress Gauge -->
                    <div class="mb-6">
                        <div class="relative pt-7">
                            <!-- Floating Pin / Pointer -->
                            <div class="absolute top-0 transition-all duration-300 -translate-x-1/2 flex flex-col items-center pointer-events-none"
                                 :style="`left: ${pointerPosition}%`">
                                <span class="text-[10px] font-black px-1.5 py-0.5 rounded shadow-md text-white whitespace-nowrap" 
                                      :class="categoryInfo.bgBadge" 
                                      x-text="bmi"></span>
                                <div class="w-0 h-0 border-l-[4px] border-l-transparent border-r-[4px] border-r-transparent border-t-[5px]"
                                     :class="categoryInfo.arrowColor"></div>
                            </div>

                            <!-- 4 Category Color Segments -->
                            <div class="h-3.5 w-full rounded-full overflow-hidden flex gap-0.5 bg-zinc-100 p-0.5 border border-zinc-200">
                                <div class="w-[28%] bg-sky-400 rounded-l-full" title="Kurus (< 18.5)"></div>
                                <div class="w-[32%] bg-emerald-500" title="Ideal (18.5 - 24.9)"></div>
                                <div class="w-[20%] bg-amber-400" title="Berlebih (25.0 - 29.9)"></div>
                                <div class="w-[20%] bg-rose-500 rounded-r-full" title="Obesitas (>= 30)"></div>
                            </div>
                        </div>

                        <!-- Labels Range -->
                        <div class="grid grid-cols-4 text-center text-[10px] font-bold text-zinc-400 mt-2">
                            <span>Kurus<br class="hidden sm:block"> &lt;18.5</span>
                            <span class="text-emerald-600 font-extrabold">Ideal<br class="hidden sm:block"> 18.5-24.9</span>
                            <span>Berlebih<br class="hidden sm:block"> 25-29.9</span>
                            <span>Obesitas<br class="hidden sm:block"> &ge;30</span>
                        </div>
                    </div>

                    <!-- Ideal Weight Recommendation Box -->
                    <div class="p-4 sm:p-5 rounded-2xl bg-zinc-50 border border-zinc-200">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-zinc-500">
                                Berat Badan Ideal:
                            </span>
                            <span class="text-xs font-semibold text-zinc-400">
                                Tinggi <strong class="text-zinc-700" x-text="height + ' cm'"></strong>
                            </span>
                        </div>
                        <div class="text-2xl font-black text-zinc-900 mt-1 font-montserrat" 
                             x-text="`${idealWeight.min} kg – ${idealWeight.max} kg`">
                        </div>
                        <p class="text-[11px] text-zinc-500 mt-1">
                            Rentang berat badan yang direkomendasikan untuk meminimalkan risiko gangguan kesehatan.
                        </p>
                    </div>
                </div>

                <!-- Call To Action (FIT HUB Style) -->
                <div class="bg-gradient-to-r from-zinc-950 via-zinc-900 to-zinc-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl border border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-red-500 mb-1">
                            PERSONAL COACHING
                        </div>
                        <h4 class="font-montserrat font-bold text-lg text-white">
                            Ingin Mencapai Berat Ideal?
                        </h4>
                        <p class="text-xs text-zinc-400 mt-1 max-w-sm">
                            Konsultasikan target komposisi tubuh bersama Personal Trainer berpengalaman di Maco Gym.
                        </p>
                    </div>
                    <a href="#pricing" 
                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-red-600/30 whitespace-nowrap transition transform hover:-translate-y-0.5">
                        <span>Pilih Paket</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Alpine.js Calculator Logic -->
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('macoBmiCalculator', () => ({
        gender: 'male',
        height: 170,
        weight: 65,

        resetValues() {
            this.gender = 'male';
            this.height = 170;
            this.weight = 65;
        },

        // Real-time calculation: Berat Badan (kg) / (Tinggi Badan (m))^2
        get bmi() {
            if (!this.height || !this.weight || this.height <= 0) return 0;
            const h = this.height / 100;
            return parseFloat((this.weight / (h * h)).toFixed(1));
        },

        // WHO Classification and Dynamic Themes
        get categoryInfo() {
            const val = this.bmi;
            if (val < 18.5) {
                return {
                    label: 'Kurus (Underweight)',
                    badgeClass: 'bg-sky-100 text-sky-800 border border-sky-200',
                    textColor: 'text-sky-600',
                    bgBadge: 'bg-sky-500',
                    arrowColor: 'border-t-sky-500',
                    description: 'Berat badan Anda berada di bawah rata-rata ideal. Tingkatkan asupan kalori bernutrisi dan latihan beban (hipertrofi) untuk membangun massa otot secara optimal.'
                };
            } else if (val <= 24.9) {
                return {
                    label: 'Ideal (Normal)',
                    badgeClass: 'bg-emerald-100 text-emerald-800 border border-emerald-200',
                    textColor: 'text-emerald-600',
                    bgBadge: 'bg-emerald-500',
                    arrowColor: 'border-t-emerald-500',
                    description: 'Luar biasa! Komposisi berat badan Anda berada pada rentang ideal yang sehat. Pertahankan konsistensi latihan gym dan pola makan bergizi seimbang.'
                };
            } else if (val <= 29.9) {
                return {
                    label: 'Berlebih (Overweight)',
                    badgeClass: 'bg-amber-100 text-amber-800 border border-amber-200',
                    textColor: 'text-amber-600',
                    bgBadge: 'bg-amber-500',
                    arrowColor: 'border-t-amber-500',
                    description: 'Berat badan Anda berada di atas ambang normal. Mulai atur defisit kalori harian dan perbanyak kombinasi latihan kardio serta angkat beban di gym.'
                };
            } else {
                return {
                    label: 'Obesitas (Obese)',
                    badgeClass: 'bg-rose-100 text-rose-800 border border-rose-200',
                    textColor: 'text-rose-600',
                    bgBadge: 'bg-rose-500',
                    arrowColor: 'border-t-rose-500',
                    description: 'Kategori ini memiliki risiko lebih tinggi terhadap penyakit metabolik. Sangat disarankan berkonsultasi dengan Personal Trainer untuk pendampingan fat-loss bertahap dan aman.'
                };
            }
        },

        // Ideal weight calculation: (18.5 * h^2) s/d (24.9 * h^2)
        get idealWeight() {
            if (!this.height || this.height <= 0) return { min: 0, max: 0 };
            const h = this.height / 100;
            return {
                min: (18.5 * h * h).toFixed(1),
                max: (24.9 * h * h).toFixed(1)
            };
        },

        // Dynamic Pin Position on Gauge Bar (scale: 12 - 38)
        get pointerPosition() {
            const minScale = 12;
            const maxScale = 38;
            const clamped = Math.min(Math.max(this.bmi, minScale), maxScale);
            return ((clamped - minScale) / (maxScale - minScale) * 100).toFixed(1);
        }
    }));
});
</script>

