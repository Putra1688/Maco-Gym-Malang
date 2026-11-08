@extends('layouts.member')

@section('title', 'Profil & Perkembangan Fisik')

@section('content')
<div class="space-y-6 sm:space-y-8">

    <!-- Top Navigation Breadcrumb -->
    <div class="flex items-center justify-between">
        <a href="{{ route('member.dashboard') }}"
           class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-red-600 dark:hover:text-red-400 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Dashboard</span>
        </a>

        <div class="text-xs font-mono text-zinc-400">
            ID Kartu: <strong class="text-red-600 dark:text-red-400 font-bold">{{ $member->card_id }}</strong>
        </div>
    </div>

    <!-- Informasi Profil Lengkap Member (Modern Minimalist Card) -->
    <div class="bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-8 border border-zinc-200/80 dark:border-[#262934] shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-6 border-b border-zinc-100 dark:border-zinc-800">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="w-16 h-16 rounded-2xl bg-red-600/10 dark:bg-red-500/10 border border-red-500/25 text-red-600 dark:text-red-400 font-montserrat font-black text-2xl flex items-center justify-center flex-shrink-0 shadow-xs">
                        {{ strtoupper(substr($member->name, 0, 2)) }}
                    </div>
                    <span class="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full bg-emerald-500 ring-2 ring-white dark:ring-[#15171d]"></span>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="font-montserrat text-xl sm:text-2xl font-black text-zinc-900 dark:text-white uppercase tracking-tight">
                            {{ $member->name }}
                        </h2>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                            Member Aktif
                        </span>
                    </div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                        Member Resmi Maco Gym Malang • Cabang <strong class="text-zinc-800 dark:text-zinc-200 font-semibold">{{ $member->branch ?? 'Pandanwangi Green Park' }}</strong>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button @click="showQrModal = true"
                        type="button"
                        class="px-4 py-2.5 bg-zinc-900 dark:bg-zinc-800 hover:bg-red-600 dark:hover:bg-red-600 active:scale-98 text-white text-xs font-bold uppercase tracking-wider rounded-xl transition-all border border-zinc-700/60 shadow-xs flex items-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4 text-red-500 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                    <span>Barcode ID</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6 text-xs">
            <div class="p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Nomor WhatsApp</p>
                <p class="font-bold text-zinc-900 dark:text-white font-mono mt-1 text-sm">{{ $member->phone }}</p>
            </div>
            <div class="p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Jenis Kelamin</p>
                <p class="font-bold text-zinc-900 dark:text-white mt-1 text-sm">
                    {{ $member->gender === 'male' ? 'Laki-laki' : ($member->gender === 'female' ? 'Perempuan' : '-') }}
                </p>
            </div>
            <div class="p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Tanggal Bergabung</p>
                <p class="font-bold text-zinc-900 dark:text-white font-mono mt-1 text-sm">
                    {{ $member->join_date ? $member->join_date->format('d M Y') : '-' }}
                </p>
            </div>
            <div class="p-3.5 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60">
                <p class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Target Kebugaran</p>
                <p class="font-bold text-red-600 dark:text-red-400 mt-1 text-sm truncate">
                    {{ $member->fitness_goal ?? 'Fat Loss & Lean Muscle' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Row 2: Status BMI & Kalkulator Tubuh Ideal -->
    <div class="bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-8 border border-zinc-200/80 dark:border-[#262934] shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-zinc-100 dark:border-zinc-800">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                    <h3 class="font-montserrat font-bold text-sm sm:text-base text-zinc-900 dark:text-white uppercase tracking-wider">
                        Indeks Massa Tubuh (BMI / IMT)
                    </h3>
                </div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                    Evaluasi proporsi berat badan dan tinggi badan berdasarkan standar World Health Organization (WHO).
                </p>
            </div>

            <div class="text-left sm:text-right">
                <span class="text-xs text-zinc-400 block font-semibold uppercase">Skor BMI Terkini</span>
                <span class="font-mono text-2xl sm:text-3xl font-black text-red-600 dark:text-red-400">
                    {{ $bmi ?? '24.1' }}
                </span>
            </div>
        </div>

        <!-- BMI Visual Spectrum Bar with Interactive Pin -->
        @php
            $bmiVal = (float) ($bmi ?? 24.1);
            // Gauge position: 15 to 35 range (20 delta)
            $markerPercent = min(96, max(4, (($bmiVal - 15) / 20) * 100));
        @endphp
        <div class="py-6">
            <div class="flex items-center justify-between text-[10px] sm:text-[11px] font-bold uppercase tracking-wider mb-3 text-zinc-400">
                <span class="text-amber-500">Underweight (&lt; 18.5)</span>
                <span class="text-emerald-500">Ideal / Normal (18.5 - 24.9)</span>
                <span class="text-amber-500">Overweight (25 - 29.9)</span>
                <span class="text-red-500">Obesitas (&gt; 30)</span>
            </div>

            <!-- Spectrum Track with Marker Pin -->
            <div class="relative pt-2 pb-1">
                <!-- Marker Indicator -->
                <div class="absolute -top-1 transition-all duration-700 ease-out -translate-x-1/2 flex flex-col items-center"
                     style="left: {{ $markerPercent }}%">
                    <span class="px-2 py-0.5 rounded bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 font-mono text-[10px] font-black shadow-md">
                        {{ $bmiVal }}
                    </span>
                    <div class="w-0 h-0 border-x-4 border-x-transparent border-t-4 border-t-zinc-900 dark:border-t-white"></div>
                </div>

                <div class="h-3 w-full rounded-full bg-zinc-100 dark:bg-zinc-800 overflow-hidden flex mt-5">
                    <div class="h-full bg-amber-400/80 w-[20%]" title="Underweight"></div>
                    <div class="h-full bg-emerald-500 w-[35%]" title="Normal"></div>
                    <div class="h-full bg-amber-500 w-[25%]" title="Overweight"></div>
                    <div class="h-full bg-red-600 w-[20%]" title="Obesitas"></div>
                </div>
            </div>

            @php
                $heightM = ($latestProgress ? $latestProgress->height_cm : 175) / 100;
                $idealMin = round(18.5 * $heightM * $heightM, 1);
                $idealMax = round(24.9 * $heightM * $heightM, 1);
            @endphp

            <div class="mt-5 p-4 rounded-2xl bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200/60 dark:border-zinc-800/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-zinc-500 dark:text-zinc-400">Rentang Berat Badan Ideal (Tinggi {{ $latestProgress ? $latestProgress->height_cm : 175 }} cm):</span>
                    <strong class="text-zinc-900 dark:text-white font-mono ml-1">{{ $idealMin }} kg - {{ $idealMax }} kg</strong>
                </div>
                <div class="text-zinc-500 dark:text-zinc-400">
                    Target Pribadi: <strong class="text-red-600 dark:text-red-400 font-mono">{{ $member->target_weight_kg ?? '70.0' }} kg</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Formulir Input Baru & Tabel Riwayat Log Fisik -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Formulir Input Pengukuran Baru (Span 4) -->
        <div class="lg:col-span-4 bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-7 border border-zinc-200/80 dark:border-[#262934] shadow-xs flex flex-col justify-between">
            <div>
                <div class="pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <h4 class="font-montserrat font-bold text-sm text-zinc-900 dark:text-white uppercase tracking-wider">
                        Catat Pengukuran Baru
                    </h4>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                        Input hasil timbangan rutin Anda di Maco Gym.
                    </p>
                </div>

                @if(isset($errors) && $errors->any())
                <div class="mt-4 p-3 bg-red-500/10 border border-red-500/30 rounded-xl text-red-600 dark:text-red-400 text-xs">
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('member.progress.store') }}" method="POST" class="mt-4 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">
                            Berat Badan (kg) <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               step="0.1"
                               name="weight_kg"
                               required
                               placeholder="Contoh: 73.5"
                               value="{{ old('weight_kg', $latestProgress?->weight_kg) }}"
                               class="w-full px-4 py-2.5 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl text-xs sm:text-sm font-mono text-zinc-900 dark:text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">
                            Tinggi Badan (cm) <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               step="0.1"
                               name="height_cm"
                               required
                               placeholder="Contoh: 175"
                               value="{{ old('height_cm', $latestProgress?->height_cm ?? 175) }}"
                               class="w-full px-4 py-2.5 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl text-xs sm:text-sm font-mono text-zinc-900 dark:text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">
                                Lingkar Pinggang (cm)
                            </label>
                            <input type="number"
                                   step="0.1"
                                   name="waist_cm"
                                   placeholder="Contoh: 81"
                                   value="{{ old('waist_cm', $latestProgress?->waist_cm) }}"
                                   class="w-full px-3 py-2.5 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl text-xs font-mono text-zinc-900 dark:text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">
                                Target Berat (kg)
                            </label>
                            <input type="number"
                                   step="0.1"
                                   name="target_weight_kg"
                                   placeholder="Contoh: 70"
                                   value="{{ old('target_weight_kg', $member->target_weight_kg) }}"
                                   class="w-full px-3 py-2.5 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl text-xs font-mono text-zinc-900 dark:text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">
                            Tanggal Pengukuran
                        </label>
                        <input type="date"
                               name="recorded_at"
                               value="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-2.5 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl text-xs sm:text-sm font-mono text-zinc-900 dark:text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-zinc-600 dark:text-zinc-400 mb-1">
                            Catatan Latihan / Pola Makan
                        </label>
                        <textarea name="notes"
                                  rows="2"
                                  placeholder="Contoh: Latihan push-pull rutin, defisit kalori bersih..."
                                  class="w-full px-4 py-2 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl text-xs text-zinc-900 dark:text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full py-3 bg-red-600 hover:bg-red-700 active:scale-98 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-red-600/20 transition-all duration-150 transform hover:-translate-y-0.5 cursor-pointer">
                        + Simpan Ukuran Fisik
                    </button>
                </form>
            </div>

            <p class="text-[10px] text-zinc-400 text-center mt-4">
                Disarankan menimbang berat badan di pagi hari sebelum sarapan.
            </p>
        </div>

        <!-- Tabel Riwayat Log Pengukuran Fisik (Span 8) -->
        <div class="lg:col-span-8 bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-7 border border-zinc-200/80 dark:border-[#262934] shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <h4 class="font-montserrat font-bold text-sm text-zinc-900 dark:text-white uppercase tracking-wider">
                        Riwayat Log Pengukuran Lengkap
                    </h4>
                    <span class="text-xs text-zinc-500 dark:text-zinc-400 font-mono">
                        {{ count($progressList) }} Titik Rekam
                    </span>
                </div>

                <!-- Responsive Table Container -->
                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b border-zinc-100 dark:border-zinc-800 text-[10px] font-bold uppercase tracking-wider text-zinc-400">
                                <th class="pb-3">Tanggal</th>
                                <th class="pb-3">Berat (kg)</th>
                                <th class="pb-3">Perubahan</th>
                                <th class="pb-3">BMI</th>
                                <th class="pb-3">Pinggang</th>
                                <th class="pb-3">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800/60">
                            @forelse($progressList as $item)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-colors">
                                <td class="py-3.5 font-mono font-bold text-zinc-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($item['recorded_at'])->format('d M Y') }}
                                </td>
                                <td class="py-3.5 font-mono font-black text-red-600 dark:text-red-400">
                                    {{ $item['weight_kg'] }} kg
                                </td>
                                <td class="py-3.5 font-mono text-[11px]">
                                    @if($item['diff'] !== null)
                                        @if($item['diff'] < 0)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold border border-emerald-500/20">
                                            &darr; {{ abs($item['diff']) }} kg
                                        </span>
                                        @elseif($item['diff'] > 0)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-500 font-bold border border-amber-500/20">
                                            &uarr; +{{ $item['diff'] }} kg
                                        </span>
                                        @else
                                        <span class="text-zinc-400 font-semibold px-2">0.0 kg</span>
                                        @endif
                                    @else
                                    <span class="text-zinc-400 text-[10px] font-semibold px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800">Awal</span>
                                    @endif
                                </td>
                                <td class="py-3.5 font-mono font-bold text-zinc-700 dark:text-zinc-300">
                                    {{ $item['bmi'] ?? '-' }}
                                </td>
                                <td class="py-3.5 font-mono text-zinc-600 dark:text-zinc-400">
                                    {{ $item['waist_cm'] ? $item['waist_cm'].' cm' : '-' }}
                                </td>
                                <td class="py-3.5 text-zinc-500 dark:text-zinc-400 text-[11px] max-w-xs truncate">
                                    {{ $item['notes'] ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-xs text-zinc-400">
                                    Belum ada data riwayat fisik tersimpan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table Footer -->
            <div class="mt-5 pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-[11px] text-zinc-500 dark:text-zinc-400">
                <span>Data riwayat penimbangan tersimpan aman pada sistem Maco Gym.</span>
                <span class="text-red-600 dark:text-red-400 font-bold uppercase tracking-wider text-[10px]">Maco Fitness Club</span>
            </div>
        </div>

    </div>

</div>
@endsection
