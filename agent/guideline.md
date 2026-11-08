# Developer Guidelines — Maco Gym Malang Project

Panduan lengkap bagi developer untuk melakukan *setup*, menjalankan, menguji, dan berkontribusi pada pengembangan project **Maco Gym Malang Web & Management System**.

---

## 1. Persyaratan Sistem (Prerequisites)

Pastikan lingkungan lokal Anda telah terpasang:
- **PHP**: Versi 8.2 atau 8.3 (dengan ekstensi `pdo_sqlite`, `curl`, `mbstring`, `fileinfo`).
- **Composer**: Versi 2.x
- **Node.js & NPM**: Versi Node 18+ atau 20+ LTS
- **Git**
- *(Opsional)* **Laragon / MySQL**: Hanya jika ingin beralih dari SQLite ke database MySQL.

---

## 2. Instalasi & Setup Pertama Kali (Initial Setup)

Buka terminal di root project dan jalankan langkah-langkah berikut:

### Langkah 1: Install Dependencies PHP & JavaScript
```bash
composer install
npm install
```

### Langkah 2: Setup File Environment
Jika file `.env` belum ada, salin dari `.env.example`:
```bash
cp .env.example .env
# Pada Windows PowerShell:
Copy-Item .env.example .env
```
Generate kunci aplikasi:
```bash
php artisan key:generate
```

### Langkah 3: Konfigurasi Database

Project ini mendukung dua mode database:

#### Mode A: SQLite (Default — Sangat Direkomendasikan & Tanpa Perlu Laragon)
1. Pastikan konfigurasi di `.env`:
   ```env
   DB_CONNECTION=sqlite
   ```
2. Pastikan file database SQLite ada di `database/database.sqlite`. Jika belum ada, buat file kosong:
   ```bash
   # Linux/macOS:
   touch database/database.sqlite

   # Windows PowerShell:
   New-Item -ItemType File -Path database/database.sqlite -Force
   ```

#### Mode B: MySQL via Laragon (Opsional)
Jika Anda ingin menggunakan MySQL dari Laragon:
1. Buka dan nyalakan Laragon (**Start All**).
2. Buat database baru bernama `maco_gym` (misal via HeidiSQL atau phpMyAdmin).
3. Sesuaikan file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=maco_gym
   DB_USERNAME=root
   DB_PASSWORD=
   ```

### Langkah 4: Jalankan Migrasi & Seeder Database
> **PENTING**: Wajib dijalankan agar tidak terjadi error `no such table: packages` atau tabel lainnya!
```bash
php artisan migrate --seed
```

---

## 3. Menjalankan Server Pengembangan (Run Dev Server)

Jalankan 2 terminal secara berdampingan:

### Terminal 1: Backend Server (Laravel)
```bash
php artisan serve
```
Aplikasi dapat diakses di browser melalui: `http://127.0.0.1:8000`

### Terminal 2: Frontend Asset Compiler (Tailwind CSS v4 & Vite)
```bash
npm run dev
```
*(Atau jika ingin men-generate bundle aset statis tanpa watcher: `npm run build`)*

---

## 4. Akun Default untuk Login (Hasil Seeding)

Gunakan kredensial berikut untuk login di halaman `http://127.0.0.1:8000/login`:

| Peran (Role) | Email / No. HP | Password | Akses & Fungsi Utama |
| :--- | :--- | :--- | :--- |
| **Super Admin** | `admin@gym.com` / `081234567890` | `password123` | Akses penuh dashboard `/admin/dashboard`, CRUD paket, trainer, member, & laporan transaksi kas. |
| **Staff Resepsionis** | `staff@gym.com` / `081234567891` | `password123` | Akses meja depan `/admin/frontdesk` (presensi kartu ID member & kasir tamu harian 3 detik). |
| **Member Aktif** | `081234567899` (ID: `MC-001`) | `member123` | Akses portal `/member/dashboard` (cek sisa hari aktif membership, QR/ID kartu, & log fisik). |

---

## 5. Arsitektur Folder & Konvensi Blade

