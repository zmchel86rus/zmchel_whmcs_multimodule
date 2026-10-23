# Smarty

- **Modul parametrləri → Smarty dəyişənlərini topla → Toplanmış Smarty dəyişənlərindən istifadə et → Səhifə redaktoru.**

## Dəyişənlər kataloqu

Modul parametrlərində Smarty dəyişənlərinin toplanmasını və istifadəsini aktivləşdirin, sonra müvafiq sayt səhifələrini açıb redaktoru yeniləyin. Kataloq dəyişənlərin adlarını, tiplərini və quruluşunu saxlayır, real dəyərləri və şəxsi məlumatları yox. Dəyişən görünmürsə, onun istifadə olunduğu səhifəyə yenidən daxil olun.

## Redaktor və məhdudiyyətlər

Səhifə redaktorunda Smarty blokunu açın və kataloqdan dəyişən seçin. İcazə verilən şərt və dövrlərdən istifadə edin; dinamik mətni göstərərkən `|escape` əlavə edin. PHP, SQL, metod çağırışları, fayl daxil etmə və `nofilter` qadağandır. Səhifəni saxlayıb açıq nəticəni yoxlayın.

## resources/available_vars/

Kataloq yalnız səhifədə müşahidə edilmiş dəyişənlərə bələdçidir: onları başqa səhifədə əlçatan etmir. Kod saxlananda və göstərilməzdən əvvəl yoxlanır; blok icazə verilən dəyərlərin təcrid edilmiş surətini alır. Şərtlər, `foreach`, yerli `assign` və `escape`, `default`, `count`, `date_format` kimi modifikatorlar işləyir. Çıxış dəyərləri avtomatik escaped olunur; nəzərdə tutulan HTML-i şablonda yazın. Məlumat çatışmırsa və ya kod xətalıdırsa, blok boş qalır, xəta PHP jurnalına yazılır.

`resources/available_vars/` kataloqu adları, tipləri, quruluşu və süni nümunələri saxlayır, real dəyərləri yox. O, dəyişənin harada görüldüyünü göstərir, lakin onu başqa səhifədə əlçatan etmir. Smarty blokuna iki dəfə klikləyərək redaktoru açın. `Ctrl+Space` dəyişən axtarır, `Ctrl+S` kodu tətbiq edir, `F11` tam ekranı açır. Kod təcrid olunmuş mühitdə işləyir; məlumat çatışmırsa blok boş qalır və xəbərdarlıq PHP jurnalına yazılır.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Təlimatlar

- **Smarty dəyişənlərini topla** — Smarty dəyişənlərinin toplanmasını aktivləşdirin və ya deaktiv edin.
- **Toplanmış Smarty dəyişənlərindən istifadə et** — Səhifə redaktorunda toplanmış Smarty dəyişənlərindən istifadəni aktivləşdirin və ya deaktiv edin.
- Smarty (PHP) dəyişəni
- Smarty: PHP, obyekt metodları, statik çağırışlar və nofilter qadağandır.
- Smarty şablonu çox böyükdür.
- Smarty
- Smarty redaktoru

