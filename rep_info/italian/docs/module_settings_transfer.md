# Importazione ed esportazione

Un unico file JSON per tutte le sezioni o per quelle selezionate, fino a 32 MiB (si applicano anche i limiti di caricamento di PHP). Le pagine corrispondenti vengono aggiornate in base allo slug e al tipo di accesso, i menu in base al nome. Gli altri record rimangono invariati. Includi le pagine quando importi i menu in un nuovo sito. Le sezioni selezionate assenti dal file vengono ignorate.

CSS/JS vengono esportati insieme alle pagine; le immagini e gli altri file caricati insieme alla libreria multimediale. La cronologia delle revisioni, le variabili Smarty raccolte e i dati riservati di WHMCS non vengono esportati. Rigenera la sitemap dopo l’importazione e applica le regole di riscrittura in Gestione riscritture.

Pagine e articoli (traduzioni, contenuti, SEO, impostazioni della sitemap, blocchi CSS/JS)

Impostazioni del modulo, sostituzioni delle pagine, intestazione/piè di pagina, robots.txt

I record corrispondenti nelle sezioni selezionate verranno aggiornati dal file. Continuare?

## JSON

L’esportazione può includere pagine e articoli con traduzioni, contenuto, SEO e CSS/JS; menu con gerarchia e posizioni; impostazioni, reindirizzamenti, regole personalizzate e raccolta multimediale con i file. Sono esclusi cronologia delle revisioni, variabili Smarty raccolte, account e segreti WHMCS e file del tema. Il JSON è limitato a 32 MiB; valgono anche i limiti PHP `upload_max_filesize` e `post_max_size`. Per trasferire i menu su un altro sito, importa anche le pagine e risolvi prima gli eventuali nomi di menu duplicati.

Il file esportato usa il formato `zmchel_whmcs_multimodule` (versione 1). Durante l'importazione gli URL del sito di origine vengono adattati al `SystemURL` del sito di destinazione, mentre i link esterni restano invariati. L'importazione non crea tabelle: preparale prima nel Database del modulo. Prima di iniziare compare una conferma; i record cambiano in una transazione e i file sostituiti vengono ripristinati in caso di errore.

## Istruzioni

- Menu e posizioni
- Reindirizzamenti
- Regole di riscrittura personalizzate
- Libreria multimediale (file e descrizioni)
