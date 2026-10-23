# Qayta yozish qoidalari

## WHMCS

Til URL manzillari, jumladan /ru/, /en/ va boshqa prefiksli sahifalar uchun qoidalar. Tillar supported_langs.php faylidan olinadi; qoidalar .htaccess fayliga WHMCS qoidalaridan oldin qoʻshiladi.

Nginx .htaccess faylini oʻqimaydi, shuning uchun bu qoidalar unda ishlamaydi. nginx da mos qoidalarni sozlang.

nginx → Apache konfiguratsiyasi aniqlandi. Bu qoidalar faqat Apache ga uzatilgan soʻrovlarda ishlaydi; nginx .htaccess faylini oʻqimaydi.

Qoida qoʻshilgan yoki oʻchirilgandan soʻng, oʻzgarishlarni .htaccess fayliga qoʻllash uchun «Qoidalarni qoʻshish yoki yangilash» tugmasini bosing.

## .htaccess

Menejerni ochib, qoidalarni saytning asosiy `.htaccess` fayli bilan solishtiring. O‘z qoidangiz uchun URL shabloni, maqsad va bayroqlarni saqlang; keyin blokni WHMCS qoidalaridan oldin yozish uchun **Qoidalarni qo‘shish yoki yangilash** tugmasini bosing. Holatni yana tekshirib, e'lon qilingan sahifani standart va boshqa tilda oching. Juda keng shablon boshqa sahifalarga ta'sir qilishi mumkin. Nginx → Apache tizimida qoidalar faqat Apache-ga uzatilgan so‘rovlarga ishlaydi.

## Yoʻriqnoma

- Qoidalarni tekshirish
- Qoidalarni qoʻshish yoki yangilash
- .htaccess faylidan barcha qoidalarni oʻchirish
- URL namunasi
- Maqsad
- Bayroqlar
