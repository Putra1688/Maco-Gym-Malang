<!-- Navbar -->
<header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-zinc-950/90 backdrop-blur-md border-b border-zinc-800/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo -->
            <a href="#hero" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-amber-500 via-amber-400 to-yellow-300 flex items-center justify-center shadow-lg shadow-amber-500/20 group-hover:scale-105 transition-transform duration-200">
                    <!-- Dumbbell Icon -->
                    <svg class="w-6 h-6 text-zinc-950 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h3m12 0h3M5 6v12M19 6v12M3 18h3m12 0h3M7 10h10M7 14h10M7 7h2v10H7zm8 0h2v10h-2z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-xl tracking-wider text-white uppercase group-hover:text-amber-400 transition-colors">
                        MACO<span class="text-amber-400">GYM</span>
                    </span>
                    <span class="text-[10px] tracking-widest text-zinc-400 font-semibold uppercase -mt-1">
                        MALANG FITNESS CLUB
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-1 lg:gap-2">
                <a href="#hero" class="px-3 py-2 text-sm font-medium text-zinc-300 hover:text-amber-400 hover:bg-zinc-900/60 rounded-lg transition-colors">
                    Beranda
                </a>
                <a href="#facilities" class="px-3 py-2 text-sm font-medium text-zinc-300 hover:text-amber-400 hover:bg-zinc-900/60 rounded-lg transition-colors">
                    Fasilitas
                </a>
                <a href="#pricing" class="px-3 py-2 text-sm font-medium text-zinc-300 hover:text-amber-400 hover:bg-zinc-900/60 rounded-lg transition-colors">
                    Paket & Harga
                </a>
                <a href="#trainers" class="px-3 py-2 text-sm font-medium text-zinc-300 hover:text-amber-400 hover:bg-zinc-900/60 rounded-lg transition-colors">
                    Personal Trainer
                </a>
                <a href="#cara-daftar" class="px-3 py-2 text-sm font-medium text-zinc-300 hover:text-amber-400 hover:bg-zinc-900/60 rounded-lg transition-colors">
                    Cara Daftar
                </a>
                <a href="#faq" class="px-3 py-2 text-sm font-medium text-zinc-300 hover:text-amber-400 hover:bg-zinc-900/60 rounded-lg transition-colors">
                    FAQ
                </a>
                <a href="#kontak" class="px-3 py-2 text-sm font-medium text-zinc-300 hover:text-amber-400 hover:bg-zinc-900/60 rounded-lg transition-colors">
                    Lokasi
                </a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20tertarik%20untuk%20bergabung%20dan%20ingin%20tanya%20informasi%20membership."
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-3 py-2 text-xs font-semibold text-zinc-300 bg-zinc-900 hover:bg-zinc-800 border border-zinc-700/60 rounded-lg transition-colors">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Chat CS</span>
                </a>
                <a href="#cara-daftar"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-zinc-950 bg-gradient-to-r from-amber-400 to-yellow-400 hover:from-amber-300 hover:to-yellow-300 rounded-lg shadow-lg shadow-amber-500/20 hover:shadow-amber-500/30 transform hover:-translate-y-0.5 transition-all">
                    <span>Daftar Sekarang</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn"
                    type="button"
                    aria-label="Toggle Navigation Menu"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-900 border border-zinc-800 focus:outline-none focus:ring-2 focus:ring-amber-400">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-zinc-950 border-b border-zinc-800 px-4 pt-2 pb-6 space-y-2">
        <a href="#hero" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-medium text-zinc-200 hover:text-amber-400 hover:bg-zinc-900">
            Beranda
        </a>
        <a href="#facilities" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-medium text-zinc-200 hover:text-amber-400 hover:bg-zinc-900">
            Fasilitas
        </a>
        <a href="#pricing" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-medium text-zinc-200 hover:text-amber-400 hover:bg-zinc-900">
            Paket & Harga
        </a>
        <a href="#trainers" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-medium text-zinc-200 hover:text-amber-400 hover:bg-zinc-900">
            Personal Trainer
        </a>
        <a href="#cara-daftar" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-medium text-zinc-200 hover:text-amber-400 hover:bg-zinc-900">
            Cara Daftar
        </a>
        <a href="#faq" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-medium text-zinc-200 hover:text-amber-400 hover:bg-zinc-900">
            FAQ
        </a>
        <a href="#kontak" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-base font-medium text-zinc-200 hover:text-amber-400 hover:bg-zinc-900">
            Lokasi & Jam Buka
        </a>
        <div class="pt-4 border-t border-zinc-800 flex flex-col gap-3">
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Maco%20Gym%2C%20saya%20ingin%20tanya%20membership."
               target="_blank"
               rel="noopener noreferrer"
               class="flex items-center justify-center gap-2 w-full py-2.5 text-sm font-semibold text-zinc-200 bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 rounded-lg">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Hubungi Admin WhatsApp</span>
            </a>
            <a href="#cara-daftar"
               class="mobile-nav-link flex items-center justify-center gap-2 w-full py-3 text-sm font-bold text-zinc-950 bg-amber-400 hover:bg-amber-300 rounded-lg shadow-lg shadow-amber-500/20">
                <span>Daftar Membership Sekarang</span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</header>

