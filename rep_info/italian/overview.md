# Multimodulo gratuito per WHMCS

**zmchel WHMCS Multimodule è gratuito.** Offre un editor visuale di pagine, contenuti multilingue, menu, libreria multimediale, campi SEO, sitemap XML, reindirizzamenti, regole di riscrittura e importazione/esportazione. Leggi le [istruzioni](instruction.md).

## Prima del primo utilizzo

**Prima del primo utilizzo, apri Impostazioni del modulo → Lingue supportate e attiva le lingue necessarie.**

A ogni attivazione, il modulo genera automaticamente nuovi salt e li scrive in `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Verifica che tutti e tre i valori salt siano compilati.

Il modulo è stato sviluppato e testato con **WHMCS dalla versione 8.13.0 alla 9.1.0**. La compatibilità con PHP è stata verificata dalla versione **7.4 alla 8.5**. Apache è pienamente supportato. Il modulo può funzionare anche con Nginx, ma l’instradamento delle lingue nella pagina iniziale potrebbe richiedere una configurazione aggiuntiva.

## Sviluppi futuri

- Aggiungere pagine nidificate e categorie.
- Suddividere il modulo attuale in componenti.
- Aggiungere un gestore dei permessi per l’amministrazione.
- Ampliare le lingue predefinite in `supported_langs.php`.
- Creare un editor di codice per i file `.tpl` del modulo e per i temi client di WHMCS.
- ~~Creare un gestore dei file di lingua del modulo, degli altri moduli e di WHMCS.~~
- Migliorare la libreria multimediale e creare un gestore SEO più completo.
- ~~Generare sitemap multilingue e una pagina sitemap HTML.~~
- Aggiungere una pagina HTML della sitemap.
- Aggiungere statistiche d’uso al gestore delle pagine.
- Aggiungere minificazione JS/CSS/HTML, cache delle pagine e ottimizzazione delle tabelle.
- Creare un sistema di aggiornamento adeguato.

Queste sono **idee per il futuro, non una tabella di marcia vincolante**.

## Proporre un’idea

[Invia una proposta](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) con oggetto «Предложение по мультимодулю».

## Fai una domanda

[Invia la tua domanda via e-mail](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) con oggetto «Задать вопрос по модулю».
