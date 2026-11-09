@extends('layouts.member')

@section('title', 'Kartu Member - Maco Gym Malang')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto" x-data="{ showBarcodeFullscreen: false }">

    <!-- 1. Header Profil Member & Tanggal Bergabung -->
    <div class="bg-white dark:bg-[#12151b] rounded-2xl border border-zinc-200 dark:border-zinc-800 p-5 sm:p-7 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-red-600 to-red-800 text-white flex items-center justify-center font-montserrat font-black text-2xl uppercase shadow-md shadow-red-600/30 shrink-0">
                    {{ substr($member->name, 0, 1) }}
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="font-montserrat font-extrabold text-xl sm:text-2xl text-zinc-900 dark:text-white uppercase tracking-tight">
                            {{ $member->name }}
                        </h2>
                        <!-- Status Keaktifan Badge -->
                        @if($isExpired)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-red-100 text-red-800 dark:bg-red-950/60 dark:text-red-400 border border-red-200 dark:border-red-900/60 uppercase">
                                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                KADALUARSA
                            </span>
                        @elseif($daysRemaining <= 3)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 border border-amber-200 dark:border-amber-900/60 uppercase">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                HAMPIR HABIS
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-900/60 uppercase">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                STATUS AKTIF
                            </span>
                        @endif
                    </div>

                    <!-- Tanggal Mulai Bergabung -->
                    <div class="flex flex-wrap items-center gap-3 text-xs text-zinc-500 dark:text-zinc-400 mt-1.5 font-medium">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Mulai Bergabung: <strong class="text-zinc-800 dark:text-zinc-200">{{ $member->created_at ? $member->created_at->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}</strong>
                        </span>
                        <span>•</span>
                        <span class="font-mono text-zinc-700 dark:text-zinc-300">ID: {{ $member->card_id }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Button Scan Barcode -->
            <button @click="showBarcodeFullscreen = true"
                    type="button"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-zinc-900 hover:bg-red-600 dark:bg-zinc-800 dark:hover:bg-red-600 text-white text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow-sm cursor-pointer shrink-0">
                <svg class="w-4 h-4 text-red-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
                <span>Buka Barcode Kartu</span>
            </button>
        </div>
    </div>

    <!-- 2. Grid Tiga Kartu: Sisa Keaktifan, Tanggal Habis Tempo, & Kunjungan Per Bulan -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        
        <!-- Card 1: Sisa Keaktifan -->
        <div class="p-6 rounded-2xl border transition-all
            {{ $isExpired 
                ? 'bg-red-50/70 dark:bg-red-950/20 border-red-200 dark:border-red-900/40 border-t-4 border-t-red-600' 
                : ($daysRemaining <= 3 
                    ? 'bg-amber-50/70 dark:bg-amber-950/20 border-amber-200 dark:border-amber-900/40 border-t-4 border-t-amber-500' 
                    : 'bg-white dark:bg-[#12151b] border-zinc-200 dark:border-zinc-800 border-t-4 border-t-emerald-500') }}">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                    Sisa Masa Aktif
                </span>
                <span class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-xs
                    {{ $isExpired 
                        ? 'bg-red-100 text-red-600 dark:bg-red-900/40' 
                        : ($daysRemaining <= 3 ? 'bg-amber-100 text-amber-600 dark:bg-amber-900/40' : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40') }}">
                    ⏳
                </span>
            </div>
            
            <div class="mt-3">
                @if($isExpired)
                    <h3 class="text-3xl sm:text-4xl font-black font-montserrat text-red-600 dark:text-red-400">
                        0 <span class="text-base font-bold text-zinc-500">Hari</span>
                    </h3>
                    <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-1">
                        Masa aktif berakhir. Perpanjang paket ke kasir.
                    </p>
                @else
                    <h3 class="text-3xl sm:text-4xl font-black font-montserrat
                        {{ $daysRemaining <= 3 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                        {{ $daysRemaining }} <span class="text-base font-bold text-zinc-500">Hari Lagi</span>
                    </h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium mt-1">
                        {{ $daysRemaining <= 3 ? 'Peringatan: Segera perpanjang masa aktif!' : 'Membership aktif & siap berlatih.' }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Card 2: Tanggal Habis Tempo (Expired Date) -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#12151b] border border-zinc-200 dark:border-zinc-800 border-t-4 border-t-zinc-900 dark:border-t-zinc-100">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                    Jatuh Tempo (Expired)
                </span>
                <span class="w-8 h-8 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 flex items-center justify-center font-bold text-xs">
                    📅
                </span>
            </div>

            <div class="mt-3">
                <h3 class="text-2xl sm:text-3xl font-black font-montserrat text-zinc-900 dark:text-white">
                    {{ $expiryDate->translatedFormat('d M Y') }}
                </h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium mt-1">
                    Batas akhir akses gym Maco Gym Malang
                </p>
            </div>
        </div>

        <!-- Card 3: Kunjungan Per Bulan -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#12151b] border border-zinc-200 dark:border-zinc-800 border-t-4 border-t-blue-600">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                    Kunjungan Bulan Ini
                </span>
                <span class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xs border border-blue-200 dark:border-blue-900/60">
                    🏋️
                </span>
            </div>

            <div class="mt-3">
                <h3 class="text-3xl sm:text-4xl font-black font-montserrat text-zinc-900 dark:text-white">
                    {{ $monthlyVisits }} <span class="text-base font-bold text-zinc-500">Sesi</span>
                </h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium mt-1">
                    Total kehadiran pada bulan {{ now()->translatedFormat('F Y') }}
                </p>
            </div>
        </div>

    </div>

    <!-- 3. Kartu Member Fisik/Digital dengan Fitur Barcode Otomatis -->
    <div class="bg-gradient-to-br from-zinc-900 via-zinc-950 to-black rounded-3xl p-6 sm:p-8 text-white border border-zinc-800 shadow-xl relative overflow-hidden">
        <!-- Background decorative watermark -->
        <div class="absolute -right-8 -bottom-8 opacity-10 pointer-events-none select-none font-montserrat font-black text-9xl uppercase tracking-tighter">
            MACO
        </div>

        <div class="relative z-10 space-y-6">
            <!-- Card Header -->
            <div class="flex items-center justify-between border-b border-zinc-800/80 pb-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo/macogym.jpg') }}"
                         alt="Maco Gym"
                         class="h-10 w-auto rounded-lg border border-zinc-700 object-contain">
                    <div>
                        <span class="font-montserrat font-black text-lg tracking-wider text-white uppercase leading-none block">
                            MACO<span class="text-red-600">GYM</span>
                        </span>
                        <span class="text-[9px] font-mono tracking-widest text-zinc-400 uppercase font-bold">
                            MALANG FITNESS CLUB
                        </span>
                    </div>
                </div>

                <!-- Chip Simulation -->
                <div class="w-11 h-8 rounded-md bg-gradient-to-tr from-amber-400 via-amber-200 to-amber-500 p-1 flex items-center justify-center shadow-xs">
                    <div class="w-full h-full border border-amber-600/40 rounded flex items-center justify-center">
                        <span class="text-[8px] font-mono font-bold text-amber-900">CHIP</span>
                    </div>
                </div>
            </div>

            <!-- Member Info on Card -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <span class="text-[10px] font-mono uppercase tracking-wider text-zinc-400">Nama Lengkap Member</span>
                    <h4 class="font-montserrat font-black text-xl text-white uppercase mt-0.5 tracking-wide">
                        {{ $member->name }}
                    </h4>
                </div>
                <div>
                    <span class="text-[10px] font-mono uppercase tracking-wider text-zinc-400">ID Kartu / Card UID</span>
                    <p class="font-mono font-bold text-lg text-red-500 tracking-wider mt-0.5">
                        {{ $member->card_id }}
                    </p>
                </div>
            </div>

            <!-- BARCODE & QR CODE SECTION -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 text-zinc-900 flex flex-col sm:flex-row items-center justify-between gap-5 shadow-inner">
                
                <!-- Barcode SVG Container -->
                <div class="flex-1 w-full text-center sm:text-left flex flex-col items-center sm:items-start">
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 mb-1 block">
                        Barcode Kartu (Tunjukkan ke Kasir)
                    </span>
                    <svg id="member-barcode" class="w-full max-w-[280px] h-16 mx-auto sm:mx-0"></svg>
                </div>

                <!-- QR Code Alternative -->
                <div class="shrink-0 flex flex-col items-center border-t sm:border-t-0 sm:border-l border-zinc-200 pt-3 sm:pt-0 sm:pl-5">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=110x110&data={{ urlencode($member->card_id) }}"
                         alt="QR Code Member"
                         class="w-20 h-20 rounded-lg border border-zinc-200">
                    <span class="text-[9px] font-mono font-bold text-zinc-500 mt-1 uppercase">QR Scan</span>
                </div>
            </div>

            <!-- Action: Fullscreen Modal Trigger -->
            <div class="flex items-center justify-between pt-1">
                <span class="text-xs text-zinc-400 font-mono">
                    * Tempelkan kartu fisik atau scan barcode di atas pada scanner resepsionis.
                </span>
                <button @click="showBarcodeFullscreen = true"
                        type="button"
                        class="text-xs font-mono font-bold text-red-400 hover:text-red-300 underline cursor-pointer">
                    Perbesar Barcode &rarr;
                </button>
            </div>
        </div>
    </div>

    <!-- 4. Log Riwayat Kunjungan Member -->
    <div class="bg-white dark:bg-[#12151b] rounded-2xl border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-xs">
        <div class="p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded bg-red-600"></span>
                <div>
                    <h3 class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-900 dark:text-white">
                        Log Riwayat Kunjungan Saya
                    </h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                        Catatan riwayat presensi check-in latihan di Maco Gym Malang
                    </p>
                </div>
            </div>
            <span class="text-xs font-mono font-bold text-zinc-500 dark:text-zinc-400">
                {{ count($recentAttendances) }} Kunjungan Terakhir
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-[10px] uppercase font-mono tracking-wider text-zinc-500 dark:text-zinc-400 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3">Tanggal & Hari</th>
                        <th class="px-4 sm:px-6 py-3">Waktu Presensi</th>
                        <th class="px-4 sm:px-6 py-3">Status / Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800 font-mono text-xs">
                    @forelse($recentAttendances as $att)
                    <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition">
                        <td class="px-4 sm:px-6 py-3 text-zinc-900 dark:text-white font-sans font-semibold">
                            {{ $att->checkin_time->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 text-red-600 dark:text-red-400 font-bold">
                            {{ $att->checkin_time->format('H:i') }} WIB
                        </td>
                        <td class="px-4 sm:px-6 py-3">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/60">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                {{ $att->notes ?? 'Presensi Berhasil' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-xs text-zinc-400 font-sans">
                            Belum ada riwayat kunjungan yang tercatat. Silakan tap kartu di resepsionis saat datang!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 5. Modal Barcode Layar Penuh (Untuk Memudahkan Scan di HP saat di Meja Kasir) -->
    <div x-cloak x-show="showBarcodeFullscreen"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-md"
         @keydown.escape.window="showBarcodeFullscreen = false">
        
        <div class="relative w-full max-w-sm bg-white rounded-3xl p-6 sm:p-8 text-zinc-900 shadow-2xl text-center"
             @click.away="showBarcodeFullscreen = false">
            
            <button @click="showBarcodeFullscreen = false"
                    type="button"
                    class="absolute top-4 right-4 text-zinc-400 hover:text-zinc-800 p-1.5 rounded-full hover:bg-zinc-100 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 text-red-700 text-[10px] font-mono font-bold uppercase mb-2">
                Barcode Check-in Kasir
            </span>

            <h3 class="font-montserrat font-black text-xl text-zinc-950 uppercase">
                {{ $member->name }}
            </h3>
            <p class="font-mono font-bold text-xs text-zinc-500 mb-5">
                ID: {{ $member->card_id }}
            </p>

            <!-- Big Barcode in Modal -->
            <div class="bg-white p-3 border-2 border-zinc-900 rounded-xl mb-4">
                <svg id="member-barcode-modal" class="w-full h-24 mx-auto"></svg>
            </div>

            <!-- Big QR in Modal -->
            <div class="p-3 bg-zinc-50 border border-zinc-200 rounded-xl flex items-center justify-center mb-5">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode($member->card_id) }}"
                     alt="QR Fullscreen"
                     class="w-36 h-36 rounded-md">
            </div>

            <button @click="showBarcodeFullscreen = false"
                    type="button"
                    class="w-full py-2.5 bg-zinc-900 hover:bg-zinc-800 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-xl transition cursor-pointer">
                Tutup Tampilan Barcode
            </button>
        </div>
    </div>

</div>

<!-- Inisialisasi JsBarcode Otomatis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cardId = @json($member->card_id);

    // Render Barcode di Card Utama
    if (typeof JsBarcode !== 'undefined' && document.getElementById('member-barcode')) {
        JsBarcode("#member-barcode", cardId, {
            format: "CODE128",
            width: 2.0,
            height: 55,
            displayValue: true,
            font: "monospace",
            fontSize: 13,
            textMargin: 3,
            lineColor: "#000000"
        });
    }

    // Render Barcode di Modal Pop-up
    if (typeof JsBarcode !== 'undefined' && document.getElementById('member-barcode-modal')) {
        JsBarcode("#member-barcode-modal", cardId, {
            format: "CODE128",
            width: 2.2,
            height: 70,
            displayValue: true,
            font: "monospace",
            fontSize: 14,
            textMargin: 4,
            lineColor: "#000000"
        });
    }
});
</script>
@endsection
