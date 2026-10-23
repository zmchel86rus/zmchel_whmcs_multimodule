# Pengelola Halaman

## Memulai dan membuat halaman

Buka **Addons → zmchel WHMCS Multimodule** di area admin WHMCS. Sebelum mengubah URL, pengalihan, atau aturan server, ekspor pengaturan modul. Di daftar halaman, pilih tambah halaman, isi nama internal dan *slug* seperti `tentang-kami` tanpa domain atau `.php`. Pilih akses untuk semua pengunjung, pengguna yang masuk, atau mode campuran; lalu pilih status draf atau terbit, jenis halaman, dan bahasa. Bahasa bawaan WHMCS harus tersedia di `supported_langs.php`.

Setelah menyimpan, buka halaman untuk mengisi konten, metadata, dan pengaturan peta situs per bahasa. Setiap bagian memiliki tombol simpan sendiri; periksa pesan hasilnya. Penghapusan awal memindahkan halaman ke tempat sampah, tempat penghapusan permanen dilakukan.

## URL

Saring daftar menurut nama, akses, jenis, status, atau bahasa. **Kunjungi** membuka URL publik. **Hapus** mula-mula memindahkan halaman ke tempat sampah; penghapusan permanen dilakukan di sana. Jika halaman tidak terbuka, periksa status terbit, bahasa aktif, dan jenis akses.

## WHMCS

Untuk mengganti halaman WHMCS, pilih alamat sistem yang sudah ada dan halaman modul yang telah diterbitkan. Pilih penggantian penuh, penambahan sebelum atau sesudah konten standar, atau hanya meta/SEO. Simpan lalu uji URL WHMCS asli sebagai pengunjung dan sebagai pelanggan yang masuk.

## Petunjuk

- Tambah halaman
- **Nama halaman** — Nama internal halaman
- **Slug halaman** — Hanya huruf Latin, tanda hubung, dan angka yang diizinkan.
- **Jenis akses** — Pengguna yang masuk: hanya pengguna yang sudah masuk yang dapat mengakses halaman; Pengunjung: hanya pengunjung yang dapat mengaksesnya; Campuran: semua orang dapat mengaksesnya, dengan visibilitas diatur oleh blok di dalam halaman.
- **Jenis halaman** — Halaman sistem tidak disertakan dalam peta situs dan tidak tersedia bagi pengguna biasa.
- **Bahasa halaman** — Bahasa bawaan selalu disertakan, apa pun pilihan Anda.
- Penggantian penuh menggantikan konten yang ditampilkan dan metadata. Tambahkan sebelum menempatkan konten sebelum konten halaman yang ada. Tambahkan sesudah menempatkan konten setelah konten halaman yang ada. Hanya metadata/SEO menggantikan metadata halaman.
- Navigasi daftar halaman
