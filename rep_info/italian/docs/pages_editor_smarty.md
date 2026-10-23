# Smarty

- **Impostazioni del modulo → Raccogli variabili Smarty → Usa le variabili Smarty raccolte → Editor delle pagine.**

## Catalogo delle variabili

Attiva la raccolta e l'uso delle variabili Smarty nelle impostazioni del modulo, poi apri le pagine pertinenti del sito e ricarica l'editor. Il catalogo conserva nomi, tipi e struttura delle variabili, ma non valori reali o dati personali. Se una variabile manca, visita di nuovo la pagina in cui viene usata.

## Editor e limiti

Apri il blocco Smarty nell'editor di pagine e scegli le variabili dal catalogo. Usa le condizioni e i cicli consentiti; aggiungi `|escape` quando mostri testo dinamico. PHP, SQL, chiamate ai metodi, inclusione di file e `nofilter` non sono ammessi. Salva la pagina e controlla il risultato pubblico.

## resources/available_vars/

Il catalogo è solo una guida alle variabili osservate in una pagina: non le rende disponibili in un’altra. Il codice viene validato al salvataggio e prima dell’output; il blocco riceve una copia isolata dei valori consentiti. Sono ammessi condizioni, `foreach`, `assign` locale e modificatori come `escape`, `default`, `count` e `date_format`. I valori in uscita vengono sottoposti a escape automaticamente; scrivi l’HTML desiderato nel modello. Se mancano dati o il codice fallisce, il blocco resta vuoto e l’errore viene registrato nel log PHP.

Il catalogo in `resources/available_vars/` conserva nomi, tipi, struttura ed esempi artificiali, non valori reali. Indica dove è stata osservata una variabile senza renderla disponibile su un'altra pagina. Apri l'editor con un doppio clic sul blocco Smarty. `Ctrl+Space` cerca variabili, `Ctrl+S` applica il codice e `F11` attiva lo schermo intero. Il codice gira in modo isolato; se mancano dati, il blocco resta vuoto e l'avviso va nel log PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Istruzioni

- **Raccogli variabili Smarty** — Attiva o disattiva la raccolta delle variabili Smarty.
- **Usa le variabili Smarty raccolte** — Attiva o disattiva l’utilizzo delle variabili Smarty raccolte nell’editor delle pagine.
- Variabile Smarty (PHP)
- Smarty: PHP, metodi degli oggetti, chiamate statiche e nofilter non sono consentiti.
- Il modello Smarty è troppo grande.
- Smarty
- Editor Smarty

