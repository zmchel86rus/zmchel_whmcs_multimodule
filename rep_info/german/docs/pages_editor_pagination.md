# Paginierungsblock

Platzieren Sie die Paginierung vor oder nach der Liste. Wählen Sie in den Einstellungen **Block auf der Arbeitsfläche auswählen** und klicken Sie den Smarty-Block oder den Container der Einträge an. Esc beendet die Auswahl. Die Paginierung muss außerhalb des Zielblocks liegen. Bei Smarty geben Sie die Variable der vollständigen Liste an, etwa `$items`; das `$` ist optional. Die Vorlage behält ihr normales `{foreach}` und benötigt kein weiteres `array_slice`. Seitenumfang und Anzahl der Schaltflächen am Anfang, Ende und neben der aktuellen Seite lassen sich für Desktop und Mobilansicht getrennt festlegen. Optional erscheint eine zweite Leiste auf der anderen Seite derselben Liste.

## Links und mehrere Listen

Jeder Block wählt die Modulvorgabe (`ZM_PB_PRETTY_URLS`), `/page/2/` oder `?page=2`. Pfad-URLs benötigen funktionierende Rewrite-Regeln. Direkte PHP-Adressen bleiben bei GET-Parametern. Filter, Sortierung, Installationspfad und Sprachpräfix bleiben erhalten; beim Formatwechsel wird die alte Seitennummer entfernt.

Die erste Liste verwendet `page`, `count`, `sort`; weitere Listen bekommen Parameter mit der ID ihres Zielblocks. Bei `/page/N/` kennzeichnet `pager` den Besitzer der Seitennummer. Eine kopierte Leiste erzeugt keine weitere Liste. Sortierbare Felder hängen von der gewählten Liste ab; `-` davor sortiert absteigend. Nicht unterstützte Felder werden ignoriert.

## Datenquellen

Bei einer gebundenen Smarty-Variable teilt das Modul die bereits auf der Seite verfügbare Sammlung auf. Unabhängige Blöcke derselben Variable erhalten jeweils ihren Ausschnitt im isolierten Blockkontext. Fehlende Datensätze werden nicht aus einer anderen Datenquelle nachgeladen.

Ohne Variable werden HTML-Elemente eines Containers geteilt. Eine Klasse oder ein Tag wie `tr` kann die wiederholten Einträge bestimmen; `thead` und `tfoot` bleiben erhalten. Für große dynamische Listen ist eine Variable günstiger als das Rendern aller Elemente. Smarty erhält `$zm_pagination` mit `total`, `page`, `pages`, `count`, `offset`, etwa `{$zm_pagination.offset + $v@iteration}`. Bei null oder einer Seite verschwindet die Leiste auf der Website.

## Anzahl, SEO und Filter

Ein optionaler Auswahlschalter bietet 10/25/50/100/250 Einträge. Er kann vor oder nach die Schaltflächen oder in einen anderen Container verschoben werden; Filter bleiben erhalten, die Liste springt auf Seite eins. Das Backend begrenzt Einstellungen und GET-Werte `count`/`count_<id>` auf 10–250. Ab Seite zwei erhalten Titel, vorhandene Beschreibung und letzter Breadcrumb die Seitennummer; Canonical zeigt auf die aktuelle Seite. **Spätere Seiten nicht indexieren** setzt nur für diese Seiten `noindex`.

Textfilter können mehrere durch Komma getrennte Felder durchsuchen. Flex/Grid, Abstände, Ausrichtung, Schaltflächenposition und responsive Spalten sind einstellbar. Datumsbereiche verwenden `YYYY-MM-DD` und schließen Zeitwerte bis zum Ende des gewählten letzten Tages ein. Zum Prüfen im WHMCS-Projekt mit DOM und Abhängigkeiten: `tests/pagination.php`, `tests/pagination.php query` und `tests/smarty_blocks.php`.

## YYYY-MM-DD

Filter wirken auf dieselbe Liste wie die Seitennummerierung. Die Textsuche kann mehrere durch Kommas getrennte Felder prüfen; ein Datumsbereich verwendet `YYYY-MM-DD` und schließt den letzten Tag vollständig ein. Anwenden oder Zurücksetzen eines Filters führt die Liste zur ersten Seite zurück.

## Flex / Grid

Wählen Sie Flex oder Grid und stellen Sie Feldbreiten und Spalten für die Gerätegrößen ein. Die Auswahl der Eintragszahl lässt sich verschieben, ohne die Verbindung zum Paginierungsblock zu verlieren. Eine duplizierte Leiste steuert dieselbe Liste samt Filtern und Seitengröße.
