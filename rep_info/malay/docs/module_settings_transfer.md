# Pemindahan data

Satu fail ZIP untuk semua bahagian atau bahagian terpilih, sehingga 128 MiB (ambil kira had muat naik PHP). Halaman yang sepadan dikemas kini berdasarkan slug dan jenis akses, manakala menu berdasarkan nama. Rekod lain kekal tidak berubah. Sertakan halaman apabila mengimport menu ke laman web baharu. Bahagian terpilih yang tiada dalam fail akan dilangkau. Fail JSON juga disokong untuk import.

CSS/JS disertakan bersama halaman, manakala imej dan fail lain yang dimuat naik disertakan bersama pustaka media. Sejarah semakan, pemboleh ubah Smarty yang dikumpulkan dan maklumat sulit WHMCS tidak dieksport. Jana semula peta laman selepas import; gunakan peraturan tulis semula melalui Pengurus Tulis Semula.

Halaman dan siaran (terjemahan, kandungan, SEO, tetapan peta laman, blok CSS/JS)

Rekod yang sepadan dalam bahagian terpilih akan dikemas kini daripada fail. Teruskan?

## ZIP

Eksport boleh merangkumi halaman dan siaran dengan terjemahan, kandungan, SEO dan CSS/JS; menu dengan hierarki dan lokasi; tetapan, pengalihan, peraturan tersuai serta pustaka media bersama failnya. Sejarah semakan, pemboleh ubah Smarty yang dikumpulkan, akaun dan rahsia WHMCS serta fail tema dikecualikan. Fail ZIP terhad kepada 128 MiB; had PHP `upload_max_filesize` dan `post_max_size` juga terpakai. Apabila memindahkan menu ke tapak lain, import halaman sekali dan selesaikan nama menu yang bertindih terlebih dahulu.

Fail eksport menggunakan format `zmchel_whmcs_multimodule` (versi 2). Semasa import, URL laman asal disesuaikan dengan `SystemURL` laman sasaran, manakala pautan luar dikekalkan. Import tidak mencipta jadual: sediakannya dahulu melalui Pangkalan Data Modul. Pengesahan diminta sebelum bermula; rekod diubah dalam transaksi dan fail yang diganti dipulihkan jika berlaku ralat.
