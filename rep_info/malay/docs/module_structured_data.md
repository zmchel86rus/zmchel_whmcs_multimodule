# Data berstruktur

- **Penyunting Halaman → Tetapan metadata → Jenis skema → Simpan.**

## Data yang ditandakan modul

Menu dan isi kandungan boleh menghasilkan `SiteNavigationElement`, soalan dan jawapan yang kelihatan `FAQPage`, dan laluan navigasi yang mempunyai beberapa item `BreadcrumbList`. Blok susun atur, butang dan penapis tidak diberi jenis kandungan secara automatik. Jenis Schema yang dipilih untuk halaman mengawal JSON-LD-nya; apabila dimatikan, penandaan itu tidak dipaparkan.

## Semakan selepas penerbitan

Pada halaman awam, semak JSON-LD, URL kanonik, bahasa dan kandungan yang benar-benar kelihatan. Penandaan yang sah tidak menjamin hasil carian diperkaya.

## Schema.org

`SiteNavigationElement` menggunakan pautan dan tajuk menu yang benar-benar kelihatan; senarai kandungan boleh menambah `WebPageElement` untuk tajuk yang memang wujud. `FAQPage` hanya mengambil soalan dan jawapan lengkap yang dilihat pelawat: blok tersembunyi dan akordion biasa dikecualikan. `BreadcrumbList` dibuat hanya jika terdapat sekurang-kurangnya dua item. Data organisasi datang daripada WHMCS; bahasa hubungan dinyatakan dalam `ContactPoint.availableLanguage` mengikut BCP 47. Modul tidak meneka jenis Schema untuk penapis, penomboran halaman, borang atau HTML tersuai.
