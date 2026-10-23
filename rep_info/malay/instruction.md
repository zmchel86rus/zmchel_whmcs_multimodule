# Panduan zmchel WHMCS Multimodule

**Sebelum menggunakan modul, jana salt yang unik dan letakkannya dalam `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` dan `ZM_PB_NONCE_SALT`.** Modul ini dibangunkan dan diuji pada **WHMCS 8.13.1–8.13.7**. Keserasian PHP diperiksa untuk **7.4–8.5**. Apache disokong sepenuhnya; Nginx mungkin memerlukan konfigurasi tambahan bagi penghalaan bahasa di laman utama. **Modul ini percuma.**

**Sebelum penggunaan pertama, buka Tetapan modul → Bahasa yang disokong dan aktifkan bahasa yang anda perlukan.**

## Pengurus bahasa (dalam pembangunan)

Dalam pentadbiran WHMCS, buka Pengurus bahasa dan pilih bahagian (bahasa klien atau admin WHMCS, modul ini atau modul lain) serta bahasa. Bandingkan teks asal atau rujukan dengan terjemahan, ubah satu baris dan simpan; kunci sedia ada juga boleh dieksport dan diimport sebagai JSON. Bahasa baharu menggunakan rujukan sehingga diterjemahkan. Pengurus boleh menghidupkan atau mematikan fail bahasa dan membetulkan nama fail lama; tukar bahasa lalai dalam WHMCS dahulu.

→ [Pengurus bahasa](../english/docs/language-manager.md) (English)

## Mula menggunakan dan mencipta halaman

Buka **Addons → zmchel WHMCS Multimodule** dalam pentadbiran WHMCS. Eksport tetapan modul sebelum mengubah URL, pengalihan atau peraturan pelayan. Dalam senarai halaman, tambah halaman dengan nama dalaman dan *slug* seperti `tentang-kami`, tanpa domain atau `.php`. Pilih akses untuk semua pelawat, pengguna berdaftar atau mod campuran; kemudian pilih status draf atau diterbitkan, jenis halaman dan bahasa. Bahasa lalai WHMCS mesti wujud dalam `supported_langs.php`.

Selepas menyimpan, buka halaman itu untuk mengisi kandungan, metadata dan tetapan peta laman bagi setiap bahasa. Setiap bahagian mempunyai butang Simpan sendiri. Semak mesej kejayaan dan paparan halaman awam. Pemadaman awal memindahkan halaman ke tong sampah; pemadaman kekal dibuat di situ.

## Penyunting dan bahasa

Pilih bahasa pada tab kandungan, seret blok GrapesJS ke kanvas, kemudian ubah teks, imej dan tetapan blok. Blok tersedia untuk seksyen, lajur, jadual, FAQ, borang hubungan, senarai, penomboran halaman dan kawasan khas tetamu atau ahli. Salin struktur ke bahasa lain jika perlu, terjemahkan teksnya dan simpan semula. Blok pautan serta butang boleh menambah bahasa halaman pada URL laman; matikan pilihan ini untuk pautan luar, fail, `mailto:` dan laluan WHMCS tanpa terjemahan.

Apabila URL mesra dan penghalaan bahasa dihidupkan, bahasa utama menggunakan laluan pendek seperti `/ms/`, atau tiada awalan jika laluan bahasa lalai dimatikan. Varian serantau menggunakan locale BCP 47. Uji pautan dalam beberapa bahasa.

## SEO, media dan menu

Isi tajuk, penerangan, tetapan robots, URL kanonik serta data sosial untuk setiap bahasa. Halaman bukan sistem yang diterbitkan boleh dimasukkan ke peta laman XML. Muat naik imej melalui Media Manager, tambah teks alternatif dan semak hasil pengoptimumannya. Dalam Menu Manager, susun halaman dan pautan tersuai, kemudian tetapkan label setiap bahasa, lokasi dan keterlihatan pada desktop atau mudah alih.

## Pengalihan dan penyelenggaraan

Gunakan Redirect Manager untuk pengalihan `301` kekal atau `302` sementara. Rewrite Manager menulis peraturan `.htaccess` untuk Apache; Nginx memerlukan konfigurasi pelayan yang setara. Uji perubahan URL sebagai tetamu dan pengguna berdaftar. Eksport JSON sebelum import besar, kemudian semak halaman, menu dan media. Panduan lanjut untuk [menu](../english/docs/menus.md), [penomboran halaman](../english/docs/pagination.md), [pengalihan](../english/docs/redirects.md), [peta laman](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [data berstruktur](../english/docs/structured-data.md) dan [pemindahan data](../english/docs/transfer.md) tersedia dalam bahasa Inggeris.
