# Menüler

Bir menü oluşturun, sayfa veya özel bağlantı ekleyin ve öğeleri sürükleyerek sıralayın. Alt menü için üst öğeyi seçin; dile göre etiketleri, misafir veya müşteri görünürlüğünü ve cihazları ayarlayın. Bir konum atayın; her konumda yalnızca bir menü bulunabilir. İç bağlantı URL’lerinin geçerli dile uyarlanıp uyarlanmayacağını seçin. Herkese açık menüyü bilgisayarda ve telefonda kontrol edin.

Her öğe için başlık, açıklama, CSS sınıfları, `rel`, simge ve yeni sekmede açılma seçeneği ayarlanabilir; yayımlanmış sayfalar otomatik olarak da eklenebilir. Masaüstü ve mobil için menünün WHMCS gezinmesini tamamlamasını veya değiştirmesini ayrı ayrı seçin. Modül sayfası bağlantısı geçerli slug, dil ve URL moduna göre yeniden hesaplanır; boş etiket çevrilmiş başlığı veya sayfa adını kullanır. Bir sayfayı açmak müşterinin profil dilini değiştirmez. Sunucu güvenli olmayan URL şemalarını ve etiketlerdeki HTML içeriğini reddeder.

## WHMCS

Modül ayarlarından gerekli WHMCS menü konumlarını etkinleştirin. Her konuma bir menü atanabilir; aynı menü birden fazla konumda kullanılabilir. Masaüstü görünümü 768 px ve üzeri genişlikte, mobil görünüm daha dar ekranlarda geçerlidir. Devre dışı bırakılan konum WHMCS'nin standart menüsünü değiştirmez.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Modülün dil yönlendirmesi olmayan WHMCS sistem yollarında menü etiketleri müşterinin kayıtlı dilini; modül sayfaları URL dilini kullanır. Varsayılan dile ayrı rota verildiğinde o da önek alır. Normal URL `?m=zmchel_whmcs_multimodule&slug=...&lang=...` biçimindedir. Özel bağlantı `clientarea.php` gibi yerelleştirilmeden bırakılabilir. Üst öğeyi gizlemek tüm dalını gizler.

Sayfa öğesinin URL'si güncel slug ve yayımlanmış çeviriye göre yeniden oluşturulur. Çeviri yoksa varsayılan dildeki yayımlanmış sürüm kullanılır. Özel bağlantı girilen URL'yi koruyabilir; dış adreslere, mailto, tel ve bağlantı noktalarına dil öneki eklenmez. Taslak, silinmiş ve erişime kapalı sayfalar gösterilmez.

## zm_pb_menus

Veriler `zm_pb_menus`, `zm_pb_menu_items` ve `zm_pb_menu_locations` tablolarında tutulur. Tabloları Modül Veritabanı bölümünden oluşturun veya onarın. Menü ağacı en fazla 10 düzey ve 300 öğe destekler; üst öğe silinirse alt öğeleri bir düzey yukarı taşınır.

## Talimatlar

- Menü oluştur
- Sayfa, yazı veya özel bağlantı ekleyin.
- Sıralarını değiştirmek için öğeleri sürükleyin. Üst öğe seçicisi veya taşıma düğmeleriyle iç içe yerleşimi ayarlayın.
- Geçerli sayfanın dilini kullan
- Girilen URL'yi değiştirmeden kullan
- Diğer dillerdeki etiketler
- Görünürlük
- Cihazlar
- Her konuma yalnızca bir menü atanabilir. Bir konum seçildiğinde bu konumun başka bir menüdeki ataması buraya taşınır.
- Üst düzey öğeler sütunlara, iç içe öğeler bağlantılara dönüşür. Bağlantısız bir başlık için URL olarak # kullanın.
- Menü tabloları henüz oluşturulmadı. Bunları Modül Veritabanı bölümünde ekleyin.

