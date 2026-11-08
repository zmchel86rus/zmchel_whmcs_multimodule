# Transfer data

Satu berkas ZIP untuk semua atau bagian yang dipilih, hingga 128 MiB (perhatikan batas unggahan PHP). Halaman yang cocok diperbarui berdasarkan slug dan jenis akses, sedangkan menu berdasarkan nama. Data lainnya tetap utuh. Sertakan halaman saat mengimpor menu ke situs baru. Bagian terpilih yang tidak ada dalam berkas akan dilewati. Berkas JSON juga didukung saat impor.

CSS/JS disertakan bersama halaman; gambar dan berkas unggahan lainnya disertakan bersama pustaka media. Riwayat revisi, variabel Smarty yang dikumpulkan, dan informasi rahasia WHMCS tidak diekspor. Buat ulang peta situs setelah impor; terapkan aturan penulisan ulang di Pengelola Penulisan Ulang.

Halaman dan postingan (terjemahan, konten, SEO, pengaturan peta situs, blok CSS/JS)

Data yang cocok dalam bagian terpilih akan diperbarui dari berkas. Lanjutkan?

## ZIP

Ekspor dapat memuat halaman dan posting beserta terjemahan, konten, SEO, dan CSS/JS; menu beserta hierarki dan lokasinya; pengaturan, pengalihan, aturan khusus, serta pustaka media berikut berkasnya. Riwayat revisi, variabel Smarty yang dikumpulkan, akun dan rahasia WHMCS, serta berkas tema tidak disertakan. Berkas ZIP dibatasi 128 MiB; batas PHP `upload_max_filesize` dan `post_max_size` juga berlaku. Saat memindahkan menu ke situs lain, impor halamannya juga dan selesaikan nama menu yang sama terlebih dahulu.

Berkas ekspor memakai format `zmchel_whmcs_multimodule` (versi 2). Saat impor, URL situs asal disesuaikan dengan `SystemURL` situs tujuan, sedangkan tautan eksternal tetap. Impor tidak membuat tabel: siapkan dahulu melalui Basis Data Modul. Sebelum dimulai, modul meminta konfirmasi; rekaman diubah dalam transaksi dan berkas yang tertimpa dipulihkan jika terjadi kesalahan.
