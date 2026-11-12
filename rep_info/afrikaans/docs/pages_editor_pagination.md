# Pagineringblok

1. Plaas die blok voor of ná sy teikenlys. Kies **Select block on canvas** en klik die Smarty-blok of itemhouer; die paginering moet buite die teiken bly.
2. Vir Smarty voer jy die veranderlike met die volledige versameling in, byvoorbeeld $items. Laat die gewone {foreach} in die sjabloon en voeg nie nog 'n array_slice by nie.
3. Kies bladsygrootte en hoeveel knoppies aan die begin, einde en weerskante verskyn, afsonderlik vir rekenaar en selfoon. 'n Tweede paneel kan dieselfde lys beheer.

## Skakels en veelvuldige lyste

Elke blok kies die moduleverstek, /page/2/ of ?page=2. Padskakels benodig werkende rewrite-reëls; direkte PHP-roetes gebruik query-parameters. Filters, sortering, installasiepad en taalvoorvoegsel bly behoue. Die eerste lys gebruik page, count en sort. Later lyste voeg die teikenblok-ID by; met /page/N/ wys pager watter ekstra lys die nommer besit. 'n Gekopieerde kontrolepaneel skep nie 'n nuwe lys nie. Sortering werk slegs met velde wat in die gekose versameling bestaan.

## Lysbronne

Met 'n Smarty-veranderlike verdeel die module die versameling wat reeds op daardie bladsy beskikbaar is. Dit laai nie ontbrekende data uit 'n ander bron nie. Sonder veranderlike verdeel dit HTML-items in die gekose houer. Jy kan 'n herhaalde klas of tag soos tr spesifiseer; thead en tfoot bly in plek. Gebruik 'n veranderlike vir groot dinamiese lyste om volledige voorafweergawe te vermy. Die Smarty-blok ontvang $zm_pagination met total, page, pages, count en offset. Wanneer 'n lys leeg is of op een bladsy pas, verdwyn die kontroles.

## Bladsygrootte, SEO en filters

Die opsionele kieser bied 10, 25, 50, 100 en 250 items. 'n Verandering behou filters en keer daardie lys terug na bladsy een. Die backend begrens count en count_<id> tot 10–250. Latere bladsye kry hul nommer in titel, beskrywing en laaste breadcrumb; canonical wys na die betrokke resultaatbladsy. Die noindex-opsie raak slegs bladsye ná die eerste. Teksfilters kan verskeie kommageskeide velde en 'n skikkingsleutel deursoek. Datumreekse gebruik YYYY-MM-DD en sluit die hele einddag in.

## Datums YYYY-MM-DD

Filters werk op dieselfde lys as paginering. Wanneer jy 'n filter toepas of skoonmaak, begin slegs daardie lys weer op sy eerste bladsy. Gaan ná die toepassing na dat die skakel steeds die gekose taal en sortering behou.

## Uitleg met Flex / Grid

Kies veldwydtes en kolomme per toestelgrootte. Die bladsygrootte-kieser kan na 'n ander houer geskuif word sonder om sy koppeling te verloor. Outomaties gedupliseerde kontroles deel die aktiewe filter en grootte.
