# İçe ve dışa aktarma

Tüm veya seçili bölümler için en fazla 128 MiB boyutunda tek bir ZIP dosyası kullanılır (PHP yükleme sınırlarını dikkate alın). Eşleşen sayfalar kalıcı bağlantı adı (slug) ve erişim türüne, menüler ise ada göre güncellenir. Diğer kayıtlar değiştirilmez. Menüleri yeni bir siteye aktarırken sayfaları da dahil edin. Dosyada bulunmayan seçili bölümler atlanır. İçe aktarmada JSON dosyaları da desteklenir.

CSS/JS, sayfalarla birlikte; görseller ve diğer yüklenen dosyalar ise medya kütüphanesiyle birlikte dahil edilir. Revizyon geçmişi, toplanan Smarty değişkenleri ve gizli WHMCS bilgileri dışa aktarılmaz. İçe aktarmadan sonra site haritasını yeniden oluşturun; yeniden yazma kurallarını Yeniden Yazma Yöneticisi bölümünden uygulayın.

Sayfalar ve yazılar (çeviriler, içerik, SEO, site haritası ayarları, CSS/JS blokları)

Seçili bölümlerde eşleşen kayıtlar dosyadaki verilerle güncellenecek. Devam edilsin mi?

## ZIP

Dışa aktarma; çevirileri, içeriği, SEO verileri ve CSS/JS koduyla sayfaları ve gönderileri; hiyerarşisi ve konumlarıyla menüleri; ayarları, yönlendirmeleri, özel kuralları ve dosyalarıyla medya kitaplığını içerebilir. Sürüm geçmişi, toplanan Smarty değişkenleri, WHMCS hesapları ve sırları ile tema dosyaları dahil edilmez. ZIP dosyası 128 MiB ile sınırlıdır; PHP `upload_max_filesize` ve `post_max_size` sınırları da geçerlidir. Menüleri başka siteye taşırken sayfaları da içe aktarın ve aynı adlı menüleri önceden çözün.

Dışa aktarılan dosya `zmchel_whmcs_multimodule` biçimini (sürüm 2) kullanır. İçe aktarma sırasında kaynak sitenin URL'leri hedefin `SystemURL` değerine uyarlanır, dış bağlantılar ise korunur. İçe aktarma tablo oluşturmaz: tabloları önce Modül Veritabanı bölümünde hazırlayın. Başlamadan önce onay istenir; kayıtlar işlem içinde değiştirilir ve hata olursa değiştirilen dosyalar geri yüklenir.
