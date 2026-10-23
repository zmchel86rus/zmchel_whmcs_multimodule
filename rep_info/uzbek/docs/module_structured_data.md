# Tuzilgan ma’lumot

- **Sahifa muharriri → Metamaʼlumot sozlamalari → Schema turi → Saqlash.**

## Modul nimalarni belgilaydi

Menyular va mundarija `SiteNavigationElement`, ko‘rinadigan savol-javoblar `FAQPage`, bir necha qismli navigatsiya yo‘li esa `BreadcrumbList` yaratishi mumkin. Joylashuv bloklari, tugmalar va filtrlarga mazmun turi avtomatik berilmaydi. Sahifa uchun tanlangan Schema turi uning JSON-LD chiqishini boshqaradi; o‘chirilsa, bu belgilash chiqarilmaydi.

## Nashrdan keyin tekshirish

Ochiq sahifada JSON-LD, kanonik URL, til va haqiqatda ko‘rinadigan mazmunni tekshiring. To‘g‘ri belgilash qidiruvda boy natijani kafolatlamaydi.

## Schema.org

`SiteNavigationElement` faqat haqiqatan ko‘rinadigan menyu havolalari va nomlarini ishlatadi; mundarija sahifada mavjud sarlavhalar uchun `WebPageElement` qo‘shishi mumkin. `FAQPage` mehmon ko‘radigan to‘liq savol-javoblarni oladi: yashirin bloklar va oddiy akkordeonlar kiritilmaydi. `BreadcrumbList` kamida ikki band bo‘lgandagina yaratiladi. Tashkilot ma'lumotlari WHMCS-dan olinadi; aloqa tillari `ContactPoint.availableLanguage` da BCP 47 formatida ko‘rsatiladi. Filtr, sahifalash, forma va maxsus HTML uchun Schema turi taxmin qilinmaydi.

## Yoʻriqnoma

- **Schema turi** — Oʻchirilganda, bu sahifa uchun Schema.org JSON belgilari chiqarilmaydi.
- **Navigatsiya zanjiri** — Navigatsiya zanjiridagi sahifa nomi
- **Kanonik URL**
- **Sahifa sarlavhasi**
- **Meta tavsif**
- **Open Graph sarlavhasi** — Boʻsh qoldirilsa, sahifa sarlavhasi ishlatiladi.
- **Open Graph tavsifi** — Boʻsh qoldirilsa, meta tavsif ishlatiladi.
- **Open Graph rasmi** — Boʻsh qoldirilsa, sahifa rasmi ishlatiladi.
