# Smarty

- **Modül ayarları → Smarty değişkenlerini topla → Toplanan Smarty değişkenlerini kullan → Sayfa düzenleyicisi.**

## Değişken kataloğu

Modül ayarlarında Smarty değişkenlerini toplama ve kullanmayı etkinleştirin; ardından ilgili site sayfalarını açıp düzenleyiciyi yenileyin. Katalog, değişken adlarını, türlerini ve yapısını saklar; gerçek değerleri veya kişisel verileri saklamaz. Bir değişken eksikse kullanıldığı sayfayı yeniden ziyaret edin.

## Düzenleyici ve sınırlar

Sayfa düzenleyicisinde Smarty bloğunu açıp katalogdan değişken seçin. İzin verilen koşulları ve döngüleri kullanın; dinamik metin gösterirken `|escape` ekleyin. PHP, SQL, yöntem çağrıları, dosya ekleme ve `nofilter` yasaktır. Sayfayı kaydedip herkese açık sonucu kontrol edin.

## resources/available_vars/

Katalog yalnızca bir sayfada gözlenen değişkenler için kılavuzdur: onları başka bir sayfada kullanılabilir hâle getirmez. Kod kaydedilirken ve gösterilmeden önce denetlenir; blok izin verilen değerlerin yalıtılmış kopyasını alır. Koşullar, `foreach`, yerel `assign` ve `escape`, `default`, `count`, `date_format` gibi değiştiriciler kullanılabilir. Çıktı değerleri otomatik olarak escape edilir; istenen HTML'i şablonda yazın. Veri eksikse veya kod başarısızsa blok boş kalır, hata PHP günlüğüne yazılır.

`resources/available_vars/` içindeki katalog adları, türleri, yapıyı ve yapay örnekleri saklar; gerçek değerleri saklamaz. Değişkenin nerede görüldüğünü gösterir ancak başka sayfada kullanılabilir kılmaz. Smarty bloğunu çift tıklayarak düzenleyiciyi açın. `Ctrl+Space` değişken arar, `Ctrl+S` kodu uygular, `F11` tam ekranı açar. Kod yalıtılmış olarak çalışır; veri yoksa blok boş kalır ve uyarı PHP günlüğüne yazılır.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Talimatlar

- **Smarty değişkenlerini topla** — Smarty değişkenlerinin toplanmasını etkinleştirin veya devre dışı bırakın.
- **Toplanan Smarty değişkenlerini kullan** — Toplanan Smarty değişkenlerinin sayfa düzenleyicisinde kullanılmasını etkinleştirin veya devre dışı bırakın.
- Smarty (PHP) değişkeni
- Smarty: PHP, nesne metotları, statik çağrılar ve nofilter yasaktır.
- Smarty şablonu çok büyük.
- Smarty
- Smarty düzenleyicisi

