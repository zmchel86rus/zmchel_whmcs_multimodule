# Menuer

Opret en menu, tilføj sider eller egne links, og sorter punkterne ved at trække dem. Vælg et overordnet punkt til undermenuer, og angiv etiketter pr. sprog, synlighed for gæster eller kunder samt enheder. Tildel en placering; hver placering kan kun have én menu. Vælg for interne links, om URL-en skal følge det aktuelle sprog. Kontrollér den offentlige menu på computer og telefon.

For hvert menupunkt kan du angive titel, beskrivelse, CSS-klasser, `rel`, ikon og åbning i en ny fane; udgivne sider kan også tilføjes automatisk. Vælg særskilt for computer og mobil, om menuen supplerer eller erstatter WHMCS-navigationen. Et link til en modulside beregnes igen ud fra den aktuelle slug, sproget og URL-tilstanden; en tom etiket bruger den oversatte titel eller sidens navn. Et sidebesøg ændrer ikke kundens profilsprog. Serveren afviser usikre URL-skemaer og HTML i etiketter.

## WHMCS

Aktivér de ønskede WHMCS-menuplaceringer i modulets indstillinger. Hver placering kan have én menu, mens den samme menu kan bruges flere steder. Skrivebordsvisningen gælder fra 768 px; på smallere skærme bruges mobilvisningen. Når en placering er slået fra, forbliver WHMCS' standardmenu uændret.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

På WHMCS-systemruter uden modulets sprogrute bruger menuetiketter kundens gemte sprog; modulsider bruger sproget i URL'en. Når standardsprogets egen rute aktiveres, får det også et præfiks. En almindelig URL er `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Et brugerdefineret link kan bevares uden lokalisering, for eksempel `clientarea.php`. Skjules et overordnet punkt, skjules hele grenen.

URL'en for et sidepunkt beregnes på ny ud fra den aktuelle slug og den publicerede oversættelse. Mangler oversættelsen, bruges den publicerede version på standardsproget. Et brugerdefineret link kan bevare den indtastede URL; eksterne adresser, mailto, tel og ankre får ikke sprogpræfiks. Kladder, slettede sider og sider uden adgang vises ikke.

## zm_pb_menus

Data ligger i tabellerne `zm_pb_menus`, `zm_pb_menu_items` og `zm_pb_menu_locations`. Opret eller reparer tabellerne under Modulets database. Træet understøtter højst 10 niveauer og 300 punkter; når et overordnet punkt slettes, flyttes dets underpunkter ét niveau op.

## Vejledning

- Opret en menu, tilføj sider eller egne links, og sorter punkterne ved at trække dem.
