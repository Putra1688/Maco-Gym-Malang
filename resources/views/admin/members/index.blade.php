@extends('layouts.admin')

@section('title', 'Manajemen Member')
@section('header', 'Data & Keanggotaan Member')

@section('content')
<div class="space-y-6">

    <!-- Bar Aksi Atas: Filter & Tambah Member -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200 dark:border-slate-700/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.members.index') }}" class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[220px]">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari ID Kartu, Nama, atau WhatsApp..."
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <select name="status"
                    onchange="this.form.submit()"
                    class="px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>🟢 Aktif</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>🔴 Kadaluarsa</option>
                <option value="pending_verification" {{ request('status') === 'pending_verification' ? 'selected' : '' }}>⚪ Pending</option>
            </select>

            <button type="submit" class="px-4 py-2.5 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 font-semibold text-xs rounded-xl transition">
                Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('admin.members.index') }}" class="text-xs text-slate-500 hover:text-red-500">
                Reset
            </a>
            @endif
        </form>

        <div>
            <a href="{{ route('admin.members.create') }}"
               class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-sm rounded-xl shadow-md transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Daftar Member Baru</span>
            </a>
        </div>
    </div>

    <!-- Tabel Data Member -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-750 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3.5">ID Kartu</th>
                        <th class="px-6 py-3.5">Nama & Kontak</th>
                        <th class="px-6 py-3.5">Jenis Kelamin</th>
                        <th class="px-6 py-3.5">Masa Aktif Hingga</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($members as $m)
                    @php
                        $daysLeft = now()->startOfDay()->diffInDays($m->current_expiry_date->startOfDay(), false);
                        $isExpired = $m->current_expiry_date->lt(now()->startOfDay()) || $m->status === 'expired';
                        $phoneFormatted = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $m->phone));
                        $waText = "Halo Kak {$m->name}, membership Maco Gym kamu berakhir pada {$m->current_expiry_date->format('d/m/Y')}. Yuk perpanjang agar latihanmu tetap rutin!";
                        $waUrl = "https://wa.me/{$phoneFormatted}?text=" . urlencode($waText);
                    @endphp
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                        <td class="px-6 py-4 font-mono font-bold text-amber-600 dark:text-amber-400 text-xs">
                            {{ $m->card_id }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900 dark:text-white">{{ $m->name }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-mono">{{ $m->phone }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs">
                            {{ $m->gender === 'male' ? 'Laki-laki' : ($m->gender === 'female' ? 'Perempuan' : '-') }}
                        </td>
                        <td class="px-6 py-4 text-xs font-mono">
                            <p class="font-bold text-slate-800 dark:text-slate-200">{{ $m->current_expiry_date->format('d M Y') }}</p>
                            <p class="text-[11px] {{ $isExpired ? 'text-red-500 font-bold' : ($daysLeft <= 3 ? 'text-amber-500 font-bold' : 'text-slate-400') }}">
                                {{ $isExpired ? 'Kadaluarsa' : "Sisa {$daysLeft} Hari" }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            @if($isExpired)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-300 border border-red-300 dark:border-red-800">
                                🔴 Expired
                            </span>
                            @elseif($daysLeft <= 3)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-300 dark:border-amber-800">
                                🟡 H-{{ max(0, $daysLeft) }}
                            </span>
                            @elseif($m->status === 'active')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800">
                                🟢 Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                Pending
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ $waUrl }}"
                                   target="_blank"
                                   title="Chat WhatsApp Reminder"
                                   class="p-2 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                    </svg>
                                </a>

                                <a href="{{ route('admin.members.show', $m) }}"
                                   class="px-3 py-1.5 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 text-xs font-semibold rounded-lg transition">
                                    Detail
                                </a>

                                <a href="{{ route('admin.members.edit', $m) }}"
                                   class="p-2 text-slate-500 hover:text-amber-500 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition"
                                   title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                            Tidak ditemukan data member sesuai kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
        <div class="p-4 border-t border-slate-200 dark:border-slate-750">
            {{ $members->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

