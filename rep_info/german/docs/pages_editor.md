# Seiteneditor

- [Paginierung und Filter](pages_editor_pagination.md)
- [Smarty und erfasste Variablen](pages_editor_smarty.md)
- [Schema.org-Strukturdaten](module_structured_data.md)

## Blockeditor

Öffnen Sie die Inhaltseinstellungen und wählen Sie eine Sprache. Ziehen Sie einen GrapesJS-Block auf die Arbeitsfläche; verschachtelte Blöcke gehören in einen Abschnitt, eine Spalte oder einen Container. Klicken Sie auf einen Block und bearbeiten Sie ihn unter **GrapesJS · Blockeinstellungen**. Der Pfeil klappt das Panel ein; diese Einstellung bleibt im Browser erhalten. Einfachen Text bearbeiten Sie direkt, formatierten Text mit TinyMCE und Code im jeweiligen Blockeditor. Speichern Sie die Sprachfassung und kontrollieren Sie sie über **Besuchen**.

Es gibt unter anderem Text, Überschriften, Bilder, Video, Karte, Link, Schaltfläche, Zitat, Liste, Tabelle, FAQ, Akkordeon, Inhaltsverzeichnis, Paginierung, Filter, Kontaktformular, Fortschritt, Abstand, Abschnitt, Flex, Grid, `div`, Karteikarten, Galerie, Karussell, Bereiche für Gäste/angemeldete Nutzer sowie CSS und JavaScript. Smarty muss in den Moduleinstellungen aktiviert sein. Bezeichnungen und Verfügbarkeit können variieren.

Für zwei Spalten fügen Sie einen **Abschnitt** ein, stellen `2` Spalten ein und platzieren **Bild** und **Text** darin. Legen Sie bei Bedarf eigene Spaltenzahlen für Tablet und Mobilgeräte fest. Flex und Grid eignen sich für komplexere Ausrichtung. Tabellen bieten Zeilen, Spalten sowie optional Kopf- und Fußzeilen. Beim Karussell lassen sich Folien, automatischer Wechsel, Schleife, Tempo und sichtbare Folien pro Bildschirmgröße einstellen. FAQ erzeugt Frage-Antwort-Markup, das Akkordeon ist für andere aufklappbare Inhalte. Ein Doppelklick öffnet im Editor einen Akkordeonpunkt.

Wählen Sie für Überschriften `H1`–`H6`, Größe und Stärke; meist genügt eine Hauptüberschrift `H1`. Das Inhaltsverzeichnis verlinkt folgende Überschriften. Abstände werden in Pixeln angegeben. Beschreiben Sie Bilder mit sinnvollem `alt`-Text. Über den GrapesJS-Komponentenbaum lassen sich übergeordnete Container auswählen. Prüfen Sie vor dem Löschen die Auswahl, damit Sie nicht versehentlich einen ganzen Abschnitt statt einer Zelle entfernen.

### Inhalte zwischen Sprachen übertragen

Wählen Sie über dem Editor die Zielsprache und dann **Mit Inhalt kopieren**, **Struktur kopieren** oder **Klonen**. Die ersten beiden Optionen fügen Blöcke mit Text bzw. nur das Layout hinzu. Klonen ersetzt den Inhalt des Zieleditors und fragt bei vorhandenem Inhalt nach Bestätigung. Öffnen Sie danach die Zielsprache, übersetzen Sie den Text und speichern Sie. Einzelne ausgewählte Blöcke lassen sich ebenfalls übertragen.

## Sprachen und Links

Die Sprachen stehen in `supported_langs.php`. Bei Sprachrouting und lesbaren URLs hat die Standardsprache nur dann kein Präfix (`/contact/`), wenn ihre optionale Sprachroute ausgeschaltet ist; andere verwenden etwa `/ru/contact/` oder `/de/contact/`. Ein Wechsel der Seitensprache soll die Profilsprache des Kunden nicht ändern.

