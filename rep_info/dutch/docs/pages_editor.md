# Pagina-editor

- [Paginering en filters](pages_editor_pagination.md)
- [Smarty en variabelen](pages_editor_smarty.md)
- [Gestructureerde gegevens](module_structured_data.md)

## 3. Inhoud bewerken

Open de pagina en bewerk per taal de tabbladen Inhoud, Metagegevens en Sitemap. Sleep blokken naar het canvas, wijzig tekst en afbeeldingen en sla elk tabblad op. Gebruik Kopiëren met inhoud voor een uitgangsversie of Kopiëren van structuur voor een lege vertaalindeling. Een kopie vertaalt de tekst niet automatisch.

## 4. Links en publicatie

Gebruik bij een link naar een vertaalde modulepagina de optie om de huidige taal aan de URL toe te voegen. Schakel die uit voor externe links, e-mailadressen en WHMCS-routes zonder taalversie. Controleer na publicatie de pagina als gast en als klant, op desktop en mobiel. Test ook titel, afbeeldingen, formulieren en de tweede taal.

## SEO

Controleer in de basisinstellingen naam, slug, type, status, toegang en talen. De standaardtaal van WHMCS moet in de module actief zijn; een gepubliceerde pagina heeft inhoud nodig in de getoonde taal. Vul per taal titel en beschrijving in en controleer canonical, robots, Open Graph, broodkruimels en Schema. Kies op het sitemaptabblad frequentie en prioriteit voor een openbare pagina die geen systeempagina is. Sla op en controleer de openbare URL en XML.

## Contactformulier

Voeg een blok **Contactformulier** toe. Kies een **WHMCS-ticket** met supportafdeling of **e-mail** met ontvanger; vul kop, beschrijving, onderwerp en knoptekst in. Geef elk veld een naam, type, verplichting en validatie. Voor een gastticket zijn velden met de rollen afzendernaam en e-mailadres nodig. Zet bij keuzelijsten één optie per regel, bijvoorbeeld `sales : Verkoop`. Maak voor elke toestemming een apart veld en gebruik de CAPTCHA van WHMCS. Sla op en verstuur als gast een echte test; controleer het ticket of de aflevering, fouten en het leegmaken van het formulier. Een groene editorstatus bevestigt geen aflevering; stel SMTP in WHMCS in als `mail()` faalt.

## Instructies

- Geneste flex-indelingscontainer. Sleep andere blokken erin.
- Geneste CSS Grid-container. Sleep andere blokken erin.
- Geneste Bootstrap-carrousel. Sleep blokken erin; elk blok wordt een dia.
- Alle blokken onder dit blok worden alleen aan ingelogde gebruikers getoond. Werkt alleen wanneer het toegangstype van de pagina Gemengd is.
- Alle blokken onder dit blok worden alleen aan gasten getoond. Werkt alleen wanneer het toegangstype van de pagina Gemengd is.
- **Paginatitel**
- **Metabeschrijving**
- **Canonieke URL**
- **Robots** — index, follow / noindex, nofollow. Bepaalt de indexering.
- **Schematype** — Wanneer dit is uitgeschakeld, wordt voor deze pagina geen Schema.org-JSON-opmaak uitgevoerd.
