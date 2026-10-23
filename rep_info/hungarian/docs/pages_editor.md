# Oldalszerkesztő

- [Lapozás](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Strukturált adatok](module_structured_data.md)

## Tartalom és nyelvek

A Tartalom lapon válasszon nyelvet, majd húzzon GrapesJS-blokkokat a munkaterületre. Szerkessze a kiválasztott blokk szövegét, képeit és beállításait, majd mentse az adott nyelvet. Szakaszok, oszlopok, táblázatok, GYIK, harmonikák, kapcsolatfelvételi űrlapok, listák, lapozás, vendég-/ügyfélzónák és egyéni kód is rendelkezésre állnak. Másolja a szerkezetet vagy tartalmat másik nyelvre, és közzététel előtt fordítsa le a szövegeket.

Szép URL-ek és nyelvi útválasztás esetén az alapértelmezett nyelv csak a saját útvonal kikapcsolásakor használ `/contact/`, a többi nyelv például `/hu/contact/` előtagot használ. A Hivatkozás és Gomb blokkokban csak a webhely lefordított oldalainál engedélyezze az aktuális nyelv hozzáadását. Külső címek, fájlok, `mailto:`, `tel:` és fordítás nélküli WHMCS-útvonalak esetén kapcsolja ki. A hivatkozásokat több nyelven ellenőrizze.

## WHMCS

Az alapbeállításoknál ellenőrizze a nevet, slugot, típust, állapotot, hozzáférést és nyelveket. A WHMCS alapértelmezett nyelvét a modulban engedélyezni kell; a közzétett oldalnak a megjelenített nyelven is kell tartalom.

## SEO

Nyelvenként adja meg a címet és leírást, majd ellenőrizze a canonical, robots, Open Graph, morzsamenü és Schema értékeket. A webhelytérkép lapon állítsa be egy nyilvános, nem rendszeroldal gyakoriságát és prioritását. Mentés után ellenőrizze a nyilvános URL-t és XML-t.

## Kapcsolatfelvételi űrlap

Adjon hozzá **Kapcsolatfelvételi űrlap** blokkot. Válasszon **WHMCS-jegyet** és támogatási részleget, vagy **e-mailt** és címzettet; adja meg a címet, leírást, tárgyat és gombszöveget. Minden mezőhöz állítson nevet, típust, kötelezőséget és ellenőrzést. Vendég által küldött jegyhez a feladó nevének és e-mailjének szerepét viselő mezők szükségesek. Legördülő listában soronként egy lehetőség legyen, például `sales : Értékesítés`. Minden hozzájáruláshoz hozzon létre külön mezőt, és használja a WHMCS CAPTCHA-beállítását. Mentés után vendégként küldjön valódi próbaüzenetet; ellenőrizze a jegyet vagy kézbesítést, hibákat és űrlaptörlést. A szerkesztő zöld állapota nem bizonyít kézbesítést; ha a `mail()` hibázik, állítsa be a WHMCS SMTP-t.

## Útmutató

- Beágyazott flexelrendezésű konténer. Húzzon bele más blokkokat.
- Beágyazott CSS Grid-konténer. Húzzon bele más blokkokat.
- Beágyazott Bootstrap-körhinta. Húzzon bele blokkokat; mindegyik külön diává válik.
- Az e blokk alatti összes blokk csak bejelentkezett felhasználóknak jelenik meg. Csak Vegyes hozzáférési típusú oldalon működik.
- Az e blokk alatti összes blokk csak vendégeknek jelenik meg. Csak Vegyes hozzáférési típusú oldalon működik.
- **Oldal címe**
- **Metaleírás**
- **Kanonikus URL**
- **Robots** — index, follow / noindex, nofollow. A keresőmotoros indexelést szabályozza.
- **Schema típusa** — Kikapcsolva az oldalhoz nem jelenik meg a Schema.org JSON-jelölés.
