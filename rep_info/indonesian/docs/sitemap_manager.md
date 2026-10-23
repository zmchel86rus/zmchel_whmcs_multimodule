# Peta situs

Pembuatan otomatis berjalan setelah cron WHMCS saat pembaruan diperlukan. Pembuatan manual dimulai segera.

Halaman dan postingan aktif yang dapat diakses pengunjung, termasuk versi bahasa yang dipublikasikan, akan disertakan. Penggantian halaman menggunakan URL publik dari halaman yang digantikannya.

Jika tidak ada yang dipilih, peta situs diperbarui setiap hari.

Jika diaktifkan, /html-sitemap menampilkan peta situs sebagai halaman HTML biasa; sitemap.xml tidak terpengaruh.

## XML

XML memuat tautan timbal balik untuk bahasa aktif dan `x-default` untuk alamat bahasa bawaan. Sumber pengalihan tidak masuk ke `loc` atau alternatif bahasa; terjemahan cadangan ditandai dengan bahasa sebenarnya dari konten. Berkas halaman dan posting mendeklarasikan namespace XHTML.

Hook `AfterCronJob` membandingkan interval `ZM_PB_SITEMAP_UPDFREQ` dengan waktu keberhasilan terakhir `ZM_PB_SITEMAP_LASTUPD`; saat sitemap dimatikan, pembuatan manual juga tidak tersedia. Versi bahasa dipilih menurut `lang_active`, bukan `lang_status`. Bagian tambahan memakai akhiran `_2`, `_3`, dan seterusnya. Jika pembuatan gagal, berkas sebelumnya dipulihkan dan waktu keberhasilan tidak berubah. Periksa izin menulis ke akar situs, `resources/`, dan `inc/editable_consts.php`; tabel diperbaiki secara terpisah di basis data modul.

Pembuatan otomatis mengikuti cron WHMCS dan interval yang diatur; tombol pembuatan menjalankannya segera. Hanya halaman dan posting yang diterbitkan serta dapat dilihat tamu, beserta terjemahan aktifnya, yang disertakan. Jika sebuah halaman menggantikan halaman sistem, URL publik halaman sistem digunakan, bukan slug halaman penggantinya. Berkas yang melebihi 50.000 URL atau 50 MB dibagi menjadi beberapa bagian. Indeks mempertahankan sitemap lain yang valid.

Modul menulis `sitemap_index.xml`, `sitemap_pages.xml`, dan `sitemap_posts.xml` di akar situs; kategori kosong tidak menghasilkan berkas. Modul tidak membuat `sitemap.xml` gabungan. Setelah halaman atau bahasa berubah, buat ulang peta situs lalu buka indeksnya di peramban. Jika terjadi kesalahan, periksa izin tulis pada akar situs; waktu pembuatan terakhir yang berhasil tidak berubah.

## Petunjuk

- Buat peta situs
- Berkas di direktori utama situs
- Pembuatan terakhir yang berhasil
- Pembaruan berikutnya paling cepat pada
- **Frekuensi pembaruan** — Jika kosong, nilai bawaannya adalah 'monthly'.
- **Prioritas pembaruan** — Jika kosong, nilai bawaannya adalah '0.5'.
