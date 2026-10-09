# Anleitung für ZMChel WHMCS Multimodule

**Erzeugen Sie vor der Verwendung unbedingt eigene Salt-Werte und tragen Sie diese in `module_init.php` ein: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` und `ZM_PB_NONCE_SALT`.** Das Modul wurde mit **WHMCS 8.13.1** entwickelt und getestet; **Apache wird vollständig unterstützt (100 %)**. Unter Nginx kann es ebenfalls funktionieren; prüfen Sie dort besonders die Sprachführung der Startseite.

Diese Anleitung richtet sich an Mitarbeiter, die Website-Inhalte über WHMCS pflegen. Texte, Bilder und Menüs lassen sich ohne Programmierung bearbeiten. Exportieren Sie vor Änderungen an URLs, Weiterleitungen, Serverregeln oder Code die Einstellungen: solche Änderungen können veröffentlichte Seiten beeinflussen.

## 1. Orientierung

Melden Sie sich mit Berechtigung für das Add-on im WHMCS-Adminbereich an und öffnen Sie **Add-ons → ZMChel WHMCS Multimodule**. Die Reiter führen zur Seitenliste, Sitemap, Mediathek, Menüverwaltung, Rewrite-Regeln, Weiterleitungen, Moduldatenbank und den Moduleinstellungen. In der Seitenliste können Sie Seiten erstellen, suchen, ändern und entfernen sowie WHMCS-Seiten ersetzen. Die Moduldatenbank zeigt fehlende Tabellen und bietet Reparaturen für Administratoren.

Ein **Slug** ist der Adressteil hinter der Domain, etwa `contact` in `/contact/`. Ein Entwurf ist noch nicht öffentlich, eine veröffentlichte Seite schon. Ein **Block** ist ein Inhaltselement. Eine **Seitenüberschreibung** zeigt Builder-Inhalte unter der bestehenden Adresse einer WHMCS-Seite.

## 2. Seite erstellen und veröffentlichen

1. Öffnen Sie **Seitenliste → Seite hinzufügen**. Geben Sie einen internen Namen und einen Slug aus lateinischen Buchstaben, Ziffern und Bindestrichen ein, z. B. `about-us`. Domain, Sprachpräfix, `?` und `.php` gehören nicht in den Slug.
2. Wählen Sie den Zugriff: **Gemischt** für alle mit optionalen Bereichen für Gäste und angemeldete Nutzer, **Angemeldet** nur für angemeldete Nutzer oder **Nicht angemeldet** für Gäste.
3. Wählen Sie den Status **Entwurf**, **Veröffentlicht**, **Zurückgestellt** oder **Papierkorb**. Zurückgestellt ist keine automatische Terminveröffentlichung. Wählen Sie anschließend **Seite**, **Artikel** oder **Systemseite**. Systemseiten erscheinen nicht als gewöhnliche Seiten und nicht in der Sitemap.
4. Aktivieren Sie die benötigten Sprachen; die Standardsprache ist bereits enthalten. Speichern Sie die Seite und öffnen Sie sie erneut. Bearbeiten Sie **Inhalt**, **Metadaten** und bei veröffentlichten Nicht-Systemseiten **Sitemap-Einstellungen** je Sprache. Jeder Bereich hat eine eigene Speichern-Schaltfläche; unten gibt es **Alles speichern**. Achten Sie auf Erfolgsmeldungen und Warnungen vor ungespeicherten Änderungen.

Die Seitenliste bietet Suche und Filter für Zugriff, Typ, Status und Sprache. **Besuchen** öffnet die öffentliche Seite. **Löschen** verschiebt sie zunächst in den Papierkorb; endgültiges Löschen erfolgt dort.

## 3. Blockeditor

Öffnen Sie die Inhaltseinstellungen und wählen Sie eine Sprache. Ziehen Sie einen GrapesJS-Block auf die Arbeitsfläche; verschachtelte Blöcke gehören in einen Abschnitt, eine Spalte oder einen Container. Klicken Sie auf einen Block und bearbeiten Sie ihn unter **GrapesJS · Blockeinstellungen**. Der Pfeil klappt das Panel ein; diese Einstellung bleibt im Browser erhalten. Einfachen Text bearbeiten Sie direkt, formatierten Text mit TinyMCE und Code im jeweiligen Blockeditor. Speichern Sie die Sprachfassung und kontrollieren Sie sie über **Besuchen**.

Es gibt unter anderem Text, Überschriften, Bilder, Video, Karte, Link, Schaltfläche, Zitat, Liste, Tabelle, FAQ, Akkordeon, Inhaltsverzeichnis, Paginierung, Filter, Kontaktformular, Fortschritt, Abstand, Abschnitt, Flex, Grid, `div`, Karteikarten, Galerie, Karussell, Bereiche für Gäste/angemeldete Nutzer sowie CSS und JavaScript. Smarty muss in den Moduleinstellungen aktiviert sein. Bezeichnungen und Verfügbarkeit können variieren.

Für zwei Spalten fügen Sie einen **Abschnitt** ein, stellen `2` Spalten ein und platzieren **Bild** und **Text** darin. Legen Sie bei Bedarf eigene Spaltenzahlen für Tablet und Mobilgeräte fest. Flex und Grid eignen sich für komplexere Ausrichtung. Tabellen bieten Zeilen, Spalten sowie optional Kopf- und Fußzeilen. Beim Karussell lassen sich Folien, automatischer Wechsel, Schleife, Tempo und sichtbare Folien pro Bildschirmgröße einstellen. FAQ erzeugt Frage-Antwort-Markup, das Akkordeon ist für andere aufklappbare Inhalte. Ein Doppelklick öffnet im Editor einen Akkordeonpunkt.

Wählen Sie für Überschriften `H1`–`H6`, Größe und Stärke; meist genügt eine Hauptüberschrift `H1`. Das Inhaltsverzeichnis verlinkt folgende Überschriften. Abstände werden in Pixeln angegeben. Beschreiben Sie Bilder mit sinnvollem `alt`-Text. Über den GrapesJS-Komponentenbaum lassen sich übergeordnete Container auswählen. Prüfen Sie vor dem Löschen die Auswahl, damit Sie nicht versehentlich einen ganzen Abschnitt statt einer Zelle entfernen.

### Inhalte zwischen Sprachen übertragen

Wählen Sie über dem Editor die Zielsprache und dann **Mit Inhalt kopieren**, **Struktur kopieren** oder **Klonen**. Die ersten beiden Optionen fügen Blöcke mit Text bzw. nur das Layout hinzu. Klonen ersetzt den Inhalt des Zieleditors und fragt bei vorhandenem Inhalt nach Bestätigung. Öffnen Sie danach die Zielsprache, übersetzen Sie den Text und speichern Sie. Einzelne ausgewählte Blöcke lassen sich ebenfalls übertragen.

## 4. Sprachen und Links

Die Sprachen stehen in `supported_langs.php`. Bei Sprachrouting und lesbaren URLs hat die Standardsprache kein Präfix (`/contact/`); andere verwenden etwa `/ru/contact/` oder `/de/contact/`. Ein Wechsel der Seitensprache soll die Profilsprache des Kunden nicht ändern.

Bei **Link** und **Schaltfläche** können Sie **Sprache der aktuellen Seite in die URL übernehmen** aktivieren. So wird `/contact/` auf einer russischen Seite zu `/ru/contact/`; vorhandene Sprachpräfixe werden ersetzt, Query-Parameter und Fragmente bleiben erhalten. Speichern und testen Sie Links in zwei Sprachen. Neue Blöcke haben diese Option standardmäßig; ältere behalten ihr Verhalten bis zur ausdrücklichen Änderung.

Deaktivieren Sie die Option für externe Adressen, Dateien, `mailto:`, `tel:`, Anker und WHMCS-Routen ohne Sprachversion wie `/login` oder `/clientarea.php`. Die Option erzeugt keine Übersetzung der Zielseite: deren Sprachversion muss selbst veröffentlicht sein. Links in TinyMCE und Smarty haben keinen eigenen Schalter und müssen manuell geprüft werden.

## 5. SEO und Sitemap einer Seite

Öffnen Sie **Metadaten**, wählen Sie die Sprache und füllen Sie **Seitentitel** und **Meta-Beschreibung** in dieser Sprache aus. Optional ergänzen Sie Breadcrumbs, Open-Graph- und Twitter-Angaben; leere optionale Social-Felder können die Hauptmetadaten übernehmen. Prüfen Sie Canonical-URL, Robots und Schema-Typ: `WebPage` für normale Seiten, einen Artikeltyp für Artikel, `ContactPage` für Kontaktseiten. `Organization` ist nicht allein wegen des Website-Betreibers der richtige Haupttyp. Speichern Sie jede Sprache.

Bei einer veröffentlichten Nicht-Systemseite können Sie Sitemap-Häufigkeit und Priorität einstellen. Prüfen Sie nach der Veröffentlichung Titel, Beschreibung, Sprachlinks und eine sinnvolle `H1`. Bei Überschreibungen steht die öffentliche Adresse der ersetzten Seite in der Sitemap, nicht der interne Builder-Slug.

## 6. WHMCS-Seite ersetzen

Erstellen und veröffentlichen Sie zunächst die Builder-Seite. Öffnen Sie **Seitenliste → Seitenüberschreibungen → Überschreibung hinzufügen**, wählen Sie die WHMCS-Seite und die Builder-Seite und speichern Sie. **Vollständig** ersetzt Inhalt und Metadaten. **Vorher** oder **Nachher** fügt Blöcke vor bzw. nach dem Standardinhalt ein. **Nur Metadaten** ersetzt allein SEO-Daten; kombinierte Varianten fügen Blöcke hinzu und ersetzen Metadaten. Eine Systemseite darf nicht doppelt zugeordnet werden.

Prüfen Sie die ursprüngliche **öffentliche WHMCS-Adresse**, auch als Gast und als angemeldeter Kunde. Der interne Builder-Slug leitet bei abweichender Adresse zur öffentlichen Seite weiter. Für eingeschränkte Teilbereiche verwenden Sie gemischten Zugriff und Bereiche für Gäste bzw. angemeldete Nutzer.

## 7. Bilder und Mediathek

Öffnen Sie **Medienmanager → Datei hochladen**. Geben Sie bei Bildern einen treffenden **Alt-Text** ein; Name, Titel und Beschreibung helfen bei Suche und Beschriftung. Nach dem Hochladen finden Sie Dateien mit Suche, Typfilter und **Mehr laden**. Wählen Sie in einem Bildblock **Bild auswählen**, danach die Mediendatei, und speichern Sie die Seite.

Der Manager erzeugt mehrere Bildgrößen. Bereits hochgeladene Bilder können Sie über **Bild optimieren** erneut optimieren; prüfen Sie danach besonders Text auf Bannern. Bei Bedarf deaktivieren Sie `srcset` für einen einzelnen Bildblock. Eine Platzhalteradresse `data:image/svg+xml…` ist keine echte Bilddatei.

## 8. Menüs

Erstellen Sie im **Menümanager** ein Menü mit Namen. Fügen Sie Seiten oder Artikel hinzu; **Benutzerdefinierter Link** eignet sich für externe URLs, Systemseiten und Spaltenüberschriften. Ziehen Sie Einträge für Reihenfolge und Verschachtelung. In den Eintragseinstellungen ändern Sie Text, andere Sprachen, neues Fenster, Sichtbarkeit, CSS-Klassen und weitere Attribute. Bei eigenen Links wählen Sie, ob die aktuelle Sprache in die URL übernommen wird; `/clientarea.php` und Routen ohne Sprachversion bleiben unverändert.

Aktivieren Sie das Menü, wählen Sie **Ergänzen** oder **Ersetzen** der WHMCS-Navigation sowie Desktop/Mobil-Sichtbarkeit. Weisen Sie Haupt- oder Zusatz-Navigation, Seitenleiste oder Fußzeile zu; je Position ist nur ein Menü möglich. Speichern und testen Sie beide Bildschirmgrößen. In der Fußzeile werden Einträge oberster Ebene zu Spalten und verschachtelte Einträge zu Links; `#` kann eine nicht verlinkte Überschrift kennzeichnen. Aktivieren Sie die Ausgabe der Position auch in den Moduleinstellungen. Fehlende Menütabellen reparieren Sie unter **Moduldatenbank**. Einzelheiten: [Menüs](../../docs/menus.md).

