# zmchel WHMCS Multimodule qo‘llanmasi

**Moduldan foydalanishdan oldin noyob salt qiymatlarini yarating va `module_init.php` fayliga kiriting: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` va `ZM_PB_NONCE_SALT`.** Modul **WHMCS 8.13.1–8.13.7** versiyalarida ishlab chiqilgan va sinovdan o‘tkazilgan. **PHP 7.4–8.5** bilan mosligi tekshirilgan. Apache to‘liq qo‘llab-quvvatlanadi; Nginx’da bosh sahifadagi til marshrutlari uchun qo‘shimcha sozlama talab qilinishi mumkin. **Modul bepul.**

**Birinchi foydalanishdan oldin Modul sozlamalari → Qo‘llab-quvvatlanadigan tillar bo‘limini ochib, kerakli tillarni yoqing.**

## Tillar menejeri (ishlab chiqilmoqda)

WHMCS boshqaruv panelida Tillar menejerini ochib, bo‘limni (WHMCS mijoz yoki admin tillari, shu modul yoxud boshqa modul) va tilni tanlang. Asl nusxa yoki namuna matnni tarjima bilan solishtiring, bitta qatorni tahrir qilib saqlang; mavjud kalitlarni JSON sifatida eksport va import qilish ham mumkin. Yangi tillar tarjima qilinmaguncha namuna matndan foydalanadi. Menejer til fayllarini yoqib-o‘chiradi va eski nomlarni tuzatadi; standart tilni avval WHMCS-da o‘zgartiring.

## Sahifa yaratish

WHMCS boshqaruv panelida **Addons → zmchel WHMCS Multimodule** bo‘limini oching. URL, yo‘naltirish yoki server qoidalarini o‘zgartirishdan oldin modul sozlamalarini eksport qiling. Sahifalar ro‘yxatida yangi sahifa yarating: ichki nom va domen yoki `.php` qo‘shilmagan `biz-haqimizda` kabi *slug* kiriting. Hammaga, faqat tizimga kirganlarga yoki aralash kirish turini, so‘ng qoralama yoki chop etilgan holatni, sahifa turini va tillarni tanlang. WHMCS’ning standart tili `supported_langs.php` da bo‘lishi kerak.

Saqlagach, sahifaning har bir til uchun kontent, metama’lumot va sayt xaritasi bo‘limlarini to‘ldiring. Har bo‘limning alohida Saqlash tugmasi bor. Natija xabarini va ommaviy sahifani tekshiring. Dastlabki o‘chirish sahifani savatga ko‘chiradi; butunlay o‘chirish savatdan bajariladi.

## Vizual muharrir va tillar

Kontent bo‘limida tilni tanlab, GrapesJS bloklarini ish maydoniga suring. Matn, rasm va blok sozlamalarini tahrirlang. Bo‘limlar, ustunlar, jadvallar, FAQ, aloqa shakli, ro‘yxatlar, sahifalash hamda mehmon yoki a’zolar uchun alohida kontent bloklari mavjud. Tuzilmani boshqa tilga ko‘chirishingiz mumkin; chop etishdan oldin matnni tarjima qiling. Havola va tugma bloklari joriy tilni ichki URL’ga qo‘sha oladi. Tashqi havola, fayl, `mailto:` va tarjimasi bo‘lmagan WHMCS yo‘llari uchun bu sozlamani o‘chiring.

Chiroyli URL va til marshrutlari yoqilganda asosiy til `/uz/` kabi qisqa yo‘ldan foydalanadi; standart til yo‘li o‘chirilgan bo‘lsa prefikssiz ishlaydi. Mintaqaviy variantlar BCP 47 locale’dan foydalanadi.

## SEO va xizmat ko‘rsatish

Har bir til uchun sarlavha, tavsif, robots, kanonik URL va ijtimoiy tarmoq ma’lumotlarini to‘ldiring. Chop etilgan, tizimga oid bo‘lmagan sahifani XML sayt xaritasiga qo‘shish mumkin. Media Manager’da rasmlarni yuklang, muqobil matn yozing va optimallashtirish natijasini tekshiring. Menu Manager’da sahifalar va maxsus havolalarni joylashtiring, tilga mos yozuvlar va ko‘rinish sozlamalarini belgilang.

Redirect Manager’da doimiy `301` yoki vaqtinchalik `302` yo‘naltirish yarating. Rewrite Manager Apache uchun `.htaccess` qoidalarini yozadi; Nginx uchun mos qoidalarni serverda sozlang. Katta importdan oldin JSON eksport qiling va keyin natijani tekshiring. Batafsil inglizcha hujjatlar: [menyular](../english/docs/menus.md), [sahifalash](../english/docs/pagination.md), [yo‘naltirish](../english/docs/redirects.md), [sayt xaritasi](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [tuzilgan ma’lumot](../english/docs/structured-data.md), [ma’lumot ko‘chirish](../english/docs/transfer.md).
