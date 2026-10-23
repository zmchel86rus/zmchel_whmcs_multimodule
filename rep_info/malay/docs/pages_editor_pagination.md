# Penomboran halaman

Klik blok senarai. Tekan Esc untuk membatalkan. Letakkan penomboran halaman di luar blok sasaran.

Untuk Smarty, masukkan pemboleh ubah senarai penuh. Tanpa pemboleh ubah, elemen HTML dalam bekas akan dibahagikan mengikut halaman; anda boleh menentukan kelas baris atau tag tr. Pautan mengekalkan count, sort dan penapis. Berbilang senarai berasingan disokong.

Pemilih bilangan item setiap halaman: 10, 25, 50, 100, 250

Seret pemilih bilangan item setiap halaman ke dalam penomboran halaman atau ke blok halaman lain. Pemilih itu kekal dipautkan kepada penomboran halaman ini.

Pilih blok senarai Smarty. Carian dan penomboran halaman mesti merujuk kepada blok yang sama.

Tetapkan pemboleh ubah senarai penuh. Carian memadankan mana-mana medan yang dipilih; penapis digunakan bersama. Syarat digunakan sebelum pengiraan halaman; penggunaan atau penetapan semula akan kembali ke halaman pertama. Jika penomboran halaman sudah dipautkan, pemboleh ubah daripadanya akan digunakan.

## Pautan dan sumber senarai

Letakkan penomboran halaman di luar blok senarai dan pilih blok itu sebagai sasaran. Untuk senarai Smarty, nyatakan pemboleh ubah yang mengandungi semua item; jika tidak, elemen HTML bekas akan dibahagikan. Pilih format pautan mengikut tetapan modul, `/page/2/` atau `?page=2`. Format laluan memerlukan peraturan rewrite. Senarai bebas menggunakan parameter berasingan; pautan mengekalkan bahasa, penapis dan susunan.

## Saiz halaman, SEO dan penapis

Tetapkan bilangan item dan jika perlu hidupkan pilihan 10/25/50/100/250. Menukar saiz mengembalikan senarai ke halaman pertama. Noindex hanya terpakai mulai halaman kedua; semak tajuk dan URL kanonik. Sambungkan penapis ke senarai yang sama, kemudian uji halaman kedua dan hasil bertapis pada laman awam.

## page / count / pager

Untuk senarai Smarty, nyatakan pemboleh ubah yang mengandungi semua item dan kekalkan gelung `{foreach}`: modul membahagikan senarai, jadi jangan tambah `array_slice` kedua. Tanpa pemboleh ubah, unsur HTML dalam bekas dibahagikan; kelas baris atau tag `tr` boleh dipilih, manakala `thead` dan `tfoot` kekal. Tetapkan bilangan butang sekitar halaman semasa secara berasingan untuk desktop dan telefon. Pada laluan PHP langsung gunakan `?page=2`; `/page/2/` memerlukan peraturan rewrite. Halaman seterusnya mempunyai canonical sendiri dan boleh diberi `noindex`.

Jika terdapat beberapa senarai bebas, senarai pertama menggunakan `page`, `count` dan `sort`; yang lain menggunakan parameter dengan ID blok. Pada laluan `/page/N/`, `pager` menunjukkan senarai yang memiliki nombor tersebut. Dalam blok Smarty, `$zm_pagination` menyediakan `total`, `page`, `pages`, `count` dan `offset`. Nilai `count` dihadkan kepada 10–250. Jika senarai kosong atau hanya satu halaman, panel penomboran halaman disembunyikan.

## YYYY-MM-DD

Penapis berfungsi pada senarai yang sama dengan penomboran halaman. Carian teks boleh menyemak beberapa medan yang dipisahkan dengan koma; julat tarikh menggunakan `YYYY-MM-DD` dan merangkumi seluruh hari terakhir.

## Flex / Grid

Pilih Flex atau Grid lalu tetapkan lebar dan lajur mengikut peranti. Menggunakan atau mengosongkan penapis mengembalikan senarai ke halaman pertama. Pemilih bilangan hasil boleh dialihkan tanpa kehilangan sambungan; panel pendua mengawal senarai yang sama.

## Arahan

- Jangan indeks halaman 2 dan seterusnya
- Format pautan
- Bilangan item lalai bagi setiap halaman
