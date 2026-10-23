# Webhelytérképek

Az automatikus generálás a WHMCS cron-futtatása után indul, ha esedékes a frissítés. A kézi generálás azonnal elindul.

A vendégek számára elérhető aktív oldalak és bejegyzések, közzétett nyelvi változataikkal együtt, bekerülnek a webhelytérképbe. A felülírások az általuk helyettesített oldalak nyilvános URL-jeit használják.

Bekapcsolva a /html-sitemap normál HTML-oldalként jeleníti meg a webhelytérképet; a sitemap.xml változatlan marad.

## XML

Az XML kölcsönös hivatkozásokat tartalmaz az aktív nyelvekhez, és `x-default` jelölést az alapértelmezett nyelv címéhez. Az átirányítások forrásai nem kerülnek a `loc` mezőbe vagy a nyelvi alternatívák közé; a helyettesítő fordítás a tartalom tényleges nyelvét kapja. Az oldal- és bejegyzésfájlok deklarálják az XHTML névteret.

Az `AfterCronJob` hook a `ZM_PB_SITEMAP_UPDFREQ` időközt a legutóbbi sikeres létrehozás `ZM_PB_SITEMAP_LASTUPD` idejéhez méri; kikapcsolt oldaltérképnél a kézi létrehozás sem elérhető. A nyelvi változatokat a `lang_active`, nem a `lang_status` alapján választja. A további részek `_2`, `_3` stb. utótagot kapnak. Hiba esetén a korábbi fájlok visszaállnak, a siker ideje nem változik. Ellenőrizze az írást a gyökérbe, a `resources/` könyvtárba és az `inc/editable_consts.php` fájlba; a táblákat külön a modul adatbázisában javítsa.

Az automatikus előállítás a WHMCS cron feladatától és a beállított időköztől függ; a gomb azonnal elindítja. Csak a vendégek számára elérhető, közzétett oldalak és bejegyzések, valamint aktív fordításaik kerülnek bele. Ha egy oldal rendszeroldalt ír felül, a rendszeroldal nyilvános URL-je szerepel, nem a helyettesítő slugja. Az 50 000 URL-t vagy 50 MB-ot meghaladó fájlok több részre oszlanak. Az index megőrzi a többi érvényes oldaltérképet.

A modul a webhely gyökérkönyvtárába írja a `sitemap_index.xml`, `sitemap_pages.xml` és `sitemap_posts.xml` fájlokat; üres kategóriához nem készül fájl. Összevont `sitemap.xml` nem jön létre. Oldal- vagy nyelvváltozás után készítse el újra a térképeket, és nyissa meg az indexet a böngészőben. Hiba esetén ellenőrizze a gyökérkönyvtár írási jogát; az utolsó sikeres generálás ideje nem változik.

## Útmutató

- Webhelytérképek generálása
- Fájlok a webhely gyökérkönyvtárában
- Utolsó sikeres generálás
- Következő frissítés legkorábban
- Ha nincs kiválasztva semmi, a webhelytérkép naponta frissül.
- **Frissítési gyakoriság** — Ha üres, az alapértelmezett érték: 'monthly'.
- **Frissítési prioritás** — Ha üres, az alapértelmezett érték: '0.5'.
