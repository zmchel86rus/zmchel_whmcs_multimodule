# Sitemap

La generazione automatica viene eseguita dopo il cron di WHMCS quando è previsto un aggiornamento. La generazione manuale inizia immediatamente.

Sono incluse le pagine e gli articoli attivi accessibili agli ospiti, comprese le versioni linguistiche pubblicate. Le sostituzioni usano gli URL pubblici delle pagine sostituite.

Se non viene selezionato nulla, la sitemap viene aggiornata ogni giorno.

Quando è attiva, /html-sitemap mostra la sitemap come una normale pagina HTML; sitemap.xml non viene modificato.

## XML

L’XML contiene collegamenti reciproci per le lingue attive e `x-default` per l’indirizzo della lingua predefinita. Le origini dei reindirizzamenti sono escluse da `loc` e dalle alternative linguistiche; un contenuto di ripiego viene marcato con la sua lingua effettiva. I file di pagine e articoli dichiarano lo spazio dei nomi XHTML.

L’hook `AfterCronJob` confronta l’intervallo `ZM_PB_SITEMAP_UPDFREQ` con l’ora dell’ultima generazione riuscita `ZM_PB_SITEMAP_LASTUPD`; quando la sitemap è disattivata, non è disponibile neppure la generazione manuale. Le versioni linguistiche sono selezionate con `lang_active`, non con `lang_status`. Le parti aggiuntive hanno suffissi `_2`, `_3` e successivi. In caso di errore i file precedenti vengono ripristinati e l’ora dell’ultimo successo non cambia. Controlla la scrittura nella radice, in `resources/` e in `inc/editable_consts.php`; ripara le tabelle separatamente nel database del modulo.

La generazione automatica dipende dal cron di WHMCS e dall’intervallo impostato; il pulsante la avvia subito. Sono incluse solo pagine e articoli pubblicati, accessibili agli ospiti, con le loro traduzioni attive. Se una pagina sostituisce una pagina di sistema, viene usato l’URL pubblico della pagina di sistema e non lo slug della sostituzione. I file oltre 50.000 URL o 50 MB vengono suddivisi. L’indice conserva le altre sitemap valide.

Il modulo scrive `sitemap_index.xml`, `sitemap_pages.xml` e `sitemap_posts.xml` nella radice del sito; per una categoria vuota non crea file. Non genera un `sitemap.xml` combinato. Dopo modifiche a pagine o lingue, rigenera le mappe e apri l'indice nel browser. In caso di errore, controlla i permessi di scrittura nella radice; la data dell'ultima generazione riuscita resta invariata.

## Istruzioni

- Genera sitemap
- File nella radice del sito
- Ultima generazione riuscita
- Prossimo aggiornamento non prima del
- **Frequenza di aggiornamento** — Se vuoto, il valore predefinito è 'monthly'.
- **Priorità di aggiornamento** — Se vuoto, il valore predefinito è '0.5'.
