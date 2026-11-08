@extends('layouts.admin')

@section('title', 'Laporan Kas & Transaksi')
@section('header', 'Laporan Keuangan & Kas Masuk')

@section('content')
<div class="space-y-6">

    <!-- Summary Total Terfilter -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 sm:p-6 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-red-600 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Uang Masuk (Sesuai Filter)</span>
                <h3 class="text-3xl font-black text-zinc-900 dark:text-white mt-1 font-montserrat">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </h3>
                <p class="text-xs text-zinc-400 mt-1 font-mono">Dari {{ number_format($totalCount) }} transaksi kas tercatat</p>
            </div>
            <div class="w-10 h-10 rounded bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 flex items-center justify-center font-bold text-xs uppercase shrink-0 border border-red-200 dark:border-red-900/60 font-mono">
                IDR
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-lg p-5 sm:p-6 border border-zinc-200 dark:border-zinc-800 border-t-2 border-t-zinc-800 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Periode & Kriteria Filter</span>
                <p class="text-xs font-mono font-bold text-zinc-800 dark:text-zinc-200 mt-1">
                    {{ request('start_date') ? request('start_date') : 'Semua Tanggal' }} s/d {{ request('end_date') ? request('end_date') : 'Hari ini' }}
                </p>
                <div class="flex items-center gap-1.5 mt-2">
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700">
                        METODE: {{ request('payment_method') ? strtoupper(request('payment_method')) : 'SEMUA' }}
                    </span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono font-bold uppercase bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700">
                        TIPE: {{ request('package_type') ? strtoupper(str_replace('_', ' ', request('package_type'))) : 'SEMUA' }}
                    </span>
                </div>
            </div>
            <button onclick="window.print()"
                    class="px-3.5 py-2 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 font-bold text-xs rounded transition flex items-center gap-1.5 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                <span>Cetak Rekap</span>
            </button>
        </div>
    </div>

    <!-- Filter Bar (PRD 3.3: Rentang Tanggal, Tipe Paket, Metode Bayar) -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-5 border border-zinc-200 dark:border-zinc-800">
        <form method="GET" action="{{ route('admin.transactions.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <div>
                <label class="block text-[10px] font-mono uppercase font-bold text-zinc-500 mb-1">Dari Tanggal</label>
                <input type="date"
                       name="start_date"
                       value="{{ request('start_date') }}"
                       class="w-full px-2.5 py-1.5 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-xs font-mono outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
            </div>

            <div>
                <label class="block text-[10px] font-mono uppercase font-bold text-zinc-500 mb-1">Sampai Tanggal</label>
                <input type="date"
                       name="end_date"
                       value="{{ request('end_date') }}"
                       class="w-full px-2.5 py-1.5 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-xs font-mono outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white">
            </div>

            <div>
                <label class="block text-[10px] font-mono uppercase font-bold text-zinc-500 mb-1">Tipe Paket</label>
                <select name="package_type"
                        class="w-full px-2.5 py-1.5 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-xs outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-mono uppercase">
                    <option value="">SEMUA TIPE</option>
                    <option value="membership" {{ request('package_type') === 'membership' ? 'selected' : '' }}>MEMBERSHIP</option>
                    <option value="daily_visit" {{ request('package_type') === 'daily_visit' ? 'selected' : '' }}>VISIT HARIAN</option>
                    <option value="personal_trainer" {{ request('package_type') === 'personal_trainer' ? 'selected' : '' }}>PERSONAL TRAINER</option>
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-mono uppercase font-bold text-zinc-500 mb-1">Metode Bayar</label>
                <select name="payment_method"
                        class="w-full px-2.5 py-1.5 bg-zinc-50 dark:bg-zinc-950 border border-zinc-300 dark:border-zinc-700 rounded text-xs outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 text-zinc-900 dark:text-white font-mono uppercase">
                    <option value="">SEMUA METODE</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>CASH / TUNAI</option>
                    <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>QRIS</option>
                    <option value="transfer" {{ request('payment_method') === 'transfer' ? 'selected' : '' }}>TRANSFER BANK</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 py-1.5 bg-red-600 hover:bg-red-700 text-white font-montserrat font-bold text-xs uppercase tracking-wider rounded transition">
                    Terapkan
                </button>
                @if(request()->hasAny(['start_date', 'end_date', 'package_type', 'payment_method', 'search']))
                <a href="{{ route('admin.transactions.index') }}"
                   class="px-2.5 py-1.5 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-xs font-semibold rounded text-zinc-600 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Transaksi Kas -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-50 dark:bg-zinc-950/60 text-[10px] uppercase font-mono tracking-wider text-zinc-500 dark:text-zinc-400 border-b border-zinc-200 dark:border-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3">Invoice</th>
                        <th class="px-4 sm:px-6 py-3">Waktu</th>
                        <th class="px-4 sm:px-6 py-3">Pelanggan / Member</th>
                        <th class="px-4 sm:px-6 py-3 hidden md:table-cell">Layanan</th>
                        <th class="px-4 sm:px-6 py-3">Metode</th>
                        <th class="px-4 sm:px-6 py-3 hidden lg:table-cell">Kasir</th>
                        <th class="px-4 sm:px-6 py-3 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($transactions as $tx)
                    <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition">
                        <td class="px-4 sm:px-6 py-3.5 font-mono font-bold text-red-600 dark:text-red-400 text-xs">
                            {{ $tx->invoice_code }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-xs font-mono text-zinc-600 dark:text-zinc-400">
                            {{ $tx->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 font-bold text-zinc-900 dark:text-white">
                            {{ $tx->customer_name }}
                            @if($tx->member)
                                <span class="block text-[10px] font-mono font-normal text-zinc-400">{{ $tx->member->card_id }}</span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-xs hidden md:table-cell">
                            <span class="font-bold text-zinc-800 dark:text-zinc-200">{{ $tx->package?->name ?? 'Layanan' }}</span>
                            <span class="block text-[10px] font-mono text-zinc-400 uppercase tracking-wide">
                                {{ $tx->package?->type ? str_replace('_', ' ', $tx->package->type) : '-' }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5">
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold uppercase tracking-wider
                                {{ $tx->payment_method === 'cash' ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-900/60' : '' }}
                                {{ $tx->payment_method === 'qris' ? 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-900/60' : '' }}
                                {{ $tx->payment_method === 'transfer' ? 'bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-900/60' : '' }}">
                                {{ $tx->payment_method }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-xs text-zinc-500 dark:text-zinc-400 hidden lg:table-cell font-mono">
                            {{ $tx->creator?->name ?? 'Frontdesk' }}
                        </td>
                        <td class="px-4 sm:px-6 py-3.5 text-right font-mono font-bold text-sm text-zinc-900 dark:text-white">
                            Rp {{ number_format($tx->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-xs text-zinc-400">
                            Tidak ditemukan transaksi pada rentang filter ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