## 9. Kontaktformular

Fügen Sie den Block **Kontaktformular** hinzu und stellen Sie Titel, Beschreibung, Betreff und Schaltflächentext ein. Wählen Sie **WHMCS-Ticket** mit Support-Abteilung oder **E-Mail** mit Empfänger im Block. Legen Sie Felder mit Name, Typ, Pflichtangabe und Prüfung an. Ein Gast-Ticket braucht Felder für Absendername und E-Mail. Dropdown-Optionen schreiben Sie zeilenweise als `wert : Beschriftung`, z. B. `sales : Vertrieb`.

Für mehrere Einwilligungen verwenden Sie getrennte **Einwilligung**-Felder mit eigenem Text und Pflichtstatus. Sichere Links wie `<a href="/privacy/">Datenschutz</a>` sind möglich. Legen Sie Breite, neue Zeile, Reihenfolge und gegebenenfalls Flex/Grid fest. CAPTCHA verwendet Typ und Schlüssel aus WHMCS. Bei E-Mail wählen Sie eine Systemnachricht ohne WHMCS-Vorlage oder die normale Gestaltung. Speichern Sie und schicken Sie als Besucher eine Testnachricht; prüfen Sie Empfänger/Ticket, Fehlermeldungen und Zurücksetzen des Formulars. Falls PHP `mail()` ausfällt, richten Sie SMTP in WHMCS ein. Der grüne Editorstatus beweist keinen E-Mail-Empfang.

