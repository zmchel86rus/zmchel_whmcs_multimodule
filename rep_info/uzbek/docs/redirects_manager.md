# Yo‘naltirish

Aniq manzillar: manba → manzil. Manba — sayt ildizidan boshlanadigan yoʻl yoki shu saytdagi URL. Manzil — yoʻl yoki toʻliq HTTP(S) URL. Soʻrov parametrlarisiz qoida parametrli soʻrovlarga ham mos keladi; manzil kiritilganicha ishlatiladi. Qoidalar WHMCS ga yetib keladigan GET/HEAD soʻrovlariga qoʻllanadi.

Standart qiymat: 14 kun. Nashr qilingan sahifa yoki uning faol tarjimalari oxirgi marta oʻzgartirilgan kundan, oʻzgarish boʻlmagan boʻlsa, yaratilgan kundan hisoblanadi. Kechikish boʻlmasligi uchun 0 kiriting. Avtomatik qoidalar HTTP 301 dan foydalanadi.

Almashtiruvchi sahifa manzillari avtomatik ravishda oʻrnini bosgan tizim sahifalariga yoʻnaltiradi. Bir nechta manzil belgilangan boʻlsa, birinchisi ishlatiladi. Bu qayta yoʻnaltirishlar almashtirishlar yoqilganida, Qayta yoʻnaltirish menejeri qoidalaridan qatʼi nazar ishlaydi.

/ bilan boshlanuvchi toʻgʻri yoʻl yoki toʻliq HTTP(S) URL kiriting. Manba ushbu saytga tegishli boʻlishi kerak; # fragmentlari qoʻllab-quvvatlanmaydi.

## HTTP

Qoidalar HTTP `301`, `302`, `303`, `307`, `308` kodlarini qo‘llaydi va faqat WHMCS ga yetib kelgan `GET`/`HEAD` so‘rovlarida ishlaydi. Manba yo‘l va ko‘rsatilgan bo‘lsa so‘rov parametrlari bilan aniq mos keladi; manzil parametrlari eskilarini almashtiradi. Menejer qoidalarni `zm_pb_redirects` jadvalida saqlaydi, lekin so‘rov paytida jadval yaratmaydi: **Modul ma’lumotlar bazasi** bo‘limidan foydalaning. Mavjud URL ustunlari 128 bayt bilan cheklangan.

Qo‘lda yaratilgan qoidalar avtomatik qoidalardan ustun. E'lon qilingan sahifaning slug qiymati o‘zgarsa, belgilangan kutishdan keyin har bir faol til uchun avtomatik `301` yaratilishi mumkin; qoralamani e'lon qilish buni qilmaydi. Keyingi qayta nomlashlar eski manzillarni yangilaydi. So‘rov parametrlari bor qoida faqat yo‘lga tegishli qoidani ortda qoldiradi. Manba URL shu saytga tegishli bo‘lishi va `#` fragmentini o‘z ichiga olmasligi kerak.

## Yoʻriqnoma

- Manba
- Manzil
- Yoqilgan
- Oʻchirilgan
