@extends('layouts.admin')

@section('title', 'Manajemen Member')
@section('header', 'Data & Keanggotaan Member')

@section('content')
<div class="space-y-6">

    <!-- Bar Aksi Atas: Filter & Tambah Member -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-5 border border-zinc-200 dark:border-zinc-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.members.index') }}" class="flex flex-wrap items-center gap-2.5 flex-1">
            <div class="relative flex-1 min-w-[220px]">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari ID Kartu, Nama, atau WhatsApp..."
                       class="w-full pl-9 pr-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-xs outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-mono">
                <svg class="w-4 h-4 text-zinc-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <select name="status"
                    onchange="this.form.submit()"
                    class="px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-xs outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-mono uppercase font-semibold">
                <option value="">SEMUA STATUS</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>AKTIF</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>KADALUARSA</option>
                <option value="pending_verification" {{ request('status') === 'pending_verification' ? 'selected' : '' }}>PENDING</option>
            </select>

            <button type="submit" class="px-3.5 py-2 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-800 dark:text-zinc-200 font-semibold text-xs rounded transition">
                Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('admin.members.index') }}" class="text-xs text-zinc-500 hover:text-red-500 font-semibold">
                Reset
            </a>
            @endif
        </form>

        <div>
            <a href="{{ route('admin.members.create') }}"
               class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center justify-center gap-1.5 self-start">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Daftar Member Baru</span>
            </a>
        </div>
    </div>

    <!-- Tabel Data Member -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-950/60 text-[10px] uppercase font-mono tracking-wider text-zinc-500 dark:text-zinc-400 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3">ID Kartu</th>
                        <th class="px-4 sm:px-6 py-3">Nama & Kontak</th>
                        <th class="px-4 sm:px-6 py-3 hidden md:table-cell">Gender</th>
                        <th class="px-4 sm:px-6 py-3">Masa Berlaku</th>
                        <th class="px-4 sm:px-6 py-3">Status</th>
                        <th class="px-4 sm:px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($members as $m)
                    @php
                        $daysLeft = now()->startOfDay()->diffInDays($m->current_expiry_date->startOfDay(), false);
                        $isExpired = $m->current_expiry_date->lt(now()->startOfDay()) || $m->status === 'expired';
                        $phoneFormatted = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $m->phone));
                        $waText = "Halo Kak {$m->name}, membership Maco Gym kamu berakhir pada {$m->current_expiry_date->format('d/m/Y')}. Yuk perpanjang agar latihanmu tetap rutin!";
                        $waUrl = "https://wa.me/{$phoneFormatted}?text=" . urlencode($waText);
                    @endphp
                    <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition">
                        <td class="px-4 sm:px-6 py-3.5 font-mono font-bold text-red-600 dark:text-red-400 text-xs">
                            {{ $m->card_id }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5">
                            <p class="font-bold text-zinc-900 dark:text-white">{{ $m->name }}</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 font-mono">{{ $m->phone }}</p>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-xs hidden md:table-cell text-zinc-600 dark:text-zinc-400 font-mono">
                            {{ $m->gender === 'male' ? 'LAKI-LAKI' : ($m->gender === 'female' ? 'PEREMPUAN' : '-') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-xs font-mono">
                            <p class="font-bold text-zinc-800 dark:text-zinc-200">{{ $m->current_expiry_date->format('d M Y') }}</p>
                            <p class="text-[11px] {{ $isExpired ? 'text-red-500 font-bold' : ($daysLeft <= 3 ? 'text-amber-500 font-bold' : 'text-zinc-400') }}">
                                {{ $isExpired ? 'KADALUARSA' : "SISA {$daysLeft} HARI" }}
                            </p>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5">
                            @if($isExpired)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-900/60">
                                EXPIRED
                            </span>
                            @elseif($daysLeft <= 3)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-900/60">
                                H-{{ max(0, $daysLeft) }}
                            </span>
                            @elseif($m->status === 'active')
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/60">
                                AKTIF
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700">
                                PENDING
                            </span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-right">
                            <div class="inline-flex items-center gap-1.5">
                                <a href="{{ $waUrl }}"
                                   target="_blank"
                                   title="Chat WhatsApp Reminder"
                                   class="p-1.5 rounded bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition border border-emerald-200 dark:border-emerald-900/60">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                    </svg>
                                </a>

                                <a href="{{ route('admin.members.show', $m) }}"
                                   class="px-2.5 py-1 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-800 dark:text-zinc-200 text-xs font-semibold rounded transition border border-zinc-200 dark:border-zinc-700">
                                    Detail
                                </a>

                                <a href="{{ route('admin.members.edit', $m) }}"
                                   class="p-1.5 text-zinc-400 hover:text-red-600 dark:hover:text-red-400 rounded hover:bg-zinc-100 dark:hover:bg-zinc-800 transition"
                                   title="Edit Data">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-xs text-zinc-400">
                            Tidak ada data member yang sesuai dengan pencarian atau filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
        <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
            {{ $members->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
