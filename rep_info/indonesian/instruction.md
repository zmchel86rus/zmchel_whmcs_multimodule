# Petunjuk zmchel WHMCS Multimodule

**Sebelum memakai modul, buat salt unik di `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, dan `ZM_PB_NONCE_SALT`.** Modul ini dibuat dan diuji pada **WHMCS 8.13.1–8.13.7**. Pemeriksaan kompatibilitas PHP mencakup **7.4–8.5**. Apache didukung sepenuhnya (100%); Nginx dapat digunakan, tetapi perutean bahasa di beranda mungkin membutuhkan pengaturan tambahan.

**Sebelum penggunaan pertama, buka Pengaturan modul → Bahasa yang didukung dan aktifkan bahasa yang Anda perlukan.**

**zmchel WHMCS Multimodule gratis.** Dari admin WHMCS, Anda dapat mengelola halaman multibahasa dengan editor visual, menu, pustaka media, metadata SEO, peta situs XML, pengalihan, aturan rewrite, serta impor dan ekspor.

## Pengaturan modul

Pilih bahasa yang dapat digunakan modul. Menonaktifkan bahasa tidak akan menghapus kontennya.

- **Pengaturan modul → Bahasa yang didukung → Aktifkan**
- **Basis data modul → Perbaiki Item terpilih**
- **Aturan penulisan ulang → Periksa aturan → Tambah atau perbarui aturan**

Nginx tidak membaca .htaccess, sehingga aturan ini tidak berfungsi di sana. Konfigurasikan aturan setara di nginx.

## Pengelola Halaman

- **Tambah halaman → Nama halaman → Slug halaman → Simpan**
- **Editor halaman → Pengaturan konten → Pengaturan metadata → Pengaturan peta situs halaman → Simpan semua**
- **Pengelola Halaman → Kunjungi**
- **Peta Situs → Buat peta situs**

Hanya huruf Latin, tanda hubung, dan angka yang diizinkan.

Pengguna yang masuk: hanya pengguna yang sudah masuk yang dapat mengakses halaman; Pengunjung: hanya pengunjung yang dapat mengaksesnya; Campuran: semua orang dapat mengaksesnya, dengan visibilitas diatur oleh blok di dalam halaman.

Pembuatan otomatis berjalan setelah cron WHMCS saat pembaruan diperlukan. Pembuatan manual dimulai segera.

## Panduan per bagian

- [Pengelola Halaman](docs/pages_manager.md)
- [Editor halaman](docs/pages_editor.md)
- [Pengelola Media](docs/media_manager.md)
- [menu](docs/menu_manager.md)
- [Pengelola bahasa](docs/langs_manager.md)
- [pengalihan](docs/redirects_manager.md)
- [peta situs](docs/sitemap_manager.md)
- [Aturan penulisan ulang](docs/rewrite_manager.md)
- [Pengaturan modul](docs/module_settings.md)
- [Basis data modul](docs/module_db.md)

## Materi tambahan

- [paginasi](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [data terstruktur](docs/module_structured_data.md)
- [transfer data](docs/module_settings_transfer.md)
