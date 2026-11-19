<!-- Programs Section (Clean Light Theme with Red Accents) -->
@php
    $programs = [
        [
            'title' => 'STRENGTH TRAINING',
            'category' => 'Compound & Free Weights',
            'image' => asset('images/showroom/room-1.png'),
            'description' => 'Fokus pada peningkatan kekuatan otot murni melalui gerakan angkat beban compound, barbel olimpiade, squat rack kokoh, dan bench press beban berat.',
        ],
        [
            'title' => 'WEIGHT LOSS',
            'category' => 'Fat Loss & Cardio Circuit',
            'image' => asset('images/showroom/room-2.png'),
            'description' => 'Kombinasi latihan interval berintensitas tinggi (HIIT) dan sirkuit kardio terstruktur untuk membakar kalori membandel sekaligus menjaga kebugaran jantung.',
        ],
        [
            'title' => 'MUSCLE BUILDING',
            'category' => 'Hypertrophy & Isolation',
            'image' => asset('images/showroom/room-4.png'),
            'description' => 'Program hipertrofi pembentukan massa otot proporsional dengan mesin plate-loaded, cable station fleksibel, dan variasi latihan isolasi terarah.',
        ],
        [
            'title' => 'MACO GYM CAFE',
            'category' => 'Cafe & Nutrition Lounge',
            'image' => asset('images/showroom/room-3.png'),
            'description' => 'Fasilitas cafe santai di dalam Maco Gym! Nikmati aneka sajian kopi, protein shake bernutrisi, dan minuman segar untuk momen istirahat nyaman dan hangout setelah sesi latihan.',
        ],
    ];
@endphp

