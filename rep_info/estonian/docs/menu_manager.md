# Menüüd

Looge menüü, lisage lehti või oma linke ja järjestage üksused lohistades. Alammenüü jaoks valige vanemüksus ning määrake keelepõhised sildid, nähtavus külalistele või klientidele ja seadmed. Määrake asukoht: ühes asukohas saab olla ainult üks menüü. Siselinkide puhul valige, kas URL järgib praegust keelt. Kontrollige avalikku menüüd arvutis ja telefonis.

Iga kirje jaoks saab määrata pealkirja, kirjelduse, CSS-klassid, `rel`-atribuudi, ikooni ja uuel vahekaardil avamise; avaldatud lehti saab lisada automaatselt. Valige arvuti ja mobiili jaoks eraldi, kas menüü täiendab või asendab WHMCS-i navigeerimise. Mooduli lehe link arvutatakse uuesti praeguse slugi, keele ja URL-režiimi järgi; tühi silt kasutab tõlgitud pealkirja või lehe nime. Lehe külastamine ei muuda kliendi profiilikeelt. Server lükkab tagasi ohtlikud URL-skeemid ja siltide HTML-i.

## WHMCS

Lülita mooduli seadetes sisse vajalikud WHMCS-i menüüasukohad. Ühes asukohas saab olla üks menüü, kuid sama menüüd võib kasutada mitmes asukohas. Arvutivaade kehtib alates laiusest 768 px, kitsamal ekraanil mobiilivaade. Väljalülitatud asukoht jätab WHMCS-i tavamenüü muutmata.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

WHMCS-i süsteemiteedel, kus mooduli keele suunamist pole, kasutavad menüüsildid kliendi salvestatud keelt; mooduli lehed kasutavad URL-i keelt. Kui vaikekeelele lubatakse oma tee, saab ka see prefiksi. Tavaline URL on `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Kohandatud lingi võib jätta lokaliseerimata, näiteks `clientarea.php`. Ülemkirje peitmine peidab kogu selle haru.

Lehelingi URL arvutatakse uuesti kehtiva slug'i ja avaldatud tõlke järgi. Kui tõlge puudub, kasutatakse avaldatud vaikekeele versiooni. Kohandatud link võib säilitada sisestatud URL-i; välisaadressid, mailto, tel ja ankrud ei saa keele eesliidet. Mustandeid, kustutatud ja ligipääsupiiranguga lehti ei kuvata.

## zm_pb_menus

Andmed asuvad tabelites `zm_pb_menus`, `zm_pb_menu_items` ja `zm_pb_menu_locations`. Loo või paranda tabelid mooduli andmebaasi jaotises. Puu võib sisaldada kuni 10 taset ja 300 kirjet; vanemkirje kustutamisel tõstetakse selle alamkirjed ühe taseme võrra üles.

## Juhised

- Loo menüü
- Lisage lehti, postitusi või kohandatud linke.
- Järjestuse muutmiseks lohistage elemente. Pesastuse määramiseks kasutage ülemelemendi valikut või teisaldusnuppe.
- Kasuta praeguse lehe keelt
- Kasuta sisestatud URL-i muutmata kujul
- Sildid teistes keeltes
- Nähtav järgmistele kasutajatele
- Seadmed
- Igas asukohas saab olla üks menüü. Asukoha valimine teisaldab sellele määrangu teisest menüüst.
- Ülemise taseme elemendid muutuvad veergudeks ja pesastatud elemendid linkideks. Ilma lingita pealkirja jaoks kasutage URL-i #.
- Menüütabeleid pole veel loodud. Lisage need mooduli andmebaasis.

