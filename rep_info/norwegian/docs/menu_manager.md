# Menyer

Opprett en meny, legg til sider eller egne lenker, og sorter elementene ved å dra dem. Velg et overordnet element for undermenyer, og angi etiketter per språk, synlighet for gjester eller kunder samt enheter. Tildel en plassering; hver plassering kan bare ha én meny. Velg om interne lenkers URL skal følge gjeldende språk. Kontroller den offentlige menyen på datamaskin og telefon.

Hvert element kan ha tittel, beskrivelse, CSS-klasser, `rel`, ikon og åpning i ny fane; publiserte sider kan også legges til automatisk. Velg separat for datamaskin og mobil om menyen skal utvide eller erstatte WHMCS-navigasjonen. En lenke til en modulside beregnes på nytt fra gjeldende slug, språk og URL-modus; en tom etikett bruker oversatt tittel eller sidens navn. Å åpne en side endrer ikke språket i kundens profil. Serveren avviser usikre URL-skjemaer og HTML i etiketter.

## WHMCS

Aktiver de ønskede WHMCS-menyplasseringene i modulinnstillingene. Hver plassering kan ha én meny, mens samme meny kan brukes flere steder. Skrivebordsvisning gjelder fra 768 px bredde; smalere skjermer bruker mobilvisning. En deaktivert plassering lar WHMCS-standardmenyen være uendret.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

På WHMCS-systemruter uten modulens språkruting bruker menyetiketter kundens lagrede språk; modulsider bruker språket i URL-en. Når standardspråket får sin egen rute, får det også prefiks. En vanlig URL er `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. En egendefinert lenke kan stå uten lokalisering, for eksempel `clientarea.php`. Å skjule et overordnet element skjuler hele grenen.

URL-en til et sideelement beregnes på nytt fra gjeldende slug og publisert oversettelse. Mangler oversettelsen, brukes den publiserte versjonen på standardspråket. En egendefinert lenke kan beholde den angitte URL-en; eksterne adresser, mailto, tel og ankre får ikke språkprefiks. Utkast, slettede sider og sider uten tilgang vises ikke.

## zm_pb_menus

Dataene ligger i tabellene `zm_pb_menus`, `zm_pb_menu_items` og `zm_pb_menu_locations`. Opprett eller reparer dem under Modulens database. Treet støtter høyst 10 nivåer og 300 elementer; når en overordnet oppføring slettes, flyttes barna ett nivå opp.

## Instruksjoner

- Opprett meny
- Legg til sider, innlegg eller egendefinerte lenker.
- Dra elementene for å endre rekkefølgen. Angi nesting med valg av overordnet element eller flytteknappene.
- Bruk språket til den gjeldende siden
- Bruk den angitte URL-en uendret
- Etiketter på andre språk
- Synlig for
- Enheter
- Hver plassering kan ha én meny. Når du velger en plassering, flyttes tilordningen hit fra en annen meny.
- Elementer på øverste nivå blir kolonner, og nøstede elementer blir lenker. Bruk URL-en # for en overskrift uten lenke.
- Menytabellene er ennå ikke opprettet. Legg dem til i Moduldatabase.

