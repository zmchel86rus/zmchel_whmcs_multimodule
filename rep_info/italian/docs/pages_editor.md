# Editor delle pagine

- [Paginazione](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Dati strutturati](module_structured_data.md)

## Contenuto e lingue

Nella scheda Contenuto seleziona una lingua e trascina i blocchi GrapesJS nell’area di lavoro. Modifica testo, immagini e opzioni del blocco selezionato, poi salva quella lingua. Sono disponibili sezioni, colonne, tabelle, FAQ, fisarmoniche, moduli di contatto, elenchi, paginazione, aree per ospiti/clienti e codice personalizzato. Copia struttura o contenuto in un’altra lingua e traduci i testi prima della pubblicazione.

Con URL leggibili e instradamento linguistico, la lingua predefinita usa `/contact/` solo se il suo percorso opzionale è disattivato; le altre un prefisso come `/it/contact/`. Nei blocchi Link e Pulsante, abilita l’aggiunta della lingua corrente solo per le pagine tradotte del sito. Lasciala disattivata per link esterni, file, `mailto:`, `tel:` e percorsi WHMCS senza traduzioni. Controlla i link in più lingue.

## WHMCS

Nelle impostazioni di base controlla nome, slug, tipo, stato, accesso e lingue. La lingua predefinita di WHMCS deve essere attiva nel modulo; una pagina pubblicata deve avere contenuto nella lingua mostrata.

## SEO

Per ogni lingua compila titolo e descrizione, poi verifica canonical, robots, Open Graph, breadcrumb e Schema. Nella scheda della sitemap imposta frequenza e priorità per una pagina pubblica non di sistema. Salva e controlla URL pubblico e XML.

## Modulo di contatto

Aggiungi il blocco **Modulo di contatto**. Scegli un **ticket WHMCS** con reparto di supporto oppure un'**e-mail** con destinatario; compila titolo, descrizione, oggetto e testo del pulsante. Per ogni campo imposta nome, tipo, obbligatorietà e convalida. Un ticket di un visitatore richiede campi con i ruoli di nome ed e-mail del mittente. Nella tendina inserisci un'opzione per riga, per esempio `sales : Vendite`. Crea un campo separato per ogni consenso e usa il CAPTCHA configurato in WHMCS. Salva e invia una prova reale come visitatore; controlla ticket o consegna, errori e azzeramento del modulo. Lo stato verde dell'editor non conferma la consegna; imposta SMTP in WHMCS se `mail()` fallisce.

## Istruzioni

- Contenitore con layout Flex annidato. Trascina altri blocchi al suo interno.
- Contenitore CSS Grid annidato. Trascina altri blocchi al suo interno.
- Carosello Bootstrap annidato. Trascina i blocchi al suo interno; ciascuno diventa una diapositiva.
- Tutti i blocchi sotto questo blocco sono visibili solo agli utenti autenticati. Funziona solo quando il tipo di accesso della pagina è Misto.
- Tutti i blocchi sotto questo blocco sono visibili solo agli ospiti. Funziona solo quando il tipo di accesso della pagina è Misto.
- **Titolo della pagina**
- **Meta descrizione**
- **URL canonico**
- **Robots** — index, follow / noindex, nofollow. Controlla l’indicizzazione.
- **Tipo di Schema** — Se disattivato, il markup JSON Schema.org non viene generato per questa pagina.
