# Smarty-blok en veranderlikekatalogus

Skakel eers die insameling en gebruik van Smarty-veranderlikes in Module settings aan. ZM_PB_COLLECT_VARS bou die katalogus; ZM_PB_USE_COLLECT_VARS laat die blok en sy uitvoer toe. Besoek die relevante openbare bladsye en herlaai die redigeerder om nuwe voorstelle te sien.

## Katalogus

Die lêers is in resources/available_vars/ per tema en sjabloon. Hulle teken name, tipes, geneste struktuur en waarnemingstadiums aan, maar nie werklike waardes nie. Merkers soos sampled en truncated wys beperkte monsters. Wagwoorde, tokens en persoonlike inligting word as redacted gemerk. 'n Ontbrekende veld in die katalogus bewys nie dat dit in elke versoek ontbreek nie. Getters, modelverhoudings en nuwe databasisnavrae word nie uitgevoer nie. Die lêergids word met .htaccess beskerm, maar bevat geen regte waardes om op Nginx blootgestel te word nie.

## Redigeerder

Klik **Edit code** in die bloknutsbalk of dubbelklik die Smarty-blok. CodeMirror wys die kode, beskikbare veranderlikes en 'n soekpaneel. Ctrl+Space soek veranderlikes; Ctrl+S pas kode toe; F11 gebruik volskerm; Escape sluit. 'n Versameling kan met {foreach $items as $item} deurloop word en 'n veld met {$item.title|escape} vertoon word. Voeg 'n toestand vir 'n leë lys by en toets die werklike uitset.

## Voorbeeld met foreach

Vir 'n lys wat reeds op die bladsy bestaan, kan jy die patroon {foreach $items as $item} gebruik en die titel met {$item.title|escape} wys. Voeg 'n leë-toestand by wanneer geen items beskikbaar is nie. Die katalogus help jou om die regte veranderlikenaam te vind, maar laai nie die data self nie.

## Uitvoering en beperkings

Kode word by stoor en voor uitvoer gevalideer. Beperkte if, foreach, plaaslike assign, capture en modifiers soos escape, default, count en date_format word toegelaat. PHP, SQL, objekmetodes, willekeurige funksies, insluitlêers, netwerkbronne en nofilter is verbode. Waardes word outomaties ge-escape; skryf doelbewuste HTML in die sjabloon self. 'n Fout of ontbrekende data laat die blok leeg en skryf 'n fout na die PHP-log. Toegangsbeperkte dele word verwyder voordat Smarty-blokke uitgevoer word.
