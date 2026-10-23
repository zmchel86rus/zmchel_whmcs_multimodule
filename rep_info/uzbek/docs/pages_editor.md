# Sahifa muharriri

- [sahifalash](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [tuzilgan ma’lumot](module_structured_data.md)

## Vizual muharrir va tillar

Kontent bo‘limida tilni tanlab, GrapesJS bloklarini ish maydoniga suring. Matn, rasm va blok sozlamalarini tahrirlang. Bo‘limlar, ustunlar, jadvallar, FAQ, aloqa shakli, ro‘yxatlar, sahifalash hamda mehmon yoki a’zolar uchun alohida kontent bloklari mavjud. Tuzilmani boshqa tilga ko‘chirishingiz mumkin; chop etishdan oldin matnni tarjima qiling. Havola va tugma bloklari joriy tilni ichki URL’ga qo‘sha oladi. Tashqi havola, fayl, `mailto:` va tarjimasi bo‘lmagan WHMCS yo‘llari uchun bu sozlamani o‘chiring.

Chiroyli URL va til marshrutlari yoqilganda asosiy til `/uz/` kabi qisqa yo‘ldan foydalanadi; standart til yo‘li o‘chirilgan bo‘lsa prefikssiz ishlaydi. Mintaqaviy variantlar BCP 47 locale’dan foydalanadi.

## WHMCS

Asosiy sozlamalarda nom, slug, tur, holat, kirish va tillarni tekshiring. WHMCS standart tili modulda yoqilgan bo‘lishi kerak; e'lon qilingan sahifada ko‘rsatiladigan tildagi kontent bo‘lishi zarur.

## SEO

Har bir tilga sarlavha va tavsif yozing, so‘ng canonical, robots, Open Graph, navigatsiya yo‘li va Schema ni tekshiring. Sayt xaritasi bo‘limida ochiq, tizimga kirmaydigan sahifa uchun chastota va ustuvorlikni belgilang. Saqlab, ochiq URL va XML-ni tekshiring.

## Aloqa formasi

**Aloqa formasi** blokini qo‘shing. **WHMCS murojaati** va yordam bo‘limi yoki **email** va qabul qiluvchini tanlang; sarlavha, tavsif, mavzu va tugma matnini to‘ldiring. Har bir maydonga nom, tur, majburiylik va tekshiruv belgilang. Mehmon murojaati jo‘natuvchi ismi va email roli berilgan maydonlarni talab qiladi. Ochiladigan ro‘yxatda har qatorga bitta variant yozing, masalan `sales : Savdo`. Har bir rozilikka alohida maydon yarating va WHMCS dagi CAPTCHA dan foydalaning. Saqlab, mehmon sifatida haqiqiy sinov yuboring; murojaat yoki xat yetib borishini, xatolarni va formaning tozalanishini tekshiring. Muharrirning yashil holati yetkazishni tasdiqlamaydi; `mail()` ishlamasa WHMCS SMTP ni sozlang.

## Yoʻriqnoma

- Ichma-ich flex joylashuv konteyneri. Boshqa bloklarni ichiga sudrab joylashtiring.
- Ichma-ich CSS Grid konteyneri. Boshqa bloklarni ichiga sudrab joylashtiring.
- Ichma-ich Bootstrap karuseli. Bloklarni ichiga sudrang; har biri alohida slaydga aylanadi.
- Ushbu blokdan pastdagi barcha bloklar faqat tizimga kirgan foydalanuvchilarga koʻrsatiladi. Faqat sahifaga kirish turi Aralash boʻlganda ishlaydi.
- Ushbu blokdan pastdagi barcha bloklar faqat mehmonlarga koʻrsatiladi. Faqat sahifaga kirish turi Aralash boʻlganda ishlaydi.
- **Sahifa sarlavhasi**
- **Meta tavsif**
- **Kanonik URL**
- **Robots** — index, follow / noindex, nofollow. Indekslashni boshqaradi.
- **Schema turi** — Oʻchirilganda, bu sahifa uchun Schema.org JSON belgilari chiqarilmaydi.
