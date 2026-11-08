@extends('layouts.member')

@section('title', 'Dashboard Member')

@section('content')
<script>
    function workoutRoutineComponent() {
        return {
            routines: @json($member->routines),
            activeId: {{ (int) ($activeRoutine?->id ?? ($member->routines->first()?->id ?? 1)) }},
            csrfToken: '{{ csrf_token() }}',
            showRoutineModal: false,
            activeTab: 'edit',

            get currentRoutine() {
                return this.routines.find(r => r.id === this.activeId) || this.routines[0] || null;
            },

            get currentExercises() {
                return this.currentRoutine ? (this.currentRoutine.target_exercises || []) : [];
            },

            switchTab(id) {
                this.activeId = id;
            },

            async toggleItem(index) {
                const routine = this.currentRoutine;
                if (!routine || !routine.target_exercises || !routine.target_exercises[index]) return;

                // 1. Optimistic instant visual update
                routine.target_exercises[index].done = !routine.target_exercises[index].done;

                // 2. Background AJAX fetch (No page reload, no scroll jumping)
                try {
                    const url = '/member/routine/' + routine.id + '/toggle';
                    await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken
                        },
                        body: JSON.stringify({ exercise_index: index })
                    });
                } catch (err) {
                    console.error('Failed to toggle routine exercise:', err);
                    // Revert on error
                    routine.target_exercises[index].done = !routine.target_exercises[index].done;
                }
            },

            async resetAll() {
                const routine = this.currentRoutine;
                if (!routine || !routine.target_exercises) return;

                // Instant optimistic uncheck
                routine.target_exercises.forEach(ex => ex.done = false);

                try {
                    const url = '/member/routine/' + routine.id + '/reset';
                    await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken
                        }
                    });
                } catch (err) {
                    console.error('Failed to reset routine checklist:', err);
                }
            },

            async addExercise(e) {
                const form = e.target;
                const nameInput = form.querySelector('input[name="name"]');
                const setsInput = form.querySelector('input[name="sets"]');
                const name = nameInput.value.trim();
                const sets = setsInput.value.trim();

                if (!name || !sets) return;

                const routine = this.currentRoutine;
                if (!routine) return;

                if (!routine.target_exercises) {
                    routine.target_exercises = [];
                }

                const newEx = { name, sets, done: false };
                routine.target_exercises.push(newEx);
                nameInput.value = '';
                setsInput.value = '';

                try {
                    const url = '/member/routine/' + routine.id + '/exercise';
                    await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken
                        },
                        body: JSON.stringify({ name, sets })
                    });
                } catch (err) {
                    console.error('Failed to add exercise:', err);
                }
            },

            async deleteExercise(index) {
                const routine = this.currentRoutine;
                if (!routine || !routine.target_exercises) return;

                routine.target_exercises.splice(index, 1);

                try {
                    const url = '/member/routine/' + routine.id + '/exercise/' + index;
                    await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken
                        }
                    });
                } catch (err) {
                    console.error('Failed to delete exercise:', err);
                }
            }
        };
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('workoutRoutineComponent', workoutRoutineComponent);
    });
</script>

