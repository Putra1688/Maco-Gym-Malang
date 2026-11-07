<!-- About Section (Clean Light Theme with Red Accents & Contrasted Photo Box) -->
<section id="about" class="py-24 bg-white border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left: Inspiring Gym Box with "DISCIPLINE FOCUS STRONG CONSISTENT" with Directional Dark Overlay (FIT HUB Style) -->
            <div class="lg:col-span-4 relative rounded-2xl overflow-hidden border border-zinc-200 p-8 sm:p-10 shadow-xl flex flex-col justify-center min-h-[360px] group">
                <!-- Background Gym Photo -->
                <img src="{{ asset('images/about-gym.jpg') }}"
                     alt="Maco Gym Training Atmosphere"
                     class="absolute inset-0 w-full h-full object-cover filter brightness-95 group-hover:scale-105 transition-transform duration-700">
                
                <!-- Directional Dark Gradient Overlay for High Contrast Text -->
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/95 via-zinc-950/60 to-zinc-950/40"></div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-red-600/30 blur-3xl rounded-full pointer-events-none"></div>

                <!-- Giant Motivational Stencil Text Overlay -->
                <div class="relative z-10 space-y-1 font-bold text-3xl sm:text-4xl lg:text-5xl uppercase tracking-tight leading-none select-none font-montserrat">
                    <div class="text-zinc-300 hover:text-white transition-colors">DISCIPLINE</div>
                    <div class="text-red-500 drop-shadow-[0_0_20px_rgba(239,68,68,0.5)]">FOCUS</div>
                    <div class="text-white">STRONG</div>
                    <div class="text-zinc-300 hover:text-white transition-colors">CONSISTENT</div>
                </div>

                <div class="relative z-10 mt-6 pt-4 border-t border-white/20 flex items-center justify-between text-xs text-zinc-300 font-bold tracking-widest uppercase">
                    <span>Maco Gym Philosophy</span>
                    <span class="text-red-400 font-bold">Kota Malang</span>
                </div>
            </div>

            <!-- Middle: About Copy & Action Button -->
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 rounded-full bg-red-600"></span>
                        <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">ABOUT MACO GYM</span>
                    </div>
                    <h3 class="font-montserrat text-2xl sm:text-4xl font-bold uppercase text-zinc-900 tracking-tight">
                        TENTANG MACO GYM MALANG
                    </h3>
                </div>

                <p class="text-sm sm:text-base text-zinc-600 leading-relaxed font-normal">
                    Di Maco Gym, kami percaya bahwa kebugaran lebih dari sekadar sesi angkat beban — ini adalah gaya hidup. Misi kami adalah membantu setiap orang di Kota Malang mencapai performa fisik dan mental terbaik mereka melalui fasilitas berstandar tinggi, program latihan teruji, dan atmosfer komunitas yang suportif.
                </p>

                <div>
                    <a href="#cara-daftar" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-md bg-red-600 hover:bg-red-700 text-white text-xs font-bold uppercase tracking-wider transition-all shadow-lg shadow-red-600/25">
                        <span>MORE ABOUT US</span>
                        <svg class="w-4 h-4 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right: 2x2 Stats Grid with Circular Icons -->
            <div class="lg:col-span-3 grid grid-cols-2 gap-6 sm:gap-8">
                
                <!-- Stat 1 -->
                <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 shadow-xs space-y-2">
                    <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl sm:text-3xl font-bold text-zinc-900">7+</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-zinc-500">YEARS EXPERIENCE</div>
                </div>

                <!-- Stat 2 -->
                <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 shadow-xs space-y-2">
                    <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl sm:text-3xl font-bold text-zinc-900">1.5K+</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-zinc-500">HAPPY MEMBERS</div>
                </div>

                <!-- Stat 3 -->
                <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 shadow-xs space-y-2">
                    <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h3m12 0h3M5 6v12M19 6v12M3 18h3m12 0h3M7 10h10M7 14h10M7 7h2v10H7zm8 0h2v10h-2z" />
                        </svg>
                    </div>
                    <div class="text-2xl sm:text-3xl font-bold text-zinc-900">50+</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-zinc-500">MODERN MACHINES</div>
                </div>

                <!-- Stat 4 -->
                <div class="p-4 rounded-xl bg-zinc-50 border border-zinc-200 shadow-xs space-y-2">
                    <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl sm:text-3xl font-bold text-zinc-900">100+</div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-zinc-500">TRANSFORMATIONS</div>
                </div>

            </div>

        </div>

    </div>
</section>