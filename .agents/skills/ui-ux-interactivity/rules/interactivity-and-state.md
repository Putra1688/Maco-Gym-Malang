# Interactivity & State Management Guidelines

Dokumen ini memandu pembuatan interaktivitas frontend yang reaktif, cepat, dan handal menggunakan Alpine.js serta asynchronous Fetch API di ekosistem Laravel Blade.

---

## 1. Aturan Penulisan Komponen Alpine.js yang Aman

### JANGAN PERNAH Suntikkan JSON ke Atribut HTML
❌ **SALAH (Akan Crash):**
```html
<!-- Error: Tanda kutip ganda di JSON akan memotong atribut x-data -->
<div x-data="myComponent({ items: @json($data) })">
```
Browser memotong atribut pada tanda kutip pertama di dalam string JSON `[{"id":1...`, menghasilkan atribut rusak dan `SyntaxError` di console, membuat tampilan kosong melompong (*blank*).

✅ **BENAR (Aman & Handal):**
Letakkan definisi data di dalam tag `<script>` di atas elemen HTML, lalu panggil fungsi bersihnya:
```html
<script>
    function myComponent() {
        return {
            items: @json($data),
            activeId: {{ (int) ($activeItem?->id ?? 1) }},
            csrfToken: '{{ csrf_token() }}',
            // method logic...
        };
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('myComponent', myComponent);
    });
</script>

<div x-data="myComponent()">
    <!-- Konten reaktif -->
</div>
```

---

## 2. Pola Zero-Reload & Optimistic UI

### Pola Toggle Checkbox Instan
Pengguna yang mencentang latihan mengharapkan perubahan visual seketika tanpa jeda jaringan dan **tanpa halaman me-refresh yang membuat posisi scroll kembali ke paling atas**:

```javascript
async toggleItem(index) {
    const routine = this.currentRoutine;
    if (!routine || !routine.target_exercises || !routine.target_exercises[index]) return;

    // 1. Optimistic Update Seketika di Browser
    routine.target_exercises[index].done = !routine.target_exercises[index].done;

    // 2. Kirim update ke Server di Latar Belakang (AJAX)
    try {
        const response = await fetch('/member/routine/' + routine.id + '/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken
            },
            body: JSON.stringify({ exercise_index: index })
        });
        
        if (!response.ok) throw new Error('Server returned non-200');
    } catch (err) {
        console.error('Toggle failed, reverting:', err);
        // Rollback state jika jaringan/server gagal
        routine.target_exercises[index].done = !routine.target_exercises[index].done;
        alert('Gagal menyimpan perubahan. Periksa koneksi internet Anda.');
    }
}
```

### Pola Ganti Tab Tanpa Reload
Gunakan pemetaan array di memori klien daripada navigasi URL penuh:

```html
<!-- Tombol Tab -->
<div class="flex items-center gap-2 overflow-x-auto pb-1">
    <template x-for="tab in tabs" :key="tab.id">
        <button type="button"
                @click="activeTabId = tab.id"
                class="px-3.5 py-1.5 rounded-lg text-xs font-bold uppercase transition"
                :class="activeTabId === tab.id ? 'bg-red-600 text-white' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-500 hover:text-zinc-900 dark:hover:text-white'"
                x-text="tab.name">
        </button>
    </template>
</div>

<!-- Tampilan Daftar Berdasarkan Tab Aktif -->
<div class="mt-4 space-y-2">
    <template x-for="(item, idx) in activeList" :key="idx">
        <!-- Render Item -->
    </template>
</div>
```

---

## 3. Pola Modal & Dialog Aksesibel

Untuk modal seperti Barcode Presensi atau Atur Menu Rutin:

1. **Backdrop Blur & Transisi:**
   ```html
   <div x-show="showModal"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
   ```

2. **Tutup dengan Tombol Escape & Klik Luar:**
   - Pasang `@keydown.escape.window="showModal = false"` pada elemen modal.
   - Pasang `@click.away="showModal = false"` pada container dalam dialog.

3. **Cegah Scroll Body Saat Modal Terbuka:**
   - Gunakan `x-effect="document.body.classList.toggle('overflow-hidden', showModal)"`.

---

## 4. Keamanan CSRF pada Request AJAX

Laravel memerlukan token CSRF pada setiap request `POST`, `PUT`, `PATCH`, atau `DELETE`. Selalu sertakan header:
```javascript
headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
}
```
Dan pastikan controller Laravel merespons dengan format JSON yang sesuai:
```php
if ($request->wantsJson() || $request->ajax()) {
    return response()->json(['success' => true]);
}
```

