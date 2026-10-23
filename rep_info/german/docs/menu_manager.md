# Menüverwaltung

Unter `menu_manager` lassen sich mehrere unabhängige Menüs anlegen. Seiten und Beiträge können gesucht und übernommen werden; außerdem sind eigene Links und Überschriften mit URL `#` möglich. Menüpunkte lassen sich ziehen, verschachteln und sortieren. Beschriftungen können übersetzt werden; weitere Optionen sind Titel, Beschreibung, CSS-Klassen, `rel`, Symbol, neues Fenster sowie Sichtbarkeit für Gäste oder angemeldete Kunden. Neue veröffentlichte Seiten können automatisch erscheinen. Ein Menü ergänzt oder ersetzt die WHMCS-Navigation auf Desktopgeräten, Mobilgeräten oder beiden.

Beim Löschen eines übergeordneten Punkts rücken seine Kinder auf dessen Ebene. Erlaubt sind höchstens 10 Ebenen und 300 Punkte. Menü und Struktur werden in einer Transaktion gespeichert.

## Positionen und Schalter

| WHMCS-Position | Schalter |
| --- | --- |
| `ClientAreaPrimaryNavbar` | `ZM_PB_ENABLE_MAINNAV` |
| `ClientAreaSecondaryNavbar` | `ZM_PB_ENABLE_SECONDARYNAV` |
| `ClientAreaPrimarySidebar` | `ZM_PB_ENABLE_MAINSIDEBAR` |
| `ClientAreaSecondarySidebar` | `ZM_PB_ENABLE_SECONDARYSIDEBAR` |

Die Schalter stehen in den Moduleinstellungen. Bei deaktivierter Position wird ihr Handler nicht geladen und fragt die Datenbank nicht ab. Ohne Zuweisung bleibt das WHMCS-Menü unverändert. Pro Position gilt ein Menü; dasselbe Menü kann mehreren Positionen zugewiesen werden. Eine neue Zuweisung übernimmt eine bereits belegte Position.

Desktop beginnt bei 768 px, Mobilansicht endet bei 767 px. Wird nur eine Ansicht ersetzt, bleibt die andere bei der WHMCS-Navigation. Standardthemen zeigen eine Untermenüebene; Moduldateien ergänzen tiefere Navbar-Ebenen. Die Sidebar verwendet aufklappbare Listen. Übergeordnete Links bleiben anklickbar und haben eine eigene Schaltfläche zum Aufklappen.

## Sprachen, URLs und Zugriff

Auf WHMCS-Systemrouten außerhalb von `ZM_PB_MAINSYSTEM_DEFAULT_PAGES`, etwa `clientarea.php`, gilt die gespeicherte Benutzersprache. Ein fehlendes URL-Präfix setzt sie nicht zurück; Profil und Sitzung werden beim Seitenaufruf nicht verändert. Modulseiten und überschreibbare Seiten folgen dagegen der URL-Sprache.

Bei eigenen Links kann **Sprache der Link-URL** die Adresse unverändert lassen, beispielsweise `/clientarea.php`; die Beschriftung bleibt übersetzbar. Die Option steht in `zm_pb_menu_items.localize_url` und wird exportiert. Bei älteren Installationen muss die Spalte über **Moduldatenbank** ergänzt werden.

Seitenlinks werden beim Ausgeben aus aktuellem Slug, URL-Einstellungen und veröffentlichten Übersetzungen berechnet. Die Standardsprache erhält ein Präfix, wenn ihre optionale Route aktiviert ist; sonst bleibt sie ohne Präfix. Einfache URLs verwenden `?m=zmchel_whmcs_multimodule&slug=...&lang=...`, ohne die Profilsprache zu ändern. Fehlt eine Übersetzung, wird die veröffentlichte Standardübersetzung verwendet. Leere Beschriftungen stammen aus übersetztem Breadcrumb oder Meta-Titel, danach aus dem Seitennamen. Externe URLs, `mailto:`, `tel:`, Anker und Systemdateien erhalten kein Sprachpräfix.

Entwürfe, gelöschte und für den Besucher gesperrte Seiten werden ausgeblendet. Ein verborgener Elternpunkt verbirgt seinen Zweig. Unsichere URL-Schemata und HTML in Beschriftungen werden serverseitig abgelehnt.

## Tabellen

`zm_pb_menus` enthält Einstellungen, `zm_pb_menu_items` die Struktur und `zm_pb_menu_locations` die Positionen. Das Schema liegt in `inc/menu_schema.php`; Erstellung, Reparatur und Entfernung erfolgen über **Moduldatenbank**, nicht im Menüeditor. Beim Deaktivieren werden Tabellen nur mit aktiviertem `db_action` entfernt. Ausgabe: `lib/menu.php`; Helfer: `inc/menu_manager.php`; Hooks: `hooks/menu.php`. Für Tests mit WHMCS und PDO SQLite: `tests/menu.php`, auch mit `--plain`.

## Anleitung

- Menü erstellen
- Fügen Sie Seiten, Beiträge oder eigene Links hinzu.
- Elemente ziehen, um sie neu anzuordnen. Über die übergeordnete Ebene oder die Schaltflächen die Verschachtelung festlegen.
- Sprache der aktuellen Seite verwenden
- Eingegebene URL unverändert verwenden
- Beschriftungen in anderen Sprachen
- Sichtbar für
- Geräte
- Pro Position kann ein Menü zugewiesen werden. Die Auswahl verschiebt eine bestehende Zuweisung von einem anderen Menü hierher.
- Elemente der obersten Ebene werden zu Spalten, untergeordnete Elemente zu Links. Für eine Überschrift ohne Link URL # verwenden.
- Menütabellen wurden noch nicht erstellt. Erstellen Sie sie unter „Moduldatenbank“.
