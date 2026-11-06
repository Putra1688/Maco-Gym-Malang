<!-- Cara Daftar Section -->
<section id="cara-daftar" class="py-24 bg-zinc-950 relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute bottom-0 right-0 w-[500px] h-[300px] bg-amber-500/10 blur-[130px] pointer-events-none rounded-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-wider">
                Proses Mudah & Cepat
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white uppercase tracking-tight">
                Cara Daftar Member <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-yellow-300">Maco Gym</span>
            </h2>
            <p class="text-zinc-400 text-sm sm:text-base leading-relaxed">
                Hanya butuh 4 langkah mudah untuk mulai bergabung. Daftar online sekarang atau datang langsung ke resepsionis kami.
            </p>
        </div>

        <!-- 4 Step Process Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            
            <!-- Step 1 -->
            <div class="relative bg-zinc-900/80 border border-zinc-800 rounded-2xl p-6 flex flex-col justify-between hover:border-amber-400/50 transition-colors">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-400 text-zinc-950 font-black text-xl flex items-center justify-center mb-5 shadow-lg shadow-amber-500/20">
                        01
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Pilih Paket Membership</h3>
                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">
                        Tentukan pilihan paket: Bulanan Reguler, Promo Mahasiswa (KTM), atau Personal Trainer sesuai kebutuhan fisikmu.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-800 text-[11px] font-semibold text-amber-400">
                    Langkah 1: Menentukan Tujuan
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative bg-zinc-900/80 border border-zinc-800 rounded-2xl p-6 flex flex-col justify-between hover:border-amber-400/50 transition-colors">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-400 text-zinc-950 font-black text-xl flex items-center justify-center mb-5 shadow-lg shadow-amber-500/20">
                        02
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Isi Data Pendaftaran</h3>
                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">
                        Lengkapi form pendaftaran online di bawah atau hubungi admin WhatsApp untuk verifikasi cepat.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-800 text-[11px] font-semibold text-amber-400">
                    Langkah 2: Registrasi Identitas
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative bg-zinc-900/80 border border-zinc-800 rounded-2xl p-6 flex flex-col justify-between hover:border-amber-400/50 transition-colors">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-400 text-zinc-950 font-black text-xl flex items-center justify-center mb-5 shadow-lg shadow-amber-500/20">
                        03
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Konfirmasi & Pembayaran</h3>
                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">
                        Pembayaran sangat praktis via QRIS (semua e-wallet/m-banking), transfer bank, atau tunai di meja kasir gym.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-800 text-[11px] font-semibold text-amber-400">
                    Langkah 3: Transaksi Aman
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative bg-zinc-900/80 border border-zinc-800 rounded-2xl p-6 flex flex-col justify-between hover:border-amber-400/50 transition-colors">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-500 text-zinc-950 font-black text-xl flex items-center justify-center mb-5 shadow-lg shadow-emerald-500/20">
                        04
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Aktivasi & Mulai Latihan</h3>
                    <p class="text-xs sm:text-sm text-zinc-400 leading-relaxed">
                        Akun member langsung aktif! Dapatkan orientasi alat dari staff kami dan mulailah sesi latihan pertamamu.
                    </p>
                </div>
                <div class="mt-4 pt-3 border-t border-zinc-800 text-[11px] font-semibold text-emerald-400">
                    Langkah 4: Ready to Workout!
                </div>
            </div>

        </div>

        <!-- Interactive Direct Registration Form Box -->
        <div class="max-w-3xl mx-auto rounded-3xl bg-gradient-to-b from-zinc-900 to-zinc-950 border border-zinc-800 p-6 sm:p-10 shadow-2xl">
            <div class="text-center mb-8 space-y-2">
                <span class="inline-block text-xs font-bold uppercase tracking-wider text-amber-400 bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">
                    Formulir Registrasi Cepat
                </span>
                <h3 class="text-2xl sm:text-3xl font-black text-white">Daftarkan Dirimu Sekarang</h3>
                <p class="text-xs sm:text-sm text-zinc-400">
                    Isi data singkat berikut. Kamu akan otomatis terhubung ke WhatsApp Admin Maco Gym untuk konfirmasi pendaftaran.
                </p>
            </div>

            <form id="registration-form" onsubmit="submitRegistration(event)" class="space-y-5">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Name Input -->
                    <div>
                        <label for="member_name" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">
                            Nama Lengkap <span class="text-amber-400">*</span>
                        </label>
                        <input type="text"
                               id="member_name"
                               required
                               placeholder="Contoh: Rangga Dwi Saputra"
                               class="w-full bg-zinc-950 border border-zinc-700/80 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition-colors">
                    </div>

                    <!-- WhatsApp Input -->
                    <div>
                        <label for="member_phone" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">
                            Nomor WhatsApp <span class="text-amber-400">*</span>
                        </label>
                        <input type="tel"
                               id="member_phone"
                               required
                               placeholder="Contoh: 081234567890"
                               class="w-full bg-zinc-950 border border-zinc-700/80 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition-colors">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Package Selection -->
                    <div>
                        <label for="selected_package" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">
                            Pilihan Paket Membership <span class="text-amber-400">*</span>
                        </label>
                        <select id="selected_package"
                                required
                                class="w-full bg-zinc-950 border border-zinc-700/80 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition-colors">
                            <option value="1 Bulan Reguler (Rp 175.000)">1 Bulan Reguler - Rp 175.000</option>
                            <option value="3 Bulan Hemat (Rp 450.000)" selected>3 Bulan Hemat - Rp 450.000 (Paling Populer)</option>
                            <option value="1 Bulan Mahasiswa (Rp 135.000)">1 Bulan Mahasiswa - Rp 135.000 (Wajib KTM)</option>
                            <option value="3 Bulan Mahasiswa (Rp 360.000)">3 Bulan Mahasiswa - Rp 360.000 (KTM)</option>
                            <option value="Personal Trainer 5 Sesi (Rp 600.000)">PT 5 Sesi Starter - Rp 600.000</option>
                            <option value="Personal Trainer 12 Sesi (Rp 1.250.000)">PT 12 Sesi Intensive - Rp 1.250.000</option>
                            <option value="Personal Trainer 24 Sesi (Rp 2.200.000)">PT 24 Sesi Elite - Rp 2.200.000</option>
                            <option value="Daily Pass Harian (Rp 25.000)">Daily Pass Harian - Rp 25.000</option>
                        </select>
                    </div>

                    <!-- Fitness Target -->
                    <div>
                        <label for="fitness_goal" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">
                            Target Kebugaran
                        </label>
                        <select id="fitness_goal"
                                class="w-full bg-zinc-950 border border-zinc-700/80 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition-colors">
                            <option value="Membentuk Otot & Tubuh Proporsional (Hypertrophy)">Membentuk Otot & Tubuh Proporsional</option>
                            <option value="Menurunkan Berat Badan / Lemak (Fat Loss)">Menurunkan Berat Badan / Fat Loss</option>
                            <option value="Kebugaran & Kesehatan Sehari-hari (General Fitness)">Kebugaran Sehari-hari</option>
                            <option value="Meningkatkan Kekuatan / Angkatan (Strength / Powerlifting)">Meningkatkan Kekuatan / Powerlifting</option>
                        </select>
                    </div>
                </div>

                <!-- Notes Input -->
                <div>
                    <label for="member_notes" class="block text-xs font-bold text-zinc-300 uppercase tracking-wider mb-2">
                        Catatan / Waktu Rencana Mulai (Opsional)
                    </label>
                    <textarea id="member_notes"
                              rows="2"
                              placeholder="Misal: Mahasiswa UB semester 4, rencana mulai latihan hari Senin sore..."
                              class="w-full bg-zinc-950 border border-zinc-700/80 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition-colors"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-4 px-6 rounded-xl font-black text-sm sm:text-base text-zinc-950 bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 hover:from-amber-300 hover:to-yellow-300 shadow-xl shadow-amber-500/25 transition-all flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Konfirmasi Pendaftaran via WhatsApp</span>
                    </button>
                    <p class="text-center text-[11px] text-zinc-500 mt-2">
                        Data kamu aman. Konfirmasi pendaftaran akan langsung dijawab oleh tim customer service Maco Gym Malang.
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
                        `Mohon info langkah konfirmasi dan nomor rekening/QRIS untuk pembayaran. Terima kasih!`;

        const waUrl = `https://wa.me/6281234567890?text=${message}`;
        window.open(waUrl, '_blank');
    }
</script>

