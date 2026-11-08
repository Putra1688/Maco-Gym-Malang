@extends('layouts.admin')

@section('title', 'Dashboard Monitoring')
@section('header', 'Dashboard Monitoring')

@section('content')
<div class="space-y-6">

    <!-- 4 Metrik Operasional Utama — Athletic Industrial Design -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <!-- 1. Total Member Aktif -->
        <div class="rounded-lg p-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Member Aktif</span>
                    <h3 class="text-3xl font-black text-zinc-900 dark:text-white font-montserrat mt-1">{{ number_format($totalActiveMembers) }}</h3>
                </div>
                <div class="w-9 h-9 rounded bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 flex items-center justify-center shrink-0 border border-red-200 dark:border-red-900/60">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-600 dark:text-emerald-400 font-mono">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    STATUS VALID
                </span>
                <span class="text-[10px] text-zinc-400 font-mono">Kartu Fisik Aktif</span>
            </div>
        </div>

        <!-- 2. Member Mendekati Jatuh Tempo (H-3) -->
        <div class="rounded-lg p-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-amber-500 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Jatuh Tempo (H-3)</span>
                    <h3 class="text-3xl font-black text-amber-600 dark:text-amber-400 font-montserrat mt-1">{{ number_format($expiringMembers->count()) }}</h3>
                </div>
                <div class="w-9 h-9 rounded bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 border border-amber-200 dark:border-amber-900/60">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-amber-600 dark:text-amber-400 font-mono">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    PERLU DIINGATKAN
                </span>
                <span class="text-[10px] text-zinc-400 font-mono">Follow-up WA</span>
            </div>
        </div>

        <!-- 3. Kunjungan Hari Ini -->
        <div class="rounded-lg p-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-blue-600 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Kunjungan Hari Ini</span>
                    <h3 class="text-3xl font-black text-zinc-900 dark:text-white font-montserrat mt-1">{{ number_format($todayAttendance) }}</h3>
                </div>
                <div class="w-9 h-9 rounded bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 border border-blue-200 dark:border-blue-900/60">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-[11px] font-mono">
                <span class="text-blue-600 dark:text-blue-400 font-bold">Member: {{ $todayMemberAttendance }}</span>
                <span class="text-zinc-300 dark:text-zinc-700">|</span>
                <span class="text-emerald-600 dark:text-emerald-400 font-bold">Tamu: {{ $todayGuestAttendance }}</span>
            </div>
        </div>

        <!-- 4. Pemasukan Kas Hari Ini -->
        <div class="rounded-lg p-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-zinc-900 dark:border-t-zinc-100 flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Pemasukan Hari Ini</span>
                    <h3 class="text-2xl font-black text-zinc-900 dark:text-white font-montserrat mt-1">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="w-9 h-9 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 flex items-center justify-center shrink-0 border border-zinc-200 dark:border-zinc-700 font-bold font-mono text-xs">
                    IDR
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-xs">
                <span class="text-[11px] text-zinc-500 dark:text-zinc-400">Bulan Ini:</span>
                <span class="font-mono font-bold text-red-600 dark:text-red-400 text-xs">Rp {{ number_format($monthRevenue, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Peringatan Member Hampir Habis (PRD 3.3: Follow-Up WhatsApp 1-Klik) -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <span class="w-2 h-2 rounded bg-amber-500 shrink-0"></span>
                <div>
                    <h3 class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-900 dark:text-white">Member Mendekati Jatuh Tempo (H-3 / H-1)</h3>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">Kirim pengingat WhatsApp agar masa aktif diperpanjang tanpa jeda latihan.</p>
                </div>
            </div>
            <a href="{{ route('admin.members.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                <span>Lihat Seluruh Member</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-950/60 text-[10px] uppercase font-mono tracking-wider text-zinc-500 dark:text-zinc-400 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3">ID Kartu</th>
                        <th class="px-4 sm:px-6 py-3">Nama Member</th>
                        <th class="px-4 sm:px-6 py-3 hidden sm:table-cell">No. WhatsApp</th>
                        <th class="px-4 sm:px-6 py-3 hidden md:table-cell">Jatuh Tempo</th>
                        <th class="px-4 sm:px-6 py-3">Sisa Waktu</th>
                        <th class="px-4 sm:px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($expiringMembers as $expiring)
                    @php
                        $daysLeft = now()->startOfDay()->diffInDays($expiring->current_expiry_date->startOfDay(), false);
                        $phoneFormatted = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $expiring->phone));
                        $waText = "Halo Kak {$expiring->name}, membership Maco Gym kamu akan berakhir pada {$expiring->current_expiry_date->format('d/m/Y')}. Yuk perpanjang agar latihanmu tetap rutin!";
                        $waUrl = "https://wa.me/{$phoneFormatted}?text=" . urlencode($waText);
                    @endphp
                    <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition">
                        <td class="px-4 sm:px-6 py-3.5 font-mono font-bold text-red-600 dark:text-red-400 text-xs">
                            {{ $expiring->card_id }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5">
                            <div class="font-bold text-zinc-900 dark:text-white text-sm">{{ $expiring->name }}</div>
                            <div class="text-[11px] text-zinc-500 dark:text-zinc-400 font-mono sm:hidden">{{ $expiring->phone }}</div>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-zinc-600 dark:text-zinc-300 font-mono hidden sm:table-cell text-xs">
                            {{ $expiring->phone }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-zinc-600 dark:text-zinc-300 font-mono text-xs hidden md:table-cell">
                            {{ $expiring->current_expiry_date->format('d M Y') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider
                                         {{ $daysLeft <= 1 ? 'bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-900/60' : 'bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-900/60' }}">
                                SISA {{ max(0, $daysLeft) }} HARI
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-right">
                            <a href="{{ $waUrl }}"
                               target="_blank"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded transition">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                <span class="hidden sm:inline">Kirim WA</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-8 h-8 rounded bg-emerald-100 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-zinc-600 dark:text-zinc-300 font-semibold">Tidak ada member yang akan habis dalam 3 hari ke depan.</p>
                                <p class="text-[11px] text-zinc-400">Seluruh masa aktif member terkendali dengan baik.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grid Dua Kolom: Transaksi Terbaru & Presensi Terakhir -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">

        <!-- Transaksi Terbaru -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded bg-red-600"></span>
                    <h4 class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white">Arus Kas Masuk Terbaru</h4>
                </div>
                <a href="{{ route('admin.transactions.index') }}" class="text-[11px] font-mono font-bold uppercase tracking-wider text-red-600 dark:text-red-400 hover:underline">
                    Semua Transaksi &rarr;
                </a>
            </div>
            <div class="p-3 sm:p-4 space-y-2">
                @forelse($recentTransactions as $tx)
                <div class="flex items-center justify-between p-3 rounded bg-zinc-50 dark:bg-zinc-950/60 border border-zinc-200 dark:border-zinc-800">
                    <div class="min-w-0">
                        <p class="font-bold text-sm text-zinc-900 dark:text-white truncate">{{ $tx->customer_name }}</p>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5 flex items-center gap-2 flex-wrap">
                            <span>{{ $tx->package?->name ?? 'Layanan' }}</span>
                            <span class="text-zinc-300 dark:text-zinc-700">•</span>
                            <span class="uppercase font-mono font-bold text-red-600 dark:text-red-400 text-[10px]">{{ $tx->payment_method }}</span>
                        </p>
                    </div>
                    <div class="text-right shrink-0 ml-3">
                        <p class="font-bold text-sm text-zinc-900 dark:text-white font-mono">Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-zinc-400 font-mono">{{ $tx->created_at->format('H:i') }} WIB</p>
                    </div>
                </div>
                @empty
                <div class="py-8 text-center">
                    <p class="text-xs text-zinc-400">Belum ada transaksi hari ini.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Presensi Terakhir -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
            <div class="p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded bg-blue-600"></span>
                    <h4 class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white">Presensi Kedatangan Terakhir</h4>
                </div>
                <a href="{{ route('admin.frontdesk.index') }}" class="text-[11px] font-mono font-bold uppercase tracking-wider text-red-600 dark:text-red-400 hover:underline">
                    Ke Frontdesk &rarr;
                </a>
            </div>
            <div class="p-3 sm:p-4 space-y-2">
                @forelse($recentAttendances as $att)
                <div class="flex items-center justify-between p-3 rounded bg-zinc-50 dark:bg-zinc-950/60 border border-zinc-200 dark:border-zinc-800">
                    <div class="flex items-center gap-3 min-w-0">
                        <span class="px-1.5 py-1 rounded font-mono font-bold text-[10px] uppercase shrink-0 border
                                     {{ $att->type === 'member' ? 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border-blue-200 dark:border-blue-900/60' : 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border-emerald-200 dark:border-emerald-900/60' }}">
                            {{ $att->type === 'member' ? 'MEMBER' : 'TAMU' }}
                        </span>
                        <div class="min-w-0">
                            <p class="font-bold text-sm text-zinc-900 dark:text-white truncate">
                                {{ $att->type === 'member' ? ($att->member?->name ?? 'Member') : $att->guest_name }}
                            </p>
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 font-mono">
                                {{ $att->type === 'member' ? ($att->member?->card_id ?? '-') : 'Tiket Non-Member' }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right shrink-0 ml-3">
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-zinc-200 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">
                            {{ $att->checkin_time->format('H:i') }} WIB
                        </span>
                    </div>
                </div>
                @empty
                <div class="py-8 text-center">
                    <p class="text-xs text-zinc-400">Belum ada aktivitas presensi hari ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
