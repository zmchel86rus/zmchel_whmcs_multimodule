# Sayt xaritasi

Yangilash vaqti kelganda avtomatik yaratish WHMCS cron ishidan keyin bajariladi. Qoʻlda yaratish darhol boshlanadi.

Mehmonlarga ochiq faol sahifalar va maqolalar, shu jumladan ularning nashr qilingan til versiyalari ham kiritiladi. Almashtirilgan sahifalar oʻrnini bosgan sahifalarning ommaviy URL manzillaridan foydalanadi.

Yoqilganda /html-sitemap sayt xaritasini oddiy HTML sahifa sifatida koʻrsatadi; sitemap.xml fayliga taʼsir qilmaydi.

## XML

XML faol tillar uchun o‘zaro havolalar va standart til manzili uchun `x-default` ni qo‘shadi. Qayta yo‘naltirish manbalari `loc` yoki til muqobillariga kirmaydi; zaxira tarjima mazmunning haqiqiy tili bilan belgilanadi. Sahifa va yozuv fayllari XHTML nomlar makonini e’lon qiladi.

`AfterCronJob` hook-i `ZM_PB_SITEMAP_UPDFREQ` oralig‘ini oxirgi muvaffaqiyatli yaratish vaqti `ZM_PB_SITEMAP_LASTUPD` bilan solishtiradi; sayt xaritasi o‘chirilsa, qo‘lda yaratish ham ishlamaydi. Til variantlari `lang_status` emas, `lang_active` bo‘yicha tanlanadi. Qo‘shimcha qismlar `_2`, `_3` va keyingi qo‘shimchalarni oladi. Xato bo‘lsa, avvalgi fayllar tiklanadi, muvaffaqiyat vaqti o‘zgarmaydi. Sayt ildizi, `resources/` va `inc/editable_consts.php` uchun yozish huquqini tekshiring; jadvallarni modul ma’lumotlar bazasida alohida tuzating.

Avtomatik yaratish WHMCS cron vazifasi va belgilangan oraliqqa bog‘liq; tugma uni darhol boshlaydi. Faqat mehmonlarga ochiq chop etilgan sahifa va yozuvlar faol tarjimalari bilan qo‘shiladi. Sahifa tizim sahifasini almashtirsa, almashtiruvchi slug emas, tizim sahifasining ommaviy URL manzili ishlatiladi. 50 000 URL yoki 50 MB dan oshgan fayllar qismlarga bo‘linadi. Indeks boshqa yaroqli sayt xaritalarini saqlaydi.

Modul sayt ildiziga `sitemap_index.xml`, `sitemap_pages.xml` va `sitemap_posts.xml` fayllarini yozadi; bo‘sh toifa uchun fayl yaratilmaydi. Umumiy `sitemap.xml` yaratilmaydi. Sahifalar yoki tillar o‘zgargach, xaritalarni qayta yarating va indeksni brauzerda oching. Xato bo‘lsa, sayt ildiziga yozish huquqini tekshiring; oxirgi muvaffaqiyatli yaratish vaqti o‘zgarmaydi.

## Yoʻriqnoma

- Sayt xaritalarini yaratish
- Sayt ildizidagi fayllar
- Oxirgi muvaffaqiyatli yaratish
- Keyingi yangilanish bundan oldin emas
- Hech narsa tanlanmasa, sayt xaritasi har kuni yangilanadi.
- **Yangilanish davriyligi** — Boʻsh qoldirilsa, standart qiymat: 'monthly'.
- **Yangilash ustuvorligi** — Boʻsh qoldirilsa, standart qiymat: '0.5'.
