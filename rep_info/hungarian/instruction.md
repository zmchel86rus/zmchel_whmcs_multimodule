# zmchel WHMCS Multimodule: útmutató

**A modul használata előtt hozzon létre egyedi sókat, és helyezze el őket a `module_init.php` fájlban**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` és `ZM_PB_NONCE_SALT`.

**Az első használat előtt nyissa meg a Modulbeállítások → Támogatott nyelvek menüt, és kapcsolja be a szükséges nyelveket.**

A modult a **WHMCS 8.13.1–8.13.7** verzióival fejlesztették és tesztelték. A PHP-kompatibilitást a **7.4–8.5** verziókon ellenőrizték. Az Apache teljes mértékben támogatott. A modul Nginx alatt is működhet, de a kezdőlap nyelvi útválasztása további beállítást igényelhet.

**A zmchel WHMCS Multimodule ingyenes.** Vizuális oldalszerkesztőt, többnyelvű tartalmat, menüket, médiatárat, SEO-mezőket, XML-webhelytérképeket, átirányításokat, átírási szabályokat, valamint importálást és exportálást kínál.

## Modulbeállítások

Válassza ki a modul által használható nyelveket. A kikapcsolás nem törli a tartalmat.

- **Modulbeállítások → Támogatott nyelvek → Bekapcsolás**
- **Moduladatbázis → Javítás Kiválasztott elemek**
- **URL-átírási szabályok → Szabályok ellenőrzése → Szabályok hozzáadása vagy frissítése**

Az Nginx nem olvassa a .htaccess fájlt, ezért ezek a szabályok nem működnek benne. Állítson be megfelelő szabályokat az nginx konfigurációjában.

## Oldalkezelő

- **Oldal hozzáadása → Oldal neve → Oldal slugja → Mentés**
- **Oldalszerkesztő → Tartalombeállítások → Metaadat-beállítások → Az oldal webhelytérkép-beállításai → Összes mentése**
- **Oldalkezelő → Megtekintés**
- **Webhelytérkép → Webhelytérképek generálása**

Csak latin betűk, kötőjelek és számjegyek engedélyezettek.

Bejelentkezett felhasználók: az oldalt csak bejelentkezett felhasználók érhetik el; Vendégek: csak a vendégek férhetnek hozzá; Vegyes: mindenki elérheti, a láthatóságot pedig az oldalon belüli blokkok szabályozzák.

Az automatikus generálás a WHMCS cron-futtatása után indul, ha esedékes a frissítés. A kézi generálás azonnal elindul.

## Útmutatók szakaszonként

- [Oldalkezelő](docs/pages_manager.md)
- [Oldalszerkesztő](docs/pages_editor.md)
- [Médiakezelő](docs/media_manager.md)
- [Menük](docs/menu_manager.md)
- [Nyelvkezelő](docs/langs_manager.md)
- [Átirányítások](docs/redirects_manager.md)
- [Webhelytérképek](docs/sitemap_manager.md)
- [URL-átírási szabályok](docs/rewrite_manager.md)
- [Modulbeállítások](docs/module_settings.md)
- [Moduladatbázis](docs/module_db.md)

## További anyagok

- [Lapozás](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Strukturált adatok](docs/module_structured_data.md)
- [Importálás és exportálás](docs/module_settings_transfer.md)
