# Kostenloses Multimodul für WHMCS

**Erzeugen Sie vor der Verwendung unbedingt eigene Salt-Werte und tragen Sie diese in `module_init.php` ein: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` und `ZM_PB_NONCE_SALT`.** Das Modul wurde für **WHMCS 8.13.1** entwickelt und getestet; **Apache wird vollständig unterstützt (100 %)**. Es kann auch mit Nginx funktionieren; die Sprachführung auf der Startseite sollte dort gesondert geprüft und gegebenenfalls eingerichtet werden.

**ZMChel WHMCS Multimodule ist kostenlos.** Damit lassen sich Website-Inhalte im WHMCS-Administrationsbereich verwalten: mit visuellem Seiten- und Blockeditor, mehrsprachigen Inhalten, Menüs, Mediathek, SEO-Metadaten, XML-Sitemaps, Weiterleitungen, Rewrite-Regeln sowie Import und Export. Die [Anleitung](instruction.md) beschreibt die Bedienung.

## Geplante Weiterentwicklung

- Verschachtelte Seiten und Seitenkategorien bzw. Rubriken ergänzen.
- Den derzeitigen Monolithen in zusammenarbeitende Komponenten aufteilen.
- Eine Verwaltung der Zugriffsrechte für das Modul im Adminbereich einführen.
- Die Standardsprachen in `supported_langs.php` erweitern.
- Einen Codeeditor im Adminbereich zum Erstellen, Bearbeiten und Löschen von `.tpl`-Dateien des Moduls sowie zum Bearbeiten von Client-Themes der CMS einführen (ohne Admin-Theme).
- Einen Sprachmanager für Sprachdateien dieses Moduls, anderer Module und der CMS entwickeln.
- Den Medienmanager verbessern.
- Einen vollständigen, stärker optimierten SEO-Manager nach dem Vorbild von Yoast SEO für WordPress entwickeln.
- Mehrsprachige Sitemap-Erzeugung und eine HTML-Sitemap-Seite ergänzen.
- Nutzungsstatistiken zum Seitenmanager hinzufügen.

Dies sind **Pläne für die Zukunft, kein verbindlicher Fahrplan**.

## Idee vorschlagen

[Senden Sie eine E-Mail](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) mit dem Betreff „Предложение по мультимодулю“.
