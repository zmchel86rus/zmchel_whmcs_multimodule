# Peraturan tulis semula

## WHMCS

Peraturan untuk URL bahasa, termasuk halaman di bawah /ru/, /en/ dan awalan lain. Bahasa diperoleh daripada supported_langs.php; peraturan dimasukkan ke .htaccess sebelum peraturan WHMCS.

Nginx tidak membaca .htaccess, jadi peraturan ini tidak berfungsi padanya. Konfigurasikan peraturan yang setara dalam nginx.

Konfigurasi nginx → Apache dikesan. Peraturan ini hanya berfungsi untuk permintaan yang diteruskan ke Apache; nginx tidak membaca .htaccess.

Selepas menambah atau memadam peraturan, klik “Tambah atau kemas kini peraturan” untuk menerapkan perubahan pada .htaccess.

## .htaccess

Buka pengurus dan bandingkan peraturan dengan fail utama `.htaccess` laman. Untuk peraturan tersuai, simpan corak URL, sasaran dan bendera; kemudian pilih **Tambah atau kemas kini peraturan** supaya blok ditulis sebelum peraturan WHMCS. Semak semula status dan buka halaman terbitan dalam bahasa lalai serta bahasa lain. Corak terlalu luas boleh menjejaskan halaman lain. Dalam susunan Nginx → Apache, peraturan ini hanya berkuat kuasa bagi permintaan yang diteruskan kepada Apache.

## Arahan

- Semak peraturan
- Tambah atau kemas kini peraturan
- Padam semua peraturan daripada .htaccess
- Corak URL
- Sasaran
- Bendera
