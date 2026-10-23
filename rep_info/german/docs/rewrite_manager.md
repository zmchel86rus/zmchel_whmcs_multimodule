# Rewrite-Regeln

## WHMCS

Regeln für Sprach-URLs, auch Seiten unter /ru/, /en/ und anderen Präfixen. Die Sprachen stammen aus supported_langs.php; die Regeln werden vor den WHMCS-Regeln in .htaccess eingefügt.

Nginx liest .htaccess nicht; diese Regeln wirken dort nicht. Entsprechende Regeln müssen in nginx konfiguriert werden.

Ein nginx-→-Apache-Aufbau wurde erkannt. Die Regeln gelten nur für Anfragen, die Apache erreichen; nginx liest .htaccess nicht.

Nach dem Hinzufügen oder Löschen auf „Regeln hinzufügen oder aktualisieren“ klicken, um .htaccess zu aktualisieren.

## Sitemap, Weiterleitungen und Rewrite-Regeln

Aktivieren Sie die Sitemap-Erzeugung und wählen Sie die Häufigkeit in den Moduleinstellungen. Im Reiter **Sitemap** prüfen Sie den letzten Lauf und geplante URLs und klicken auf **Sitemaps erzeugen**. Öffnen Sie `sitemap_index.xml` und die Unterdateien. Automatische Läufe hängen vom WHMCS-Cron ab. Der Index kann andere Sitemap-Dateien im Website-Stammverzeichnis enthalten. Überschreibungen verwenden öffentliche Adressen; unveröffentlichte Sprachfassungen gehören nicht hinein. Einzelheiten: [Sitemaps](sitemap_manager.md).

Im **Weiterleitungsmanager** geben Sie Quelle `/old-page/` und Ziel `/new-page/` ein, wählen `301` für dauerhaft oder `302` für vorübergehend, aktivieren, speichern und testen die alte URL. Automatische Weiterleitungen nach Slug-Änderungen haben einen eigenen Schalter und ein Mindestalter. Einzelheiten: [Weiterleitungen](redirects_manager.md).

Im **Rewrite-Manager** prüfen Sie die Regeln und klicken dann **Regeln hinzufügen oder aktualisieren**, damit `.htaccess` geschrieben wird. Bei eigenen Regeln geben Sie URL-Muster, Ziel und Flags ein und wenden die Regeln erneut an. `.htaccess` gilt für Apache; Nginx benötigt entsprechende Serverregeln. Fehlerhafte Regeln können die ganze Website betreffen.

## Anleitung

- Regeln prüfen
- Regeln hinzufügen oder aktualisieren
- Alle Regeln aus .htaccess entfernen
- URL-Muster
- Ziel
- Flags
