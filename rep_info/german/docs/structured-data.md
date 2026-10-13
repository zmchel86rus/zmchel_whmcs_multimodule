# Strukturierte Daten in der Ausgabe

| Ausgabe | Schema.org-Auszeichnung |
| --- | --- |
| Navbar, Sidebar, Footer | `SiteNavigationElement` mit echten Beschriftungen, Sprache und URLs nach Zugriffs- und Überschreibungsprüfung. Gruppen nutzen `hasPart`. |
| Inhaltsverzeichnis | `SiteNavigationElement` und `WebPageElement` mit tatsächlich vorhandenen Überschriftenankern. |
| Fragen und Antworten | `FAQPage` nur für sichtbare, nicht leere Fragen und Antworten. Verborgene Blöcke und gewöhnliche Akkordeons fehlen; anklickbare geschlossene `details` zählen. |
| Breadcrumbs | `BreadcrumbList` ab zwei Einträgen. Ein einzelner Eintrag bleibt sichtbar, jedoch ohne Auszeichnung. |
| Organisation und Kontakt | WHMCS-Daten. Die Seitensprache steht in `WebPage`/`ContactPage`, unterstützte Sprachen in `ContactPoint.availableLanguage` als BCP47. |
| Filter, Seitengröße, Paginierung und Kontaktformular | Keine automatische eigene Entität: Bedienelemente sind keine Produkte, Artikel oder Organisationskontakte. |
| Layoutblöcke, Smarty und eigenes HTML | Keine erratene Auszeichnung; vorhandenes Autoren-HTML wird nicht umgeschrieben. |

`SiteNavigationElement` garantiert keine zusätzlichen Links in Suchergebnissen. Google zeigt FAQ-Rich-Results seit Mai 2026 nicht mehr an; korrektes `FAQPage` beschreibt weiterhin echte Inhalte. Für lokale Filter wird kein `SearchAction` angelegt. `inLanguage` wird in Vorlagen für `Organization`, `Person`, `Product` und `Service` nicht erfunden, wenn die Eigenschaft dort nicht gilt.

Quellen: [Google-Richtlinien](https://developers.google.com/search/docs/appearance/structured-data/sd-policies), [SiteNavigationElement](https://schema.org/SiteNavigationElement), [inLanguage](https://schema.org/inLanguage), [Breadcrumbs](https://developers.google.com/search/docs/appearance/structured-data/breadcrumb). Lokale Prüfungen mit PHP DOM: `tests/schema_output.php`, `tests/contact_schema.php`, `tests/table_of_contents.php`, `tests/footer_menu.php`.
