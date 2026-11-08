# Layout & Visual Hierarchy Guidelines

Dokumen ini mengatur standar arsitektur tata letak (layout), perataan optik, tipografi, dan komposisi visual pada aplikasi Maco Gym Malang.

---

## 1. Grid & Skala Tata Letak Responsif

### Container & Max-Width
- Gunakan `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8` sebagai container standar halaman.
- Hindari konten yang membentang tanpa batas pada monitor ultrawide (> 1440px) agar rasio baca tetap nyaman.

### Sistem Grid Berimbang
- **Metrik Cepat:** Gunakan 4 kolom fleksibel:
  ```html
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
  ```
- **Komposisi Dua Kartu Utama:** Gunakan split 12-kolom:
  - 7 Kolom (Kartu Utama/Fokus) vs 5 Kolom (Metrik Pendukung/Live Meter):
    ```html
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-7">...</div>
        <div class="lg:col-span-5">...</div>
    </div>
    ```
  - 6 Kolom Seimbang:
    ```html
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-6">...</div>
        <div class="lg:col-span-6">...</div>
    </div>
    ```

### Spasi & Ritme Vertikal
- Antar-bagian besar (Row / Section): `space-y-6 sm:space-y-8`.
- Di dalam kartu: Padding `p-5 sm:p-7` atau `p-6 sm:p-8`.
- Antar-item kecil dalam list: `gap-2.5` atau `space-y-2.5`.
- Selalu gunakan `gap-*` pada flex/grid daripada memberikan margin manual `mt-*` / `mb-*` pada elemen anak.

---

## 2. Tipografi & Hierarki Teks

Aplikasi ini menggunakan perpaduan 3 tipografi berkarakter:

1. **Montserrat (Display & Header):**
   - Karakter: Gagah, atletik, berenergi tinggi.
   - Penggunaan: Judul utama halaman, nama kartu member, judul section penting.
   - Kelas Tailwind: `font-montserrat font-extrabold uppercase tracking-tight` atau `tracking-wider`.
   - Contoh:
     ```html
     <h1 class="font-montserrat text-2xl sm:text-3xl font-extrabold uppercase tracking-tight text-zinc-900 dark:text-white">
         Halo, <span class="text-red-600">Bima Arya</span>
     </h1>
     ```

2. **Plus Jakarta Sans (Body & UI Copy):**
   - Karakter: Bersih, modern, sangat terbaca di layar mobile.
   - Penggunaan: Paragraf pengantar, label form, deskripsi latihan, panduan operasional.
   - Kelas Tailwind: `font-sans text-xs sm:text-sm text-zinc-600 dark:text-zinc-400`.

3. **Monospace (Data, Angka, & Tanggal):**
   - Karakter: Presisi, akurat, khas pengukuran fitness.
   - Penggunaan: Berat badan (`73.8 kg`), kode barcode member (`MC-001`), jam check-in (`18:30 WIB`), repetisi/set (`4 Sets x 10 Reps`).
   - Kelas Tailwind: `font-mono font-bold text-zinc-900 dark:text-white`.

---

## 3. Desain Kartu (Card Architecture)

Setiap kartu harus memiliki struktur 3 lapis yang konsisten:

```html
<div class="bg-white dark:bg-[#15171d] rounded-3xl p-6 sm:p-7 border border-zinc-200 dark:border-[#262934] shadow-xs flex flex-col justify-between">
    <!-- 1. Header Kartu -->
    <div>
        <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-red-600"></span>
                <h3 class="font-montserrat font-bold text-sm uppercase tracking-wider text-zinc-900 dark:text-white">
                    Judul Kartu
                </h3>
            </div>
            <!-- Opsi/Aksi Header -->
        </div>

        <!-- 2. Isi/Body Kartu -->
        <div class="mt-4">
            <!-- Konten Utama -->
        </div>
    </div>

    <!-- 3. Footer Kartu -->
    <div class="mt-5 pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between text-[11px] text-zinc-500 dark:text-zinc-400">
        <!-- Informasi Status atau Tombol Aksi Tambahan -->
    </div>
</div>
```

---

## 4. Dark & Light Mode Contrast Rules

1. **Permukaan Gelap Berkualitas (Bukan Pure Black #000):**
   - Background halaman: `#0e1014` (`dark:bg-[#0e1014]`).
   - Background kartu: `#15171d` (`dark:bg-[#15171d]`).
   - Input field & nested container: `#1a1d24` (`dark:bg-zinc-900/60`).
   - Border pemisah: `#262934` (`dark:border-[#262934]`) atau `dark:border-zinc-800/80`.

2. **Kontras Teks Wajib Memenuhi WCAG 2.1 AA:**
   - Teks Utama (Heading): `text-zinc-900 dark:text-white`.
   - Teks Pendukung (Body): `text-zinc-600 dark:text-zinc-300`.
   - Teks Sekunder (Caption/Metrik kecil): `text-zinc-500 dark:text-zinc-400`.
   - **HINDARI:** Menggunakan `text-zinc-600` di atas dark mode background karena tidak terbaca.

