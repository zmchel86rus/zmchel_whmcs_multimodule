# Pengalihan

Alamat persis: sumber → tujuan. Sumber adalah jalur dari direktori utama situs atau URL di situs ini. Tujuan adalah jalur atau URL HTTP(S) lengkap. Aturan tanpa parameter kueri juga cocok dengan permintaan yang memiliki parameter tersebut; tujuan digunakan sesuai yang dimasukkan. Aturan berlaku untuk permintaan GET/HEAD yang mencapai WHMCS.

Bawaan: 14 hari. Dihitung sejak perubahan terakhir pada halaman yang dipublikasikan atau terjemahan aktifnya; jika belum pernah diubah, dihitung sejak pembuatan. Tetapkan 0 agar tanpa penundaan. Aturan otomatis menggunakan HTTP 301.

Alamat halaman pengganti secara otomatis dialihkan ke halaman sistem yang digantikannya. Jika satu penggantian memiliki beberapa tujuan, tujuan pertama yang dikonfigurasi akan digunakan. Pengalihan ini berfungsi selama penggantian halaman diaktifkan, terlepas dari aturan Pengelola Pengalihan.

Masukkan jalur yang valid yang diawali / atau URL HTTP(S) lengkap. Sumber harus berasal dari situs ini; fragmen # tidak didukung.

## HTTP

Aturan mendukung kode HTTP `301`, `302`, `303`, `307`, `308` dan hanya berlaku untuk permintaan `GET`/`HEAD` yang mencapai WHMCS. Sumber dicocokkan persis dengan jalur dan, jika ditentukan, parameter kueri; parameter tujuan menggantikan parameter lama. Pengelola menyimpan aturan di `zm_pb_redirects`, tetapi tidak membuat tabel saat ada permintaan: gunakan **Basis data modul**. Kolom URL yang ada dibatasi 128 byte.

Aturan manual didahulukan dari aturan otomatis. Perubahan slug halaman yang diterbitkan dapat membuat pengalihan `301` otomatis untuk setiap bahasa aktif setelah jeda yang ditetapkan; menerbitkan draf tidak membuatnya. Perubahan nama berikutnya memperbarui tujuan aturan lama. Aturan dengan parameter kueri didahulukan dari aturan yang hanya mencocokkan jalur. URL sumber harus milik situs ini dan tidak boleh memiliki fragmen `#`.

## Petunjuk

- Sumber
- Tujuan
- Aktif
- Nonaktif
