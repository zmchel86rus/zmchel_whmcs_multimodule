# Sprachverwaltung

- **Bereiche → Sprachen → Übersetzungen.** Jede Speichern-Schaltfläche speichert nur eine Übersetzung.

Die Sprachverwaltung bearbeitet WHMCS- und Modultexte im Administrationsbereich. Die Funktion befindet sich noch in Entwicklung. Zugriff hat der Superadministrator des Moduls; PHP benötigt Schreibrechte für die betroffenen Sprachverzeichnisse.

## Bereich und Sprache auswählen

Aktivieren Sie zuerst die benötigten Sprachen unter **Moduleinstellungen → Unterstützte Sprachen**. Öffnen Sie dann **Sprachverwaltung → Bereiche** und wählen Sie die Client- oder Administrationssprachen von WHMCS, dieses Modul oder ein anderes erkanntes Modul. Die Tabelle zeigt vorhandene, deaktivierte und noch hinzufügbare Sprachen. Unter **Sprachen** wählen Sie eine Datei oder fügen eine fehlende Sprache hinzu. Eine neue Datei übernimmt zunächst Texte aus einer Referenzsprache und ist damit noch nicht übersetzt. Die Kennzeichnung für unübersetzt zeigt an, dass keine eigenen Übersetzungen vorliegen.

## Übersetzungen bearbeiten

Unter **Übersetzungen** zeigt **Original** den Text aus der ursprünglichen Datei der gewählten Sprache ohne Ihre Override-Änderungen. Fehlen eigene Texte, heißt die Spalte **Referenz**. Suchen Sie nach Schlüssel oder Text, filtern Sie nach allen, ursprünglichen oder hinzugefügten Schlüsseln und speichern Sie jede Zeile einzeln. Eigene Schlüssel können Sie innerhalb eines gewählten Abschnitts ergänzen und später umbenennen oder löschen. Einige Kataloge fremder Module sind nur lesbar, wenn ihr Format nicht sicher gespeichert werden kann.

## JSON

**JSON exportieren** lädt Schlüssel und Übersetzungen für den ausgewählten Bereich und die Sprache herunter. **JSON importieren** aktualisiert nur vorhandene Schlüssel. Unbekannte und doppelte Schlüssel werden übersprungen und im Ergebnis aufgeführt. Lassen Sie Bereichs- und Sprachkennungen sowie Schlüsselpfade unverändert. Die Uploadgrenze beträgt 8 MiB.

## Sprachdateien und Standardsprache

Sprachdateien lassen sich deaktivieren und wieder aktivieren; deaktivierte Dateien bleiben bearbeitbar. Die englische Basisdatei und die aktuelle WHMCS-Standardsprache sind geschützt. Für vom Manager angelegte WHMCS-Client- und Administrationssprachen werden Sicherungskopien zur Wiederherstellung nach Updates gespeichert. Erscheint unter **Bereiche** eine Dateinamenkorrektur, prüfen Sie den neuen Namen und klicken Sie auf **Korrigieren**; die Änderung gilt für die erkannten Bereiche.

Um die Standardsprache zu wechseln, aktivieren Sie die neue Sprache zuerst in den Moduleinstellungen, ändern dann die WHMCS-Standardsprache und deaktivieren erst danach die alte Sprache. Prüfen Sie die Texte sowohl im Administrations- als auch im Clientbereich.

## Anleitung

- Bereiche
- Sprachen
- Übersetzungen
- Diese Sprache ist deaktiviert, ihre Übersetzungen können aber weiterhin bearbeitet werden.
- Referenzsprache
- Jede Speichern-Schaltfläche speichert nur eine Übersetzung.
- Nicht übersetzt
- Originale anzeigen
- Hinzugefügte anzeigen
- Die folgenden Übersetzungsschlüssel wurden nicht importiert:
- unbekannter Schlüssel
- doppelter Schlüssel
