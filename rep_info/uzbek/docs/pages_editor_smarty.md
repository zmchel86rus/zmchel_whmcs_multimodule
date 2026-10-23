# Smarty

- **Modul sozlamalari → Smarty oʻzgaruvchilarini yigʻish → Yigʻilgan Smarty oʻzgaruvchilaridan foydalanish → Sahifa muharriri.**

## Oʻzgaruvchilar katalogi

Modul sozlamalarida Smarty o‘zgaruvchilarini yig‘ish va ishlatishni yoqing, keyin tegishli sayt sahifalarini ochib, tahrirlagichni yangilang. Katalog o‘zgaruvchilarning nomi, turi va tuzilishini saqlaydi, lekin haqiqiy qiymatlar yoki shaxsiy ma’lumotlarni saqlamaydi. O‘zgaruvchi ko‘rinmasa, ishlatiladigan sahifaga qayta kiring.

## Tahrirlagich va cheklovlar

Sahifa tahrirlagichida Smarty blokini ochib, katalogdan o‘zgaruvchilarni tanlang. Ruxsat etilgan shart va sikllardan foydalaning; dinamik matn chiqarganda `|escape` qo‘shing. PHP, SQL, metod chaqiruvlari, fayl qo‘shish va `nofilter` taqiqlangan. Sahifani saqlab, ochiq natijani tekshiring.

## resources/available_vars/

Katalog faqat sahifada ko‘rilgan o‘zgaruvchilar haqida yo‘riq beradi: ularni boshqa sahifada mavjud qilmaydi. Kod saqlashda va chiqarishdan oldin tekshiriladi; blok ruxsat etilgan qiymatlarning ajratilgan nusxasini oladi. Shartlar, `foreach`, mahalliy `assign` hamda `escape`, `default`, `count`, `date_format` kabi modifikatorlarga ruxsat bor. Chiqish qiymatlari avtomatik escape qilinadi; kerakli HTML-ni shablonda yozing. Ma’lumot yo‘q yoki kod xato bo‘lsa, blok bo‘sh qoladi, xato PHP jurnaliga yoziladi.

`resources/available_vars/` katalogida nomlar, turlar, tuzilma va sun'iy misollar saqlanadi, haqiqiy qiymatlar emas. U o‘zgaruvchi qayerda ko‘rilganini ko‘rsatadi, ammo uni boshqa sahifada mavjud qilib qo‘ymaydi. Smarty blokini ikki marta bosib muharrirni oching. `Ctrl+Space` o‘zgaruvchilarni qidiradi, `Ctrl+S` kodni qo‘llaydi, `F11` to‘liq ekranni ochadi. Kod alohida ishlaydi; ma'lumot bo‘lmasa blok bo‘sh qoladi va ogohlantirish PHP jurnaliga yoziladi.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Yoʻriqnoma

- **Smarty oʻzgaruvchilarini yigʻish** — Smarty oʻzgaruvchilarini yigʻishni yoqish yoki oʻchirish.
- **Yigʻilgan Smarty oʻzgaruvchilaridan foydalanish** — Sahifa muharririda yigʻilgan Smarty oʻzgaruvchilaridan foydalanishni yoqish yoki oʻchirish.
- Smarty (PHP) oʻzgaruvchisi
- Smarty: PHP, obyekt metodlari, statik chaqiruvlar va nofilter taqiqlangan.
- Smarty shabloni juda katta.
- Smarty
- Smarty muharriri

