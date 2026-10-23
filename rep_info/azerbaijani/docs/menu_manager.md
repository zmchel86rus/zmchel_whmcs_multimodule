# Menyular

Menyu yaradın, səhifələri və ya xüsusi keçidləri əlavə edib sürükləyərək sıralayın. Alt menyu üçün ana elementi, dillərə görə etiketləri, qonaq və ya müştəri görünməsini və cihazları seçin. Yerləşmə təyin edin; hər yerləşmədə yalnız bir menyu ola bilər. Daxili keçid üçün URL-in cari dilə uyğunlaşdırılıb-uyğunlaşdırılmayacağını seçin. Açıq menyunu kompüterdə və telefonda yoxlayın.

Hər element üçün başlıq, təsvir, CSS sinifləri, `rel`, ikon və yeni vərəqdə açılma seçimi təyin etmək olar; dərc edilmiş səhifələr avtomatik də əlavə edilə bilər. Menyunun WHMCS naviqasiyasını tamamlamasını və ya əvəz etməsini masaüstü və mobil görünüş üçün ayrıca seçin. Modul səhifəsinin keçidi cari slug, dil və URL rejiminə görə yenidən hesablanır; boş etiket tərcümə edilmiş başlığı və ya səhifə adını götürür. Səhifəyə baxmaq müştərinin profil dilini dəyişmir. Server təhlükəli URL sxemlərini və etiketdəki HTML-i rədd edir.

## WHMCS

Modul parametrlərində WHMCS menyu yerlərini aktiv edin. Hər yerə yalnız bir menyu təyin olunur, eyni menyu isə bir neçə yerdə işləyə bilər. Kompüter görünüşü 768 piksel və daha geniş ekranlar, mobil görünüş isə daha dar ekranlar üçündür. Yer söndürüləndə WHMCS-in standart menyusu dəyişmir.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Modulun dil marşrutu olmayan WHMCS sistem yollarında menyu etiketləri müştərinin saxlanmış dilindən, modul səhifələrində isə URL dilindən istifadə edir. Standart dilə ayrıca marşrut verildikdə ona da prefiks əlavə olunur. Sadə URL `?m=zmchel_whmcs_multimodule&slug=...&lang=...` şəklindədir. Fərdi keçidi lokallaşdırmadan saxlamaq olar; bu, `clientarea.php` kimi yollar üçün uyğundur. Ana elementi gizlətmək bütün budağı gizlədir.

Səhifə bəndlərinin URL-ləri cari slug və dərc edilmiş tərcümə əsasında yenidən qurulur. Tərcümə yoxdursa, dərc olunmuş əsas dil versiyası istifadə edilir. Xüsusi keçid göstərilən URL-ni olduğu kimi saxlaya bilər; xarici ünvanlara, mailto, tel və lövbərlərə dil prefiksi əlavə edilmir. Qaralama, silinmiş və giriş icazəsi olmayan səhifələr göstərilmir.

## zm_pb_menus

Məlumatlar `zm_pb_menus`, `zm_pb_menu_items` və `zm_pb_menu_locations` cədvəllərində saxlanılır. Cədvəlləri Modul verilənlər bazası bölməsində yaradın və ya düzəldin. Menyu ağacı ən çox 10 səviyyə və 300 bənd dəstəkləyir; ana bənd silinərsə, alt bəndlər bir səviyyə yuxarı keçir.

## Təlimatlar

- Menyu yarat
- Səhifələr, yazılar və ya xüsusi keçidlər əlavə edin.
- Sıralamanı dəyişmək üçün elementləri sürükləyin. İyerarxiyanı əsas element seçimi və ya köçürmə düymələri ilə tənzimləyin.
- Cari səhifənin dilindən istifadə et
- Daxil edilmiş URL-ni dəyişmədən istifadə et
- Digər dillərdə etiketlər
- Kimlərə görünür
- Cihazlar
- Hər yerləşmə sahəsində yalnız bir menyu ola bilər. Sahəni seçmək onu digər menyudan buraya təyin edir.
- Üst səviyyəli elementlər sütunlara, daxili elementlər isə keçidlərə çevrilir. Keçidsiz başlıq üçün URL olaraq # istifadə edin.
- Menyu cədvəlləri hələ yaradılmayıb. Onları Modulun verilənlər bazası bölməsində əlavə edin.
