# Yeniden yazma kuralları

## WHMCS

/ru/, /en/ ve diğer önekler altındaki sayfalar dahil, dil URL'leri için kurallar. Diller supported_langs.php dosyasından alınır; kurallar .htaccess dosyasına WHMCS kurallarından önce eklenir.

Nginx .htaccess dosyasını okumadığından bu kurallar orada çalışmaz. Eşdeğer kuralları nginx içinde yapılandırın.

nginx → Apache yapılandırması algılandı. Bu kurallar yalnızca Apache'ye iletilen isteklerde çalışır; nginx .htaccess dosyasını okumaz.

Bir kural ekledikten veya sildikten sonra değişiklikleri .htaccess dosyasına uygulamak için “Kuralları ekle veya güncelle” düğmesine tıklayın.

## .htaccess

Yöneticiyi açıp kuralları sitenin ana `.htaccess` dosyasıyla karşılaştırın. Kendi kuralınız için URL desenini, hedefi ve bayrakları kaydedin; ardından bloğu WHMCS kurallarından önce yazmak için **Kuralları ekle veya güncelle** seçeneğini kullanın. Durumu yeniden kontrol edip yayınlanmış bir sayfayı varsayılan ve başka bir dilde açın. Çok geniş bir desen başka sayfaları etkileyebilir. Nginx → Apache kurulumunda kurallar yalnızca Apache'ye iletilen isteklerde çalışır.

## Talimatlar

- Kuralları kontrol et
- Kuralları ekle veya güncelle
- Tüm kuralları .htaccess dosyasından kaldır
- URL deseni
- Hedef
- Bayraklar
