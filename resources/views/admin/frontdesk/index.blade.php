@extends('layouts.admin')

@section('title', 'Frontdesk & Presensi Cepat')
@section('header', 'Frontdesk & Meja Kasir')

@section('content')
<div class="space-y-6" x-data="{ showGuestModal: false, showCheckinModal: {{ session('checkin_status') ? 'true' : 'false' }} }">

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
                               id="card-search-input"
                               name="search"
                               placeholder="Tempelkan kartu RFID atau ketik ID Kartu member..."
                               autofocus
                               autocomplete="off"
                               required
                               class="w-full pl-4 pr-32 py-3.5 bg-zinc-50 dark:bg-zinc-950 border-2 border-zinc-300 dark:border-zinc-700 focus:border-red-600 dark:focus:border-red-600 rounded-lg text-base font-semibold placeholder:text-zinc-400 text-zinc-900 dark:text-white outline-none transition font-mono">
                        <button type="submit"
                                class="absolute right-1.5 top-1.5 bottom-1.5 px-5 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center gap-1.5 cursor-pointer">
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
                $mId = session('checked_member_id') ?? data_get(session('checked_member'), 'id');
                $m = $mId ? \App\Models\Member::find($mId) : (is_object(session('checked_member')) ? session('checked_member') : null);
                $mCardId = $m ? $m->card_id : data_get(session('checked_member'), 'card_id', '-');
                $mName = $m ? $m->name : data_get(session('checked_member'), 'name', 'Member');
                $mPhone = $m ? $m->phone : data_get(session('checked_member'), 'phone', '');
                $rawExpiry = $m ? $m->current_expiry_date : data_get(session('checked_member'), 'current_expiry_date');
                $mExpiryDate = $rawExpiry ? ($rawExpiry instanceof \Carbon\Carbon ? $rawExpiry : \Carbon\Carbon::parse($rawExpiry)) : null;
                $mExpiryFormatted = $mExpiryDate ? $mExpiryDate->format('d M Y') : '-';
                $remDays = session('days_remaining', ($mExpiryDate ? max(0, now()->startOfDay()->diffInDays($mExpiryDate->startOfDay(), false)) : 0));
                $memberShowUrl = $m ? route('admin.members.show', $m) : ($mId ? route('admin.members.show', $mId) : '#');
                $cleanPhone = preg_replace('/[^0-9]/', '', $mPhone ?? '');
            @endphp
            <div class="mt-5 p-4 rounded-lg border
                {{ $status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950/30 border-l-4 border-l-emerald-600 border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200' : '' }}
                {{ $status === 'expiring_soon' ? 'bg-amber-50 dark:bg-amber-950/30 border-l-4 border-l-amber-500 border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200' : '' }}
                {{ $status === 'expired' ? 'bg-red-50 dark:bg-red-950/30 border-l-4 border-l-red-600 border-red-200 dark:border-red-800 text-red-900 dark:text-red-200' : '' }}
                {{ $status === 'not_found' ? 'bg-zinc-100 dark:bg-zinc-800 border-l-4 border-l-zinc-500 border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-white' : '' }}">

                @if($status === 'active' && ($m || session('checked_member')))
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded bg-emerald-600 text-white flex items-center justify-center font-black text-lg shrink-0">
                            ✓
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-emerald-600/20 text-emerald-800 dark:text-emerald-200 font-mono font-bold text-[10px] rounded uppercase tracking-wider">STATUS: AKTIF</span>
                                <span class="font-mono text-xs font-bold">{{ $mCardId }}</span>
                            </div>
                            <h4 class="text-lg font-black text-zinc-900 dark:text-white mt-0.5 font-montserrat">{{ $mName }}</h4>
                            <p class="text-xs text-zinc-600 dark:text-zinc-300">Presensi berhasil dicatat pada {{ now()->format('H:i:s') }} WIB</p>
                        </div>
                    </div>
                    <div class="text-right sm:border-l sm:pl-4 sm:border-emerald-200 dark:sm:border-emerald-800">
                        <span class="text-[10px] uppercase font-mono font-bold text-emerald-700 dark:text-emerald-400">Sisa Masa Aktif</span>
                        <p class="text-2xl font-black text-emerald-700 dark:text-emerald-300 font-mono">
                            {{ max(0, $remDays) }} Hari
                        </p>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Hingga {{ $mExpiryFormatted }}</p>
                    </div>
                </div>

                @elseif($status === 'expiring_soon' && ($m || session('checked_member')))
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded bg-amber-500 text-zinc-950 flex items-center justify-center font-black text-lg shrink-0">
                            !
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-amber-500/20 text-amber-800 dark:text-amber-200 font-mono font-bold text-[10px] rounded uppercase tracking-wider">HAMPIR HABIS (H-{{ max(0, $remDays) }})</span>
                                <span class="font-mono text-xs font-bold">{{ $mCardId }}</span>
                            </div>
                            <h4 class="text-lg font-black text-zinc-900 dark:text-white mt-0.5 font-montserrat">{{ $mName }}</h4>
                            <p class="text-xs text-amber-700 dark:text-amber-300 font-medium">Presensi tetap tercatat. Tawarkan perpanjangan sekarang!</p>
                        </div>
                    </div>
                    <div>
                        <a href="{{ $memberShowUrl }}"
                           class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-zinc-950 font-montserrat font-bold text-xs uppercase tracking-wider rounded transition inline-block">
                            Perpanjang Sekarang &rarr;
                        </a>
                    </div>
                </div>

                @elseif($status === 'expired' && ($m || session('checked_member')))
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded bg-red-600 text-white flex items-center justify-center font-black text-lg shrink-0">
                            ✕
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-red-600/20 text-red-800 dark:text-red-200 font-mono font-bold text-[10px] rounded uppercase tracking-wider">STATUS: KADALUARSA</span>
                                <span class="font-mono text-xs font-bold">{{ $mCardId }}</span>
                            </div>
                            <h4 class="text-lg font-black text-zinc-900 dark:text-white mt-0.5 font-montserrat">{{ $mName }}</h4>
                            <p class="text-xs text-red-600 dark:text-red-300 font-medium">
                                Kadaluarsa sejak {{ $mExpiryFormatted }}. Presensi ditolak sebelum diperpanjang!
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ $memberShowUrl }}"
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

    <!-- Live Feed: Log Presensi Kedatangan Hari Ini / Filter Tanggal -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full {{ ($isToday ?? true) ? 'bg-emerald-500 animate-pulse' : 'bg-blue-500' }}"></span>
                    <h3 class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white">
                        {{ ($isToday ?? true) ? 'Riwayat Kedatangan Hari Ini (Live Check-in)' : 'Riwayat Presensi: ' . \Carbon\Carbon::parse($selectedDate ?? today())->translatedFormat('d F Y') }}
                    </h3>
                </div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                    Daftar pengunjung yang telah masuk melalui meja resepsionis & sistem presensi RFID.
                </p>
            </div>

            <!-- Date Picker Filter -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <form method="GET" action="{{ route('admin.frontdesk.index') }}" class="flex items-center gap-2">
                    <label for="filter-date" class="text-xs font-mono font-bold text-zinc-500 dark:text-zinc-400 shrink-0">
                        Pilih Tanggal:
                    </label>
                    <input type="date"
                           id="filter-date"
                           name="date"
                           value="{{ $selectedDate ?? today()->toDateString() }}"
                           onchange="this.form.submit()"
                           class="px-2.5 py-1.5 text-xs font-mono font-semibold rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-2 focus:ring-red-500 outline-none transition cursor-pointer">
                    @if(!($isToday ?? true))
                        <a href="{{ route('admin.frontdesk.index') }}"
                           class="px-2.5 py-1.5 rounded-lg text-xs font-mono font-bold bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 transition">
                            Hari Ini
                        </a>
                    @endif
                </form>

                <span class="px-2.5 py-1 rounded bg-zinc-100 dark:bg-zinc-800 text-xs font-mono font-bold text-zinc-700 dark:text-zinc-300 shrink-0">
                    {{ count($todayAttendances) }} Presensi
                </span>
            </div>
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
                            Belum ada presensi yang tercatat {{ ($isToday ?? true) ? 'hari ini' : 'pada tanggal terpilih' }}.
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

    <!-- ============================================================== -->
    <!-- POP-UP NOTIFIKASI HASIL TAP KARTU RFID / SCAN (MODAL PC ADMIN) -->
    <!-- ============================================================== -->
    @if(session('checkin_status'))
    @php
        $modalStatus = session('checkin_status');
        $modalMemberId = session('checked_member_id') ?? data_get(session('checked_member'), 'id');
        $modalMember = $modalMemberId ? \App\Models\Member::find($modalMemberId) : (is_object(session('checked_member')) ? session('checked_member') : null);
        $hasMemberData = $modalMember || session('checked_member');
        $modalCardId = $modalMember ? $modalMember->card_id : data_get(session('checked_member'), 'card_id', '-');
        $modalName = $modalMember ? $modalMember->name : data_get(session('checked_member'), 'name', 'Member');
        $modalPhone = $modalMember ? $modalMember->phone : data_get(session('checked_member'), 'phone', '');
        $modalRawExpiry = $modalMember ? $modalMember->current_expiry_date : data_get(session('checked_member'), 'current_expiry_date');
        $modalExpiryDate = $modalRawExpiry ? ($modalRawExpiry instanceof \Carbon\Carbon ? $modalRawExpiry : \Carbon\Carbon::parse($modalRawExpiry)) : null;
        $modalExpiryFormatted = $modalExpiryDate ? $modalExpiryDate->format('d M Y') : '-';
        $modalExpiryLong = $modalExpiryDate ? $modalExpiryDate->translatedFormat('d F Y') : '-';
        $modalRemDays = session('days_remaining', ($modalExpiryDate ? max(0, now()->startOfDay()->diffInDays($modalExpiryDate->startOfDay(), false)) : 0));
        $modalCleanPhone = preg_replace('/[^0-9]/', '', $modalPhone ?? '');
        $modalShowUrl = $modalMember ? route('admin.members.show', $modalMember) : ($modalMemberId ? route('admin.members.show', $modalMemberId) : '#');
    @endphp
    <div x-cloak x-show="showCheckinModal"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/80 backdrop-blur-xs"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="showCheckinModal = false; focusCardInput()"
         @keydown.enter.window="if(showCheckinModal) { showCheckinModal = false; focusCardInput(); }">
        
        <div class="relative w-full max-w-md bg-white dark:bg-zinc-900 rounded-3xl p-6 sm:p-8 text-zinc-900 dark:text-white shadow-2xl border-2 overflow-hidden text-center
            {{ $modalStatus === 'active' ? 'border-emerald-500 shadow-emerald-950/20' : '' }}
            {{ $modalStatus === 'expiring_soon' ? 'border-amber-500 shadow-amber-950/20' : '' }}
            {{ $modalStatus === 'expired' ? 'border-red-600 shadow-red-950/20' : '' }}
            {{ $modalStatus === 'not_found' ? 'border-zinc-500' : '' }}"
            @click.away="showCheckinModal = false; focusCardInput()"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="scale-95 opacity-0"
            x-transition:enter-end="scale-100 opacity-100">

            <!-- Close Button -->
            <button @click="showCheckinModal = false; focusCardInput()"
                    type="button"
                    class="absolute top-4 right-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 p-2 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Status Icon & Header Badge -->
            <div class="mb-4">
                @if($modalStatus === 'active')
                    <div class="w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-3xl font-black mx-auto mb-3 border-2 border-emerald-500/40">
                        ✓
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-mono font-bold bg-emerald-600 text-white uppercase tracking-wider shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                        CHECK-IN BERHASIL — MEMBER AKTIF
                    </span>
                @elseif($modalStatus === 'expiring_soon')
                    <div class="w-16 h-16 rounded-full bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-3xl font-black mx-auto mb-3 border-2 border-amber-500/40">
                        !
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-mono font-bold bg-amber-500 text-zinc-950 uppercase tracking-wider shadow-xs">
                        ⚠️ PERINGATAN: MASA AKTIF HAMPIR HABIS
                    </span>
                @elseif($modalStatus === 'expired')
                    <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-950/60 text-red-600 dark:text-red-400 flex items-center justify-center text-3xl font-black mx-auto mb-3 border-2 border-red-600/40">
                        ✕
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-mono font-bold bg-red-600 text-white uppercase tracking-wider shadow-xs">
                        AKSES DITOLAK — MASA AKTIF HABIS
                    </span>
                @else
                    <div class="w-16 h-16 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-500 flex items-center justify-center text-3xl font-black mx-auto mb-3">
                        ?
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-mono font-bold bg-zinc-700 text-white uppercase tracking-wider">
                        KARTU TIDAK TERDAFTAR
                    </span>
                @endif
            </div>

            <!-- Member Info -->
            @if($hasMemberData)
                <h3 class="font-montserrat font-black text-2xl text-zinc-900 dark:text-white uppercase tracking-tight">
                    {{ $modalName }}
                </h3>
                <p class="font-mono font-bold text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                    ID KARTU: <span class="text-red-600 dark:text-red-400">{{ $modalCardId }}</span>
                </p>

                <!-- Remaining Days Highlight Card -->
                <div class="my-5 p-4 rounded-2xl border text-center
                    {{ $modalStatus === 'active' ? 'bg-emerald-50/80 dark:bg-emerald-950/30 border-emerald-200 dark:border-emerald-800/60' : '' }}
                    {{ $modalStatus === 'expiring_soon' ? 'bg-amber-50/80 dark:bg-amber-950/30 border-amber-200 dark:border-amber-800/60' : '' }}
                    {{ $modalStatus === 'expired' ? 'bg-red-50/80 dark:bg-red-950/30 border-red-200 dark:border-red-800/60' : '' }}">
                    
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 block mb-1">
                        Sisa Masa Aktif
                    </span>

                    @if($modalStatus === 'expired')
                        <div class="text-3xl font-black font-montserrat text-red-600 dark:text-red-400">
                            0 HARI (EXPIRED)
                        </div>
                        <p class="text-xs text-red-600 dark:text-red-300 font-semibold mt-1">
                            Kedaluwarsa sejak {{ $modalExpiryFormatted }}
                        </p>
                    @else
                        <div class="text-3xl sm:text-4xl font-black font-montserrat
                            {{ $modalStatus === 'expiring_soon' ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                            {{ max(0, $modalRemDays) }} HARI LAGI
                        </div>
                        <p class="text-xs text-zinc-600 dark:text-zinc-300 font-medium mt-1">
                            Jatuh Tempo: <strong>{{ $modalExpiryLong }}</strong>
                        </p>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2 pt-1">
                    @if($modalStatus === 'expired')
                        <a href="{{ $modalShowUrl }}"
                           class="w-full block py-3 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-sm text-center">
                            Perpanjang Membership Sekarang
                        </a>
                    @elseif($modalStatus === 'expiring_soon')
                        <a href="https://wa.me/{{ $modalCleanPhone }}?text={{ urlencode('Halo Kak ' . $modalName . ', ini dari Maco Gym Malang. Mengingatkan bahwa masa aktif membership Anda tersisa ' . $modalRemDays . ' hari lagi (hingga ' . $modalExpiryFormatted . '). Yuk perpanjang sekarang agar latihan tidak terputus!') }}"
                           target="_blank"
                           class="w-full flex items-center justify-center gap-2 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-sm">
                            <span>Ingatkan via WhatsApp</span>
                        </a>
                    @endif

                    <button @click="showCheckinModal = false; focusCardInput()"
                            type="button"
                            class="w-full py-2.5 rounded-xl border border-zinc-200 dark:border-zinc-700 text-xs font-mono font-bold text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer">
                        Tutup & Siap Tap Berikutnya (Esc / Enter)
                    </button>
                </div>
            @else
                <div class="my-5 p-4 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-xs">
                    {{ session('error', 'Kartu atau data member tidak ditemukan.') }}
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.members.create') }}"
                       class="flex-1 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase rounded-xl transition text-center">
                        + Daftar Member Baru
                    </a>
                    <button @click="showCheckinModal = false; focusCardInput()"
                            type="button"
                            class="flex-1 py-2.5 border border-zinc-300 dark:border-zinc-700 text-xs font-bold rounded-xl transition">
                        Tutup
                    </button>
                </div>
            @endif
        </div>
    </div>
    @endif

</div>

<!-- Sound Effect & Auto-Focus Scripts -->
<script>
function focusCardInput() {
    setTimeout(() => {
        const el = document.getElementById('card-search-input');
        if (el) {
            el.focus();
            el.select();
        }
    }, 80);
}

function playAudioChime(type) {
    try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        if (type === 'success') {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, ctx.currentTime);
            osc.frequency.setValueAtTime(880, ctx.currentTime + 0.1);
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.35);
            osc.start();
            osc.stop(ctx.currentTime + 0.35);
        } else if (type === 'warning') {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.type = 'triangle';
            osc.frequency.setValueAtTime(440, ctx.currentTime);
            osc.frequency.setValueAtTime(440, ctx.currentTime + 0.15);
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.35);
            osc.start();
            osc.stop(ctx.currentTime + 0.35);
        } else {
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(180, ctx.currentTime);
            gain.gain.setValueAtTime(0.25, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.4);
            osc.start();
            osc.stop(ctx.currentTime + 0.4);
        }
    } catch (e) {
        // Ignore audio policy
    }
}

document.addEventListener('DOMContentLoaded', () => {
    focusCardInput();

    @if(session('checkin_status'))
        @if(session('checkin_status') === 'active')
            playAudioChime('success');
        @elseif(session('checkin_status') === 'expiring_soon')
            playAudioChime('warning');
        @else
            playAudioChime('error');
        @endif
    @endif
});
</script>
@endsection
