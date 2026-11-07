@extends('layouts.member')

@section('title', 'Dashboard Member')

@section('content')
<div class="space-y-6">

    <!-- Kartu Digital Membership Eksklusif (PRD 3.4) -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-amber-950 p-6 sm:p-8 text-white shadow-2xl border border-amber-500/30">
        <!-- Background Glow Accent -->
        <div class="absolute -right-10 -top-10 w-60 h-60 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-white/10 relative z-10">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/30">
                    Kartu Anggota Resmi
                </span>
                <h2 class="text-2xl sm:text-3xl font-black mt-2 tracking-tight">{{ $member->name }}</h2>
                <p class="text-xs text-slate-300 font-mono mt-0.5">ID: <span class="text-amber-400 font-bold text-sm">{{ $member->card_id }}</span></p>
            </div>

            <div class="text-left sm:text-right">
                @if($isExpired)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-400 border border-red-500/40">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span> Kadaluarsa
                </span>
                @elseif($daysRemaining <= 3)
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span> Hampir Habis (H-{{ max(0, $daysRemaining) }})
                </span>
                @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Member Aktif
                </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 pt-6 relative z-10">
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Sisa Masa Aktif</p>
                <p class="text-3xl sm:text-4xl font-black text-amber-400 mt-1 font-mono">
                    {{ max(0, $daysRemaining) }} <span class="text-base font-normal text-slate-300">Hari</span>
                </p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase font-semibold">Jatuh Tempo</p>
                <p class="text-base sm:text-lg font-bold text-slate-100 mt-1 font-mono">
                    {{ $member->current_expiry_date->format('d M Y') }}
                </p>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <p class="text-xs text-slate-400 uppercase font-semibold">Mulai Bergabung</p>
                <p class="text-base sm:text-lg font-bold text-slate-100 mt-1 font-mono">
                    {{ $member->join_date->format('d M Y') }}
                </p>
            </div>
        </div>

        @if($isExpired || $daysRemaining <= 3)
        <div class="mt-6 pt-4 border-t border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
            <p class="text-amber-200">
                {{ $isExpired ? 'Masa aktif membership Anda telah berakhir. Perpanjang agar latihanmu tetap maksimal!' : 'Masa aktif membership Anda hampir habis dalam beberapa hari.' }}
            </p>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Maco%20Gym,%20saya%20ingin%20perpanjang%20membership%20ID%20{{ $member->card_id }}"
               target="_blank"
               class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl transition text-center self-start sm:self-auto">
                Perpanjang via Resepsionis &rarr;
            </a>
        </div>
        @endif
    </div>

    <!-- Catatan Anti-Kecurangan Presensi (PRD 3.4) -->
    <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-900/60 text-blue-900 dark:text-blue-300 text-xs flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <span>
            <strong>Informasi Presensi:</strong> Presensi kedatangan hanya dapat dilakukan di meja resepsionis Maco Gym menggunakan nomor kartu fisik untuk menjamin keaslian kehadiran.
        </span>
    </div>

    <!-- Dua Kolom: Riwayat Kehadiran & Catatan Fisik Terbaru -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Riwayat Kehadiran Member -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm">
            <h3 class="font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Riwayat Kunjungan Latihan
            </h3>

            <div class="space-y-2.5 max-h-80 overflow-y-auto pr-1">
                @forelse($member->attendances as $att)
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200/60 dark:border-slate-700/60 text-xs">
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white font-mono">{{ $att->checkin_time->format('d M Y') }}</p>
                        <p class="text-[11px] text-slate-400">Pukul {{ $att->checkin_time->format('H:i') }} WIB</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                        Check-in Valid
                    </span>
                </div>
                @empty
                <p class="text-center py-8 text-xs text-slate-400">Belum ada riwayat kunjungan.</p>
                @endforelse
            </div>
        </div>

        <!-- Log Fisik Terbaru (PRD 3.4 Opsional) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Perkembangan Fisik Terakhir
                    </h3>
                    <a href="{{ route('member.profile') }}" class="text-xs text-amber-600 dark:text-amber-400 font-semibold hover:underline">
                        Catat Baru &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($member->progresses as $prog)
                    <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200/60 dark:border-slate-700/60 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-mono font-bold text-slate-500">{{ \Carbon\Carbon::parse($prog->recorded_at)->format('d M Y') }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">Tinggi: <strong class="text-slate-700 dark:text-slate-200">{{ $prog->height_cm }} cm</strong></p>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-black text-amber-500 font-mono">{{ $prog->weight_kg }} kg</span>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center text-xs text-slate-400">
                        Belum ada catatan berat & tinggi badan.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700">
                <a href="{{ route('member.profile') }}"
                   class="w-full py-2.5 px-4 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 text-xs font-bold rounded-xl transition text-center block">
                    Update Catatan Fisik Anda
                </a>
            </div>
        </div>

    </div>

</div>
@endsection

