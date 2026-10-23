# Sayt xəritələri

Yenilənmə vaxtı çatdıqda avtomatik yaratma WHMCS cron tapşırığından sonra başlayır. Əl ilə yaratma dərhal başlayır.

Qonaqlar üçün əlçatan olan aktiv səhifələr və yazılar, o cümlədən onların dərc edilmiş dil versiyaları daxil edilir. Əvəzləmələr əvəz etdikləri səhifələrin ümumi URL-lərindən istifadə edir.

Aktiv olduqda /html-sitemap sayt xəritəsini adi HTML səhifəsi kimi göstərir; sitemap.xml faylına təsir etmir.

## XML

XML aktiv dillər üçün qarşılıqlı alternativ keçidlər və standart dil ünvanı üçün `x-default` əlavə edir. Yönləndirmə mənbələri `loc` və dil alternativlərinə daxil edilmir; ehtiyat tərcümə məzmunun həqiqi dili ilə işarələnir. Səhifə və yazı faylları XHTML ad məkanını elan edir.

`AfterCronJob` hook-u `ZM_PB_SITEMAP_UPDFREQ` müddətini son uğurlu `ZM_PB_SITEMAP_LASTUPD` vaxtı ilə müqayisə edir; sitemap söndürüləndə əl ilə yaratma da əlçatan olmur. Dil versiyaları yalnız `lang_active` ilə götürülür, `lang_status` ilə yox. Əlavə hissələrə `_2`, `_3` və sonrakı şəkilçilər verilir. Yaratma uğursuz olsa, əvvəlki fayllar bərpa edilir və uğur vaxtı dəyişmir. Sayt kökü ilə yanaşı `resources/` və `inc/editable_consts.php` yazma hüquqlarını yoxlayın; cədvəllər modul verilənlər bazasında ayrıca təmir olunur.

Avtomatik yaradılma WHMCS cron və modulda seçilmiş müddətdən asılıdır; yaratma düyməsi prosesi dərhal başladır. Xəritəyə yalnız qonaqlara açıq, dərc edilmiş səhifə və yazılar, həmçinin onların aktiv tərcümələri daxil olur. Sistem səhifəsini əvəz edən səhifə öz slug-u əvəzinə sistem səhifəsinin açıq URL-indən istifadə edir. 50 000 URL və ya 50 MB həddini aşan fayllar hissələrə bölünür. İndeks digər etibarlı sayt xəritələrini saxlayır.

Modul saytın kökündə `sitemap_index.xml`, `sitemap_pages.xml` və `sitemap_posts.xml` fayllarını yazır; boş kateqoriya üçün fayl yaradılmır. Ümumi `sitemap.xml` yaradılmır. Səhifə və ya dil dəyişikliklərindən sonra xəritələri yenidən yaradın və indeksi brauzerdə açın. Xəta olarsa, sayt kökünə yazma icazəsini yoxlayın; uğursuz əməliyyat son uğurlu yaradılma vaxtını dəyişmir.

## Təlimatlar

- Sayt xəritələrini yarat
- Saytın kök qovluğundakı fayllar
- Son uğurlu yaradılma
- Növbəti yenilənmə ən tez
- Heç nə seçilmədikdə sayt xəritəsi hər gün yenilənir.
- **Yenilənmə tezliyi** — Boş olduqda standart dəyər 'monthly' olur.
- **Yenilənmə prioriteti** — Boş olduqda standart dəyər '0.5' olur.
