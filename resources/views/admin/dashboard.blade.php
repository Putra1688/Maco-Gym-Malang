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

    <!-- ================= 4 GRAFIK MONITORING & ANALITIK OPERASIONAL ================= -->
    <div class="space-y-6">

        <!-- 1. Grafik Pemasukan Per Bulan (Full-Width Card) -->
        <div class="w-full bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-5 sm:p-6 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded bg-red-600 shrink-0"></span>
                    <div>
                        <h3 class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-900 dark:text-white">
                            Grafik Pemasukan Per Bulan
                        </h3>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                            Akumulasi arus kas transaksi membership & tiket harian dalam 6 bulan terakhir
                        </p>
                    </div>
                </div>
                <div class="shrink-0 flex items-center gap-2">
                    <span class="px-2.5 py-1 rounded bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/60 font-mono font-bold text-xs">
                        Total 6 Bulan: Rp {{ number_format($total6MonthsRevenue, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="relative w-full h-[300px] sm:h-[340px]">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>

            <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-[11px] text-zinc-400 font-mono">
                <span>* Sumber data dari pembukuan kas transaksi resmi Maco Gym</span>
                <span class="text-red-600 dark:text-red-400 font-bold">Terupdate Real-Time</span>
            </div>
        </div>

        <!-- 2. Baris Tengah: Chart Lingkaran Gender (50%) & Demografi Umur (50%) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 items-stretch">
            
            <!-- Chart Lingkaran (Donut) Jumlah Member Laki-laki / Perempuan -->
            <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-5 sm:p-6 flex flex-col justify-between shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded bg-rose-500 shrink-0"></span>
                        <div>
                            <h3 class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-900 dark:text-white">
                                Gender Member
                            </h3>
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                                Deteksi rasio Laki-laki vs Perempuan
                            </p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 font-mono text-[11px] font-bold">
                        {{ $totalGenderMembers }} Member
                    </span>
                </div>

                <div class="relative w-full h-[220px] flex items-center justify-center my-auto">
                    <canvas id="genderDonutChart"></canvas>
                </div>

                <!-- Gender Pills Breakdown -->
                <div class="grid grid-cols-2 gap-3 mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="p-2.5 rounded-lg bg-zinc-50 dark:bg-zinc-950/60 border border-zinc-200 dark:border-zinc-800 flex flex-col">
                        <div class="flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <span class="w-2 h-2 rounded-full bg-red-600"></span>
                            <span class="font-semibold">Laki-laki</span>
                        </div>
                        <div class="font-montserrat font-black text-lg text-zinc-900 dark:text-white mt-1">
                            {{ $maleCount }} <span class="text-xs text-red-600 dark:text-red-400 font-mono font-normal">({{ $malePercentage }}%)</span>
                        </div>
                    </div>

                    <div class="p-2.5 rounded-lg bg-zinc-50 dark:bg-zinc-950/60 border border-zinc-200 dark:border-zinc-800 flex flex-col">
                        <div class="flex items-center gap-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                            <span class="font-semibold">Perempuan</span>
                        </div>
                        <div class="font-montserrat font-black text-lg text-zinc-900 dark:text-white mt-1">
                            {{ $femaleCount }} <span class="text-xs text-rose-500 dark:text-rose-400 font-mono font-normal">({{ $femalePercentage }}%)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagram Batang Horizontal Demografi Umur Paling Banyak -->
            <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-5 sm:p-6 flex flex-col justify-between shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded bg-amber-500 shrink-0"></span>
                        <div>
                            <h3 class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-900 dark:text-white">
                                Demografi Umur Member
                            </h3>
                            <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                                Diagram batang horizontal sebaran kelompok umur member
                            </p>
                        </div>
                    </div>
                    <span class="px-2.5 py-1 rounded bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-900/60 font-mono font-bold text-[11px] shrink-0">
                        Dominan: {{ $dominantAgeGroup }}
                    </span>
                </div>

                <div class="relative w-full h-[250px] sm:h-[270px]">
                    <canvas id="ageDemographicChart"></canvas>
                </div>

                <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 text-[11px] text-zinc-400 font-mono flex items-center justify-between">
                    <span>* Klasifikasi usia berdasarkan tanggal lahir terdaftar</span>
                    <span class="text-amber-600 dark:text-amber-400 font-bold">5 Kategori Usia</span>
                </div>
            </div>

        </div>

        <!-- 3. Diagram Rata-Rata Kehadiran Member (Full-Width Card dengan Filter Bulan & Minggu 1-4 + Drill-Down Batang Hari) -->
        <div class="w-full bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-5 sm:p-6 shadow-xs">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                <!-- Judul & Tombol Kembali ke Mingguan -->
                <div class="flex items-start gap-3">
                    <span class="w-2.5 h-2.5 rounded bg-blue-600 shrink-0 mt-1"></span>
                    <div>
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h3 id="attendance-title" class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-900 dark:text-white">
                                Grafik Rata-Rata Kehadiran Member
                            </h3>
                            <button id="attendance-back-btn"
                                    type="button"
                                    onclick="backToWeeklyView()"
                                    class="hidden inline-flex items-center gap-1.5 px-2.5 py-1 rounded text-xs font-mono font-bold bg-blue-600 hover:bg-blue-700 text-white transition shadow-xs cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                <span>Kembali ke Grafik Mingguan</span>
                            </button>
                        </div>
                        <p id="attendance-subtitle" class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                            Pola kehadiran member per hari pada periode terpilih. Klik salah satu batang hari untuk melihat rincian jam kedatangan.
                        </p>
                    </div>
                </div>

                <!-- Filter Controls: Bulan & Minggu 1-4 Disertai Tanggal -->
                <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                    <!-- Dropdown Filter Bulan -->
                    <div class="flex items-center gap-1.5">
                        <label for="filter-month" class="text-[11px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                            Bulan:
                        </label>
                        <select id="filter-month" 
                                onchange="onMonthChange(this.value)"
                                class="px-2.5 py-1.5 text-xs font-mono font-semibold rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition cursor-pointer">
                            <option value="">-- Pilih Bulan --</option>
                            @foreach($availableMonths as $m)
                                <option value="{{ $m['value'] }}" {{ $m['is_current'] ? 'selected' : '' }}>
                                    {{ $m['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dropdown Filter Minggu (Ke 1-4 Disertai Rentang Tanggal) -->
                    <div class="flex items-center gap-1.5">
                        <label for="filter-week" class="text-[11px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                            Minggu:
                        </label>
                        <select id="filter-week" 
                                onchange="onWeekChange(this.value)"
                                class="px-2.5 py-1.5 text-xs font-mono font-semibold rounded-lg bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed">
                            <option value="">-- Pilih Minggu --</option>
                        </select>
                    </div>

                    <!-- Badge Info Periode -->
                    <span id="attendance-badge" class="px-2.5 py-1 rounded bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-900/60 font-mono font-bold text-[11px]">
                        Minggu 1
                    </span>
                </div>
            </div>

            <!-- Attendance Chart Canvas Container -->
            <div id="attendance-chart-wrapper" class="relative w-full h-[300px] sm:h-[340px]">
                <canvas id="attendanceAvgChart"></canvas>
            </div>

            <!-- Empty State: Data Belum Ada (Untuk Periode Masa Depan / Pilihan Kosong) -->
            <div id="attendance-empty-state" class="hidden flex flex-col items-center justify-center py-16 px-4 text-center border border-dashed border-zinc-200 dark:border-zinc-800 rounded-lg">
                <div class="w-14 h-14 rounded-full bg-zinc-100 dark:bg-zinc-800/80 flex items-center justify-center text-zinc-400 dark:text-zinc-500 mb-3 border border-zinc-200 dark:border-zinc-700">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h4 id="attendance-empty-title" class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-800 dark:text-zinc-200">
                    Data Belum Ada
                </h4>
                <p id="attendance-empty-desc" class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 max-w-sm">
                    Periode yang dipilih berada di masa depan. Belum ada aktivitas presensi member yang tercatat pada rentang waktu ini.
                </p>
            </div>

            <!-- Footer Stats / Hint Interaktivitas -->
            <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 text-[11px] text-zinc-400 font-mono flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span id="attendance-footer-hint">💡 Klik salah satu batang hari di atas untuk membedah grafik jam kedatangan (06:00 - 22:00 WIB) pada hari tersebut.</span>
                </div>
                <div id="attendance-footer-stat">
                    <span>Total Kunjungan: <strong id="attendance-total-visits" class="text-zinc-800 dark:text-zinc-100">0 Member</strong></span>
                </div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const isDark = () => document.documentElement.classList.contains('dark');

    const getThemeColors = () => ({
        grid: isDark() ? 'rgba(255, 255, 255, 0.08)' : 'rgba(0, 0, 0, 0.06)',
        text: isDark() ? '#a1a1aa' : '#71717a',
        tooltipBg: isDark() ? '#18181b' : '#ffffff',
        tooltipText: isDark() ? '#f4f4f5' : '#18181b',
        tooltipBorder: isDark() ? '#3f3f46' : '#e4e4e7',
    });

    const colors = getThemeColors();

    // -------------------------------------------------------------
    // 1. Grafik Pemasukan Per Bulan (Line with Gradient Fill)
    // -------------------------------------------------------------
    const revCanvas = document.getElementById('monthlyRevenueChart');
    let revenueChart;
    if (revCanvas) {
        const ctx = revCanvas.getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(220, 38, 38, 0.28)');
        gradient.addColorStop(1, 'rgba(220, 38, 38, 0.00)');

        revenueChart = new Chart(revCanvas, {
            type: 'line',
            data: {
                labels: @json($monthlyRevenueLabels),
                datasets: [{
                    label: 'Pemasukan Kas',
                    data: @json($monthlyRevenueData),
                    borderColor: '#dc2626',
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#dc2626',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: colors.tooltipBg,
                        titleColor: colors.tooltipText,
                        bodyColor: colors.tooltipText,
                        borderColor: colors.tooltipBorder,
                        borderWidth: 1,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return ' Pemasukan: Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: colors.text, font: { family: 'Plus Jakarta Sans', size: 11, weight: 'bold' } }
                    },
                    y: {
                        grid: { color: colors.grid },
                        ticks: {
                            color: colors.text,
                            font: { family: 'Plus Jakarta Sans', size: 10 },
                            callback: function(val) {
                                if (val >= 1000000) return 'Rp ' + (val / 1000000) + ' Jt';
                                if (val >= 1000) return 'Rp ' + (val / 1000) + ' Rb';
                                return 'Rp ' + val;
                            }
                        }
                    }
                }
            }
        });
    }

    // -------------------------------------------------------------
    // 2. Chart Lingkaran (Donut) Gender Member
    // -------------------------------------------------------------
    const genderCanvas = document.getElementById('genderDonutChart');
    let genderChart;
    if (genderCanvas) {
        genderChart = new Chart(genderCanvas, {
            type: 'doughnut',
            data: {
                labels: @json($genderLabels),
                datasets: [{
                    data: @json($genderData),
                    backgroundColor: ['#dc2626', '#fb7185'],
                    hoverBackgroundColor: ['#b91c1c', '#f43f5e'],
                    borderWidth: isDark() ? 3 : 2,
                    borderColor: isDark() ? '#18181b' : '#ffffff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: colors.tooltipBg,
                        titleColor: colors.tooltipText,
                        bodyColor: colors.tooltipText,
                        borderColor: colors.tooltipBorder,
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.raw / total) * 100).toFixed(1) : 0;
                                return ' ' + context.label + ': ' + context.raw + ' Member (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // -------------------------------------------------------------
    // 3. Diagram Batang Horizontal Demografi Umur Paling Banyak
    // -------------------------------------------------------------
    const ageCanvas = document.getElementById('ageDemographicChart');
    let ageChart;
    if (ageCanvas) {
        ageChart = new Chart(ageCanvas, {
            type: 'bar',
            data: {
                labels: @json($ageLabels),
                datasets: [{
                    label: 'Jumlah Member',
                    data: @json($ageData),
                    backgroundColor: [
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#3b82f6',
                        '#10b981'
                    ],
                    borderRadius: 6,
                    borderSkipped: false,
                    maxBarThickness: 22,
                }]
            },
            options: {
                indexAxis: 'y', // Diagram batang horizontal
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: colors.tooltipBg,
                        titleColor: colors.tooltipText,
                        bodyColor: colors.tooltipText,
                        borderColor: colors.tooltipBorder,
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.raw + ' Orang Member';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: colors.grid },
                        ticks: {
                            color: colors.text,
                            stepSize: 1,
                            font: { family: 'Plus Jakarta Sans', size: 10 }
                        }
                    },
                    y: {
                        grid: { display: false },
                        ticks: {
                            color: colors.text,
                            font: { family: 'Plus Jakarta Sans', size: 11, weight: 'bold' }
                        }
                    }
                }
            }
        });
    }

    // -------------------------------------------------------------
    // 4. Grafik Rata-rata Kehadiran Member (Filter Bulan, Minggu 1-4 & Drill-Down Batang Hari)
    // -------------------------------------------------------------
    const attCanvas = document.getElementById('attendanceAvgChart');
    let attendanceChart = null;

    const rawAttendancesByDate = @json($attendancesByDate);
    const TODAY_STR = '{{ $todayDateString }}'; // 2026-11-09
    const DEFAULT_MONTH = '{{ $defaultMonthString }}'; // 2026-11

    const INDO_MONTHS_SHORT = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const INDO_DAYS = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const INDO_DAYS_SHORT = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    const OPERATIONAL_HOURS = [];
    for (let h = 6; h <= 22; h++) {
        OPERATIONAL_HOURS.push((h < 10 ? '0' : '') + h + ':00');
    }

    let currentViewMode = 'weekly'; // 'weekly' | 'hourly'
    let currentWeekData = null;
    let currentDayData = null;

    const monthSelect = document.getElementById('filter-month');
    const weekSelect = document.getElementById('filter-week');
    const titleEl = document.getElementById('attendance-title');
    const subtitleEl = document.getElementById('attendance-subtitle');
    const backBtn = document.getElementById('attendance-back-btn');
    const badgeEl = document.getElementById('attendance-badge');
    const hintEl = document.getElementById('attendance-footer-hint');
    const statTotalEl = document.getElementById('attendance-total-visits');
    const chartWrapper = document.getElementById('attendance-chart-wrapper');
    const emptyStateEl = document.getElementById('attendance-empty-state');
    const emptyTitleEl = document.getElementById('attendance-empty-title');
    const emptyDescEl = document.getElementById('attendance-empty-desc');

    function showChartCanvas() {
        if (chartWrapper) chartWrapper.classList.remove('hidden');
        if (emptyStateEl) emptyStateEl.classList.add('hidden');
    }

    function showEmptyState(title, desc) {
        if (chartWrapper) chartWrapper.classList.add('hidden');
        if (emptyStateEl) emptyStateEl.classList.remove('hidden');
        if (emptyTitleEl) emptyTitleEl.textContent = title;
        if (emptyDescEl) emptyDescEl.textContent = desc;
    }

    function getWeeksForMonth(yearMonthStr) {
        if (!yearMonthStr) return [];
        const parts = yearMonthStr.split('-');
        const year = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10);
        const lastDay = new Date(year, month, 0).getDate();
        const mShort = INDO_MONTHS_SHORT[month];
        const pad = (n) => String(n).padStart(2, '0');

        // Pembagian 4 minggu (Minggu 1 s/d 4)
        const weekDefs = [
            { index: 1, start: 1, end: 7 },
            { index: 2, start: 8, end: 14 },
            { index: 3, start: 15, end: 21 },
            { index: 4, start: 22, end: lastDay },
        ];

        return weekDefs.map(def => {
            const startDateStr = `${year}-${pad(month)}-${pad(def.start)}`;
            const endDateStr = `${year}-${pad(month)}-${pad(def.end)}`;
            const label = `Minggu ${def.index} (${pad(def.start)} - ${pad(def.end)} ${mShort} ${year})`;
            
            const days = [];
            for (let d = def.start; d <= def.end; d++) {
                const dateStr = `${year}-${pad(month)}-${pad(d)}`;
                const dateObj = new Date(year, month - 1, d);
                const dayOfWeek = dateObj.getDay();
                const dayName = INDO_DAYS[dayOfWeek];
                const dayShort = INDO_DAYS_SHORT[dayOfWeek];
                const attRecord = rawAttendancesByDate[dateStr] || { total: 0, hours: {} };
                
                days.push({
                    dateStr: dateStr,
                    dayName: dayName,
                    dayShort: dayShort,
                    dayNum: d,
                    formattedDate: `${pad(d)} ${mShort} ${year}`,
                    isFuture: dateStr > TODAY_STR,
                    total: attRecord.total || 0,
                    hours: attRecord.hours || {}
                });
            }

            const isWeekFuture = startDateStr > TODAY_STR;

            return {
                index: def.index,
                label: label,
                startDate: startDateStr,
                endDate: endDateStr,
                isFuture: isWeekFuture,
                days: days
            };
        });
    }

    function initAttendanceChart(labels, counts, maxVal) {
        if (!attCanvas) return;
        attendanceChart = new Chart(attCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Kunjungan Member',
                    data: counts,
                    backgroundColor: counts.map(v => (v === maxVal && v > 0) ? '#2563eb' : 'rgba(59, 130, 246, 0.75)'),
                    hoverBackgroundColor: '#1d4ed8',
                    borderRadius: 6,
                    borderSkipped: false,
                    maxBarThickness: 38,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                onHover: (event, chartElement) => {
                    if (event.native && event.native.target) {
                        event.native.target.style.cursor = (chartElement.length > 0 && currentViewMode === 'weekly') ? 'pointer' : 'default';
                    }
                },
                onClick: (event, elements) => {
                    if (elements.length > 0 && currentViewMode === 'weekly' && currentWeekData) {
                        const clickedIndex = elements[0].index;
                        const day = currentWeekData.days[clickedIndex];
                        if (day) {
                            renderDailyHourlyAttendance(day);
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: colors.tooltipBg,
                        titleColor: colors.tooltipText,
                        bodyColor: colors.tooltipText,
                        borderColor: colors.tooltipBorder,
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            title: function(context) {
                                if (currentViewMode === 'hourly') {
                                    return 'Pukul ' + context[0].label + ' WIB';
                                }
                                const rawLabel = context[0].label;
                                return Array.isArray(rawLabel) ? rawLabel.join(' - ') : rawLabel;
                            },
                            label: function(context) {
                                if (currentViewMode === 'hourly') {
                                    return ' ' + context.raw + ' Member Presensi';
                                }
                                return ' ' + context.raw + ' Kunjungan Member (Klik batang untuk rincian jam)';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: colors.text, font: { family: 'Plus Jakarta Sans', size: 10, weight: 'bold' } }
                    },
                    y: {
                        grid: { color: colors.grid },
                        ticks: {
                            color: colors.text,
                            stepSize: 1,
                            font: { family: 'Plus Jakarta Sans', size: 10 }
                        }
                    }
                }
            }
        });
    }

    function renderAttendanceForWeek(monthStr, weekIndex) {
        currentViewMode = 'weekly';
        const weeks = getWeeksForMonth(monthStr);
        const week = weeks.find(w => w.index === weekIndex);
        if (!week) return;

        currentWeekData = week;
        currentDayData = null;

        if (backBtn) backBtn.classList.add('hidden');

        // Periode masa depan: tampilkan informasi "Data belum ada"
        if (week.isFuture) {
            showEmptyState(
                'Data Belum Ada',
                `Periode ${week.label} berada di masa depan. Belum ada aktivitas presensi member yang tercatat pada rentang waktu ini.`
            );
            if (titleEl) titleEl.textContent = 'Grafik Rata-Rata Kehadiran Member (Mingguan)';
            if (subtitleEl) subtitleEl.textContent = `Menampilkan periode ${week.label}.`;
            if (badgeEl) badgeEl.textContent = `Minggu ${week.index} (Masa Depan)`;
            if (statTotalEl) statTotalEl.textContent = '0 Member';
            return;
        }

        showChartCanvas();

        if (titleEl) titleEl.textContent = 'Grafik Rata-Rata Kehadiran Member (Mingguan)';
        if (subtitleEl) subtitleEl.textContent = `Pola kehadiran member per hari pada ${week.label}. Klik salah satu batang hari untuk melihat rincian jam kedatangan.`;
        if (badgeEl) badgeEl.textContent = `Minggu ${week.index}`;
        if (hintEl) hintEl.textContent = '💡 Klik salah satu batang hari di atas untuk membedah grafik jam kedatangan (06:00 - 22:00 WIB) pada hari tersebut.';

        const labels = week.days.map(d => [d.dayName, d.formattedDate.replace(/ \d{4}$/, '')]);
        const counts = week.days.map(d => d.total);
        const maxVal = Math.max(...counts, 0);

        const totalWeekVisits = counts.reduce((a, b) => a + b, 0);
        const avgVisits = (totalWeekVisits / week.days.length).toFixed(1);
        if (statTotalEl) {
            statTotalEl.innerHTML = `<strong>${totalWeekVisits} Member</strong> <span class="text-zinc-400">(${avgVisits} / hari)</span>`;
        }

        if (!attendanceChart) {
            initAttendanceChart(labels, counts, maxVal);
        } else {
            attendanceChart.data.labels = labels;
            attendanceChart.data.datasets[0].label = 'Kunjungan Member';
            attendanceChart.data.datasets[0].data = counts;
            attendanceChart.data.datasets[0].backgroundColor = counts.map(v => (v === maxVal && v > 0) ? '#2563eb' : 'rgba(59, 130, 246, 0.75)');
            attendanceChart.data.datasets[0].hoverBackgroundColor = '#1d4ed8';
            attendanceChart.data.datasets[0].maxBarThickness = 38;
            attendanceChart.update();
        }
    }

    function renderDailyHourlyAttendance(day) {
        currentViewMode = 'hourly';
        currentDayData = day;

        showChartCanvas();

        if (titleEl) {
            titleEl.textContent = `Grafik Jam Kedatangan Member — ${day.dayName}, ${day.formattedDate}`;
        }
        if (subtitleEl) {
            subtitleEl.textContent = `Distribusi jam kedatangan member (06:00 - 22:00 WIB) pada tanggal ${day.formattedDate}. Puncak jam sibuk (peak hours) disorot merah.`;
        }
        if (backBtn) {
            backBtn.classList.remove('hidden');
        }
        if (badgeEl) {
            badgeEl.textContent = `${day.dayName}`;
        }
        if (hintEl) {
            hintEl.textContent = `✓ Menampilkan distribusi jam hari ${day.dayName} (${day.formattedDate}). Klik tombol "Kembali ke Grafik Mingguan" untuk kembali.`;
        }

        const hourlyCounts = OPERATIONAL_HOURS.map(h => day.hours[h] || 0);
        const maxHourVal = Math.max(...hourlyCounts, 0);

        const totalDayVisits = hourlyCounts.reduce((a, b) => a + b, 0);
        let peakHourText = '-';
        if (maxHourVal > 0) {
            const peakIdx = hourlyCounts.indexOf(maxHourVal);
            peakHourText = OPERATIONAL_HOURS[peakIdx] + ` (${maxHourVal} Kunjungan)`;
        }

        if (statTotalEl) {
            statTotalEl.innerHTML = `Total Hari Ini: <strong>${totalDayVisits} Member</strong> | Puncak: <strong class="text-red-600 dark:text-red-400">${peakHourText}</strong>`;
        }

        if (attendanceChart) {
            attendanceChart.data.labels = OPERATIONAL_HOURS;
            attendanceChart.data.datasets[0].label = `Kunjungan ${day.dayName}`;
            attendanceChart.data.datasets[0].data = hourlyCounts;
            attendanceChart.data.datasets[0].backgroundColor = hourlyCounts.map(v => (v === maxHourVal && v > 0) ? '#dc2626' : 'rgba(37, 99, 235, 0.85)');
            attendanceChart.data.datasets[0].hoverBackgroundColor = hourlyCounts.map(v => (v === maxHourVal && v > 0) ? '#b91c1c' : '#1d4ed8');
            attendanceChart.data.datasets[0].maxBarThickness = 28;
            attendanceChart.update();
        }
    }

    window.backToWeeklyView = function() {
        if (!currentWeekData) return;
        const selectedMonth = monthSelect.value;
        renderAttendanceForWeek(selectedMonth, currentWeekData.index);
    };

    window.onMonthChange = function(selectedMonth) {
        if (!selectedMonth) {
            // Filter mingguan nonaktif jika filter bulan belum ditentukan
            weekSelect.disabled = true;
            weekSelect.innerHTML = '<option value="">-- Pilih Minggu --</option>';
            showEmptyState(
                'Silakan Pilih Periode',
                'Tentukan bulan dan minggu terlebih dahulu untuk menampilkan grafik rata-rata kehadiran member.'
            );
            if (badgeEl) badgeEl.textContent = 'Belum Dipilih';
            if (statTotalEl) statTotalEl.textContent = '0 Member';
            return;
        }

        weekSelect.disabled = false;
        const weeks = getWeeksForMonth(selectedMonth);
        let optionsHtml = '';
        weeks.forEach(w => {
            optionsHtml += `<option value="${w.index}">${w.label}</option>`;
        });
        weekSelect.innerHTML = optionsHtml;

        // Secara default akan menyiapkan satu minggu sebelumnya
        let targetWeekIndex = 1;
        if (selectedMonth === DEFAULT_MONTH) {
            const todayDayNum = parseInt(TODAY_STR.split('-')[2], 10);
            let currentWeekIndex = 1;
            if (todayDayNum <= 7) currentWeekIndex = 1;
            else if (todayDayNum <= 14) currentWeekIndex = 2;
            else if (todayDayNum <= 21) currentWeekIndex = 3;
            else currentWeekIndex = 4;

            targetWeekIndex = currentWeekIndex > 1 ? currentWeekIndex - 1 : 1;
        } else {
            targetWeekIndex = 1;
        }

        weekSelect.value = String(targetWeekIndex);
        renderAttendanceForWeek(selectedMonth, targetWeekIndex);
    };

    window.onWeekChange = function(selectedWeekIndex) {
        const selectedMonth = monthSelect.value;
        if (!selectedMonth) return;
        renderAttendanceForWeek(selectedMonth, parseInt(selectedWeekIndex, 10));
    };

    // Inisialisasi awal saat halaman dimuat
    if (monthSelect) {
        monthSelect.value = DEFAULT_MONTH;
        window.onMonthChange(DEFAULT_MONTH);
    }

    // Dynamic Dark/Light Mode Adaptability
    const observer = new MutationObserver(() => {
        const theme = getThemeColors();
        [revenueChart, ageChart, attendanceChart].forEach(ch => {
            if (ch) {
                ch.options.scales.x.ticks.color = theme.text;
                if (ch.options.scales.x.grid) ch.options.scales.x.grid.color = theme.grid;
                ch.options.scales.y.ticks.color = theme.text;
                if (ch.options.scales.y.grid) ch.options.scales.y.grid.color = theme.grid;
                ch.update();
            }
        });
        if (genderChart) {
            genderChart.data.datasets[0].borderColor = isDark() ? '#18181b' : '#ffffff';
            genderChart.update();
        }
    });
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
});
</script>
@endpush
