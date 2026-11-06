@extends('layouts.admin')

@section('title', 'Manajemen Paket & Layanan')
@section('header', 'CMS Manajemen Paket & Harga')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Paket & Tiket Gym</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400">Pengaturan harga tiket harian, paket membership bulanan, serta sesi personal trainer.</p>
        </div>

        <a href="{{ route('admin.packages.create') }}"
           class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2 self-start">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Paket Baru</span>
        </a>
    </div>

    <!-- Grid Paket Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($packages as $pkg)
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm flex flex-col justify-between relative overflow-hidden">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider
                        {{ $pkg->type === 'membership' ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20' : '' }}
                        {{ $pkg->type === 'daily_visit' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20' : '' }}
                        {{ $pkg->type === 'personal_trainer' ? 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20' : '' }}">
                        {{ $pkg->type === 'membership' ? 'Membership' : ($pkg->type === 'daily_visit' ? 'Visit Harian' : 'Personal Trainer') }}
                    </span>

                    @if($pkg->is_active)
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 dark:text-emerald-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Aktif
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span> Nonaktif
                    </span>
                    @endif
                </div>

                <h4 class="text-xl font-black text-slate-900 dark:text-white">{{ $pkg->name }}</h4>
                <p class="text-2xl font-black text-amber-500 mt-2 font-mono">
                    Rp {{ number_format($pkg->price, 0, ',', '.') }}
                </p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Durasi Masa Aktif: <strong class="text-slate-700 dark:text-slate-300 font-mono">{{ $pkg->duration_days }} Hari</strong>
                </p>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <a href="{{ route('admin.packages.edit', $pkg) }}"
                   class="text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-amber-500 flex items-center gap-1">
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
                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-semibold">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-12 text-center text-slate-400 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
            Belum ada paket yang terdaftar.
        </div>
        @endforelse
    </div>

</div>
@endsection

