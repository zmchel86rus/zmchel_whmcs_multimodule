# Data terstruktur

- **Editor halaman → Pengaturan metadata → Jenis skema → Simpan.**

## Data yang ditandai modul

Menu dan daftar isi dapat menghasilkan `SiteNavigationElement`, tanya jawab yang terlihat menghasilkan `FAQPage`, dan jejak navigasi dengan beberapa item menghasilkan `BreadcrumbList`. Blok tata letak, tombol, dan filter tidak otomatis diberi jenis konten. Jenis Schema yang dipilih untuk halaman mengatur keluaran JSON-LD-nya; jika dimatikan, penandaan ini tidak ditampilkan.

## Pemeriksaan setelah terbit

Di halaman publik, periksa JSON-LD, URL kanonis, bahasa, dan konten yang benar-benar terlihat. Penandaan yang valid tidak menjamin hasil kaya di mesin pencari.

## Schema.org

`SiteNavigationElement` memakai tautan dan judul menu yang benar-benar terlihat; daftar isi dapat menambahkan `WebPageElement` untuk judul yang memang ada di halaman. `FAQPage` hanya mengambil pertanyaan dan jawaban lengkap yang terlihat oleh pengunjung: blok tersembunyi dan akordeon biasa dikecualikan. `BreadcrumbList` dibuat hanya jika ada setidaknya dua item. Data organisasi berasal dari WHMCS; bahasa kontak ditulis di `ContactPoint.availableLanguage` dalam format BCP 47. Modul tidak menebak tipe Schema untuk filter, penomoran halaman, formulir, atau HTML khusus.

## Petunjuk

- **Jenis skema** — Jika dinonaktifkan, markup JSON Schema.org tidak akan dihasilkan untuk halaman ini.
- **Jejak navigasi** — Nama halaman dalam jejak navigasi
- **URL kanonis**
- **Judul halaman**
- **Deskripsi meta**
- **Judul Open Graph** — Jika kosong, judul halaman akan digunakan.
- **Deskripsi Open Graph** — Jika kosong, deskripsi meta akan digunakan.
- **Gambar Open Graph** — Jika kosong, gambar halaman akan digunakan.
