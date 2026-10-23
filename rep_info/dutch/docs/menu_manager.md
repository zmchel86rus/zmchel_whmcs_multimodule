# Menu's

Maak een menu, voeg pagina’s of eigen links toe en rangschik de onderdelen door ze te slepen. Kies een bovenliggend onderdeel voor submenu’s en stel labels per taal, zichtbaarheid voor gasten of klanten en apparaten in. Wijs een locatie toe; elke locatie kan maar één menu gebruiken. Bepaal voor interne links of de URL de huidige taal volgt. Controleer het openbare menu op desktop en telefoon.

Per item kunt u een titel, beschrijving, CSS-klassen, `rel`, pictogram en openen in een nieuw tabblad instellen; gepubliceerde pagina’s kunnen ook automatisch worden toegevoegd. Kies voor desktop en mobiel afzonderlijk of het menu de WHMCS-navigatie aanvult of vervangt. Een link naar een modulepagina wordt opnieuw berekend uit de huidige slug, taal en URL-modus; een leeg label gebruikt de vertaalde titel of paginanaam. Een paginabezoek verandert de profieltaal van de klant niet. De server weigert onveilige URL-schema’s en HTML in labels.

## WHMCS

Schakel de gewenste WHMCS-menuposities in via de module-instellingen. Per positie kan één menu worden toegewezen; hetzelfde menu mag op meerdere posities staan. De desktopweergave geldt vanaf 768 px en de mobiele weergave daaronder. Een uitgeschakelde positie laat het standaardmenu van WHMCS ongemoeid.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Op WHMCS-systeemroutes zonder taalroutering van de module gebruiken menulabels de opgeslagen klanttaal; modulepagina’s gebruiken de taal van de URL. Als de standaardtaal een eigen route krijgt, krijgt die ook een voorvoegsel. Een gewone URL is `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Een aangepaste link kan ongewijzigd blijven, bijvoorbeeld `clientarea.php`. Een verborgen bovenliggend item verbergt de hele tak.

De URL van een pagina-item wordt opnieuw opgebouwd uit de huidige slug en de gepubliceerde vertaling. Ontbreekt die vertaling, dan wordt de gepubliceerde versie in de standaardtaal gebruikt. Een aangepaste link kan de ingevoerde URL ongewijzigd houden; externe adressen, mailto, tel en ankers krijgen geen taalprefix. Concepten, verwijderde en ontoegankelijke pagina's worden niet getoond.

## zm_pb_menus

De gegevens staan in `zm_pb_menus`, `zm_pb_menu_items` en `zm_pb_menu_locations`. Maak of herstel deze tabellen via Moduledatabase. De boom ondersteunt maximaal 10 niveaus en 300 items; bij het verwijderen van een bovenliggend item schuiven de onderliggende items één niveau omhoog.

## Instructies

- Maak een menu, voeg pagina’s of eigen links toe en rangschik de onderdelen door ze te slepen.
