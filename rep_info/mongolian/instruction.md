[![Ажиглагчид](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%90%D0%B6%D0%B8%D0%B3%D0%BB%D0%B0%D0%B3%D1%87%D0%B8%D0%B4)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Одод](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%9E%D0%B4%D0%BE%D0%B4)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Форкууд](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%A4%D0%BE%D1%80%D0%BA%D1%83%D1%83%D0%B4)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Асуудлууд](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%D0%90%D1%81%D1%83%D1%83%D0%B4%D0%BB%D1%83%D1%83%D0%B4)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule ашиглах заавар

**zmchel WHMCS Multimodule нь үнэгүй модуль.** WHMCS-ийн удирдлагаас хуудас болон блокийг визуал аргаар засах, олон хэлний агуулга, цэс, медиа сан, SEO өгөгдөл, XML sitemap, чиглүүлэлт, rewrite дүрэм, өгөгдөл импортлох ба экспортлох боломж олгоно.

## Анх ашиглахын өмнө

**Модулийн тохиргоо → Дэмжигдэх хэл хэсгийг нээгээд хэрэгтэй хэлнүүдээ идэвхжүүлнэ үү.** Хэлийг идэвхгүй болгоход өмнө нь үүсгэсэн агуулга устахгүй.

Модулийг идэвхжүүлэх бүрд module_init.php файл дахь ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT, ZM_PB_NONCE_SALT давсуудыг шинээр үүсгэнэ. Гурван утга бүгд бичигдсэнийг шалгаарай.

## Шалгасан нийцтэй байдал ба ажиллагаа

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3 ба 4

## Вэб серверийн нийцтэй байдал

Apache бүрэн дэмжигдэнэ. Nginx дээр ч ажиллаж болно, гэхдээ нүүр хуудасны хэлний маршрут нэмэлт тохиргоо, шалгалт шаардаж магадгүй.

## Модулийн тохиргоо

Ашиглах хэл, URL хэлбэр, хэлний маршрутыг сонгоно. Apache ашиглаж байгаа бол Rewrite менежерээс дүрмээ шалгаж хэрэгжүүл; Nginx .htaccess файлыг уншихгүй тул сервер дээр нь ижил чиглүүлэлтийг тохируул. Дараа нь үндсэн болон өөр нэг идэвхтэй хэл дээр нийтлэгдсэн хуудсыг нээж шалга.

## Хуудасны менежер

Дотоод нэр болон зөвхөн латин үсэг, тоо, зураас агуулсан slug оруулж хуудас үүсгэнэ. Хэл, нийтлэх төлөв, зочин эсвэл нэвтэрсэн хэрэглэгчийн хандалтыг сонгоод хадгал. Хуудасны редакторт агуулга, SEO өгөгдөл нэмсний дараа нийтэлж, нийтэд харагдах хаягаар нь шалга. Sitemap-ийг гараар эсвэл WHMCS-ийн товлосон даалгавраар шинэчил.

## Хэсгүүдийн заавар

- [Хуудасны менежер](docs/pages_manager.md)
- [Хуудасны редактор](docs/pages_editor.md)
- [Медиа менежер](docs/media_manager.md)
- [Цэс](docs/menu_manager.md)
- [Хэлний менежер](docs/langs_manager.md)
- [Чиглүүлэлт](docs/redirects_manager.md)
- [Sitemap](docs/sitemap_manager.md)
- [Rewrite менежер](docs/rewrite_manager.md)
- [Модулийн тохиргоо](docs/module_settings.md)
- [Модулийн өгөгдлийн сан](docs/module_db.md)

## Нэмэлт баримтжуулалт

- [Хуудаслалт ба шүүлтүүр](docs/pages_editor_pagination.md)
- [Smarty ба хувьсагчийн жагсаалт](docs/pages_editor_smarty.md)
- [Schema.org бүтэцтэй өгөгдөл](docs/module_structured_data.md)
- [Импорт ба экспорт](docs/module_settings_transfer.md)
