# Meniji

Ustvarite meni, dodajte strani ali povezave po meri in razvrstite elemente z vlečenjem. Za podmeni izberite nadrejeni element; nastavite oznake po jezikih, vidnost za goste ali stranke in naprave. Dodelite mesto: na vsakem je lahko samo en meni. Za notranje povezave izberite, ali naj URL sledi trenutnemu jeziku. Javni meni preverite na računalniku in telefonu.

Za vsak element lahko določite naslov, opis, razrede CSS, `rel`, ikono in odpiranje v novem zavihku; objavljene strani je mogoče dodati samodejno. Ločeno za računalnik in telefon izberite, ali meni dopolnjuje ali nadomešča navigacijo WHMCS. Povezava do strani modula se znova izračuna glede na trenutni slug, jezik in način URL; prazna oznaka uporabi prevedeni naslov ali ime strani. Obisk strani ne spremeni jezika v profilu stranke. Strežnik zavrne nevarne sheme URL in HTML v oznakah.

## WHMCS

V nastavitvah modula vključite želene položaje menija WHMCS. Vsak položaj lahko uporablja en meni, isti meni pa je lahko dodeljen več položajem. Namizni prikaz velja od širine 768 px, mobilni prikaz na ožjih zaslonih. Izklopljen položaj ne spremeni običajnega menija WHMCS.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Na sistemskih poteh WHMCS brez jezikovnega usmerjanja modula oznake menija uporabljajo shranjeni jezik stranke; strani modula uporabljajo jezik URL-ja. Če dobi privzeti jezik svojo pot, dobi tudi predpono. Navadni URL je `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Lastno povezavo lahko pustite brez lokalizacije, denimo `clientarea.php`. Skritje nadrejenega elementa skrije celotno vejo.

URL elementa strani se znova sestavi iz trenutnega sluga in objavljenega prevoda. Če prevod manjka, se uporabi objavljena različica v privzetem jeziku. Povezava po meri lahko ohrani vneseni URL; zunanji naslovi, mailto, tel in sidra ne dobijo jezikovne predpone. Osnutki, izbrisane in nedostopne strani niso prikazane.

## zm_pb_menus

Podatki so v tabelah `zm_pb_menus`, `zm_pb_menu_items` in `zm_pb_menu_locations`. Ustvarite ali popravite jih v razdelku Podatkovna zbirka modula. Drevo omogoča največ 10 ravni in 300 elementov; ko izbrišete nadrejeni element, se njegovi podrejeni premaknejo eno raven više.

## Navodila

- Ustvarite meni, dodajte strani ali povezave po meri in razvrstite elemente z vlečenjem.
