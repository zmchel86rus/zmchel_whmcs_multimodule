# Sidredigerare

- [Sidnumrering](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Strukturerad data](module_structured_data.md)

## Innehåll och språk

Välj ett språk på fliken Innehåll och dra GrapesJS-block till arbetsytan. Redigera text, bilder och inställningar för det valda blocket och spara språket. Det finns sektioner, kolumner, tabeller, vanliga frågor, dragspel, kontaktformulär, listor, sidnumrering, gäst-/kundzoner och egen kod. Kopiera struktur eller innehåll till ett annat språk och översätt texten före publicering.

Med snygga URL:er och språkstyrning använder standardspråket `/contact/` bara när dess valfria språkväg är avstängd, medan andra språk har prefix som `/sv/contact/`. Slå på aktuellt språk i Länk- och Knapp-block endast för översatta sidor på webbplatsen. Låt det vara av för externa adresser, filer, `mailto:`, `tel:` och WHMCS-rutter utan översättning. Testa länkar på flera språk.

## WHMCS

Kontrollera namn, slug, typ, status, åtkomst och språk i grundinställningarna. WHMCS standardspråk måste vara aktiverat i modulen; en publicerad sida behöver innehåll på språket som visas.

## SEO

Ange titel och beskrivning för varje språk och kontrollera canonical, robots, Open Graph, brödsmulor och Schema. På fliken för webbplatskarta väljer du frekvens och prioritet för en offentlig sida som inte är systemsida. Spara och kontrollera offentlig URL och XML.

## Kontaktformulär

Lägg till blocket **Kontaktformulär**. Välj ett **WHMCS-ärende** med supportavdelning eller **e-post** med mottagare; fyll i rubrik, beskrivning, ämne och knapptext. Ge varje fält namn, typ, obligatorisk inställning och validering. Ett ärende från en gäst kräver fält med rollerna avsändarnamn och e-postadress. Skriv ett val per rad i rullistan, till exempel `sales : Försäljning`. Skapa ett separat fält för varje samtycke och använd CAPTCHA som ställts in i WHMCS. Spara och skicka ett verkligt test som gäst; kontrollera ärendet eller leveransen, fel och tömning av formuläret. Grön status i redigeraren bekräftar inte leverans; konfigurera SMTP i WHMCS om `mail()` misslyckas.

## Instruktioner

- Nästlad container med flexlayout. Dra in andra block i den.
- Nästlad CSS Grid-container. Dra in andra block i den.
- Nästlad Bootstrap-karusell. Dra in block i den; varje block blir en bildruta.
- Alla block under det här blocket visas endast för inloggade användare. Fungerar bara när sidans åtkomsttyp är Blandad.
- Alla block under det här blocket visas endast för gäster. Fungerar bara när sidans åtkomsttyp är Blandad.
- **Sidtitel**
- **Metabeskrivning**
- **Kanonisk URL**
- **Robots** — index, follow / noindex, nofollow. Styr indexeringen.
- **Schematyp** — När funktionen är inaktiverad genereras ingen Schema.org-JSON-kod för den här sidan.
