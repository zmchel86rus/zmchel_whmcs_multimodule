# zmchel WHMCS Multimodule: talimatlar

**Modülü kullanmadan önce benzersiz salt değerleri oluşturup `module_init.php` dosyasına yerleştirin**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` ve `ZM_PB_NONCE_SALT`.

**İlk kullanımdan önce Modül ayarları → Desteklenen diller bölümünü açıp gereken dilleri etkinleştirin.**

Modül **WHMCS 8.13.1–8.13.7** üzerinde geliştirilip test edilmiştir. PHP uyumluluğu **7.4–8.5** sürümlerinde kontrol edilmiştir. Apache tam olarak desteklenir. Modül Nginx ile de çalışabilir; ancak ana sayfadaki dil yönlendirmesi ek yapılandırma gerektirebilir.

**zmchel WHMCS Multimodule ücretsizdir.** Görsel sayfa düzenleyicisi, çok dilli içerik, menüler, medya kütüphanesi, SEO alanları, XML site haritaları, yönlendirmeler, yeniden yazma kuralları ve içe/dışa aktarma araçları sunar.

## Modül ayarları

Modülün kullanabileceği dilleri seçin. Bir dili kapatmak içeriğini silmez.

- **Modül ayarları → Desteklenen diller → Etkinleştir**
- **Modül veritabanı → Düzelt Seçili öğeler**
- **Yeniden yazma kuralları → Kuralları kontrol et → Kuralları ekle veya güncelle**

Nginx .htaccess dosyasını okumadığından bu kurallar orada çalışmaz. Eşdeğer kuralları nginx içinde yapılandırın.

## Sayfa yöneticisi

- **Sayfa ekle → Sayfa adı → Sayfa slug'ı → Kaydet**
- **Sayfa düzenleyicisi → İçerik ayarları → Meta veri ayarları → Sayfa site haritası ayarları → Tümünü kaydet**
- **Sayfa yöneticisi → Ziyaret et**
- **Site haritası → Site haritalarını oluştur**

Yalnızca Latin harfleri, kısa çizgiler ve rakamlara izin verilir.

Oturum açmış kullanıcılar: sayfaya yalnızca oturum açmış kullanıcılar erişebilir; Misafirler: yalnızca misafirler erişebilir; Karma: sayfaya herkes erişebilir, görünürlük sayfa içindeki bloklarla kontrol edilir.

Güncelleme zamanı geldiğinde otomatik oluşturma, WHMCS cron işleminden sonra çalışır. Manuel oluşturma hemen başlar.

## Bölümlere göre kılavuzlar

- [Sayfa yöneticisi](docs/pages_manager.md)
- [Sayfa düzenleyicisi](docs/pages_editor.md)
- [Medya Yöneticisi](docs/media_manager.md)
- [Menüler](docs/menu_manager.md)
- [Dil Yöneticisi](docs/langs_manager.md)
- [Yönlendirmeler](docs/redirects_manager.md)
- [Site haritaları](docs/sitemap_manager.md)
- [Yeniden yazma kuralları](docs/rewrite_manager.md)
- [Modül ayarları](docs/module_settings.md)
- [Modül veritabanı](docs/module_db.md)

## Ek materyaller

- [Sayfalama](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Yapılandırılmış veriler](docs/module_structured_data.md)
- [İçe ve dışa aktarma](docs/module_settings_transfer.md)
