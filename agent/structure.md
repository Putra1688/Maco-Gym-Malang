# Struktur Project View & Controller (Maco Gym)

```
resources/
└── views/
    ├── layouts/
    │   ├── guest.blade.php        # Layout landing page publik (Dark Luxury)
    │   ├── admin.blade.php        # Layout dashboard admin & staf resepsionis
    │   └── member.blade.php       # Layout portal member (read-only sisa hari)
    │
    ├── guest/                     # Halaman publik (no auth)
    │   ├── index.blade.php        # Landing page utama
    │   ├── partials/
    │   │   ├── hero.blade.php
    │   │   ├── facilities.blade.php
    │   │   ├── packages.blade.php # Daftar paket & harga tiket harian
    │   │   ├── trainers.blade.php
    │   │   ├── location.blade.php # Lokasi Google Maps & jam buka
    │   │   └── faq.blade.php
    │   └── register_interest.blade.php # Form pra-pendaftaran / minat member
    │
    ├── admin/                     # Admin & Staf Resepsionis
    │   ├── dashboard.blade.php    # Summary card metrik harian & grafik
    │   │
    │   ├── frontdesk/             # Modul Utama Resepsionis (Operasional Meja Depan)
    │   │   └── index.blade.php    # Layar presensi kartu member + input tamu harian cepat
    │   │
    │   ├── members/               # Manajemen Member
    │   │   ├── index.blade.php    # Tabel data member (filter status, sisa hari, tombol WA)
    │   │   ├── create.blade.php   # Form pendaftaran member walk-in + assign ID kartu fisik
    │   │   ├── show.blade.php     # Detail member, log riwayat presensi & transaksi
    │   │   └── edit.blade.php
    │   │
    │   ├── packages/              # CMS Paket Membership & Tiket Harian
    │   │   ├── index.blade.php
    │   │   ├── create.blade.php
    │   │   └── edit.blade.php
    │   │
    │   ├── transactions/          # Laporan Keuangan Sederhana
    │   │   └── index.blade.php    # Rekap kas masuk harian/bulanan (Cash vs QRIS)
    │   │
    │   └── trainers/              # CMS Personal Trainer
    │       ├── index.blade.php
    │       ├── create.blade.php
    │       └── edit.blade.php
    │
    ├── member/                    # Portal Member (auth member)
    │   ├── dashboard.blade.php    # Status aktif, sisa hari, riwayat kehadiran
    │   └── profile.blade.php      # Profil member & log fisik opsional
    │
    └── auth/
        ├── login.blade.php        # Login Admin/Staf/Member
        └── passwords/
            └── reset.blade.php
```
