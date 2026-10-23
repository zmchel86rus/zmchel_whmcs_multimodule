# Səhifə redaktoru

- [səhifələmə](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [strukturlaşdırılmış məlumat](module_structured_data.md)

## Vizual redaktor və dillər

Məzmun bölməsində dili seçin, GrapesJS bloklarını iş sahəsinə sürüşdürün, mətnləri, şəkilləri və blok parametrlərini redaktə edin. Bölmə, sütun, cədvəl, FAQ, əlaqə forması, siyahı, səhifələmə və qonaq/üzv zonaları mövcuddur. Quruluşu başqa dilə köçürüb mətnləri tərcümə edə bilərsiniz. Keçid və düymə bloklarında cari səhifənin dilini daxili URL-yə əlavə etmək olar; xarici keçidlər, fayllar, `mailto:` və tərcüməsi olmayan WHMCS yolları üçün bunu söndürün.

Gözəl URL və dil marşrutları aktivdirsə, əsas dil `/az/` kimi qısa yoldan istifadə edir, standart dil üçün ayrıca yol söndürülübsə prefiks olmur. Regional variantlarda BCP 47 locale istifadə edilir. Keçidləri bir neçə dildə yoxlayın.

## WHMCS

Əsas parametrlərdə ad, slug, növ, status, giriş və dilləri yoxlayın. WHMCS-in əsas dili modulda aktiv olmalıdır; dərc olunmuş səhifənin göstərilən dildə məzmunu olmalıdır.

## SEO

Hər dil üçün başlıq və təsvir yazın, sonra canonical, robots, Open Graph, breadcrumb və Schema dəyərlərini yoxlayın. Sayt xəritəsi bölməsində açıq, sistem olmayan səhifə üçün tezlik və prioritet seçin. Yadda saxlayın, açıq URL-ni və XML-i yoxlayın.

## Əlaqə forması

**Əlaqə forması** blokunu əlavə edin. **WHMCS bileti** və dəstək şöbəsi, yaxud **email** və alıcı seçin; başlıq, təsvir, mövzu və düymə mətnini yazın. Hər sahəyə ad, növ, məcburilik və yoxlama verin. Qonaq bileti üçün göndərənin adı və email rolu olan sahələr lazımdır. Açılan siyahıya hər sətirdə bir variant yazın, məsələn `sales : Satış`. Hər razılıq üçün ayrıca sahə yaradın və WHMCS-də qurulmuş CAPTCHA-dan istifadə edin. Saxlayıb qonaq kimi real sınaq göndərin; bileti və ya email çatdırılmasını, xətaları və formanın təmizlənməsini yoxlayın. Redaktorun yaşıl göstəricisi çatdırılmanı təsdiqləmir; `mail()` işləmirsə, WHMCS-də SMTP qurun.

## Təlimatlar

- İç-içə flex düzülüş konteyneri. Digər blokları içinə sürükləyin.
- İç-içə CSS Grid konteyneri. Digər blokları içinə sürükləyin.
- İç-içə Bootstrap karuseli. Blokları içinə sürükləyin; hər biri ayrıca slayd olur.
- Bu blokdan aşağıdakı bütün bloklar yalnız hesaba daxil olmuş istifadəçilərə göstərilir. Yalnız səhifənin giriş növü Qarışıq olduqda işləyir.
- Bu blokdan aşağıdakı bütün bloklar yalnız qonaqlara göstərilir. Yalnız səhifənin giriş növü Qarışıq olduqda işləyir.
- **Səhifənin başlığı**
- **Meta təsvir**
- **Kanonik URL**
- **Robots** — index, follow / noindex, nofollow. İndeksləşdirməni idarə edir.
- **Schema növü** — Deaktiv olduqda bu səhifə üçün Schema.org JSON işarələnməsi çıxarılmır.
