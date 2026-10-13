# Weiterleitungen und Sitemap-Sprachen

Der **Weiterleitungsmanager** speichert Quelladresse → Ziel → HTTP-Status 301, 302, 303, 307 oder 308. Regeln können bearbeitet, deaktiviert und gelöscht werden; die Verwaltung zeigt 50 pro Seite.

Quellen sind lokale Pfade ab `/` oder absolute URLs derselben Website. Ziele dürfen Pfade oder HTTP(S)-URLs sein. Abschließende Schrägstriche gelten beim Abgleich als gleich; das Ziel behält seinen eigenen. Regeln mit Query haben Vorrang vor reinen Pfadregeln. Pfadregeln erfassen auch Anfragen mit Parametern; Zielparameter ersetzen Quellparameter.

Regeln greifen bei GET/HEAD, wenn die Anfrage WHMCS erreicht, noch vor dem Page Builder. Sie ändern weder `.htaccess` noch Sprachsitzung oder Profil. Serverweiterleitungen und die vorhandenen Sprach-/Canonical-Regeln arbeiten unabhängig. `ZM_PB_ENABLE_REDIRECTS_MANAGER` schaltet gespeicherte Regeln ein. `ZM_PB_AUTO_REDIRECTS` und `ZM_PB_AUTO_REDIRECT_DAYS` steuern automatische Regeln; Standard sind 14 Tage, 0 bedeutet keine Wartezeit.

Beim Umbenennen des Slugs einer weiterhin veröffentlichten Seite entsteht automatisch ein 301. Das Alter wird vor dem Speichern aus dem neuesten Zeitstempel der vorhandenen Seite oder aktiven Übersetzung bestimmt. Erstmaliges Veröffentlichen eines Entwurfs erzeugt keine Regel. Jede verfügbare Sprachadresse bekommt eine Regel. Spätere Umbenennungen aktualisieren frühere Ziele; die Rückkehr zu einem alten Slug entfernt Selbstweiterleitungen. Manuelle Regeln haben Vorrang.

Ist die Seitenüberschreibung aktiv, leitet deren Alias auch bei deaktivierten gespeicherten Regeln zur ursprünglichen Systemseite. Bei mehreren überschriebenen Seiten zeigt der Layout-Alias auf die erste konfigurierte Seite; die Sitemap listet jede Systemseite getrennt. Die Umbenennung aktualisiert `page_overrides.to` zusammen mit Seite und Regeln in einer Transaktion.

Die Daten liegen in `zm_pb_redirects`. Anfragen erstellen oder reparieren keine Tabellen; nutzen Sie dafür **Moduldatenbank**. URL-Spalten fassen 128 Byte, längere Eingaben werden abgelehnt. `sitemap_pages.xml` und `sitemap_posts.xml` enthalten wechselseitige Sprachalternativen und `x-default` für die Standardsprache. Nur aktive Übersetzungen erscheinen; Weiterleitungsquellen fehlen in `loc` und Alternativen. XML kann im **Sitemap-Manager** oder per Cron erneuert werden. Isolierte Tests: `tests/redirects.php` und `tests/sitemap.php` mit den Varianten `--plain`, `--routes-off` und `--disabled`; sie verwenden temporäre Dateien und SQLite im Speicher.
