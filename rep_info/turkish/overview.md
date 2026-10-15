# WHMCS için ücretsiz çok amaçlı modül

**Modülü kullanmadan önce benzersiz salt değerleri oluşturup `module_init.php` dosyasına yerleştirin**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` ve `ZM_PB_NONCE_SALT`.

Modül **WHMCS 8.13.1–8.13.7** üzerinde geliştirilip test edilmiştir. PHP uyumluluğu **7.4–8.5** sürümlerinde kontrol edilmiştir. Apache tam olarak desteklenir. Modül Nginx ile de çalışabilir; ancak ana sayfadaki dil yönlendirmesi ek yapılandırma gerektirebilir.

**zmchel WHMCS Multimodule ücretsizdir.** Görsel sayfa düzenleyicisi, çok dilli içerik, menüler, medya kütüphanesi, SEO alanları, XML site haritaları, yönlendirmeler, yeniden yazma kuralları ve içe/dışa aktarma araçları sunar. [Talimatları](instruction.md) okuyun.

## Gelecekteki geliştirmeler

- İç içe sayfalar ve sayfa kategorileri eklemek.
- Mevcut modülü bileşenlere ayırmak.
- Yönetim alanı için erişim hakları yöneticisi eklemek.
- `supported_langs.php` içindeki varsayılan dil listesini genişletmek.
- Modülün `.tpl` dosyaları ve WHMCS müşteri temaları için kod düzenleyicisi eklemek.
- Modülün, diğer modüllerin ve WHMCS'nin dil dosyaları için yönetici eklemek.
- Medya yöneticisini geliştirmek ve kapsamlı bir SEO yöneticisi hazırlamak.
- Çok dilli site haritaları ve HTML site haritası sayfası eklemek.
- Sayfa yöneticisine kullanım istatistikleri eklemek.
- JS/CSS/HTML küçültme, tam sayfa önbelleği ve tablo optimizasyonu eklemek.
- Sağlam bir modül güncelleme sistemi hazırlamak.

Bunlar **kesin bir yol haritası değil, gelecek için fikirlerdir**.

## Fikir önerin

[Önerinizi gönderin](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E); e-posta konusu «Предложение по мультимодулю» olsun.

## Soru sorun

[Sorunuzu e-postayla gönderin](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E); e-posta konusu «Задать вопрос по модулю» olsun.
