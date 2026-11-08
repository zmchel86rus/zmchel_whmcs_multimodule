# Kostenloses Multimodul für WHMCS

**ZMChel WHMCS Multimodule ist kostenlos.** Damit lassen sich Website-Inhalte im WHMCS-Administrationsbereich verwalten: mit visuellem Seiten- und Blockeditor, mehrsprachigen Inhalten, Menüs, Mediathek, SEO-Metadaten, XML-Sitemaps, Weiterleitungen, Rewrite-Regeln sowie Import und Export. Die [Anleitung](instruction.md) beschreibt die Bedienung.

## Vor der ersten Verwendung

**Öffnen Sie vor der ersten Verwendung Moduleinstellungen → Unterstützte Sprachen und aktivieren Sie die benötigten Sprachen.**

Bei jeder Aktivierung erzeugt das Modul automatisch neue Salt-Werte und schreibt sie in `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Prüfen Sie, ob alle drei Salt-Werte gesetzt sind.

Das Modul wurde für **WHMCS 8.13.0–9.1.0** entwickelt und getestet; **Apache wird vollständig unterstützt (100 %)**. Es kann auch mit Nginx funktionieren; die Sprachführung auf der Startseite sollte dort gesondert geprüft und gegebenenfalls eingerichtet werden.

**Geprüfte PHP-Versionen:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 und 8.5. Alle PHP-Dateien haben die Syntaxprüfung mit jeder Version bestanden; zusätzlich wurden eigenständige Tests ausgeführt.

## Geplante Weiterentwicklung

- Verschachtelte Seiten und Seitenkategorien bzw. Rubriken ergänzen.
- Den derzeitigen Monolithen in zusammenarbeitende Komponenten aufteilen.
- Eine Verwaltung der Zugriffsrechte für das Modul im Adminbereich einführen.
- Die Standardsprachen in `supported_langs.php` erweitern.
- Einen Codeeditor im Adminbereich zum Erstellen, Bearbeiten und Löschen von `.tpl`-Dateien des Moduls sowie zum Bearbeiten von Client-Themes der CMS einführen (ohne Admin-Theme).
- ~~Einen Sprachmanager für Sprachdateien dieses Moduls, anderer Module und der CMS entwickeln.~~
- Den Medienmanager verbessern.
- Einen vollständigen, stärker optimierten SEO-Manager nach dem Vorbild von Yoast SEO für WordPress entwickeln.
- ~~Mehrsprachige Sitemap-Erzeugung und eine HTML-Sitemap-Seite ergänzen.~~
- Eine HTML-Sitemap-Seite hinzufügen.
- Nutzungsstatistiken zum Seitenmanager hinzufügen.
- Einen Optimierungsmanager für die Minifizierung von JS, CSS und HTML, einen vom Modul erzeugten Ganzseiten-Cache sowie die Optimierung der Datenbanktabellen des Moduls und von WHMCS ergänzen.
- Ein zuverlässiges Update-System für das Modul entwickeln.

Dies sind **Pläne für die Zukunft, kein verbindlicher Fahrplan**.

## Idee vorschlagen

[Senden Sie eine E-Mail](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) mit dem Betreff „Предложение по мультимодулю“.

## Frage stellen

[Senden Sie Ihre Frage per E-Mail](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) mit dem Betreff „Задать вопрос по модулю“.
