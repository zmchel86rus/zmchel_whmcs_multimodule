# Ma’lumot ko‘chirish

Barcha yoki tanlangan boʻlimlar uchun bitta ZIP fayl; hajmi 128 MiB gacha (PHP yuklash cheklovlarini hisobga oling). Mos sahifalar slug va kirish turi, menyular esa nomi boʻyicha yangilanadi. Boshqa yozuvlar oʻzgarishsiz qoladi. Yangi saytga menyularni import qilayotganda sahifalarni ham qoʻshing. Faylda mavjud boʻlmagan tanlangan boʻlimlar oʻtkazib yuboriladi. Import paytida JSON fayllari ham qoʻllab-quvvatlanadi.

CSS/JS sahifalar bilan, rasmlar va boshqa yuklangan fayllar esa media kutubxonasi bilan birga eksport qilinadi. Tahrirlar tarixi, yigʻilgan Smarty oʻzgaruvchilari va WHMCS maxfiy maʼlumotlari eksport qilinmaydi. Importdan keyin sayt xaritasini qayta yarating; qayta yozish qoidalarini Qayta yozish qoidalari menejerida qoʻllang.

Sahifalar va maqolalar (tarjimalar, kontent, SEO, sayt xaritasi sozlamalari, CSS/JS bloklari)

Tanlangan boʻlimlardagi mos yozuvlar fayl maʼlumotlari bilan yangilanadi. Davom etilsinmi?

## ZIP

Eksportga tarjimalari, mazmuni, SEO va CSS/JS kodi bilan sahifa va yozuvlar; tuzilmasi va joylari bilan menyular; sozlamalar, qayta yo‘naltirishlar, maxsus qoidalar va fayllari bilan media kutubxonasi kirishi mumkin. Tahrirlar tarixi, yig‘ilgan Smarty o‘zgaruvchilari, WHMCS hisoblari va sirlar hamda mavzu fayllari kiritilmaydi. ZIP fayli 128 MiB bilan cheklanadi; PHP `upload_max_filesize` va `post_max_size` cheklovlari ham amal qiladi. Menyuni boshqa saytga ko‘chirganda sahifalarni ham import qiling va bir xil menyu nomlarini oldindan hal qiling.

Eksport fayli `zmchel_whmcs_multimodule` formatidan (2-versiya) foydalanadi. Import paytida manba sayt URL manzillari maqsad saytning `SystemURL` qiymatiga moslashtiriladi, tashqi havolalar saqlanadi. Import jadval yaratmaydi: ularni avval Modul ma'lumotlar bazasida tayyorlang. Boshlashdan oldin tasdiq so‘raladi; yozuvlar tranzaksiya ichida o‘zgaradi, xato bo‘lsa almashtirilgan fayllar tiklanadi.
