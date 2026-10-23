# Smarty

- **Tetapan modul → Kumpul pemboleh ubah Smarty → Gunakan pemboleh ubah Smarty yang dikumpulkan → Penyunting Halaman.**

## Katalog pemboleh ubah

Aktifkan pengumpulan dan penggunaan pemboleh ubah Smarty dalam tetapan modul, kemudian buka halaman laman yang berkaitan dan muat semula editor. Katalog menyimpan nama, jenis dan struktur pemboleh ubah, bukan nilai sebenar atau data peribadi. Jika pemboleh ubah tiada, lawati semula halaman yang menggunakannya.

## Editor dan had

Buka blok Smarty dalam editor halaman dan pilih pemboleh ubah daripada katalog. Gunakan syarat dan gelung yang dibenarkan; tambah `|escape` apabila memaparkan teks dinamik. PHP, SQL, panggilan kaedah, penyertaan fail dan `nofilter` tidak dibenarkan. Simpan halaman dan semak paparan awam.

## resources/available_vars/

Katalog hanya panduan kepada pemboleh ubah yang dilihat pada halaman: ia tidak menjadikannya tersedia pada halaman lain. Kod disemak semasa disimpan dan sebelum dipaparkan; blok menerima salinan terasing nilai yang dibenarkan. Syarat, `foreach`, `assign` setempat dan pengubah seperti `escape`, `default`, `count`, `date_format` dibenarkan. Nilai keluaran di-escape secara automatik; tulis HTML yang dimaksudkan dalam templat. Jika data tiada atau kod gagal, blok kosong dan ralat dicatat dalam log PHP.

Katalog dalam `resources/available_vars/` menyimpan nama, jenis, struktur dan contoh buatan, bukan nilai sebenar. Ia menunjukkan tempat pemboleh ubah diperhatikan tetapi tidak menjadikannya tersedia pada halaman lain. Buka editor dengan klik dua kali pada blok Smarty. `Ctrl+Space` mencari pemboleh ubah, `Ctrl+S` menggunakan kod dan `F11` membuka skrin penuh. Kod berjalan secara terasing; jika data tiada, blok kekal kosong dan amaran dicatat dalam log PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Arahan

- **Kumpul pemboleh ubah Smarty** — Aktifkan atau nyahaktifkan pengumpulan pemboleh ubah Smarty.
- **Gunakan pemboleh ubah Smarty yang dikumpulkan** — Aktifkan atau nyahaktifkan penggunaan pemboleh ubah Smarty yang dikumpulkan dalam penyunting halaman.
- Pemboleh ubah Smarty (PHP)
- Smarty: PHP, kaedah objek, panggilan statik dan nofilter tidak dibenarkan.
- Templat Smarty terlalu besar.
- Smarty
- Editor Smarty

