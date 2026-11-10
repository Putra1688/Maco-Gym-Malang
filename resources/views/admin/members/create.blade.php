@extends('layouts.admin')

@section('title', 'Pendaftaran Member Baru')
@section('header', 'Pendaftaran Member Baru (Walk-in)')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.members.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-red-600 transition flex items-center gap-1.5">
            <span>&larr;</span>
            <span>Kembali ke Daftar Member</span>
        </a>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg p-6 sm:p-8 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600">
        <div class="mb-6 pb-4 border-b border-zinc-100 dark:border-zinc-800">
            <h3 class="font-montserrat text-base sm:text-lg font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Formulir Pendaftaran Member di Tempat</h3>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Data akan otomatis membuat akun member portal (password default: <code class="text-red-600 dark:text-red-400 font-mono font-bold">member123</code>) dan mencatat transaksi kas.
            </p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 rounded bg-red-50 dark:bg-red-950/40 border-l-4 border-l-red-600 border border-red-200 dark:border-red-900/60 text-red-800 dark:text-red-300 text-xs">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.members.store') }}"
              method="POST"
              onsubmit="if(this.submitting) return false; this.submitting = true; document.getElementById('submit-member-btn').disabled = true; document.getElementById('submit-member-btn').textContent = 'Mendaftarkan...';"
              class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- ID Kartu Fisik -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Nomor ID Kartu Fisik <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                           name="card_id"
                           value="{{ old('card_id') }}"
                           required
                           placeholder="Contoh: MC-001"
                           class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm font-mono font-bold text-red-600 dark:text-red-400 uppercase outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600">
                    <p class="text-[11px] text-zinc-400 font-mono mt-1">Nomor fisik pada kartu RFID/Barcode.</p>
                </div>

                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Nama Lengkap <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           placeholder="Contoh: Alexander Pratama"
                           class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- No WhatsApp -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Nomor WhatsApp (Aktif) <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           required
                           placeholder="Contoh: 081234567890"
                           class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm font-mono outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Jenis Kelamin
                    </label>
                    <select name="gender"
                            class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Status Pendaftaran -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Status Pendaftaran <span class="text-red-600">*</span>
                    </label>
                    <select name="status"
                            class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-semibold">
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>AKTIF (Pembayaran Lunas & Verifikasi Langsung)</option>
                        <option value="pending_verification" {{ old('status') === 'pending_verification' ? 'selected' : '' }}>PENDING (Menunggu Pembayaran & Verifikasi)</option>
                    </select>
                    <p class="text-[11px] text-zinc-400 font-mono mt-1">
                        Pilih <strong>PENDING</strong> jika member baru mendaftar dan belum menyelesaikan proses aktivasi/pembayaran.
                    </p>
                </div>

                <!-- Paket Membership Awal -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Paket Membership yang Dipilih <span class="text-red-600">*</span>
                    </label>
                    <select name="package_id"
                            required
                            class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-semibold">
                        <option value="">-- Pilih Paket Membership --</option>
                        @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}" {{ old('package_id') == $pkg->id ? 'selected' : '' }}>
                            {{ $pkg->name }} ({{ $pkg->duration_days }} Hari) — Rp {{ number_format($pkg->price, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                <!-- Metode Pembayaran -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1.5">
                        Metode Pembayaran Kas <span class="text-red-600">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center justify-center gap-1.5 p-2 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 cursor-pointer hover:border-red-600 text-xs font-bold text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="cash" checked class="text-red-600 focus:ring-red-500">
                            <span>Cash</span>
                        </label>
                        <label class="flex items-center justify-center gap-1.5 p-2 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 cursor-pointer hover:border-red-600 text-xs font-bold text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="qris" {{ old('payment_method') === 'qris' ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
                            <span>QRIS</span>
                        </label>
                        <label class="flex items-center justify-center gap-1.5 p-2 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 cursor-pointer hover:border-red-600 text-xs font-bold text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }} class="text-red-600 focus:ring-red-500">
                            <span>Transfer</span>
                        </label>
                    </div>
                    <p class="text-[11px] text-zinc-400 font-mono mt-1">* Jika status Pending, transaksi kas baru tercatat saat diverifikasi.</p>
                </div>

                <!-- Opsi Langsung Check-in Walk-in -->
                <div class="p-3.5 rounded-lg bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 flex items-center">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox"
                               name="checkin_now"
                               value="1"
                               checked
                               class="w-4 h-4 text-red-600 rounded focus:ring-red-500">
                        <div>
                            <span class="text-xs font-bold text-zinc-900 dark:text-white">Langsung catat presensi check-in hari ini</span>
                            <p class="text-[11px] text-zinc-500">Otomatis mencatat check-in awal (khusus pendaftaran aktif).</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-end gap-2.5">
                <a href="{{ route('admin.members.index') }}"
                   class="px-4 py-2 rounded border border-zinc-300 dark:border-zinc-700 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                    Batal
                </a>
                <button type="submit"
                        id="submit-member-btn"
                        class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition cursor-pointer disabled:opacity-50">
                    Simpan & Daftarkan Member
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
