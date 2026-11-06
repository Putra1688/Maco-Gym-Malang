<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 transition-colors duration-200" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || localStorage.getItem('darkMode') === null }" :class="{ 'dark': darkMode }">
    
    <!-- Navbar -->
    <nav class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-bold text-amber-600 dark:text-amber-400">MACO GYM</a>
                
                <div class="flex items-center gap-4">
                    <!-- Theme Toggle -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    
                    <a href="#facilities" class="hover:text-amber-600 dark:hover:text-amber-400">Fasilitas</a>
                    <a href="#packages" class="hover:text-amber-600 dark:hover:text-amber-400">Paket</a>
                    <a href="#trainers" class="hover:text-amber-600 dark:hover:text-amber-400">Trainer</a>
                    <a href="/login" class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg font-semibold transition">Login</a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-slate-800 dark:bg-slate-950 text-slate-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-amber-400 mb-4">MACO GYM MALANG</h3>
                    <p class="text-sm">Gym eksklusif dengan fasilitas modern untuk mencapai target fitness Anda.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <p class="text-sm">WhatsApp: 081234567890</p>
                    <p class="text-sm">Email: info@macogym.com</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Jam Operasional</h4>
                    <p class="text-sm">Senin - Sabtu: 06.00 - 22.00</p>
                    <p class="text-sm">Minggu: 08.00 - 20.00</p>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-slate-700 text-center text-sm">
                <p>&copy; 2026 Maco Gym Malang. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
