# WHMCS üçün pulsuz multimodul

**İstifadədən əvvəl unikal salt dəyərlərini `module_init.php` faylına yazın: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` və `ZM_PB_NONCE_SALT`.** Modul **WHMCS 8.13.1–8.13.7** üzərində hazırlanıb və sınaqdan keçirilib. **PHP 7.4–8.5** uyğunluğu yoxlanılıb. Apache tam (100%) dəstəklənir; Nginx-də ana səhifənin dil marşrutları əlavə sazlama tələb edə bilər.

**İlk istifadədən əvvəl Modul parametrləri → Dəstəklənən dillər bölməsini açın və sizə lazım olan dilləri aktiv edin.**

**zmchel WHMCS Multimodule pulsuzdur.** WHMCS idarəetmə panelindən vizual redaktorla çoxdilli səhifələri, menyuları, media kitabxanasını, SEO metadatasını, XML sayt xəritələrini, yönləndirmələri, rewrite qaydalarını, idxal və ixracı idarə edin. Ətraflı məlumat üçün [təlimatı](instruction.md) oxuyun.

## Gələcək inkişaf

- İç-içə səhifələr və səhifə kateqoriyaları əlavə etmək.
- Monolit kodu qarşılıqlı işləyən komponentlərə ayırmaq.
- Admin giriş hüquqları meneceri yaratmaq və `supported_langs.php` dillərini genişləndirmək.
- Modulun `.tpl` faylları və WHMCS müştəri mövzuları üçün kod redaktoru yaratmaq; admin mövzusu istisnadır.
- Modul və WHMCS dil faylları üçün dil menecerini inkişaf etdirmək, media menecerini yaxşılaşdırmaq.
- Yoast SEO-dan ilhamlanan, daha optimallaşdırılmış tam SEO meneceri qurmaq.
- Çoxdilli sayt xəritəsi və HTML sayt xəritəsi səhifəsi əlavə etmək.
- Səhifə menecerinə istifadə statistikası əlavə etmək.
- JS, CSS və HTML kiçiltməsi, tam səhifə keşlənməsi, modul və WHMCS cədvəllərinin optimallaşdırılması üçün menecer qurmaq.
- Modulun düzgün yeniləmə sistemini əlavə etmək.

Bunlar **sabit yol xəritəsi deyil, gələcək üçün fikirlərdir**.

## Fikir təklif edin və ya sual verin

[Təklif göndərin](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) və ya [sual verin](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E): `ackirkin@gmail.com`.
