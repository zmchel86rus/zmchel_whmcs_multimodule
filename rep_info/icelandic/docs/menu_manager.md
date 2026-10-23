# Valmyndir

Búðu til valmynd, bættu við síðum eða eigin tenglum og raðaðu atriðunum með því að draga þau. Veldu yfiratriði fyrir undirvalmynd og stilltu heiti eftir tungumáli, sýnileika fyrir gesti eða viðskiptavini og tæki. Úthlutaðu staðsetningu; hver staðsetning getur haft aðeins eina valmynd. Veldu hvort innri tenglar eigi að fylgja núverandi tungumáli. Athugaðu opinberu valmyndina á tölvu og síma.

Fyrir hvert atriði má stilla titil, lýsingu, CSS-klasa, `rel`, tákn og opnun í nýjum flipa; einnig er hægt að bæta birtum síðum sjálfkrafa við. Veldu sérstaklega fyrir tölvu og síma hvort valmyndin bæti við leiðsögn WHMCS eða komi í stað hennar. Tengill á síðu einingarinnar er reiknaður aftur út frá núverandi slug, tungumáli og URL-stillingu; tómt heiti notar þýddan titil eða nafn síðunnar. Heimsókn á síðu breytir ekki tungumáli viðskiptavinar í prófíl. Þjónninn hafnar óöruggum URL-skema og HTML í heitum.

## WHMCS

Virkjaðu viðeigandi staðsetningar WHMCS-valmynda í stillingum einingarinnar. Hver staðsetning tekur við einni valmynd en sama valmynd má birtast á fleiri en einum stað. Tölvuútlit gildir frá 768 px breidd og farsímaútlit á mjórri skjám. Óvirk staðsetning breytir ekki sjálfgefnu WHMCS-valmyndinni.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Á kerfisleiðum WHMCS án tungumálabeiningar einingarinnar nota heiti valmyndar vistað tungumál viðskiptavinar; síður einingarinnar nota tungumál URL-slóðarinnar. Ef sjálfgefið tungumál fær eigin leið fær það einnig forskeyti. Einföld URL-slóð er `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Sérsniðinn tengill getur verið án staðfærslu, til dæmis `clientarea.php`. Falin yfirfærsla felur alla greinina.

Slóð síðufærslu er reiknuð aftur út frá núverandi slug og birtri þýðingu. Vanti þýðingu er birta útgáfan á sjálfgefnu tungumáli notuð. Sérsniðinn tengill getur haldið uppgefinni URL óbreyttri; ytri slóðir, mailto, tel og akkeri fá ekki tungumálaforskeyti. Drög, eyddar síður og síður án aðgangs birtast ekki.

## zm_pb_menus

Gögnin eru í töflunum `zm_pb_menus`, `zm_pb_menu_items` og `zm_pb_menu_locations`. Búðu til eða lagaðu töflurnar í gagnagrunnshluta einingarinnar. Tréð leyfir mest 10 stig og 300 atriði; þegar yfiratriði er eytt færast undiratriðin upp um eitt stig.

## Leiðbeiningar

- Búa til valmynd
- Bættu við síðum, færslum eða sérsniðnum tenglum.
- Dragðu atriði til að breyta röð þeirra. Stilltu stigskipan með vali á yfireiningu eða færsluhnöppunum.
- Nota tungumál núverandi síðu
- Nota skráðu vefslóðina óbreytta
- Merkingar á öðrum tungumálum
- Sýnilegt fyrir
- Tæki
- Á hverri staðsetningu getur aðeins verið ein valmynd. Ef staðsetning er valin færist úthlutun hennar hingað frá annarri valmynd.
- Atriði á efsta stigi verða að dálkum og undiratriði að tenglum. Notaðu vefslóðina # fyrir fyrirsögn án tengils.
- Valmyndatöflurnar hafa ekki verið búnar til. Bættu þeim við í Gagnagrunni einingarinnar.
