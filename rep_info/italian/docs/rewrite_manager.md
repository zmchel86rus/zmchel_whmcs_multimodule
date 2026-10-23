# Regole di riscrittura

## WHMCS

Regole per gli URL multilingue, incluse le pagine sotto /ru/, /en/ e altri prefissi. Le lingue provengono da supported_langs.php; le regole vengono inserite in .htaccess prima delle regole WHMCS.

Nginx non legge .htaccess, quindi queste regole non funzionano su questo server. Configura regole equivalenti in nginx.

È stata rilevata una configurazione nginx → Apache. Queste regole funzionano solo per le richieste inoltrate ad Apache; nginx non legge .htaccess.

Dopo aver aggiunto o eliminato una regola, fai clic su “Aggiungi o aggiorna le regole” per applicare le modifiche a .htaccess.

## .htaccess

Apri il gestore e confronta le regole con il file principale `.htaccess`. Per una regola personalizzata salva il modello URL, la destinazione e i flag; quindi scegli **Aggiungi o aggiorna le regole** per scrivere il blocco prima delle regole WHMCS. Ricontrolla lo stato e apri una pagina pubblicata nella lingua predefinita e in un'altra. Un modello troppo ampio può coinvolgere altre pagine. Con Nginx → Apache, le regole valgono solo per le richieste inoltrate ad Apache.

## Istruzioni

- Controlla le regole
- Aggiungi o aggiorna le regole
- Rimuovi tutte le regole da .htaccess
- Schema URL
- Destinazione
- Flag
