[![İzləyənlər](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%C4%B0zl%C9%99y%C9%99nl%C9%99r)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Ulduzlar](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Ulduzlar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Forklar](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Forklar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Məsələlər](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=M%C9%99s%C9%99l%C9%99l%C9%99r)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule təlimatı

**zmchel WHMCS Multimodule pulsuzdur.** WHMCS idarəetmə panelindən vizual redaktorla çoxdilli səhifələri, menyuları, media kitabxanasını, SEO metadatasını, XML sayt xəritələrini, yönləndirmələri, rewrite qaydalarını, idxal və ixracı idarə edin.

## İlk istifadədən əvvəl

**İlk istifadədən əvvəl Modul parametrləri → Dəstəklənən dillər bölməsini açın və sizə lazım olan dilləri aktiv edin.**

Hər aktivləşdirmədə modul yeni salt dəyərləri yaradır və onları `module_init.php` faylına yazır (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Hər üç salt dəyərinin doldurulduğunu yoxlayın.

## Sınaqdan keçirilmiş uyğunluq və funksionallıq

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Veb serverlərlə uyğunluq

Apache tam (100%) dəstəklənir; Nginx-də ana səhifənin dil marşrutları əlavə sazlama tələb edə bilər.

## Modul parametrləri

Modulun istifadə edə biləcəyi dilləri seçin. Dili deaktiv etmək onun məzmununu silmir.

- **Modul parametrləri → Dəstəklənən dillər → Aktivləşdir**
- **Modulun verilənlər bazası → Düzəlt Seçilmiş elementlər**
- **URL yenidənyazma qaydaları → Qaydaları yoxla → Qaydaları əlavə et və ya yenilə**

Nginx .htaccess faylını oxumur, buna görə bu qaydalar orada işləmir. Uyğun qaydaları nginx-də qurun.

## Səhifə meneceri

- **Səhifə əlavə et → Səhifənin adı → Səhifənin slug-u → Saxla**
- **Səhifə redaktoru → Məzmun parametrləri → Metaməlumat parametrləri → Səhifənin sayt xəritəsi parametrləri → Hamısını saxla**
- **Səhifə meneceri → Ziyarət et**
- **Sayt xəritəsi → Sayt xəritələrini yarat**

Yalnız latın hərflərinə, defislərə və rəqəmlərə icazə verilir.

Daxil olmuş istifadəçilər: səhifəyə yalnız hesaba daxil olanlar baxa bilər; Qonaqlar: yalnız qonaqlar baxa bilər; Qarışıq: hamı baxa bilər, görünmə isə səhifənin daxilindəki bloklarla idarə olunur.

Yenilənmə vaxtı çatdıqda avtomatik yaratma WHMCS cron tapşırığından sonra başlayır. Əl ilə yaratma dərhal başlayır.

## Bölmələr üzrə təlimatlar

- [Səhifə meneceri](docs/pages_manager.md)
- [Səhifə redaktoru](docs/pages_editor.md)
- [Media meneceri](docs/media_manager.md)
- [menyular](docs/menu_manager.md)
- [Dil meneceri](docs/langs_manager.md)
- [yönləndirmələr](docs/redirects_manager.md)
- [sayt xəritələri](docs/sitemap_manager.md)
- [URL yenidənyazma qaydaları](docs/rewrite_manager.md)
- [Modul parametrləri](docs/module_settings.md)
- [Modulun verilənlər bazası](docs/module_db.md)

## Əlavə materiallar

- [səhifələmə](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [strukturlaşdırılmış məlumat](docs/module_structured_data.md)
- [məlumat ötürülməsi](docs/module_settings_transfer.md)
