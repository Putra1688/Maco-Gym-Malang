# Struktur Project

resources/
└── views/
    ├── layouts/
    │   ├── guest.blade.php        # Layout landing page (public)
    │   ├── member.blade.php       # Layout dashboard member
    │   └── admin.blade.php        # Layout dashboard admin
    │
    ├── guest/                     # Semua halaman publik (no auth)
    │   ├── index.blade.php        # Landing page utama
    │   ├── partials/
    │   │   ├── hero.blade.php
    │   │   ├── facilities.blade.php
    │   │   ├── products.blade.php
    │   │   ├── trainers.blade.php
    │   │   └── faq.blade.php
    │   └── register.blade.php     # Form registrasi guest
    │
    ├── member/                    # Role: Member (auth)
    │   ├── dashboard.blade.php    # Status membership, sisa hari
    │   └── profile.blade.php     # Log berat & tinggi badan
    │
    ├── admin/                     # Role: Admin (auth)
    │   ├── dashboard.blade.php    # Summary cards + charts
    │   ├── members/
    │   │   ├── index.blade.php    # Tabel data member
    │   │   └── show.blade.php     # Detail member
    │   ├── products/
    │   │   ├── index.blade.php
    │   │   ├── create.blade.php
    │   │   └── edit.blade.php
    │   └── trainers/
    │       ├── index.blade.php
    │       ├── create.blade.php
    │       └── edit.blade.php
    │
    └── auth/
        ├── login.blade.php
        └── passwords/
            └── reset.blade.php



