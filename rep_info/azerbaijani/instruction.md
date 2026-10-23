# zmchel WHMCS Multimodule təlimatı

**İstifadədən əvvəl unikal salt dəyərlərini `module_init.php` faylına yazın: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` və `ZM_PB_NONCE_SALT`.** Modul **WHMCS 8.13.1–8.13.7** üzərində hazırlanıb və sınaqdan keçirilib. **PHP 7.4–8.5** uyğunluğu yoxlanılıb. Apache tam (100%) dəstəklənir; Nginx-də ana səhifənin dil marşrutları əlavə sazlama tələb edə bilər.

**İlk istifadədən əvvəl Modul parametrləri → Dəstəklənən dillər bölməsini açın və sizə lazım olan dilləri aktiv edin.**

**zmchel WHMCS Multimodule pulsuzdur.** WHMCS idarəetmə panelindən vizual redaktorla çoxdilli səhifələri, menyuları, media kitabxanasını, SEO metadatasını, XML sayt xəritələrini, yönləndirmələri, rewrite qaydalarını, idxal və ixracı idarə edin.

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
