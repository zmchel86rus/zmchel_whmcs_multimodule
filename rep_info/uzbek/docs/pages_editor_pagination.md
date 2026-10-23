# Sahifalash

Ro‘yxat blokini bosing. Esc — bekor qilish. Sahifalash bog‘langan blokdan tashqarida joylashishi kerak.

Smarty uchun to‘liq ro‘yxat o‘zgaruvchisini kiriting. O‘zgaruvchi ko‘rsatilmasa, konteynerdagi HTML elementlari sahifalarga bo‘linadi; zarur bo‘lsa, qator klassini yoki tr tegini ko‘rsating. Havolalarda count, sort va filtrlar saqlanadi. Bir nechta mustaqil ro‘yxat qo‘llab-quvvatlanadi.

Sahifadagi elementlar sonini tanlash maydonini sahifalash ichiga yoki sahifaning boshqa bloklariga sudrab o‘tkazing. U ushbu sahifalash bilan bog‘langan holda qoladi.

Smarty ro‘yxat blokini tanlang. Qidiruv va sahifalash bir xil blokka bog‘langan bo‘lishi kerak.

To‘liq ro‘yxat o‘zgaruvchisini ko‘rsating. Qidiruv tanlangan maydonlarning istalganiga mos keladi; filtrlar birgalikda qo‘llanadi. Shartlar sahifalar sonini hisoblashdan oldin qo‘llanadi; filtrlarni qo‘llash yoki qayta o‘rnatish birinchi sahifaga qaytaradi. Agar sahifalash allaqachon bog‘langan bo‘lsa, uning o‘zgaruvchisi ishlatiladi.

## Havolalar va roʻyxat manbai

Sahifalashni roʻyxat blokidan tashqariga joylashtirib, shu blokni nishon sifatida tanlang. Smarty roʻyxati uchun barcha elementlar saqlangan oʻzgaruvchini koʻrsating; aks holda konteynerning HTML elementlari boʻlinadi. Havola shaklini modul sozlamasiga ko‘ra, `/page/2/` yoki `?page=2` qilib tanlang. Yoʻl shakli rewrite qoidalarini talab qiladi. Mustaqil roʻyxatlar alohida parametrlardan foydalanadi; havolalar til, filtr va saralashni saqlaydi.

## Sahifa hajmi, SEO va filtrlar

Elementlar sonini belgilang va kerak boʻlsa 10/25/50/100/250 tanlovini yoqing. Hajm oʻzgarsa, roʻyxat birinchi sahifaga qaytadi. Noindex faqat ikkinchi sahifadan boshlab amal qiladi; sarlavha va kanonik URLni tekshiring. Filtrlarni shu roʻyxatga ulang, soʻng ochiq saytda ikkinchi sahifani va filtrlangan natijani sinang.

## page / count / pager

Smarty ro‘yxati uchun barcha elementli o‘zgaruvchini ko‘rsating va `{foreach}` siklini saqlang: ro‘yxatni modul bo‘ladi, ikkinchi `array_slice` qo‘shmang. O‘zgaruvchi bo‘lmasa, konteynerning HTML elementlari sahifalanadi; satr sinfi yoki `tr` tegini ko‘rsatish mumkin, `thead` va `tfoot` esa saqlanadi. Joriy sahifa yonidagi tugmalar sonini kompyuter va telefon uchun alohida belgilang. Bevosita PHP yo‘llarida `?page=2` ishlating; `/page/2/` rewrite qoidalarini talab qiladi. Keyingi sahifalarning o‘z canonical manzili bor va ularga `noindex` qo‘yish mumkin.

Bir nechta mustaqil ro‘yxat bo‘lsa, birinchisi `page`, `count` va `sort` parametrlaridan, qolganlari blok ID-si qo‘shilgan parametrlardan foydalanadi. `/page/N/` yo‘lida `pager` raqam qaysi ro‘yxatga tegishli ekanini bildiradi. Smarty blokida `$zm_pagination` `total`, `page`, `pages`, `count` va `offset` qiymatlarini beradi. `count` 10–250 oralig‘ida cheklanadi. Ro‘yxat bo‘sh yoki bir sahifali bo‘lsa, sahifalash paneli yashiriladi.

## YYYY-MM-DD

Filtrlar sahifalash bilan bir xil ro‘yxatda ishlaydi. Matnli qidiruv vergul bilan ajratilgan bir nechta maydonni tekshirishi mumkin; sana oralig‘i `YYYY-MM-DD` formatidan foydalanadi va oxirgi kunni to‘liq qamrab oladi.

## Flex / Grid

Flex yoki Grid ni tanlab, qurilmalar bo‘yicha kenglik va ustunlarni sozlang. Filtrni qo‘llash yoki tozalash ro‘yxatni birinchi sahifaga qaytaradi. Natijalar soni tanlagichini bog‘lanishni yo‘qotmasdan ko‘chirish mumkin; takror panel shu ro‘yxatni boshqaradi.

## Yoʻriqnoma

- Sahifadagi elementlar soni: 10, 25, 50, 100, 250
- 2-sahifadan boshlab indekslashni taqiqlash
- Havola formati
- Sahifadagi standart elementlar soni
