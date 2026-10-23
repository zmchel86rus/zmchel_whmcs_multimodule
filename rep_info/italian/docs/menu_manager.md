# Menu

Crea un menu, aggiungi pagine o collegamenti personalizzati e ordina gli elementi trascinandoli. Scegli un elemento genitore per i sottomenu e imposta etichette per lingua, visibilità per ospiti o clienti e dispositivi. Assegna una posizione: ogni posizione può avere un solo menu. Per i collegamenti interni scegli se l’URL deve seguire la lingua corrente. Controlla il menu pubblico su computer e telefono.

Per ogni elemento puoi impostare titolo, descrizione, classi CSS, `rel`, icona e apertura in una nuova scheda; puoi anche aggiungere automaticamente le pagine pubblicate. Scegli separatamente per desktop e cellulare se il menu integra o sostituisce la navigazione WHMCS. Il collegamento a una pagina del modulo viene ricalcolato secondo slug, lingua e modalità URL correnti; un’etichetta vuota usa il titolo tradotto o il nome della pagina. Visitare una pagina non modifica la lingua del profilo cliente. Il server rifiuta schemi URL non sicuri e HTML nelle etichette.

## WHMCS

Abilita le posizioni del menu WHMCS necessarie nelle impostazioni del modulo. Ogni posizione accetta un solo menu, ma lo stesso menu può essere assegnato a più posizioni. La visualizzazione desktop si applica da 768 px di larghezza; sotto tale soglia si usa quella mobile. Una posizione disattivata lascia invariato il menu standard di WHMCS.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Nelle rotte di sistema WHMCS senza routing linguistico del modulo, le etichette del menu usano la lingua salvata del cliente; le pagine del modulo usano la lingua dell’URL. Se abiliti una rotta propria per la lingua predefinita, anche questa riceve un prefisso. L’URL semplice è `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Un link personalizzato può restare non localizzato, per esempio `clientarea.php`. Nascondere un elemento padre nasconde tutto il suo ramo.

L'URL di una voce collegata a una pagina viene ricalcolato dallo slug attuale e dalla traduzione pubblicata. Se la traduzione manca, si usa la versione pubblicata nella lingua predefinita. Un link personalizzato può mantenere l'URL inserito; indirizzi esterni, mailto, tel e ancore non ricevono prefissi linguistici. Bozze, pagine eliminate e pagine non accessibili non vengono mostrate.

## zm_pb_menus

I dati sono nelle tabelle `zm_pb_menus`, `zm_pb_menu_items` e `zm_pb_menu_locations`. Creale o riparale nella sezione Database del modulo. L'albero supporta fino a 10 livelli e 300 voci; eliminando una voce padre, le figlie salgono di un livello.

## Istruzioni

- Crea menu
- Aggiungi pagine, articoli o link personalizzati.
- Trascina gli elementi per riordinarli. Imposta i livelli di annidamento tramite il selettore della voce principale o i pulsanti di spostamento.
- Usa la lingua della pagina corrente
- Usa l’URL inserito senza modificarlo
- Etichette in altre lingue
- Visibile a
- Dispositivi
- Ogni posizione può avere un solo menu. Selezionando una posizione, la relativa assegnazione viene trasferita qui da un altro menu.
- Gli elementi di primo livello diventano colonne e quelli annidati diventano link. Usa l’URL # per un’intestazione senza link.
- Le tabelle dei menu non sono ancora state create. Aggiungile nel Database del modulo.

