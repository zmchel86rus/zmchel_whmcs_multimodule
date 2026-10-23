# Seitenmanager

## Seite erstellen und veröffentlichen

1. Öffnen Sie **Seitenliste → Seite hinzufügen**. Geben Sie einen internen Namen und einen Slug aus lateinischen Buchstaben, Ziffern und Bindestrichen ein, z. B. `about-us`. Domain, Sprachpräfix, `?` und `.php` gehören nicht in den Slug.
2. Wählen Sie den Zugriff: **Gemischt** für alle mit optionalen Bereichen für Gäste und angemeldete Nutzer, **Angemeldet** nur für angemeldete Nutzer oder **Nicht angemeldet** für Gäste.
3. Wählen Sie den Status **Entwurf**, **Veröffentlicht**, **Zurückgestellt** oder **Papierkorb**. Zurückgestellt ist keine automatische Terminveröffentlichung. Wählen Sie anschließend **Seite**, **Artikel** oder **Systemseite**. Systemseiten erscheinen nicht als gewöhnliche Seiten und nicht in der Sitemap.
4. Aktivieren Sie die benötigten Sprachen; die Standardsprache ist bereits enthalten. Speichern Sie die Seite und öffnen Sie sie erneut. Bearbeiten Sie **Inhalt**, **Metadaten** und bei veröffentlichten Nicht-Systemseiten **Sitemap-Einstellungen** je Sprache. Jeder Bereich hat eine eigene Speichern-Schaltfläche; unten gibt es **Alles speichern**. Achten Sie auf Erfolgsmeldungen und Warnungen vor ungespeicherten Änderungen.

Die Seitenliste bietet Suche und Filter für Zugriff, Typ, Status und Sprache. **Besuchen** öffnet die öffentliche Seite. **Löschen** verschiebt sie zunächst in den Papierkorb; endgültiges Löschen erfolgt dort.

## Suchen, ansehen und löschen

Filtern Sie die Liste nach Name, Zugang, Typ, Status oder Sprache. **Besuchen** öffnet die öffentliche URL. **Löschen** verschiebt die Seite zunächst in den Papierkorb; erst dort wird sie endgültig gelöscht. Öffnet sich eine Seite nicht, prüfen Sie Veröffentlichung, aktive Sprache und Zugriffstyp.

## WHMCS-Seite ersetzen

Erstellen und veröffentlichen Sie zunächst die Builder-Seite. Öffnen Sie **Seitenliste → Seitenüberschreibungen → Überschreibung hinzufügen**, wählen Sie die WHMCS-Seite und die Builder-Seite und speichern Sie. **Vollständig** ersetzt Inhalt und Metadaten. **Vorher** oder **Nachher** fügt Blöcke vor bzw. nach dem Standardinhalt ein. **Nur Metadaten** ersetzt allein SEO-Daten; kombinierte Varianten fügen Blöcke hinzu und ersetzen Metadaten. Eine Systemseite darf nicht doppelt zugeordnet werden.

Prüfen Sie die ursprüngliche **öffentliche WHMCS-Adresse**, auch als Gast und als angemeldeter Kunde. Der interne Builder-Slug leitet bei abweichender Adresse zur öffentlichen Seite weiter. Für eingeschränkte Teilbereiche verwenden Sie gemischten Zugriff und Bereiche für Gäste bzw. angemeldete Nutzer.

## Anleitung

- Seite hinzufügen
- **Seitenname** — Interner Seitenname
- **Seiten-Slug** — Nur lateinische Buchstaben, Bindestriche und Ziffern sind erlaubt.
- **Zugriffstyp** — Angemeldete Benutzer: Nur angemeldete Benutzer können die Seite öffnen; Gäste: Nur Gäste können sie öffnen; Gemischt: Alle können sie öffnen, einzelne Blöcke steuern ihre eigene Sichtbarkeit.
- **Seitentyp** — Systemseiten erscheinen nicht in der Sitemap und sind für normale Benutzer nicht verfügbar.
- **Seitensprachen** — Die Standardsprache wird unabhängig von Ihrer Auswahl immer hinzugefügt.
- Vollständige Überschreibung ersetzt Inhalt und Metadaten. Davor hinzufügen platziert Inhalt vor dem bestehenden Seiteninhalt. Danach hinzufügen platziert Inhalt nach dem bestehenden Seiteninhalt. Nur Metadaten/SEO ersetzt die Metadaten der Seite.
- Seitennavigation
