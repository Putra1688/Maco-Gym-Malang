@extends('layouts.admin')

@section('title', 'Detail Member - ' . $member->name)
@section('header', 'Profil & Riwayat Member')

@section('content')
@php
    $daysLeft = now()->startOfDay()->diffInDays($member->current_expiry_date->startOfDay(), false);
    $isExpired = $member->current_expiry_date->lt(now()->startOfDay()) || $member->status === 'expired';
    $phoneFormatted = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $member->phone));
    $waText = "Halo Kak {$member->name}, membership Maco Gym kamu berakhir pada {$member->current_expiry_date->format('d/m/Y')}. Yuk perpanjang agar latihanmu tetap rutin!";
    $waUrl = "https://wa.me/{$phoneFormatted}?text=" . urlencode($waText);
@endphp

<div class="space-y-6" x-data="{ showRenewModal: false }">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.members.index') }}" class="text-xs text-slate-500 hover:text-amber-500 transition flex items-center gap-1">
            &larr; Kembali ke Daftar Member
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.members.edit', $member) }}"
               class="px-3.5 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 text-xs font-semibold rounded-xl transition">
                Edit Data
            </a>
            <button type="button"
                    @click="showRenewModal = true"
                    class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow transition">
                + Perpanjang Membership
            </button>
        </div>
    </div>

    <!-- Kartu Profil Member -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 sm:p-8 border border-slate-200 dark:border-slate-700/80 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200 dark:border-slate-700">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 text-slate-950 font-black text-2xl flex items-center justify-center shadow-md">
                    {{ strtoupper(substr($member->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-xs font-bold text-amber-600 dark:text-amber-400 bg-amber-500/10 px-2 py-0.5 rounded border border-amber-500/20">
                            {{ $member->card_id }}
                        </span>
                        @if($isExpired)
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-300 border border-red-300 dark:border-red-800">
                            🔴 Kadaluarsa
                        </span>
                        @elseif($daysLeft <= 3)
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-300 dark:border-amber-800">
                            🟡 Hampir Habis (H-{{ max(0, $daysLeft) }})
                        </span>
                        @else
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800">
                            🟢 Aktif (Sisa {{ $daysLeft }} Hari)
                        </span>
                        @endif
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $member->name }}</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Bergabung sejak {{ $member->join_date->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Tombol WhatsApp Follow-Up -->
            <div>
                <a href="{{ $waUrl }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>Kirim Pesan WhatsApp</span>
                </a>
            </div>
        </div>

        <!-- Detail Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-6">
            <div>
                <p class="text-[11px] uppercase font-bold text-slate-400">Nomor Telepon / WA</p>
                <p class="font-mono font-bold text-sm text-slate-800 dark:text-slate-200 mt-0.5">{{ $member->phone }}</p>
            </div>
            <div>
                <p class="text-[11px] uppercase font-bold text-slate-400">Jenis Kelamin</p>
                <p class="font-bold text-sm text-slate-800 dark:text-slate-200 mt-0.5">
                    {{ $member->gender === 'male' ? 'Laki-laki' : ($member->gender === 'female' ? 'Perempuan' : '-') }}
                </p>
            </div>
            <div>
                <p class="text-[11px] uppercase font-bold text-slate-400">Jatuh Tempo Membership</p>
                <p class="font-mono font-bold text-sm text-slate-800 dark:text-slate-200 mt-0.5">{{ $member->current_expiry_date->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-[11px] uppercase font-bold text-slate-400">Akun Portal Member</p>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">
                    User: <strong class="font-mono">{{ $member->user?->phone ?? $member->phone }}</strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Riwayat Presensi & Transaksi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Riwayat Kehadiran (Attendances) -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm p-5">
            <h4 class="font-bold text-slate-900 dark:text-white mb-4">Riwayat Presensi Kehadiran</h4>
            <div class="space-y-2.5 max-h-96 overflow-y-auto pr-1">
                @forelse($member->attendances as $att)
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200/50 dark:border-slate-700/50 text-xs">
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white font-mono">{{ $att->checkin_time->format('d M Y, H:i') }} WIB</p>
                        <p class="text-slate-400 text-[11px]">{{ $att->notes ?? 'Check-in frontdesk' }}</p>
                    </div>
                    <span class="px-2 py-0.5 rounded font-bold bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400">
                        Hadir
                    </span>
                </div>
                @empty
                <p class="text-center py-8 text-xs text-slate-400">Belum ada catatan presensi untuk member ini.</p>
                @endforelse
            </div>
        </div>

        <!-- Riwayat Transaksi / Pembayaran -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm p-5">
            <h4 class="font-bold text-slate-900 dark:text-white mb-4">Riwayat Pembayaran & Perpanjangan</h4>
            <div class="space-y-2.5 max-h-96 overflow-y-auto pr-1">
                @forelse($member->transactions as $tx)
                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-750 border border-slate-200/50 dark:border-slate-700/50 text-xs">
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $tx->package?->name ?? 'Membership' }}</p>
                        <p class="text-slate-400 font-mono text-[11px]">{{ $tx->invoice_code }} • {{ $tx->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-900 dark:text-white">Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                        <span class="px-2 py-0.5 rounded font-mono font-bold text-[10px] uppercase bg-amber-500/10 text-amber-600 dark:text-amber-400">
                            {{ $tx->payment_method }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-center py-8 text-xs text-slate-400">Belum ada riwayat transaksi.</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Modal Perpanjangan Membership Cepat (PRD 3.2: 1-Klik Renewal) -->
    <div x-show="showRenewModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm animate-fadeIn">
        <div @click.away="showRenewModal = false"
             class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 border border-slate-200 dark:border-slate-700 shadow-2xl">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Perpanjang Membership</h3>
                    <p class="text-xs text-slate-500">{{ $member->name }} ({{ $member->card_id }})</p>
                </div>
                <button @click="showRenewModal = false" class="p-1 rounded-lg text-slate-400 hover:text-white">✕</button>
            </div>

            <form action="{{ route('admin.members.renew', $member) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Pilih Paket Perpanjangan
                    </label>
                    <select name="package_id"
                            required
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/50 border border-slate-300 dark:border-slate-600 rounded-xl text-sm outline-none focus:ring-2 focus:ring-amber-500 font-semibold">
                        @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}">
                            {{ $pkg->name }} ({{ $pkg->duration_days }} Hari) — Rp {{ number_format($pkg->price, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">Jika kartu masih aktif, durasi akan ditambahkan langsung dari tanggal jatuh tempo saat ini.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Metode Pembayaran
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center justify-center gap-1 p-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-xs font-semibold cursor-pointer">
                            <input type="radio" name="payment_method" value="cash" checked class="text-amber-500">
                            <span>Cash</span>
                        </label>
                        <label class="flex items-center justify-center gap-1 p-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-xs font-semibold cursor-pointer">
                            <input type="radio" name="payment_method" value="qris" class="text-amber-500">
                            <span>QRIS</span>
                        </label>
                        <label class="flex items-center justify-center gap-1 p-2.5 rounded-xl border border-slate-300 dark:border-slate-600 text-xs font-semibold cursor-pointer">
                            <input type="radio" name="payment_method" value="transfer" class="text-amber-500">
                            <span>Transfer</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-200 dark:border-slate-700">
                    <button type="button" @click="showRenewModal = false" class="px-4 py-2 border rounded-xl text-xs font-semibold">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow">
                        Konfirmasi Perpanjang
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

