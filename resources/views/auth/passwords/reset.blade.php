<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name', 'Maco Gym Malang') }}</title>

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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
    </div>

    <div class="relative z-10 w-full max-w-md my-8">
        <!-- Brand Header -->
        <div class="text-center mb-6">
            <a href="{{ url('/') }}" class="inline-flex flex-col items-center group">
                <div class="p-1 rounded-lg bg-zinc-900 border border-zinc-800 group-hover:border-red-600 transition">
                    <img src="{{ asset('images/logo/macogym.jpg') }}"
                         alt="Maco Gym Malang"
                         class="h-14 w-auto object-contain rounded">
                </div>
                <div class="mt-3">
                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-red-950/80 border border-red-800/80 text-[10px] font-mono font-bold tracking-widest text-red-400 uppercase mb-1.5">
                        BANTUAN KEAMANAN AKUN
                    </div>
                    <h1 class="font-montserrat font-black text-2xl sm:text-3xl tracking-tight text-white uppercase leading-none">
                        MACO<span class="text-red-600">GYM</span> MALANG
                    </h1>
                </div>
            </a>
        </div>

        <!-- Card Container -->
        <div class="bg-white dark:bg-zinc-900 rounded-xl p-6 sm:p-8 border border-zinc-200 dark:border-zinc-800 border-t-4 border-t-red-600 shadow-xl">
            <div class="mb-5 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                <h2 class="font-montserrat text-lg font-bold uppercase tracking-wide text-zinc-900 dark:text-white">
                    Reset Password Akun
                </h2>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                    Verifikasi identitas anggota dilakukan secara langsung demi menjaga keamanan profil & kartu member.
                </p>
            </div>

            <div class="p-4 bg-amber-50 dark:bg-amber-950/40 border-l-4 border-l-amber-500 border border-amber-200 dark:border-amber-900/60 rounded-md text-amber-900 dark:text-amber-200 text-xs mb-6">
                <p class="font-bold mb-1 uppercase tracking-wide text-[10px]">Ketentuan Keamanan:</p>
                <p class="leading-relaxed">
                    Reset kata sandi member dan staf dilakukan melalui meja resepsionis Maco Gym secara langsung atau konfirmasi nomor terdaftar via WhatsApp Admin.
                </p>
            </div>

            <div class="space-y-3">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Maco%20Gym,%20saya%20ingin%20reset%20password%20akun%20saya"
                   target="_blank"
                   class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-lg transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>Hubungi Admin via WhatsApp</span>
                </a>

                <a href="{{ route('login') }}"
                   class="w-full py-2.5 px-4 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 font-semibold text-xs rounded-lg transition text-center block">
                    &larr; Kembali ke Halaman Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>
