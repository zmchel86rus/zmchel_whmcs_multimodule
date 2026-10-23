# Editor halaman

- [paginasi](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [data terstruktur](module_structured_data.md)

## Editor dan bahasa

Pilih bahasa di tab konten, seret blok GrapesJS ke kanvas, lalu ubah teks, gambar, dan pengaturannya. Tersedia bagian, kolom, tabel, FAQ, formulir kontak, daftar, paginasi, serta area khusus tamu atau anggota. Anda dapat menyalin struktur ke bahasa lain, kemudian menerjemahkan isinya sebelum menerbitkan. Blok tautan dan tombol dapat menambahkan bahasa halaman ke URL situs; matikan opsi itu untuk tautan eksternal, berkas, `mailto:`, dan rute WHMCS yang tidak memiliki versi bahasa.

Jika URL cantik dan perutean bahasa aktif, bahasa utama memakai rute pendek, misalnya `/id/`, atau tanpa prefiks jika opsi rute bahasa bawaan dimatikan. Varian regional menggunakan locale BCP 47. Periksa tautan dalam beberapa bahasa setelah disimpan.

## WHMCS

Pada pengaturan dasar, periksa nama, slug, jenis, status, akses, dan bahasa. Bahasa bawaan WHMCS harus aktif di modul; halaman terbit harus memiliki konten dalam bahasa yang ditampilkan.

## SEO

Isi judul dan deskripsi untuk tiap bahasa, lalu periksa canonical, robots, Open Graph, jejak navigasi, dan Schema. Di tab peta situs, pilih frekuensi dan prioritas untuk halaman publik non-sistem. Simpan lalu periksa URL publik dan XML.

## Formulir kontak

Tambahkan blok **Formulir kontak**. Pilih **tiket WHMCS** dan departemen dukungan atau **email** dan penerima; isi judul, deskripsi, subjek, dan teks tombol. Beri setiap kolom nama, jenis, status wajib, dan validasi. Tiket tamu perlu kolom dengan peran nama dan email pengirim. Tulis satu pilihan per baris pada daftar tarik turun, misalnya `sales : Penjualan`. Buat kolom terpisah untuk setiap persetujuan dan gunakan CAPTCHA yang diatur di WHMCS. Simpan lalu kirim uji nyata sebagai tamu; periksa tiket atau pengiriman, kesalahan, dan pengosongan formulir. Status hijau di editor tidak memastikan pesan terkirim; atur SMTP di WHMCS jika `mail()` gagal.

## Petunjuk

- Kontainer tata letak Flex bertingkat. Seret blok lain ke dalamnya.
- Kontainer CSS Grid bertingkat. Seret blok lain ke dalamnya.
- Karusel Bootstrap bertingkat. Seret blok ke dalamnya; setiap blok menjadi satu slide.
- Semua blok di bawah blok ini hanya ditampilkan kepada pengguna yang sudah masuk. Hanya berfungsi jika jenis akses halaman adalah Campuran.
- Semua blok di bawah blok ini hanya ditampilkan kepada pengunjung. Hanya berfungsi jika jenis akses halaman adalah Campuran.
- **Judul halaman**
- **Deskripsi meta**
- **URL kanonis**
- **Robots** — index, follow / noindex, nofollow. Mengatur pengindeksan.
- **Jenis skema** — Jika dinonaktifkan, markup JSON Schema.org tidak akan dihasilkan untuk halaman ini.
