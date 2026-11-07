<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name', 'Maco Gym Malang') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 dark:bg-[#0B0F19] text-slate-900 dark:text-slate-100 font-sans min-h-screen flex items-center justify-center p-4 transition-colors duration-200"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || localStorage.getItem('darkMode') === null }"
      :class="{ 'dark': darkMode }">

    <div class="w-full max-w-md my-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                MACO<span class="text-amber-500">GYM</span> MALANG
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Reset Password Akun</p>
        </div>

        <div class="bg-white dark:bg-[#161F30] rounded-2xl shadow-xl p-8 border border-slate-200 dark:border-slate-800">
            <div class="p-4 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 rounded-xl text-amber-800 dark:text-amber-300 text-sm mb-6">
                Untuk keamanan akun, reset password member & staf dapat dilakukan langsung melalui meja resepsionis atau hubungi admin via WhatsApp.
            </div>

            <div class="space-y-4">
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Maco%20Gym,%20saya%20ingin%20reset%20password%20akun%20saya"
                   target="_blank"
                   class="w-full py-3.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/20 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>Hubungi Admin via WhatsApp</span>
                </a>

                <a href="{{ route('login') }}"
                   class="w-full py-3 px-4 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-xl transition text-center block text-sm">
                    Kembali ke Halaman Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>

