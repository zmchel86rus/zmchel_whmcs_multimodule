# Sayfa yöneticisi

## Erişim ve sayfalar

WHMCS yönetim panelinde **Addons → zmchel WHMCS Multimodule** bölümünü açın. Sayfa listesinde sayfa oluşturabilir, arayabilir, düzenleyebilir ve silebilirsiniz. *Slug*, `/contact/` adresindeki `contact` gibi alan adından sonraki bölümdür. URL'leri, yönlendirmeleri veya sunucu kurallarını değiştirmeden önce modül ayarlarını dışa aktarın.

Yeni bir sayfa oluştururken alan adı ya da `.php` içermeyen, Latin harfleri, rakamlar ve kısa çizgilerden oluşan dahili ad ve slug girin. Ziyaretçiler, oturum açmış müşteriler veya herkes için erişimi seçin. Ardından durum (taslak, yayımlandı, ertelendi veya çöp kutusu), tür (sayfa, makale veya sistem sayfası) ve dilleri belirleyin. WHMCS varsayılan dili `supported_langs.php` içinde bulunmalıdır; modül bu dili otomatik ekler.

Kaydettikten sonra sayfayı açıp **ana ayarları**, **içeriği**, **meta verileri** ve **site haritası** ayarlarını düzenleyin. Her formun ayrı Kaydet düğmesi vardır; «Tümünü kaydet» hepsini işler. Başarı mesajlarını ve herkese açık sayfayı kontrol edin. Silme işlemi sayfayı önce çöp kutusuna taşır; kalıcı silme oradan yapılır.

## URL

Listeyi ad, erişim, tür, durum veya dile göre süzün. **Ziyaret et** herkese açık URL'yi açar. **Sil** önce sayfayı çöp kutusuna taşır; kalıcı silme orada yapılır. Sayfa açılmıyorsa yayın durumunu, etkin dili ve erişim türünü denetleyin.

## WHMCS

Bir WHMCS sayfasını değiştirmek için mevcut sistem adresini ve modülün yayınlanmış sayfasını seçin. Tam değiştirme, normal içeriğin önüne veya arkasına ekleme ya da yalnızca meta/SEO seçin. Kaydedin ve özgün WHMCS URL'sini ziyaretçi ve oturum açmış müşteri olarak sınayın.

## Talimatlar

- Sayfa ekle
- **Sayfa adı** — Dahili sayfa adı
- **Sayfa slug'ı** — Yalnızca Latin harfleri, kısa çizgiler ve rakamlara izin verilir.
- **Erişim türü** — Oturum açmış kullanıcılar: sayfaya yalnızca oturum açmış kullanıcılar erişebilir; Misafirler: yalnızca misafirler erişebilir; Karma: sayfaya herkes erişebilir, görünürlük sayfa içindeki bloklarla kontrol edilir.
- **Sayfa türü** — Sistem sayfaları site haritasına dahil edilmez ve normal kullanıcılara açık değildir.
- **Sayfa dilleri** — Seçiminizden bağımsız olarak varsayılan dil her zaman dahil edilir.
- Tam geçersiz kılma, görüntülenen içeriği ve meta verileri değiştirir.\ Öncesine ekle, içeriği mevcut sayfa içeriğinden önce yerleştirir.\ Sonrasına ekle, içeriği mevcut sayfa içeriğinden sonra yerleştirir.\ Yalnızca meta veri/SEO, sayfanın meta verilerini değiştirir.
- Sayfa listesinde gezinme
