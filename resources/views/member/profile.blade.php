@extends('layouts.member')

@section('title', 'Profil & Catatan Fisik')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('member.dashboard') }}" class="text-xs text-slate-500 hover:text-amber-500 transition flex items-center gap-1">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <!-- Informasi Profil Member -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-slate-700/80 shadow-sm">
        <div class="flex items-center gap-4 pb-6 border-b border-slate-200 dark:border-slate-700">
            <div class="w-14 h-14 rounded-2xl bg-amber-500/10 border border-amber-500/30 text-amber-500 font-black text-xl flex items-center justify-center">
                {{ strtoupper(substr($member->name, 0, 2)) }}
            </div>
            <div>
                <span class="font-mono text-xs font-bold text-amber-500">{{ $member->card_id }}</span>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $member->name }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">Member Resmi Maco Gym Malang</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-6 text-sm">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase">Nomor WhatsApp</p>
                <p class="font-bold text-slate-900 dark:text-white font-mono mt-0.5">{{ $member->phone }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase">Jenis Kelamin</p>
                <p class="font-bold text-slate-900 dark:text-white mt-0.5">
                    {{ $member->gender === 'male' ? 'Laki-laki' : ($member->gender === 'female' ? 'Perempuan' : '-') }}
                </p>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase">Tanggal Bergabung</p>
                <p class="font-bold text-slate-900 dark:text-white font-mono mt-0.5">{{ $member->join_date->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Form & Riwayat Log Perkembangan Fisik (PRD 3.4 & 4.2) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Form Input Perkembangan Fisik -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm">
            <h4 class="font-bold text-slate-900 dark:text-white mb-2">Catat Perkembangan Fisik</h4>
            <p class="text-xs text-slate-500 dark:text-slate-400 mb-5">Pantau kenaikan massa otot atau penurunan kadar lemak Anda.</p>

            @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900 rounded-xl text-red-700 dark:text-red-300 text-xs">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('member.progress.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Berat Badan (kg) <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           step="0.1"
                           name="weight_kg"
                           required
                           placeholder="Contoh: 72.5"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Tinggi Badan (cm) <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           step="0.1"
                           name="height_cm"
                           required
                           placeholder="Contoh: 175"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Tanggal Pencatatan
                    </label>
                    <input type="date"
                           name="recorded_at"
                           value="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <button type="submit"
                        class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow transition">
                    + Simpan Data Fisik
                </button>
            </form>
        </div>

        <!-- Tabel Riwayat Perkembangan Fisik -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm overflow-hidden">
            <h4 class="font-bold text-slate-900 dark:text-white mb-4">Riwayat Pengukuran Fisik</h4>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-750 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-4 py-3">Tanggal Catat</th>
                            <th class="px-4 py-3">Berat (kg)</th>
                            <th class="px-4 py-3">Tinggi (cm)</th>
                            <th class="px-4 py-3">BMI Estimasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($member->progresses as $prog)
                        @php
                            $heightInM = $prog->height_cm / 100;
                            $bmi = $heightInM > 0 ? round($prog->weight_kg / ($heightInM * $heightInM), 1) : 0;
                        @endphp
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-750 transition text-xs">
                            <td class="px-4 py-3.5 font-mono font-bold text-slate-700 dark:text-slate-300">
                                {{ \Carbon\Carbon::parse($prog->recorded_at)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3.5 font-black text-amber-500 font-mono text-sm">
                                {{ $prog->weight_kg }} kg
                            </td>
                            <td class="px-4 py-3.5 font-mono text-slate-700 dark:text-slate-300">
                                {{ $prog->height_cm }} cm
                            </td>
                            <td class="px-4 py-3.5 font-mono">
                                <span class="px-2 py-0.5 rounded font-bold
                                    {{ $bmi < 18.5 ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $bmi >= 18.5 && $bmi <= 24.9 ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $bmi >= 25 ? 'bg-amber-100 text-amber-700' : '' }}">
                                    {{ $bmi }} ({{ $bmi < 18.5 ? 'Underweight' : ($bmi <= 24.9 ? 'Normal' : 'Overweight') }})
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-xs text-slate-400">
                                Belum ada riwayat perkembangan fisik yang dicatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection

