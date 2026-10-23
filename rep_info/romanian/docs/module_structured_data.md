# Date structurate

- **Editor de pagini → Setări pentru metadate → Tip Schema → Salvează.**

Completați metadatele și un tip adecvat pentru fiecare limbă: WebPage, un tip de articol sau ContactPage. După publicare verificați JSON-LD și URL-ul canonic.

## Ce marchează modulul

Meniurile și cuprinsul pot produce `SiteNavigationElement`, întrebările și răspunsurile vizibile `FAQPage`, iar un traseu de navigare cu mai multe elemente `BreadcrumbList`. Blocurile de aranjare, butoanele și filtrele nu primesc automat un tip de conținut. Tipul Schema ales pentru pagină controlează JSON-LD-ul ei; dacă este dezactivat, acest marcaj nu este afișat.

## Verificarea după publicare

Pe pagina publică verificați JSON-LD, URL-ul canonic, limba și conținutul vizibil în realitate. Un marcaj valid nu garantează un rezultat îmbogățit în căutare.

## Schema.org

`SiteNavigationElement` folosește legăturile și titlurile de meniu vizibile efectiv; cuprinsul poate adăuga și `WebPageElement` pentru titlurile existente pe pagină. `FAQPage` include doar întrebări și răspunsuri complete vizibile vizitatorului: blocurile ascunse și acordeoanele obișnuite sunt excluse. `BreadcrumbList` se creează numai cu cel puțin două elemente. Datele organizației provin din WHMCS; limbile de contact apar în `ContactPoint.availableLanguage` în format BCP 47. Modulul nu ghicește un tip Schema pentru filtre, paginare, formulare sau HTML personalizat.

## Instrucțiuni

- **Tip Schema** — Când opțiunea este dezactivată, marcajul JSON Schema.org nu este generat pentru această pagină.
- **Fir de navigare** — Numele paginii în firul de navigare
- **URL canonic**
- **Titlul paginii**
- **Meta descriere**
- **Titlu Open Graph** — Dacă este gol, se folosește titlul paginii.
- **Descriere Open Graph** — Dacă este goală, se folosește meta descrierea.
- **Imagine Open Graph** — Dacă este goală, se folosește imaginea paginii.
