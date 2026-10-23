# Menük

Hozzon létre menüt, adjon hozzá oldalakat vagy egyéni hivatkozásokat, majd húzással rendezze az elemeket. Almenühöz válasszon szülőelemet; állítsa be a nyelvenkénti feliratokat, a vendégek vagy ügyfelek számára való láthatóságot és az eszközöket. Rendeljen hozzá helyet; egy helyen csak egy menü lehet. A belső linkeknél döntse el, kövesse-e az URL az aktuális nyelvet. Ellenőrizze a nyilvános menüt számítógépen és telefonon.

Minden menüponthoz megadható cím, leírás, CSS-osztály, `rel`, ikon és új lapon való megnyitás; a közzétett oldalak automatikusan is hozzáadhatók. Asztali és mobil nézethez külön válassza ki, hogy a menü kiegészítse vagy lecserélje a WHMCS navigációját. A moduloldal hivatkozása az aktuális slug, nyelv és URL-mód alapján újraszámolódik; az üres címke a lefordított címet vagy az oldal nevét használja. Az oldal megnyitása nem módosítja az ügyfél profilnyelvét. A szerver elutasítja a nem biztonságos URL-sémákat és a címkékben lévő HTML-t.

## WHMCS

A modul beállításaiban engedélyezze a kívánt WHMCS-menühelyeket. Egy helyhez egy menü rendelhető, ugyanaz a menü viszont több helyen is használható. Az asztali nézet legalább 768 px szélességnél, a mobilnézet keskenyebb képernyőn érvényes. A kikapcsolt helyen a WHMCS alapmenüje változatlan marad.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

A WHMCS olyan rendszerútvonalain, ahol a modul nem irányít nyelv szerint, a menücímkék az ügyfél mentett nyelvét használják; a moduloldalak az URL nyelvét. Ha az alapértelmezett nyelv saját útvonalat kap, az is előtagot kap. Az egyszerű URL alakja `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Egyéni hivatkozás lokalizálás nélkül is maradhat, például `clientarea.php`. A szülő elrejtése az egész ágat elrejti.

Az oldalbejegyzések URL-je az aktuális slug és a közzétett fordítás alapján újra létrejön. Ha nincs fordítás, az alapértelmezett nyelv közzétett változata jelenik meg. Egyéni hivatkozásnál megtartható a megadott URL; külső címek, mailto, tel és horgonyok nem kapnak nyelvi előtagot. Piszkozatok, törölt és hozzáférhetetlen oldalak nem jelennek meg.

## zm_pb_menus

Az adatok a `zm_pb_menus`, `zm_pb_menu_items` és `zm_pb_menu_locations` táblákban vannak. A táblákat a Modul adatbázisa részben hozza létre vagy javítsa. A fa legfeljebb 10 szintet és 300 elemet kezel; egy szülő törlésekor a gyermekei egy szinttel feljebb kerülnek.

## Útmutató

- Menü létrehozása
- Adjon hozzá oldalakat, bejegyzéseket vagy egyéni hivatkozásokat.
- Az elemeket húzással rendezheti át. Az alá-fölérendeltséget a szülőelem-választóval vagy a mozgatógombokkal állíthatja be.
- Az aktuális oldal nyelvének használata
- A megadott URL változatlan használata
- Feliratok más nyelveken
- Kik láthatják?
- Eszközök
- Minden megjelenítési helyhez egy menü rendelhető. Egy hely kiválasztása áthelyezi ide a hozzárendelést egy másik menüből.
- A legfelső szintű elemek oszlopokká, az alárendelt elemek hivatkozásokká válnak. Hivatkozás nélküli címsorhoz használja a # URL-t.
- A menütáblák még nem jöttek létre. Adja hozzá őket a Moduladatbázisban.

