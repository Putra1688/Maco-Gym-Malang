# Dokumentasi Sistem: Portal Member Maco Gym Malang

> **Versi:** 1.2.0  
> **Terakhir Diperbarui:** November 2026  
> **Target Pengguna:** Anggota Resmi (Members) Maco Gym Malang  
> **Stack Teknologi:** Laravel 11 (PHP 8.3), Tailwind CSS v4, Chart.js v4 UMD, Alpine.js, MySQL (Laragon)

---

## 1. Filosofi Desain & Penyelarasan Tema

### 1.1. Keselarasan Identitas Visual (Landing Page Match)
Portal member dirancang selaras 100% dengan atmosfer atletis premium pada Landing Page Maco Gym Malang:
* **Warna Aksen Utama:** **Athletic Crimson Red** (`#ef233c` / `red-600` dengan hover `#dc2626`).
* **Latar Gelap (Dark Mode - Default):** **Deep Obsidian Zinc** (`#0e1014` untuk canvas background dan `#15171d` untuk kartu/container) dengan batas kontras tegas (`border-[#262934]`).
* **Latar Terang (Light Mode):** **Crisp Off-White Slate** (`#f8fafc` dengan kartu `#ffffff` dan border `#e2e8f0`).
* **Tipografi:** 
  * *Montserrat* (Uppercase, Bold/Black, tracking-tight) untuk display atletis, nama member, dan judul kartu.
  * *Plus Jakarta Sans* untuk keterbacaan tinggi pada data metrik, formulir, dan teks tubuh.
  * *Monospace (Font Tabular)* untuk ID Kartu, jam WIB, tanggal, dan angka berat badan.

### 1.2. Prinsip Anti-AI Flag (Anti-AI Clichés)
Untuk memastikan tampilan tidak tampak seperti template AI generik (*AI slop*), diterapkan kaidah desain profesional:
1. **Menghilangkan Gradien Ungu/Pink Neon Mengambang:** Menggunakan palet monokrom gelap maskulin dengan satu aksen merah tegas (*laser red*) khas fasilitas gym atletis.
2. **Konteks Operasional Nyata:** Menggunakan data nyata (ID Kartu `MC-001`, cabang Pandanwangi & Lowokwaru, jam WIB, berat badan kilogram, latihan barbell & dumbbell nyata).
3. **Keterbacaan dan Ergonomi Kasir:** Tombol dan barcode berukuran lapang, siap dipindai oleh scanner meja kasir frontdesk dalam 3 detik.
4. **Bahasa Indonesia Alami:** Menghindari terjemahan kaku atau jargon asing yang berlebihan.

---

## 2. Struktur Skema Database Relasional

Sistem portal member terhubung langsung ke database MySQL `maco` melalui model-model Eloquent berikut:

### 2.1. Tabel `members`
Menyimpan identitas anggota keanggotaan fisik dan target personal.
* `id` (PK, BigInt)
* `user_id` (FK ke `users`, Nullable)
* `card_id` (String, Unique) -> *Contoh: `MC-001`*
* `name` (String) -> *Nama lengkap anggota*
* `phone` (String) -> *Nomor WhatsApp aktif*
* `gender` (Enum: `male`, `female`)
* `branch` (String) -> *Cabang utama: 'Pandanwangi Green Park' / 'Lowokwaru'*
* `target_weight_kg` (Decimal 5,2, Nullable) -> *Target berat badan yang ingin dicapai*
* `fitness_goal` (String, Nullable) -> *Tujuan: 'Fat Loss & Lean Muscle', 'Bulking', dll.*
* `join_date` (Date) -> *Tanggal pertama kali bergabung*
* `current_expiry_date` (Date) -> *Tanggal jatuh tempo keanggotaan*
* `status` (Enum: `active`, `expired`, `pending_verification`)

