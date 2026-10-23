# Site haritaları

Güncelleme zamanı geldiğinde otomatik oluşturma, WHMCS cron işleminden sonra çalışır. Manuel oluşturma hemen başlar.

Yayımlanmış dil sürümleri dahil, misafirlerin erişebildiği etkin sayfalar ve yazılar eklenir. Geçersiz kılmalar, yerini aldıkları sayfaların herkese açık URL'lerini kullanır.

Etkinleştirildiğinde /html-sitemap, site haritasını normal bir HTML sayfası olarak gösterir; sitemap.xml etkilenmez.

## XML

XML etkin diller için karşılıklı bağlantılar ve varsayılan dil adresi için `x-default` içerir. Yönlendirme kaynakları `loc` veya dil alternatiflerine girmez; yedek içerik gerçek diliyle işaretlenir. Sayfa ve gönderi dosyaları XHTML ad alanını bildirir.

`AfterCronJob` kancası `ZM_PB_SITEMAP_UPDFREQ` aralığını son başarılı oluşturma zamanı `ZM_PB_SITEMAP_LASTUPD` ile karşılaştırır; site haritası kapalıyken elle oluşturma da kullanılamaz. Dil sürümleri `lang_status` yerine `lang_active` ile seçilir. Ek parçalar `_2`, `_3` gibi son ekler alır. Oluşturma başarısız olursa eski dosyalar geri yüklenir ve başarı zamanı değişmez. Kök dizin, `resources/` ve `inc/editable_consts.php` için yazma izinlerini denetleyin; tabloları modül veritabanında ayrıca onarın.

Otomatik oluşturma WHMCS cron görevine ve ayarlanan aralığa bağlıdır; düğme işlemi hemen başlatır. Yalnızca konukların görebildiği yayımlanmış sayfalar ve gönderiler ile etkin çevirileri eklenir. Bir sayfa sistem sayfasının yerini alıyorsa, yerine geçen sayfanın slug değeri değil sistem sayfasının herkese açık URL'si kullanılır. 50.000 URL veya 50 MB sınırını aşan dosyalar bölünür. Dizin diğer geçerli site haritalarını korur.

Modül site köküne `sitemap_index.xml`, `sitemap_pages.xml` ve `sitemap_posts.xml` dosyalarını yazar; boş kategori için dosya oluşturulmaz. Birleşik bir `sitemap.xml` oluşturmaz. Sayfalar veya diller değiştikten sonra haritaları yeniden oluşturup dizini tarayıcıda açın. Hata olursa kök dizine yazma iznini denetleyin; son başarılı oluşturma zamanı değişmez.

## Talimatlar

- Site haritalarını oluştur
- Site kök dizinindeki dosyalar
- Son başarılı oluşturma
- Bir sonraki güncellemenin en erken zamanı
- Hiçbir şey seçilmezse site haritası her gün güncellenir.
- **Güncelleme sıklığı** — Boş bırakılırsa varsayılan değer 'monthly' olur.
- **Güncelleme önceliği** — Boş bırakılırsa varsayılan değer '0.5' olur.
