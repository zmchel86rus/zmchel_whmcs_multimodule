# Multimodul percuma untuk WHMCS

**Sebelum menggunakan modul, jana salt yang unik dalam `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` dan `ZM_PB_NONCE_SALT`.** Modul ini dibangunkan dan diuji pada **WHMCS 8.13.1–8.13.7**. Keserasian PHP diperiksa untuk **7.4–8.5**. Apache disokong sepenuhnya (100%); Nginx boleh digunakan, tetapi penghalaan bahasa di laman utama mungkin memerlukan tetapan tambahan.

**zmchel WHMCS Multimodule ialah modul percuma.** Ia membolehkan anda mengurus halaman berbilang bahasa melalui penyunting visual, menu, pustaka media, metadata SEO, peta laman XML, pengalihan, peraturan rewrite serta import dan eksport dari pentadbiran WHMCS. Rujuk [panduan penggunaan](instruction.md) sebelum bermula.

## Rancangan pembangunan

- Menambah halaman bersarang serta kategori atau rubrik halaman.
- Memecahkan kod monolit kepada komponen yang saling berinteraksi.
- Membina pengurus hak akses admin dan menambah bahasa lalai dalam `supported_langs.php`.
- Membina penyunting kod untuk fail `.tpl` modul serta tema klien WHMCS, tetapi bukan tema admin.
- Memperluas pengurus bahasa untuk fail bahasa modul dan WHMCS, serta menambah baik pengurus media.
- Membina pengurus SEO lengkap yang diilhamkan oleh Yoast SEO tetapi lebih dioptimumkan.
- Menambah peta laman berbilang bahasa dan halaman peta laman HTML.
- Menambah statistik penggunaan pada pengurus halaman.
- Membina pengurus pengoptimuman untuk mengecilkan JS, CSS dan HTML, cache halaman penuh, serta pengoptimuman jadual modul dan WHMCS.
- Membina sistem kemas kini modul yang lebih baik.

Ini ialah **idea untuk masa depan, bukan pelan keluaran yang tetap**.

## Cadangkan idea atau tanya soalan

[Hantar cadangan](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) atau [tanya soalan](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) melalui `ackirkin@gmail.com`.
