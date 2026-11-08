# Micro-Interactions & Visual Polish Guidelines

Dokumen ini mengatur detail mikro (micro-interactions), transisi, efek sentuh/hover, state pemuatan (loading states), dan umpan balik antarmuka agar terasa taktil dan profesional.

---

## 1. Efek Sentuh & Hover Taktil

### Tombol Aksi Utama (Primary Actions)
Beri sedikit efek elevasi pada hover dan feedback tekanan saat diklik (*active scale*):
```html
<button type="button"
        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 active:scale-98 text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-md shadow-red-600/20 transition-all duration-150 transform hover:-translate-y-0.5 cursor-pointer">
    <span>Simpan Perubahan</span>
</button>
```

### Kartu Interaktif
Untuk kartu yang dapat diklik atau dipilih, berikan aksen border hover:
```html
<div class="p-4 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 transition-all duration-150 hover:border-red-500/50 hover:shadow-sm cursor-pointer">
```

---

## 2. Status Loading & Anti Double-Submit

Saat tombol form memproses data di latar belakang:
1. Matikan tombol dengan `:disabled="isSubmitting"`.
2. Ganti teks atau tampilkan ikon spinner berputar.
3. Ubah kursor menjadi `cursor-not-allowed` dan kurangi opacity:
```html
<button type="submit"
        :disabled="isSubmitting"
        class="px-4 py-2 bg-red-600 text-white rounded-xl font-bold text-xs uppercase transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
    <svg x-show="isSubmitting" class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
    </svg>
    <span x-text="isSubmitting ? 'Menyimpan...' : 'Tambah Gerakan'"></span>
</button>
```

---

## 3. Skeleton Loading & State Kosong (Empty States)

### Skeleton Loading Placeholder
Saat data grafik atau daftar sedang diunduh via fetch:
```html
<div class="animate-pulse space-y-3">
    <div class="h-4 bg-zinc-200 dark:bg-zinc-800 rounded w-1/3"></div>
    <div class="h-10 bg-zinc-100 dark:bg-zinc-850 rounded-xl"></div>
    <div class="h-10 bg-zinc-100 dark:bg-zinc-850 rounded-xl"></div>
</div>
```

### Empty State Bermakna
Jangan biarkan kartu kosong melompong tanpa instruksi jika data belum ada:
```html
<div class="py-10 text-center flex flex-col items-center justify-center">
    <div class="w-12 h-12 rounded-full bg-zinc-100 dark:bg-zinc-850 flex items-center justify-center text-zinc-400 mb-3">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
    </div>
    <p class="text-xs font-bold text-zinc-800 dark:text-zinc-200">Belum Ada Target Latihan</p>
    <p class="text-[11px] text-zinc-400 max-w-xs mt-1">Pilih template latihan cepat atau tambahkan gerakan mandiri untuk memulai sesi gym hari ini.</p>
    <button @click="openTemplateModal()" class="mt-4 px-3 py-1.5 bg-red-600 text-white rounded-lg text-xs font-bold">
        + Pilih Template Siap Pakai
    </button>
</div>
```

---

## 4. Toast & Notifikasi Ringan

Gunakan flash banner atau floating toast yang hilang otomatis setelah 3-4 detik:
```html
<div x-data="{ show: true }"
     x-show="show"
     x-init="setTimeout(() => show = false, 3500)"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-2"
     class="fixed bottom-5 right-5 z-50 flex items-center gap-2.5 px-4 py-3 bg-zinc-900 text-white rounded-xl shadow-lg border border-zinc-800 text-xs font-semibold">
    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
    <span>Data berat badan berhasil dicatat!</span>
</div>
```

