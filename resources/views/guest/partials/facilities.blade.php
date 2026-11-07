<!-- Programs & Facilities Section (Clean Light Theme with Red Accents) -->
<section id="facilities" class="py-24 bg-zinc-50 border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header with "OUR PROGRAMS" & "VIEW ALL PROGRAMS ->" -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-2 h-2 rounded-full bg-red-600"></span>
                    <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">OUR PROGRAMS</span>
                </div>
                <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-zinc-900 tracking-tight">
                    PROGRAM LATIHAN & <span class="text-red-600">FASILITAS GYM</span>
                </h2>
            </div>
            <div>
                <a href="#pricing" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-red-600 hover:text-red-700 transition-colors">
                    <span>VIEW ALL PROGRAMS</span>
                    <svg class="w-4 h-4 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- 4 Top Programs Grid with Real Fitness Photography -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            
            <!-- Program 1: Strength Training -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <!-- Program Image Header -->
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/programs/strength.jpg') }}"
                         alt="Strength Training"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <!-- Icon in Circle on Image -->
                    <div class="absolute bottom-3 left-4 w-10 h-10 rounded-lg bg-white/95 text-red-600 border border-zinc-200 shadow-md flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h3m12 0h3M5 6v12M19 6v12M3 18h3m12 0h3M7 10h10M7 14h10M7 7h2v10H7zm8 0h2v10h-2z" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 pt-4 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            STRENGTH TRAINING
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed mb-4">
                            Build muscle and progressive strength with compound lifts, olympic barbells, squat racks, and heavy benches.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-zinc-100">
                        <a href="#cara-daftar" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase text-red-600 group-hover:underline">
                            <span>LEARN MORE</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Program 2: Weight Loss -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/programs/weightloss.jpg') }}"
                         alt="Weight Loss"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-4 w-10 h-10 rounded-lg bg-white/95 text-red-600 border border-zinc-200 shadow-md flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 pt-4 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            WEIGHT LOSS
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed mb-4">
                            Effective HIIT workouts, metabolic conditioning, and cardio programs designed to burn stubborn calories fast.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-zinc-100">
                        <a href="#cara-daftar" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase text-red-600 group-hover:underline">
                            <span>LEARN MORE</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Program 3: Muscle Building -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/programs/muscle.jpg') }}"
                         alt="Muscle Building"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-4 w-10 h-10 rounded-lg bg-white/95 text-red-600 border border-zinc-200 shadow-md flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 pt-4 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            MUSCLE BUILDING
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed mb-4">
                            Targeted hypertrophy routines with plate-loaded machines, cable stations, and isolation form exercises.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-zinc-100">
                        <a href="#cara-daftar" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase text-red-600 group-hover:underline">
                            <span>LEARN MORE</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Program 4: Yoga & Flexibility -->
            <div class="group relative rounded-2xl bg-white border border-zinc-200 hover:border-red-500/60 overflow-hidden flex flex-col justify-between transition-all duration-300 hover:-translate-y-1.5 shadow-sm hover:shadow-xl">
                <div class="relative h-52 overflow-hidden">
                    <img src="{{ asset('images/programs/flexibility.jpg') }}"
                         alt="Yoga and Flexibility"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 filter brightness-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-3 left-4 w-10 h-10 rounded-lg bg-white/95 text-red-600 border border-zinc-200 shadow-md flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        </svg>
                    </div>
                </div>

                <div class="p-6 pt-4 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2 group-hover:text-red-600 transition-colors">
                            YOGA & FLEXIBILITY
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed mb-4">
                            Improve joint mobility, posture, core stability, and athletic stamina with functional stretching routines.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-zinc-100">
                        <a href="#cara-daftar" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase text-red-600 group-hover:underline">
                            <span>LEARN MORE</span>
                            <span class="text-sm">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- 8 Detailed Facilities Grid -->
        <div class="pt-10 border-t border-zinc-200">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-red-600 bg-red-50 px-3.5 py-1.5 rounded-full border border-red-200">
                    FASILITAS LENGKAP MACO GYM
                </span>
                <h3 class="font-montserrat text-2xl sm:text-3xl font-bold uppercase text-zinc-900 mt-3">
                    STANDAR PERALATAN & KENYAMANAN TERBAIK
                </h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Fac 1 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Free Weights Zone</div>
                    <p class="text-xs text-zinc-600">Dumbbell 1kg - 50kg lengkap, Olympic Barbells, Incline/Flat Bench, dan Squat Racks kokoh.</p>
                </div>

                <!-- Fac 2 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Plate-Loaded Machines</div>
                    <p class="text-xs text-zinc-600">Smith Machine, Hack Squat, Leg Press, Lat Pulldown, dan Cable Crossover dengan biomekanik presisi.</p>
                </div>

                <!-- Fac 3 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Cardio Theater</div>
                    <p class="text-xs text-zinc-600">Treadmill auto-incline, Elliptical Trainer, Spinning Bike, dan Stairmaster dengan monitor detak jantung.</p>
                </div>

                <!-- Fac 4 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Functional Zone</div>
                    <p class="text-xs text-zinc-600">Kettlebells, Battle Ropes, Plyometric Boxes, Slam Balls, dan Monkey Bar untuk melatih stamina.</p>
                </div>

                <!-- Fac 5 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Locker & Shower Hangat</div>
                    <p class="text-xs text-zinc-600">Loker berkunci aman, shower air hangat bersih, wastafel higienis, dan cermin luas.</p>
                </div>

                <!-- Fac 6 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Musholla Ber-AC</div>
                    <p class="text-xs text-zinc-600">Tempat ibadah tenang, sejuk, dan wudhu bersih di dalam gym agar ibadah tetap tepat waktu.</p>
                </div>

                <!-- Fac 7 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Protein & Supplement Bar</div>
                    <p class="text-xs text-zinc-600">Sedia Whey Protein shaker segar, pre-workout, BCAA, snack sehat berprotein, dan air dingin.</p>
                </div>

                <!-- Fac 8 -->
                <div class="p-5 rounded-xl bg-white border border-zinc-200 hover:border-red-300 transition-all shadow-xs hover:shadow-md">
                    <div class="text-red-600 font-bold text-sm mb-1.5">Full AC & High Sound</div>
                    <p class="text-xs text-zinc-600">Sirkulasi udara sejuk berpendingin AC bebas apek dengan dentuman musik workout pemacu semangat.</p>
                </div>

            </div>
        </div>

    </div>
</section>