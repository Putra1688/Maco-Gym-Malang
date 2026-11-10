<!-- Testimonials Section (Clean Light Theme with Red Accents) -->
<section class="py-24 bg-zinc-50 border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="w-8 h-[2px] bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">TESTIMONIALS</span>
                <span class="w-8 h-[2px] bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-2xl sm:text-4xl font-bold uppercase text-zinc-900 tracking-tight">
                WHAT OUR MEMBERS SAY
            </h2>
        </div>

        <!-- 3 Testimonial Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Review 1 -->
            <div class="rounded-2xl bg-white border border-zinc-200 hover:border-red-400 p-6 flex flex-col justify-between shadow-sm hover:shadow-lg transition-all">
                <div class="space-y-4">
                    <!-- Stars -->
                    <div class="flex items-center gap-1 text-red-500 text-sm">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <!-- Quote -->
                    <p class="text-xs sm:text-sm text-zinc-700 italic leading-relaxed">
                        "Maco Gym changed my fitness life! Tempatnya bersih, alatnya lengkap standar internasional, dan suasananya sangat mendukung buat pemula maupun yang sudah pro."
                    </p>
                </div>
                <!-- Member Info with Real Photo Avatar -->
                <div class="mt-6 pt-4 border-t border-zinc-100 flex items-center gap-3.5">
                    <img src="{{ asset('images/testimonials/jason.jpg') }}"
                         alt="Jason R."
                         class="w-11 h-11 rounded-full object-cover border-2 border-red-500 shrink-0 shadow-sm">
                    <div>
                        <div class="text-xs font-bold text-zinc-900">- Jason R.</div>
                        <div class="text-[10px] text-zinc-500">Mahasiswa UB & Member 1 Tahun</div>
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="rounded-2xl bg-white border border-zinc-200 hover:border-red-400 p-6 flex flex-col justify-between shadow-sm hover:shadow-lg transition-all">
                <div class="space-y-4">
                    <div class="flex items-center gap-1 text-red-500 text-sm">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="text-xs sm:text-sm text-zinc-700 italic leading-relaxed">
                        "Paket mahasiswanya benar-benar terjangkau di kantong. Ditambah fasilitas shower air hangat dan loker yang aman bikin nyaman latihan tiap sore sepulang kuliah."
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-zinc-100 flex items-center gap-3.5">
                    <img src="{{ asset('images/testimonials/sarah.jpg') }}"
                         alt="Sarah M."
                         class="w-11 h-11 rounded-full object-cover border-2 border-red-500 shrink-0 shadow-sm">
                    <div>
                        <div class="text-xs font-bold text-zinc-900">- Sarah M.</div>
                        <div class="text-[10px] text-zinc-500">Mahasiswi Polinema Malang</div>
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="rounded-2xl bg-white border border-zinc-200 hover:border-red-400 p-6 flex flex-col justify-between shadow-sm hover:shadow-lg transition-all">
                <div class="space-y-4">
                    <div class="flex items-center gap-1 text-red-500 text-sm">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <p class="text-xs sm:text-sm text-zinc-700 italic leading-relaxed">
                        "Best gym in Malang! Coach-coachnya ramah dan tidak pelit ilmu. Program Personal Trainer 12 sesinya berhasil bantu saya turun 9 kg dan bentuk otot."
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-zinc-100 flex items-center gap-3.5">
                    <img src="{{ asset('images/testimonials/michael.jpg') }}"
                         alt="Michael T."
                         class="w-11 h-11 rounded-full object-cover border-2 border-red-500 shrink-0 shadow-sm">
                    <div>
                        <div class="text-xs font-bold text-zinc-900">- Michael T.</div>
                        <div class="text-[10px] text-zinc-500">Entrepreneur & Powerlifter</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>