<!-- Programs Section (Clean Light Theme with Red Accents) -->
<section id="facilities" class="py-24 bg-zinc-50 border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header: Centered & Clean Title -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <div class="flex items-center justify-center gap-3 mb-1">
                <span class="w-8 h-[2px] bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">OUR PROGRAMS</span>
                <span class="w-8 h-[2px] bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-zinc-900 tracking-tight">
                PROGRAM LATIHAN <span class="text-red-600">MACO GYM</span>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600 max-w-2xl mx-auto leading-relaxed">
                Dirancang untuk membantu setiap member mencapai target kebugaran secara konsisten, mulai dari pembentukan otot, penurunan berat badan, hingga pemulihan stamina.
            </p>
        </div>

        <!-- 4 Top Programs Grid (Clean Image & Text Only) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Program 1: Strength Training -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <!-- Clean Program Image (No Badge) -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('images/programs/strength.jpg') }}"
                         alt="Strength Training Maco Gym"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            STRENGTH TRAINING
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed font-normal">
                            Fokus pada peningkatan kekuatan otot murni melalui gerakan angkat beban compound, barbel olimpiade, squat rack kokoh, dan bench press beban berat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Program 2: Weight Loss -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('images/programs/weightloss.jpg') }}"
                         alt="Weight Loss Program Maco Gym"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            WEIGHT LOSS
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed font-normal">
                            Kombinasi latihan interval berintensitas tinggi (HIIT) dan sirkuit kardio terstruktur untuk membakar kalori membandel sekaligus menjaga kebugaran jantung.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Program 3: Muscle Building -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('images/programs/muscle.jpg') }}"
                         alt="Muscle Building Maco Gym"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            MUSCLE BUILDING
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed font-normal">
                            Program hipertrofi pembentukan massa otot proporsional dengan mesin plate-loaded, cable station fleksibel, dan variasi latihan isolasi terarah.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Program 4: Yoga & Flexibility -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ asset('images/programs/flexibility.jpg') }}"
                         alt="Flexibility and Mobility Maco Gym"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            YOGA & FLEXIBILITY
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed font-normal">
                            Meningkatkan mobilitas sendi, elastisitas otot, kestabilan postur tubuh, serta pemulihan fisik setelah sesi latihan beban intensif.
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Central Action Button to Dedicated Facilities & Classes Page -->
        <div class="mt-14 text-center">
            <a href="{{ route('facilities.index') }}" 
               class="inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white font-montserrat font-bold text-xs uppercase tracking-wider shadow-lg shadow-red-600/30 hover:shadow-red-600/40 transition-all duration-200 transform hover:-translate-y-0.5">
                <span>JELAJAHI FASILITAS & PROGRAM LENGKAP</span>
                <svg class="w-4 h-4 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
            <p class="text-[11px] text-zinc-500 mt-2.5 font-medium">
                Lihat detail 8 zona fasilitas gym, daftar program lengkap, dan jadwal bimbingan coach di Kota Malang.
            </p>
        </div>

    </div>
</section>