## 10. Listen, Filter und Paginierung

Verbinden Sie den **Paginierung**-Block mit dem richtigen Listenblock, etwa einer Smarty-Liste. Stellen Sie Datenquelle, Standardanzahl, sichtbare Schaltflächen, `/page/N/` oder `?page=N`, die optionale Auswahl 10/25/50/100/250 und Indexierung späterer Seiten ein. Der Server begrenzt `count` auf 10–250. Der Auswahlschalter kann neben den Seitenzahlen oder anderswo stehen. **Filter** bieten Text-, Bereichs- und Datumssuche; einen eigenen Suchblock gibt es nicht. Verbinden Sie Filter mit derselben Liste. Prüfen Sie auf Seite 2 geänderte Ergebnisse und saubere URLs. Einzelheiten: [Paginierung](../../docs/pagination.md).

## 11. Smarty, CSS und JavaScript

Aktivieren Sie **Smarty-Variablen verwenden**, bevor Sie einen Smarty-Block einsetzen. Wählen Sie im Codeeditor eine erfasste Variable und speichern Sie. Ob sie verfügbar ist, hängt von der Seite und dem Zeitpunkt anderer Module ab. Erlaubt ist nur die vorgesehene Template-Syntax; PHP, SQL und direkter Datenbankzugriff sind untersagt. Ein einfaches Beispiel ist `{$pageTitle|escape}`. Testen Sie als Gast und Kunde und geben Sie keine ganzen Objekte mit personenbezogenen Daten aus. Einzelheiten: [Smarty](../../docs/smarty.md).

