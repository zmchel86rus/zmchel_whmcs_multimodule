# Kieslysbestuurder

Die menu_manager ondersteun afsonderlike kieslyste, bladsy- en artikelsoektog, eie skakels en opskrifte met # as URL. Sleep items om hul volgorde te verander of stel 'n oueritem vir geneste vlakke in. Elke item het 'n etiket en vertalings, titel, beskrywing, CSS-klasse, rel, ikoon, nuwe-oortjie-keuse en sigbaarheid vir gaste of kliënte. Nuwe gepubliseerde bladsye kan outomaties bygevoeg word. 'n Kieslys kan WHMCS-navigasie op rekenaar, selfoon of albei uitbrei of vervang.

## Plekke en skakelaars

Die WHMCS-plekke ClientAreaPrimaryNavbar, ClientAreaSecondaryNavbar, ClientAreaPrimarySidebar en ClientAreaSecondarySidebar word onderskeidelik deur ZM_PB_ENABLE_MAINNAV, ZM_PB_ENABLE_SECONDARYNAV, ZM_PB_ENABLE_MAINSIDEBAR en ZM_PB_ENABLE_SECONDARYSIDEBAR beheer. Afgeskakelde plekke laai nie hul hanteerder nie. Sonder aktiewe toewysing bly die oorspronklike WHMCS-kieslys. Een kieslys kan elke plek beset en dieselfde kieslys mag verskeie plekke gebruik; 'n nuwe toewysing neem 'n besette plek oor. Die module voeg dieper navbar-vlakke en uitbreibare sylyste by.

## Tale en toegang

Op gewone WHMCS-stelselroetes bepaal die gebruiker se gestoorde taal die etikette. Modulebladsye gebruik die taal in die URL sonder om profiel of sessie te verander. Vir 'n eie skakel kan **Link URL language** die ingevoerde URL onveranderd laat terwyl die etiket vertaal word. Die keuse lê in zm_pb_menu_items.localize_url. Bladsyitems bereken hul URL weer uit die huidige slug, mooi URL-instellings en gepubliseerde vertalings. Gewone roetes gebruik ?m=zmchel_whmcs_multimodule&slug=...&lang=.... 'n Leë etiket gebruik breadcrumb, meta-titel of bladsynaam. Konsepte, verwyderde en toegangbeperkte bladsye verskyn nie. Eksterne URLs, mailto, tel en ankers kry geen taalvoorvoegsel nie.

## Tabelle en kode

zm_pb_menus stoor instellings, zm_pb_menu_items die hiërargie en zm_pb_menu_locations die plekke. Skep of herstel die schema in Module database; die kieslysbestuurder verander net inskrywings. Wanneer jy 'n ouer uitvee, skuif sy kinders een vlak op. 'n Kieslys het hoogstens 10 vlakke en 300 items; stoor gebruik een transaksie. Toets die resultaat op selfoon en rekenaar, as gas en as kliënt.
