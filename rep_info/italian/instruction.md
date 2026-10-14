# zmchel WHMCS Multimodule: istruzioni

**Prima di usare il modulo, genera salt univoci e inseriscili in `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` e `ZM_PB_NONCE_SALT`.

Sviluppato e testato con **WHMCS 8.13.1–8.13.7**; compatibilità PHP verificata dalla versione **7.4 alla 8.5**. Apache è pienamente supportato. Il modulo può funzionare anche con Nginx, ma l’instradamento delle lingue nella pagina iniziale può richiedere altre impostazioni. **Il modulo è gratuito.**

## Accesso e pagine

Nel pannello WHMCS apri **Addons → zmchel WHMCS Multimodule**. L’elenco delle pagine consente di creare, cercare, modificare ed eliminare pagine. Lo *slug* è la parte dell’indirizzo dopo il dominio, ad esempio `contact` in `/contact/`. Esporta le impostazioni prima di cambiare URL, reindirizzamenti o regole del server.

Per creare una pagina, inserisci un nome interno e uno slug con lettere latine, numeri e trattini, senza dominio né `.php`. Scegli l’accesso: visitatori, clienti autenticati o misto. Seleziona stato (bozza, pubblicata, differita o cestino), tipo (pagina, articolo o pagina di sistema) e lingue. La lingua predefinita di WHMCS deve essere presente in `supported_langs.php` e viene aggiunta automaticamente.

Dopo il salvataggio apri la pagina e modifica le **impostazioni principali**, il **contenuto**, i **metadati** e le opzioni della **sitemap**. Ogni modulo ha il proprio pulsante Salva; «Salva tutto» li elabora tutti. Controlla i messaggi di conferma e visita la pagina pubblica. L’eliminazione sposta prima la pagina nel cestino; la cancellazione definitiva si esegue da lì.

## Contenuto e lingue

Nella scheda Contenuto seleziona una lingua e trascina i blocchi GrapesJS nell’area di lavoro. Modifica testo, immagini e opzioni del blocco selezionato, poi salva quella lingua. Sono disponibili sezioni, colonne, tabelle, FAQ, fisarmoniche, moduli di contatto, elenchi, paginazione, aree per ospiti/clienti e codice personalizzato. Copia struttura o contenuto in un’altra lingua e traduci i testi prima della pubblicazione.

Con URL leggibili e instradamento linguistico, la lingua predefinita usa `/contact/`; le altre un prefisso come `/it/contact/`. Nei blocchi Link e Pulsante, abilita l’aggiunta della lingua corrente solo per le pagine tradotte del sito. Lasciala disattivata per link esterni, file, `mailto:`, `tel:` e percorsi WHMCS senza traduzioni. Controlla i link in più lingue.

## SEO, media e menu

Per ogni lingua compila titolo, descrizione, immagine social, URL canonico, regole robots e tipo Schema nella scheda Metadati. Una pagina pubblicata non di sistema può comparire nella sitemap XML. Nella libreria multimediale carica le immagini, inserisci un testo alternativo utile e verifica la qualità dopo l’ottimizzazione.

Nel Gestore dei menu crea un menu, aggiungi pagine o link personalizzati, ordina gli elementi e scegli posizione e visibilità. A ogni posizione può essere assegnato un solo menu. Per sostituire una pagina WHMCS, pubblica prima la nuova pagina, configura la sostituzione nell’elenco e prova l’URL WHMCS originale da visitatore e da cliente autenticato.

## Strumenti del sito

Nel Gestore dei reindirizzamenti imposta origine e destinazione: `301` per uno spostamento permanente, `302` per uno temporaneo. Il Gestore delle riscritture controlla le regole degli URL leggibili. Genera le sitemap nella relativa scheda e controlla `sitemap_index.xml`. Le impostazioni del modulo controllano anche menu, Smarty, manutenzione e importazione/esportazione. Un’esportazione JSON non sostituisce un backup completo di WHMCS.

Il modulo di contatto può inviare un ticket WHMCS o un’email. Configura campi, destinatario o reparto di supporto, consensi e CAPTCHA, poi esegui un invio reale di prova. Se mancano tabelle del modulo, usa la sezione Database del modulo.

## Documentazione aggiuntiva (English)

[Menu](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Paginazione](../english/docs/pagination.md) · [Sitemap](../english/docs/sitemaps.md) · [Reindirizzamenti](../english/docs/redirects.md) · [Dati strutturati](../english/docs/structured-data.md) · [Importazione ed esportazione](../english/docs/transfer.md).
