# Menu

Cipta menu, tambah halaman atau pautan tersuai, kemudian susun item dengan menyeretnya. Pilih item induk untuk submenu dan tetapkan label mengikut bahasa, keterlihatan kepada tetamu atau pelanggan serta peranti. Tetapkan lokasi; setiap lokasi hanya boleh mempunyai satu menu. Bagi pautan dalaman, pilih sama ada URL mengikut bahasa semasa. Semak menu awam pada komputer dan telefon.

Setiap item boleh mempunyai tajuk, huraian, kelas CSS, `rel`, ikon dan pilihan membuka tab baharu; halaman yang diterbitkan juga boleh ditambah secara automatik. Pilih secara berasingan untuk desktop dan telefon sama ada menu melengkapkan atau menggantikan navigasi WHMCS. Pautan ke halaman modul dikira semula menurut slug, bahasa dan mod URL semasa; label kosong menggunakan tajuk terjemahan atau nama halaman. Membuka halaman tidak mengubah bahasa profil pelanggan. Pelayan menolak skema URL yang tidak selamat dan HTML dalam label.

## WHMCS

Aktifkan lokasi menu WHMCS yang diperlukan dalam tetapan modul. Setiap lokasi menerima satu menu, namun menu yang sama boleh digunakan di beberapa lokasi. Paparan desktop bermula pada lebar 768 px, manakala paparan mudah alih digunakan pada skrin yang lebih sempit. Lokasi yang dimatikan tidak mengubah menu asal WHMCS.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Pada laluan sistem WHMCS tanpa penghalaan bahasa modul, label menu menggunakan bahasa pelanggan yang disimpan; halaman modul menggunakan bahasa URL. Jika bahasa lalai diberi laluan sendiri, bahasa itu juga mendapat awalan. URL biasa ialah `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Pautan tersuai boleh dibiarkan tanpa pelokalan, contohnya `clientarea.php`. Menyembunyikan item induk menyembunyikan seluruh cabangnya.

URL item halaman dikira semula daripada slug semasa dan terjemahan yang diterbitkan. Jika terjemahan tiada, versi bahasa lalai yang diterbitkan digunakan. Pautan tersuai boleh mengekalkan URL yang dimasukkan; alamat luar, mailto, tel dan sauh tidak menerima awalan bahasa. Draf, halaman yang dipadam dan halaman tanpa akses tidak dipaparkan.

## zm_pb_menus

Data disimpan dalam jadual `zm_pb_menus`, `zm_pb_menu_items` dan `zm_pb_menu_locations`. Cipta atau baiki jadual melalui Pangkalan Data Modul. Pepohon menyokong sehingga 10 aras dan 300 item; apabila induk dipadam, anaknya naik satu aras.

## Arahan

- Cipta menu
- Tambah halaman, siaran atau pautan tersuai.
- Seret item untuk mengubah susunan. Tetapkan hierarki menggunakan pemilih induk atau butang untuk mengalihkan item.
- Gunakan bahasa halaman semasa
- Gunakan URL yang dimasukkan tanpa perubahan
- Label dalam bahasa lain
- Boleh dilihat oleh
- Peranti
- Setiap lokasi boleh mempunyai satu menu sahaja. Memilih lokasi akan memindahkan penetapan lokasi daripada menu lain ke menu ini.
- Item peringkat teratas menjadi lajur dan item bersarang menjadi pautan. Gunakan URL # untuk tajuk tanpa pautan.
- Jadual menu belum dicipta. Tambahkannya melalui Pangkalan Data Modul.
