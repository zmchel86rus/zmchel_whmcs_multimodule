# Talenbeheer

- **Secties → Talen → Vertalingen.** Elke knop Opslaan slaat één vertaling op.

Met Talenbeheer bewerk je vertaalteksten van WHMCS en modules vanuit het beheerpaneel. De functie is nog in ontwikkeling. Alleen de superbeheerder van de module heeft toegang; PHP moet bovendien in de betreffende taalmappen kunnen schrijven.

## Een onderdeel en taal kiezen

Schakel eerst de gewenste talen in via **Module-instellingen → Ondersteunde talen**. Kies daarna bij **Talenbeheer → Onderdelen** de client- of beheertalen van WHMCS, deze module of een gevonden andere module. De tabel toont bestaande, uitgeschakelde en nog toe te voegen talen. Op **Talen** kun je een bestaand bestand kiezen of een nieuwe taal toevoegen. Zo'n nieuw bestand gebruikt aanvankelijk teksten uit een referentietaal; het is daarmee nog niet vertaald. De markering voor onvertaald duidt op een bestand zonder eigen vertalingen.

## Vertalingen bewerken

Op **Vertalingen** toont **Origineel** de tekst uit het oorspronkelijke bestand van de geselecteerde taal, zonder jouw aanpassingen. Heeft de taal nog geen eigen vertaling, dan heet de kolom **Referentie**. Zoek op sleutel of tekst, filter op alle, oorspronkelijke of toegevoegde sleutels en sla elke regel afzonderlijk op. Je kunt binnen een gekozen onderdeel een eigen sleutel toevoegen en die later hernoemen of verwijderen. Sommige bestanden van externe modules zijn alleen leesbaar als hun formaat niet veilig kan worden opgeslagen.

## JSON

Met **JSON exporteren** download je sleutels en vertalingen van het gekozen onderdeel en de gekozen taal. **JSON importeren** werkt alleen bestaande sleutels bij. Onbekende en dubbele sleutels worden overgeslagen en in het resultaat vermeld. Laat de identifiers van onderdeel en taal en de sleutelpaden staan. Een upload mag maximaal 8 MiB zijn.

## Taalbestanden en standaardtaal

Je kunt een taalbestand uitschakelen en weer inschakelen; ook uitgeschakeld blijft het bewerkbaar. Het Engelse basisbestand en de huidige standaardtaal van WHMCS zijn beschermd. Van via de manager toegevoegde WHMCS client- en beheertalen worden kopieën bewaard voor herstel na een update. Verschijnt op **Onderdelen** een correctie voor een bestandsnaam, controleer dan de nieuwe naam en klik op **Herstellen**; de correctie geldt voor de gevonden onderdelen.

Wil je de standaardtaal wijzigen, schakel de nieuwe taal dan eerst in de module-instellingen in, wijzig vervolgens de WHMCS-standaardtaal en schakel pas daarna de oude taal uit. Controleer de teksten in zowel het beheerpaneel als het klantgedeelte.

## Instructies

- Secties
- Talen
- Vertalingen
- Deze taal is uitgeschakeld, maar de vertalingen kunnen nog worden bewerkt.
- Referentietaal
- Elke knop Opslaan slaat één vertaling op.
- Niet vertaald
- Originele tonen
- Toegevoegde tonen
- De volgende vertaalsleutels zijn niet geïmporteerd:
- onbekende sleutel
- dubbele sleutel
