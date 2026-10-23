# Sayfalama

Liste içeren bloğa tıklayın. İptal etmek için Esc tuşuna basın. Sayfalama, seçilen bloğun dışında olmalıdır.

Smarty için tam liste değişkenini belirtin. Değişken yoksa kapsayıcıdaki HTML öğeleri sayfalara bölünür; gerekirse satır sınıfını veya tr etiketini belirtin. Bağlantılar count, sort ve filtreleri korur. Birbirinden bağımsız listeler desteklenir.

Öğe sayısı seçicisini sayfalama içinde veya sayfanın diğer bloklarına sürükleyebilirsiniz. Seçici bu sayfalamaya bağlı kalır.

Liste içeren bir Smarty bloğu seçin. Arama ve sayfalama aynı bloğa bağlı olmalıdır.

Tam listenin değişkenini belirtin. Arama, belirtilen alanlardan herhangi birini kontrol eder; filtreler birlikte uygulanır. Koşullar sayfa sayısı hesaplanmadan önce uygulanır; uygulama ve sıfırlama ilk sayfaya döndürür. Sayfalama zaten varsa onun değişkeni kullanılır.

## Bağlantılar ve liste kaynağı

Sayfalamayı liste bloğunun dışına yerleştirip o bloğu hedef seçin. Smarty listesi için tüm öğeleri içeren değişkeni belirtin; aksi halde kapsayıcının HTML öğeleri bölünür. Bağlantı biçimini modül ayarına göre, `/page/2/` veya `?page=2` olarak seçin. Yol biçimi rewrite kuralları gerektirir. Bağımsız listeler ayrı parametreler kullanır; bağlantılar dili, filtreleri ve sıralamayı korur.

## Sayfa boyutu, SEO ve filtreler

Öğe sayısını belirleyin, gerekirse 10/25/50/100/250 seçimini etkinleştirin. Boyut değişikliği listeyi ilk sayfaya döndürür. Noindex yalnızca ikinci sayfadan itibaren geçerlidir; başlık ve kanonik URL'yi kontrol edin. Filtreleri aynı listeye bağlayıp herkese açık sitede ikinci sayfayı ve filtrelenmiş sonucu test edin.

## page / count / pager

Smarty listesi için tüm öğeleri içeren değişkeni belirtin ve `{foreach}` döngüsünü koruyun: listeyi modül böler, ikinci bir `array_slice` eklemeyin. Değişken yoksa kapsayıcının HTML öğeleri sayfalanır; satır sınıfı veya `tr` etiketi seçilebilir, `thead` ve `tfoot` yerinde kalır. Geçerli sayfanın çevresindeki düğme sayısını masaüstü ve mobil için ayrı ayarlayın. Doğrudan PHP yollarında `?page=2` kullanın; `/page/2/` rewrite kuralları gerektirir. Sonraki sayfaların kendilerine ait canonical adresi vardır ve `noindex` alabilirler.

Birden fazla bağımsız liste varsa ilki `page`, `count` ve `sort` kullanır; diğerleri blok kimliği eklenmiş parametreleri kullanır. `/page/N/` yolunda `pager` sayının hangi listeye ait olduğunu belirtir. Smarty bloğunda `$zm_pagination` `total`, `page`, `pages`, `count` ve `offset` değerlerini sağlar. `count` 10–250 aralığına sınırlandırılır. Liste boşsa veya tek sayfaysa sayfalama paneli gizlenir.

## YYYY-MM-DD

Filtreler sayfalama ile aynı liste üzerinde çalışır. Metin araması virgülle ayrılmış birden fazla alanı denetleyebilir; tarih aralığı `YYYY-MM-DD` kullanır ve son günün tamamını kapsar.

## Flex / Grid

Flex veya Grid seçip cihazlara göre genişlik ve sütunları ayarlayın. Filtreyi uygulamak ya da temizlemek listeyi ilk sayfaya döndürür. Sonuç sayısı seçicisi bağlantısı kopmadan taşınabilir; kopya panel aynı listeyi yönetir.

## Talimatlar

- Öğe sayısı seçimi: 10, 25, 50, 100, 250
- 2. ve sonraki sayfaları dizine ekleme
- Bağlantı biçimi
- Varsayılan öğe sayısı
