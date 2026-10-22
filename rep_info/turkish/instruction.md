# zmchel WHMCS Multimodule: talimatlar

**Modülü kullanmadan önce benzersiz salt değerleri oluşturup `module_init.php` dosyasına yerleştirin**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` ve `ZM_PB_NONCE_SALT`.

**İlk kullanımdan önce Modül ayarları → Desteklenen diller bölümünü açıp gereken dilleri etkinleştirin.**

Modül **WHMCS 8.13.1–8.13.7** üzerinde geliştirilip test edilmiştir; PHP uyumluluğu **7.4–8.5** sürümlerinde kontrol edilmiştir. Apache tam olarak desteklenir. Nginx de çalışabilir, ancak ana sayfadaki dil yönlendirmesi ek ayar gerektirebilir. **Modül ücretsizdir.**

## Dil Yöneticisi (geliştirme aşamasında)

WHMCS yönetiminde Dil Yöneticisini açın ve bir bölüm (WHMCS müşteri veya yönetici dilleri, bu modül ya da başka bir modül) ile dil seçin. Özgün metni veya referansı çeviriyle karşılaştırın, bir satırı düzenleyip kaydedin; mevcut anahtarları JSON olarak dışa ve içe aktarabilirsiniz. Yeni diller çevrilene kadar referansı kullanır. Yönetici dil dosyalarını etkinleştirip devre dışı bırakır ve eski dosya adlarını düzeltir; varsayılan dili önce WHMCS'de değiştirin.

## Erişim ve sayfalar

WHMCS yönetim panelinde **Addons → zmchel WHMCS Multimodule** bölümünü açın. Sayfa listesinde sayfa oluşturabilir, arayabilir, düzenleyebilir ve silebilirsiniz. *Slug*, `/contact/` adresindeki `contact` gibi alan adından sonraki bölümdür. URL'leri, yönlendirmeleri veya sunucu kurallarını değiştirmeden önce modül ayarlarını dışa aktarın.

Yeni bir sayfa oluştururken alan adı ya da `.php` içermeyen, Latin harfleri, rakamlar ve kısa çizgilerden oluşan dahili ad ve slug girin. Ziyaretçiler, oturum açmış müşteriler veya herkes için erişimi seçin. Ardından durum (taslak, yayımlandı, ertelendi veya çöp kutusu), tür (sayfa, makale veya sistem sayfası) ve dilleri belirleyin. WHMCS varsayılan dili `supported_langs.php` içinde bulunmalıdır; modül bu dili otomatik ekler.

Kaydettikten sonra sayfayı açıp **ana ayarları**, **içeriği**, **meta verileri** ve **site haritası** ayarlarını düzenleyin. Her formun ayrı Kaydet düğmesi vardır; «Tümünü kaydet» hepsini işler. Başarı mesajlarını ve herkese açık sayfayı kontrol edin. Silme işlemi sayfayı önce çöp kutusuna taşır; kalıcı silme oradan yapılır.

## İçerik ve diller

İçerik sekmesinde bir dil seçip GrapesJS bloklarını çalışma alanına sürükleyin. Seçili bloğun metin, resim ve seçeneklerini düzenleyip o dili kaydedin. Bölümler, sütunlar, tablolar, SSS, akordeonlar, iletişim formları, listeler, sayfalama, ziyaretçi/müşteri alanları ve özel kod blokları bulunur. Yapıyı veya içeriği başka bir dile kopyalayın ve yayımlamadan önce metinleri çevirin.

Güzel URL'ler ve dil yönlendirmesi etkinse varsayılan dil `/contact/`, diğer diller `/tr/contact/` gibi bir önek kullanır. Bağlantı ve Düğme bloklarında geçerli dili yalnızca sitenin çevrilmiş sayfaları için ekleyin. Harici adresler, dosyalar, `mailto:`, `tel:` ve çevirisi olmayan WHMCS yolları için kapalı bırakın. Bağlantıları birden fazla dilde sınayın.

## SEO, medya ve menüler

Her dil için Meta veriler sekmesinde başlık, açıklama, sosyal medya görseli, kanonik URL, robots ayarları ve Schema türünü doldurun. Yayımlanmış sistem dışı sayfalar XML site haritasına eklenebilir. Medya yöneticisine resim yükleyin, anlamlı alternatif metin ekleyin ve optimizasyondan sonra kaliteyi kontrol edin.

Menü yöneticisinde bir menü oluşturun, sayfalar veya özel bağlantılar ekleyin, öğeleri sıralayıp konum ve görünürlüğü ayarlayın. Her konuma yalnızca bir menü atanabilir. Bir WHMCS sayfasını değiştirmek için önce yeni sayfayı yayımlayın, sayfa listesinde geçersiz kılmayı ayarlayın ve asıl WHMCS URL'sini ziyaretçi ve oturum açmış müşteri olarak sınayın.

## Site araçları

Yönlendirme yöneticisinde kaynak ve hedef belirleyin: kalıcı taşıma için `301`, geçici taşıma için `302`. Yeniden yazma yöneticisi güzel URL kurallarını yönetir. Site haritalarını oluşturup `sitemap_index.xml` dosyasını kontrol edin. Modül ayarları menüleri, Smarty'yi, bakım modunu ve içe/dışa aktarmayı da yönetir. JSON dışa aktarımı tam WHMCS yedeğinin yerini almaz.

İletişim formu WHMCS destek bileti veya e-posta gönderebilir. Alanları, alıcıyı veya destek bölümünü, onayları ve CAPTCHA'yı ayarlayın ve gerçek bir test gönderimi yapın. Modül tabloları eksikse Modül veritabanı bölümünü kullanın.

## Ek belgeler (English)

[Menüler](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Sayfalama](../english/docs/pagination.md) · [Site haritaları](../english/docs/sitemaps.md) · [Yönlendirmeler](../english/docs/redirects.md) · [Yapılandırılmış veriler](../english/docs/structured-data.md) · [İçe ve dışa aktarma](../english/docs/transfer.md).