Perhatikan pembagian struktur folder view agar tidak terjadi duplikasi:

```
resources/views/
├── welcome.blade.php            # Halaman Landing Page publik utama
│
├── guest/
│   └── partials/                # KHUSUS section landing page publik (di-include di welcome)
│       ├── navbar.blade.php     # Top bar & navigation header
│       ├── hero.blade.php       # Banner utama (Slideshow & Fit Hub dark-gradient)
│       ├── facilities.blade.php # Daftar program & 8 fasilitas
│       ├── about.blade.php      # Filosofi Maco Gym & statistik 2x2
│       ├── testimonials.blade.php # Ulasan member
│       ├── pricing.blade.php    # Paket membership & promo mahasiswa
│       ├── trainers.blade.php   # Profil staf pelatih/coach
│       ├── how-to-join.blade.php# Alur pendaftaran & form booking WA
│       └── faq.blade.php        # Tanya jawab interaktif
│
├── components/                  # KHUSUS komponen yang dipakai BERSAMA lintas role
│   └── footer.blade.php         # Footer global (<x-footer />)
│
├── admin/                       # Dashboard manajemen gym & meja kasir/frontdesk
│   ├── dashboard.blade.php
│   ├── frontdesk/index.blade.php# Layar operasional utama kasir & presensi
│   ├── members/                 # Manajemen member & perpanjangan (renew)
│   ├── packages/                # CMS paket membership
│   ├── trainers/                # CMS personal trainer
│   └── transactions/            # Rekap kas masuk harian/bulanan
│
├── member/                      # Portal pribadi member gym
│   ├── dashboard.blade.php
│   └── profile.blade.php
│
└── auth/                        # Halaman otentikasi login & reset password
    └── login.blade.php
```

> **Aturan**:
> - Jangan membuat duplikasi file guest di dalam `resources/views/components/`. Gunakan `guest/partials/` untuk konten landing page dan panggil menggunakan `@include('guest.partials.nama-file')`.
> - Simpan komponen yang benar-benar dipakai di semua role (misal: layout footer, alert toast) di `resources/views/components/`.

---

## 6. Standarisasi & Quality Checks

Sebelum melakukan `git commit` dan `git push`:

1. **Jalankan Test Suite**:
   Pastikan seluruh test feature dan unit lolos:
   ```bash
   php artisan test
   # Atau langsung via PHPUnit:
   vendor/bin/phpunit
   ```
2. **Format Kode Sesuai Standar Laravel Pint**:
   ```bash
   vendor/bin/pint --dirty --format agent
   # Atau format seluruh project:
   vendor/bin/pint
   ```
3. **Compile Aset Frontend**:
   ```bash
   npm run build
   ```

---

## 7. Solusi Permasalahan Umum (Troubleshooting)

### Q: Muncul error `SQLSTATE[HY000]: no such table: packages`?
- **Penyebab**: Migrasi database belum dijalankan di file SQLite Anda.
- **Solusi**: Jalankan perintah `php artisan migrate --seed` di terminal.

### Q: Muncul error `Unable to locate file in Vite manifest`?
- **Penyebab**: File manifest kompilasi CSS/JS belum dibuat.
- **Solusi**: Jalankan `npm run build` atau buka terminal kedua dengan `npm run dev`.

### Q: Muncul syntax error `unexpected token "<<", expecting end of file`?
- **Penyebab**: Ada penanda konflik Git (`<<<<<<< HEAD`, `=======`, `>>>>>>>`) yang tertinggal saat git merge / git pull.
- **Solusi**: Buka file yang disebutkan pada stack trace (biasanya `routes/web.php`), cari kata kunci `<<<<<<<` dan selesaikan perbedaannya.

### Q: Apakah wajib menyalakan Laragon?
- **Jawaban**: **Tidak wajib**. Jika menggunakan `DB_CONNECTION=sqlite`, project berjalan 100% tanpa Laragon. Anda hanya butuh Laragon jika ingin memakai service MySQL atau domain virtual host `.test`.

