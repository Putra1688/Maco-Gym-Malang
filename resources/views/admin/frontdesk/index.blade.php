@extends('layouts.admin')

@section('title', 'Frontdesk & Presensi Cepat')
@section('header', 'Frontdesk & Meja Kasir')

@section('content')
<div class="space-y-6" x-data="{ showGuestModal: false }">

    <!-- Header Ringkasan Kehadiran Hari Ini -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-zinc-900 p-5 rounded-lg border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Masuk Hari Ini</span>
                <h4 class="text-3xl font-black font-montserrat text-zinc-900 dark:text-white mt-1">{{ $todayStats['total'] }} <span class="text-xs font-normal text-zinc-400 font-sans">Orang</span></h4>
            </div>
            <div class="w-10 h-10 rounded bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-red-200 dark:border-red-900/60 font-mono">
                TOTAL
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 p-5 rounded-lg border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-blue-600 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Member Terdaftar</span>
                <h4 class="text-3xl font-black font-montserrat text-blue-600 dark:text-blue-400 mt-1">{{ $todayStats['member'] }} <span class="text-xs font-normal text-zinc-400 font-sans">Presensi</span></h4>
            </div>
            <div class="w-10 h-10 rounded bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-blue-200 dark:border-blue-900/60 font-mono">
                MBR
            </div>
        </div>
        <div class="bg-white dark:bg-zinc-900 p-5 rounded-lg border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-emerald-600 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Tamu Visit Harian</span>
                <h4 class="text-3xl font-black font-montserrat text-emerald-600 dark:text-emerald-400 mt-1">{{ $todayStats['guest'] }} <span class="text-xs font-normal text-zinc-400 font-sans">Tiket</span></h4>
            </div>
            <div class="w-10 h-10 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-emerald-200 dark:border-emerald-900/60 font-mono">
                TMU
            </div>
        </div>
    </div>

    <!-- Kotak Utama Presensi Cepat (Quick Check-in) & Aksi Meja Depan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Form Pencarian / Scan Barcode Member (PRD 3.2: 3 Detik) -->
        <div class="lg:col-span-2 bg-white dark:bg-zinc-900 rounded-lg p-5 sm:p-6 border border-zinc-200 dark:border-zinc-800 flex flex-col justify-between">
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4 pb-3 border-b border-zinc-100 dark:border-zinc-800">
                    <div>
                        <h3 class="text-sm sm:text-base font-montserrat font-bold uppercase tracking-wider text-zinc-900 dark:text-white">
                            Presensi Cepat Member (Scan / ID Kartu)
                        </h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Ketik ID Kartu (contoh: <code class="text-red-600 dark:text-red-400 font-mono font-bold">MC-001</code>) atau nomor WA, lalu tekan <kbd class="px-1.5 py-0.5 bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 rounded text-[10px] font-mono border border-zinc-200 dark:border-zinc-700">Enter</kbd></p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-mono font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/40 px-2.5 py-1 rounded border border-emerald-200 dark:border-emerald-900/60 self-start sm:self-auto">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        TERMINAL READY
                    </span>
                </div>

                <form action="{{ route('admin.frontdesk.checkin') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="relative">
                        <input type="text"
                               name="search"
                               placeholder="Ketik ID Kartu atau Nama Member di sini..."
                               autofocus
                               required
                               class="w-full pl-4 pr-32 py-3.5 bg-zinc-50 dark:bg-zinc-950 border-2 border-zinc-300 dark:border-zinc-700 focus:border-red-600 dark:focus:border-red-600 rounded-lg text-base font-semibold placeholder:text-zinc-400 text-zinc-900 dark:text-white outline-none transition font-mono">
                        <button type="submit"
                                class="absolute right-1.5 top-1.5 bottom-1.5 px-5 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center gap-1.5">
                            <span>Check-in</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Respon Visual Hasil Presensi (PRD 3.2: Aktif / H-3 / Kadaluarsa) -->
            @if(session('checkin_status'))
            @php
                $status = session('checkin_status');
                $m = session('checked_member');
            @endphp
            <div class="mt-5 p-4 rounded-lg border
                {{ $status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950/30 border-l-4 border-l-emerald-600 border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200' : '' }}
                {{ $status === 'expiring_soon' ? 'bg-amber-50 dark:bg-amber-950/30 border-l-4 border-l-amber-500 border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200' : '' }}
                {{ $status === 'expired' ? 'bg-red-50 dark:bg-red-950/30 border-l-4 border-l-red-600 border-red-200 dark:border-red-800 text-red-900 dark:text-red-200' : '' }}
                {{ $status === 'not_found' ? 'bg-zinc-100 dark:bg-zinc-800 border-l-4 border-l-zinc-500 border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-white' : '' }}">

                @if($status === 'active' && $m)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded bg-emerald-600 text-white flex items-center justify-center font-black text-lg shrink-0">
                            ✓
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-emerald-600/20 text-emerald-800 dark:text-emerald-200 font-mono font-bold text-[10px] rounded uppercase tracking-wider">STATUS: AKTIF</span>
                                <span class="font-mono text-xs font-bold">{{ $m->card_id }}</span>
                            </div>
                            <h4 class="text-lg font-black text-zinc-900 dark:text-white mt-0.5 font-montserrat">{{ $m->name }}</h4>
                            <p class="text-xs text-zinc-600 dark:text-zinc-300">Presensi berhasil dicatat pada {{ now()->format('H:i:s') }} WIB</p>
                        </div>
                    </div>
                    <div class="text-right sm:border-l sm:pl-4 sm:border-emerald-200 dark:sm:border-emerald-800">
                        <span class="text-[10px] uppercase font-mono font-bold text-emerald-700 dark:text-emerald-400">Sisa Masa Aktif</span>
                        <p class="text-2xl font-black text-emerald-700 dark:text-emerald-300 font-mono">
                            {{ max(0, now()->startOfDay()->diffInDays($m->current_expiry_date->startOfDay(), false)) }} Hari
                        </p>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Hingga {{ $m->current_expiry_date->format('d M Y') }}</p>
                    </div>
                </div>

                @elseif($status === 'expiring_soon' && $m)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded bg-amber-500 text-zinc-950 flex items-center justify-center font-black text-lg shrink-0">
                            !
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-amber-500/20 text-amber-800 dark:text-amber-200 font-mono font-bold text-[10px] rounded uppercase tracking-wider">HAMPIR HABIS (H-{{ max(0, now()->startOfDay()->diffInDays($m->current_expiry_date->startOfDay(), false)) }})</span>
                                <span class="font-mono text-xs font-bold">{{ $m->card_id }}</span>
                            </div>
                            <h4 class="text-lg font-black text-zinc-900 dark:text-white mt-0.5 font-montserrat">{{ $m->name }}</h4>
                            <p class="text-xs text-amber-700 dark:text-amber-300 font-medium">Presensi tetap tercatat. Tawarkan perpanjangan sekarang!</p>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.members.show', $m) }}"
                           class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-zinc-950 font-montserrat font-bold text-xs uppercase tracking-wider rounded transition inline-block">
                            Perpanjang Sekarang &rarr;
                        </a>
                    </div>
                </div>

                @elseif($status === 'expired' && $m)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded bg-red-600 text-white flex items-center justify-center font-black text-lg shrink-0">
                            ✕
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-red-600/20 text-red-800 dark:text-red-200 font-mono font-bold text-[10px] rounded uppercase tracking-wider">STATUS: KADALUARSA</span>
                                <span class="font-mono text-xs font-bold">{{ $m->card_id }}</span>
                            </div>
                            <h4 class="text-lg font-black text-zinc-900 dark:text-white mt-0.5 font-montserrat">{{ $m->name }}</h4>
                            <p class="text-xs text-red-600 dark:text-red-300 font-medium">
                                Kadaluarsa sejak {{ $m->current_expiry_date->format('d M Y') }}. Presensi ditolak sebelum diperpanjang!
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('admin.members.show', $m) }}"
                           class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition">
                            Perpanjang Membership
                        </a>
                        <button type="button"
                                @click="showGuestModal = true"
                                class="px-4 py-2 bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300 dark:hover:bg-zinc-600 text-zinc-800 dark:text-white font-bold text-xs rounded transition">
                            Bayar Visit Harian
                        </button>
                    </div>
                </div>

                @elseif($status === 'not_found')
                <div class="flex items-center justify-between gap-4">
                    <p class="text-xs font-semibold">Data member tidak ditemukan. Periksa kembali ID kartu atau nomor WhatsApp.</p>
                    <a href="{{ route('admin.members.create') }}" class="text-xs font-bold text-red-600 dark:text-red-400 hover:underline shrink-0">
                        + Daftar Member Baru
                    </a>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Tombol Aksi Cepat Samping (Pendaftaran Member & Tiket Harian) -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 sm:p-6 border border-zinc-200 dark:border-zinc-800 flex flex-col justify-between">
            <div>
                <h4 class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white mb-1">Aksi Meja Depan</h4>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-5">Untuk tamu datang langsung (walk-in) atau pembelian tiket presensi harian.</p>

                <div class="space-y-3">
                    <button type="button"
                            @click="showGuestModal = true"
                            class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <span>Tiket Tamu Harian (Non-Member)</span>
                    </button>

                    <a href="{{ route('admin.members.create') }}"
                       class="w-full py-3 px-4 bg-zinc-100 dark:bg-zinc-800 hover:bg-red-600 hover:text-white dark:hover:bg-red-600 dark:hover:text-white text-zinc-800 dark:text-zinc-200 font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center justify-center gap-2 border border-zinc-200 dark:border-zinc-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span>Daftar Member Baru (Walk-in)</span>
                    </a>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800 text-[11px] text-zinc-400 font-mono">
                Verifikasi pembayaran (Cash/QRIS) & pencegahan kecurangan presensi.
            </div>
        </div>
    </div>

    <!-- Live Feed: Log Presensi Kedatangan Hari Ini -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
            <div>
                <h3 class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white">Riwayat Kedatangan Hari Ini (Live Check-in)</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Daftar pengunjung yang telah masuk melalui meja resepsionis.</p>
            </div>
            <span class="text-xs font-mono font-bold text-zinc-500 dark:text-zinc-400">{{ count($todayAttendances) }} Presensi</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-950/60 text-[10px] uppercase font-mono tracking-wider text-zinc-500 dark:text-zinc-400 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3">Waktu</th>
                        <th class="px-4 sm:px-6 py-3">Tipe</th>
                        <th class="px-4 sm:px-6 py-3">Nama Pengunjung</th>
                        <th class="px-4 sm:px-6 py-3 hidden sm:table-cell">ID Kartu</th>
                        <th class="px-4 sm:px-6 py-3 hidden md:table-cell">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($todayAttendances as $att)
                    <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition">
                        <td class="px-4 sm:px-6 py-3 font-mono font-bold text-xs text-red-600 dark:text-red-400">
                            {{ $att->checkin_time->format('H:i:s') }} WIB
                        </td>
                        <td class="px-4 sm:px-6 py-3">
                            @if($att->type === 'member')
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900/60">
                                MEMBER
                            </span>
                            @else
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/60">
                                TAMU HARIAN
                            </span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3 font-bold text-zinc-900 dark:text-white">
                            {{ $att->type === 'member' ? ($att->member?->name ?? 'Member') : $att->guest_name }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 text-xs font-mono text-zinc-600 dark:text-zinc-400 hidden sm:table-cell">
                            {{ $att->type === 'member' ? ($att->member?->card_id ?? '-') : '-' }}
                        </td>
                        <td class="px-4 sm:px-6 py-3 text-xs text-zinc-500 dark:text-zinc-400 hidden md:table-cell">
                            {{ $att->notes ?? 'Presensi reguler' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-xs text-zinc-400">
                            Belum ada presensi yang tercatat hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form Kilat: Tiket Tamu Harian (PRD 3.2) -->
    <div x-show="showGuestModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75"
         style="display: none;">
        <div @click.away="showGuestModal = false"
             class="bg-white dark:bg-zinc-900 rounded-lg max-w-lg w-full p-6 border border-zinc-200 dark:border-zinc-800 shadow-2xl">
            <div class="flex items-center justify-between mb-5 pb-3 border-b border-zinc-100 dark:border-zinc-800">
                <div>
                    <h3 class="font-montserrat text-sm font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Input Tiket Tamu Harian</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Tiket masuk non-member (1 hari latihan).</p>
                </div>
                <button @click="showGuestModal = false" class="p-1 rounded text-zinc-400 hover:text-zinc-600 dark:hover:text-white">
                    ✕
                </button>
            </div>

            <form action="{{ route('admin.frontdesk.daily-guest') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1">
                        Nama Lengkap Tamu <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           required
                           placeholder="Contoh: Budi Santoso"
                           class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1">
                        Nomor WhatsApp (Opsional)
                    </label>
                    <input type="text"
                           name="phone"
                           placeholder="Contoh: 081234567890"
                           class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-mono">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1">
                        Pilih Paket Tiket Harian <span class="text-red-500">*</span>
                    </label>
                    <select name="package_id"
                            required
                            class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-semibold">
                        @foreach($packages as $pkg)
                            @if($pkg->type === 'daily_visit' || $pkg->duration_days <= 1)
                            <option value="{{ $pkg->id }}">
                                {{ $pkg->name }} — Rp {{ number_format($pkg->price, 0, ',', '.') }}
                            </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1">
                        Metode Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center justify-center gap-2 p-2.5 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 cursor-pointer hover:border-red-600 font-semibold text-xs text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="cash" checked class="text-red-600 focus:ring-red-500">
                            <span>Cash</span>
                        </label>
                        <label class="flex items-center justify-center gap-2 p-2.5 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 cursor-pointer hover:border-red-600 font-semibold text-xs text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="qris" class="text-red-600 focus:ring-red-500">
                            <span>QRIS</span>
                        </label>
                        <label class="flex items-center justify-center gap-2 p-2.5 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 cursor-pointer hover:border-red-600 font-semibold text-xs text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="transfer" class="text-red-600 focus:ring-red-500">
                            <span>Transfer</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-2 border-t border-zinc-100 dark:border-zinc-800">
                    <button type="button"
                            @click="showGuestModal = false"
                            class="px-3.5 py-2 rounded border border-zinc-300 dark:border-zinc-700 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-montserrat font-bold uppercase tracking-wider rounded transition">
                        Simpan & Check-in
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
