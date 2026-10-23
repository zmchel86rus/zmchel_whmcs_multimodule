# Səhifələmə

Siyahı blokuna klikləyin. Esc seçimi ləğv edir. Səhifələməni hədəf blokdan kənarda yerləşdirin.

Smarty üçün tam siyahı dəyişənini daxil edin. Dəyişən olmadan konteynerin HTML elementləri səhifələrə bölünür; lazım gələrsə, sətir sinfini və ya tr teqini göstərin. Keçidlər element sayını, sıralamanı və filtrləri saxlayır. Bir neçə müstəqil siyahı dəstəklənir.

Səhifədəki element sayı seçicisini səhifələmənin içinə və ya səhifənin digər bloklarına sürükləyin. O, bu səhifələmə ilə əlaqəli qalacaq.

Smarty siyahı blokunu seçin. Axtarış və səhifələmə eyni bloka bağlı olmalıdır.

Tam siyahı dəyişənini göstərin. Axtarış seçilmiş sahələrdən hər hansı birində uyğunluq axtarır; filtrlər birlikdə tətbiq olunur. Şərtlər səhifələr hesablanmazdan əvvəl tətbiq edilir; tətbiq və sıfırlama ilk səhifəyə qaytarır. Mövcud səhifələmə əlaqəsi dəyişəni təmin edir.

## Keçidlər və siyahı mənbəyi

Səhifələməni siyahı blokundan kənara yerləşdirin və həmin bloku hədəf seçin. Smarty siyahısı üçün bütün elementləri saxlayan dəyişəni göstərin; əks halda konteynerdəki HTML elementləri bölünür. Keçid formatını modul ayarına görə, `/page/2/` və ya `?page=2` kimi seçin. Yol formatı rewrite qaydaları tələb edir. Müstəqil siyahılar ayrı parametrlərdən istifadə edir; keçidlər dili, filtrləri və sıralamanı saxlayır.

## Səhifə ölçüsü, SEO və filtrlər

Element sayını təyin edin və lazım gələrsə 10/25/50/100/250 seçimini aktivləşdirin. Ölçünün dəyişməsi siyahını birinci səhifəyə qaytarır. Noindex seçimi yalnız ikinci və sonrakı səhifələrə tətbiq olunur; başlığı və kanonik URL-i yoxlayın. Filtrləri eyni siyahıya bağlayın, sonra ikinci səhifəni və filtr nəticəsini açıq saytda sınayın.

## page / count / pager

Smarty siyahısı üçün bütün elementləri saxlayan dəyişəni göstərin və `{foreach}` dövrünü saxlayın: siyahını modul bölür, ikinci `array_slice` əlavə etməyin. Dəyişən yoxdursa, konteynerdəki HTML elementləri bölünür; `tr` etiketi və ya sətir sinfi seçilə bilər, `thead` və `tfoot` yerində qalır. Cari səhifənin ətrafındakı düymələrin sayını masaüstü və mobil üçün ayrı seçin. Birbaşa PHP yollarında `?page=2` istifadə edin; `/page/2/` rewrite qaydaları tələb edir. Birincidən sonrakı səhifələrin öz canonical ünvanı var və onlara `noindex` verilə bilər.

Bir neçə müstəqil siyahı olduqda birincisi `page`, `count` və `sort` parametrlərindən istifadə edir; digərlərinin parametrlərinə blokun ID-si əlavə olunur. `/page/N/` yolunda `pager` nömrənin hansı siyahıya aid olduğunu göstərir. Smarty blokunda `$zm_pagination` `total`, `page`, `pages`, `count` və `offset` dəyərlərini verir. `count` 10–250 aralığında məhdudlaşdırılır. Boş və ya tək səhifəli siyahıda səhifələmə paneli gizlənir.

## YYYY-MM-DD

Filtrlər səhifələmə ilə eyni siyahıya tətbiq olunur. Mətn axtarışı vergüllə ayrılmış bir neçə sahəni yoxlaya bilər; tarix aralığı `YYYY-MM-DD` istifadə edir və son günü tam əhatə edir.

## Flex / Grid

Görünüş üçün Flex və ya Grid seçin, enləri və sütunları cihazlara görə qurun. Filtri tətbiq və ya sıfırlamaq siyahını ilk səhifəyə qaytarır. Nəticə sayı seçicisini paneldən ayırıb köçürmək olar; təkrarlanan panel eyni siyahını idarə edir.

## Təlimatlar

- Səhifədəki element sayı: 10, 25, 50, 100, 250
- 2-ci və sonrakı səhifələri indeksləmə
- Keçidlərin formatı
- Səhifədə standart element sayı
