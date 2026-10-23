# URL-átírási szabályok

## WHMCS

Nyelvi URL-ekre vonatkozó szabályok, beleértve a /ru/, /en/ és más előtagok alatti oldalakat. A nyelvek a supported_langs.php fájlból származnak; a szabályok a WHMCS szabályai elé kerülnek a .htaccess fájlban.

Az Nginx nem olvassa a .htaccess fájlt, ezért ezek a szabályok nem működnek benne. Állítson be megfelelő szabályokat az nginx konfigurációjában.

nginx → Apache konfiguráció észlelve. Ezek a szabályok csak az Apache-hoz továbbított kérésekre működnek; az nginx nem olvassa a .htaccess fájlt.

Szabály hozzáadása vagy törlése után kattintson a „Szabályok hozzáadása vagy frissítése” gombra a változtatások .htaccess fájlra alkalmazásához.

## .htaccess

Nyissa meg a kezelőt, és hasonlítsa össze a szabályokat a webhely fő `.htaccess` fájljával. Saját szabálynál mentse az URL-mintát, a célt és a jelzőket, majd válassza a **Szabályok hozzáadása vagy frissítése** műveletet, hogy a blokk a WHMCS-szabályok elé kerüljön. Ellenőrizze újra az állapotot, és nyisson meg egy közzétett oldalt az alapnyelven és egy másikon. A túl tág minta más oldalakat is érinthet. Nginx → Apache esetén csak az Apache-nak átadott kérésekre érvényes.

## Útmutató

- Szabályok ellenőrzése
- Szabályok hozzáadása vagy frissítése
- Az összes szabály eltávolítása a .htaccess fájlból
- URL-minta
- Cél
- Jelzők
