[![Kuzatuvchilar](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Kuzatuvchilar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Yulduzlar](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Yulduzlar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Forklar](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Forklar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Muammolar](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Muammolar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule qo‘llanmasi

**zmchel WHMCS Multimodule bepul.** WHMCS boshqaruv panelidan ko‘p tilli sahifalar, vizual muharrir, menyular, media kutubxonasi, SEO metama’lumotlari, XML sayt xaritasi, yo‘naltirishlar, rewrite qoidalari hamda import va eksportni boshqaring.

## Birinchi foydalanishdan oldin

**Birinchi foydalanishdan oldin Modul sozlamalari → Qo‘llab-quvvatlanadigan tillar bo‘limini ochib, kerakli tillarni yoqing.**

Har bir faollashtirishda modul yangi salt qiymatlarini avtomatik yaratadi va ularni `module_init.php` fayliga yozadi (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Uchala salt qiymati ham toʻldirilganini tekshiring.

## Sinovdan o‘tgan moslik va ishlash

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Veb-serverlar bilan moslik

Apache to‘liq (100%) qo‘llab-quvvatlanadi; Nginx’da bosh sahifaning til marshruti qo‘shimcha sozlashni talab qilishi mumkin.

## Modul sozlamalari

Modul foydalanishi mumkin boʻlgan tillarni tanlang. Tilni oʻchirish uning kontentini oʻchirmaydi.

- **Modul sozlamalari → Qoʻllab-quvvatlanadigan tillar → Yoqish**
- **Modul maʼlumotlar bazasi → Tuzatish Tanlangan elementlar**
- **Qayta yozish qoidalari → Qoidalarni tekshirish → Qoidalarni qoʻshish yoki yangilash**

Nginx .htaccess faylini oʻqimaydi, shuning uchun bu qoidalar unda ishlamaydi. nginx da mos qoidalarni sozlang.

## Sahifalar menejeri

- **Sahifa qoʻshish → Sahifa nomi → Sahifa slugi → Saqlash**
- **Sahifa muharriri → Kontent sozlamalari → Metamaʼlumot sozlamalari → Sahifa sayt xaritasi sozlamalari → Hammasini saqlash**
- **Sahifalar menejeri → Koʻrish**
- **Sayt xaritasi → Sayt xaritalarini yaratish**

Faqat lotin harflari, defislar va raqamlarga ruxsat etiladi.

Tizimga kirgan foydalanuvchilar: sahifaga faqat tizimga kirganlar kira oladi; Mehmonlar: faqat mehmonlar kira oladi; Aralash: sahifaga hamma kira oladi, koʻrinish esa sahifa ichidagi bloklar orqali boshqariladi.

Yangilash vaqti kelganda avtomatik yaratish WHMCS cron ishidan keyin bajariladi. Qoʻlda yaratish darhol boshlanadi.

## Boʻlimlar boʻyicha qoʻllanmalar

- [Sahifalar menejeri](docs/pages_manager.md)
- [Sahifa muharriri](docs/pages_editor.md)
- [Media menejeri](docs/media_manager.md)
- [menyular](docs/menu_manager.md)
- [Tillar menejeri](docs/langs_manager.md)
- [yo‘naltirish](docs/redirects_manager.md)
- [sayt xaritasi](docs/sitemap_manager.md)
- [Qayta yozish qoidalari](docs/rewrite_manager.md)
- [Modul sozlamalari](docs/module_settings.md)
- [Modul maʼlumotlar bazasi](docs/module_db.md)

## Qoʻshimcha materiallar

- [sahifalash](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [tuzilgan ma’lumot](docs/module_structured_data.md)
- [ma’lumot ko‘chirish](docs/module_settings_transfer.md)
