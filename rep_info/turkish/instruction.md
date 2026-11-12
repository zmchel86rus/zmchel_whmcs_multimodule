[![İzleyenler](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%C4%B0zleyenler)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Yıldızlar](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Y%C4%B1ld%C4%B1zlar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Forklar](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Forklar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Sorunlar](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Sorunlar)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule: talimatlar

**zmchel WHMCS Multimodule ücretsizdir.** Görsel sayfa düzenleyicisi, çok dilli içerik, menüler, medya kütüphanesi, SEO alanları, XML site haritaları, yönlendirmeler, yeniden yazma kuralları ve içe/dışa aktarma araçları sunar.

## İlk kullanımdan önce

**İlk kullanımdan önce Modül ayarları → Desteklenen diller bölümünü açıp gereken dilleri etkinleştirin.**

Modül her etkinleştirildiğinde yeni salt değerleri oluşturur ve bunları `module_init.php` dosyasına yazar (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Üç salt değerinin de doldurulduğunu kontrol edin.

## Test edilmiş uyumluluk ve işlevsellik

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Web sunucusu uyumluluğu

Apache tam olarak desteklenir. Modül Nginx ile de çalışabilir; ancak ana sayfadaki dil yönlendirmesi ek yapılandırma gerektirebilir.

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
