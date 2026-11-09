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
        <a href="{{ route('admin.members.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-red-600 transition flex items-center gap-1.5">
            <span>&larr;</span>
            <span>Kembali ke Daftar Member</span>
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.members.edit', $member) }}"
               class="px-3.5 py-1.5 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-800 dark:text-zinc-200 text-xs font-semibold rounded border border-zinc-200 dark:border-zinc-700 transition">
                Edit Data
            </a>
            <button type="button"
                    @click="showRenewModal = true"
                    class="px-4 py-1.5 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition">
                + Perpanjang Membership
            </button>
        </div>
    </div>

    <!-- Kartu Profil Member: Athlete Dossier -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg p-6 sm:p-8 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-zinc-100 dark:border-zinc-800">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-red-600 dark:text-red-400 font-montserrat font-black text-2xl flex items-center justify-center shrink-0">
                    {{ strtoupper(substr($member->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-mono text-xs font-bold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-950/40 px-2 py-0.5 rounded border border-red-200 dark:border-red-900/60">
                            {{ $member->card_id }}
                        </span>
                        @if($isExpired)
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-900/60">
                            EXPIRED
                        </span>
                        @elseif($daysLeft <= 3)
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-900/60">
                            H-{{ max(0, $daysLeft) }}
                        </span>
                        @else
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/60">
                            AKTIF (SISA {{ $daysLeft }} HARI)
                        </span>
                        @endif
                    </div>
                    <h2 class="font-montserrat text-xl sm:text-2xl font-black uppercase tracking-tight text-zinc-900 dark:text-white mt-1">{{ $member->name }}</h2>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 font-mono">Bergabung sejak {{ $member->join_date->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Tombol WhatsApp Follow-Up -->
            <div>
                <a href="{{ $waUrl }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition">
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
                <span class="text-[10px] font-mono uppercase font-bold text-zinc-400">Nomor WhatsApp</span>
                <p class="font-mono font-bold text-sm text-zinc-900 dark:text-zinc-100 mt-0.5">{{ $member->phone }}</p>
            </div>
            <div>
                <span class="text-[10px] font-mono uppercase font-bold text-zinc-400">Jenis Kelamin</span>
                <p class="font-bold text-sm text-zinc-900 dark:text-zinc-100 mt-0.5 font-mono">
                    {{ $member->gender === 'male' ? 'LAKI-LAKI' : ($member->gender === 'female' ? 'PEREMPUAN' : '-') }}
                </p>
            </div>
            <div>
                <span class="text-[10px] font-mono uppercase font-bold text-zinc-400">Jatuh Tempo Membership</span>
                <p class="font-mono font-bold text-sm text-zinc-900 dark:text-zinc-100 mt-0.5">{{ $member->current_expiry_date->format('d M Y') }}</p>
            </div>
            <div>
                <span class="text-[10px] font-mono uppercase font-bold text-zinc-400">Akun Portal Member</span>
                <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">
                    User: <strong class="font-mono text-zinc-900 dark:text-white">{{ $member->user?->phone ?? $member->phone }}</strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Riwayat Presensi & Transaksi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Riwayat Kehadiran (Attendances) -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-5">
            <h4 class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white mb-4">Riwayat Presensi Kehadiran</h4>
            <div class="space-y-2 max-h-96 overflow-y-auto pr-1">
                @forelse($member->attendances as $att)
                <div class="flex items-center justify-between p-3 rounded bg-zinc-50 dark:bg-zinc-950/60 border border-zinc-200 dark:border-zinc-800 text-xs">
                    <div>
                        <p class="font-mono font-bold text-zinc-900 dark:text-white">{{ $att->checkin_time->format('d M Y, H:i') }} WIB</p>
                        <p class="text-zinc-400 text-[11px]">{{ $att->notes ?? 'Check-in frontdesk' }}</p>
                    </div>
                    <span class="px-2 py-0.5 rounded font-mono font-bold text-[10px] uppercase bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900/60">
                        HADIR
                    </span>
                </div>
                @empty
                <p class="text-center py-8 text-xs text-zinc-400">Belum ada catatan presensi untuk member ini.</p>
                @endforelse
            </div>
        </div>

        <!-- Riwayat Transaksi / Pembayaran -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 p-5">
            <h4 class="font-montserrat font-bold text-xs uppercase tracking-wider text-zinc-900 dark:text-white mb-4">Riwayat Pembayaran & Perpanjangan</h4>
            <div class="space-y-2 max-h-96 overflow-y-auto pr-1">
                @forelse($member->transactions as $tx)
                <div class="flex items-center justify-between p-3 rounded bg-zinc-50 dark:bg-zinc-950/60 border border-zinc-200 dark:border-zinc-800 text-xs">
                    <div>
                        <p class="font-bold text-zinc-900 dark:text-white">{{ $tx->package?->name ?? 'Membership' }}</p>
                        <p class="text-zinc-400 font-mono text-[11px]">{{ $tx->invoice_code }} • {{ $tx->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-zinc-900 dark:text-white font-mono">Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                        <span class="px-2 py-0.5 rounded font-mono font-bold text-[10px] uppercase bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/50">
                            {{ $tx->payment_method }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-center py-8 text-xs text-zinc-400">Belum ada riwayat transaksi.</p>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Modal Perpanjangan Membership Cepat (PRD 3.2: 1-Klik Renewal) -->
    <div x-show="showRenewModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75"
         style="display: none;">
        <div @click.away="showRenewModal = false"
             class="bg-white dark:bg-zinc-900 rounded-lg max-w-md w-full p-6 border border-zinc-200 dark:border-zinc-800 shadow-2xl">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-zinc-100 dark:border-zinc-800">
                <div>
                    <h3 class="font-montserrat text-sm font-bold uppercase tracking-wider text-zinc-900 dark:text-white">Perpanjang Membership</h3>
                    <p class="text-xs text-zinc-500 font-mono">{{ $member->name }} ({{ $member->card_id }})</p>
                </div>
                <button @click="showRenewModal = false" class="p-1 rounded text-zinc-400 hover:text-white">✕</button>
            </div>

            <form action="{{ route('admin.members.renew', $member) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1">
                        Pilih Paket Perpanjangan
                    </label>
                    <select name="package_id"
                            required
                            class="w-full px-3 py-2 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-sm outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 font-semibold text-zinc-900 dark:text-white">
                        @foreach($packages as $pkg)
                        <option value="{{ $pkg->id }}">
                            {{ $pkg->name }} ({{ $pkg->duration_days }} Hari) — Rp {{ number_format($pkg->price, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-zinc-400 mt-1">Jika kartu masih aktif, durasi akan ditambahkan langsung dari tanggal jatuh tempo saat ini.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 mb-1">
                        Metode Pembayaran
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center justify-center gap-1.5 p-2 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 text-xs font-bold cursor-pointer hover:border-red-600 text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="cash" checked class="text-red-600 focus:ring-red-500">
                            <span>Cash</span>
                        </label>
                        <label class="flex items-center justify-center gap-1.5 p-2 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 text-xs font-bold cursor-pointer hover:border-red-600 text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="qris" class="text-red-600 focus:ring-red-500">
                            <span>QRIS</span>
                        </label>
                        <label class="flex items-center justify-center gap-1.5 p-2 rounded border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-950 text-xs font-bold cursor-pointer hover:border-red-600 text-zinc-900 dark:text-white">
                            <input type="radio" name="payment_method" value="transfer" class="text-red-600 focus:ring-red-500">
                            <span>Transfer</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-zinc-100 dark:border-zinc-800">
                    <button type="button" @click="showRenewModal = false" class="px-3.5 py-2 border border-zinc-300 dark:border-zinc-700 rounded text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition">
                        Konfirmasi Perpanjang
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
