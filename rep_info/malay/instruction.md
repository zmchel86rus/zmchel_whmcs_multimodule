# Panduan zmchel WHMCS Multimodule

**Sebelum menggunakan modul, jana salt yang unik dalam `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` dan `ZM_PB_NONCE_SALT`.** Modul ini dibangunkan dan diuji pada **WHMCS 8.13.1–8.13.7**. Keserasian PHP diperiksa untuk **7.4–8.5**. Apache disokong sepenuhnya (100%); Nginx boleh digunakan, tetapi penghalaan bahasa di laman utama mungkin memerlukan tetapan tambahan.

**Sebelum penggunaan pertama, buka Tetapan modul → Bahasa yang disokong dan aktifkan bahasa yang anda perlukan.**

**zmchel WHMCS Multimodule ialah modul percuma.** Ia membolehkan anda mengurus halaman berbilang bahasa melalui penyunting visual, menu, pustaka media, metadata SEO, peta laman XML, pengalihan, peraturan rewrite serta import dan eksport dari pentadbiran WHMCS.

## Tetapan modul

Pilih bahasa yang boleh digunakan oleh modul. Menyahaktifkan bahasa tidak akan memadam kandungannya.

- **Tetapan modul → Bahasa yang disokong → Aktifkan**
- **Pangkalan data modul → Baiki Item terpilih**
- **Peraturan tulis semula → Semak peraturan → Tambah atau kemas kini peraturan**

Nginx tidak membaca .htaccess, jadi peraturan ini tidak berfungsi padanya. Konfigurasikan peraturan yang setara dalam nginx.

## Pengurus Halaman

- **Tambah halaman → Nama halaman → Slug halaman → Simpan**
- **Penyunting Halaman → Tetapan kandungan → Tetapan metadata → Tetapan peta laman halaman → Simpan semua**
- **Pengurus Halaman → Lawati**
- **Peta Laman → Jana peta laman**

Hanya huruf Latin, tanda sempang dan angka dibenarkan.

Pengguna yang telah log masuk: hanya pengguna yang telah log masuk boleh mengakses halaman; Tetamu: hanya tetamu boleh mengaksesnya; Campuran: semua orang boleh mengakses halaman dan keterlihatan dikawal melalui blok di dalam halaman.

Penjanaan automatik berjalan selepas cron WHMCS apabila kemas kini diperlukan. Penjanaan manual bermula serta-merta.

## Panduan mengikut bahagian

- [Pengurus Halaman](docs/pages_manager.md)
- [Penyunting Halaman](docs/pages_editor.md)
- [Pengurus Media](docs/media_manager.md)
- [menu](docs/menu_manager.md)
- [Pengurus bahasa](docs/langs_manager.md)
- [pengalihan](docs/redirects_manager.md)
- [peta laman](docs/sitemap_manager.md)
- [Peraturan tulis semula](docs/rewrite_manager.md)
- [Tetapan modul](docs/module_settings.md)
- [Pangkalan data modul](docs/module_db.md)

## Bahan tambahan

- [penomboran halaman](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [data berstruktur](docs/module_structured_data.md)
- [pemindahan data](docs/module_settings_transfer.md)
