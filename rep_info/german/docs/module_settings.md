# Moduleinstellungen

## WHMCS

Wählen Sie die Sprachen aus, die das Modul verwenden kann. Beim Deaktivieren bleiben die Inhalte erhalten. Wenn Sie sprechende URLs mit Apache verwenden, aktualisieren Sie nach Sprachänderungen die Regeln im Rewrite Manager.

- [Import und Export](module_settings_transfer.md)

## Anleitung

- **Lesbare URLs** — Lesbare URLs einschließlich System-URLs aktivieren.
- **Sprachrouting** — Sprachrouten aktivieren oder deaktivieren. Bei Aktivierung sind Seiten unter /de/, /en/, /es/ und anderen unterstützten Sprachpräfixen erreichbar. Andernfalls zeigt eine URL Inhalte in der für den Benutzer eingestellten Sprache.
- **Route der Standardsprache** — Gibt der Standardsprache ein eigenes URL-Präfix und leitet Modulseiten ohne Präfix dorthin weiter.
- **Wartungsmodus (Modul)** — Den Wartungsmodus des Moduls aktivieren oder deaktivieren. Dieser sanftere Modus lässt WHMCS-Hooks und andere Komponenten weiterlaufen.
- **Smarty-Variablen sammeln** — Sammeln von Smarty-Variablen aktivieren oder deaktivieren.
- **Gesammelte Smarty-Variablen verwenden** — Verwendung gesammelter Smarty-Variablen im Seiteneditor aktivieren oder deaktivieren.
- **Seitenüberschreibungen** — Seitenüberschreibungen aktivieren oder deaktivieren.
- **Aktualisierungsintervall** — Ohne Auswahl wird die Sitemap täglich aktualisiert.
- **HTML-Sitemap** — Bei Aktivierung wird unter /html-sitemap eine normale HTML-Sitemap angezeigt; sitemap.xml bleibt unverändert.
- **Website-Header** — Eigener HTML-Code für den Abschnitt <head>, einschließlich <script> und <style>.
- **Website-Footer** — Eigener HTML-Code vor </body>, einschließlich <script> und <style>.
- **robots.txt bearbeiten**
