# Sayfa düzenleyicisi

- [Sayfalama](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Yapılandırılmış veriler](module_structured_data.md)

## İçerik ve diller

İçerik sekmesinde bir dil seçip GrapesJS bloklarını çalışma alanına sürükleyin. Seçili bloğun metin, resim ve seçeneklerini düzenleyip o dili kaydedin. Bölümler, sütunlar, tablolar, SSS, akordeonlar, iletişim formları, listeler, sayfalama, ziyaretçi/müşteri alanları ve özel kod blokları bulunur. Yapıyı veya içeriği başka bir dile kopyalayın ve yayımlamadan önce metinleri çevirin.

Güzel URL'ler ve dil yönlendirmesi etkinse varsayılan dil yalnızca isteğe bağlı kendi rotası kapalıysa `/contact/`, diğer diller `/tr/contact/` gibi bir önek kullanır. Bağlantı ve Düğme bloklarında geçerli dili yalnızca sitenin çevrilmiş sayfaları için ekleyin. Harici adresler, dosyalar, `mailto:`, `tel:` ve çevirisi olmayan WHMCS yolları için kapalı bırakın. Bağlantıları birden fazla dilde sınayın.

## WHMCS

Temel ayarlarda ad, slug, tür, durum, erişim ve dilleri denetleyin. WHMCS'nin varsayılan dili modülde etkin olmalıdır; yayınlanmış sayfanın gösterilen dilde içeriği olmalıdır.

## SEO

Her dil için başlık ve açıklama girin, ardından canonical, robots, Open Graph, gezinti yolu ve Schema değerlerini kontrol edin. Site haritası sekmesinde herkese açık, sistem dışı sayfa için sıklık ve öncelik seçin. Kaydedip herkese açık URL'yi ve XML'i denetleyin.

## İletişim Formu

**İletişim Formu** bloğunu ekleyin. Bir **WHMCS destek talebi** ve destek bölümü ya da **e-posta** ve alıcı seçin; başlık, açıklama, konu ve düğme metnini girin. Her alan için ad, tür, zorunluluk ve doğrulama belirleyin. Ziyaretçi talebi, gönderen adı ve e-posta rolü atanmış alanlar gerektirir. Açılır listede her satıra bir seçenek yazın, örneğin `sales : Satış`. Her onay için ayrı alan oluşturun ve WHMCS'deki CAPTCHA'yı kullanın. Kaydedip ziyaretçi olarak gerçek bir deneme gönderin; talebi veya teslimatı, hataları ve formun temizlenmesini kontrol edin. Düzenleyicinin yeşil durumu teslimatı doğrulamaz; `mail()` başarısızsa WHMCS'de SMTP yapılandırın.

## Talimatlar

- İç içe flex düzen kapsayıcısı. Diğer blokları içine sürükleyin.
- İç içe CSS Grid kapsayıcısı. Diğer blokları içine sürükleyin.
- İç içe Bootstrap döngüsel galerisi. Blokları içine sürükleyin; her biri bir slayt olur.
- Bu bloğun altındaki tüm bloklar yalnızca oturum açmış kullanıcılara gösterilir. Yalnızca sayfanın erişim türü Karma olduğunda çalışır.
- Bu bloğun altındaki tüm bloklar yalnızca misafirlere gösterilir. Yalnızca sayfanın erişim türü Karma olduğunda çalışır.
- **Sayfa başlığı**
- **Meta açıklama**
- **Kanonik URL**
- **Robots** — index, follow / noindex, nofollow. Dizine eklenmeyi kontrol eder.
- **Şema türü** — Devre dışı bırakıldığında bu sayfa için Schema.org JSON işaretlemesi oluşturulmaz.
