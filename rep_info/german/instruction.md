# Anleitung für ZMChel WHMCS Multimodule

**Erzeugen Sie vor der Verwendung unbedingt eigene Salt-Werte und tragen Sie diese in `module_init.php` ein: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` und `ZM_PB_NONCE_SALT`.** Das Modul wurde für **WHMCS 8.13.1–8.13.7** entwickelt und getestet; **Apache wird vollständig unterstützt (100 %)**. Es kann auch mit Nginx funktionieren; die Sprachführung auf der Startseite sollte dort gesondert geprüft und gegebenenfalls eingerichtet werden.

**Öffnen Sie vor der ersten Verwendung Moduleinstellungen → Unterstützte Sprachen und aktivieren Sie die benötigten Sprachen.**

**Geprüfte PHP-Versionen:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 und 8.5. Alle PHP-Dateien haben die Syntaxprüfung mit jeder Version bestanden; zusätzlich wurden eigenständige Tests ausgeführt.

**ZMChel WHMCS Multimodule ist kostenlos.** Damit lassen sich Website-Inhalte im WHMCS-Administrationsbereich verwalten: mit visuellem Seiten- und Blockeditor, mehrsprachigen Inhalten, Menüs, Mediathek, SEO-Metadaten, XML-Sitemaps, Weiterleitungen, Rewrite-Regeln sowie Import und Export.

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
