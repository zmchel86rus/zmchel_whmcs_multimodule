# zmchel WHMCS Multimodule: útmutató

**A modul használata előtt hozzon létre egyedi sókat, és helyezze el őket a `module_init.php` fájlban**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` és `ZM_PB_NONCE_SALT`.

**Az első használat előtt nyissa meg a Modulbeállítások → Támogatott nyelvek menüt, és kapcsolja be a szükséges nyelveket.**

A modult a **WHMCS 8.13.1–8.13.7** verzióival fejlesztették és tesztelték; a PHP-kompatibilitást a **7.4–8.5** verziókon ellenőrizték. Az Apache teljes mértékben támogatott. A Nginx is működhet, de a kezdőlap nyelvi útválasztása további beállítást igényelhet. **A modul ingyenes.**

## Nyelvkezelő (fejlesztés alatt)

A WHMCS adminfelületén nyissa meg a Nyelvkezelőt, majd válasszon részt (WHMCS ügyfél- vagy adminnyelvek, ez vagy más modul) és nyelvet. Hasonlítsa össze az eredetit vagy a referenciát a fordítással, módosítson egy sort, majd mentse; a meglévő kulcsok JSON-ként exportálhatók és importálhatók. Az új nyelvek a fordításig a referenciát használják. A kezelő nyelvi fájlokat kapcsol be és ki, és javítja a régi fájlneveket; előbb a WHMCS-ben módosítsa az alapértelmezett nyelvet.

→ [Nyelvkezelő](../english/docs/language-manager.md) (English)

## Hozzáférés és oldalak

A WHMCS adminisztrációjában nyissa meg az **Addons → zmchel WHMCS Multimodule** részt. Az oldalak listájában létrehozhat, kereshet, szerkeszthet és törölhet oldalakat. A *slug* a cím domain utáni része, például a `/contact/` címben a `contact`. URL-ek, átirányítások vagy kiszolgálói szabályok módosítása előtt exportálja a modulbeállításokat.

Új oldalhoz adjon meg belső nevet és latin betűkből, számokból és kötőjelekből álló slugot domain és `.php` nélkül. Válasszon hozzáférést vendégeknek, bejelentkezett ügyfeleknek vagy mindenkinek. Ezután válasszon állapotot (piszkozat, közzétett, halasztott vagy kuka), típust (oldal, cikk vagy rendszeroldal) és nyelveket. A WHMCS alapértelmezett nyelvének szerepelnie kell a `supported_langs.php` fájlban; a modul automatikusan hozzáadja.

Mentés után nyissa meg az oldalt, és szerkessze a **fő beállításokat**, a **tartalmat**, a **metaadatokat** és a **webhelytérkép** beállításait. Minden űrlapnak saját Mentés gombja van; az „Összes mentése” mindet feldolgozza. Ellenőrizze a sikerüzeneteket és a nyilvános oldalt. A törlés először a kukába helyezi az oldalt; a végleges törlés onnan történik.

## Tartalom és nyelvek

A Tartalom lapon válasszon nyelvet, majd húzzon GrapesJS-blokkokat a munkaterületre. Szerkessze a kiválasztott blokk szövegét, képeit és beállításait, majd mentse az adott nyelvet. Szakaszok, oszlopok, táblázatok, GYIK, harmonikák, kapcsolatfelvételi űrlapok, listák, lapozás, vendég-/ügyfélzónák és egyéni kód is rendelkezésre állnak. Másolja a szerkezetet vagy tartalmat másik nyelvre, és közzététel előtt fordítsa le a szövegeket.

Szép URL-ek és nyelvi útválasztás esetén az alapértelmezett nyelv `/contact/`, a többi nyelv például `/hu/contact/` előtagot használ. A Hivatkozás és Gomb blokkokban csak a webhely lefordított oldalainál engedélyezze az aktuális nyelv hozzáadását. Külső címek, fájlok, `mailto:`, `tel:` és fordítás nélküli WHMCS-útvonalak esetén kapcsolja ki. A hivatkozásokat több nyelven ellenőrizze.

## SEO, média és menük

Minden nyelvnél töltse ki a Metaadatok lapon a címet, leírást, közösségi képet, kanonikus URL-t, robots-beállításokat és a Schema típusát. A közzétett, nem rendszeroldalak bekerülhetnek az XML-webhelytérképbe. A médiakezelőben töltsön fel képeket, adjon meg hasznos helyettesítő szöveget, és optimalizálás után ellenőrizze a minőséget.

A Menükezelőben hozzon létre menüt, adjon hozzá oldalakat vagy egyéni hivatkozásokat, rendezze az elemeket, majd állítsa be a helyet és a láthatóságot. Egy helyhez egy menü rendelhető. WHMCS-oldal lecseréléséhez előbb tegye közzé az új oldalt, állítsa be a felülírást az oldalak listájában, és tesztelje az eredeti WHMCS URL-t vendégként és bejelentkezett ügyfélként.

## Webhelyeszközök

Az Átirányításkezelőben adjon meg forrást és célt: végleges áthelyezéshez `301`, ideigleneshez `302`. Az átíráskezelő a szép URL-ek szabályait kezeli. Generálja a webhelytérképeket, és ellenőrizze a `sitemap_index.xml` fájlt. A modulbeállítások a menüket, a Smarty-t, a karbantartást és az importálást/exportálást is kezelik. A JSON-export nem helyettesíti a teljes WHMCS-biztonsági mentést.

A kapcsolatfelvételi űrlap WHMCS-támogatási jegyet vagy e-mailt küldhet. Állítsa be a mezőket, a címzettet vagy támogatási osztályt, a hozzájárulásokat és a CAPTCHA-t, majd végezzen valódi próbaküldést. Hiányzó modultáblák esetén használja a Moduladatbázis részt.

## További dokumentáció (English)

[Menük](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Lapozás](../english/docs/pagination.md) · [Webhelytérképek](../english/docs/sitemaps.md) · [Átirányítások](../english/docs/redirects.md) · [Strukturált adatok](../english/docs/structured-data.md) · [Importálás és exportálás](../english/docs/transfer.md).
