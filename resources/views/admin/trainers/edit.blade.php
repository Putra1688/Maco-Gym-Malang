@extends('layouts.admin')

@section('title', 'Edit Trainer - ' . $trainer->name)
@section('header', 'Edit Personal Trainer')

@section('content')
<div class="max-w-xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.trainers.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-red-600 transition flex items-center gap-1.5">
            <span>&larr;</span>
            <span>Kembali ke Daftar Trainer</span>
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg p-6 sm:p-8 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600">
        <div class="mb-6 pb-4 border-b border-zinc-100 dark:border-zinc-800">
            <h3 class="font-montserrat text-base sm:text-lg font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Perbarui Data Trainer</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Ubah nama, spesialisasi, atau foto pelatih.</p>
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

        <form action="{{ route('admin.trainers.update', $trainer) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Nama Trainer <span class="text-red-600">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $trainer->name) }}"
                       required
                       class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Spesialisasi / Keahlian <span class="text-red-600">*</span>
                </label>
                <input type="text"
                       name="specialty"
                       value="{{ old('specialty', $trainer->specialty) }}"
                       required
                       class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Nomor WhatsApp
                </label>
                <input type="text"
                       name="phone"
                       value="{{ old('phone', $trainer->phone) }}"
                       class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm font-mono outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                    Ganti Foto Profil (Opsional)
                </label>
                @if($trainer->photo_path)
                <div class="mb-3 flex items-center gap-3">
                    <img src="{{ asset('storage/' . $trainer->photo_path) }}" alt="{{ $trainer->name }}" class="w-12 h-12 rounded object-cover border border-zinc-200 dark:border-zinc-700">
                    <span class="text-xs text-zinc-400 font-mono">Foto saat ini</span>
                </div>
                @endif
                <input type="file"
                       name="photo"
                       accept="image/*"
                       class="w-full text-xs text-zinc-500 dark:text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:uppercase file:bg-red-50 dark:file:bg-red-950/40 file:text-red-600 dark:file:text-red-400 hover:file:bg-red-100 dark:hover:file:bg-red-900/50">
            </div>

            <div class="pt-2">
                <label class="inline-flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $trainer->is_active) ? 'checked' : '' }} class="rounded text-red-600 focus:ring-red-500 w-4 h-4">
                    <span class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Trainer aktif di sistem</span>
                </label>
            </div>

            <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-end gap-2.5">
                <a href="{{ route('admin.trainers.index') }}"
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
