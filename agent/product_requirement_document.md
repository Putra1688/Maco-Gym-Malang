# Product Requirement Document (PRD)
## Maco Gym Malang Management System

### 1. Document Overview
* **Project Name:** Maco Gym Malang Web & Management System
* **Version:** 1.0.0
* **Date:** November 2026
* **Target Stack:** PHP (Laravel 11+), Tailwind CSS (Dark/Light Mode), MySQL (via Laragon / phpMyAdmin), Responsive Web (SEO & Mobile Optimized)
* **Design Concept:** Sederhana tapi Mewah (Luxury Minimalist dengan dukungan **Dark & Light Mode Toggle**)
* **Core Philosophy:** Tepat guna, efisien untuk staf, tidak berbelit-belit, dan **anti-overkill**.

---

### 2. Background & Product Objectives

#### 2.1. Latar Belakang
Operasional Maco Gym Malang saat ini masih sepenuhnya manual menggunakan buku catatan kertas:
* Pencatatan pendaftaran member ditulis di buku.
* Pemantauan masa aktif member diperiksa manual lembar demi lembar.
* Presensi kedatangan member dan tiket tamu harian dicatat di buku tamu.
* Rekap pemasukan harian berisiko selisih karena catatan tercecer.

#### 2.2. Tujuan Sistem
1. **Digitalisasi Meja Resepsionis (Frontdesk):** Menggantikan buku manual dengan sistem kasir & presensi instan yang cepat (3–5 detik per orang).
2. **Branding & Promosi Online (Landing Page):** Menampilkan profil gym yang berkelas, fasilitas, katalog harga, dan kemudahan kontak via WhatsApp.
3. **Tertib Administrasi & Anti-Bocor:** Semua uang masuk (membership & tiket harian) tercatat otomatis dan transparan.
4. **Follow-up Member Otomatis/Mudah:** Notifikasi member yang hampir habis masa aktifnya via WhatsApp 1-klik tanpa biaya gateway berbayar.

---

### 3. User Roles & Pembagian Alur Operasional

Prinsip Utama: **Staf Resepsionis adalah operator utama penginputan data di tempat** untuk menjamin kontrol pembayaran (Cash/QRIS) dan mencegah kecurangan presensi.

```
                           +------------------------+
                           |  PENGUNJUNG / TAMU GYM |
                           +-----------+------------+
                                       |
                 +---------------------+---------------------+
                 | (Datang ke Gym)                           | (Akses dari Rumah)
                 v                                           v
      +---------------------+                     +---------------------+
      |   MEJA RESEPSIONIS  |                     |     LANDING PAGE    |
      | (Diinputkan Staf)   |                     | (Mandiri / Publik)  |
      +----------+----------+                     +----------+----------+
                 |                                           |
    +------------+------------+                              v
    |                         |                     Lihat Fasilitas & Harga,
    v                         v                     Kirim Form Minat / Chat WA
[Member: Scan Kartu/ID]   [Tamu Harian / Baru]
    |                         |
Presensi Instan           Input Nama & Bayar
(Cek Sisa Hari)           (Cetak/Log Masuk)
```

#### 3.1. Guest / Calon Member (Public Landing Page - Mandiri)
* **Hero Section:** Foto gym berkelas dengan atmosfer pencahayaan atletis, slogan, dan tombol CTA WhatsApp.
* **Facilities & Equipment:** Galeri fasilitas (alat beban, kardio, loker, shower, area fungsional).
* **Paket & Harga:** Tabel harga transparan (Harian/Visit, Bulanan, 3 Bulan, 6 Bulan, 1 Tahun, Personal Trainer).
* **Profil Personal Trainer:** Foto, keahlian, dan portofolio singkat pelatih Maco Gym.
* **FAQ & Lokasi:** Jam buka, Google Maps interaktif, fasilitas pendukung.
* **Formulir Minat / Pra-Pendaftaran:** Calon member bisa mengisi nama dan nomor WhatsApp dari rumah. Data tersimpan sebagai status `Pending` di sistem resepsionis.

#### 3.2. Frontdesk / Kasir (Dioperasikan Resepsionis di Meja Depan)
* **Layar Presensi Cepat (Quick Check-in):**
  * Input 1 kolom pencarian: Cukup ketik ID Kartu Member (misal: `MC-001`) atau nama member, tekan Enter.
  * Respon visual seketika:
    * 🟢 **AKTIF:** Menampilkan sisa hari aktif (misal: "Sisa 18 Hari"). Presensi langsung tercatat otomatis.
    * 🟡 **HAMPIR HABIS (H-3):** Menampilkan peringatan sisa hari dengan opsi perpanjangan.
    * 🔴 **KADALUARSA:** Peringatan kartu mati. Muncul opsi langsung `[Perpanjang]` atau `[Bayar Visit Harian]`.
