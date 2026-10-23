# Smarty

- **Pengaturan modul → Kumpulkan variabel Smarty → Gunakan variabel Smarty yang dikumpulkan → Editor halaman.**

## Katalog variabel

Aktifkan pengumpulan dan penggunaan variabel Smarty dalam pengaturan modul, lalu buka halaman situs yang terkait dan muat ulang editor. Katalog menyimpan nama, jenis, dan struktur variabel, bukan nilai sebenarnya atau data pribadi. Jika suatu variabel belum muncul, kunjungi lagi halaman yang menggunakannya.

## Editor dan batasan

Buka blok Smarty di editor halaman dan pilih variabel dari katalog. Gunakan kondisi dan perulangan yang diizinkan; tambahkan `|escape` saat menampilkan teks dinamis. PHP, SQL, pemanggilan metode, penyertaan berkas, dan `nofilter` tidak diizinkan. Simpan halaman dan periksa hasil publik.

## resources/available_vars/

Katalog hanya panduan bagi variabel yang pernah terlihat pada suatu halaman: katalog tidak membuatnya tersedia di halaman lain. Kode divalidasi saat disimpan dan sebelum ditampilkan; blok menerima salinan terisolasi dari nilai yang diizinkan. Kondisi, `foreach`, `assign` lokal dan modifier seperti `escape`, `default`, `count`, `date_format` diperbolehkan. Nilai keluaran di-escape secara otomatis; tulis HTML yang memang diinginkan dalam templat. Jika data tidak ada atau kode gagal, blok tetap kosong dan galat dicatat pada log PHP.

Katalog di `resources/available_vars/` menyimpan nama, tipe, struktur, dan contoh buatan, bukan nilai sebenarnya. Katalog menunjukkan tempat variabel terlihat, tetapi tidak membuatnya tersedia di halaman lain. Buka editor dengan klik dua kali pada blok Smarty. `Ctrl+Space` mencari variabel, `Ctrl+S` menerapkan kode, dan `F11` menampilkan layar penuh. Kode dijalankan terpisah; jika data tidak ada, blok tetap kosong dan peringatan masuk ke log PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Petunjuk

- **Kumpulkan variabel Smarty** — Aktifkan atau nonaktifkan pengumpulan variabel Smarty.
- **Gunakan variabel Smarty yang dikumpulkan** — Aktifkan atau nonaktifkan penggunaan variabel Smarty yang dikumpulkan di editor halaman.
- Variabel Smarty (PHP)
- Smarty: PHP, metode objek, pemanggilan statis, dan nofilter tidak diizinkan.
- Templat Smarty terlalu besar.
- Smarty
- Editor Smarty

