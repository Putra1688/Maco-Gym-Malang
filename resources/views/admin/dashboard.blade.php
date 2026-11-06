@extends('layouts.admin')

@section('title', 'Dashboard Monitoring')
@section('header', 'Dashboard Monitoring & Rekap')

@section('content')
<div class="space-y-6">

    <!-- 4 Metrik Kartu Utama (PRD 3.3) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- 1. Total Member Aktif -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Total Member Aktif</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ number_format($totalActiveMembers) }}</h3>
                    <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-2 flex items-center gap-1 font-medium">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Kartu Aktif Valid
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Member Mendekati Jatuh Tempo (H-3) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Hampir Habis (H-3)</p>
                    <h3 class="text-3xl font-extrabold text-amber-500 mt-1">{{ number_format($expiringMembers->count()) }}</h3>
                    <p class="text-xs text-amber-600 dark:text-amber-400 mt-2 font-medium">Perlu difollow-up WhatsApp</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- 3. Kunjungan Hari Ini (Perbandingan Member vs Tamu) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Kunjungan Hari Ini</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-1">{{ number_format($todayAttendance) }}</h3>
                    <div class="flex items-center gap-3 text-xs mt-2 font-medium">
                        <span class="text-blue-600 dark:text-blue-400">Member: {{ $todayMemberAttendance }}</span>
                        <span class="text-slate-400">•</span>
                        <span class="text-emerald-600 dark:text-emerald-400">Tamu: {{ $todayGuestAttendance }}</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- 4. Pemasukan Kas (Hari Ini & Bulan Ini) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Pemasukan Hari Ini</p>
                    <h3 class="text-2xl font-black text-amber-600 dark:text-amber-400 mt-1">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                        Bulan Ini: <strong class="text-slate-800 dark:text-slate-200">Rp {{ number_format($monthRevenue, 0, ',', '.') }}</strong>
                    </p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Peringatan Member Hampir Habis (PRD 3.3: Follow-Up WhatsApp 1-Klik) -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 dark:border-slate-700/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    Member Mendekati Jatuh Tempo (H-3 / H-1)
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Segera ingatkan member agar perpanjang tanpa putus latihan.</p>
            </div>
            <a href="{{ route('admin.members.index') }}" class="text-xs text-amber-600 dark:text-amber-400 font-semibold hover:underline">
                Lihat Semua Member &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-750 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3.5">ID Kartu</th>
                        <th class="px-6 py-3.5">Nama Member</th>
                        <th class="px-6 py-3.5">No. WhatsApp</th>
                        <th class="px-6 py-3.5">Tanggal Jatuh Tempo</th>
                        <th class="px-6 py-3.5">Sisa Hari</th>
                        <th class="px-6 py-3.5 text-right">Follow-Up WhatsApp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($expiringMembers as $expiring)
                    @php
                        $daysLeft = now()->startOfDay()->diffInDays($expiring->current_expiry_date->startOfDay(), false);
                        $phoneFormatted = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $expiring->phone));
                        $waText = "Halo Kak {$expiring->name}, membership Maco Gym kamu akan berakhir pada {$expiring->current_expiry_date->format('d/m/Y')}. Yuk perpanjang agar latihanmu tetap rutin!";
                        $waUrl = "https://wa.me/{$phoneFormatted}?text=" . urlencode($waText);
                    @endphp
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                        <td class="px-6 py-4 font-mono font-bold text-amber-600 dark:text-amber-400 text-xs">
                            {{ $expiring->card_id }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">
                            {{ $expiring->name }}
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                            {{ $expiring->phone }}
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300 font-mono text-xs">
                            {{ $expiring->current_expiry_date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-300 dark:border-amber-700">
                                Sisa {{ max(0, $daysLeft) }} Hari
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ $waUrl }}"
                               target="_blank"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                <span>Kirim WA 1-Klik</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                            Tidak ada member yang akan habis masa aktifnya dalam 3 hari ke depan. Semua aman! 👍
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grid Dua Kolom: Transaksi Terbaru & Presensi Terakhir -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Transaksi Terbaru -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-slate-900 dark:text-white text-base">Arus Kas Masuk Terbaru</h4>
                <a href="{{ route('admin.transactions.index') }}" class="text-xs text-amber-600 dark:text-amber-400 font-semibold hover:underline">
                    Semua Transaksi &rarr;
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentTransactions as $tx)
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200/60 dark:border-slate-700/60">
                    <div>
                        <p class="font-bold text-sm text-slate-900 dark:text-white">{{ $tx->customer_name }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                            {{ $tx->package?->name ?? 'Layanan' }} • <span class="uppercase font-mono font-bold text-amber-600 dark:text-amber-400">{{ $tx->payment_method }}</span>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-sm text-slate-900 dark:text-white">Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                        <p class="text-[11px] text-slate-400 font-mono">{{ $tx->created_at->format('H:i') }} WIB</p>
                    </div>
                </div>
                @empty
                <p class="text-center py-6 text-sm text-slate-400">Belum ada transaksi hari ini.</p>
                @endforelse
            </div>
        </div>

        <!-- Presensi Terakhir -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-slate-900 dark:text-white text-base">Presensi Terakhir Masuk</h4>
                <a href="{{ route('admin.frontdesk.index') }}" class="text-xs text-amber-600 dark:text-amber-400 font-semibold hover:underline">
                    Ke Frontdesk &rarr;
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentAttendances as $att)
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200/60 dark:border-slate-700/60">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center font-bold text-xs {{ $att->type === 'member' ? 'bg-blue-500/10 text-blue-500' : 'bg-emerald-500/10 text-emerald-500' }}">
                            {{ $att->type === 'member' ? 'MBR' : 'TMU' }}
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-900 dark:text-white">
                                {{ $att->type === 'member' ? ($att->member?->name ?? 'Member') : $att->guest_name }}
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $att->type === 'member' ? ($att->member?->card_id ?? '-') : 'Tamu Non-Member' }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex px-2 py-0.5 rounded text-[11px] font-mono bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300">
                            {{ $att->checkin_time->format('H:i') }} WIB
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-center py-6 text-sm text-slate-400">Belum ada aktivitas presensi hari ini.</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection

