<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maco Gym Malang - @yield('title', 'Member Portal')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/macogym.jpg') }}">

    <!-- Theme Initialization Script (Prevents flash of unstyled theme) -->
    <script>
        (function() {
            const saved = localStorage.getItem('darkMode');
            if (saved === 'true' || saved === null || (!('darkMode' in localStorage))) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Google Fonts: Montserrat & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;0,700;0,800;0,900;1,700;1,800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Stylesheets via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js v4 UMD (High Performance Canvas Rendering) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-slate-50/70 dark:bg-[#0a0c10] text-zinc-800 dark:text-zinc-100 font-sans min-h-screen flex flex-col antialiased selection:bg-red-600 selection:text-white transition-colors duration-200 pb-20 md:pb-0"
      x-data="{ 
          darkMode: document.documentElement.classList.contains('dark'),
          showQrModal: false,
          copiedId: false,
          toggleDark() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('darkMode', this.darkMode);
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          },
          copyCardId(id) {
              navigator.clipboard.writeText(id);
              this.copiedId = true;
              setTimeout(() => this.copiedId = false, 2500);
          }
      }">

    <!-- Top Navigation Bar (Frosted Glass Modern Minimalist) -->
    <header class="bg-white/80 dark:bg-[#0e1014]/80 backdrop-blur-xl border-b border-zinc-200/70 dark:border-[#1e222d] sticky top-0 z-40 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Brand & Logo -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="relative">
                            <img src="{{ asset('images/logo/macogym.jpg') }}"
                                 alt="Maco Gym Malang"
                                 class="h-9 sm:h-11 w-auto object-contain rounded-xl border border-zinc-200 dark:border-zinc-800 group-hover:border-red-500/80 transition-all duration-300 shadow-xs">
                            <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-red-600 ring-2 ring-white dark:ring-[#0e1014]"></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-montserrat font-black text-base sm:text-xl tracking-wider text-zinc-900 dark:text-white uppercase leading-none">
                                MACO<span class="text-red-600">GYM</span>
                            </span>
                            <span class="text-[8px] sm:text-[9px] tracking-widest text-zinc-400 dark:text-zinc-400 font-bold uppercase mt-1">
                                MEMBER PORTAL
                            </span>
                        </div>
                    </a>

                    <!-- Desktop Navigation Links -->
                    <nav class="hidden md:flex items-center gap-1.5 pl-6 border-l border-zinc-200 dark:border-zinc-800/80">
                        <a href="{{ route('member.dashboard') }}"
                           class="relative px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 {{ request()->routeIs('member.dashboard') || request()->routeIs('member.preview') ? 'text-red-600 dark:text-red-400 bg-red-600/10 dark:bg-red-500/10' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100/80 dark:hover:bg-zinc-900/60' }}">
                            <span>Dashboard</span>
                            @if(request()->routeIs('member.dashboard') || request()->routeIs('member.preview'))
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 rounded-full bg-red-600"></span>
                            @endif
                        </a>
                        <a href="{{ route('member.profile') }}"
                           class="relative px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 {{ request()->routeIs('member.profile') ? 'text-red-600 dark:text-red-400 bg-red-600/10 dark:bg-red-500/10' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100/80 dark:hover:bg-zinc-900/60' }}">
                            <span>Profil & Fisik</span>
                            @if(request()->routeIs('member.profile'))
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 rounded-full bg-red-600"></span>
                            @endif
                        </a>
                        <a href="{{ route('home') }}" target="_blank"
                           class="px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider text-zinc-400 hover:text-red-600 dark:hover:text-red-400 transition-colors flex items-center gap-1.5">
                            <span>Website Utama</span>
                            <svg class="w-3.5 h-3.5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </nav>
                </div>

                <!-- Right Header Actions -->
                <div class="flex items-center gap-2.5 sm:gap-3">
                    
                    <!-- Quick Barcode Trigger Button -->
                    <button @click="showQrModal = true"
                            type="button"
                            title="Tampilkan Barcode Presensi Kasir"
                            class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-zinc-900 dark:bg-zinc-800/80 hover:bg-red-600 dark:hover:bg-red-600 text-white border border-zinc-700/60 dark:border-zinc-700/40 transition-all duration-200 transform hover:-translate-y-0.5 active:scale-98 shadow-xs cursor-pointer">
                        <svg class="w-4 h-4 text-red-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        <span class="hidden sm:inline">Scan ID</span>
                    </button>

                    <!-- Dark / Light Mode Switcher -->
                    <button @click="toggleDark()"
                            type="button"
                            title="Ganti Tema Tampilan"
                            class="p-2.5 rounded-xl bg-zinc-100 dark:bg-zinc-900 text-zinc-600 dark:text-zinc-300 hover:text-red-600 dark:hover:text-red-400 border border-zinc-200/80 dark:border-zinc-800 transition-all duration-200 cursor-pointer">
                        <!-- Moon Icon (in Light Mode) -->
                        <svg x-show="!darkMode" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                        <!-- Sun Icon (in Dark Mode) -->
                        <svg x-show="darkMode" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <!-- User Identity Badge & Logout -->
                    <div class="flex items-center gap-2.5 sm:gap-3 pl-2 sm:pl-3 border-l border-zinc-200 dark:border-zinc-800">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-zinc-900 dark:text-white leading-tight">
                                {{ auth()->user()->name ?? 'Bima Arya' }}
                            </p>
                            <p class="text-[10px] text-red-600 dark:text-red-400 font-mono font-bold">
                                {{ auth()->user()->member?->card_id ?? 'MC-001' }}
                            </p>
                        </div>

                        @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    title="Keluar dari Akun"
                                    class="p-2 rounded-xl text-zinc-400 hover:text-red-500 hover:bg-red-500/10 transition-colors cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}"
                           class="text-xs font-bold text-red-600 dark:text-red-400 hover:underline">
                            Login
                        </a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- Floating Mobile Bottom Navigation Bar (Gym-Ergonomic Mobile Dock) -->
    <div class="fixed bottom-4 inset-x-4 z-40 md:hidden bg-white/90 dark:bg-[#15171d]/90 backdrop-blur-xl border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl p-1.5 shadow-2xl shadow-black/20 flex items-center justify-around">
        <a href="{{ route('member.dashboard') }}"
           class="flex-1 flex flex-col items-center justify-center py-1.5 px-2 rounded-xl text-[10px] font-bold uppercase tracking-wider transition-all {{ request()->routeIs('member.dashboard') || request()->routeIs('member.preview') ? 'text-red-600 dark:text-red-400 bg-red-600/10' : 'text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white' }}">
            <svg class="w-5 h-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Center Scan Button -->
        <button @click="showQrModal = true"
                type="button"
                title="Buka Scan Barcode ID"
                class="flex flex-col items-center justify-center -mt-5 w-12 h-12 rounded-full bg-red-600 text-white shadow-lg shadow-red-600/40 border-4 border-slate-50 dark:border-[#0a0c10] transform active:scale-95 transition cursor-pointer">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
            </svg>
        </button>

        <a href="{{ route('member.profile') }}"
           class="flex-1 flex flex-col items-center justify-center py-1.5 px-2 rounded-xl text-[10px] font-bold uppercase tracking-wider transition-all {{ request()->routeIs('member.profile') ? 'text-red-600 dark:text-red-400 bg-red-600/10' : 'text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white' }}">
            <svg class="w-5 h-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span>Profil</span>
        </a>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        
        <!-- Flash Alert Success -->
        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-800 dark:text-emerald-300 flex items-center gap-3 shadow-xs">
            <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-xs sm:text-sm font-semibold">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Flash Alert Warning -->
        @if(session('warning'))
        <div class="mb-6 p-4 rounded-xl bg-amber-500/10 border border-amber-500/30 text-amber-800 dark:text-amber-300 flex items-center gap-3 shadow-xs">
            <svg class="w-5 h-5 flex-shrink-0 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span class="text-xs sm:text-sm font-semibold">{{ session('warning') }}</span>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- Global Barcode & QR Scanner Modal (Pop-up Layar Penuh Terang untuk Scanner Meja Resepsionis) -->
    <div x-cloak x-show="showQrModal"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="showQrModal = false">
        
        <div class="relative w-full max-w-sm bg-white rounded-3xl p-6 sm:p-8 text-zinc-900 shadow-2xl border border-zinc-200 text-center"
             @click.away="showQrModal = false"
             x-transition:enter="transition ease-out duration-200 transform"
             x-transition:enter-start="scale-95 opacity-0"
             x-transition:enter-end="scale-100 opacity-100"
             x-transition:leave="transition ease-in duration-150 transform"
             x-transition:leave-start="scale-100 opacity-100"
             x-transition:leave-end="scale-95 opacity-0">
            
            <!-- Close Button -->
            <button @click="showQrModal = false"
                    type="button"
                    class="absolute top-4 right-4 text-zinc-400 hover:text-zinc-800 p-1.5 rounded-full hover:bg-zinc-100 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600/10 text-red-600 text-[10px] font-bold uppercase tracking-wider mb-2">
                <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                <span>Presensi Frontdesk Kasir</span>
            </div>

            <h3 class="font-montserrat font-extrabold text-xl text-zinc-950 uppercase tracking-tight">
                {{ auth()->user()->name ?? 'Bima Arya' }}
            </h3>
            
            <!-- Copy ID Pill Button -->
            <div class="flex items-center justify-center gap-2 mt-1 mb-5">
                <button type="button"
                        @click="copyCardId('{{ auth()->user()->member?->card_id ?? 'MC-001' }}')"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-xs font-mono font-bold transition cursor-pointer">
                    <span>ID: {{ auth()->user()->member?->card_id ?? 'MC-001' }}</span>
                    <svg x-show="!copiedId" class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <svg x-show="copiedId" class="w-3.5 h-3.5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
                <span x-show="copiedId" x-transition class="text-[10px] font-bold text-emerald-600">Tersalin!</span>
            </div>

            <!-- Barcode Visual Representation (High Contrast Ultra Crisp) -->
            <div class="bg-white border-2 border-zinc-900 rounded-2xl p-4 sm:p-5 mb-4 shadow-sm">
                <!-- SVG Code 128 / Barcode Simulation -->
                <svg class="w-full h-24 mx-auto" viewBox="0 0 280 90" fill="currentColor">
                    <!-- Quiet zone -->
                    <rect x="0" y="0" width="280" height="90" fill="#ffffff" />
                    <!-- Barcode stripes -->
                    <g fill="#000000">
                        <rect x="20" y="8" width="4" height="60" />
                        <rect x="28" y="8" width="2" height="60" />
                        <rect x="34" y="8" width="6" height="60" />
                        <rect x="44" y="8" width="2" height="60" />
                        <rect x="50" y="8" width="4" height="60" />
                        <rect x="58" y="8" width="8" height="60" />
                        <rect x="70" y="8" width="2" height="60" />
                        <rect x="76" y="8" width="6" height="60" />
                        <rect x="86" y="8" width="4" height="60" />
                        <rect x="94" y="8" width="2" height="60" />
                        <rect x="100" y="8" width="8" height="60" />
                        <rect x="112" y="8" width="4" height="60" />
                        <rect x="120" y="8" width="2" height="60" />
                        <rect x="126" y="8" width="6" height="60" />
                        <rect x="136" y="8" width="2" height="60" />
                        <rect x="142" y="8" width="8" height="60" />
                        <rect x="154" y="8" width="4" height="60" />
                        <rect x="162" y="8" width="2" height="60" />
                        <rect x="168" y="8" width="6" height="60" />
                        <rect x="178" y="8" width="4" height="60" />
                        <rect x="186" y="8" width="2" height="60" />
                        <rect x="192" y="8" width="8" height="60" />
                        <rect x="204" y="8" width="4" height="60" />
                        <rect x="212" y="8" width="6" height="60" />
                        <rect x="222" y="8" width="2" height="60" />
                        <rect x="228" y="8" width="4" height="60" />
                        <rect x="236" y="8" width="8" height="60" />
                        <rect x="248" y="8" width="4" height="60" />
                        <rect x="256" y="8" width="2" height="60" />
                    </g>
                    <!-- Text under barcode -->
                    <text x="140" y="82" font-family="monospace" font-size="14" font-weight="bold" text-anchor="middle" fill="#000000" letter-spacing="4">
                        *{{ auth()->user()->member?->card_id ?? 'MC-001' }}*
                    </text>
                </svg>
            </div>

            <p class="text-[11px] text-zinc-500 leading-relaxed mb-5">
                Tunjukkan layar ini ke scanner kasir meja depan Maco Gym Pandanwangi / Lowokwaru saat tiba untuk check-in otomatis.
            </p>

            <button @click="showQrModal = false"
                    type="button"
                    class="w-full py-2.5 px-4 bg-zinc-950 hover:bg-zinc-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition cursor-pointer">
                Tutup Layar Scan
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-auto py-6 sm:py-8 border-t border-zinc-200 dark:border-[#262934] bg-white dark:bg-[#12141a] text-center text-xs text-zinc-500 dark:text-zinc-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="font-montserrat font-bold text-zinc-900 dark:text-white uppercase tracking-wider">MACO<span class="text-red-600">GYM</span> MALANG</span>
                <span class="text-zinc-400 dark:text-zinc-600">•</span>
                <span>Pandanwangi & Lowokwaru</span>
            </div>
            <div>
                &copy; {{ date('Y') }} Maco Gym Malang. Luxury Minimalist Management System.
            </div>
        </div>
    </footer>

</body>
</html>
