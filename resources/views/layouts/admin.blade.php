<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Maco Gym Malang') }} - @yield('title')</title>

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

    <!-- Google Fonts: Plus Jakarta Sans & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/macogym.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-zinc-100 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased font-sans min-h-screen selection:bg-red-600 selection:text-white"
      x-data="{
          darkMode: document.documentElement.classList.contains('dark'),
          sidebarOpen: window.innerWidth >= 1024,
          mobileMenuOpen: false,
          toggleDark() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('darkMode', this.darkMode);
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          }
      }"
      @resize.window="if (window.innerWidth >= 1024) { mobileMenuOpen = false; sidebarOpen = true; }">

    <div class="flex min-h-screen">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition-opacity duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false"
             class="fixed inset-0 z-40 bg-black/70 lg:hidden"
             style="display: none;"></div>

        <!-- Sidebar: Industrial, Athletic, Solid -->
        <aside :class="[
                   mobileMenuOpen ? 'translate-x-0' : '-translate-x-full',
                   sidebarOpen ? 'lg:w-64' : 'lg:w-20'
               ]"
               class="fixed inset-y-0 left-0 z-50 w-72 lg:translate-x-0 lg:static lg:inset-auto
                      bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-800
                      transition-all duration-200 flex flex-col">

            <!-- Sidebar Header / Brand -->
            <div class="p-4 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between shrink-0 h-16">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group overflow-hidden" x-show="sidebarOpen || mobileMenuOpen">
                    <img src="{{ asset('images/logo/macogym.jpg') }}"
                         alt="Maco Gym"
                         class="h-9 w-auto object-contain rounded border border-zinc-200 dark:border-zinc-700 shrink-0">
                    <div class="flex flex-col min-w-0">
                        <span class="font-montserrat font-black text-base tracking-wider text-zinc-900 dark:text-white uppercase leading-none">
                            MACO<span class="text-red-600">GYM</span>
                        </span>
                        <span class="text-[9px] font-mono font-bold tracking-widest text-zinc-500 dark:text-zinc-400 uppercase mt-0.5">
                            ADMIN CONSOLE
                        </span>
                    </div>
                </a>

                <!-- Sidebar toggle (desktop) -->
                <button @click="sidebarOpen = !sidebarOpen"
                        class="hidden lg:flex p-1.5 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded text-zinc-500 dark:text-zinc-400 transition"
                        title="Perkecil / Perluas Sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Close button (mobile) -->
                <button @click="mobileMenuOpen = false"
                        class="lg:hidden p-1.5 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded text-zinc-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard', 'routeIs' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'admin.frontdesk.index', 'routeIs' => 'admin.frontdesk.*', 'label' => 'Frontdesk & Kasir', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ['route' => 'admin.members.index', 'routeIs' => 'admin.members.*', 'label' => 'Data Member', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                        ['route' => 'admin.packages.index', 'routeIs' => 'admin.packages.*', 'label' => 'Paket Layanan', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                        ['route' => 'admin.transactions.index', 'routeIs' => 'admin.transactions.*', 'label' => 'Laporan Transaksi', 'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
                        ['route' => 'admin.trainers.index', 'routeIs' => 'admin.trainers.*', 'label' => 'Personal Trainer', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm font-semibold transition-colors duration-150
                              {{ request()->routeIs($item['routeIs'])
                                  ? 'bg-red-600 text-white'
                                  : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                        </svg>
                        <span x-show="sidebarOpen || mobileMenuOpen" class="whitespace-nowrap">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Sidebar Footer: Back to Website -->
            <div class="p-3 border-t border-zinc-200 dark:border-zinc-800 shrink-0" x-show="sidebarOpen || mobileMenuOpen">
                <a href="{{ url('/') }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>Lihat Website Publik</span>
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Bar: Crisp, Solid, Functional -->
            <header class="sticky top-0 z-30 bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800 px-4 sm:px-6 py-3 h-16 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <!-- Mobile hamburger -->
                    <button @click="mobileMenuOpen = true"
                            class="lg:hidden p-1.5 -ml-1 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded text-zinc-600 dark:text-zinc-400 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div>
                        <h2 class="font-montserrat text-sm sm:text-base font-bold uppercase tracking-wider text-zinc-900 dark:text-white leading-tight">@yield('header', 'Dashboard')</h2>
                        <p class="text-[11px] font-mono text-zinc-500 dark:text-zinc-400 hidden sm:block">{{ now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Theme Toggle -->
                    <button @click="toggleDark()"
                            class="px-2.5 py-1.5 rounded bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-600 dark:text-zinc-300 transition text-xs font-medium flex items-center gap-1.5"
                            title="Ganti Mode Tampilan (Dark/Light)">
                        <span x-show="!darkMode" class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                            <span class="text-[11px] hidden md:inline">Dark</span>
                        </span>
                        <span x-show="darkMode" class="flex items-center gap-1 text-amber-400">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/></svg>
                            <span class="text-[11px] text-zinc-300 hidden md:inline">Light</span>
                        </span>
                    </button>

                    <!-- User Info & Logout -->
                    <div class="flex items-center gap-2 sm:gap-3 pl-2 sm:pl-3 border-l border-zinc-200 dark:border-zinc-800">
                        <div class="hidden sm:block text-right">
                            <p class="text-xs font-bold text-zinc-900 dark:text-white leading-none">{{ auth()->user()->name }}</p>
                            <span class="inline-block px-1.5 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800 text-[9px] font-mono font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mt-1">
                                {{ auth()->user()->role }}
                            </span>
                        </div>
                        <!-- User Avatar Initials -->
                        <div class="w-8 h-8 rounded bg-red-600 flex items-center justify-center text-white text-xs font-montserrat font-bold uppercase shrink-0">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="p-1.5 text-zinc-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded transition"
                                    title="Logout">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 overflow-y-auto">
                @if(session('success'))
                <div class="mb-5 p-3.5 bg-emerald-50 dark:bg-emerald-950/40 border-l-4 border-l-emerald-600 border border-emerald-200 dark:border-emerald-900/60 rounded text-emerald-900 dark:text-emerald-200 text-xs sm:text-sm font-medium flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-5 p-3.5 bg-red-50 dark:bg-red-950/40 border-l-4 border-l-red-600 border border-red-200 dark:border-red-900/60 rounded text-red-900 dark:text-red-200 text-xs sm:text-sm font-medium flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                @endif

                @if(session('warning'))
                <div class="mb-5 p-3.5 bg-amber-50 dark:bg-amber-950/40 border-l-4 border-l-amber-500 border border-amber-200 dark:border-amber-900/60 rounded text-amber-900 dark:text-amber-200 text-xs sm:text-sm font-medium flex items-center gap-2.5">
                    <svg class="w-4 h-4 text-amber-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('warning') }}</span>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