* **Tiket Tamu Harian (+ Non-Member Visit):**
  * Tombol 1-klik di resepsionis untuk tamu non-member.
  * Form kilat: Nama, Nomor WhatsApp (opsional untuk prospek promo), Nominal Paket Harian, Metode Bayar (Cash / QRIS / Transfer).
  * Data langsung tersimpan di kas harian dan log pengunjung hari ini.
* **Pendaftaran Member Baru di Tempat (Walk-in Registration):**
  * Resepsionis menginput data member baru: Nama, No. WhatsApp, Paket Membership, dan memasukkan Nomor ID Kartu Fisik yang diserahkan.
* **Perpanjangan Membership (Renewal):**
  * 1-klik perpanjang masa aktif dari profil member saat member membayar.

#### 3.3. Admin & Owner (Monitoring, Kontrol, & Laporan)
* **Dashboard Metrik Utama:**
  * Total Member Aktif saat ini.
  * Member yang mendekati habis masa aktif (H-3 / H-1).
  * Kunjungan Hari Ini (Perbandingan Member vs Tamu Harian).
  * Rekap Keuangan Masuk (Hari Ini & Bulan Ini).
* **Manajemen Member & Follow-Up WhatsApp:**
  * Tabel data member lengkap dengan status masa aktif.
  * **Tombol WhatsApp 1-Klik (`wa.me`):** Template pesan pengingat masa aktif otomatis tanpa biaya API pihak ketiga:
    > *"Halo Kak [Nama], membership Maco Gym kamu akan berakhir pada [Tanggal]. Yuk perpanjang agar latihanmu tetap rutin!"*
* **Laporan Kas Sederhana (Arus Kas Masuk):**
  * Rekap uang masuk per rentang tanggal.
  * Filter berdasarkan: Tipe (Membership vs Visit Harian) dan Metode Pembayaran (Cash vs QRIS/Transfer).
* **CMS Manajemen Paket & Trainer:**
  * Pengaturan harga tiket harian, paket membership bulanan, serta data pelatih.

#### 3.4. Member Role (Portal Mandiri - Read-Only)
* **Akses Dashboard Member:**
  * Member dapat login menggunakan Nomor WhatsApp / ID Kartu & Password.
  * Menampilkan: Sisa hari aktif membership, masa berlaku, riwayat tanggal kunjungan.
  * Log Profil Fisik (Opsional): Catatan sederhana perkembangan berat/tinggi badan.
  * *Catatan:* Member **tidak** dapat menginput presensi sendiri agar tidak terjadi kecurangan titip absen.

---

### 4. Technical Architecture & Database Design

#### 4.1. Tech Stack
* **Backend:** Laravel 11+ (PHP 8.3)
* **Frontend:** Blade Templating + Tailwind CSS (Class-based Dark/Light Mode) + Alpine.js (Ringan, interaktif, tanpa beban kompilasi SPA yang rumit)
* **Database:** MySQL / MariaDB (Dikelola via Laragon / phpMyAdmin)
* **Theme Switching:** Dark / Light Mode Toggle (Persistent via `localStorage` / session, default: Dark Mode untuk kesan eksklusif gym)

#### 4.2. Skema Database Relasional (MySQL)

1. **Tabel `users`**
   * `id` (PK, BigInt)
   * `name` (String)
   * `username` / `phone` (String, Unique)
   * `password` (String)
   * `role` (Enum: `admin`, `staff`, `member`)
   * `timestamps`

2. **Tabel `members`**
   * `id` (PK, BigInt)
   * `user_id` (FK ke `users`, Nullable)
   * `card_id` (String, Unique) -> *ID yang tercetak pada kartu fisik*
   * `name` (String)
   * `phone` (String)
   * `gender` (Enum: `male`, `female`, Nullable)
   * `join_date` (Date)
   * `current_expiry_date` (Date) -> *Tanggal jatuh tempo membership*
   * `status` (Enum: `active`, `expired`, `pending_verification`)
   * `timestamps`

3. **Tabel `packages` (Paket Membership & Layanan)**
   * `id` (PK, Int)
   * `name` (String) -> *Contoh: Visit Harian, 1 Bulan, 3 Bulan, Pelajar/Mahasiswa*
   * `type` (Enum: `membership`, `daily_visit`, `personal_trainer`)
   * `price` (Decimal/BigInt)
   * `duration_days` (Int) -> *1 untuk harian, 30 untuk 1 bulan, dll.*
   * `is_active` (Boolean)
   * `timestamps`

4. **Tabel `transactions` (Pencatatan Keuangan Masuk)**
   * `id` (PK, BigInt)
   * `invoice_code` (String, Unique)
   * `member_id` (FK ke `members`, Nullable untuk tamu harian)
   * `package_id` (FK ke `packages`)
   * `customer_name` (String) -> *Nama member atau nama tamu harian*
   * `customer_phone` (String, Nullable)
   * `amount` (BigInt)
   * `payment_method` (Enum: `cash`, `qris`, `transfer`)
   * `created_by` (FK ke `users` - staf yang bertugas)
   * `created_at` (Timestamp)

