@extends('layouts.admin')

@section('title', 'Manajemen Paket & Layanan')
@section('header', 'CMS Paket & Layanan')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="font-montserrat text-base sm:text-lg font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Daftar Paket & Tiket Gym</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Pengaturan harga tiket harian, paket membership bulanan, serta sesi personal trainer.</p>
        </div>

        <a href="{{ route('admin.packages.create') }}"
           class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center gap-1.5 self-start">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Paket Baru</span>
        </a>
    </div>

    <!-- Grid Paket Cards: Athletic Tiers -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($packages as $pkg)
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 sm:p-6 border border-zinc-200 dark:border-zinc-800 flex flex-col justify-between relative
            {{ $pkg->type === 'membership' ? 'border-t-2 border-t-red-600' : '' }}
            {{ $pkg->type === 'daily_visit' ? 'border-t-2 border-t-emerald-600' : '' }}
            {{ $pkg->type === 'personal_trainer' ? 'border-t-2 border-t-blue-600' : '' }}">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider
                        {{ $pkg->type === 'membership' ? 'bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-900/60' : '' }}
                        {{ $pkg->type === 'daily_visit' ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/60' : '' }}
                        {{ $pkg->type === 'personal_trainer' ? 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900/60' : '' }}">
                        {{ $pkg->type === 'membership' ? 'MEMBERSHIP' : ($pkg->type === 'daily_visit' ? 'VISIT HARIAN' : 'PERSONAL TRAINER') }}
                    </span>

                    @if($pkg->is_active)
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-mono font-bold uppercase text-emerald-600 dark:text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> AKTIF
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-mono font-bold uppercase text-zinc-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span> NONAKTIF
                    </span>
                    @endif
                </div>

                <h4 class="font-montserrat text-base font-bold uppercase tracking-wide text-zinc-900 dark:text-white">{{ $pkg->name }}</h4>
                <p class="text-2xl font-black text-zinc-900 dark:text-white mt-2 font-mono">
                    Rp {{ number_format($pkg->price, 0, ',', '.') }}
                </p>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 font-mono">
                    Masa Aktif: <strong class="text-zinc-800 dark:text-zinc-200">{{ $pkg->duration_days }} Hari</strong>
                </p>
            </div>

            <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                <a href="{{ route('admin.packages.edit', $pkg) }}"
                   class="text-xs font-bold text-zinc-700 dark:text-zinc-300 hover:text-red-600 dark:hover:text-red-400 flex items-center gap-1.5 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <span>Edit Paket</span>
                </a>

                <form action="{{ route('admin.packages.destroy', $pkg) }}"
                      method="POST"
                      onsubmit="return confirm('Hapus paket {{ $pkg->name }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-semibold transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-12 text-center text-xs text-zinc-400 bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800">
            Belum ada paket yang terdaftar.
        </div>
        @endforelse
    </div>

</div>
@endsection
