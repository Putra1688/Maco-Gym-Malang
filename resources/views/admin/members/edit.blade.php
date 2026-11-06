@extends('layouts.admin')

@section('title', 'Edit Member - ' . $member->name)
@section('header', 'Edit Data Member')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.members.show', $member) }}" class="text-xs text-slate-500 hover:text-amber-500 transition flex items-center gap-1">
            &larr; Kembali ke Profil Member
        </a>

        <!-- Form Hapus Member -->
        <form action="{{ route('admin.members.destroy', $member) }}"
              method="POST"
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus member {{ $member->name }}? Tindakan ini tidak dapat dibatalkan!');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-semibold transition">
                Hapus Member
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-slate-700/80 shadow-sm">
        <div class="mb-6 pb-4 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Perbarui Informasi Member</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Mengubah data profil, nomor kartu fisik, atau status masa aktif.</p>
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

        <form action="{{ route('admin.members.update', $member) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Nomor ID Kartu Fisik <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="card_id"
                           value="{{ old('card_id', $member->card_id) }}"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono font-bold text-amber-600 dark:text-amber-400 uppercase outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $member->name) }}"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Nomor WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $member->phone) }}"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Jenis Kelamin
                    </label>
                    <select name="gender"
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ old('gender', $member->gender) === 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender', $member->gender) === 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200 dark:border-slate-700 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Status Keanggotaan <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                            required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500 font-semibold">
                        <option value="active" {{ old('status', $member->status) === 'active' ? 'selected' : '' }}>🟢 Aktif</option>
                        <option value="expired" {{ old('status', $member->status) === 'expired' ? 'selected' : '' }}>🔴 Kadaluarsa</option>
                        <option value="pending_verification" {{ old('status', $member->status) === 'pending_verification' ? 'selected' : '' }}>⚪ Pending</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        Tanggal Jatuh Tempo <span class="text-red-500">*</span>
                    </label>
                    <input type="date"
                           name="current_expiry_date"
                           value="{{ old('current_expiry_date', $member->current_expiry_date->format('Y-m-d')) }}"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-sm font-mono outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.members.show', $member) }}"
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

