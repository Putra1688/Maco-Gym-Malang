@extends('layouts.admin')

@section('title', 'Laporan Kas & Transaksi')
@section('header', 'Laporan Arus Kas Masuk (Pemasukan)')

@section('content')
<div class="space-y-6">

    <!-- Summary Total Terfilter -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase font-bold tracking-wider text-slate-500">Total Uang Masuk (Sesuai Filter)</p>
                <h3 class="text-3xl font-black text-amber-500 mt-1 font-mono">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </h3>
                <p class="text-xs text-slate-400 mt-1">Dari total {{ number_format($totalCount) }} transaksi tercatat</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center font-black text-lg">
                Rp
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs uppercase font-bold tracking-wider text-slate-500">Keterangan Filter Aktif</p>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200 mt-1">
                    {{ request('start_date') ? request('start_date') : 'Awal' }} s/d {{ request('end_date') ? request('end_date') : 'Hari ini' }}
                </p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                        Metode: {{ request('payment_method') ? strtoupper(request('payment_method')) : 'Semua' }}
                    </span>
                    <span class="px-2 py-0.5 rounded text-[11px] font-mono bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                        Tipe: {{ request('package_type') ? ucfirst(str_replace('_', ' ', request('package_type'))) : 'Semua' }}
                    </span>
                </div>
            </div>
            <button onclick="window.print()"
                    class="px-4 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 font-bold text-xs rounded-xl transition flex items-center gap-1.5 text-slate-800 dark:text-slate-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                <span>Cetak Rekap</span>
            </button>
        </div>
    </div>

    <!-- Filter Bar (PRD 3.3: Rentang Tanggal, Tipe Paket, Metode Bayar) -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200 dark:border-slate-700/80 shadow-sm">
        <form method="GET" action="{{ route('admin.transactions.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <div>
                <label class="block text-[11px] uppercase font-bold text-slate-500 mb-1">Dari Tanggal</label>
                <input type="date"
                       name="start_date"
                       value="{{ request('start_date') }}"
                       class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-mono outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-[11px] uppercase font-bold text-slate-500 mb-1">Sampai Tanggal</label>
                <input type="date"
                       name="end_date"
                       value="{{ request('end_date') }}"
                       class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs font-mono outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-[11px] uppercase font-bold text-slate-500 mb-1">Tipe Paket</label>
                <select name="package_type"
                        class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs outline-none focus:ring-2 focus:ring-amber-500">
                    <option value="">Semua Tipe</option>
                    <option value="membership" {{ request('package_type') === 'membership' ? 'selected' : '' }}>Membership</option>
                    <option value="daily_visit" {{ request('package_type') === 'daily_visit' ? 'selected' : '' }}>Visit Harian</option>
                    <option value="personal_trainer" {{ request('package_type') === 'personal_trainer' ? 'selected' : '' }}>Personal Trainer</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] uppercase font-bold text-slate-500 mb-1">Metode Bayar</label>
                <select name="payment_method"
                        class="w-full px-3 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-xl text-xs outline-none focus:ring-2 focus:ring-amber-500">
                    <option value="">Semua Metode</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>Cash / Tunai</option>
                    <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>QRIS</option>
                    <option value="transfer" {{ request('payment_method') === 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs rounded-xl shadow transition">
                    Terapkan
                </button>
                @if(request()->hasAny(['start_date', 'end_date', 'package_type', 'payment_method', 'search']))
                <a href="{{ route('admin.transactions.index') }}"
                   class="px-3 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-xs font-semibold rounded-xl text-slate-600 dark:text-slate-300">
                    Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabel Transaksi Kas -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-750 text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-3.5">Kode Invoice</th>
                        <th class="px-6 py-3.5">Waktu Transaksi</th>
                        <th class="px-6 py-3.5">Pelanggan / Member</th>
                        <th class="px-6 py-3.5">Paket & Layanan</th>
                        <th class="px-6 py-3.5">Metode Bayar</th>
                        <th class="px-6 py-3.5">Kasir/Staf</th>
                        <th class="px-6 py-3.5 text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($transactions as $tx)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition">
                        <td class="px-6 py-4 font-mono font-bold text-amber-600 dark:text-amber-400 text-xs">
                            {{ $tx->invoice_code }}
                        </td>
                        <td class="px-6 py-4 text-xs font-mono text-slate-600 dark:text-slate-400">
                            {{ $tx->created_at->format('d/m/Y H:i') }} WIB
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                            {{ $tx->customer_name }}
                            @if($tx->member)
                                <span class="block text-[11px] font-mono text-slate-400">{{ $tx->member->card_id }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs">
                            <span class="font-bold text-slate-800 dark:text-slate-200">{{ $tx->package?->name ?? 'Layanan' }}</span>
                            <span class="block text-[11px] text-slate-400 uppercase tracking-wide">
                                {{ $tx->package?->type ? str_replace('_', ' ', $tx->package->type) : '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-mono font-extrabold uppercase tracking-wider
                                {{ $tx->payment_method === 'cash' ? 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800' : '' }}
                                {{ $tx->payment_method === 'qris' ? 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-300 border border-blue-300 dark:border-blue-800' : '' }}
                                {{ $tx->payment_method === 'transfer' ? 'bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 border border-purple-300 dark:border-purple-800' : '' }}">
                                {{ $tx->payment_method }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400">
                            {{ $tx->creator?->name ?? 'Frontdesk' }}
                        </td>
                        <td class="px-6 py-4 text-right font-mono font-extrabold text-sm text-slate-900 dark:text-white">
                            Rp {{ number_format($tx->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                            Tidak ditemukan transaksi pada rentang filter ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="p-4 border-t border-slate-200 dark:border-slate-750">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>

</div>
@endsection

