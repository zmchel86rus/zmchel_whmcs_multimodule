# Aturan penulisan ulang

## WHMCS

Aturan untuk URL bahasa, termasuk halaman di bawah /ru/, /en/, dan awalan lainnya. Bahasa berasal dari supported_langs.php; aturan disisipkan ke .htaccess sebelum aturan WHMCS.

Nginx tidak membaca .htaccess, sehingga aturan ini tidak berfungsi di sana. Konfigurasikan aturan setara di nginx.

Konfigurasi nginx → Apache terdeteksi. Aturan ini hanya berfungsi untuk permintaan yang diteruskan ke Apache; nginx tidak membaca .htaccess.

Setelah menambahkan atau menghapus aturan, klik “Tambah atau perbarui aturan” untuk menerapkan perubahan ke .htaccess.

## .htaccess

Buka pengelola dan bandingkan aturan dengan berkas utama `.htaccess` situs. Untuk aturan sendiri, simpan pola URL, tujuan, dan penanda; lalu klik **Tambah atau perbarui aturan** agar blok ditulis sebelum aturan WHMCS. Periksa statusnya lagi dan buka halaman terbit dalam bahasa bawaan serta bahasa lain. Pola yang terlalu luas dapat memengaruhi halaman lain. Pada susunan Nginx → Apache, aturan ini hanya berlaku untuk permintaan yang diteruskan ke Apache.

## Petunjuk

- Periksa aturan
- Tambah atau perbarui aturan
- Hapus semua aturan dari .htaccess
- Pola URL
- Target
- Flag