<div class="space-y-6 sm:space-y-8" x-data="workoutRoutineComponent()">

    <!-- Header Sapaan & Status Singkat (Modern Minimalist Athletic) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600/10 border border-red-500/20 text-red-600 dark:text-red-400 text-[10px] sm:text-xs font-bold uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                    <span>Maco Fitness Club • Malang</span>
                </span>
                <span class="text-xs font-mono text-zinc-400 dark:text-zinc-500 hidden sm:inline">
                    {{ now()->translatedFormat('l, d F Y') }}
                </span>
            </div>
            <h1 class="font-montserrat text-2xl sm:text-3xl lg:text-4xl font-black text-zinc-900 dark:text-white uppercase tracking-tight">
                Halo, <span class="text-red-600">{{ $member->name }}</span>
            </h1>
            <p class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 mt-1 max-w-2xl leading-relaxed">
                Setiap repetisi, disiplin, dan keringat membawamu selangkah lebih dekat ke target fisik terbaikmu.
            </p>
        </div>

        <div class="flex items-center gap-2 self-start sm:self-auto flex-shrink-0">
            <button @click="showQrModal = true"
                    type="button"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 active:scale-98 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-lg shadow-red-600/25 transition-all duration-200 transform hover:-translate-y-0.5 cursor-pointer">
                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
                <span>Buka Barcode Presensi</span>
            </button>
        </div>
    </div>

    <!-- Row 1: Kartu Digital Member & Live Gym Crowd Meter -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- [FITUR 1] Kartu Digital Member Maco Gym (Matte Obsidian Metal Athletic Finish) -->
        <div class="lg:col-span-7 relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#12141a] via-[#161922] to-[#0c0e12] text-white p-6 sm:p-8 border border-zinc-700/60 hover:border-red-500/40 transition-colors shadow-2xl shadow-black/30 flex flex-col justify-between min-h-[320px]">
            <!-- Subtle Radial Glow Background -->
            <div class="absolute -right-20 -top-20 w-80 h-80 rounded-full bg-red-600/15 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 rounded-full bg-zinc-800/40 blur-3xl pointer-events-none"></div>

            <!-- Top Row: Brand & Status Pill -->
            <div class="flex items-center justify-between relative z-10 pb-5 border-b border-zinc-800/80">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo/macogym.jpg') }}" alt="Logo" class="h-10 w-auto rounded-lg border border-zinc-700/80 shadow-xs">
                    <div>
                        <div class="font-montserrat font-black text-sm tracking-widest text-white uppercase leading-none">
                            MACO<span class="text-red-500">GYM</span>
                        </div>
                        <p class="text-[9px] uppercase tracking-widest text-zinc-400 font-mono mt-1">ALL ACCESS PASS • Kartu Anggota Resmi</p>
                    </div>
                </div>

                <div>
                    @if($isExpired)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-red-500/20 text-red-400 border border-red-500/40">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Kadaluarsa
                    </span>
                    @elseif($daysRemaining <= 3)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span> Hampir Habis (H-{{ max(0, $daysRemaining) }})
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Member Aktif
                    </span>
                    @endif
                </div>
            </div>

            <!-- Middle Row: EMV Chip, NFC & Member Identity -->
            <div class="py-5 relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <!-- EMV Metallic Smartcard Chip Simulation -->
                    <div class="w-11 h-8 rounded-md bg-gradient-to-br from-amber-200 via-amber-400 to-amber-600 border border-amber-300/80 p-1 flex flex-col justify-between shadow-xs">
                        <div class="h-1 border-b border-amber-600/40"></div>
                        <div class="h-1 border-b border-amber-600/40"></div>
                    </div>
                    
                    <!-- Contactless NFC Wave Icon -->
                    <svg class="w-6 h-6 text-zinc-400/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.5 16.5a5 5 0 010-7M12 19a8.5 8.5 0 000-14M15.5 21.5a12 12 0 000-19" />
                    </svg>
                </div>

                <p class="text-[10px] uppercase font-bold tracking-widest text-zinc-400">Nama Anggota</p>
                <h2 class="font-montserrat text-2xl sm:text-3xl font-black text-white uppercase tracking-tight mt-0.5">
                    {{ $member->name }}
                </h2>
                
                <div class="flex flex-wrap items-center gap-3 mt-2">
                    <div class="text-xs font-mono text-zinc-400">
                        ID: <span class="text-white font-bold text-sm tracking-widest bg-zinc-900/90 px-2.5 py-1 rounded-lg border border-zinc-700/80">{{ $member->card_id }}</span>
                    </div>
                    <span class="text-zinc-600">•</span>
                    <div class="text-xs text-zinc-400">
                        Cabang: <span class="text-zinc-200 font-semibold">{{ $member->branch ?? 'Pandanwangi Green Park' }}</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: Dates & Quick Action -->
            <div class="pt-5 border-t border-zinc-800/80 relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="grid grid-cols-3 gap-4 text-left">
                    <div>
                        <p class="text-[9px] uppercase font-bold text-zinc-400 tracking-wider">Sisa Aktif</p>
                        <p class="font-mono text-lg sm:text-xl font-black text-red-500 mt-0.5">
                            {{ max(0, $daysRemaining) }} <span class="text-xs font-normal text-zinc-400">Hari</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-bold text-zinc-400 tracking-wider">Jatuh Tempo</p>
                        <p class="font-mono text-xs sm:text-sm font-bold text-zinc-200 mt-1">
                            {{ $member->current_expiry_date ? $member->current_expiry_date->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-[9px] uppercase font-bold text-zinc-400 tracking-wider">Bergabung</p>
                        <p class="font-mono text-xs sm:text-sm font-bold text-zinc-200 mt-1">
                            {{ $member->join_date ? $member->join_date->format('d M Y') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2 self-start sm:self-auto">
                    <button @click="showQrModal = true"
                            type="button"
                            class="px-3.5 py-2 bg-zinc-900/90 hover:bg-zinc-800 text-white text-xs font-bold uppercase tracking-wider rounded-xl border border-zinc-700/80 transition-all flex items-center gap-1.5 cursor-pointer shadow-xs">
                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        <span>Scan ID</span>
                    </button>
                    @if($isExpired || $daysRemaining <= 3)
                    <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym,%20saya%20ingin%20perpanjang%20membership%20ID%20{{ $member->card_id }}"
                       target="_blank"
                       class="px-3.5 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold uppercase tracking-wider rounded-xl transition shadow-sm">
                        Perpanjang &rarr;
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- [FITUR 2] Maco Gym Live Crowd Meter (Sleek Real-time Radar) -->
        <div class="lg:col-span-5 bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-7 border border-zinc-200/80 dark:border-[#262934] shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </span>
                        <h3 class="font-montserrat font-bold text-sm text-zinc-900 dark:text-white uppercase tracking-wider">
                            Live Gym Crowd
                        </h3>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $crowdInfo['badge_class'] }}">
                        {{ $crowdInfo['badge'] }}
                    </span>
                </div>

                <!-- Capacity Percentage Gauge -->
                <div class="mt-5">
                    <div class="flex items-baseline justify-between mb-2">
                        <div>
                            <span class="text-xs font-semibold text-zinc-500 dark:text-zinc-400">Kapasitas Stasiun Alat & Area</span>
                            <span class="block text-[10px] text-zinc-400 font-mono mt-0.5">
                                ~{{ $crowdInfo['active_attendees'] ?? 10 }} dari {{ $crowdInfo['max_capacity'] ?? 35 }} stasiun alat terisi
                            </span>
                        </div>
                        <span class="font-mono text-3xl font-black text-zinc-900 dark:text-white">
                            {{ $crowdInfo['percentage'] }}%
                        </span>
                    </div>

                    <!-- Progress Bar with Track -->
                    <div class="w-full bg-zinc-100 dark:bg-zinc-800 rounded-full h-3 overflow-hidden p-0.5">
                        <div class="h-full rounded-full transition-all duration-700 ease-out {{ $crowdInfo['bar_color'] }}"
                             style="width: {{ $crowdInfo['percentage'] }}%"></div>
                    </div>

                    <p class="text-xs font-bold text-zinc-800 dark:text-zinc-200 mt-2.5">
                        Kondisi: <span class="text-red-600 dark:text-red-400">{{ $crowdInfo['status'] }}</span>
                    </p>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                        {{ $crowdInfo['recommendation'] }}
                    </p>
                </div>

                <!-- Peak Hours Breakdown Guide -->
                <div class="mt-5 pt-4 border-t border-zinc-100 dark:border-zinc-800 space-y-2 text-xs">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Panduan Jam Latihan Maco Gym</p>
                    <div class="grid grid-cols-2 gap-2 text-[11px]">
                        <div class="p-2.5 rounded-xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold block">06:00 - 15:00</span>
                            <span class="text-zinc-500 dark:text-zinc-400 text-[10px]">Pagi - Siang: Sepi Bebas Antre</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                            <span class="text-red-600 dark:text-red-400 font-bold block">17:00 - 20:30</span>
                            <span class="text-zinc-500 dark:text-zinc-400 text-[10px]">Peak Hours: Jam Sibuk</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jam Operasional & Kontak Cabang -->
            <div class="mt-5 pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-[11px] text-zinc-500 dark:text-zinc-400">
                <span title="Dihitung dari 35 stasiun alat aktif Maco Gym (Beban, Machine, Rack & Kardio) dengan durasi latihan rata-rata 90 menit">
                    Metrik: 35 Stasiun Alat Aktif
                </span>
                <a href="https://wa.me/6281250207403" target="_blank" class="text-red-600 dark:text-red-400 font-semibold hover:underline">
                    Tanya Frontdesk &rarr;
                </a>
            </div>
        </div>

    </div>

    <!-- Row 2: Grid 4 Metrik Kebugaran Cepat -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <!-- Metric 1: Sisa Hari -->
        <div class="p-5 rounded-2xl bg-white dark:bg-[#15171d] border border-zinc-200 dark:border-[#262934] shadow-xs">
            <div class="flex items-center justify-between text-zinc-400 mb-2">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider">Masa Aktif</span>
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="font-mono text-2xl sm:text-3xl font-black text-zinc-900 dark:text-white">
                {{ max(0, $daysRemaining) }} <span class="text-xs font-normal text-zinc-500">Hari</span>
            </p>
            <p class="text-[10px] text-zinc-400 mt-1">Status keanggotaan aktif</p>
        </div>

        <!-- Metric 2: Kunjungan Bulan Ini -->
        <div class="p-5 rounded-2xl bg-white dark:bg-[#15171d] border border-zinc-200 dark:border-[#262934] shadow-xs">
            <div class="flex items-center justify-between text-zinc-400 mb-2">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider">Kunjungan Bulan Ini</span>
                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="font-mono text-2xl sm:text-3xl font-black text-zinc-900 dark:text-white">
                {{ $monthlyVisits }} <span class="text-xs font-normal text-zinc-500">Sesi</span>
            </p>
            <p class="text-[10px] text-emerald-600 dark:text-emerald-400 mt-1 font-semibold">Bulan {{ now()->translatedFormat('F Y') }}</p>
        </div>

        <!-- Metric 3: Streak Mingguan -->
        <div class="p-5 rounded-2xl bg-white dark:bg-[#15171d] border border-zinc-200 dark:border-[#262934] shadow-xs">
            <div class="flex items-center justify-between text-zinc-400 mb-2">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider">Latihan 7 Hari Terakhir</span>
                <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <p class="font-mono text-2xl sm:text-3xl font-black text-zinc-900 dark:text-white">
                {{ $weeklyStreak }} <span class="text-xs font-normal text-zinc-500">Hari</span>
            </p>
            <p class="text-[10px] text-zinc-400 mt-1">Konsistensi latihan mingguan</p>
        </div>

        <!-- Metric 4: Berat Terkini vs Target -->
        <div class="p-5 rounded-2xl bg-white dark:bg-[#15171d] border border-zinc-200 dark:border-[#262934] shadow-xs">
            <div class="flex items-center justify-between text-zinc-400 mb-2">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-wider">Berat & Target</span>
                <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="font-mono text-2xl sm:text-3xl font-black text-zinc-900 dark:text-white">
                {{ $latestProgress ? $latestProgress->weight_kg : '73.8' }} <span class="text-xs font-normal text-zinc-500">kg</span>
            </p>
            <p class="text-[10px] text-zinc-400 mt-1">
                Target: <strong class="text-zinc-700 dark:text-zinc-200">{{ $member->target_weight_kg ?? '70.0' }} kg</strong>
            </p>
        </div>

    </div>

    <!-- Row 3: [FITUR 3] Grafik Perkembangan Fisik Interaktif (Chart.js) -->
    <div class="bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-8 border border-zinc-200 dark:border-[#262934] shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-zinc-100 dark:border-zinc-800">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                    <h3 class="font-montserrat font-bold text-base sm:text-lg text-zinc-900 dark:text-white uppercase tracking-wider">
                        Grafik Perkembangan Berat Badan
                    </h3>
                </div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                    Visualisasi tren perubahan berat badan (kg) berdasarkan log penimbangan di Maco Gym.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('member.profile') }}"
                   class="px-3.5 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold uppercase tracking-wider rounded-lg transition shadow-xs">
                    + Catat Berat Baru
                </a>
            </div>
        </div>

        <!-- Summary Metric Badges in Graph -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-6 border-b border-zinc-100 dark:border-zinc-800 text-xs">
            <div>
                <span class="text-zinc-400 block text-[10px] uppercase font-bold">Berat Awal</span>
                <span class="font-mono font-bold text-zinc-900 dark:text-white text-base">
                    {{ $chartWeights[0] ?? 76.8 }} kg
                </span>
            </div>
            <div>
                <span class="text-zinc-400 block text-[10px] uppercase font-bold">Berat Terkini</span>
                <span class="font-mono font-bold text-red-600 dark:text-red-400 text-base">
                    {{ end($chartWeights) ?: 73.8 }} kg
                </span>
            </div>
            <div>
                <span class="text-zinc-400 block text-[10px] uppercase font-bold">Total Selisih</span>
                <span class="font-mono font-bold {{ $weightChange <= 0 ? 'text-emerald-500' : 'text-amber-500' }} text-base">
                    {{ $weightChange > 0 ? '+'.$weightChange : $weightChange }} kg
                </span>
            </div>
            <div>
                <span class="text-zinc-400 block text-[10px] uppercase font-bold">Status Indeks BMI</span>
                <span class="font-bold {{ $bmiColor }} text-sm block mt-0.5">
                    {{ $bmi ?? '24.1' }} ({{ $bmiCategory }})
                </span>
            </div>
        </div>

        <!-- Chart Canvas Container -->
        <div class="pt-6 relative h-72 sm:h-80 w-full">
            <canvas id="weightProgressChart"></canvas>
        </div>
    </div>

    <!-- Row 4: [FITUR 4] Workout Routine Checklist & [FITUR 5] Riwayat Presensi -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- [FITUR 4] Workout Split Checklist Hari Ini (Instant Reactive via Alpine.js) -->
        <div class="lg:col-span-6 bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-7 border border-zinc-200/80 dark:border-[#262934] shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <span class="p-1.5 rounded-lg bg-red-600/10 text-red-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </span>
                        <h3 class="font-montserrat font-bold text-sm text-zinc-900 dark:text-white uppercase tracking-wider">
                            Target Latihan Hari Ini
                        </h3>
                    </div>

                    <!-- Action: Reset Checklist & Manage Routine Modal -->
                    <div class="flex items-center gap-2">
                        <button type="button"
                                @click="resetAll()"
                                title="Reset status centang latihan untuk sesi baru tanpa reload"
                                class="p-1.5 rounded-xl text-zinc-400 hover:text-zinc-800 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition cursor-pointer active:scale-95">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </button>

                        <button @click="showRoutineModal = true"
                                type="button"
                                class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider rounded-xl bg-zinc-100 dark:bg-zinc-800/80 hover:bg-red-600 hover:text-white text-zinc-700 dark:text-zinc-300 transition-all flex items-center gap-1.5 cursor-pointer shadow-xs active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                            <span>Atur Menu</span>
                        </button>
                    </div>
                </div>

                <!-- Program Day Tabs: PUSH DAY, PULL DAY, LEG DAY (In-Memory Alpine Switch, No Reload, No Scroll Jump) -->
                <div class="flex items-center gap-2 mt-4 overflow-x-auto pb-1" x-show="routines.length > 0">
                    <template x-for="r in routines" :key="r.id">
                        <button type="button"
                                @click="switchTab(r.id)"
                                class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-150 whitespace-nowrap cursor-pointer select-none"
                                :class="activeId === r.id ? 'bg-red-600 text-white shadow-md shadow-red-600/30' : 'bg-zinc-100 dark:bg-zinc-850 text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white hover:bg-zinc-200 dark:hover:bg-zinc-800'"
                                x-text="r.day_name">
                        </button>
                    </template>
                </div>

                <div class="mt-4">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white"
                       x-text="currentRoutine ? currentRoutine.title : 'Menu Latihan Mandiri'">
                    </p>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                        Centang latihan yang telah selesai Anda lakukan di gym hari ini:
                    </p>
                </div>

                <!-- Exercise Items List (Instant Reactive Checkbox via Alpine.js) -->
                <div class="mt-4 space-y-2.5">
                    <template x-for="(ex, index) in currentExercises" :key="index">
                        <div class="flex items-center justify-between p-3.5 rounded-2xl border transition-all duration-150 cursor-pointer select-none"
                             :class="ex.done ? 'bg-zinc-100/60 dark:bg-zinc-900/40 border-zinc-200/50 dark:border-zinc-800/40 opacity-80' : 'bg-zinc-50 dark:bg-zinc-900/60 border-zinc-200/80 dark:border-zinc-800/70 hover:border-red-500/50 hover:bg-zinc-100/50 dark:hover:bg-zinc-850/50'"
                             @click="toggleItem(index)">
                            
                            <div class="flex items-center gap-3.5 flex-grow">
                                <!-- Checkbox Button -->
                                <button type="button"
                                        @click.stop="toggleItem(index)"
                                        class="w-5 h-5 rounded-lg flex items-center justify-center transition-all border flex-shrink-0 cursor-pointer"
                                        :class="ex.done ? 'bg-red-600 border-red-600 text-white shadow-xs' : 'border-zinc-300 dark:border-zinc-600 bg-white dark:bg-zinc-800'">
                                    <svg x-show="ex.done" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                
                                <!-- Exercise Name & Sets -->
                                <div>
                                    <p class="text-xs font-bold text-zinc-900 dark:text-white transition-all"
                                       :class="ex.done ? 'line-through text-zinc-400 dark:text-zinc-500' : ''"
                                       x-text="ex.name"></p>
                                    <span class="inline-block px-2 py-0.5 rounded-md bg-zinc-200/60 dark:bg-zinc-800/80 text-[10px] text-zinc-600 dark:text-zinc-400 font-mono mt-1"
                                          x-text="ex.sets"></span>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <span class="text-[10px] font-bold uppercase tracking-wider ml-3 flex-shrink-0 px-2 py-0.5 rounded-md"
                                  :class="ex.done ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-400'"
                                  x-text="ex.done ? 'Selesai' : 'Pending'">
                            </span>
                        </div>
                    </template>

                    <div x-show="currentExercises.length === 0" class="py-8 text-center text-xs text-zinc-400">
                        Belum ada latihan pada menu ini. Klik "Atur Menu" untuk menambah latihan.
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-zinc-100 dark:border-zinc-800 text-[11px] text-zinc-500 dark:text-zinc-400 flex items-center justify-between">
                <span class="flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                    <span>Program rutin Maco Gym</span>
                </span>
                <button @click="showRoutineModal = true" class="font-bold text-red-600 dark:text-red-400 hover:underline cursor-pointer">
                    + Tambah Gerakan Baru
                </button>
            </div>
        </div>

        <!-- [FITUR 5] Riwayat Presensi Meja Depan (Span 6) -->
        <div class="lg:col-span-6 bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-7 border border-zinc-200/80 dark:border-[#262934] shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <span class="p-1.5 rounded-lg bg-red-600/10 text-red-600">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <h3 class="font-montserrat font-bold text-sm text-zinc-900 dark:text-white uppercase tracking-wider">
                            Log Kunjungan Terakhir
                        </h3>
                    </div>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400 font-mono">
                        {{ $member->attendances->count() }} Tercatat
                    </span>
                </div>

                <div class="mt-4 space-y-2.5 max-h-72 overflow-y-auto pr-1">
                    @forelse($member->attendances as $att)
                    <div class="flex items-center justify-between p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/70 dark:border-zinc-800/70 text-xs hover:border-red-500/40 transition">
                        <div>
                            <p class="font-bold text-zinc-900 dark:text-white font-mono">
                                {{ $att->checkin_time->translatedFormat('l, d M Y') }}
                            </p>
                            <p class="text-[10px] text-zinc-500 dark:text-zinc-400 mt-0.5">
                                Pukul {{ $att->checkin_time->format('H:i') }} WIB • Maco Gym Pandanwangi
                            </p>
                        </div>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                            Check-in Valid
                        </span>
                    </div>
                    @empty
                    <div class="py-12 text-center text-xs text-zinc-400">
                        Belum ada riwayat kunjungan tersimpan di database.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Anti-Fraud Notice Footer -->
            <div class="mt-5 pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center gap-2 text-[11px] text-zinc-500 dark:text-zinc-400">
                <svg class="w-4 h-4 text-zinc-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Presensi dicatat otomatis saat scan barcode kartu di meja depan Maco Gym.</span>
            </div>
        </div>

    </div>

    <!-- Row 5: [FITUR 6] Katalog Member Perks & Benefit Eksklusif -->
    <div class="bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-8 border border-zinc-200/80 dark:border-[#262934] shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-zinc-100 dark:border-zinc-800">
            <div>
                <h3 class="font-montserrat font-bold text-base sm:text-lg text-zinc-900 dark:text-white uppercase tracking-wider">
                    Keuntungan & Perks Khusus Member
                </h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                    Tunjukkan kartu fisik atau barcode digital Anda untuk menikmati fasilitas gratis dan potongan harga mitra.
                </p>
            </div>
            <a href="https://wa.me/6281250207403?text=Halo%20Admin%20Maco%20Gym,%20saya%20ingin%20tanya%20tentang%20benefit%20member"
               target="_blank"
               class="px-4 py-2 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-900 dark:text-white text-xs font-bold uppercase tracking-wider rounded-xl transition flex items-center gap-2 self-start sm:self-auto cursor-pointer">
                <span>Hubungi Admin</span>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-6">
            
            <!-- Perk 1 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/70 dark:border-zinc-800/70 hover:border-red-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center font-bold mb-3">
                    15%
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Nutrition Bar Discount</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    Diskon 15% untuk pembelian whey protein shake, pre-workout, dan suplemen di bar Maco Gym.
                </p>
            </div>

            <!-- Perk 2 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/70 dark:border-zinc-800/70 hover:border-red-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Shower Air Hangat & Loker</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    Akses bebas locker room harian dan shower air hangat bertekanan tinggi setelah sesi latihan intens.
                </p>
            </div>

            <!-- Perk 3 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/70 dark:border-zinc-800/70 hover:border-red-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Free Monthly InBody Test</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    1x tes komposisi tubuh bulanan (body fat percentage, muscle mass, visceral fat) didampingi pelatih.
                </p>
            </div>

            <!-- Perk 4 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/70 dark:border-zinc-800/70 hover:border-red-500/40 hover:-translate-y-0.5 transition-all duration-200">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Konsultasi Gerakan Coach</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    Bebas konsultasi koreksi form squat, deadlift, dan bench press dengan pelatih jaga Maco Gym.
                </p>
            </div>

        </div>
    </div>
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-6">
            
            <!-- Perk 1 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center font-bold mb-3">
                    15%
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Nutrition Bar Discount</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    Diskon 15% untuk pembelian whey protein shake, pre-workout, dan suplemen di bar Maco Gym.
                </p>
            </div>

            <!-- Perk 2 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Shower Air Hangat & Loker</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    Akses bebas locker room harian dan shower air hangat bertekanan tinggi setelah sesi latihan intens.
                </p>
            </div>

            <!-- Perk 3 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Free Monthly InBody Test</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    1x tes komposisi tubuh bulanan (body fat percentage, muscle mass, visceral fat) didampingi pelatih.
                </p>
            </div>

            <!-- Perk 4 -->
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <div class="w-10 h-10 rounded-xl bg-red-600/10 text-red-600 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h4 class="font-montserrat font-bold text-xs uppercase text-zinc-900 dark:text-white">Konsultasi Gerakan Coach</h4>
                <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">
                    Bebas konsultasi koreksi form squat, deadlift, dan bench press dengan pelatih jaga Maco Gym.
                </p>
            </div>

        </div>
    </div>

    <!-- MODAL ATUR MENU LATIHAN (Member Self-Management Routine Modal) -->
    <div x-cloak x-show="showRoutineModal"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         @keydown.escape.window="showRoutineModal = false">
        
        <div class="relative w-full max-w-lg bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-8 text-zinc-900 dark:text-white shadow-2xl border border-zinc-200 dark:border-zinc-800"
             @click.away="showRoutineModal = false">
            
            <!-- Close Button -->
            <button @click="showRoutineModal = false"
                    type="button"
                    class="absolute top-5 right-5 text-zinc-400 hover:text-zinc-800 dark:hover:text-white p-1 rounded-full transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                <span class="text-[10px] uppercase font-bold tracking-widest text-red-600 font-montserrat">
                    MANAJEMEN TARGET LATIHAN
                </span>
            </div>
            <h3 class="font-montserrat font-extrabold text-xl uppercase tracking-tight">
                Atur Menu Gerakan Latihan
            </h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-6">
                Sesuaikan target latihan Anda untuk split: <strong class="text-red-600 dark:text-red-400" x-text="currentRoutine ? currentRoutine.day_name : 'Latihan'"></strong>
            </p>

            <!-- Mode Selector Tabs: Tambah Gerakan / Template Cepat -->
            <div class="flex items-center gap-2 border-b border-zinc-200 dark:border-zinc-800 pb-3 mb-5">
                <button @click="activeTab = 'edit'"
                        type="button"
                        class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg transition cursor-pointer"
                        :class="activeTab === 'edit' ? 'bg-red-600 text-white' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'">
                    Daftar & Tambah Gerakan
                </button>
                <button @click="activeTab = 'template'"
                        type="button"
                        class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg transition cursor-pointer"
                        :class="activeTab === 'template' ? 'bg-red-600 text-white' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'">
                    Pilih Template Siap Pakai
                </button>
            </div>

            <!-- Tab 1: Edit & Tambah Gerakan (Instant via Alpine.js & Fetch) -->
            <div x-show="activeTab === 'edit'" class="space-y-5">
                
                <!-- Existing Exercises with Instant Delete Button -->
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-zinc-400 mb-2">
                        Gerakan Latihan Saat Ini:
                    </label>
                    <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                        <template x-for="(ex, idx) in currentExercises" :key="idx">
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-xs">
                                <div>
                                    <p class="font-bold text-zinc-900 dark:text-white" x-text="ex.name"></p>
                                    <p class="text-[10px] text-zinc-400 font-mono" x-text="ex.sets"></p>
                                </div>
                                <button type="button"
                                        @click="deleteExercise(idx)"
                                        title="Hapus gerakan ini"
                                        class="text-red-500 hover:text-red-700 p-1 rounded transition cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <div x-show="currentExercises.length === 0" class="text-xs text-zinc-400 text-center py-4">
                            Belum ada latihan pada split ini.
                        </div>
                    </div>
                </div>

                <!-- Form Tambah Gerakan Baru (Instant Add via Alpine.js & Fetch) -->
                <form @submit.prevent="addExercise($event)" class="pt-4 border-t border-zinc-200 dark:border-zinc-800 space-y-3">
                    <p class="text-xs font-bold text-zinc-900 dark:text-white uppercase tracking-wider"
                       x-text="'+ Tambah Gerakan ke ' + (currentRoutine ? currentRoutine.day_name : 'Latihan')">
                    </p>

                    <div>
                        <input type="text"
                               name="name"
                               required
                               placeholder="Nama Latihan (misal: Cable Flyes, Barbell Curl)"
                               class="w-full px-3.5 py-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-300 dark:border-zinc-700 rounded-xl text-xs text-zinc-900 dark:text-white outline-none focus:ring-2 focus:ring-red-600">
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-2">
                            <input type="text"
                                   name="sets"
                                   required
                                   placeholder="Target (misal: 4 Sets x 12 Reps)"
                                   class="w-full px-3.5 py-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-300 dark:border-zinc-700 rounded-xl text-xs text-zinc-900 dark:text-white outline-none focus:ring-2 focus:ring-red-600">
                        </div>
                        <button type="submit"
                                class="py-2 px-3 bg-red-600 hover:bg-red-700 text-white font-bold text-xs uppercase tracking-wider rounded-xl transition shadow-xs text-center cursor-pointer">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tab 2: Pilih Template Populer -->
            <div x-show="activeTab === 'template'" class="space-y-4">
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    Gunakan template standar rekomendasi pelatih Maco Gym untuk menyusun program mingguan Anda secara instan:
                </p>

                <!-- Template 1: Push Pull Legs -->
                <form action="{{ route('member.routine.template') }}" method="POST" class="p-4 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                    @csrf
                    <input type="hidden" name="template_type" value="ppl">
                    <div>
                        <h4 class="font-bold text-xs uppercase text-zinc-900 dark:text-white">Push • Pull • Legs (PPL)</h4>
                        <p class="text-[11px] text-zinc-400 mt-0.5">3 Hari Split: Dada & Triceps, Punggung & Biceps, Kaki.</p>
                    </div>
                    <button type="submit"
                            onclick="return confirm('Menerapkan template ini akan mengganti menu latihan Anda saat ini. Lanjutkan?')"
                            class="px-3 py-1.5 bg-zinc-900 dark:bg-zinc-800 hover:bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-lg transition cursor-pointer">
                        Terapkan
                    </button>
                </form>

                <!-- Template 2: Upper / Lower -->
                <form action="{{ route('member.routine.template') }}" method="POST" class="p-4 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
                    @csrf
                    <input type="hidden" name="template_type" value="upper_lower">
                    <div>
                        <h4 class="font-bold text-xs uppercase text-zinc-900 dark:text-white">Upper / Lower Body</h4>
                        <p class="text-[11px] text-zinc-400 mt-0.5">4 Hari Split: Tubuh Bagian Atas & Tubuh Bagian Bawah.</p>
                    </div>
                    <button type="submit"
                            onclick="return confirm('Menerapkan template ini akan mengganti menu latihan Anda saat ini. Lanjutkan?')"
                            class="px-3 py-1.5 bg-zinc-900 dark:bg-zinc-800 hover:bg-red-600 text-white text-xs font-bold uppercase tracking-wider rounded-lg transition cursor-pointer">
                        Terapkan
                    </button>
                </form>
            </div>

            <div class="mt-6 pt-4 border-t border-zinc-200 dark:border-zinc-800 flex justify-end">
                <button @click="showRoutineModal = false"
                        type="button"
                        class="px-4 py-2 bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 text-xs font-bold uppercase tracking-wider rounded-xl hover:bg-zinc-200 dark:hover:bg-zinc-700 transition cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('weightProgressChart');
        if (!ctx) return;

        const labels = @json($chartLabels);
        const weights = @json($chartWeights);
        const isDarkMode = document.documentElement.classList.contains('dark') || localStorage.getItem('darkMode') === 'true';

        // Styling Palette
        const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.06)' : 'rgba(0, 0, 0, 0.06)';
        const textColor = isDarkMode ? '#a1a1aa' : '#71717a';

        // Gradient Background
        const canvasCtx = ctx.getContext('2d');
        const gradient = canvasCtx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(239, 35, 60, 0.28)');
        gradient.addColorStop(1, 'rgba(239, 35, 60, 0.00)');

        window.memberWeightChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['09 Sep', '21 Sep', '03 Okt', '15 Okt', '27 Okt', '07 Nov'],
                datasets: [{
                    label: 'Berat Badan (kg)',
                    data: weights.length ? weights : [76.8, 76.1, 75.4, 74.8, 74.2, 73.8],
                    borderColor: '#ef233c',
                    borderWidth: 3,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#ef233c',
                    pointBorderColor: isDarkMode ? '#15171d' : '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#ffffff',
                    pointHoverBorderColor: '#ef233c',
                    pointHoverBorderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: isDarkMode ? '#1f2430' : '#ffffff',
                        titleColor: isDarkMode ? '#ffffff' : '#09090b',
                        bodyColor: isDarkMode ? '#e4e4e7' : '#27272a',
                        borderColor: '#ef233c',
                        borderWidth: 1.5,
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Berat: ' + context.parsed.y + ' kg';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: gridColor,
                            drawBorder: false
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                family: 'Plus Jakarta Sans',
                                size: 11
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: gridColor,
                            drawBorder: false
                        },
                        ticks: {
                            color: textColor,
                            font: {
                                family: 'Plus Jakarta Sans',
                                size: 11
                            },
                            callback: function(value) {
                                return value + ' kg';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
