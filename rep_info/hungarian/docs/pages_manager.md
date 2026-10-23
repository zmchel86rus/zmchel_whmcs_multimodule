# Oldalkezelő

## Hozzáférés és oldalak

A WHMCS adminisztrációjában nyissa meg az **Addons → zmchel WHMCS Multimodule** részt. Az oldalak listájában létrehozhat, kereshet, szerkeszthet és törölhet oldalakat. A *slug* a cím domain utáni része, például a `/contact/` címben a `contact`. URL-ek, átirányítások vagy kiszolgálói szabályok módosítása előtt exportálja a modulbeállításokat.

Új oldalhoz adjon meg belső nevet és latin betűkből, számokból és kötőjelekből álló slugot domain és `.php` nélkül. Válasszon hozzáférést vendégeknek, bejelentkezett ügyfeleknek vagy mindenkinek. Ezután válasszon állapotot (piszkozat, közzétett, halasztott vagy kuka), típust (oldal, cikk vagy rendszeroldal) és nyelveket. A WHMCS alapértelmezett nyelvének szerepelnie kell a `supported_langs.php` fájlban; a modul automatikusan hozzáadja.

Mentés után nyissa meg az oldalt, és szerkessze a **fő beállításokat**, a **tartalmat**, a **metaadatokat** és a **webhelytérkép** beállításait. Minden űrlapnak saját Mentés gombja van; az „Összes mentése” mindet feldolgozza. Ellenőrizze a sikerüzeneteket és a nyilvános oldalt. A törlés először a kukába helyezi az oldalt; a végleges törlés onnan történik.

## URL

Szűrje a listát név, hozzáférés, típus, állapot vagy nyelv szerint. A **Megtekintés** megnyitja a nyilvános URL-t. A **Törlés** először a kukába helyezi az oldalt; a végleges törlés ott történik. Ha az oldal nem nyílik meg, ellenőrizze a közzétételt, az aktív nyelvet és a hozzáférést.

## WHMCS

WHMCS-oldal helyettesítéséhez válassza ki a meglévő rendszer URL-jét és a modul közzétett oldalát. Választhat teljes cserét, az eredeti tartalom elé vagy mögé beszúrást, illetve csak meta/SEO módosítást. Mentés után próbálja ki az eredeti WHMCS URL-t vendégként és bejelentkezett ügyfélként.

## Útmutató

- Oldal hozzáadása
- **Oldal neve** — Az oldal belső neve
- **Oldal slugja** — Csak latin betűk, kötőjelek és számjegyek engedélyezettek.
- **Hozzáférés típusa** — Bejelentkezett felhasználók: az oldalt csak bejelentkezett felhasználók érhetik el; Vendégek: csak a vendégek férhetnek hozzá; Vegyes: mindenki elérheti, a láthatóságot pedig az oldalon belüli blokkok szabályozzák.
- **Oldal típusa** — A rendszeroldalak nem szerepelnek a webhelytérképben, és a normál felhasználók számára nem érhetők el.
- **Az oldal nyelvei** — Az alapértelmezett nyelv a választásától függetlenül mindig szerepel.
- A teljes felülírás lecseréli a megjelenített tartalmat és metaadatokat.\ A „Beszúrás elé” a meglévő oldaltartalom elé helyezi a tartalmat.\ A „Beszúrás utána” a meglévő oldaltartalom után helyezi a tartalmat.\ A „Csak metaadatok/SEO” kizárólag az oldal metaadatait cseréli le.
- Navigáció az oldalak listájában
