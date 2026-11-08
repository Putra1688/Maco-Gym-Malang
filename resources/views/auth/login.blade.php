<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ke Sistem - {{ config('app.name', 'Maco Gym Malang') }}</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/macogym.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans min-h-screen flex items-center justify-center p-4 relative selection:bg-red-600 selection:text-white"
      x-data="{
          darkMode: document.documentElement.classList.contains('dark'),
          toggleDark() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('darkMode', this.darkMode);
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          },
          fillAccount(phone, pass) {
              document.getElementById('input-phone').value = phone;
              document.getElementById('input-password').value = pass;
          }
      }">

    <!-- Background Authentic Gym Photo with Athletic Contrast Overlay -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <img src="{{ asset('images/about-gym.jpg') }}"
             alt="Maco Gym Training Atmosphere"
             class="w-full h-full object-cover filter brightness-[0.20] contrast-125">
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-950/90 to-zinc-950"></div>
    </div>

    <!-- Top Action Navigation -->
    <div class="fixed top-4 right-4 z-20 flex items-center gap-2">
        <button @click="toggleDark()"
                type="button"
                class="px-3 py-2 rounded-md bg-zinc-900/90 border border-zinc-800 text-zinc-300 hover:text-white hover:border-zinc-700 text-xs font-semibold transition"
                title="Ganti Mode Tampilan (Dark/Light)">
            <span x-show="!darkMode" class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/></svg>
                <span>Dark</span>
            </span>
            <span x-show="darkMode" class="flex items-center gap-1.5 text-amber-400">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/></svg>
                <span class="text-zinc-300">Light</span>
            </span>
        </button>

        <a href="{{ url('/') }}"
           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-md bg-zinc-900/90 border border-zinc-800 text-xs font-bold uppercase tracking-wider text-zinc-300 hover:text-red-500 hover:border-zinc-700 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Landing Page</span>
        </a>
    </div>

    <!-- Login Container -->
    <div class="relative z-10 w-full max-w-md my-8">

        <!-- Brand Header: Athletic, Bold, Industrial -->
        <div class="text-center mb-6">
            <a href="{{ url('/') }}" class="inline-flex flex-col items-center group">
                <div class="p-1 rounded-lg bg-zinc-900 border border-zinc-800 group-hover:border-red-600 transition">
                    <img src="{{ asset('images/logo/macogym.jpg') }}"
                         alt="Maco Gym Malang"
                         class="h-14 w-auto object-contain rounded">
                </div>
                <div class="mt-3">
                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-red-950/80 border border-red-800/80 text-[10px] font-mono font-bold tracking-widest text-red-400 uppercase mb-1.5">
                        PORTAL OPERASIONAL & MEMBER
                    </div>
                    <h1 class="font-montserrat font-black text-2xl sm:text-3xl tracking-tight text-white uppercase leading-none">
                        MACO<span class="text-red-600">GYM</span> MALANG
                    </h1>
                </div>
            </a>
        </div>

        <!-- Form Card: Solid Athletic Card with Red Header Accent -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-6 sm:p-8 border border-zinc-200 dark:border-zinc-800 border-t-4 border-t-red-600 shadow-xl">
            <div class="mb-6 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                <h2 class="font-montserrat text-lg font-bold uppercase tracking-wide text-zinc-900 dark:text-white">
                    Masuk ke Sistem
                </h2>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                    Silakan gunakan kredensial staf kasir atau nomor member Anda.
                </p>
            </div>

            @if($errors->any())
            <div class="mb-5 p-3.5 bg-red-50 dark:bg-red-950/50 border-l-4 border-l-red-600 border border-red-200 dark:border-red-900 rounded-md text-red-800 dark:text-red-300 text-xs flex items-start gap-2.5">
                <svg class="w-4 h-4 shrink-0 mt-0.5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">{{ $errors->first() }}</span>
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider mb-1.5 text-zinc-700 dark:text-zinc-300">
                        Nomor WhatsApp / ID Kartu Member
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input type="text"
                               name="phone"
                               id="input-phone"
                               value="{{ old('phone') }}"
                               placeholder="Contoh: 081234567890 atau MC-001"
                               required
                               autofocus
                               class="w-full pl-9 pr-3 py-2.5 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded-lg text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none transition text-sm">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs text-red-600 dark:text-red-400 font-semibold hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-zinc-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input type="password"
                               name="password"
                               id="input-password"
                               required
                               placeholder="Masukkan password Anda"
                               class="w-full pl-9 pr-3 py-2.5 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded-lg text-zinc-900 dark:text-white placeholder-zinc-400 focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none transition text-sm">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3 px-4 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-lg active:scale-[0.99] transition flex items-center justify-center gap-2">
                        <span>MASUK SEKARANG</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Quick Auto-Fill Demo Accounts -->
            <div class="mt-6 pt-5 border-t border-zinc-100 dark:border-zinc-800">
                <div class="flex items-center justify-between mb-2.5">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                        Akses Cepat Pengujian:
                    </span>
                    <span class="text-[9px] font-mono text-zinc-400">1-Klik Isi</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button"
                            @click="fillAccount('081234567890', 'password123')"
                            class="px-2.5 py-2 rounded-md bg-zinc-100 hover:bg-zinc-200 dark:bg-zinc-950 dark:hover:bg-zinc-800 border border-zinc-200 dark:border-zinc-800 hover:border-red-600 dark:hover:border-red-600 text-center transition">
                        <span class="block text-xs font-bold text-zinc-900 dark:text-white">Admin</span>
                        <span class="block text-[9px] text-zinc-500 font-mono">Super</span>
                    </button>
                    <button type="button"
                            @click="fillAccount('081234567891', 'password123')"
                            class="px-2.5 py-2 rounded-md bg-zinc-100 hover:bg-zinc-200 dark:bg-zinc-950 dark:hover:bg-zinc-800 border border-zinc-200 dark:border-zinc-800 hover:border-red-600 dark:hover:border-red-600 text-center transition">
                        <span class="block text-xs font-bold text-zinc-900 dark:text-white">Staff</span>
                        <span class="block text-[9px] text-zinc-500 font-mono">Kasir</span>
                    </button>
                    <button type="button"
                            @click="fillAccount('081234567899', 'member123')"
                            class="px-2.5 py-2 rounded-md bg-zinc-100 hover:bg-zinc-200 dark:bg-zinc-950 dark:hover:bg-zinc-800 border border-zinc-200 dark:border-zinc-800 hover:border-red-600 dark:hover:border-red-600 text-center transition">
                        <span class="block text-xs font-bold text-zinc-900 dark:text-white">Member</span>
                        <span class="block text-[9px] text-zinc-500 font-mono">MC-001</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Link -->
        <div class="mt-6 text-center">
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-400 hover:text-white transition">
                <span>&larr;</span>
                <span>Kembali ke Beranda Maco Gym Malang</span>
            </a>
        </div>
    </div>

</body>
</html>
