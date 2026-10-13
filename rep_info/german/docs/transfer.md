# Import und Export

Öffnen Sie **Moduleinstellungen → Import / Export**. Eine JSON-Datei (`zmchel_whmcs_multimodule`, Formatversion 1) enthält ausgewählte oder alle Bereiche:

- **Seiten und Beiträge:** Einstellungen, Übersetzungen, GrapesJS-Inhalt, SEO und Sitemap. Generiertes CSS/JS wird als Quelltext exportiert und beim Import unter neuer Seiten-ID angelegt.
- **Menüs:** Hierarchie, übersetzte Beschriftungen, Positionen und Einstellungen. Seiten werden über `slug + auth_type`, Menüs über den Namen zugeordnet. Doppelte Menünamen auf der Zielseite müssen vorher geklärt werden.
- **Einstellungen:** bearbeitbare Konstanten, Modulwerte, Überschreibungen, Header/Footer und `robots.txt`. System-URL-Modus und letzte Sitemap-Erzeugung bleiben lokal.
- **Weiterleitungen:** manuelle Regeln und Verknüpfungen automatischer Regeln mit Seiten.
- **Rewrite-Regeln:** eigene Regeln; anschließend im Rewrite-Manager anwenden.
- **Medien:** nur registrierte Mediendateien, Größen, Beschreibungen und Attribute, keine fremden WHMCS-Anhänge. Namenskonflikte erhalten neue Namen; importierte Verweise werden angepasst.

Der Import aktualisiert Übereinstimmungen, fügt neue Datensätze hinzu und lässt andere unverändert. Fehlende ausgewählte Bereiche werden übersprungen. Werden nur Menüs oder automatische Weiterleitungen übertragen, müssen die zugehörigen Seiten vorher oder gleichzeitig importiert werden. URLs der Quellwebsite werden durch die Ziel-SystemURL ersetzt, externe URLs nicht. Für Bilder wählen Sie Medien zusammen mit Seiten aus.

JSON ist auf 32 MiB begrenzt; zusätzlich gelten `upload_max_filesize` und `post_max_size`. Große Exporte benötigen eventuell mehr PHP-Speicher. Revisionen, gesammelte Smarty-Variablen, WHMCS-Konten/Geheimnisse und Themendateien fehlen im Export. Datenbanktabellen müssen bereits bestehen.

Vor dem Import werden Änderungen bestätigt. Datenbankänderungen laufen in einer Transaktion, überschriebene Dateien werden bei Fehlern wiederhergestellt. Bearbeitbare Konstanten werden nur als vollständiger gewählter Satz importiert. Eine Dateisperre schützt die Operation; nach Erfolg lädt die Registerkarte neu. Die Sitemap ist anschließend separat zu erzeugen. Test im Projekt: `tests/transfer.php` mit temporären Verzeichnissen und SQLite ohne Produktivdatenbank.
