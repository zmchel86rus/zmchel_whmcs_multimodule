# URL yenidənyazma qaydaları

## WHMCS

/ru/, /en/ və digər prefikslərdəki səhifələr də daxil olmaqla dil URL-ləri üçün qaydalar. Dillər supported_langs.php faylından götürülür; qaydalar .htaccess faylına WHMCS qaydalarından əvvəl əlavə edilir.

Nginx .htaccess faylını oxumur, buna görə bu qaydalar orada işləmir. Uyğun qaydaları nginx-də qurun.

nginx → Apache quruluşu aşkarlandı. Bu qaydalar yalnız Apache-yə ötürülən sorğular üçün işləyir; nginx .htaccess faylını oxumur.

Qayda əlavə etdikdən və ya sildikdən sonra dəyişiklikləri .htaccess faylına tətbiq etmək üçün “Qaydaları əlavə et və ya yenilə” düyməsini sıxın.

## .htaccess

Meneceri açın və qaydaları saytın əsas `.htaccess` faylı ilə müqayisə edin. Öz qaydanız üçün URL nümunəsini, hədəfi və bayraqları saxlayın; sonra **Qaydaları əlavə et və ya yenilə** vasitəsilə blok WHMCS qaydalarından əvvəl yazılır. Vəziyyəti yenidən yoxlayın və dərc olunmuş səhifəni əsas və başqa dildə açın. Həddən artıq geniş nümunə digər səhifələrə təsir edə bilər. Nginx → Apache quruluşunda qaydalar yalnız Apache-yə ötürülən sorğulara tətbiq edilir.

## Təlimatlar

- Qaydaları yoxla
- Qaydaları əlavə et və ya yenilə
- .htaccess faylından bütün qaydaları sil
- URL nümunəsi
- Hədəf
- Bayraqlar
