@extends('layouts.admin')

@section('title', 'Pendaftaran Member Baru')
@section('header', 'Pendaftaran Member Baru (Walk-in)')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.members.index') }}" class="text-xs text-slate-500 hover:text-amber-500 transition flex items-center gap-1">
            &larr; Kembali ke Daftar Member
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-slate-700/80 shadow-sm">
        <div class="mb-6 pb-4 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Formulir Pendaftaran Member di Tempat</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                Data akan otomatis membuat akun member portal (password default: <code class="text-amber-500 font-mono">member123</code>) dan mencatat transaksi kas.
            </p>
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

        <form action="{{ route('admin.members.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- ID Kartu Fisik -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Nomor ID Kartu Fisik <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="card_id"
                           value="{{ old('card_id') }}"
                           required
                           placeholder="Contoh: MC-001"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono font-bold text-amber-600 dark:text-amber-400 uppercase outline-none focus:ring-2 focus:ring-amber-500">
                    <p class="text-[11px] text-slate-400 mt-1">Nomor tercetak pada kartu fisik yang diserahkan ke member.</p>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           placeholder="Contoh: Alexander Pratama"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- No WhatsApp -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Nomor WhatsApp (Aktif) <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           required
                           placeholder="Contoh: 081234567890"
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Jenis Kelamin
                    </label>
                    <select name="gender"
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200 dark:border-slate-700 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Paket Membership Awal -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Paket Membership Awal <span class="text-red-500">*</span>
                    </label>
                    <select name="package_id"
                            required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500 font-semibold">
                        @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}" {{ old('package_id') == $pkg->id ? 'selected' : '' }}>
                            {{ $pkg->name }} ({{ $pkg->duration_days }} Hari) — Rp {{ number_format($pkg->price, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Metode Pembayaran Kasir <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center justify-center gap-1.5 p-2.5 rounded-xl border border-slate-300 dark:border-slate-700 cursor-pointer text-xs font-semibold hover:border-amber-500">
                            <input type="radio" name="payment_method" value="cash" checked class="text-amber-500">
                            <span>Cash</span>
                        </label>
                        <label class="flex items-center justify-center gap-1.5 p-2.5 rounded-xl border border-slate-300 dark:border-slate-700 cursor-pointer text-xs font-semibold hover:border-amber-500">
                            <input type="radio" name="payment_method" value="qris" {{ old('payment_method') === 'qris' ? 'checked' : '' }} class="text-amber-500">
                            <span>QRIS</span>
                        </label>
                        <label class="flex items-center justify-center gap-1.5 p-2.5 rounded-xl border border-slate-300 dark:border-slate-700 cursor-pointer text-xs font-semibold hover:border-amber-500">
                            <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }} class="text-amber-500">
                            <span>Transfer</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.members.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 text-xs font-semibold text-slate-700 dark:text-slate-300">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow-md transition">
                    Simpan & Daftarkan Member
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

