# Smarty-Block und Variablenkatalog

`ZM_PB_COLLECT_VARS` sammelt den Katalog; `ZM_PB_USE_COLLECT_VARS === true` aktiviert den Smarty-Block und seine Ausgabe. Besuchen Sie nach dem Einschalten die betroffenen Seiten und laden Sie den Editor erneut.

## Katalog

Dateien liegen unter `resources/available_vars/<Thema>__<Vorlage>_smarty_vars.json`. Erfasst werden Namen, Typen, verschachtelte Struktur, künstliche Beispiele und Beobachtungsphasen wie `ClientAreaPage:9999`, `ClientAreaHeadOutput:9999`, `ClientAreaFooterOutput:9999`. Die Phase zeigt Verfügbarkeit, nicht den erzeugenden Hook. `children.[]` beschreibt Listenelemente; Tiefe und Umfang sind begrenzt und mit `sampled`/`truncated` markiert. Ein fehlendes Feld kann in anderen Anfragen trotzdem vorkommen.

Echte Werte werden nicht gespeichert. Passwort-, Token- und personenbezogene Felder sind zusätzlich `redacted`. Bei Collections und Modellen werden nur bereits geladene `items`/`attributes` gelesen, keine Getter, Beziehungen oder Abfragen. Andere Objekte bleiben undurchsichtig. Ältere JSON-Dumps werden bei der nächsten Sammlung anonymisiert. Der Ordner ist durch `.htaccess` geschützt; auch ohne diese Datei enthält der Katalog keine echten Werte.

## Editor und Ausführung

**Code bearbeiten** oder ein Doppelklick auf den Smarty-Block öffnet CodeMirror in GrapesJS. Oben steht der Code, darunter die Variable; rechts suchen Sie Thema, Vorlage und Variable. `Ctrl+Space` sucht Variablen, `Ctrl+S`/`Cmd+S` übernimmt Code, `F11` schaltet Vollbild ein, `Escape` beendet es oder schließt ohne Übernahme.

```smarty
{foreach $registered_domains as $item}
    <div class="domain">{$item.domain|escape}</div>
{foreachelse}
    <p>Keine Domains.</p>
{/foreach}
```

Code wird beim Speichern und vor der Ausgabe geprüft. Isoliertes Smarty erhält einen Schnappschuss bereits vorhandener Variablen als Arrays und Skalare. Erlaubt sind Bedingungen, `foreach`, lokales `assign`, `capture`, `literal`, `strip`, `break`/`continue` sowie ausgewählte Modifikatoren (`escape`, `default`, `count`, `nl2br`, `upper`, `lower`, `capitalize`, `truncate`, `replace`, `cat`, `date_format`). PHP, Methoden, beliebige Funktionen, SQL, Includes, Netzwerkzugriffe, Superglobals und `nofilter` sind verboten. Werte werden automatisch maskiert; HTML gehört direkt in die Vorlage. Sensible Felder fehlen auch im Ausgabe-Schnappschuss.

Blöcke werden in `ClientAreaFooterOutput:10000` verarbeitet und über einen Smarty-Ausgabefilter an ihre ursprüngliche HTML-Position gesetzt. Gesperrte Bereiche werden vorher entfernt. Fehlende Daten oder Vorlagenfehler ergeben einen leeren Block und einen Eintrag im PHP-Fehlerprotokoll. Der Katalog ist keine Datenquelle und macht Variablen anderer Seiten nicht verfügbar. Prüfen Sie mit `tests/smarty_blocks.php` in einer WHMCS-Umgebung mit Projektabhängigkeiten.
