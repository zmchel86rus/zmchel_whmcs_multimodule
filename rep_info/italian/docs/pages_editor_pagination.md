# Paginazione

Fai clic sul blocco che contiene l'elenco. Premi Esc per annullare. La paginazione deve trovarsi all'esterno del blocco selezionato.

Per Smarty, indica la variabile contenente l'elenco completo. Senza una variabile, gli elementi HTML del contenitore vengono suddivisi in pagine; se necessario, specifica la classe delle righe o il tag tr. I link mantengono count, sort e i filtri. Sono supportati elenchi indipendenti.

Selezione del numero di elementi: 10, 25, 50, 100, 250

Il selettore del numero di elementi può essere trascinato all'interno della paginazione o in altri blocchi della pagina. Rimane collegato a questa paginazione.

Seleziona un blocco Smarty contenente un elenco. La ricerca e la paginazione devono essere collegate allo stesso blocco.

Indica la variabile contenente l'elenco completo. La ricerca controlla tutti i campi specificati e i filtri vengono applicati congiuntamente. Le condizioni vengono applicate prima del calcolo delle pagine; l'applicazione o la reimpostazione dei filtri riporta alla prima pagina. Se la paginazione è già presente, viene utilizzata la relativa variabile.

## Collegamenti e origine dell'elenco

Posiziona la paginazione fuori dal blocco elenco e scegli quel blocco come destinazione. Per un elenco Smarty, indica la variabile con tutti gli elementi; altrimenti vengono divisi gli elementi HTML del contenitore. Scegli il formato dei link secondo l'impostazione del modulo, `/page/2/` o `?page=2`. Il formato nel percorso richiede regole rewrite. Gli elenchi indipendenti usano parametri separati; i link conservano lingua, filtri e ordinamento.

## Dimensione pagina, SEO e filtri

Imposta il numero di elementi e, se serve, attiva il selettore 10/25/50/100/250. Cambiare dimensione riporta l'elenco alla prima pagina. Noindex si applica solo dalla seconda pagina; controlla il titolo e l'URL canonico. Collega i filtri allo stesso elenco, poi prova la seconda pagina e un risultato filtrato sul sito pubblico.

## page / count / pager

Per una lista Smarty, indica la variabile con tutti gli elementi e conserva il ciclo `{foreach}`: il modulo divide la lista, quindi non aggiungere un secondo `array_slice`. Senza variabile vengono suddivisi gli elementi HTML del contenitore; puoi indicare una classe di riga o il tag `tr`, mentre `thead` e `tfoot` restano intatti. Imposta separatamente per desktop e cellulare il numero di pulsanti attorno alla pagina corrente. Su rotte PHP dirette usa `?page=2`; `/page/2/` richiede regole rewrite. Le pagine successive hanno un canonical proprio e possono ricevere `noindex`.

Se ci sono più elenchi indipendenti, il primo usa `page`, `count` e `sort`; gli altri usano parametri con l'ID del blocco. Con il percorso `/page/N/`, `pager` indica a quale elenco appartiene il numero. Nel blocco Smarty, `$zm_pagination` fornisce `total`, `page`, `pages`, `count` e `offset`. `count` è limitato a 10–250. Se l'elenco è vuoto o occupa una sola pagina, il pannello di paginazione viene nascosto.

## YYYY-MM-DD

I filtri agiscono sullo stesso elenco della paginazione. La ricerca testuale può controllare più campi separati da virgole; l'intervallo di date usa `YYYY-MM-DD` e comprende l'intero ultimo giorno.

## Flex / Grid

Scegli Flex o Grid e imposta larghezze e colonne per dispositivo. Applicare o azzerare un filtro riporta alla prima pagina. Il selettore del numero di risultati può essere spostato senza perdere il collegamento; un pannello duplicato controlla lo stesso elenco.

## Istruzioni

- Non indicizzare le pagine dalla seconda in poi
- Formato dei link
- Numero predefinito di elementi
