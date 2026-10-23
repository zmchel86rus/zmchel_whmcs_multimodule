# Sitemap

## XML

Das XML enthält wechselseitige Links für aktive Sprachen und `x-default` für die Adresse der Standardsprache. Weiterleitungsquellen werden aus `loc` und Sprachalternativen ausgeschlossen; Ersatzinhalte behalten ihre tatsächliche Sprache. Die Seiten- und Beitragsdateien deklarieren den XHTML-Namensraum.

Der Generator liegt in `lib/sitemap.php`, Hilfsfunktionen in `inc/sitemap_manager.php`, der Hook `AfterCronJob` in `hooks/sitemap.php`. Bei deaktiviertem `ZM_PB_ENABLE_SITEMAP` gibt es weder Cron- noch manuelle Generierung.

Nach jedem Cron-Lauf werden aktuelle Zeit, `ZM_PB_SITEMAP_LASTUPD` und `ZM_PB_SITEMAP_UPDFREQ` verglichen. Ein leerer oder unbekannter Zeitraum bedeutet täglich. Die letzte **erfolgreiche** Erzeugung steht in `inc/editable_consts.php`. **Generieren** im `sitemap_manager` startet sofort.

Im Stammverzeichnis entstehen `sitemap_index.xml`, `sitemap_pages.xml` und `sitemap_posts.xml`. Ab 50.000 URLs oder 50 MB pro Kategorie folgen Dateien mit `_2`, `_3` usw. Der Index übernimmt andere gültige `urlset`-Dateien im Stammverzeichnis, verschachtelt aber keine Indizes. Das Modul verändert nur seine Seiten-/Beitragsdateien und den gemeinsamen Index, keine fremden Dateien.

Aufgenommen werden aktive, veröffentlichte, öffentlich zugängliche Seiten und Beiträge mit aktiven Sprachversionen. Veröffentlichung wird über `page.status = publish`, Sprachverfügbarkeit über `lang_active` bestimmt. `lang_status` veröffentlicht der Editor nicht und wird daher nicht geprüft. Überschriebene Systemseiten erscheinen unter ihrer öffentlichen Original-URL; der Slug der Layoutseite fehlt. Die Standardsprache erhält nur bei aktivierter optionaler Route ein Präfix; die anderen Sprachen folgen der Routing-Einstellung.

Eine leere Kategorie erzeugt keine Datei; ein allgemeines `sitemap.xml` wird nicht angelegt. Wenn nur der Index übrig bleibt, starten Sie die Erzeugung im Manager erneut. Schreibzugriff auf Website-Stamm, Modulordner `resources/` und `inc/editable_consts.php` ist nötig. Fehlende Tabellen müssen über **Moduldatenbank** angelegt werden. Bei Fehlern werden Dateien aus temporären Kopien wiederhergestellt; der Zeitpunkt der letzten erfolgreichen Erzeugung bleibt unverändert. Isolierter Test mit Projektabhängigkeiten und XML-, mbstring- und SQLite-Erweiterung: `php -d extension=pdo_sqlite tests/sitemap.php`.

## Anleitung

- Die automatische Erstellung läuft nach dem WHMCS-Cron, sobald ein Update fällig ist. Die manuelle Erstellung startet sofort.
- Aktive, für Gäste zugängliche Seiten und Beiträge einschließlich ihrer veröffentlichten Sprachversionen werden aufgenommen. Überschreibungen verwenden die öffentlichen URLs der ersetzten Seiten.
- Sitemaps erstellen
- Dateien im Website-Stammverzeichnis
- Letzte erfolgreiche Erstellung
- Nächste Aktualisierung frühestens
- Ohne Auswahl wird die Sitemap täglich aktualisiert.
- Bei Aktivierung wird unter /html-sitemap eine normale HTML-Sitemap angezeigt; sitemap.xml bleibt unverändert.
- **Aktualisierungsintervall** — Wenn leer, gilt der Standardwert 'monthly'.
- **Aktualisierungspriorität** — Wenn leer, gilt der Standardwert '0.5'.
