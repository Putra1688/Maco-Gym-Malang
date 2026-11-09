<!-- Hero Section (FIT HUB Style: Left-side Dark Contrast Gradient with Bright Real Gym Photo on the Right) -->
<section id="hero" class="relative h-[100dvh] min-h-[520px] max-h-[920px] flex flex-col justify-center overflow-hidden bg-zinc-950 pt-20 sm:pt-24 lg:pt-28 pb-4 sm:pb-6">
    
    <!-- Background Image Slideshow Carousel (Bright, natural photographic lighting) -->
    <div id="hero-slider" class="absolute inset-0 z-0">
        <!-- Slide 1 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100">
            <img src="{{ asset('images/hero-model.jpg') }}"
                 alt="Maco Gym Athletes Training"
                 class="w-full h-full object-cover object-right md:object-center filter brightness-95 contrast-105 scale-100">
        </div>
        <!-- Slide 2 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('images/about-gym.jpg') }}"
                 alt="Maco Gym Facilities"
                 class="w-full h-full object-cover object-right md:object-center filter brightness-95 contrast-105 scale-100">
        </div>
        <!-- Slide 3 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('images/programs/strength.jpg') }}"
                 alt="Strength Training"
                 class="w-full h-full object-cover object-right md:object-center filter brightness-95 contrast-105 scale-100">
        </div>
        <!-- Slide 4 -->
        <div class="hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0">
            <img src="{{ asset('images/programs/muscle.jpg') }}"
                 alt="Muscle Building"
                 class="w-full h-full object-cover object-right md:object-center filter brightness-95 contrast-105 scale-100">
        </div>
    </div>

    <!-- Directional Dark Gradient Overlay (Exact Match with FIT HUB Reference: Dark on left text side, Open & Bright on photo side) -->
    <div class="absolute inset-0 z-1 bg-gradient-to-r from-zinc-950 via-zinc-950/90 sm:via-zinc-950/80 to-transparent w-full md:w-3/4 lg:w-3/5 pointer-events-none"></div>
    <div class="absolute inset-0 z-1 bg-gradient-to-t from-zinc-950/80 via-transparent to-transparent md:hidden pointer-events-none"></div>

    <!-- Hero Content (Positioned on the Left over the Dark Gradient for Maximum Readability) -->
    <div class="relative z-10 w-full max-w-[1720px] mx-auto px-5 sm:px-8 lg:px-12 my-auto text-left flex flex-col items-start space-y-4 sm:space-y-5 py-2 sm:py-4">
        
        <!-- Tagline / Eyebrow -->
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-950/60 border border-red-500/40 backdrop-blur-md">
            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
            <span class="tagline text-[10px] sm:text-xs font-bold uppercase tracking-[0.2em] text-red-400 font-montserrat">
                TRAIN HARD. STAY STRONG.
            </span>
        </div>

        <!-- Headline (Proportional & Compact like FIT HUB Reference) -->
        <h1 class="font-montserrat text-2xl sm:text-3xl md:text-4xl lg:text-[40px] xl:text-[44px] font-bold uppercase text-white tracking-tight leading-tight max-w-lg lg:max-w-xl drop-shadow-md">
            BECOME THE <br>
            <span class="text-red-500 drop-shadow-[0_0_20px_rgba(239,68,68,0.4)]">BEST VERSION</span> <br>
            OF YOURSELF
        </h1>

        <!-- Subheading -->
        <p class="text-xs sm:text-sm md:text-base text-zinc-300 max-w-lg font-normal leading-relaxed drop-shadow">
            Modern equipment. Expert trainers. Supportive community. Everything you need to achieve your fitness goals at Maco Gym Malang.
        </p>

        <!-- Action Buttons -->
        <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center justify-start gap-3 w-full sm:w-auto">
            <!-- Red Primary Button -->
            <a href="#pricing"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 sm:px-7 py-3 text-xs sm:text-sm font-bold uppercase tracking-wider text-white bg-red-600 hover:bg-red-700 rounded-md shadow-lg shadow-red-600/30 transform hover:-translate-y-0.5 transition-all text-center">
                <span>JOIN NOW</span>
                <svg class="w-4 h-4 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>

            <!-- Secondary Light Outline Button: Kunjungi Instagram -->
            <a href="https://www.instagram.com/macogym.mlg/"
               target="_blank"
               rel="noopener noreferrer"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 sm:px-7 py-3 text-xs sm:text-sm font-bold uppercase tracking-wider text-white bg-black/40 hover:bg-white hover:text-black border border-white/40 hover:border-white rounded-md backdrop-blur-md transition-all text-center">
                <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                <span>KUNJUNGI INSTAGRAM</span>
            </a>
        </div>

        <!-- Carousel Slide Indicators (Dots) -->
        <div class="flex items-center justify-start gap-2 pt-1">
            <span class="hero-dot w-6 h-1 rounded-full bg-red-600 transition-all duration-500"></span>
            <span class="hero-dot w-2 h-1 rounded-full bg-white/40 transition-all duration-500"></span>
            <span class="hero-dot w-2 h-1 rounded-full bg-white/40 transition-all duration-500"></span>
            <span class="hero-dot w-2 h-1 rounded-full bg-white/40 transition-all duration-500"></span>
        </div>

    </div>
</section>

<!-- Auto Slideshow Script (2 seconds interval with smooth fade transition) -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.hero-dot');
        let currentSlide = 0;
        const totalSlides = slides.length;

        if (totalSlides > 1) {
            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');
                
                if (dots[currentSlide]) {
                    dots[currentSlide].classList.remove('w-6', 'bg-red-600');
                    dots[currentSlide].classList.add('w-2', 'bg-white/40');
                }

                currentSlide = (currentSlide + 1) % totalSlides;

                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');

                if (dots[currentSlide]) {
                    dots[currentSlide].classList.remove('w-2', 'bg-white/40');
                    dots[currentSlide].classList.add('w-6', 'bg-red-600');
                }
            }, 2000);
        }
    });
</script>