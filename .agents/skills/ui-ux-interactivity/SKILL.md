---
name: ui-ux-interactivity
description: "Use when designing, building, refining, or auditing user interfaces, layouts, typography, visual hierarchy, responsive designs, and interactive frontend behaviors. Triggers when creating or improving Blade views, Tailwind CSS layouts, interactive dashboards, forms, modals, tabs, filters, or when implementing zero-reload interactions, optimistic UI updates, Alpine.js reactivity, micro-animations, or dark/light mode polish. Also apply when fixing awkward layouts, UI blank states, or page reload jumps."
license: MIT
metadata:
  author: maco-gym
---

# UI/UX & Interactivity Standards

Panduan komprehensif untuk merancang tata letak (layout), hierarki visual, dan interaktivitas frontend berkualitas tinggi untuk Maco Gym Malang. Skill ini memastikan antarmuka terasa modern, responsif, cepat (*zero-reload*), dan bebas dari estetika klise AI (*anti-AI slop*).

---

## 1. Aturan Emas Desain & Interaktivitas

1. **Zero-Reload Interactions (Tanpa Loncat Halaman):**
   - Mengubah tab program, memfilter data, mencentang checklist, atau menyukai item **TIDAK BOLEH** menyebabkan *full page reload* (`<a>` biasa atau `<form>` submit standar) yang membuat layar meloncat kembali ke paling atas.
   - Gunakan Alpine.js untuk state reaktif di memori klien dengan *background AJAX fetch* ke endpoint Laravel.

2. **Optimistic UI Updates:**
   - Berikan umpan balik instan ke pengguna (contoh: centang langsung aktif, badge berubah status seketika) sebelum respons server tiba.
   - Jika *fetch* latar belakang gagal, kembalikan state (*rollback*) dan tampilkan pesan notifikasi yang jelas.

3. **Anti-AI Clichés & Athletic Brand Identity:**
   - **DILARANG:** Gradien ungu-pastel generik, blob mengambang acak tanpa makna teknis, sudut melengkung berlebihan yang tidak proporsional, atau placeholder teks malas.
   - **GUNAKAN:** Identitas tegas Maco Gym Malang:
     - **Athletic Crimson Red:** `#ef233c` (Tailwind `red-600` / `red-500`) untuk aksen utama, status penting, dan tombol tindakan primer.
     - **Obsidian Dark Surface:** `#0e1014` (body latar) dan `#15171d` / `#1b1e26` (surface card) dengan border halus `#262934` pada Dark Mode.
     - **Clean Slate White:** Putih bersih dengan kartu border halus `border-zinc-200` pada Light Mode.
     - **Tipografi Berkarakter:** *Montserrat* (Bold/Black, All-Caps untuk Header/Display) + *Plus Jakarta Sans* (Body/Keterangan) + *Mono* (Angka, Kode, Metrik).

4. **Keamanan Parsing Alpine.js (PENTING):**
   - **JANGAN PERNAH** menyuntikkan `@json(...)` langsung di dalam atribut HTML `x-data="..."`. Tanda kutip ganda JSON akan memotong atribut HTML dan menyebabkan `SyntaxError` fatal yang membuat tampilan kosong (*blank*).
   - Selalu inisialisasi state komponen di tag `<script>` terpisah menggunakan JavaScript murni atau daftarkan dengan `Alpine.data('componentName', ...)`.

---

## 2. Struktur Modul & Referensi Mendalam

Ketika mengerjakan aspek antarmuka tertentu, rujuk dokumen panduan berikut:

- [Layout & Visual Hierarchy](./rules/layout-and-visual-hierarchy.md): Grid responsif, perataan optik, tipografi, ritme spasi, dan sistem kartu.
- [Interactivity & State Management](./rules/interactivity-and-state.md): Arsitektur Alpine.js, zero-reload tabs, optimistic toggle, background fetch, form async, modal & drawer.
- [Micro-Interactions & Polish](./rules/micro-interactions-and-polish.md): Efek hover taktil, animasi transisi, skeleton loader, focus-visible a11y, dan toast feedback.

---

## 3. Checklist Sebelum Finalisasi UI

Sebelum menyerahkan hasil perubahan antarmuka atau kode Blade:

- [ ] Apakah interaksi klik (tab/checkbox/filter) berjalan mulus tanpa me-reload halaman atau meloncat ke atas?
- [ ] Apakah Alpine.js diinisialisasi secara aman tanpa konflik tanda kutip di atribut HTML?
- [ ] Apakah tampilan sudah teruji sempurna baik di **Light Mode** maupun **Dark Mode** (kontras teks jelas, tidak ada teks abu-abu gelap di atas background hitam)?
- [ ] Apakah tata letak responsif rapi dari layar HP (`< 640px`) hingga desktop besar (`lg` & `xl`)?
- [ ] Apakah tombol memiliki state interaktif (`hover`, `active`, `focus-visible`, `disabled`)?
- [ ] Apakah format angka, metrik berat (kg), dan tanggal ditampilkan konsisten dengan font mono/sans yang tepat?
- [ ] Jika ada form submit, apakah tombol mencegah *double-submit* saat proses berlangsung?

