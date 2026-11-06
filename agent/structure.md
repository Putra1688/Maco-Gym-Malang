# Struktur Project

## Views

```
resources/views/
├── welcome.blade.php                   # Landing page (guest entry point)
│
├── components/                         # Reusable UI — dipakai lebih dari satu role
│   ├── footer.blade.php                # <x-footer /> — guest, member, admin
│   ├── modal.blade.php                 # <x-modal /> — popup login, notifikasi
│   ├── table.blade.php                 # <x-table /> — (nanti) admin & member
│   └── chart.blade.php                 # <x-chart /> — (nanti) admin
│
├── guest/
│   ├── partials/                       # Section-section landing page (hanya guest)
│   │   ├── navbar.blade.php            # Navbar dengan tombol login
│   │   ├── hero.blade.php
│   │   ├── facilities.blade.php
│   │   ├── pricing.blade.php
│   │   ├── trainers.blade.php
│   │   ├── how-to-join.blade.php
│   │   └── faq.blade.php
│   └── register.blade.php              # Form registrasi guest
│
├── auth/
│   └── login.blade.php                 # Form login (atau sebagai modal)
│
├── member/                             # (nanti)
│   ├── dashboard.blade.php             # Status membership, sisa hari aktif
│   └── profile.blade.php              # Log berat & tinggi badan
│
└── admin/                              # (nanti)
    ├── dashboard.blade.php             # Summary cards + charts
    ├── members/
    │   ├── index.blade.php
    │   └── show.blade.php
    ├── products/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    └── trainers/
        ├── index.blade.php
        ├── create.blade.php
        └── edit.blade.php
```

## Konvensi Pemanggilan

| Tipe file | Cara panggil | Contoh |
|---|---|---|
| `components/` | `<x-nama />` | `<x-footer />` |
| `guest/partials/` | `@include('guest.partials.nama')` | `@include('guest.partials.hero')` |
| `auth/`, `guest/` | `return view('auth.login')` | dari controller |

## Aturan Penempatan

- **`components/`** → kalau dipakai oleh lebih dari satu role
- **`guest/partials/`** → kalau hanya untuk landing page guest
- **Sidebar** → akan masuk `components/sidebar.blade.php` (dipakai admin & member)
- **Navbar** → tetap di `guest/partials/navbar.blade.php` (hanya guest)

## Routes

```
GET  /                  → welcome.blade.php       (guest landing page)
POST /register          → GuestController@register
GET  /login             → auth/login.blade.php
POST /login             → AuthController@login
POST /logout            → AuthController@logout

# Member (auth + role:member)
GET  /member/dashboard  → member/dashboard.blade.php
GET  /member/profile    → member/profile.blade.php

# Admin (auth + role:admin)
GET  /admin/dashboard   → admin/dashboard.blade.php
     /admin/members     → resource
     /admin/products    → resource
     /admin/trainers    → resource
```