**Custom CSS** und **Custom JS** gelten für die jeweilige Seite; prüfen Sie Mobilansicht und Sprachen. Globaler Code für Kopf und Fuß steht in den Moduleinstellungen und sollte nur von Personen mit HTML/CSS/JavaScript-Kenntnissen geändert werden.

## 12. Sitemap, Weiterleitungen und Rewrite-Regeln

Aktivieren Sie die Sitemap-Erzeugung und wählen Sie die Häufigkeit in den Moduleinstellungen. Im Reiter **Sitemap** prüfen Sie den letzten Lauf und geplante URLs und klicken auf **Sitemaps erzeugen**. Öffnen Sie `sitemap_index.xml` und die Unterdateien. Automatische Läufe hängen vom WHMCS-Cron ab. Der Index kann andere Sitemap-Dateien im Website-Stammverzeichnis enthalten. Überschreibungen verwenden öffentliche Adressen; unveröffentlichte Sprachfassungen gehören nicht hinein. Einzelheiten: [Sitemaps](../../docs/sitemaps.md).

Im **Weiterleitungsmanager** geben Sie Quelle `/old-page/` und Ziel `/new-page/` ein, wählen `301` für dauerhaft oder `302` für vorübergehend, aktivieren, speichern und testen die alte URL. Automatische Weiterleitungen nach Slug-Änderungen haben einen eigenen Schalter und ein Mindestalter. Einzelheiten: [Weiterleitungen](../../docs/redirects.md).

Im **Rewrite-Manager** prüfen Sie die Regeln und klicken dann **Regeln hinzufügen oder aktualisieren**, damit `.htaccess` geschrieben wird. Bei eigenen Regeln geben Sie URL-Muster, Ziel und Flags ein und wenden die Regeln erneut an. `.htaccess` gilt für Apache; Nginx benötigt entsprechende Serverregeln. Fehlerhafte Regeln können die ganze Website betreffen.

