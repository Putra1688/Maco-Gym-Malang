<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maco Gym Malang | Train Hard. Stay Strong. Fitness Club Terbaik di Malang</title>
    <meta name="description" content="Pusat kebugaran & fitness club terlengkap di Kota Malang. Fasilitas modern, pelatih bersertifikasi, paket mahasiswa terjangkau, dan atmosfer gym berenergi tinggi.">
    <meta name="keywords" content="gym malang, maco gym malang, fitness club malang, paket mahasiswa gym, personal trainer malang">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Maco Gym Malang | Train Hard. Stay Strong.">
    <meta property="og:description" content="Alat gym lengkap standar internasional, promo mahasiswa mulai Rp 135k/bulan, bimbingan Coach profesional, dan shower air hangat.">
    <meta property="og:image" content="{{ asset('images/logo/macogym.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo/macogym.jpg') }}">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white text-zinc-800 antialiased selection:bg-red-600 selection:text-white font-sans min-h-screen flex flex-col">

    <!-- Navbar & Top Info Bar (Guest Partial) -->
    @include('guest.partials.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section (Become The Best Version Of Yourself) -->
        @include('guest.partials.hero')

        <!-- Programs & Facilities (Our Programs) -->
        @include('guest.partials.facilities')

        <!-- About Section (Discipline Focus Strong Consistent) -->
        @include('guest.partials.about')

        <!-- Pricing (Choose Your Plan) -->
        @include('guest.partials.pricing')

        <!-- Personal Trainers (Our Expert Trainers) -->
        @include('guest.partials.trainers')

        <!-- Schedule & How to Join (Cara Daftar) -->
        @include('guest.partials.how-to-join')

        <!-- Testimonials (What Our Members Say) -->
        @include('guest.partials.testimonials')

        <!-- FAQ Section (Questions & Answers) -->
        @include('guest.partials.faq')
    </main>

    <!-- Pre-Footer Banner & Footer (Shared Component) -->
    <x-footer />

    <!-- Mobile Nav Toggle & Header Scroll Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const hamburgerIcon = document.getElementById('hamburger-icon');
            const closeIcon = document.getElementById('close-icon');
            const navLinks = document.querySelectorAll('.mobile-nav-link');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    const isExpanded = !mobileMenu.classList.contains('hidden');
                    if (isExpanded) {
                        mobileMenu.classList.add('hidden');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    } else {
                        mobileMenu.classList.remove('hidden');
                        hamburgerIcon.classList.add('hidden');
                        closeIcon.classList.remove('hidden');
                    }
                });

                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    });
                });
            }

            const header = document.getElementById('main-header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 30) {
                    header.classList.add('shadow-2xl');
                } else {
                    header.classList.remove('shadow-2xl');
                }
            });
        });
    </script>
</body>
</html>
