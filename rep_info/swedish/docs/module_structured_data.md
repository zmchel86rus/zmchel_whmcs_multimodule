# Strukturerad data

- **Sidredigerare → Metadatainställningar → Schematyp → Spara.**

## Vad modulen märker upp

Menyer och innehållsförteckningar kan skapa `SiteNavigationElement`, synliga frågor och svar `FAQPage` och en brödsmulesti med flera delar `BreadcrumbList`. Layoutblock, knappar och filter får inte automatiskt en innehållstyp. Sidans valda Schema-typ styr dess JSON-LD; när den är avstängd skickas denna märkning inte ut.

## Kontroll efter publicering

Kontrollera JSON-LD, kanonisk webbadress, språk och faktiskt synligt innehåll på den publika sidan. Giltig märkning garanterar inte ett utökat sökresultat.

## Schema.org

`SiteNavigationElement` använder menylänkar och titlar som faktiskt syns; innehållsförteckningen kan lägga till `WebPageElement` för rubriker som finns på sidan. `FAQPage` tar bara med fullständiga frågor och svar som besökaren ser: dolda block och vanliga dragspel lämnas utanför. `BreadcrumbList` skapas först vid minst två poster. Organisationsuppgifter kommer från WHMCS; kontaktspråk finns i `ContactPoint.availableLanguage` med BCP 47-format. Modulen gissar ingen Schema-typ för filter, paginering, formulär eller egen HTML.

## Instruktioner

- **Schematyp** — När funktionen är inaktiverad genereras ingen Schema.org-JSON-kod för den här sidan.
- **Brödsmulor** — Sidnamn i brödsmulor
- **Kanonisk URL**
- **Sidtitel**
- **Metabeskrivning**
- **Open Graph-titel** — Om fältet lämnas tomt används sidtiteln.
- **Open Graph-beskrivning** — Om fältet lämnas tomt används metabeskrivningen.
- **Open Graph-bild** — Om fältet lämnas tomt används sidbilden.

