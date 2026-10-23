# Multimodul gratis untuk WHMCS

**Sebelum memakai modul, buat salt unik di `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, dan `ZM_PB_NONCE_SALT`.** Modul ini dibuat dan diuji pada **WHMCS 8.13.1–8.13.7**. Pemeriksaan kompatibilitas PHP mencakup **7.4–8.5**. Apache didukung sepenuhnya (100%); Nginx dapat digunakan, tetapi perutean bahasa di beranda mungkin membutuhkan pengaturan tambahan.

**Sebelum penggunaan pertama, buka Pengaturan modul → Bahasa yang didukung dan aktifkan bahasa yang Anda perlukan.**

**zmchel WHMCS Multimodule gratis.** Dari admin WHMCS, Anda dapat mengelola halaman multibahasa dengan editor visual, menu, pustaka media, metadata SEO, peta situs XML, pengalihan, aturan rewrite, serta impor dan ekspor. Baca [petunjuk penggunaan](instruction.md) sebelum mulai.

## Rencana pengembangan

- Menambahkan halaman bertingkat dan kategori atau rubrik.
- Memecah kode monolit menjadi komponen yang saling berinteraksi.
- Membuat pengelola hak akses admin dan memperluas bahasa bawaan di `supported_langs.php`.
- Membuat editor kode untuk berkas `.tpl` modul dan tema klien WHMCS, selain tema admin.
- Mengembangkan pengelola bahasa untuk berkas bahasa modul dan WHMCS, serta meningkatkan pengelola media.
- Mengembangkan pengelola SEO yang lebih lengkap, terinspirasi Yoast SEO tetapi dioptimalkan.
- Menambahkan peta situs multibahasa dan halaman peta situs HTML.
- Menambahkan statistik penggunaan pada pengelola halaman.
- Membuat pengelola optimasi untuk minifikasi JS, CSS, dan HTML, cache halaman penuh, serta optimasi tabel modul dan WHMCS.
- Membuat sistem pembaruan modul yang layak.

Ini adalah **gagasan untuk masa depan, bukan jadwal rilis yang tetap**.

## Usulkan ide atau ajukan pertanyaan

[Kirim usulan](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) atau [ajukan pertanyaan](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) melalui email `ackirkin@gmail.com`.
