# Reindirizzamenti

Indirizzi esatti: origine → destinazione. L’origine è un percorso dalla radice del sito o un URL di questo sito. La destinazione è un percorso o un URL HTTP(S) completo. Una regola senza parametri di query corrisponde anche alle richieste che li contengono; la destinazione viene utilizzata esattamente come inserita. Le regole si applicano alle richieste GET/HEAD che raggiungono WHMCS.

Predefinito: 14 giorni. Si calcola dall’ultima modifica della pagina pubblicata o delle sue traduzioni attive; se non è mai stata modificata, dalla creazione. Imposta 0 per non applicare ritardi. Le regole automatiche utilizzano HTTP 301.

Gli indirizzi delle pagine sostitutive reindirizzano automaticamente alle pagine di sistema che sostituiscono. Se una sostituzione ha più destinazioni, viene utilizzata la prima configurata. Questi reindirizzamenti funzionano quando le sostituzioni sono attive, indipendentemente dalle regole di Gestione reindirizzamenti.

Inserisci un percorso valido che inizi con / o un URL HTTP(S) completo. L’origine deve appartenere a questo sito; i frammenti # non sono supportati.

## HTTP

Le regole supportano i codici HTTP `301`, `302`, `303`, `307` e `308` e si applicano solo alle richieste `GET`/`HEAD` che raggiungono WHMCS. L’origine corrisponde esattamente al percorso e, se specificati, ai parametri della query; i parametri della destinazione sostituiscono i precedenti. Il gestore salva le regole in `zm_pb_redirects`, ma non crea la tabella durante una richiesta: usa **Database del modulo**. Le colonne URL esistenti sono limitate a 128 byte.

Le regole manuali hanno priorità su quelle automatiche. Cambiare lo slug di una pagina pubblicata può creare un `301` automatico per ogni lingua attiva dopo il ritardo impostato; pubblicare una bozza non lo crea. Le rinomine successive aggiornano le vecchie destinazioni. Una regola con parametri di query prevale su una regola relativa al solo percorso. L'URL di origine deve appartenere a questo sito e non deve includere un frammento `#`.

## Istruzioni

- Origine
- Destinazione
- Attivo
- Disattivato
