# Yönləndirmələr

Dəqiq ünvanlar: mənbə → təyinat. Mənbə saytın kökündən başlayan yol və ya bu saytdakı URL-dir. Təyinat yol və ya tam HTTP(S) URL ola bilər. Sorğu parametrləri olmayan qayda parametrli sorğulara da uyğun gəlir; təyinat daxil edildiyi kimi istifadə olunur. Qaydalar WHMCS-ə çatan GET/HEAD sorğularına tətbiq edilir.

Standart: 14 gün. Müddət dərc edilmiş səhifənin və ya onun aktiv tərcümələrinin son dəyişiklik tarixindən, dəyişiklik olmayıbsa, yaradılma tarixindən hesablanır. Gecikmə olmaması üçün 0 daxil edin. Avtomatik qaydalar HTTP 301 istifadə edir.

Əvəzləyici səhifə ünvanları əvəz etdikləri sistem səhifələrinə avtomatik yönləndirilir. Bir əvəzləmənin bir neçə təyinatı varsa, ilk təyin edilən istifadə olunur. Bu yönləndirmələr, Yönləndirmə menecerinin qaydalarından asılı olmayaraq, əvəzləmələr aktiv olduqda işləyir.

/ işarəsi ilə başlayan düzgün yol və ya tam HTTP(S) URL daxil edin. Mənbə bu sayta aid olmalıdır; # fraqmentləri dəstəklənmir.

## HTTP

Qaydalar HTTP `301`, `302`, `303`, `307`, `308` kodlarını dəstəkləyir və yalnız WHMCS-ə çatan `GET`/`HEAD` sorğularına tətbiq olunur. Mənbə yol və göstərilibsə sorğu parametrləri ilə dəqiq uyğunlaşdırılır; təyinatın parametrləri əvvəlkiləri əvəz edir. Menecer qaydaları `zm_pb_redirects` cədvəlində saxlayır, amma sorğu zamanı cədvəl yaratmır: **Modul verilənlər bazası** bölməsindən istifadə edin. Mövcud URL sütunları 128 baytla məhduddur.

Əl ilə yaradılan qaydalar avtomatik qaydalardan üstün tutulur. Dərc olunmuş səhifənin slug-u dəyişəndə təyin edilmiş gözləmə müddətindən sonra hər aktiv dil üçün avtomatik `301` yaradıla bilər; qaralamanın dərc edilməsi bunu yaratmır. Sonrakı ad dəyişiklikləri köhnə qaydaların hədəfini yeniləyir. Sorğu parametrlərini göstərən qayda yalnız yol üzrə qaydadan üstün tutulur. Mənbə URL bu sayta aid olmalı və `#` fraqmenti daşımamalıdır.

## Təlimatlar

- Mənbə
- Təyinat
- Aktivdir
- Deaktivdir
