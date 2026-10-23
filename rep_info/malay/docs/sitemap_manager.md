# Peta laman

Penjanaan automatik berjalan selepas cron WHMCS apabila kemas kini diperlukan. Penjanaan manual bermula serta-merta.

Halaman dan siaran aktif yang boleh diakses oleh tetamu, termasuk versi bahasa yang diterbitkan, akan disertakan. Penggantian menggunakan URL awam halaman yang digantikannya.

Jika tiada pilihan dibuat, peta laman dikemas kini setiap hari.

Apabila diaktifkan, /html-sitemap memaparkan peta laman sebagai halaman HTML biasa; sitemap.xml tidak terjejas.

## XML

XML mengandungi pautan timbal balik bagi bahasa aktif dan `x-default` untuk alamat bahasa lalai. Sumber pengalihan tidak dimasukkan dalam `loc` atau pilihan bahasa; terjemahan sandaran ditandai dengan bahasa sebenar kandungan. Fail halaman dan siaran mengisytiharkan ruang nama XHTML.

Hook `AfterCronJob` membandingkan sela `ZM_PB_SITEMAP_UPDFREQ` dengan masa penjanaan berjaya terakhir `ZM_PB_SITEMAP_LASTUPD`; jika peta laman dimatikan, penjanaan manual juga tidak tersedia. Versi bahasa dipilih melalui `lang_active`, bukan `lang_status`. Bahagian tambahan mendapat akhiran `_2`, `_3` dan seterusnya. Jika penjanaan gagal, fail terdahulu dipulihkan dan masa kejayaan tidak berubah. Semak izin menulis pada akar tapak, `resources/` dan `inc/editable_consts.php`; jadual dibaiki berasingan dalam pangkalan data modul.

Penjanaan automatik bergantung pada cron WHMCS dan sela masa yang ditetapkan; butang penjanaan memulakannya segera. Hanya halaman dan siaran yang diterbitkan serta boleh dilihat tetamu, bersama terjemahan aktifnya, dimasukkan. Jika halaman menggantikan halaman sistem, URL awam halaman sistem digunakan dan bukannya slug halaman pengganti. Fail yang melebihi 50,000 URL atau 50 MB dipecahkan. Indeks mengekalkan peta laman lain yang sah.

Modul menulis `sitemap_index.xml`, `sitemap_pages.xml` dan `sitemap_posts.xml` pada akar laman; kategori kosong tidak menghasilkan fail. Ia tidak membuat `sitemap.xml` gabungan. Selepas halaman atau bahasa berubah, jana semula peta laman dan buka indeks dalam pelayar. Jika berlaku ralat, semak kebenaran menulis pada akar laman; masa penjanaan berjaya yang terakhir tidak berubah.

## Arahan

- Jana peta laman
- Fail dalam akar laman web
- Penjanaan terakhir yang berjaya
- Kemas kini seterusnya tidak lebih awal daripada
- **Kekerapan kemas kini** — Jika kosong, nilai lalai ialah 'monthly'.
- **Keutamaan kemas kini** — Jika kosong, nilai lalai ialah '0.5'.