Bei **Link** und **Schaltfläche** können Sie **Sprache der aktuellen Seite in die URL übernehmen** aktivieren. So wird `/contact/` auf einer russischen Seite zu `/ru/contact/`; vorhandene Sprachpräfixe werden ersetzt, Query-Parameter und Fragmente bleiben erhalten. Speichern und testen Sie Links in zwei Sprachen. Neue Blöcke haben diese Option standardmäßig; ältere behalten ihr Verhalten bis zur ausdrücklichen Änderung.

Deaktivieren Sie die Option für externe Adressen, Dateien, `mailto:`, `tel:`, Anker und WHMCS-Routen ohne Sprachversion wie `/login` oder `/clientarea.php`. Die Option erzeugt keine Übersetzung der Zielseite: deren Sprachversion muss selbst veröffentlicht sein. Links in TinyMCE und Smarty haben keinen eigenen Schalter und müssen manuell geprüft werden.

## SEO und Sitemap einer Seite

Öffnen Sie **Metadaten**, wählen Sie die Sprache und füllen Sie **Seitentitel** und **Meta-Beschreibung** in dieser Sprache aus. Optional ergänzen Sie Breadcrumbs, Open-Graph- und Twitter-Angaben; leere optionale Social-Felder können die Hauptmetadaten übernehmen. Prüfen Sie Canonical-URL, Robots und Schema-Typ: `WebPage` für normale Seiten, einen Artikeltyp für Artikel, `ContactPage` für Kontaktseiten. `Organization` ist nicht allein wegen des Website-Betreibers der richtige Haupttyp. Speichern Sie jede Sprache.

Bei einer veröffentlichten Nicht-Systemseite können Sie Sitemap-Häufigkeit und Priorität einstellen. Prüfen Sie nach der Veröffentlichung Titel, Beschreibung, Sprachlinks und eine sinnvolle `H1`. Bei Überschreibungen steht die öffentliche Adresse der ersetzten Seite in der Sitemap, nicht der interne Builder-Slug.

## Kontaktformular

Fügen Sie den Block **Kontaktformular** hinzu und stellen Sie Titel, Beschreibung, Betreff und Schaltflächentext ein. Wählen Sie **WHMCS-Ticket** mit Support-Abteilung oder **E-Mail** mit Empfänger im Block. Legen Sie Felder mit Name, Typ, Pflichtangabe und Prüfung an. Ein Gast-Ticket braucht Felder für Absendername und E-Mail. Dropdown-Optionen schreiben Sie zeilenweise als `wert : Beschriftung`, z. B. `sales : Vertrieb`.

Für mehrere Einwilligungen verwenden Sie getrennte **Einwilligung**-Felder mit eigenem Text und Pflichtstatus. Sichere Links wie `<a href="/privacy/">Datenschutz</a>` sind möglich. Legen Sie Breite, neue Zeile, Reihenfolge und gegebenenfalls Flex/Grid fest. CAPTCHA verwendet Typ und Schlüssel aus WHMCS. Bei E-Mail wählen Sie eine Systemnachricht ohne WHMCS-Vorlage oder die normale Gestaltung. Speichern Sie und schicken Sie als Besucher eine Testnachricht; prüfen Sie Empfänger/Ticket, Fehlermeldungen und Zurücksetzen des Formulars. Falls PHP `mail()` ausfällt, richten Sie SMTP in WHMCS ein. Der grüne Editorstatus beweist keinen E-Mail-Empfang.

## Anleitung

- Verschachtelter Container mit Flex-Layout. Ziehen Sie weitere Blöcke hinein.
- Verschachtelter Container mit CSS-Grid-Layout. Ziehen Sie weitere Blöcke hinein.
- Verschachteltes Bootstrap-Karussell. Ziehen Sie Blöcke hinein; jeder wird zu einer Folie.
- Alle Blöcke unter diesem Block werden nur angemeldeten Benutzern angezeigt. Funktioniert nur beim Zugriffstyp „Gemischt“.
- Alle Blöcke unter diesem Block werden nur Gästen angezeigt. Funktioniert nur beim Zugriffstyp „Gemischt“.
- **Seitentitel**
- **Meta-Beschreibung**
- **Kanonische URL**
- **Robots** — index, follow / noindex, nofollow. Steuert die Indexierung.
- **Schema-Typ** — Bei Deaktivierung wird kein Schema.org-JSON für diese Seite ausgegeben.
