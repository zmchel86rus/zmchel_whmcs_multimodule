# Menyular

Menyu yarating, sahifalar yoki maxsus havolalar qoʻshing va elementlarni sudrab tartiblang. Ichki menyu uchun ota elementni tanlang; til bo‘yicha yorliqlarni, mehmon yoki mijozlarga ko‘rinishini va qurilmalarni sozlang. Joylashuvni belgilang: har bir joyda faqat bitta menyu bo‘ladi. Ichki havolalar URL manzili joriy tilga moslashishini tanlang. Ochiq menyuni kompyuter va telefonda tekshiring.

Har bir bandga sarlavha, tavsif, CSS sinflari, `rel`, belgi va yangi varaqda ochish sozlamasini berish mumkin; chop etilgan sahifalarni avtomatik qo‘shish ham mumkin. Kompyuter va telefon uchun menyu WHMCS navigatsiyasini to‘ldirishi yoki almashtirishini alohida tanlang. Modul sahifasiga havola joriy slug, til va URL rejimi asosida qayta hisoblanadi; bo‘sh yorliq tarjima qilingan sarlavha yoki sahifa nomini oladi. Sahifani ochish mijoz profilining tilini o‘zgartirmaydi. Server xavfli URL sxemalari va yorliqlardagi HTML kodini rad etadi.

## WHMCS

Modul sozlamalarida kerakli WHMCS menyu joylarini yoqing. Har bir joyga bitta menyu biriktiriladi, ammo bitta menyudan bir nechta joyda foydalanish mumkin. Kompyuter ko‘rinishi 768 px va undan keng ekranlarda, mobil ko‘rinish tor ekranlarda ishlaydi. O‘chirilgan joy WHMCS standart menyusini o‘zgartirmaydi.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Modul til yo‘nalishi bo‘lmagan WHMCS tizim yo‘llarida menyu yorliqlari mijozning saqlangan tilidan, modul sahifalari esa URL tilidan foydalanadi. Standart tilga alohida yo‘l berilsa, unga ham prefiks qo‘shiladi. Oddiy URL `?m=zmchel_whmcs_multimodule&slug=...&lang=...` ko‘rinishida. `clientarea.php` kabi maxsus havolani lokallashtirmasdan qoldirish mumkin. Ota-band yashirilsa, butun tarmoq yashiriladi.

Sahifa bandining URL manzili joriy slug va e'lon qilingan tarjima asosida qayta tuziladi. Tarjima bo‘lmasa, standart tildagi e'lon qilingan versiya ishlatiladi. Maxsus havola kiritilgan URL manzilini o‘zgartirmay saqlashi mumkin; tashqi manzillar, mailto, tel va yakor havolalariga til prefiksi qo‘shilmaydi. Qoralama, o‘chirilgan va kirish cheklangan sahifalar ko‘rsatilmaydi.

## zm_pb_menus

Ma'lumotlar `zm_pb_menus`, `zm_pb_menu_items` va `zm_pb_menu_locations` jadvallarida saqlanadi. Jadvallarni Modul ma'lumotlar bazasi bo‘limida yarating yoki tuzating. Daraxt ko‘pi bilan 10 daraja va 300 bandni qo‘llaydi; ota band o‘chirilsa, uning bolalari bir daraja yuqoriga ko‘tariladi.

## Yoʻriqnoma

- Menyu yaratish
- Sahifalar, maqolalar yoki maxsus havolalar qoʻshing.
- Elementlar tartibini oʻzgartirish uchun ularni sudrang. Ichma-ich joylashuvni ota-element tanlagichi yoki koʻchirish tugmalari bilan belgilang.
- Joriy sahifa tilidan foydalanish
- Kiritilgan URL manzilini oʻzgartirmasdan ishlatish
- Boshqa tillardagi yorliqlar
- Kimlarga koʻrinadi
- Qurilmalar
- Har bir joylashuvga bitta menyu biriktirish mumkin. Joylashuvni tanlash uni boshqa menyudan shu menyuga koʻchiradi.
- Yuqori darajadagi elementlar ustunlarga, ichki elementlar esa havolalarga aylanadi. Havolasiz sarlavha uchun URL sifatida # kiriting.
- Menyu jadvallari hali yaratilmagan. Ularni Modul maʼlumotlar bazasi boʻlimida qoʻshing.