### 2.2. Tabel `member_progress`
Mencatat riwayat perkembangan fisik berkala dari penimbangan di gym.
* `id` (PK, BigInt)
* `member_id` (FK ke `members`, Cascade Delete)
* `weight_kg` (Decimal 5,2) -> *Berat badan (kg)*
* `height_cm` (Decimal 5,2) -> *Tinggi badan (cm)*
* `waist_cm` (Decimal 5,2, Nullable) -> *Lingkar pinggang (cm)*
* `chest_cm` (Decimal 5,2, Nullable) -> *Lingkar dada (cm)*
* `notes` (Text, Nullable) -> *Catatan pola makan / latihan*
* `recorded_at` (Date) -> *Tanggal pengukuran*

### 2.3. Tabel `member_routines`
Menyimpan target program rutinitas latihan harian (*workout split*).
* `id` (PK, BigInt)
* `member_id` (FK ke `members`, Cascade Delete)
* `day_name` (String) -> *Contoh: 'Push Day', 'Pull Day', 'Leg Day'*
* `title` (String) -> *Fokus otot: 'Dada, Bahu Depan & Triceps'*
* `target_exercises` (JSON) -> *Array item: `[{"name": "...", "sets": "...", "done": true/false}]`*
* `is_active` (Boolean, Default: true)

### 2.4. Tabel `attendances`
Log riwayat presensi yang dicatat meja depan saat kartu member di-tap/scan.
* `id` (PK, BigInt)
* `type` (Enum: `member`, `daily_guest`)
* `member_id` (FK ke `members`, Nullable)
* `checkin_time` (Timestamp) -> *Waktu kedatangan di gym*
* `notes` (Text, Nullable)

---

## 3. Manajemen Target Latihan (Workout Routines)

### 3.1. Siapa yang Mengatur?
Target latihan dirancang dapat diatur oleh **dua pihak**:
1. **Member Mandiri (Fokus Saat Ini):**
   * Member memiliki kendali penuh melalui tombol **"Atur Menu"** pada kartu *Target Latihan Hari Ini*.
   * **Beralih Hari / Split:** Member dapat memilih hari latihan (misal beralih antara *Push Day*, *Pull Day*, atau *Leg Day*).
   * **Tambah Gerakan Baru:** Member dapat memasukkan nama latihan (misal: *Incline Dumbbell Curl*) dan target repetisi (misal: *4 Sets x 12 Reps*).
   * **Hapus Gerakan:** Member dapat menghapus variasi gerakan yang tidak ingin dikerjakan.
   * **Reset Sesi:** Tombol reset untuk mengembalikan semua status centang ke posisi belum selesai saat memulai sesi latihan baru di gym.
   * **Template Cepat:** Member dapat menerapkan template bawaan rekomendasi pelatih Maco Gym seperti *Push-Pull-Legs (3 Hari)* atau *Upper-Lower (4 Hari)* dengan 1 klik.
2. **Personal Trainer (Coach) / Admin:**
   * Diatur melalui panel admin member untuk member yang mengambil bimbingan personal trainer intensif.

---

## 4. Metodologi & Formula Penghitungan Kapasitas Alat dan Area (Gym Crowd Meter)

Penghitungan kapasitas pada widget **Live Gym Crowd** Maco Gym didasarkan pada standar operasional industri kebugaran:

### 4.1. Faktor Luas Area Bersih (*Effective Floor Space*)
* Standar industri menetapkan ruang gerak aman minimal adalah **4.0 - 5.0 m² per orang** di zona beban bebas (*free weights zone*) dan **3.0 - 3.5 m² per orang** di zona mesin kardio.
* Pada fasilitas Maco Gym Malang (area latihan efektif rata-rata ~150 - 180 m²), kapasitas maksimal aman tanpa saling berdesakan adalah **35 - 40 orang**.

