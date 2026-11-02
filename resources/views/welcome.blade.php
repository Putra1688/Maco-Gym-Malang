<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maco Gym Malang | Pusat Kebugaran & Fitness Terbaik di Kota Malang</title>
    <meta name="description" content="Pusat kebugaran & fitness club terlengkap di Kota Malang dengan alat modern, paket bulanan, promo mahasiswa terjangkau, dan bimbingan Personal Trainer bersertifikat.">
    <meta name="keywords" content="gym malang, fitness malang, maco gym malang, paket gym mahasiswa malang, personal trainer malang, tempat fitness murah di malang">

    <!-- Open Graph / Meta Sosial -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Maco Gym Malang | Pusat Kebugaran & Fitness Terbaik">
    <meta property="og:description" content="Alat gym lengkap standar internasional, promo mahasiswa mulai Rp 135rb, fasilitas shower air hangat, loker, dan coach profesional.">
    <meta property="og:site_name" content="Maco Gym Malang">

    <!-- Google Fonts: Plus Jakarta Sans & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles & Scripts via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 text-zinc-100 antialiased selection:bg-amber-400 selection:text-zinc-950 font-sans min-h-screen flex flex-col">

    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content Sections -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <x-hero />

        <!-- Facilities Section -->
        <x-facilities />

        <!-- Products / Pricing Section (Bulanan, Mahasiswa, Personal Trainer) -->
        <x-pricing />

        <!-- Personal Trainer Section -->
        <x-trainers />

        <!-- Cara Daftar & Interactive Registration Form -->
        <x-how-to-join />

        <!-- FAQ Section -->
        <x-faq />
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Mobile Navigation Toggle Script -->
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

                // Close menu when a link is clicked
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        hamburgerIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    });
                });
            }

            // Navbar scroll background effect
            const header = document.getElementById('main-header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 40) {
                    header.classList.add('shadow-xl', 'bg-zinc-950/95');
                } else {
                    header.classList.remove('shadow-xl');
                }
            });
        });
    </script>
</body>
</html>
