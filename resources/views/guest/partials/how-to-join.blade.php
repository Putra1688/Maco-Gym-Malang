<!-- Cara Daftar Section (Clean Light Theme with Red Accents) -->
<section id="cara-daftar" class="py-24 bg-white border-t border-zinc-200 relative">
    <div class="w-full max-w-[1720px] mx-auto px-4 sm:px-8 lg:px-12">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <div class="flex items-center justify-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                <span class="tagline text-xs font-bold uppercase tracking-[0.2em] text-red-600 font-montserrat">SCHEDULE & JOINING</span>
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
            </div>
            <h2 class="font-montserrat text-3xl sm:text-5xl font-bold uppercase text-zinc-900 tracking-tight">
                CARA DAFTAR MEMBER <span class="text-red-600">MACO GYM</span>
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600">
                4 langkah cepat untuk memulai sesi latihan pertamamu. Daftar online atau kunjungi resepsionis kami.
            </p>
        </div>

        <!-- 4 Step Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            
            <!-- Step 1 -->
            <div class="rounded-2xl bg-zinc-50 border border-zinc-200 p-6 flex flex-col justify-between hover:border-red-400 transition-all shadow-xs hover:shadow-md">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-bold text-xl flex items-center justify-center mb-5 shadow-md shadow-red-600/20">
                        01
                    </div>
                    <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2">PILIH PAKET</h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        Tentukan pilihan paket: Bulanan Reguler, Promo Mahasiswa (KTM), atau Personal Trainer sesuai kebutuhan fisikmu.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-200 text-[10px] font-bold text-red-600 uppercase tracking-wider">
                    Step 1: Goal Setting
                </div>
            </div>

            <!-- Step 2 -->
            <div class="rounded-2xl bg-zinc-50 border border-zinc-200 p-6 flex flex-col justify-between hover:border-red-400 transition-all shadow-xs hover:shadow-md">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-bold text-xl flex items-center justify-center mb-5 shadow-md shadow-red-600/20">
                        02
                    </div>
                    <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2">ISI FORMULIR</h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        Lengkapi formulir pendaftaran singkat di bawah atau hubungi admin WhatsApp untuk verifikasi kilat.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-200 text-[10px] font-bold text-red-600 uppercase tracking-wider">
                    Step 2: Quick Register
                </div>
            </div>

            <!-- Step 3 -->
            <div class="rounded-2xl bg-zinc-50 border border-zinc-200 p-6 flex flex-col justify-between hover:border-red-400 transition-all shadow-xs hover:shadow-md">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-bold text-xl flex items-center justify-center mb-5 shadow-md shadow-red-600/20">
                        03
                    </div>
                    <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2">PEMBAYARAN</h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        Pembayaran praktis via QRIS (BCA, Mandiri, BRI, Gopay, OVO, ShopeePay) atau tunai di kasir gym.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-200 text-[10px] font-bold text-red-600 uppercase tracking-wider">
                    Step 3: Secure Payment
                </div>
            </div>

            <!-- Step 4 -->
            <div class="rounded-2xl bg-zinc-50 border border-zinc-200 p-6 flex flex-col justify-between hover:border-red-400 transition-all shadow-xs hover:shadow-md">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-red-600 text-white font-bold text-xl flex items-center justify-center mb-5 shadow-md shadow-red-600/20">
                        04
                    </div>
                    <h3 class="font-montserrat text-base font-bold uppercase text-zinc-900 mb-2">MULAI LATIHAN</h3>
                    <p class="text-xs text-zinc-600 leading-relaxed">
                        Member langsung aktif! Dapatkan panduan alat dari tim instruktur dan mulailah sesi latihan pertamamu.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-200 text-[10px] font-bold text-red-600 uppercase tracking-wider">
                    Step 4: Workout Ready
                </div>
            </div>

        </div>

        <!-- Interactive Direct Registration Form Box -->
        <div class="max-w-4xl mx-auto rounded-2xl bg-zinc-50 border border-zinc-200 p-6 sm:p-10 shadow-lg">
            <div class="text-center mb-8 space-y-2">
                <span class="inline-block text-[10px] font-bold uppercase tracking-[0.2em] text-red-600 bg-red-100 px-3 py-1 rounded border border-red-200">
                    ONLINE REGISTRATION
                </span>
                <h3 class="font-montserrat text-2xl sm:text-3xl font-bold uppercase text-zinc-900">DAFTARKAN DIRIMU SEKARANG</h3>
                <p class="text-xs text-zinc-600">
                    Data kamu akan otomatis terhubung ke WhatsApp Admin Maco Gym Malang untuk proses verifikasi instan.
                </p>
            </div>

            <form id="registration-form" onsubmit="submitRegistration(event)" class="space-y-5">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="member_name" class="block text-[11px] font-bold uppercase tracking-wider text-zinc-800 mb-2">
                            Nama Lengkap <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               id="member_name"
                               required
                               placeholder="Nama lengkap kamu"
                               class="w-full bg-white border border-zinc-300 rounded-md px-4 py-3 text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 shadow-xs transition-colors">
                    </div>

                    <div>
                        <label for="member_phone" class="block text-[11px] font-bold uppercase tracking-wider text-zinc-800 mb-2">
                            Nomor WhatsApp <span class="text-red-600">*</span>
                        </label>
                        <input type="tel"
                               id="member_phone"
                               required
                               placeholder="081234567890"
                               class="w-full bg-white border border-zinc-300 rounded-md px-4 py-3 text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 shadow-xs transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="selected_package" class="block text-[11px] font-bold uppercase tracking-wider text-zinc-800 mb-2">
                            Pilihan Paket Membership <span class="text-red-600">*</span>
                        </label>
                        <select id="selected_package"
                                required
                                class="w-full bg-white border border-zinc-300 rounded-md px-4 py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 shadow-xs transition-colors">
                            <option value="1 Bulan Reguler (Rp 175.000)">1 Bulan Reguler - Rp 175.000</option>
                            <option value="3 Bulan Hemat (Rp 450.000)" selected>3 Bulan Hemat - Rp 450.000 (Popular)</option>
                            <option value="1 Bulan Mahasiswa (Rp 135.000)">1 Bulan Mahasiswa - Rp 135.000 (KTM)</option>
                            <option value="3 Bulan Mahasiswa (Rp 360.000)">3 Bulan Mahasiswa - Rp 360.000 (KTM)</option>
                            <option value="Personal Trainer 5 Sesi (Rp 600.000)">PT 5 Sesi Starter - Rp 600.000</option>
                            <option value="Personal Trainer 12 Sesi (Rp 1.250.000)">PT 12 Sesi Intensive - Rp 1.250.000</option>
                            <option value="Personal Trainer 24 Sesi (Rp 2.200.000)">PT 24 Sesi Elite - Rp 2.200.000</option>
                            <option value="Daily Pass Harian (Rp 25.000)">Daily Pass Harian - Rp 25.000</option>
                        </select>
                    </div>

                    <div>
                        <label for="fitness_goal" class="block text-[11px] font-bold uppercase tracking-wider text-zinc-800 mb-2">
                            Target Kebugaran
                        </label>
                        <select id="fitness_goal"
                                class="w-full bg-white border border-zinc-300 rounded-md px-4 py-3 text-xs sm:text-sm text-zinc-900 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 shadow-xs transition-colors">
                            <option value="Muscle Building / Hypertrophy">Membentuk Otot & Tubuh Proporsional</option>
                            <option value="Weight Loss / Fat Burn">Menurunkan Berat Badan / Fat Loss</option>
                            <option value="General Fitness & Stamina">Kebugaran & Kesehatan Sehari-hari</option>
                            <option value="Strength & Powerlifting">Meningkatkan Kekuatan / Powerlifting</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="member_notes" class="block text-[11px] font-bold uppercase tracking-wider text-zinc-800 mb-2">
                        Catatan / Waktu Rencana Mulai (Opsional)
                    </label>
                    <textarea id="member_notes"
                              rows="2"
                              placeholder="Misal: Mahasiswa UB semester 4, rencana mulai latihan hari Senin..."
                              class="w-full bg-white border border-zinc-300 rounded-md px-4 py-3 text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 shadow-xs transition-colors"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-4 px-6 rounded-md font-bold text-xs sm:text-sm uppercase tracking-wider text-white bg-red-600 hover:bg-red-700 shadow-xl shadow-red-600/25 transition-all flex items-center justify-center gap-2">
                        <span>KIRIM PENDAFTARAN VIA WHATSAPP</span>
                        <svg class="w-4 h-4 font-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                    <p class="text-center text-[10px] text-zinc-500 mt-2">
                        Konfirmasi pembayaran dan barcode member akan dipandu oleh CS Maco Gym Malang.
                    </p>
                </div>

            </form>
        </div>

    </div>
</section>

<!-- Registration Submission JS -->
<script>
    function submitRegistration(event) {
        event.preventDefault();
        
        const name = document.getElementById('member_name').value.trim();
        const phone = document.getElementById('member_phone').value.trim();
        const selectedPackage = document.getElementById('selected_package').value;
        const goal = document.getElementById('fitness_goal').value;
        const notes = document.getElementById('member_notes').value.trim();

        const message = `Halo Admin Maco Gym Malang, saya ingin mendaftar membership:%0A%0A` +
                        `• *Nama:* ${encodeURIComponent(name)}%0A` +
                        `• *No. WhatsApp:* ${encodeURIComponent(phone)}%0A` +
                        `• *Pilihan Paket:* ${encodeURIComponent(selectedPackage)}%0A` +
                        `• *Target Fitness:* ${encodeURIComponent(goal)}%0A` +
                        (notes ? `• *Catatan:* ${encodeURIComponent(notes)}%0A%0A` : `%0A`) +
                        `Mohon info langkah konfirmasi pembayaran. Terima kasih!`;

        const waUrl = `https://wa.me/6281250207403?text=${message}`;
        window.open(waUrl, '_blank');
    }
</script>