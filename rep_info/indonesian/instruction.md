# Petunjuk zmchel WHMCS Multimodule

**Sebelum menggunakan modul, buat salt unik dan masukkan ke `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, dan `ZM_PB_NONCE_SALT`.** Modul ini dikembangkan dan diuji pada **WHMCS 8.13.1–8.13.7**. Kompatibilitas PHP telah diperiksa untuk **7.4–8.5**. Apache didukung sepenuhnya; Nginx mungkin memerlukan konfigurasi tambahan untuk perutean bahasa di beranda. **Modul ini gratis.**

**Sebelum penggunaan pertama, buka Pengaturan modul → Bahasa yang didukung dan aktifkan bahasa yang Anda perlukan.**

## Pengelola bahasa (dalam pengembangan)

Di admin WHMCS, buka Pengelola bahasa lalu pilih bagian (bahasa klien atau admin WHMCS, modul ini atau modul lain) dan bahasa. Bandingkan teks asli atau referensi dengan terjemahan, ubah satu baris dan simpan; kunci yang sudah ada juga dapat diekspor dan diimpor sebagai JSON. Bahasa baru memakai referensi sampai diterjemahkan. Pengelola dapat mengaktifkan atau menonaktifkan berkas bahasa serta membetulkan nama berkas lama; ubah dulu bahasa bawaan di WHMCS.

→ [Pengelola bahasa](../english/docs/language-manager.md) (English)

## Memulai dan membuat halaman

Buka **Addons → zmchel WHMCS Multimodule** di area admin WHMCS. Sebelum mengubah URL, pengalihan, atau aturan server, ekspor pengaturan modul. Di daftar halaman, pilih tambah halaman, isi nama internal dan *slug* seperti `tentang-kami` tanpa domain atau `.php`. Pilih akses untuk semua pengunjung, pengguna yang masuk, atau mode campuran; lalu pilih status draf atau terbit, jenis halaman, dan bahasa. Bahasa bawaan WHMCS harus tersedia di `supported_langs.php`.

Setelah menyimpan, buka halaman untuk mengisi konten, metadata, dan pengaturan peta situs per bahasa. Setiap bagian memiliki tombol simpan sendiri; periksa pesan hasilnya. Penghapusan awal memindahkan halaman ke tempat sampah, tempat penghapusan permanen dilakukan.

## Editor dan bahasa

Pilih bahasa di tab konten, seret blok GrapesJS ke kanvas, lalu ubah teks, gambar, dan pengaturannya. Tersedia bagian, kolom, tabel, FAQ, formulir kontak, daftar, paginasi, serta area khusus tamu atau anggota. Anda dapat menyalin struktur ke bahasa lain, kemudian menerjemahkan isinya sebelum menerbitkan. Blok tautan dan tombol dapat menambahkan bahasa halaman ke URL situs; matikan opsi itu untuk tautan eksternal, berkas, `mailto:`, dan rute WHMCS yang tidak memiliki versi bahasa.

Jika URL cantik dan perutean bahasa aktif, bahasa utama memakai rute pendek, misalnya `/id/`, atau tanpa prefiks jika opsi rute bahasa bawaan dimatikan. Varian regional menggunakan locale BCP 47. Periksa tautan dalam beberapa bahasa setelah disimpan.

## SEO, media, dan menu

Isi judul, deskripsi, pengaturan robots, URL kanonis, dan data sosial untuk setiap bahasa. Halaman terbit yang bukan halaman sistem dapat dimasukkan ke peta situs XML. Unggah gambar melalui Media Manager, tambahkan teks alternatif, lalu periksa hasil optimasinya. Dalam Menu Manager, susun halaman dan tautan khusus, atur label per bahasa, lokasi, serta visibilitas desktop dan seluler.

## Pengalihan dan pemeliharaan

Gunakan Redirect Manager untuk pengalihan `301` permanen atau `302` sementara. Rewrite Manager menulis aturan `.htaccess` untuk Apache; pada Nginx, aturan setara harus dikonfigurasi di server. Uji setiap perubahan URL dalam keadaan keluar dan masuk akun. Ekspor JSON sebelum impor besar, lalu periksa halaman, menu, dan media sesudahnya. Petunjuk rinci untuk [menu](../english/docs/menus.md), [paginasi](../english/docs/pagination.md), [pengalihan](../english/docs/redirects.md), [peta situs](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [data terstruktur](../english/docs/structured-data.md), dan [transfer data](../english/docs/transfer.md) tersedia dalam bahasa Inggris.
