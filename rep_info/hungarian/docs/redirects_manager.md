# Átirányítások

Pontos címek: forrás → cél. A forrás a webhely gyökerétől számított elérési út vagy a webhelyen belüli URL. A cél elérési út vagy teljes HTTP(S)-URL lehet. A lekérdezési paraméterek nélküli szabály a paraméterekkel érkező kérésekre is illeszkedik; a cél a megadott formában kerül felhasználásra. A szabályok a WHMCS-hez eljutó GET/HEAD kérésekre érvényesek.

Alapértelmezés: 14 nap. A közzétett oldal vagy aktív fordításai utolsó módosításától, módosítás hiányában a létrehozástól számítva. Késleltetés nélkül állítsa 0-ra. Az automatikus szabályok HTTP 301-et használnak.

A felülírt oldalak címei automatikusan az általuk helyettesített rendszeroldalakra irányítanak. Ha egy felülíráshoz több cél tartozik, az elsőként beállítottat használja a rendszer. Ezek az átirányítások a felülírások engedélyezésekor az Átirányításkezelő szabályaitól függetlenül működnek.

Adjon meg egy érvényes, / jellel kezdődő elérési utat vagy teljes HTTP(S)-URL-t. A forrásnak ehhez a webhelyhez kell tartoznia; a # töredékazonosítók nem támogatottak.

## HTTP

A szabályok a `301`, `302`, `303`, `307`, `308` HTTP-kódokat támogatják, és csak a WHMCS-hez eljutó `GET`/`HEAD` kérésekre érvényesek. A forrás pontosan az útvonalhoz és a megadott lekérdezési paraméterekhez illeszkedik; a cél paraméterei felülírják a régieket. A kezelő a `zm_pb_redirects` táblában tárolja a szabályokat, de kérés közben nem hozza létre a táblát: használja a **Modul adatbázisa** részt. A meglévő URL-oszlopok korlátja 128 bájt.

A kézi szabályok megelőzik az automatikusakat. Egy közzétett oldal slugjának módosítása a beállított várakozás után automatikus `301` átirányítást hozhat létre minden aktív nyelvhez; piszkozat közzététele nem. A későbbi átnevezések frissítik a régi célokat. A lekérdezési paramétereket tartalmazó szabály megelőzi a csak útvonalra vonatkozót. A forrás URL-nek ehhez a webhelyhez kell tartoznia, és nem tartalmazhat `#` töredéket.

## Útmutató

- Forrás
- Cél
- Engedélyezve
- Letiltva
