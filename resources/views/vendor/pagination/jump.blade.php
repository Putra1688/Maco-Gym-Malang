@if ($paginator->total() > 0)
@php
    $current = $paginator->currentPage();
    $last = $paginator->lastPage();

    // Sederhanakan nomor: maksimal 5 nomor halaman dalam satu kelompok
    $pages = [];
    if ($last <= 5) {
        for ($i = 1; $i <= $last; $i++) {
            $pages[] = $i;
        }
    } else {
        if ($current <= 4) {
            // Halaman pertama / dekat awal: 1 2 3 4 5 ... last
            $end = min(5, $last);
            for ($i = 1; $i <= $end; $i++) {
                $pages[] = $i;
            }
            if ($end < $last) {
                if ($end < $last - 1) {
                    $pages[] = '...';
                }
                $pages[] = $last;
            }
        } elseif ($current >= $last - 3) {
            // Halaman terakhir / dekat akhir: 1 ... (last-4) (last-3) (last-2) (last-1) last
            $start = max(1, $last - 4);
            if ($start > 1) {
                $pages[] = 1;
                if ($start > 2) {
                    $pages[] = '...';
                }
            }
            for ($i = $start; $i <= $last; $i++) {
                $pages[] = $i;
            }
        } else {
            // Halaman tengah: 1 ... (current-2) (current-1) current (current+1) (current+2) ... last
            $start = $current - 2;
            $end = $current + 2;

            $pages[] = 1;
            if ($start > 2) {
                $pages[] = '...';
            }
            for ($i = $start; $i <= $end; $i++) {
                $pages[] = $i;
            }
            if ($end < $last - 1) {
                $pages[] = '...';
            }
            $pages[] = $last;
        }
    }

    $selectId = $id ?? 'pagination-per-page';
    $label = $itemLabel ?? 'data';
    $uid = 'pjump_' . ($id ?? 'default');
@endphp

