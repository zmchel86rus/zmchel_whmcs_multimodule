# Dati strutturati

- **Editor delle pagine → Impostazioni dei metadati → Tipo di Schema → Salva.**

## Che cosa contrassegna il modulo

Menu e indice dei contenuti possono generare `SiteNavigationElement`, le domande e risposte visibili `FAQPage` e un percorso di navigazione con più elementi `BreadcrumbList`. I blocchi di impaginazione, i pulsanti e i filtri non ricevono automaticamente un tipo di contenuto. Il tipo Schema scelto per la pagina controlla il suo JSON-LD; se disattivato, quel markup non viene emesso.

## Verifica dopo la pubblicazione

Nella pagina pubblica controlla JSON-LD, URL canonico, lingua e contenuto realmente visibile. Un markup valido non garantisce un risultato arricchito nei motori di ricerca.

## Schema.org

`SiteNavigationElement` usa link e titoli di menu realmente visibili; l'indice può aggiungere `WebPageElement` per le intestazioni presenti nella pagina. `FAQPage` include solo domande e risposte complete visibili al visitatore: blocchi nascosti e fisarmoniche ordinarie sono esclusi. `BreadcrumbList` viene creato solo con almeno due voci. I dati dell'organizzazione provengono da WHMCS; le lingue di contatto sono in `ContactPoint.availableLanguage` nel formato BCP 47. Il modulo non inventa un tipo Schema per filtri, paginazione, moduli o HTML personalizzato.

## Istruzioni

- **Tipo di Schema** — Se disattivato, il markup JSON Schema.org non viene generato per questa pagina.
- **Percorso di navigazione** — Nome della pagina nel percorso di navigazione
- **URL canonico**
- **Titolo della pagina**
- **Meta descrizione**
- **Titolo Open Graph** — Se vuoto, viene utilizzato il titolo della pagina.
- **Descrizione Open Graph** — Se vuota, viene utilizzata la meta descrizione.
- **Immagine Open Graph** — Se vuota, viene utilizzata l’immagine della pagina.

