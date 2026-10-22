# zmchel WHMCS Multimodule təlimatı

**Moduldan istifadə etməzdən əvvəl unikal salt dəyərləri yaradıb `module_init.php` faylına yerləşdirin: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` və `ZM_PB_NONCE_SALT`.** Modul **WHMCS 8.13.1–8.13.7** üzərində hazırlanıb və sınaqdan keçirilib. **PHP 7.4–8.5** uyğunluğu yoxlanılıb. Apache tam dəstəklənir; Nginx-də ana səhifənin dil marşrutlaşdırılması əlavə sazlama tələb edə bilər. **Modul pulsuzdur.**

## Səhifələrin yaradılması

WHMCS idarəetmə panelində **Addons → zmchel WHMCS Multimodule** bölməsini açın. URL, yönləndirmə və ya server qaydalarını dəyişməzdən əvvəl modul parametrlərini ixrac edin. Səhifələr siyahısında daxili ad və domen, yaxud `.php` olmayan `haqqimizda` kimi *slug* daxil edin. Hər kəs, yalnız daxil olmuş istifadəçilər və ya qarışıq giriş seçin; sonra qaralama və ya dərc olunmuş statusu, səhifə növünü və dilləri seçin. WHMCS-in standart dili `supported_langs.php` daxilində olmalıdır.

Yadda saxladıqdan sonra hər dil üçün məzmunu, metadatanı və sayt xəritəsi parametrlərini doldurun. Bölmələrin ayrıca Yadda saxla düyməsi var. Nəticə bildirişini və açıq səhifəni yoxlayın. İlk silmə səhifəni səbətə göndərir; birdəfəlik silmə səbətdən edilir.

## Vizual redaktor və dillər

Məzmun bölməsində dili seçin, GrapesJS bloklarını iş sahəsinə sürüşdürün, mətnləri, şəkilləri və blok parametrlərini redaktə edin. Bölmə, sütun, cədvəl, FAQ, əlaqə forması, siyahı, səhifələmə və qonaq/üzv zonaları mövcuddur. Quruluşu başqa dilə köçürüb mətnləri tərcümə edə bilərsiniz. Keçid və düymə bloklarında cari səhifənin dilini daxili URL-yə əlavə etmək olar; xarici keçidlər, fayllar, `mailto:` və tərcüməsi olmayan WHMCS yolları üçün bunu söndürün.

Gözəl URL və dil marşrutları aktivdirsə, əsas dil `/az/` kimi qısa yoldan istifadə edir, standart dil üçün ayrıca yol söndürülübsə prefiks olmur. Regional variantlarda BCP 47 locale istifadə edilir. Keçidləri bir neçə dildə yoxlayın.

## SEO, media və texniki xidmət

Hər dil üçün başlıq, təsvir, robots, kanonik URL və sosial şəbəkə məlumatlarını daxil edin. Dərc edilmiş qeyri-sistem səhifəsi XML sayt xəritəsinə düşə bilər. Media Manager vasitəsilə şəkil yükləyin, alternativ mətn əlavə edin və optimallaşdırma nəticəsini yoxlayın. Menu Manager-də səhifələri və xüsusi keçidləri düzün, dil etiketlərini, yeri və görünməni seçin.

Redirect Manager-də daimi `301` və ya müvəqqəti `302` yönləndirmə yaradın. Rewrite Manager Apache üçün `.htaccess` qaydalarını yazır; Nginx üçün ekvivalent qaydalar serverdə qurulmalıdır. Böyük idxaldan əvvəl JSON ixrac edin. İngiliscə geniş təlimatlar: [menyular](../english/docs/menus.md), [səhifələmə](../english/docs/pagination.md), [yönləndirmələr](../english/docs/redirects.md), [sayt xəritələri](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [strukturlaşdırılmış məlumat](../english/docs/structured-data.md), [məlumat ötürülməsi](../english/docs/transfer.md).
