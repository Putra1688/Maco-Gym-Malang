<!-- Top Info Bar & Main Navbar -->
<header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 shadow-sm">
    <!-- Top Thin Bar -->
    <div class="hidden lg:block bg-zinc-950 border-b border-zinc-800 text-[10px] sm:text-[11px] text-zinc-300 py-1.5">
        <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12 flex items-center justify-center gap-6 sm:gap-8">
            <!-- Address -->
            <div class="flex items-center gap-1.5 hover:text-white transition-colors">
                <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Pandanwangi Green Park Ruko E-14 & Lowokwaru, Kota Malang</span>
            </div>
            <!-- Phone -->
            <div class="flex items-center gap-1.5 hover:text-white transition-colors">
                <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span>+62 812-5020-7403</span>
            </div>
            <!-- Hours -->
            <div class="flex items-center gap-1.5 hover:text-white transition-colors">
                <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Buka: Sen - Min: 06:00 - 22:00 WIB</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar (Clean Solid White to blend seamlessly with Logo background) -->
    <div class="bg-white border-b border-zinc-200 shadow-xs">
        <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Logo with User's Maco Gym Asset (Frameless, seamlessly integrated) -->
                <a href="{{ route('home') }}#hero" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('images/logo/macogym.jpg') }}"
                         alt="Maco Gym Malang"
                         class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-105">
                    <div class="flex flex-col">
                        <span class="font-montserrat font-bold text-lg sm:text-xl tracking-wider text-zinc-900 uppercase group-hover:text-red-600 transition-colors leading-none">
                            MACO<span class="text-red-600">GYM</span>
                        </span>
                        <span class="text-[8px] sm:text-[9px] tracking-widest text-zinc-500 font-bold uppercase mt-1">
                            MALANG FITNESS CLUB
                        </span>
                    </div>
                </a>

                <!-- Centered Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
                    <a href="{{ route('home') }}#hero" class="text-xs font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'text-red-600' : 'text-zinc-700 hover:text-red-600' }} transition-colors">
                        HOME
                    </a>
                    <a href="{{ route('home') }}#about" class="text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600 transition-colors">
                        ABOUT US
                    </a>
                    <a href="{{ route('home') }}#facilities" class="text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600 transition-colors">
                        PROGRAMS
                    </a>
                    <a href="{{ route('home') }}#trainers" class="text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600 transition-colors">
                        TRAINERS
                    </a>
                    <a href="{{ route('home') }}#cara-daftar" class="text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600 transition-colors">
                        SCHEDULE
                    </a>
                    <a href="{{ route('home') }}#pricing" class="text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600 transition-colors">
                        PRICING
                    </a>
                    <a href="{{ route('home') }}#faq" class="text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600 transition-colors">
                        FAQ
                    </a>
                    <a href="{{ route('home') }}#kontak" class="text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600 transition-colors">
                        CONTACT
                    </a>
                </nav>

                <!-- Right Action Button: BMI & LOGIN / DASHBOARD -->
                <div class="hidden sm:flex items-center gap-4">
                    <!-- BMI Access Button (No background, clean text button) -->
                    <a href="{{ route('bmi.index') }}"
                       class="text-xs font-bold uppercase tracking-wider transition-colors px-2 py-1.5 flex items-center gap-1.5 {{ request()->routeIs('bmi.index') ? 'text-red-600 font-extrabold' : 'text-zinc-700 hover:text-red-600' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('bmi.index') ? 'text-red-600' : 'text-red-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>BMI</span>
                    </a>

                    @auth
                        @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
                            <a href="{{ route('admin.dashboard') }}"
                               class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-red-600 hover:bg-red-700 rounded-md shadow-md shadow-red-600/20 transform hover:-translate-y-0.5 transition-all">
                                <span>DASHBOARD</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @elseif(auth()->user()->isMember())
                            <a href="{{ route('member.dashboard') }}"
                               class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-red-600 hover:bg-red-700 rounded-md shadow-md shadow-red-600/20 transform hover:-translate-y-0.5 transition-all">
                                <span>PORTAL MEMBER</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-2 px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-white bg-red-600 hover:bg-red-700 rounded-md shadow-md shadow-red-600/20 transform hover:-translate-y-0.5 transition-all">
                            <span>LOGIN</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <button id="mobile-menu-btn"
                        type="button"
                        aria-label="Toggle Navigation Menu"
                        class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-zinc-700 hover:text-zinc-900 hover:bg-zinc-100 border border-zinc-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <svg id="hamburger-icon" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-zinc-200 px-4 pt-4 pb-6 space-y-2 shadow-xl">
        <a href="{{ route('home') }}#hero" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider {{ request()->routeIs('home') ? 'text-red-600' : 'text-zinc-700 hover:text-red-600' }}">
            HOME
        </a>
        <a href="{{ route('home') }}#about" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600">
            ABOUT US
        </a>
        <a href="{{ route('home') }}#facilities" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600">
            PROGRAMS & FASILITAS
        </a>
        <a href="{{ route('bmi.index') }}" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider {{ request()->routeIs('bmi.index') ? 'text-red-600 font-extrabold bg-red-50' : 'text-zinc-700 hover:text-red-600' }}">
            KALKULATOR BMI
        </a>
        <a href="{{ route('home') }}#trainers" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600">
            TRAINERS
        </a>
        <a href="{{ route('home') }}#cara-daftar" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600">
            SCHEDULE / CARA DAFTAR
        </a>
        <a href="{{ route('home') }}#pricing" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600">
            PRICING
        </a>
        <a href="{{ route('home') }}#faq" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600">
            FAQ
        </a>
        <a href="{{ route('home') }}#kontak" class="mobile-nav-link block px-3 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider text-zinc-700 hover:text-red-600">
            CONTACT
        </a>
        <div class="pt-4 border-t border-zinc-200 flex flex-col gap-3">
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
                    <a href="{{ route('admin.dashboard') }}"
                       class="mobile-nav-link flex items-center justify-center gap-2 w-full py-3 text-sm font-bold uppercase text-white bg-red-600 hover:bg-red-700 rounded-md shadow-md">
                        <span>DASHBOARD ADMIN &rarr;</span>
                    </a>
                @elseif(auth()->user()->isMember())
                    <a href="{{ route('member.dashboard') }}"
                       class="mobile-nav-link flex items-center justify-center gap-2 w-full py-3 text-sm font-bold uppercase text-white bg-red-600 hover:bg-red-700 rounded-md shadow-md">
                        <span>PORTAL MEMBER &rarr;</span>
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                   class="mobile-nav-link flex items-center justify-center gap-2 w-full py-3 text-sm font-bold uppercase text-white bg-red-600 hover:bg-red-700 rounded-md shadow-md">
                    <span>LOGIN KE SISTEM &rarr;</span>
                </a>
            @endauth
            <a href="https://wa.me/6281250207403"
               target="_blank"
               rel="noopener noreferrer"
               class="flex items-center justify-center gap-2 w-full py-2.5 text-xs font-bold text-zinc-700 bg-zinc-100 hover:bg-zinc-200 border border-zinc-200 rounded-md">
                <span>Chat Admin WhatsApp</span>
            </a>
        </div>
    </div>
</header>