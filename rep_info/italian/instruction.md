# zmchel WHMCS Multimodule: istruzioni

**Prima di utilizzare il modulo, genera salt univoci e inseriscili in `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` e `ZM_PB_NONCE_SALT`.

**Prima del primo utilizzo, apri Impostazioni del modulo → Lingue supportate e attiva le lingue necessarie.**

Il modulo è stato sviluppato e testato con **WHMCS dalla versione 8.13.1 alla 8.13.7**. La compatibilità con PHP è stata verificata dalla versione **7.4 alla 8.5**. Apache è pienamente supportato. Il modulo può funzionare anche con Nginx, ma l’instradamento delle lingue nella pagina iniziale potrebbe richiedere una configurazione aggiuntiva.

**zmchel WHMCS Multimodule è gratuito.** Offre un editor visuale di pagine, contenuti multilingue, menu, libreria multimediale, campi SEO, sitemap XML, reindirizzamenti, regole di riscrittura e importazione/esportazione.

## Impostazioni del modulo

Scegli le lingue utilizzabili dal modulo. Disattivare una lingua non ne elimina i contenuti.

- **Impostazioni del modulo → Lingue supportate → Attiva**
- **Database del modulo → Correggi Elementi selezionati**
- **Regole di riscrittura → Controlla le regole → Aggiungi o aggiorna le regole**

Nginx non legge .htaccess, quindi queste regole non funzionano su questo server. Configura regole equivalenti in nginx.

## Gestore delle pagine

- **Aggiungi pagina → Nome della pagina → Slug della pagina → Salva**
- **Editor delle pagine → Impostazioni del contenuto → Impostazioni dei metadati → Impostazioni della sitemap della pagina → Salva tutto**
- **Gestore delle pagine → Visita**
- **Sitemap → Genera sitemap**

Sono consentiti solo lettere latine, trattini e cifre.

Utenti autenticati: solo gli utenti che hanno effettuato l’accesso possono visualizzare la pagina; Ospiti: solo gli ospiti possono accedervi; Misto: tutti possono accedervi, con visibilità controllata dai blocchi presenti nella pagina.

La generazione automatica viene eseguita dopo il cron di WHMCS quando è previsto un aggiornamento. La generazione manuale inizia immediatamente.

## Guide per sezione

- [Gestore delle pagine](docs/pages_manager.md)
- [Editor delle pagine](docs/pages_editor.md)
- [Gestione dei file multimediali](docs/media_manager.md)
- [Menu](docs/menu_manager.md)
- [Gestore delle lingue](docs/langs_manager.md)
- [Reindirizzamenti](docs/redirects_manager.md)
- [Sitemap](docs/sitemap_manager.md)
- [Regole di riscrittura](docs/rewrite_manager.md)
- [Impostazioni del modulo](docs/module_settings.md)
- [Database del modulo](docs/module_db.md)

## Materiali aggiuntivi

- [Paginazione](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [Dati strutturati](docs/module_structured_data.md)
- [Importazione ed esportazione](docs/module_settings_transfer.md)
