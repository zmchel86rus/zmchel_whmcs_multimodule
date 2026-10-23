# Paginasi

Klik blok daftar. Tekan Esc untuk membatalkan. Tempatkan paginasi di luar blok tujuan.

Untuk Smarty, masukkan variabel daftar lengkap. Tanpa variabel, elemen HTML dalam kontainer akan dibagi menjadi halaman; Anda dapat menentukan kelas baris atau tag tr jika diperlukan. Tautan mempertahankan count, sort, dan filter. Beberapa daftar independen didukung.

Pemilih jumlah per halaman: 10, 25, 50, 100, 250

Seret pemilih jumlah item per halaman ke dalam paginasi atau ke blok halaman lainnya. Pemilih ini tetap terhubung dengan paginasi tersebut.

Pilih blok daftar Smarty. Pencarian dan paginasi harus mengarah ke blok yang sama.

Tentukan variabel daftar lengkap. Pencarian mencocokkan salah satu bidang yang dipilih; filter diterapkan bersama. Kondisi diterapkan sebelum jumlah halaman dihitung; menerapkan atau mengatur ulang akan kembali ke halaman pertama. Jika paginasi sudah terhubung, variabel dari paginasi tersebut akan digunakan.

## Tautan dan sumber daftar

Tempatkan paginasi di luar blok daftar dan pilih blok itu sebagai target. Untuk daftar Smarty, isi variabel yang memuat semua item; jika tidak, elemen HTML dalam wadah akan dibagi. Pilih bentuk tautan sesuai pengaturan modul, `/page/2/` atau `?page=2`. Bentuk jalur memerlukan aturan rewrite. Daftar independen memakai parameter terpisah; tautan mempertahankan bahasa, filter, dan pengurutan.

## Ukuran halaman, SEO, dan filter

Tetapkan jumlah item dan bila perlu aktifkan pilihan 10/25/50/100/250. Mengubah ukuran mengembalikan daftar ke halaman pertama. Noindex hanya berlaku mulai halaman kedua; periksa judul dan URL kanonis. Hubungkan filter ke daftar yang sama, lalu uji halaman kedua dan hasil yang difilter di situs publik.

## page / count / pager

Untuk daftar Smarty, tentukan variabel berisi semua item dan pertahankan perulangan `{foreach}`: modul membagi daftar, jadi jangan tambahkan `array_slice` kedua. Tanpa variabel, elemen HTML dalam wadah dibagi; Anda dapat menentukan kelas baris atau tag `tr`, sedangkan `thead` dan `tfoot` tetap utuh. Atur jumlah tombol di sekitar halaman saat ini secara terpisah untuk desktop dan ponsel. Pada rute PHP langsung gunakan `?page=2`; `/page/2/` memerlukan aturan rewrite. Halaman berikutnya memiliki canonical sendiri dan dapat diberi `noindex`.

Jika ada beberapa daftar terpisah, daftar pertama memakai `page`, `count`, dan `sort`; daftar lain memakai parameter dengan ID blok. Pada jalur `/page/N/`, `pager` menentukan daftar pemilik nomor halaman. Di blok Smarty, `$zm_pagination` menyediakan `total`, `page`, `pages`, `count`, dan `offset`. Nilai `count` dibatasi antara 10–250. Jika daftar kosong atau hanya satu halaman, panel penomoran halaman disembunyikan.

## YYYY-MM-DD

Filter bekerja pada daftar yang sama dengan penomoran halaman. Pencarian teks dapat memeriksa beberapa kolom yang dipisahkan koma; rentang tanggal memakai `YYYY-MM-DD` dan mencakup seluruh hari terakhir.

## Flex / Grid

Pilih Flex atau Grid lalu atur lebar dan kolom menurut perangkat. Menerapkan atau menghapus filter mengembalikan daftar ke halaman pertama. Pemilih jumlah hasil dapat dipindah tanpa kehilangan kaitannya; panel duplikat mengendalikan daftar yang sama.

## Petunjuk

- Jangan indeks halaman 2 dan seterusnya
- Format tautan
- Jumlah item per halaman secara default
