@extends('layouts.admin')

@section('title', 'Edit Paket - ' . $package->name)
@section('header', 'Edit Paket Layanan')

@section('content')
<div class="max-w-xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.packages.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-red-600 transition flex items-center gap-1.5">
            <span>&larr;</span>
            <span>Kembali ke Daftar Paket</span>
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg p-6 sm:p-8 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600">
        <div class="mb-6 pb-4 border-b border-zinc-100 dark:border-zinc-800">
            <h3 class="font-montserrat text-base sm:text-lg font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Perbarui Paket Layanan</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Ubah nama, tipe, durasi masa aktif, atau harga paket.</p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 rounded bg-red-50 dark:bg-red-950/40 border-l-4 border-l-red-600 border border-red-200 dark:border-red-900/60 text-red-700 dark:text-red-300 text-xs">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.packages.update', $package) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Nama Paket <span class="text-red-600">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $package->name) }}"
                       required
                       class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Tipe Layanan <span class="text-red-600">*</span>
                    </label>
                    <select name="type"
                            required
                            class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 font-semibold text-zinc-900 dark:text-white">
                        <option value="membership" {{ old('type', $package->type) === 'membership' ? 'selected' : '' }}>Membership Rutin</option>
                        <option value="daily_visit" {{ old('type', $package->type) === 'daily_visit' ? 'selected' : '' }}>Visit Harian (Tamu)</option>
                        <option value="personal_trainer" {{ old('type', $package->type) === 'personal_trainer' ? 'selected' : '' }}>Personal Trainer</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Durasi Masa Aktif (Hari) <span class="text-red-600">*</span>
                    </label>
                    <input type="number"
                           name="duration_days"
                           value="{{ old('duration_days', $package->duration_days) }}"
                           required
                           min="1"
                           class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm font-mono outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Nominal Harga (Rp) <span class="text-red-600">*</span>
                </label>
                <input type="number"
                       name="price"
                       value="{{ old('price', (int)$package->price) }}"
                       required
                       min="0"
                       step="1000"
                       class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm font-mono font-bold text-red-600 dark:text-red-400 outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600">
            </div>

            <div class="pt-2">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }} class="rounded text-red-600 focus:ring-red-500 w-4 h-4">
                    <span class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Paket aktif dan dapat dipilih di sistem kasir</span>
                </label>
            </div>

            <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-end gap-2.5">
                <a href="{{ route('admin.packages.index') }}"
                   class="px-4 py-2 rounded border border-zinc-300 dark:border-zinc-700 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