## 13. Einstellungen, Import und Wartung

Die **Moduleinstellungen** umfassen lesbare URLs, Sprachrouting, Überschreibungen, Menüpositionen, Wartungsmodus, Smarty, Weiterleitungen, Sitemap-Zeitplan, Kopf-/Fußcode, `robots.txt` sowie Import/Export. Exportieren Sie vor größeren Änderungen alle oder ausgewählte Bereiche als JSON. Der Export kann Seiten und Übersetzungen, Menüs, Einstellungen, Weiterleitungen, Rewrite-Regeln und Medien enthalten. Er ist kein vollständiges WHMCS-Backup und enthält keine Konten, Geheimnisse, Seitenrevisionen oder Theme-Dateien. Einzelheiten: [Import/Export](../../docs/transfer.md).

Zum Importieren wählen Sie JSON-Datei und Bereiche, klicken auf **Importieren** und bestätigen. Passende bestehende Datensätze können aktualisiert werden. Kontrollieren Sie danach Seiten, Menüs und Medien; importierte Rewrite-Regeln müssen separat angewendet und die Sitemap neu erzeugt werden. Die **Moduldatenbank** zeigt und repariert fehlende Tabellen oder Spalten. Der Wartungsmodus sperrt öffentliche Modulseiten für normale Besucher; testen Sie ihn in einem Browser ohne Anmeldung.

Bei der ersten Einrichtung: Add-on aktivieren und Rechte vergeben, Datenbank prüfen, lesbare URLs und Sprachrouting einstellen, Menüpositionen und Überschreibungen prüfen, Apache-Regeln anwenden oder Nginx-Routen konfigurieren, WHMCS-Cron und Schreibrechte für Sitemap-/Mediendateien kontrollieren. Veröffentlichen Sie eine Testseite in zwei Sprachen und prüfen Sie Menüs, Überschreibungen und Weiterleitungen. Smarty-Erfassung nur für Mitarbeiter aktivieren, die sie benötigen.

## 14. Abschlusskontrolle und häufige Probleme

Vor der Freigabe prüfen Sie Veröffentlichungsstatus, gespeicherten Inhalt und Metadaten aller aktivierten Sprachen. Öffnen Sie die öffentliche URL als Besucher und auf schmalem Bildschirm. Prüfen Sie Titel, Bilder, `alt`, Schaltflächen, Links, Formulare und zwei Sprachen. Bei Überschreibungen prüfen Sie die Systemadresse. Testen Sie Menüs auf Desktop/Mobilgeräten und nach Slug-Änderung die alte URL. Erzeugen Sie die Sitemap nach Veröffentlichungen erneut.

Bei 404 prüfen Sie Status, Slug, Sprache, lesbare URLs und Rewrite-Regeln. Fehlender Sprachinhalt bedeutet oft fehlenden Text oder SEO dieser Sprache; Strukturkopien übersetzen nicht. Bei `/ru/login` deaktivieren Sie die Sprachoption des Links. Fehlt ein Menü, prüfen Sie Aktivierung, Position, Modul-Ausgabebereich und Bildschirmmodus. Bei fehlenden Bildern wählen Sie eine echte Mediendatei. Bei Formularproblemen prüfen Sie Empfänger und WHMCS-Mail/SMTP. Bei Menüfehlern prüfen Sie Pflichtfelder und Tabellen. Bei alten Sitemaps prüfen Sie Zeitplan, Cron und Schreibrechte. Gespeicherte Rewrite-Regeln müssen noch angewendet werden; Nginx wird separat konfiguriert.

Für Fehlermeldungen senden Sie öffentliche URL, Seitenname/-nummer, Sprache, Handlung, erwartetes und tatsächliches Ergebnis sowie den genauen Fehlertext. Keine Passwörter oder Geheimnisse mitsenden.

### Weitere Unterlagen

- [Menüs](../../docs/menus.md)
- [Smarty und erfasste Variablen](../../docs/smarty.md)
- [Paginierung und Filter](../../docs/pagination.md)
- [Sitemaps](../../docs/sitemaps.md)
- [Weiterleitungen](../../docs/redirects.md)
- [Schema.org-Strukturdaten](../../docs/structured-data.md)
- [Import und Export](../../docs/transfer.md)
