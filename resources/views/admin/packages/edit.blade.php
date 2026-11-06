@extends('layouts.admin')

@section('title', 'Edit Paket - ' . $package->name)
@section('header', 'Edit Paket Layanan')

@section('content')
<div class="max-w-xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.packages.index') }}" class="text-xs text-slate-500 hover:text-amber-500 transition flex items-center gap-1">
            &larr; Kembali ke Daftar Paket
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-slate-700/80 shadow-sm">
        <div class="mb-6 pb-4 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Perbarui Paket Layanan</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Ubah nama, tipe, durasi masa aktif, atau harga paket.</p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-900 text-red-700 dark:text-red-300 text-sm">
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
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                    Nama Paket <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $package->name) }}"
                       required
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Tipe Layanan <span class="text-red-500">*</span>
                    </label>
                    <select name="type"
                            required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500 font-semibold">
                        <option value="membership" {{ old('type', $package->type) === 'membership' ? 'selected' : '' }}>Membership Rutin</option>
                        <option value="daily_visit" {{ old('type', $package->type) === 'daily_visit' ? 'selected' : '' }}>Visit Harian (Tamu)</option>
                        <option value="personal_trainer" {{ old('type', $package->type) === 'personal_trainer' ? 'selected' : '' }}>Personal Trainer</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Durasi Masa Aktif (Hari) <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           name="duration_days"
                           value="{{ old('duration_days', $package->duration_days) }}"
                           required
                           min="1"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                    Nominal Harga (Rp) <span class="text-red-500">*</span>
                </label>
                <input type="number"
                       name="price"
                       value="{{ old('price', (int)$package->price) }}"
                       required
                       min="0"
                       step="1000"
                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono font-bold text-amber-600 dark:text-amber-400 outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="pt-2">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }} class="rounded text-amber-500 focus:ring-amber-500 w-4 h-4">
                    <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">Paket aktif dan dapat dipilih di sistem kasir</span>
                </label>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.packages.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