<div class="px-4 py-3 border-t border-zinc-200 dark:border-zinc-800 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-zinc-500 dark:text-zinc-400">
    {{-- Kiri: Info Jumlah Data --}}
    <div class="text-center md:text-left order-2 md:order-1 whitespace-nowrap">
        Menampilkan <span class="font-bold font-mono text-zinc-800 dark:text-zinc-200">{{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }}</span>
        dari <span class="font-bold font-mono text-zinc-800 dark:text-zinc-200">{{ $paginator->total() }}</span> {{ $label }}
    </div>

    {{-- Kanan: Baris per halaman + Navigasi Halaman + Ke halaman --}}
    <div class="flex flex-wrap items-center justify-center md:justify-end gap-2.5 sm:gap-3.5 order-1 md:order-2 w-full md:w-auto">

        {{-- Dropdown Baris per halaman --}}
        <div class="flex items-center gap-1.5">
            <label for="{{ $selectId }}" class="text-[11px] font-mono text-zinc-500 dark:text-zinc-400 whitespace-nowrap">
                Baris per halaman:
            </label>
            <select id="{{ $selectId }}"
                    name="per_page"
                    onchange="window.macoGymPaginationNavigate('per_page', this.value, 'page')"
                    class="px-2 py-1 text-xs font-mono font-semibold rounded bg-zinc-50 dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-1 focus:ring-red-500 outline-none transition cursor-pointer">
                @if (!in_array($paginator->perPage(), [10, 25, 50, 100]))
                    <option value="{{ $paginator->perPage() }}" selected>{{ $paginator->perPage() }}</option>
                @endif
                <option value="10" {{ $paginator->perPage() == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $paginator->perPage() == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $paginator->perPage() == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $paginator->perPage() == 100 ? 'selected' : '' }}>100</option>
            </select>
        </div>

        {{-- Navigasi nomor halaman (Maksimal 5 nomor halaman dalam satu kelompok) --}}
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1 select-none">
            {{-- Tombol Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-7 h-7 sm:w-8 sm:h-8 text-xs font-mono text-zinc-300 dark:text-zinc-600 border border-zinc-200 dark:border-zinc-800 rounded-md cursor-not-allowed select-none bg-zinc-50 dark:bg-zinc-950/40" aria-disabled="true" aria-label="Sebelumnya">&lsaquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-7 h-7 sm:w-8 sm:h-8 text-xs font-mono font-bold text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-700 hover:text-red-600 dark:hover:text-red-400 transition-colors shadow-2xs" aria-label="Sebelumnya">&lsaquo;</a>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($pages as $item)
                @if ($item === '...')
                    <span class="inline-flex items-center justify-center px-1 sm:px-1.5 h-7 sm:h-8 text-xs font-mono text-zinc-400 dark:text-zinc-500 select-none cursor-default" aria-disabled="true">…</span>
                @elseif ($item == $current)
                    <span class="inline-flex items-center justify-center min-w-[28px] sm:min-w-[32px] h-7 sm:h-8 px-2 text-xs font-mono font-bold text-white bg-red-600 rounded-md shadow-xs shadow-red-600/30 select-none cursor-default" aria-current="page">{{ $item }}</span>
                @else
                    <a href="{{ $paginator->url($item) }}" class="inline-flex items-center justify-center min-w-[28px] sm:min-w-[32px] h-7 sm:h-8 px-2 text-xs font-mono font-semibold text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-700 hover:text-red-600 dark:hover:text-red-400 transition-colors shadow-2xs" aria-label="Halaman {{ $item }}">{{ $item }}</a>
                @endif
            @endforeach

            {{-- Tombol Selanjutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-7 h-7 sm:w-8 sm:h-8 text-xs font-mono font-bold text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-700 hover:text-red-600 dark:hover:text-red-400 transition-colors shadow-2xs" aria-label="Selanjutnya">&rsaquo;</a>
            @else
                <span class="inline-flex items-center justify-center w-7 h-7 sm:w-8 sm:h-8 text-xs font-mono text-zinc-300 dark:text-zinc-600 border border-zinc-200 dark:border-zinc-800 rounded-md cursor-not-allowed select-none bg-zinc-50 dark:bg-zinc-950/40" aria-disabled="true" aria-label="Selanjutnya">&rsaquo;</span>
            @endif
        </nav>

        {{-- Ke halaman [input] — Tanpa tombol GO, instan via Enter / Blur --}}
        @if ($last > 1)
        <div class="inline-flex items-center gap-1.5">
            <span class="text-[11px] font-mono text-zinc-500 dark:text-zinc-400 whitespace-nowrap">Ke halaman</span>
            <input type="number"
                   id="{{ $uid }}"
                   min="1"
                   max="{{ $last }}"
                   placeholder="{{ $current }}"
                   class="w-12 px-1.5 py-1 text-center text-xs font-mono font-semibold rounded bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white focus:ring-1 focus:ring-red-500 focus:border-red-500 outline-none transition [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                   aria-label="Nomor halaman tujuan">
        </div>
        <script>
        (function(){
            var input = document.getElementById('{{ $uid }}');
            if (!input) return;
            var lastPage = {{ $last }};
            var currentPage = {{ $current }};
            var navigated = false;

            function jumpTo() {
                if (navigated) return;
                var val = parseInt(input.value, 10);
                if (isNaN(val) || val < 1) return;
                if (val > lastPage) val = lastPage;
                if (val === currentPage) return;
                navigated = true;
                window.macoGymPaginationNavigate('page', val);
            }

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    jumpTo();
                }
            });

            input.addEventListener('blur', function() {
                jumpTo();
            });
        })();
        </script>
        @endif
    </div>
</div>

<script>
if (typeof window.macoGymPaginationNavigate === 'undefined') {
    window.macoGymPaginationNavigate = function(key, value, resetKey) {
        var search = window.location.search;
        var pathname = window.location.pathname;
        var query = {};
        if (search && search.length > 1) {
            var pairs = search.substring(1).split('&');
            for (var i = 0; i < pairs.length; i++) {
                if (!pairs[i]) continue;
                var parts = pairs[i].split('=');
                var k = decodeURIComponent(parts[0]);
                var v = parts.length > 1 ? decodeURIComponent(parts[1].replace(/\+/g, ' ')) : '';
                query[k] = v;
            }
        }
        if (resetKey) {
            delete query[resetKey];
        }
        if (value !== null && value !== undefined && value !== '') {
            query[key] = value;
        } else {
            delete query[key];
        }
        var qs = [];
        for (var p in query) {
            if (Object.prototype.hasOwnProperty.call(query, p)) {
                qs.push(encodeURIComponent(p) + '=' + encodeURIComponent(query[p]));
            }
        }
        window.location.href = pathname + (qs.length > 0 ? '?' + qs.join('&') : '');
    };
}
</script>
@endif
