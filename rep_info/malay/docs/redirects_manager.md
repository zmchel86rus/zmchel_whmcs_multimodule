# Pengalihan

Alamat tepat: sumber → destinasi. Sumber ialah laluan dari akar laman web atau URL pada laman web ini. Destinasi ialah laluan atau URL HTTP(S) penuh. Peraturan tanpa parameter pertanyaan juga sepadan dengan permintaan yang mempunyai parameter tersebut; destinasi digunakan seperti yang dimasukkan. Peraturan terpakai pada permintaan GET/HEAD yang sampai ke WHMCS.

Lalai: 14 hari. Dikira daripada perubahan terakhir pada halaman yang diterbitkan atau terjemahan aktifnya; jika tidak pernah diubah, dikira daripada tarikh penciptaan. Tetapkan 0 untuk tiada kelewatan. Peraturan automatik menggunakan HTTP 301.

Alamat halaman pengganti dialihkan secara automatik ke halaman sistem yang digantikannya. Jika sesuatu penggantian mempunyai beberapa destinasi, destinasi pertama yang dikonfigurasikan akan digunakan. Pengalihan ini berfungsi selagi penggantian halaman diaktifkan, tanpa bergantung pada peraturan Pengurus Pengalihan.

Masukkan laluan sah yang bermula dengan / atau URL HTTP(S) penuh. Sumber mestilah milik laman web ini; fragmen # tidak disokong.

## HTTP

Peraturan menyokong kod HTTP `301`, `302`, `303`, `307`, `308` dan hanya terpakai pada permintaan `GET`/`HEAD` yang sampai ke WHMCS. Sumber dipadankan tepat pada laluan dan, jika dinyatakan, parameter pertanyaan; parameter destinasi menggantikan yang lama. Pengurus menyimpan peraturan dalam `zm_pb_redirects`, tetapi tidak mencipta jadual semasa permintaan: gunakan **Pangkalan data modul**. Lajur URL sedia ada terhad kepada 128 bait.

Peraturan manual diutamakan daripada peraturan automatik. Perubahan slug halaman yang diterbitkan boleh membuat lencongan `301` automatik bagi setiap bahasa aktif selepas tempoh menunggu yang ditetapkan; penerbitan draf tidak membuatnya. Penamaan semula seterusnya mengemas kini sasaran lama. Peraturan dengan parameter pertanyaan diutamakan daripada peraturan laluan sahaja. URL sumber mesti milik laman ini dan tidak boleh mempunyai serpihan `#`.

## Arahan

- Sumber
- Destinasi
- Aktif
- Tidak aktif
