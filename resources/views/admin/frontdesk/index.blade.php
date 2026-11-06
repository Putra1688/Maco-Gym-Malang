@extends('layouts.admin')

@section('title', 'Frontdesk & Presensi Cepat')
@section('header', 'Operasional Meja Depan (Frontdesk)')

@section('content')
<div class="space-y-6" x-data="{ showGuestModal: false, showRenewModal: false }">

    <!-- Header Ringkasan Kehadiran Hari Ini -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase font-bold tracking-wider text-slate-500">Total Masuk Hari Ini</p>
                <h4 class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">{{ $todayStats['total'] }} Orang</h4>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center font-bold">
                GYM
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase font-bold tracking-wider text-slate-500">Member Gym</p>
                <h4 class="text-2xl font-black text-blue-600 dark:text-blue-400 mt-0.5">{{ $todayStats['member'] }} Presensi</h4>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center font-bold">
                MBR
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase font-bold tracking-wider text-slate-500">Tamu Non-Member (Visit)</p>
                <h4 class="text-2xl font-black text-emerald-600 dark:text-emerald-400 mt-0.5">{{ $todayStats['guest'] }} Tiket</h4>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center font-bold">
                TMU
            </div>
        </div>
    </div>

    <!-- Kotak Utama Presensi Cepat (Quick Check-in) & Tombol Tamu Harian -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Form 1 Kolom Pencarian / Scan Barcode (PRD 3.2: 3-5 detik) -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                        Presensi Cepat Member (Quick Check-in)
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Ketik ID Kartu (contoh: <code class="text-amber-500">MC-001</code>) atau nama, lalu tekan <kbd class="px-1.5 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-[11px] font-mono border">Enter</kbd></p>
                </div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 px-2.5 py-1 rounded-full border border-emerald-300 dark:border-emerald-800">
                    Frontdesk Ready
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
                           class="w-full pl-5 pr-28 py-4 bg-slate-50 dark:bg-slate-900 border-2 border-amber-500/40 focus:border-amber-500 rounded-2xl text-lg font-semibold placeholder:text-slate-400 placeholder:text-base text-slate-900 dark:text-white outline-none transition shadow-inner">
                    <button type="submit"
                            class="absolute right-2 top-2 bottom-2 px-6 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl transition flex items-center gap-1.5 shadow-md">
                        <span>Check-in</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Banner Respon Visual Seketika (PRD 3.2: 🟢 Aktif / 🟡 H-3 / 🔴 Kadaluarsa) -->
            @if(session('checkin_status'))
            @php
                $status = session('checkin_status');
                $m = session('checked_member');
            @endphp
            <div class="mt-5 p-5 rounded-2xl border transition-all animate-fadeIn
                {{ $status === 'active' ? 'bg-emerald-50 dark:bg-emerald-950/30 border-emerald-300 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200' : '' }}
                {{ $status === 'expiring_soon' ? 'bg-amber-50 dark:bg-amber-950/30 border-amber-300 dark:border-amber-800 text-amber-900 dark:text-amber-200' : '' }}
                {{ $status === 'expired' ? 'bg-red-50 dark:bg-red-950/30 border-red-300 dark:border-red-800 text-red-900 dark:text-red-200' : '' }}
                {{ $status === 'not_found' ? 'bg-slate-100 dark:bg-slate-800 border-slate-300 dark:border-slate-700 text-slate-900 dark:text-white' : '' }}">

                @if($status === 'active' && $m)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-black text-xl shadow-md">
                            ✓
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 font-bold text-xs rounded uppercase tracking-wider">🟢 STATUS: AKTIF</span>
                                <span class="font-mono text-xs font-bold">{{ $m->card_id }}</span>
                            </div>
                            <h4 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">{{ $m->name }}</h4>
                            <p class="text-xs text-slate-600 dark:text-slate-300">Presensi tercatat otomatis pada {{ now()->format('H:i:s') }} WIB</p>
                        </div>
                    </div>
                    <div class="text-right sm:border-l sm:pl-4 sm:border-emerald-300 dark:sm:border-emerald-800">
                        <p class="text-xs uppercase font-bold text-emerald-700 dark:text-emerald-400">Sisa Masa Aktif</p>
                        <p class="text-2xl font-black text-emerald-600 dark:text-emerald-400 font-mono">
                            {{ max(0, now()->startOfDay()->diffInDays($m->current_expiry_date->startOfDay(), false)) }} Hari
                        </p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">Hingga {{ $m->current_expiry_date->format('d M Y') }}</p>
                    </div>
                </div>

                @elseif($status === 'expiring_soon' && $m)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-black text-xl shadow-md">
                            !
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-amber-500/20 text-amber-700 dark:text-amber-300 font-bold text-xs rounded uppercase tracking-wider">🟡 HAMPIR HABIS (H-{{ max(0, now()->startOfDay()->diffInDays($m->current_expiry_date->startOfDay(), false)) }})</span>
                                <span class="font-mono text-xs font-bold">{{ $m->card_id }}</span>
                            </div>
                            <h4 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">{{ $m->name }}</h4>
                            <p class="text-xs text-amber-700 dark:text-amber-300 font-medium">Presensi tetap tercatat. Tawarkan perpanjangan sekarang!</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.members.show', $m) }}"
                           class="px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl transition shadow">
                            Perpanjang Sekarang &rarr;
                        </a>
                    </div>
                </div>

                @elseif($status === 'expired' && $m)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-red-600 text-white flex items-center justify-center font-black text-xl shadow-md">
                            ✕
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-red-500/20 text-red-700 dark:text-red-300 font-bold text-xs rounded uppercase tracking-wider">🔴 STATUS: KADALUARSA</span>
                                <span class="font-mono text-xs font-bold">{{ $m->card_id }}</span>
                            </div>
                            <h4 class="text-xl font-extrabold text-slate-900 dark:text-white mt-0.5">{{ $m->name }}</h4>
                            <p class="text-xs text-red-600 dark:text-red-300 font-medium">
                                Kadaluarsa sejak {{ $m->current_expiry_date->format('d M Y') }}. Presensi ditolak sebelum diperpanjang!
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('admin.members.show', $m) }}"
                           class="px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl transition shadow">
                            [Perpanjang Membership]
                        </a>
                        <button type="button"
                                @click="showGuestModal = true"
                                class="px-4 py-2.5 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-800 dark:text-white font-bold text-xs rounded-xl transition">
                            [Bayar Visit Harian]
                        </button>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Tombol Aksi Cepat Samping (Pendaftaran Member & Tiket Harian) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm flex flex-col justify-between">
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-2">Aksi Meja Kasir</h4>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-5">Untuk tamu datang langsung (walk-in) atau pembelian tiket presensi harian.</p>

                <div class="space-y-3">
                    <button type="button"
                            @click="showGuestModal = true"
                            class="w-full py-3.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-md shadow-emerald-600/20 transition flex items-center justify-center gap-2 text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <span>Tiket Tamu Harian (+ Non-Member)</span>
                    </button>

                    <a href="{{ route('admin.members.create') }}"
                       class="w-full py-3.5 px-4 bg-slate-100 dark:bg-slate-700 hover:bg-amber-500 hover:text-slate-950 dark:hover:bg-amber-500 dark:hover:text-slate-950 text-slate-800 dark:text-white font-bold rounded-xl transition flex items-center justify-center gap-2 text-sm border border-slate-200 dark:border-slate-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        <span>Daftar Member Baru (Walk-in)</span>
                    </a>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700/80 text-[11px] text-slate-400">
                Resepsionis bertugas sebagai verifikator pembayaran fisik (Cash/QRIS) & pencegah kecurangan presensi.
            </div>
        </div>
    </div>

    <!-- Live Feed: Tabel Log Presensi Kedatangan Hari Ini -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 dark:border-slate-700/80 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white text-base">Riwayat Kedatangan Hari Ini (Live Check-in)</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Daftar pengunjung yang telah masuk melalui meja resepsionis.</p>
            </div>
            <span class="text-xs font-mono font-bold text-slate-500">{{ count($todayAttendances) }} Data Terakhir</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-750 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3.5">Waktu Check-in</th>
                        <th class="px-6 py-3.5">Tipe</th>
                        <th class="px-6 py-3.5">Nama Pengunjung</th>
                        <th class="px-6 py-3.5">ID Kartu / Kontak</th>
                        <th class="px-6 py-3.5">Catatan Operasional</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($todayAttendances as $att)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                        <td class="px-6 py-4 font-mono font-bold text-xs text-amber-600 dark:text-amber-400">
                            {{ $att->checkin_time->format('H:i:s') }} WIB
                        </td>
                        <td class="px-6 py-4">
                            @if($att->type === 'member')
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                MEMBER
                            </span>
                            @else
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                TAMU HARIAN
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                            {{ $att->type === 'member' ? ($att->member?->name ?? 'Member') : $att->guest_name }}
                        </td>
                        <td class="px-6 py-4 text-xs font-mono text-slate-600 dark:text-slate-400">
                            {{ $att->type === 'member' ? ($att->member?->card_id ?? '-') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400">
                            {{ $att->notes ?? 'Presensi reguler' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
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
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm animate-fadeIn">
        <div @click.away="showGuestModal = false"
             class="bg-white dark:bg-slate-800 rounded-2xl max-w-lg w-full p-6 border border-slate-200 dark:border-slate-700 shadow-2xl">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Input Tiket Tamu Harian</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Tiket masuk non-member (1 hari latihan).</p>
                </div>
                <button @click="showGuestModal = false" class="p-1 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-white">
                    ✕
                </button>
            </div>

            <form action="{{ route('admin.frontdesk.daily-guest') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Nama Lengkap Tamu <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           required
                           placeholder="Contoh: Budi Santoso"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-300 dark:border-slate-600 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Nomor WhatsApp (Opsional untuk promo)
                    </label>
                    <input type="text"
                           name="phone"
                           placeholder="Contoh: 081234567890"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-300 dark:border-slate-600 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Pilih Paket Tiket Harian <span class="text-red-500">*</span>
                    </label>
                    <select name="package_id"
                            required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-300 dark:border-slate-600 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
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
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Metode Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-300 dark:border-slate-600 cursor-pointer hover:border-amber-500 font-semibold text-xs">
                            <input type="radio" name="payment_method" value="cash" checked class="text-amber-500 focus:ring-amber-500">
                            <span>Cash / Tunai</span>
                        </label>
                        <label class="flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-300 dark:border-slate-600 cursor-pointer hover:border-amber-500 font-semibold text-xs">
                            <input type="radio" name="payment_method" value="qris" class="text-amber-500 focus:ring-amber-500">
                            <span>QRIS</span>
                        </label>
                        <label class="flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-300 dark:border-slate-600 cursor-pointer hover:border-amber-500 font-semibold text-xs">
                            <input type="radio" name="payment_method" value="transfer" class="text-amber-500 focus:ring-amber-500">
                            <span>Transfer</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-slate-700">
                    <button type="button"
                            @click="showGuestModal = false"
                            class="px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-xs font-semibold text-slate-700 dark:text-slate-300">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-md transition">
                        Simpan & Catat Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