### 4.2. Faktor Ketersediaan Stasiun Alat (*Station Count*)
Jumlah unit alat aktif yang dapat digunakan secara bersamaan di Maco Gym:
* **Free Weights & Racks:** 3 unit Bench Press, 2 unit Power/Squat Rack & Smith Machine, 4 unit Dumbbell Benches (Total ~9 stasiun).
* **Selectorized & Plate-Loaded Machines:** Lat Pulldown, Seated Cable Row, Cable Crossover, Leg Press 45°, Leg Extension, Leg Curl, Pec Deck Fly, Shoulder Press (Total ~16 stasiun).
* **Cardio Area:** Treadmill, Static Bike, Elliptical (Total ~6 stasiun).
* **Functional / Stretching Corner:** Area matras & pull up bar (~4 stasiun).
* **Total Stasiun Alat Aktif = 35 Stasiun.**

### 4.3. Formula Real-Time Durasi Sesi Latihan (*Rolling Window*)
Di meja resepsionis, setiap kedatangan member di-scan dan dicatat di tabel `attendances`. Rata-rata durasi member di gym adalah **60 hingga 90 menit**:
$$\text{Active Attendees} = \text{Jumlah Check-in dalam 90 Menit Terakhir}$$
$$\text{Persentase Kapasitas} = \min\left(100\%, \frac{\text{Active Attendees}}{\text{Max Safe Station Capacity (35)}} \times 100\%\right)$$

### 4.4. Kurva Ritme Harian Gym Indonesia (Time-of-Day Heuristic)
Sistem memadukan data presensi riil dengan ritme jam operasional Maco Gym:
* **06:00 - 09:00 WIB (Pagi):** Kapasitas ~30% (*Sepi / Segar*).
* **09:00 - 15:00 WIB (Siang):** Kapasitas ~20% (*Sangat Lengang*, bebas antre alat).
* **15:00 - 17:00 WIB (Sore):** Kapasitas ~50% (*Mulai Ramai*, shift sore).
* **17:00 - 20:30 WIB (Malam - Peak Hours):** Kapasitas ~82% (*Jam Sibuk*, disarankan berbagi alat / *work-in*).
* **20:30 - 22:00 WIB (Malam Santai):** Kapasitas ~40% (*Sedang*, kondusif untuk pendinginan).

---

## 5. Akun Uji Coba & Kredensial Seeder

Data seeder telah terkonfigurasi dengan data realistis pada database `maco`:

| Skenario Pengujian | ID Kartu / No. WhatsApp | Password | Nama Member | Status & Detail Data |
|---|---|---|---|---|
| **Member Aktif (Primary Demo)** | `081234567899` atau `MC-001` | `member123` | Bima Arya | **Aktif (Sisa 20 Hari)**. Memiliki 6 titik log berat badan (76.8 &rarr; 73.8 kg), 14 log presensi bulan ini, dan 3 program latihan aktif. |
| **Peringatan Hampir Habis (H-2)** | `081234567898` atau `MC-002` | `member123` | Siti Rahma | **Hampir Habis (H-2)**. Menguji visualisasi badge peringatan kuning dan banner perpanjangan. |
| **Member Kadaluarsa (Expired)** | `081234567897` atau `MC-003` | `member123` | Doni Kusuma | **Expired (Mati 10 hari lalu)**. Menguji badge merah kadaluarsa dan tombol cepat perpanjang via WhatsApp CS. |

---

## 6. Panduan Pengujian di Browser

1. **Jalankan web server:**
   ```bash
   php artisan serve
   ```
2. **Akses via Preview:** Buka `http://127.0.0.1:8000/member-preview`
3. **Akses via Login:** Buka `http://127.0.0.1:8000/login`, login dengan `081234567899` / `member123`.
4. **Uji Manajemen Latihan:**
   * Klik tombol tab hari (*Push Day*, *Pull Day*, *Leg Day*).
   * Klik tombol **"Atur Menu"** untuk membuka modal manajemen gerakan: tambah gerakan baru, hapus gerakan, atau terapkan template.
   * Ceklis gerakan yang selesai dilakukan.
