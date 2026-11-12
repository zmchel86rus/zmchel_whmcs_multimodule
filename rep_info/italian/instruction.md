[![Osservatori](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Osservatori)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Stelle](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Stelle)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Fork](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Fork)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Segnalazioni](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Segnalazioni)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule: istruzioni

**zmchel WHMCS Multimodule è gratuito.** Offre un editor visuale di pagine, contenuti multilingue, menu, libreria multimediale, campi SEO, sitemap XML, reindirizzamenti, regole di riscrittura e importazione/esportazione.

## Prima del primo utilizzo

**Prima del primo utilizzo, apri Impostazioni del modulo → Lingue supportate e attiva le lingue necessarie.**

A ogni attivazione, il modulo genera automaticamente nuovi salt e li scrive in `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Verifica che tutti e tre i valori salt siano compilati.

## Compatibilità e funzionalità verificate

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Compatibilità con i server web

Apache è pienamente supportato. Il modulo può funzionare anche con Nginx, ma l’instradamento delle lingue nella pagina iniziale potrebbe richiedere una configurazione aggiuntiva.

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
