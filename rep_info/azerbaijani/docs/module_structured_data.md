# Strukturlaşdırılmış məlumat

- **Səhifə redaktoru → Metaməlumat parametrləri → Schema növü → Saxla.**

## Modul hansı məlumatları işarələyir

Menyular və məzmun cədvəli `SiteNavigationElement`, görünən sual-cavablar `FAQPage`, bir neçə elementli naviqasiya yolu isə `BreadcrumbList` yarada bilər. Tərtibat blokları, düymələr və filtrlər avtomatik məzmun növü almır. Səhifə üçün seçilən Schema növü onun JSON-LD çıxışını idarə edir; söndürüldükdə bu işarələmə göstərilmir.

## Dərcdən sonra yoxlama

Açıq səhifədə JSON-LD, kanonik URL, dil və həqiqətən görünən məzmunu yoxlayın. Düzgün işarələmə axtarışda zəngin nəticəyə zəmanət vermir.

## Schema.org

`SiteNavigationElement` menyunun həqiqətən görünən keçid və başlıqlarından istifadə edir; məzmun siyahısı mövcud başlıqlar üçün `WebPageElement` də əlavə edə bilər. `FAQPage` yalnız ziyarətçinin gördüyü dolu sual-cavabları götürür: gizli bloklar və adi akkordeonlar daxil edilmir. `BreadcrumbList` ən azı iki bənd olduqda yaradılır. Təşkilat məlumatları WHMCS-dən gəlir; əlaqə dilləri `ContactPoint.availableLanguage` daxilində BCP 47 ilə göstərilir. Filtr, səhifələmə, forma və xüsusi HTML üçün Schema növü təxmin edilmir.

## Təlimatlar

- **Schema növü** — Deaktiv olduqda bu səhifə üçün Schema.org JSON işarələnməsi çıxarılmır.
- **Naviqasiya zənciri** — Naviqasiya zəncirində səhifənin adı
- **Kanonik URL**
- **Səhifənin başlığı**
- **Meta təsvir**
- **Open Graph başlığı** — Boş olduqda səhifənin başlığı istifadə edilir.
- **Open Graph təsviri** — Boş olduqda meta təsvir istifadə edilir.
- **Open Graph şəkli** — Boş olduqda səhifə şəkli istifadə edilir.
