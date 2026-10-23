# Gestore delle pagine

## Accesso e pagine

Nel pannello WHMCS apri **Addons → zmchel WHMCS Multimodule**. L’elenco delle pagine consente di creare, cercare, modificare ed eliminare pagine. Lo *slug* è la parte dell’indirizzo dopo il dominio, ad esempio `contact` in `/contact/`. Esporta le impostazioni prima di cambiare URL, reindirizzamenti o regole del server.

Per creare una pagina, inserisci un nome interno e uno slug con lettere latine, numeri e trattini, senza dominio né `.php`. Scegli l’accesso: visitatori, clienti autenticati o misto. Seleziona stato (bozza, pubblicata, differita o cestino), tipo (pagina, articolo o pagina di sistema) e lingue. La lingua predefinita di WHMCS deve essere presente in `supported_langs.php` e viene aggiunta automaticamente.

Dopo il salvataggio apri la pagina e modifica le **impostazioni principali**, il **contenuto**, i **metadati** e le opzioni della **sitemap**. Ogni modulo ha il proprio pulsante Salva; «Salva tutto» li elabora tutti. Controlla i messaggi di conferma e visita la pagina pubblica. L’eliminazione sposta prima la pagina nel cestino; la cancellazione definitiva si esegue da lì.

## URL

Filtra l'elenco per nome, accesso, tipo, stato o lingua. **Visita** apre l'URL pubblico. **Elimina** sposta prima la pagina nel cestino; l'eliminazione definitiva si esegue lì. Se la pagina non si apre, controlla la pubblicazione, la lingua attiva e il tipo di accesso.

## WHMCS

Per sostituire una pagina WHMCS, scegli l'indirizzo di sistema esistente e una pagina pubblicata del modulo. Seleziona la sostituzione completa, l'aggiunta prima o dopo il contenuto normale, oppure solo meta/SEO. Salva e prova l'URL WHMCS originale come visitatore e come cliente autenticato.

## Istruzioni

- Aggiungi pagina
- **Nome della pagina** — Nome interno della pagina
- **Slug della pagina** — Sono consentiti solo lettere latine, trattini e cifre.
- **Tipo di accesso** — Utenti autenticati: solo gli utenti che hanno effettuato l’accesso possono visualizzare la pagina; Ospiti: solo gli ospiti possono accedervi; Misto: tutti possono accedervi, con visibilità controllata dai blocchi presenti nella pagina.
- **Tipo di pagina** — Le pagine di sistema sono escluse dalla sitemap e non sono accessibili agli utenti normali.
- **Lingue della pagina** — La lingua predefinita è sempre inclusa, indipendentemente dalla selezione.
- La sostituzione completa rimpiazza il contenuto visualizzato e i metadati.\ Aggiungi prima inserisce il contenuto prima di quello esistente nella pagina.\ Aggiungi dopo inserisce il contenuto dopo quello esistente nella pagina.\ Solo metadati/SEO sostituisce i metadati della pagina.
- Navigazione dell’elenco delle pagine