5. **Tabel `attendances` (Presensi Harian)**
   * `id` (PK, BigInt)
   * `type` (Enum: `member`, `daily_guest`)
   * `member_id` (FK ke `members`, Nullable)
   * `guest_name` (String, Nullable)
   * `checkin_time` (Timestamp)
   * `notes` (String, Nullable)

6. **Tabel `trainers`**
   * `id` (PK, Int)
   * `name` (String)
   * `specialty` (String)
   * `phone` (String, Nullable)
   * `photo_path` (String, Nullable)
   * `is_active` (Boolean)

7. **Tabel `member_progress` (Opsional - Log Fisik)**
   * `id` (PK, BigInt)
   * `member_id` (FK ke `members`)
   * `weight_kg` (Decimal)
   * `height_cm` (Decimal)
   * `recorded_at` (Date)

---

### 5. UI/UX Style Guide: Sederhana tapi Mewah (Dark & Light Mode)

Sistem mendukung **dua mode tampilan** yang dapat diubah kapan saja dengan tombol switch (ikon Bulan 🌙 / Matahari ☀️) di navbar/header. Pilihan mode otomatis tersimpan di browser (`localStorage`).

#### 5.1. Dark Mode (Default - Exclusive Luxury Gym)
* **Background Utama:** `#0B0F19` (Midnight Obsidian / Deep Slate)
* **Card / Container:** `#161F30` / `#1E293B` (Navy Slate) dengan border tipis `border-slate-800`
* **Teks Utama:** `#F8FAFC` (Pure White) & Teks Sekunder: `#94A3B8` (Slate-400)
* **Aksen Utama:** `#F59E0B` (Amber Gold) & `#D97706` (Warm Bronze)
* **Kelebihan:** Sangat elegan, modern, nyaman di mata resepsionis saat shift sore/malam, dan memberikan impresi gym premium di landing page.

#### 5.2. Light Mode (Crisp & Clean Luxury)
* **Background Utama:** `#F8FAFC` (Slate-50 / Clean Off-White)
* **Card / Container:** `#FFFFFF` (Pure White) dengan border halus `border-slate-200` dan `shadow-sm`
* **Teks Utama:** `#0F172A` (Slate-900) & Teks Sekunder: `#64748B` (Slate-500)
* **Aksen Utama:** `#D97706` (Deep Amber Gold)
* **Kelebihan:** Sangat jelas dan bersemangat, cocok digunakan staf resepsionis jika meja kasir berada di dekat pintu masuk/area terang terkena sinar matahari siang.

#### 5.3. Status Badges (Konsisten di Kedua Mode)
* 🟢 **Status Aktif:** 
  * Dark: Background `rgba(16, 185, 129, 0.15)`, teks `#34D399` (Emerald-400)
  * Light: Background `#ECFDF5`, teks `#059669` (Emerald-600)
* 🟡 **Peringatan / H-3:** 
  * Dark: Background `rgba(245, 158, 11, 0.15)`, teks `#FBBF24` (Amber-400)
  * Light: Background `#FFFBEB`, teks `#D97706` (Amber-600)
* 🔴 **Kadaluarsa (Expired):** 
  * Dark: Background `rgba(239, 68, 68, 0.15)`, teks `#F87171` (Red-400)
  * Light: Background `#FEF2F2`, teks `#DC2626` (Red-600)

#### 5.4. Karakteristik Komponen
* Kontras tinggi dengan font tajam (*Inter* / *Plus Jakarta Sans*).
* Sudut rounded modern (`rounded-xl` hingga `rounded-2xl`).
* Tombol aksi cepat di meja kasir berukuran lapang (`px-6 py-3`) agar bebas dari salah klik.

---

### 6. Rencana Implementasi Bertahap

* **Fase 1 (Inti Operasional Meja Depan):**
  1. Setup database MySQL & model migration (Member, Package, Transaction, Attendance).
  2. Halaman Kasir / Frontdesk: Form pencarian presensi kartu member (3 detik) & tombol input tamu harian.
  3. CRUD Member & input nomor kartu fisik.
  4. Laporan kas harian sederhana.
* **Fase 2 (Landing Page & Branding):**
  1. Halaman landing page publik bertema Dark Luxury.
  2. Info paket, fasilitas, trainer, Google Maps & tombol WhatsApp resepsionis.
* **Fase 3 (Penyempurnaan & Fitur Tambahan):**
  1. Tombol WhatsApp pengingat kadaluarsa (H-3).
  2. Portal member mandiri untuk cek masa aktif via HP.
