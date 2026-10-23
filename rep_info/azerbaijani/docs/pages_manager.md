# Səhifə meneceri

## Səhifələrin yaradılması

WHMCS idarəetmə panelində **Addons → zmchel WHMCS Multimodule** bölməsini açın. URL, yönləndirmə və ya server qaydalarını dəyişməzdən əvvəl modul parametrlərini ixrac edin. Səhifələr siyahısında daxili ad və domen, yaxud `.php` olmayan `haqqimizda` kimi *slug* daxil edin. Hər kəs, yalnız daxil olmuş istifadəçilər və ya qarışıq giriş seçin; sonra qaralama və ya dərc olunmuş statusu, səhifə növünü və dilləri seçin. WHMCS-in standart dili `supported_langs.php` daxilində olmalıdır.

Yadda saxladıqdan sonra hər dil üçün məzmunu, metadatanı və sayt xəritəsi parametrlərini doldurun. Bölmələrin ayrıca Yadda saxla düyməsi var. Nəticə bildirişini və açıq səhifəni yoxlayın. İlk silmə səhifəni səbətə göndərir; birdəfəlik silmə səbətdən edilir.

## URL

Siyahını ad, giriş növü, səhifə növü, status və ya dilə görə süzün. **Ziyarət et** açıq URL-ni açır. **Sil** əvvəlcə səhifəni zibil qutusuna köçürür; birdəfəlik silmə orada edilir. Səhifə açılmırsa, dərc vəziyyətini, aktiv dili və giriş növünü yoxlayın.

## WHMCS

WHMCS səhifəsini əvəz etmək üçün mövcud sistem ünvanını və modulun dərc olunmuş səhifəsini seçin. Tam əvəzləmə, məzmunun əvvəlinə və ya sonuna əlavə etmə, yaxud yalnız meta/SEO seçin. Yadda saxlayın və orijinal WHMCS URL-ni qonaq və daxil olmuş müştəri kimi yoxlayın.

## Təlimatlar

- Səhifə əlavə et
- **Səhifənin adı** — Səhifənin daxili adı
- **Səhifənin slug-u** — Yalnız latın hərflərinə, defislərə və rəqəmlərə icazə verilir.
- **Giriş növü** — Daxil olmuş istifadəçilər: səhifəyə yalnız hesaba daxil olanlar baxa bilər; Qonaqlar: yalnız qonaqlar baxa bilər; Qarışıq: hamı baxa bilər, görünmə isə səhifənin daxilindəki bloklarla idarə olunur.
- **Səhifənin növü** — Sistem səhifələri sayt xəritəsinə daxil edilmir və adi istifadəçilər üçün əlçatan deyil.
- **Səhifənin dilləri** — Seçiminizdən asılı olmayaraq standart dil həmişə daxil edilir.
- Tam əvəzləmə göstərilən məzmunu və metaməlumatları əvəz edir. Əvvələ əlavə et mövcud səhifə məzmunundan əvvəl məzmun yerləşdirir. Sona əlavə et mövcud səhifə məzmunundan sonra məzmun yerləşdirir. Yalnız metaməlumat/SEO səhifənin metaməlumatlarını əvəz edir.
- Səhifə siyahısı üzrə naviqasiya