<section id="facilities"
         class="py-24 bg-zinc-50 border-t border-zinc-200 relative"
         x-data="{
             modalOpen: false,
             currentIndex: 0,
             items: @js($programs),
             openModal(index) {
                 this.currentIndex = index;
                 this.modalOpen = true;
                 document.body.classList.add('overflow-hidden');
             },
             closeModal() {
                 this.modalOpen = false;
                 document.body.classList.remove('overflow-hidden');
             },
             next() {
                 this.currentIndex = (this.currentIndex + 1) % this.items.length;
             },
             prev() {
                 this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
             }
         }"
         @keydown.escape.window="closeModal()"
         @keydown.arrow-right.window="modalOpen && next()"
         @keydown.arrow-left.window="modalOpen && prev()">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header: Centered & Clean Title -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <div class="flex items-center justify-center gap-3 mb-1">
                <span class="w-8 h-[2px] bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">OUR PROGRAMS</span>
                <span class="w-8 h-[2px] bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-zinc-900 tracking-tight">
                FASILITAS & PROGRAM <span class="text-red-600">MACO GYM</span>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600 max-w-2xl mx-auto leading-relaxed">
                Dirancang untuk membantu setiap member mencapai target kebugaran secara konsisten, mulai dari pembentukan otot, penurunan berat badan, hingga pemulihan stamina. Klik pada kartu untuk melihat foto penuh.
            </p>
        </div>

        <!-- 4 Top Programs Grid (Clean Image & Text with Full Image Modal) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($programs as $index => $program)
            <div @click="openModal({{ $index }})"
                 class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl cursor-pointer">
                <!-- Clean Program Image with Hover Action Badge -->
                <div class="relative h-56 overflow-hidden bg-zinc-950">
                    <img src="{{ $program['image'] }}"
                         alt="{{ $program['title'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>

                    <!-- Overlay Hover Badge -->
                    <div class="absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-3">
                        <div class="px-3.5 py-2 rounded-full bg-black/80 backdrop-blur-md border border-white/20 text-white text-[11px] font-bold font-montserrat uppercase tracking-wider flex items-center gap-1.5 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300 shadow-xl">
                            <svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/>
                            </svg>
                            <span>Lihat Gambar Penuh</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-red-600 mb-1">
                            {{ $program['category'] }}
                        </div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            {{ $program['title'] }}
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed font-normal">
                            {{ $program['description'] }}
                        </p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-zinc-100 flex items-center justify-between text-xs">
                        <span class="text-zinc-500 font-medium text-[11px]">Area Maco Gym</span>
                        <span class="inline-flex items-center gap-1 font-bold text-red-600 font-montserrat uppercase tracking-wider text-[11px] group-hover:translate-x-1 transition-transform">
                            <span>Perbesar</span>
                            <span>&rarr;</span>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Central Action Button to Dedicated Facilities & Classes Page -->
        <div class="mt-14 text-center">
            <a href="{{ route('facilities.index') }}" 
               class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/30 hover:shadow-red-600/40 transition-all duration-200 transform hover:-translate-y-0.5">
                <span>JELAJAHI FASILITAS & PROGRAM LENGKAP</span>
                <svg class="w-4 h-4 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

    </div>

    <!-- ================= LIGHTBOX / FULLSCREEN MODAL (PARTIAL) ================= -->
    <div x-show="modalOpen"
         x-cloak
         style="display: none;"
         class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6 md:p-8"
         role="dialog"
         aria-modal="true"
         :aria-label="items[currentIndex]?.title">

        <!-- Backdrop Overlay with Fade -->
        <div x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeModal()"
             class="fixed inset-0 bg-black/90 backdrop-blur-md"></div>

        <!-- Modal Window Container -->
        <div x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-2"
             class="relative w-full max-w-4xl max-h-[92vh] flex flex-col bg-zinc-950 border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl z-10">

            <!-- Top Bar: Counter & Close Button -->
            <div class="px-4 sm:px-6 py-3.5 bg-zinc-900/90 border-b border-zinc-800/80 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2.5">
                    <span class="inline-block w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
                    <span class="text-xs font-mono font-bold uppercase tracking-wider text-zinc-300">
                        <span class="text-red-500 font-montserrat" x-text="items[currentIndex]?.category"></span>
                        <span class="text-zinc-600 mx-1.5">•</span>
                        <span x-text="'Foto ' + (currentIndex + 1) + ' dari ' + items.length"></span>
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <button @click="closeModal()"
                            type="button"
                            class="px-3 py-1.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider flex items-center gap-1.5 transition cursor-pointer shadow-sm"
                            title="Tutup (Esc)">
                        <span>Tutup</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Image Display Stage with Floating Prev / Next Controls -->
            <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[260px] sm:min-h-[360px] max-h-[58vh] sm:max-h-[66vh]">
                <img :src="items[currentIndex]?.image"
                     :alt="items[currentIndex]?.title"
                     class="w-full h-full max-h-[58vh] sm:max-h-[66vh] object-contain select-none">

                <!-- Floating Left Navigation Arrow -->
                <button @click.stop="prev()"
                        type="button"
                        class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/60 hover:bg-red-600 text-white flex items-center justify-center transition border border-white/20 backdrop-blur-sm cursor-pointer shadow-xl group"
                        title="Foto Sebelumnya">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Floating Right Navigation Arrow -->
                <button @click.stop="next()"
                        type="button"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/60 hover:bg-red-600 text-white flex items-center justify-center transition border border-white/20 backdrop-blur-sm cursor-pointer shadow-xl group"
                        title="Foto Selanjutnya">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Bottom Info Footer (Title, Description) -->
            <div class="p-4 sm:p-6 bg-zinc-950 border-t border-zinc-800/80 shrink-0 space-y-2">
                <h3 class="font-montserrat text-base sm:text-xl font-bold uppercase text-white tracking-tight"
                    x-text="items[currentIndex]?.title"></h3>
                <p class="text-xs sm:text-sm text-zinc-300 leading-relaxed font-normal"
                   x-text="items[currentIndex]?.description"></p>
            </div>

        </div>
    </div>
</section>
