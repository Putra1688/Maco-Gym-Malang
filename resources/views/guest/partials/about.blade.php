<!-- About Section (Clean Light Theme with Red Accents & Contrasted Photo Box) -->
<section id="about" class="py-20 sm:py-24 bg-white border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">
            
            <!-- Left: Inspiring Gym Box with "DISCIPLINE FOCUS STRONG CONSISTENT" with Directional Dark Overlay -->
            <div class="lg:col-span-5 relative rounded-2xl overflow-hidden border border-zinc-200 p-8 sm:p-10 shadow-xl flex flex-col justify-between min-h-[360px] sm:min-h-[400px] group">
                <!-- Background Gym Photo (room-1.png) -->
                <img src="{{ asset('images/showroom/room-1.png') }}"
                     alt="Maco Gym Training Atmosphere"
                     class="absolute inset-0 w-full h-full object-cover filter brightness-95 group-hover:scale-105 transition-transform duration-700">
                
                <!-- Directional Dark Gradient Overlay for High Contrast Text -->
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/95 via-zinc-950/60 to-zinc-950/40"></div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-red-600/30 blur-3xl rounded-full pointer-events-none"></div>

                <!-- Motivational Stencil Text Overlay (Ukuran Diperkecil Lebih Rapi & Proporsional) -->
                <div class="relative z-10 space-y-1 font-bold text-xl sm:text-2xl lg:text-3xl uppercase tracking-tight leading-tight select-none font-montserrat my-auto">
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

            <!-- Right: About Copy & Action Button -->
            <div class="lg:col-span-7 space-y-6 max-w-2xl">
                <div>
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="w-6 h-[2px] bg-red-600"></span>
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
                    <a href="https://maps.app.goo.gl/E7yMwHe1PAcArsrH9" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white text-xs font-bold font-montserrat uppercase tracking-wider transition-all duration-200 shadow-lg shadow-red-600/25 hover:-translate-y-0.5">
                        <i class="fa-solid fa-location-dot text-sm"></i>
                        <span>LIHAT LOKASI DI GOOGLE MAPS</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>