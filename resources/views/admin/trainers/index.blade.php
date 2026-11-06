@extends('layouts.admin')

@section('title', 'Manajemen Personal Trainer')
@section('header', 'CMS Personal Trainer')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Pelatih & Personal Trainer</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400">Kelola data trainer bersertifikat untuk profil website & sesi privat.</p>
        </div>

        <a href="{{ route('admin.trainers.create') }}"
           class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2 self-start">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Trainer Baru</span>
        </a>
    </div>

    <!-- Grid Kartu Trainer -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($trainers as $trainer)
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm overflow-hidden flex flex-col justify-between">
            <div class="p-6">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 dark:bg-slate-700 overflow-hidden flex-shrink-0 flex items-center justify-center font-bold text-lg text-amber-500 border border-slate-200 dark:border-slate-600">
                        @if($trainer->photo_path)
                            <img src="{{ asset('storage/' . $trainer->photo_path) }}" alt="{{ $trainer->name }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($trainer->name, 0, 2)) }}
                        @endif
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            @if($trainer->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-400">
                                Nonaktif
                            </span>
                            @endif
                        </div>
                        <h4 class="text-base font-extrabold text-slate-900 dark:text-white">{{ $trainer->name }}</h4>
                        <p class="text-xs font-semibold text-amber-600 dark:text-amber-400 mt-0.5">{{ $trainer->specialty }}</p>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-750 text-xs text-slate-500 dark:text-slate-400">
                    <p>Kontak WhatsApp: <strong class="text-slate-800 dark:text-slate-200 font-mono">{{ $trainer->phone ?? '-' }}</strong></p>
                </div>
            </div>

            <div class="px-6 py-3 bg-slate-50 dark:bg-slate-750 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <a href="{{ route('admin.trainers.edit', $trainer) }}"
                   class="text-xs font-bold text-slate-700 dark:text-slate-300 hover:text-amber-500 transition flex items-center gap-1">
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
                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-semibold">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-12 text-center text-slate-400 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
            Belum ada data trainer yang ditambahkan.
        </div>
        @endforelse
    </div>

</div>
@endsection

