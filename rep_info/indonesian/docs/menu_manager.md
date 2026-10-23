# Menu

Buat menu, tambahkan halaman atau tautan khusus, lalu urutkan item dengan menyeretnya. Pilih item induk untuk submenu dan atur label per bahasa, visibilitas bagi tamu atau klien, serta perangkat. Tetapkan lokasi; setiap lokasi hanya dapat memiliki satu menu. Untuk tautan internal, pilih apakah URL mengikuti bahasa saat ini. Periksa menu publik di komputer dan ponsel.

Setiap item dapat memiliki judul, deskripsi, kelas CSS, `rel`, ikon, dan pilihan buka di tab baru; halaman yang diterbitkan juga dapat ditambahkan otomatis. Pilih secara terpisah untuk desktop dan ponsel apakah menu melengkapi atau menggantikan navigasi WHMCS. Tautan ke halaman modul dihitung ulang dari slug, bahasa, dan mode URL saat ini; label kosong memakai judul terjemahan atau nama halaman. Membuka halaman tidak mengubah bahasa profil pelanggan. Server menolak skema URL berbahaya dan HTML pada label.

## WHMCS

Aktifkan posisi menu WHMCS yang diperlukan di pengaturan modul. Setiap posisi hanya menampung satu menu, tetapi menu yang sama dapat digunakan di beberapa posisi. Tampilan desktop berlaku mulai lebar 768 px dan tampilan seluler untuk layar yang lebih sempit. Posisi yang dinonaktifkan tidak mengubah menu bawaan WHMCS.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Pada rute sistem WHMCS tanpa perutean bahasa modul, label menu memakai bahasa pelanggan yang tersimpan; halaman modul memakai bahasa dalam URL. Bila bahasa bawaan diberi rute sendiri, bahasa itu juga mendapat awalan. URL biasa berbentuk `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Tautan khusus dapat dibiarkan tanpa lokalisasi, misalnya `clientarea.php`. Menyembunyikan item induk menyembunyikan seluruh cabangnya.

URL item halaman dihitung ulang dari slug saat ini dan terjemahan yang sudah diterbitkan. Jika terjemahan tidak ada, versi bahasa bawaan yang diterbitkan digunakan. Tautan khusus dapat mempertahankan URL yang dimasukkan; alamat eksternal, mailto, tel, dan jangkar tidak mendapat awalan bahasa. Draf, halaman yang dihapus, dan halaman yang tidak dapat diakses disembunyikan.

## zm_pb_menus

Data disimpan di tabel `zm_pb_menus`, `zm_pb_menu_items`, dan `zm_pb_menu_locations`. Buat atau perbaiki tabel melalui Basis Data Modul. Pohon menu mendukung paling banyak 10 tingkat dan 300 item; saat induk dihapus, anak-anaknya naik satu tingkat.

## Petunjuk

- Buat menu
- Tambahkan halaman, postingan, atau tautan khusus.
- Seret item untuk mengubah urutannya. Atur hierarki menggunakan pemilih induk atau tombol pemindahan.
- Gunakan bahasa halaman saat ini
- Gunakan URL yang dimasukkan tanpa perubahan
- Label dalam bahasa lain
- Terlihat oleh
- Perangkat
- Setiap lokasi hanya dapat memiliki satu menu. Memilih lokasi akan memindahkan penugasannya dari menu lain ke menu ini.
- Item tingkat teratas menjadi kolom dan item bertingkat menjadi tautan. Gunakan URL # untuk judul tanpa tautan.
- Tabel menu belum dibuat. Tambahkan tabel tersebut di Basis Data Modul.
