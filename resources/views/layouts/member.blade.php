<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Maco Gym Malang') }} - @yield('title', 'Member Portal')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 font-sans min-h-screen flex flex-col transition-colors duration-200"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || localStorage.getItem('darkMode') === null }"
      :class="{ 'dark': darkMode }">

    <!-- Top Bar -->
    <header class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 sticky top-0 z-30 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2">
                    <span class="text-2xl font-black tracking-tight text-amber-500">MACO<span class="text-slate-900 dark:text-white">GYM</span></span>
                    <span class="text-[10px] uppercase font-bold tracking-widest px-2 py-0.5 rounded bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">Member</span>
                </a>

                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('member.dashboard') }}"
                       class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('member.dashboard') ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('member.profile') }}"
                       class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('member.profile') ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700' }}">
                        Profil & Fisik
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-3">
                <!-- Theme Toggle -->
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        title="Ganti Tema"
                        class="p-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                    </svg>
                </button>

                <div class="flex items-center gap-3 pl-3 border-l border-slate-200 dark:border-slate-700">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-900 dark:text-white leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-amber-600 dark:text-amber-400 font-mono">{{ auth()->user()->member?->card_id ?? 'No Card' }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                title="Keluar"
                                class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-950/40 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mobile Nav bar -->
        <div class="flex md:hidden border-t border-slate-200 dark:border-slate-700 px-4 py-2 gap-2">
            <a href="{{ route('member.dashboard') }}"
               class="flex-1 text-center py-2 text-xs font-semibold rounded-lg {{ request()->routeIs('member.dashboard') ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400' : 'text-slate-600 dark:text-slate-300' }}">
                Dashboard
            </a>
            <a href="{{ route('member.profile') }}"
               class="flex-1 text-center py-2 text-xs font-semibold rounded-lg {{ request()->routeIs('member.profile') ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400' : 'text-slate-600 dark:text-slate-300' }}">
                Profil & Fisik
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 sm:px-6 py-6 sm:py-8 max-w-5xl">
        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        @endif

        @if(session('warning'))
        <div class="mb-6 p-4 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-amber-800 dark:text-amber-300 flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span class="text-sm font-medium">{{ session('warning') }}</span>
        </div>
        @endif

        @yield('content')
    </main>

    <footer class="py-6 border-t border-slate-200 dark:border-slate-800 text-center text-xs text-slate-500 dark:text-slate-400">
        &copy; {{ date('Y') }} Maco Gym Malang. Luxury Minimalist Management System.
    </footer>

</body>
</html>
