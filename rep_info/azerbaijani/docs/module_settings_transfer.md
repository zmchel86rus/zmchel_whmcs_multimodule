# Məlumat ötürülməsi

Bütün və ya seçilmiş bölmələr üçün 32 MiB-dək bir JSON faylı istifadə olunur (PHP yükləmə məhdudiyyətləri də qüvvədədir). Uyğun səhifələr slug və giriş növünə, menyular isə adına görə yenilənir. Digər qeydlər dəyişməz qalır. Yeni sayta menyuları idxal edərkən səhifələri də daxil edin. Faylda olmayan seçilmiş bölmələr buraxılır.

CSS/JS səhifələrlə, şəkillər və digər yüklənmiş fayllar isə media kitabxanası ilə birlikdə ixrac olunur. Dəyişiklik tarixçəsi, toplanmış Smarty dəyişənləri və WHMCS məxfi məlumatları ixrac edilmir. İdxaldan sonra sayt xəritəsini yenidən yaradın; URL yenidənyazma qaydalarını Yenidənyazma qaydaları menecerində tətbiq edin.

Səhifələr və yazılar (tərcümələr, məzmun, SEO, sayt xəritəsi parametrləri, CSS/JS blokları)

Seçilmiş bölmələrdəki uyğun qeydlər fayldakı məlumatlarla yenilənəcək. Davam edilsin?

## JSON

İxraca səhifə və yazıların tərcümələri, məzmunu, SEO və CSS/JS; menyuların iyerarxiyası və yerləri; parametrlər, yönləndirmələr, fərdi qaydalar və faylları ilə media kitabxanası daxil edilə bilər. Redaktə tarixçəsi, toplanmış Smarty dəyişənləri, WHMCS hesabları və məxfi məlumatları, mövzu faylları daxil edilmir. JSON faylının həddi 32 MiB-dir; PHP `upload_max_filesize` və `post_max_size` hədləri də qüvvədədir. Menyuları başqa sayta köçürəndə səhifələri də idxal edin; eyni adlı menyuları əvvəlcədən həll edin.

İxrac faylı `zmchel_whmcs_multimodule` formatından (versiya 1) istifadə edir. İdxal zamanı mənbə saytın URL-ləri hədəf saytın `SystemURL` dəyərinə uyğunlaşdırılır, xarici keçidlər isə saxlanılır. İdxal cədvəl yaratmır: onları əvvəlcə Modul verilənlər bazası bölməsində hazırlayın. Əməliyyatdan əvvəl təsdiq göstərilir; qeydlər tranzaksiya daxilində dəyişir və xəta olduqda əvəzlənmiş fayllar bərpa edilir.

## Təlimatlar

- Menyular və yerləşmə sahələri
- Modul parametrləri, əvəzləmələr, head/footer, robots.txt
- Yönləndirmələr
- Xüsusi URL yenidənyazma qaydaları
- Media kitabxanası (fayllar və təsvirlər)
