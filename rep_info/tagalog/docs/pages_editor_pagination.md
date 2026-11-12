# Pagination block

1. Ilagay ang block sa unahan o hulihan ng target na listahan. Gamitin ang **Select block on canvas** upang piliin ang Smarty block o container; dapat nasa labas ng target ang pagination.
2. Para sa Smarty, ipasok ang variable na may buong koleksiyon, gaya ng $items. Panatilihin ang karaniwang {foreach} sa template at huwag magdagdag ng pangalawang array_slice.
3. Piliin ang bilang ng item bawat pahina at mga button sa simula, dulo, at tabi ng kasalukuyang pahina para sa desktop at mobile. Maaaring maglagay ng pangalawang kontrol para sa parehong listahan.

## Mga link at maraming listahan

Maaaring pumili ang bawat block ng default ng module, /page/2/, o ?page=2. Kailangan ng wastong rewrite rules ang path form; query ang gamitin sa direktang PHP route. Nananatili sa link ang mga filter, sort, installation path, at language prefix. Ang unang listahan ay gumagamit ng page, count, at sort. Ang kasunod ay may suffix na target block ID; sa /page/N/, ipinapakita ng pager kung aling dagdag na listahan ang may-ari ng numero. Hindi gumagawa ng bagong listahan ang kinopyang kontrol.

## Pinagmumulan ng listahan

Kapag naka-bind sa Smarty variable, hinahati ng module ang koleksiyong available na sa pahinang iyon. Hindi ito kumukuha ng nawawalang record sa ibang source. Kung walang variable, hinahati nito ang HTML item sa napiling container. Maaaring tukuyin ang paulit-ulit na class o tag gaya ng tr; hindi gagalawin ang thead at tfoot. Sa malaking dynamic list, gumamit ng variable para hindi muna i-render ang lahat. Natatanggap ng Smarty block ang $zm_pagination na may total, page, pages, count, at offset. Nawawala ang kontrol kapag walang laman o kasya sa isang pahina.

## Laki ng pahina, SEO, at filter

May opsyonal na selector para sa 10, 25, 50, 100, at 250 item. Kapag binago ito, nananatili ang filter at babalik sa unang pahina ang partikular na listahan. Nililimitahan ng backend ang count at count_<id> sa 10–250. Nagkakaroon ng numero ang pamagat, paglalarawan, at huling breadcrumb ng sumunod na pahina; tumuturo ang canonical sa mismong resulta. Ang noindex ay para lamang sa mga pahina pagkatapos ng una. Maaaring maghanap ang text filter sa maraming field na pinaghihiwalay ng kuwit at sa susi ng array. Ang date range ay gumagamit ng YYYY-MM-DD at sumasaklaw sa buong huling araw.

## Petsa YYYY-MM-DD

Gumagana ang filter sa kaparehong listahan ng pagination. Kapag inilapat o inalis, ang listahang iyon lang ang babalik sa unang pahina. Suriin ang URL upang matiyak na nananatili ang wika at pag-uuri.

## Ayos na Flex / Grid

Itakda ang lapad at bilang ng column ayon sa laki ng device. Maaaring ilipat ang page-size selector sa ibang container nang hindi nawawala ang ugnay nito. Magkapareho ang aktibong filter at laki ng pahina sa mga duplicated control.
