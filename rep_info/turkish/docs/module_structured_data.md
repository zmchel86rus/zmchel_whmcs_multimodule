# Yapılandırılmış veriler

- **Sayfa düzenleyicisi → Meta veri ayarları → Şema türü → Kaydet.**

## Modülün işaretlediği içerik

Menüler ve içindekiler `SiteNavigationElement`, görünen soru ve yanıtlar `FAQPage`, çok öğeli gezinti yolu `BreadcrumbList` oluşturabilir. Düzen blokları, düğmeler ve filtreler otomatik içerik türü almaz. Sayfa için seçilen Schema türü JSON-LD çıktısını belirler; devre dışıysa bu işaretleme üretilmez.

## Yayından sonra kontrol

Herkese açık sayfada JSON-LD, kanonik URL, dil ve gerçekten görünen içeriği kontrol edin. Geçerli işaretleme zengin arama sonucu garantisi vermez.

## Schema.org

`SiteNavigationElement` gerçekten görünen menü bağlantılarını ve başlıklarını kullanır; içindekiler bölümü sayfada bulunan başlıklar için `WebPageElement` ekleyebilir. `FAQPage` yalnızca ziyaretçinin gördüğü dolu soru-cevapları içerir: gizli bloklar ve sıradan akordeonlar dışarıda bırakılır. `BreadcrumbList` en az iki öğe varsa oluşturulur. Kuruluş verileri WHMCS'den gelir; iletişim dilleri `ContactPoint.availableLanguage` içinde BCP 47 biçimindedir. Filtre, sayfalama, form ve özel HTML için Schema türü tahmin edilmez.

## Talimatlar

- **Şema türü** — Devre dışı bırakıldığında bu sayfa için Schema.org JSON işaretlemesi oluşturulmaz.
- **İçerik haritası (breadcrumb)** — İçerik haritasındaki sayfa adı
- **Kanonik URL**
- **Sayfa başlığı**
- **Meta açıklama**
- **Open Graph başlığı** — Boş bırakılırsa sayfa başlığı kullanılır.
- **Open Graph açıklaması** — Boş bırakılırsa meta açıklama kullanılır.
- **Open Graph görseli** — Boş bırakılırsa sayfa görseli kullanılır.

