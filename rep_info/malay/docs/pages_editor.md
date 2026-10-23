# Penyunting Halaman

- [penomboran halaman](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [data berstruktur](module_structured_data.md)

## Penyunting dan bahasa

Pilih bahasa pada tab kandungan, seret blok GrapesJS ke kanvas, kemudian ubah teks, imej dan tetapan blok. Blok tersedia untuk seksyen, lajur, jadual, FAQ, borang hubungan, senarai, penomboran halaman dan kawasan khas tetamu atau ahli. Salin struktur ke bahasa lain jika perlu, terjemahkan teksnya dan simpan semula. Blok pautan serta butang boleh menambah bahasa halaman pada URL laman; matikan pilihan ini untuk pautan luar, fail, `mailto:` dan laluan WHMCS tanpa terjemahan.

Apabila URL mesra dan penghalaan bahasa dihidupkan, bahasa utama menggunakan laluan pendek seperti `/ms/`, atau tiada awalan jika laluan bahasa lalai dimatikan. Varian serantau menggunakan locale BCP 47. Uji pautan dalam beberapa bahasa.

## WHMCS

Dalam tetapan asas, semak nama, slug, jenis, status, akses dan bahasa. Bahasa lalai WHMCS mesti diaktifkan dalam modul; halaman yang diterbitkan perlu mempunyai kandungan dalam bahasa yang dipaparkan.

## SEO

Isikan tajuk dan keterangan bagi setiap bahasa, kemudian semak canonical, robots, Open Graph, jejak navigasi dan Schema. Pada tab peta laman, pilih kekerapan dan keutamaan untuk halaman awam bukan sistem. Simpan dan semak URL awam serta XML.

## Borang hubungan

Tambah blok **Borang hubungan**. Pilih **tiket WHMCS** dan jabatan sokongan atau **e-mel** dan penerima; isi tajuk, penerangan, subjek dan teks butang. Tetapkan nama, jenis, kewajipan dan pengesahan bagi setiap medan. Tiket pelawat memerlukan medan dengan peranan nama dan e-mel pengirim. Tulis satu pilihan setiap baris dalam senarai juntai bawah, contohnya `sales : Jualan`. Cipta medan berasingan bagi setiap persetujuan dan gunakan CAPTCHA yang ditetapkan dalam WHMCS. Simpan dan hantar ujian sebenar sebagai pelawat; semak tiket atau penghantaran, ralat dan pengosongan borang. Status hijau editor tidak mengesahkan penghantaran; tetapkan SMTP dalam WHMCS jika `mail()` gagal.

## Arahan

- Bekas susun atur Flex bersarang. Seret blok lain ke dalamnya.
- Bekas CSS Grid bersarang. Seret blok lain ke dalamnya.
- Karusel Bootstrap bersarang. Seret blok ke dalamnya; setiap satu menjadi slaid.
- Semua blok di bawah blok ini dipaparkan kepada pengguna yang telah log masuk sahaja. Berfungsi hanya apabila jenis akses halaman ialah Campuran.
- Semua blok di bawah blok ini dipaparkan kepada tetamu sahaja. Berfungsi hanya apabila jenis akses halaman ialah Campuran.
- **Tajuk halaman**
- **Perihalan meta**
- **URL kanonik**
- **Robots** — index, follow / noindex, nofollow. Mengawal pengindeksan.
- **Jenis skema** — Apabila dinyahaktifkan, penanda JSON Schema.org tidak dipaparkan bagi halaman ini.
