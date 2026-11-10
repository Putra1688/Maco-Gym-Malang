@extends('layouts.admin')

@section('title', 'Frontdesk & Kasir')
@section('header', 'Frontdesk & Meja Kasir')

@section('content')
<div class="space-y-5" x-data="{ showGuestModal: false, showCheckinModal: {{ session('checkin_status') ? 'true' : 'false' }} }">

    <!-- ============================================================== -->
    <!-- 1. SUMMARY CARDS (3 Statistik Utama: Total, Member, Tamu)      -->
    <!-- ============================================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- 1. Total Masuk Hari Ini -->
        <div class="bg-white dark:bg-zinc-900 p-4 sm:p-5 rounded-lg border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600 flex items-center justify-between shadow-xs">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Masuk Hari Ini</span>
                <h4 class="text-3xl font-black font-montserrat text-zinc-900 dark:text-white mt-1">
                    {{ number_format($todayStats['total']) }}
                    <span class="text-xs font-normal text-zinc-400 font-sans">Orang</span>
                </h4>
                <p class="text-[10px] text-zinc-400 font-mono mt-1">Presensi member & tiket tamu</p>
            </div>
            <div class="w-10 h-10 rounded bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-red-200 dark:border-red-900/60 font-mono">
                TOTAL
            </div>
        </div>

        <!-- 2. Presensi Member Terdaftar -->
        <div class="bg-white dark:bg-zinc-900 p-4 sm:p-5 rounded-lg border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-blue-600 flex items-center justify-between shadow-xs">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Member Terdaftar</span>
                <h4 class="text-3xl font-black font-montserrat text-blue-600 dark:text-blue-400 mt-1">
                    {{ number_format($todayStats['member']) }}
                    <span class="text-xs font-normal text-zinc-400 font-sans">Presensi</span>
                </h4>
                <p class="text-[10px] text-zinc-400 font-mono mt-1">Tap kartu RFID & ID member</p>
            </div>
            <div class="w-10 h-10 rounded bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-blue-200 dark:border-blue-900/60 font-mono">
                MBR
            </div>
        </div>

        <!-- 3. Tamu Visit Harian -->
        <div class="bg-white dark:bg-zinc-900 p-4 sm:p-5 rounded-lg border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-emerald-600 flex items-center justify-between shadow-xs">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Tamu Visit Harian</span>
                <h4 class="text-3xl font-black font-montserrat text-emerald-600 dark:text-emerald-400 mt-1">
                    {{ number_format($todayStats['guest']) }}
                    <span class="text-xs font-normal text-zinc-400 font-sans">Tiket</span>
                </h4>
                <p class="text-[10px] text-zinc-400 font-mono mt-1">Tiket harian & non-member</p>
            </div>
            <div class="w-10 h-10 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-emerald-200 dark:border-emerald-900/60 font-mono">
                TMU
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- 2 & 3. OPERASIONAL: PRESENSI CEPAT & AKSI MEJA DEPAN (2 KOLOM) -->
    <!-- ============================================================== -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">

        <!-- 2. PRESENSI CEPAT MEMBER (Col 1-7 di Desktop) -->
        <div class="lg:col-span-7 xl:col-span-8 bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-5 border border-zinc-200 dark:border-zinc-800 flex flex-col justify-between shadow-xs border-t-2 border-t-red-600">
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 mb-3 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded bg-red-600 shrink-0"></span>
                        <h3 class="text-xs sm:text-sm font-montserrat font-bold uppercase tracking-wider text-zinc-900 dark:text-white">
                            Presensi Cepat Member (Scan / ID Kartu)
                        </h3>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-mono font-bold uppercase tracking-wider text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/40 px-2 py-0.5 rounded border border-emerald-200 dark:border-emerald-900/60 shrink-0 self-start sm:self-auto">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        TERMINAL READY
                    </span>
                </div>

                <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-3.5">
                    Tempelkan kartu RFID ke reader, atau ketik ID Kartu (<code class="text-red-600 dark:text-red-400 font-mono font-bold">MC-001</code>) / No. WhatsApp, lalu tekan <kbd class="px-1.5 py-0.5 bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 rounded text-[10px] font-mono border border-zinc-200 dark:border-zinc-700">Enter</kbd>
                </p>

                <!-- Check-in Form -->
                <form action="{{ route('admin.frontdesk.checkin') }}"
                      method="POST"
                      id="form-quick-checkin"
                      onsubmit="if(this.submitting) return false; this.submitting = true; const b = document.getElementById('btn-checkin-submit'); if(b){ b.disabled = true; b.innerHTML = '<span>Memproses...</span>'; }"
                      class="relative">
                    @csrf
                    <div class="relative flex items-center">
                        <div class="absolute left-3.5 text-zinc-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <input type="text"
                               id="card-search-input"
                               name="search"
                               placeholder="Tap kartu RFID atau ketik ID Kartu member..."
                               autofocus
                               autocomplete="off"
                               required
                               class="w-full pl-11 pr-28 py-3 bg-zinc-50 dark:bg-zinc-950 border-2 border-zinc-300 dark:border-zinc-700 focus:border-red-600 dark:focus:border-red-600 rounded-lg text-sm sm:text-base font-semibold placeholder:text-zinc-400 text-zinc-900 dark:text-white outline-none transition font-mono">
                        <button type="submit"
                                id="btn-checkin-submit"
                                class="absolute right-1.5 top-1.5 bottom-1.5 px-4 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center gap-1.5 cursor-pointer disabled:opacity-50">
                            <span>Check-in</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Inline Feedback Bar setelah Check-in -->
            @if(session('checkin_status'))
            @php
                $status = session('checkin_status');
                $mId = session('checked_member_id') ?? data_get(session('checked_member'), 'id');
                $m = $mId ? \App\Models\Member::find($mId) : (is_object(session('checked_member')) ? session('checked_member') : null);
                $mCardId = $m ? $m->card_id : data_get(session('checked_member'), 'card_id', '-');
                $mName = $m ? $m->name : data_get(session('checked_member'), 'name', 'Member');
                $remDays = session('days_remaining', 0);
            @endphp
            <div class="mt-4 p-3 rounded-lg border text-xs flex items-center justify-between gap-3
                {{ $status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950/40 border-emerald-300 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200' : '' }}
                {{ $status === 'expiring_soon' ? 'bg-amber-50 dark:bg-amber-950/40 border-amber-300 dark:border-amber-800 text-amber-900 dark:text-amber-200' : '' }}
                {{ $status === 'expired' ? 'bg-red-50 dark:bg-red-950/40 border-red-300 dark:border-red-800 text-red-900 dark:text-red-200' : '' }}
                {{ $status === 'not_found' ? 'bg-zinc-100 dark:bg-zinc-800 border-zinc-300 dark:border-zinc-700 text-zinc-800 dark:text-zinc-200' : '' }}">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="font-bold uppercase font-mono px-1.5 py-0.5 rounded text-[10px]
                        {{ $status === 'active' ? 'bg-emerald-600 text-white' : '' }}
                        {{ $status === 'expiring_soon' ? 'bg-amber-500 text-zinc-950' : '' }}
                        {{ $status === 'expired' ? 'bg-red-600 text-white' : '' }}
                        {{ $status === 'not_found' ? 'bg-zinc-600 text-white' : '' }}">
                        {{ strtoupper($status) }}
                    </span>
                    <span class="truncate font-semibold">
                        @if($status === 'not_found')
                            Data member tidak ditemukan. Periksa ID kartu atau nomor WhatsApp.
                        @else
                            {{ $mName }} ({{ $mCardId }}) — Sisa {{ max(0, $remDays) }} Hari
                        @endif
                    </span>
                </div>
                <button @click="showCheckinModal = true"
                        type="button"
                        class="text-xs font-bold underline shrink-0 hover:opacity-80 cursor-pointer">
                    Lihat Detail
                </button>
            </div>
            @else
            <div class="mt-4 pt-2.5 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-[11px] text-zinc-400 font-mono">
                <span>* Input otomatis siap untuk scan berikutnya</span>
                <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Ready for Next Card</span>
            </div>
            @endif
        </div>

        <!-- 3. AKSI MEJA DEPAN (Col 8-12 di Desktop) -->
        <div class="lg:col-span-5 xl:col-span-4 bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-5 border border-zinc-200 dark:border-zinc-800 flex flex-col justify-between shadow-xs border-t-2 border-t-zinc-800 dark:border-t-zinc-200">
            <div>
                <div class="flex items-center gap-2 pb-3 mb-3 border-b border-zinc-100 dark:border-zinc-800">
                    <span class="w-2.5 h-2.5 rounded bg-zinc-800 dark:bg-zinc-200 shrink-0"></span>
                    <h3 class="text-xs sm:text-sm font-montserrat font-bold uppercase tracking-wider text-zinc-900 dark:text-white">
                        Aksi Meja Depan
                    </h3>
                </div>

                <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-3.5">
                    Layanan operasional kasir untuk tamu datang langsung (walk-in).
                </p>

                <div class="space-y-2.5">
                    <!-- A. Tiket Tamu Harian -->
                    <button type="button"
                            @click="showGuestModal = true"
                            class="w-full p-3 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 border border-emerald-200 dark:border-emerald-800/60 text-left transition flex items-center justify-between group cursor-pointer">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="font-montserrat font-bold text-xs uppercase tracking-wider text-emerald-950 dark:text-emerald-100">
                                    Tiket Tamu Harian
                                </p>
                                <p class="text-[11px] text-emerald-700 dark:text-emerald-400 truncate">
                                    Non-member (1 hari latihan gym)
                                </p>
                            </div>
                        </div>
                        <span class="text-xs text-emerald-600 dark:text-emerald-400 group-hover:translate-x-0.5 transition font-bold font-mono shrink-0 ml-2">
                            + Input
                        </span>
                    </button>

                    <!-- B. Daftar Member Baru -->
                    <a href="{{ route('admin.members.create') }}"
                       class="w-full p-3 rounded-lg bg-zinc-50 dark:bg-zinc-800/60 hover:bg-zinc-100 dark:hover:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-left transition flex items-center justify-between group">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded bg-red-600 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white">
                                    Daftar Member Baru
                                </p>
                                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 truncate">
                                    Registrasi walk-in & aktivasi kartu
                                </p>
                            </div>
                        </div>
                        <span class="text-xs text-red-600 dark:text-red-400 group-hover:translate-x-0.5 transition font-bold font-mono shrink-0 ml-2">
                            + Baru
                        </span>
                    </a>
                </div>
            </div>

            <div class="mt-4 pt-2.5 border-t border-zinc-100 dark:border-zinc-800 text-[11px] text-zinc-400 font-mono">
                ⚡ Transaksi kasir langsung tercatat ke pembukuan resmi Maco Gym.
            </div>
        </div>

    </div>

    <!-- ============================================================== -->
    <!-- 4. RIWAYAT KEHADIRAN (TABEL DENGAN FILTER & SERVER PAGINATION) -->
    <!-- ============================================================== -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-xs">

        <!-- Header & Filter Bar -->
        <div class="p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800 space-y-3">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full {{ ($isToday ?? true) ? 'bg-emerald-500 animate-pulse' : 'bg-blue-500' }}"></span>
                    <div>
                        <h3 class="font-montserrat font-bold text-xs sm:text-sm uppercase tracking-wider text-zinc-900 dark:text-white">
                            {{ ($isToday ?? true) ? 'Riwayat Kedatangan Hari Ini (Live Check-in)' : 'Riwayat Presensi: ' . \Carbon\Carbon::parse($selectedDate ?? today())->translatedFormat('d F Y') }}
                        </h3>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                            Menampilkan {{ $todayAttendances->total() }} presensi tercatat {{ $search ? '(Filter Pencarian: "' . $search . '")' : '' }}
                        </p>
                    </div>
                </div>

                <!-- Total Badge -->
                <span class="px-2.5 py-1 rounded bg-zinc-100 dark:bg-zinc-800 text-xs font-mono font-bold text-zinc-700 dark:text-zinc-300 self-start sm:self-auto shrink-0">
                    Total: {{ $todayAttendances->total() }} Presensi
                </span>
            </div>

            <!-- Filter Controls Form -->
            <form method="GET" action="{{ route('admin.frontdesk.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-2.5 pt-1">
                <!-- 1. Date Picker (3 cols) -->
                <div class="lg:col-span-3">
                    <label for="filter-date" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1">
                        Tanggal:
                    </label>
                    <div class="flex items-center gap-1.5">
                        <input type="date"
                               id="filter-date"
                               name="date"
                               value="{{ $selectedDate ?? today()->toDateString() }}"
                               onchange="this.form.submit()"
                               class="w-full px-2.5 py-1.5 text-xs font-mono font-semibold rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-1 focus:ring-red-500 outline-none transition cursor-pointer">
                        @if(!($isToday ?? true))
                        <a href="{{ route('admin.frontdesk.index') }}"
                           title="Kembali ke Hari Ini"
                           class="px-2 py-1.5 rounded-lg text-xs font-mono font-bold bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 transition shrink-0">
                            Hari Ini
                        </a>
                        @endif
                    </div>
                </div>

                <!-- 2. Type Filter (3 cols) -->
                <div class="lg:col-span-3">
                    <label for="filter-type" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1">
                        Tipe Pengunjung:
                    </label>
                    <select id="filter-type"
                            name="type"
                            onchange="this.form.submit()"
                            class="w-full px-2.5 py-1.5 text-xs font-mono font-semibold rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-1 focus:ring-red-500 outline-none transition cursor-pointer">
                        <option value="all" {{ ($type ?? 'all') === 'all' ? 'selected' : '' }}>Semua Pengunjung</option>
                        <option value="member" {{ ($type ?? '') === 'member' ? 'selected' : '' }}>Member</option>
                        <option value="daily_guest" {{ ($type ?? '') === 'daily_guest' ? 'selected' : '' }}>Tamu Harian</option>
                    </select>
                </div>

                <!-- 3. Search Name / Card ID (4 cols) -->
                <div class="lg:col-span-4">
                    <label for="filter-search" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1">
                        Cari Nama / ID Kartu / No. WA:
                    </label>
                    <div class="relative flex items-center">
                        <input type="text"
                               id="filter-search"
                               name="search"
                               value="{{ $search ?? '' }}"
                               placeholder="Ketik lalu Enter..."
                               class="w-full pl-8 pr-8 py-1.5 text-xs font-semibold rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-1 focus:ring-red-500 outline-none transition">
                        <svg class="w-3.5 h-3.5 text-zinc-400 absolute left-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        @if($search)
                        <a href="{{ route('admin.frontdesk.index', ['date' => $selectedDate, 'type' => $type, 'per_page' => $perPage]) }}"
                           class="absolute right-2.5 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 text-xs"
                           title="Hapus pencarian">
                            ✕
                        </a>
                        @endif
                    </div>
                </div>

                <!-- 4. Per Page Selector (2 cols) -->
                <div class="lg:col-span-2">
                    <label for="filter-per-page" class="block text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-1">
                        Per Halaman:
                    </label>
                    <select id="filter-per-page"
                            name="per_page"
                            onchange="this.form.submit()"
                            class="w-full px-2.5 py-1.5 text-xs font-mono font-semibold rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-1 focus:ring-red-500 outline-none transition cursor-pointer">
                        <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10 Baris</option>
                        <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25 Baris</option>
                        <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50 Baris</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-zinc-50 dark:bg-zinc-950/60 text-[10px] uppercase font-mono tracking-wider text-zinc-500 dark:text-zinc-400 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-4 py-2.5 w-28">Waktu</th>
                        <th class="px-4 py-2.5 w-32">Tipe</th>
                        <th class="px-4 py-2.5 min-w-[150px]">Nama Pengunjung</th>
                        <th class="px-4 py-2.5 hidden sm:table-cell w-36">ID Kartu</th>
                        <th class="px-4 py-2.5 hidden md:table-cell">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($todayAttendances as $att)
                    <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition">
                        <td class="px-4 py-2.5 font-mono font-bold text-red-600 dark:text-red-400 whitespace-nowrap">
                            {{ $att->checkin_time->format('H:i:s') }} WIB
                        </td>
                        <td class="px-4 py-2.5">
                            @if($att->type === 'member')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900/60">
                                MEMBER
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/60">
                                TAMU HARIAN
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-2.5">
                            <div class="font-bold text-zinc-900 dark:text-white truncate max-w-[220px]">
                                {{ $att->type === 'member' ? ($att->member?->name ?? 'Member') : $att->guest_name }}
                            </div>
                            <div class="text-[10px] text-zinc-500 dark:text-zinc-400 font-mono sm:hidden flex items-center gap-1.5 mt-0.5">
                                <span>{{ $att->type === 'member' ? ($att->member?->card_id ?? '-') : 'Non-Member' }}</span>
                                <span class="text-zinc-300 dark:text-zinc-700">•</span>
                                <span class="truncate">{{ $att->notes ?? 'Presensi reguler' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2.5 text-xs font-mono text-zinc-600 dark:text-zinc-400 hidden sm:table-cell">
                            {{ $att->type === 'member' ? ($att->member?->card_id ?? '-') : '-' }}
                        </td>
                        <td class="px-4 py-2.5 text-xs text-zinc-500 dark:text-zinc-400 hidden md:table-cell">
                            <span class="truncate block max-w-xs">{{ $att->notes ?? 'Presensi reguler' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-xs text-zinc-400">
                            <div class="flex flex-col items-center gap-1.5">
                                <div class="w-8 h-8 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="font-semibold text-zinc-600 dark:text-zinc-300">
                                    Belum ada presensi yang tercatat {{ ($isToday ?? true) ? 'hari ini' : 'pada tanggal terpilih' }}.
                                </p>
                                @if($search || ($type ?? 'all') !== 'all')
                                <p class="text-[11px] text-zinc-400">
                                    Coba ubah kata kunci pencarian atau reset filter tipe pengunjung.
                                </p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if($todayAttendances->hasPages() || $todayAttendances->total() > 0)
        <div class="p-3.5 border-t border-zinc-200 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-zinc-500 dark:text-zinc-400">
            <div>
                Menampilkan <span class="font-bold font-mono text-zinc-800 dark:text-zinc-200">{{ $todayAttendances->firstItem() ?? 0 }}</span>
                s/d <span class="font-bold font-mono text-zinc-800 dark:text-zinc-200">{{ $todayAttendances->lastItem() ?? 0 }}</span>
                dari <span class="font-bold font-mono text-zinc-800 dark:text-zinc-200">{{ $todayAttendances->total() }}</span> presensi
            </div>
            <div>
                {{ $todayAttendances->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- ============================================================== -->
    <!-- MODAL FORM: INPUT TIKET TAMU HARIAN                            -->
    <!-- ============================================================== -->
    <div x-show="showGuestModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-xs"
         style="display: none;">
        <div @click.away="showGuestModal = false; focusCardInput()"
             class="bg-white dark:bg-zinc-900 rounded-lg max-w-lg w-full p-6 border border-zinc-200 dark:border-zinc-800 shadow-2xl">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-zinc-100 dark:border-zinc-800">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded bg-emerald-600"></span>
                    <div>
                        <h3 class="font-montserrat text-sm font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Input Tiket Tamu Harian</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Tiket masuk non-member (1 hari latihan gym).</p>
                    </div>
                </div>
                <button @click="showGuestModal = false; focusCardInput()" class="p-1 rounded text-zinc-400 hover:text-zinc-600 dark:hover:text-white cursor-pointer">
                    ✕
                </button>
            </div>

            <form action="{{ route('admin.frontdesk.daily-guest') }}"
                  method="POST"
                  onsubmit="if(this.submitting) return false; this.submitting = true; document.getElementById('daily-guest-submit-btn').disabled = true; document.getElementById('daily-guest-submit-btn').textContent = 'Menyimpan...';"
                  class="space-y-4">
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
                            @click="showGuestModal = false; focusCardInput()"
                            class="px-3.5 py-2 rounded border border-zinc-300 dark:border-zinc-700 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                            id="daily-guest-submit-btn"
                            class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-montserrat font-bold uppercase tracking-wider rounded transition cursor-pointer disabled:opacity-50">
                        Simpan & Check-in
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- POP-UP NOTIFIKASI HASIL TAP KARTU RFID / SCAN (MODAL FEEDBACK) -->
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

        <div class="relative w-full max-w-md bg-white dark:bg-zinc-900 rounded-2xl p-6 sm:p-7 text-zinc-900 dark:text-white shadow-2xl border-2 overflow-hidden text-center
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
                    class="absolute top-4 right-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 p-1.5 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Status Icon & Header Badge -->
            <div class="mb-4">
                @if($modalStatus === 'active')
                    <div class="w-14 h-14 rounded-full bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl font-black mx-auto mb-2.5 border-2 border-emerald-500/40">
                        ✓
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-emerald-600 text-white uppercase tracking-wider shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                        CHECK-IN BERHASIL — MEMBER AKTIF
                    </span>
                @elseif($modalStatus === 'expiring_soon')
                    <div class="w-14 h-14 rounded-full bg-amber-100 dark:bg-amber-950/60 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl font-black mx-auto mb-2.5 border-2 border-amber-500/40">
                        !
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-amber-500 text-zinc-950 uppercase tracking-wider shadow-xs">
                        ⚠️ PERINGATAN: MASA AKTIF HAMPIR HABIS
                    </span>
                @elseif($modalStatus === 'expired')
                    <div class="w-14 h-14 rounded-full bg-red-100 dark:bg-red-950/60 text-red-600 dark:text-red-400 flex items-center justify-center text-2xl font-black mx-auto mb-2.5 border-2 border-red-600/40">
                        ✕
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-red-600 text-white uppercase tracking-wider shadow-xs">
                        AKSES DITOLAK — MASA AKTIF HABIS
                    </span>
                @else
                    <div class="w-14 h-14 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-500 flex items-center justify-center text-2xl font-black mx-auto mb-2.5">
                        ?
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-mono font-bold bg-zinc-700 text-white uppercase tracking-wider">
                        KARTU TIDAK TERDAFTAR
                    </span>
                @endif
            </div>

            <!-- Member Info -->
            @if($hasMemberData)
                <h3 class="font-montserrat font-black text-xl text-zinc-900 dark:text-white uppercase tracking-tight">
                    {{ $modalName }}
                </h3>
                <p class="font-mono font-bold text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                    ID KARTU: <span class="text-red-600 dark:text-red-400">{{ $modalCardId }}</span>
                </p>

                <!-- Remaining Days Highlight Card -->
                <div class="my-4 p-3.5 rounded-xl border text-center
                    {{ $modalStatus === 'active' ? 'bg-emerald-50/80 dark:bg-emerald-950/30 border-emerald-200 dark:border-emerald-800/60' : '' }}
                    {{ $modalStatus === 'expiring_soon' ? 'bg-amber-50/80 dark:bg-amber-950/30 border-amber-200 dark:border-amber-800/60' : '' }}
                    {{ $modalStatus === 'expired' ? 'bg-red-50/80 dark:bg-red-950/30 border-red-200 dark:border-red-800/60' : '' }}">

                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 block mb-1">
                        Sisa Masa Aktif
                    </span>

                    @if($modalStatus === 'expired')
                        <div class="text-2xl font-black font-montserrat text-red-600 dark:text-red-400">
                            0 HARI (EXPIRED)
                        </div>
                        <p class="text-xs text-red-600 dark:text-red-300 font-semibold mt-1">
                            Kedaluwarsa sejak {{ $modalExpiryFormatted }}
                        </p>
                    @else
                        <div class="text-3xl font-black font-montserrat
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
                           class="w-full block py-2.5 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-lg transition text-center">
                            Perpanjang Membership Sekarang
                        </a>
                    @elseif($modalStatus === 'expiring_soon')
                        <a href="https://wa.me/{{ $modalCleanPhone }}?text={{ urlencode('Halo Kak ' . $modalName . ', ini dari Maco Gym Malang. Mengingatkan bahwa masa aktif membership Anda tersisa ' . $modalRemDays . ' hari lagi (hingga ' . $modalExpiryFormatted . '). Yuk perpanjang sekarang agar latihan tidak terputus!') }}"
                           target="_blank"
                           class="w-full flex items-center justify-center gap-2 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded-lg transition">
                            <span>Ingatkan via WhatsApp</span>
                        </a>
                    @endif

                    <button @click="showCheckinModal = false; focusCardInput()"
                            type="button"
                            class="w-full py-2 rounded-lg border border-zinc-200 dark:border-zinc-700 text-xs font-mono font-bold text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer">
                        Tutup & Siap Tap Berikutnya (Esc / Enter)
                    </button>
                </div>
            @else
                <div class="my-4 p-3.5 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-xs">
                    {{ session('error', 'Kartu atau data member tidak ditemukan.') }}
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.members.create') }}"
                       class="flex-1 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase rounded-lg transition text-center">
                        + Daftar Member Baru
                    </a>
                    <button @click="showCheckinModal = false; focusCardInput()"
                            type="button"
                            class="flex-1 py-2 border border-zinc-300 dark:border-zinc-700 text-xs font-bold rounded-lg transition cursor-pointer">
                        Tutup
                    </button>
                </div>
            @endif
        </div>
    </div>
    @endif

</div>

<!-- Sound Effect & Smart Auto-Focus Scripts -->
<script>
function focusCardInput() {
    setTimeout(() => {
        // Jangan curi fokus jika modal input tiket tamu sedang aktif
        const guestModal = document.querySelector('[x-show="showGuestModal"]');
        if (guestModal && guestModal.style.display !== 'none') {
            return;
        }
        const el = document.getElementById('card-search-input');
        if (el) {
            el.focus();
            el.select();
        }
    }, 100);
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
        // Browser audio policy fallback
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
