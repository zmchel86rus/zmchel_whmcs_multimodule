# Yönlendirmeler

Tam adresler: kaynak → hedef. Kaynak, site kök dizininden başlayan bir yol veya bu siteye ait bir URL olmalıdır. Hedef, bir yol veya tam HTTP(S) URL'si olabilir. Sorgu parametresi içermeyen bir kural, sorgu parametreli isteklerle de eşleşir; hedef girildiği şekilde kullanılır. Kurallar, WHMCS'ye ulaşan GET/HEAD isteklerine uygulanır.

Varsayılan: 14 gün. Yayımlanmış sayfanın veya etkin çevirilerinin son değişikliğinden itibaren; hiç değiştirilmemişse oluşturulma tarihinden itibaren hesaplanır. Gecikme olmaması için 0 girin. Otomatik kurallar HTTP 301 kullanır.

Geçersiz kılınan sayfa adresleri, yerini aldıkları sistem sayfalarına otomatik olarak yönlendirilir. Bir geçersiz kılmanın birden fazla hedefi varsa yapılandırılmış ilk hedef kullanılır. Bu yönlendirmeler, Yönlendirme Yöneticisi kurallarından bağımsız olarak geçersiz kılmalar etkin olduğu sürece çalışır.

/ ile başlayan geçerli bir yol veya tam bir HTTP(S) URL'si girin. Kaynak bu siteye ait olmalıdır; # parçaları desteklenmez.

## HTTP

Kurallar HTTP `301`, `302`, `303`, `307`, `308` kodlarını destekler ve yalnızca WHMCS'ye ulaşan `GET`/`HEAD` isteklerine uygulanır. Kaynak yol ve belirtilmişse sorgu parametreleriyle tam eşleşir; hedefin parametreleri eskilerini değiştirir. Yönetici kuralları `zm_pb_redirects` tablosunda saklar, ancak istek sırasında tablo oluşturmaz: **Modül veritabanı** bölümünü kullanın. Mevcut URL sütunları 128 baytla sınırlıdır.

Elle oluşturulan kurallar otomatik kurallardan önceliklidir. Yayınlanmış bir sayfanın slug'ı değişirse, belirlenen bekleme süresinden sonra her etkin dil için otomatik `301` oluşturulabilir; taslağı yayınlamak bunu yapmaz. Sonraki ad değişiklikleri eski hedefleri günceller. Sorgu parametreleri içeren kural yalnızca yol için olan kuraldan önce uygulanır. Kaynak URL bu siteye ait olmalı ve `#` parçası içermemelidir.

## Talimatlar

- Kaynak
- Hedef
- Etkin
- Devre dışı
