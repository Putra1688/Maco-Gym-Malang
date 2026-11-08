@extends('layouts.admin')

@section('title', 'Manajemen Personal Trainer')
@section('header', 'CMS Personal Trainer')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="font-montserrat text-base sm:text-lg font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Daftar Pelatih & Personal Trainer</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Kelola data trainer bersertifikat untuk profil website & sesi privat.</p>
        </div>

        <a href="{{ route('admin.trainers.create') }}"
           class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition flex items-center gap-1.5 self-start">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Trainer Baru</span>
        </a>
    </div>

    <!-- Grid Kartu Trainer: Athletic Roster -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($trainers as $trainer)
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600 flex flex-col justify-between overflow-hidden">
            <div class="p-5 sm:p-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded bg-zinc-100 dark:bg-zinc-800 overflow-hidden shrink-0 flex items-center justify-center font-bold text-lg text-red-600 dark:text-red-400 border border-zinc-200 dark:border-zinc-700">
                        @if($trainer->photo_path)
                            <img src="{{ asset('storage/' . $trainer->photo_path) }}" alt="{{ $trainer->name }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($trainer->name, 0, 2)) }}
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            @if($trainer->is_active)
                            <span class="inline-flex items-center gap-1 text-[10px] font-mono font-bold uppercase text-emerald-600 dark:text-emerald-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> AKTIF
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 text-[10px] font-mono font-bold uppercase text-zinc-400">
                                <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span> NONAKTIF
                            </span>
                            @endif
                        </div>
                        <h4 class="font-montserrat text-sm sm:text-base font-bold uppercase tracking-wide text-zinc-900 dark:text-white">{{ $trainer->name }}</h4>
                        <p class="text-xs font-semibold text-red-600 dark:text-red-400 mt-0.5">{{ $trainer->specialty }}</p>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-zinc-100 dark:border-zinc-800 text-xs text-zinc-500 dark:text-zinc-400">
                    <p>WhatsApp: <strong class="text-zinc-800 dark:text-zinc-200 font-mono">{{ $trainer->phone ?? '-' }}</strong></p>
                </div>
            </div>

            <div class="px-5 py-3 bg-zinc-50 dark:bg-zinc-950/60 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                <a href="{{ route('admin.trainers.edit', $trainer) }}"
                   class="text-xs font-bold text-zinc-700 dark:text-zinc-300 hover:text-red-600 dark:hover:text-red-400 transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <span>Edit Data</span>
                </a>

                <form action="{{ route('admin.trainers.destroy', $trainer) }}"
                      method="POST"
                      onsubmit="return confirm('Hapus pelatih {{ $trainer->name }}?');">
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
            Belum ada data trainer yang ditambahkan.
        </div>
        @endforelse
    </div>

</div>
@endsection
