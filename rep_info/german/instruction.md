[![Beobachter](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Beobachter)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Sterne](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Sterne)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Forks](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Forks)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Meldungen](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Meldungen)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# Anleitung für ZMChel WHMCS Multimodule

**ZMChel WHMCS Multimodule ist kostenlos.** Damit lassen sich Website-Inhalte im WHMCS-Administrationsbereich verwalten: mit visuellem Seiten- und Blockeditor, mehrsprachigen Inhalten, Menüs, Mediathek, SEO-Metadaten, XML-Sitemaps, Weiterleitungen, Rewrite-Regeln sowie Import und Export.

## Vor der ersten Verwendung

**Öffnen Sie vor der ersten Verwendung Moduleinstellungen → Unterstützte Sprachen und aktivieren Sie die benötigten Sprachen.**

Bei jeder Aktivierung erzeugt das Modul automatisch neue Salt-Werte und schreibt sie in `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Prüfen Sie, ob alle drei Salt-Werte gesetzt sind.

## Geprüfte Kompatibilität und Funktion

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Webserver-Kompatibilität

Apache wird vollständig unterstützt (100 %). Das Modul kann auch mit Nginx funktionieren; die Sprachführung auf der Startseite sollte dort gesondert geprüft und gegebenenfalls eingerichtet werden.

## Moduleinstellungen

Wählen Sie die Sprachen aus, die das Modul verwenden kann. Beim Deaktivieren bleiben die Inhalte erhalten.

- **Moduleinstellungen → Unterstützte Sprachen → Aktivieren**
- **Moduldatenbank → Reparieren Ausgewählte Elemente**
- **Rewrite-Regeln → Regeln prüfen → Regeln hinzufügen oder aktualisieren**

Nginx liest .htaccess nicht; diese Regeln wirken dort nicht. Entsprechende Regeln müssen in nginx konfiguriert werden.

## Seitenmanager

- **Seite hinzufügen → Seitenname → Seiten-Slug → Speichern**
- **Seiteneditor → Inhaltseinstellungen → Metadaten-Einstellungen → Sitemap-Einstellungen der Seite → Alle speichern**
- **Seitenmanager → Besuchen**
- **Sitemap → Sitemaps erstellen**

Nur lateinische Buchstaben, Bindestriche und Ziffern sind erlaubt.

Angemeldete Benutzer: Nur angemeldete Benutzer können die Seite öffnen; Gäste: Nur Gäste können sie öffnen; Gemischt: Alle können sie öffnen, einzelne Blöcke steuern ihre eigene Sichtbarkeit.

Die automatische Erstellung läuft nach dem WHMCS-Cron, sobald ein Update fällig ist. Die manuelle Erstellung startet sofort.

## Anleitungen zu den Bereichen

- [Seitenmanager](docs/pages_manager.md)
- [Seiteneditor](docs/pages_editor.md)
- [Medienmanager](docs/media_manager.md)
- [Menüs](docs/menu_manager.md)
- [Sprachverwaltung](docs/langs_manager.md)
- [Weiterleitungen](docs/redirects_manager.md)
- [Sitemaps](docs/sitemap_manager.md)
- [Rewrite-Regeln](docs/rewrite_manager.md)
- [Moduleinstellungen](docs/module_settings.md)
- [Moduldatenbank](docs/module_db.md)

## Zusätzliche Materialien

- [Paginierung und Filter](docs/pages_editor_pagination.md)
- [Smarty und erfasste Variablen](docs/pages_editor_smarty.md)
- [Schema.org-Strukturdaten](docs/module_structured_data.md)
- [Import und Export](docs/module_settings_transfer.md)
