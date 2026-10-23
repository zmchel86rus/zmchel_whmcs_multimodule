# Smarty en variabelen

- **Module-instellingen → Smarty-variabelen verzamelen → Verzamelde Smarty-variabelen gebruiken → Pagina-editor.**

Schakel Smarty-variabelen in vóór het toevoegen van een Smarty-blok. Gebruik alleen toegestane variabelen, escape dynamische waarden en toon geen persoonsgegevens; PHP en SQL zijn niet toegestaan.

## Variabelencatalogus

Schakel het verzamelen en gebruiken van Smarty-variabelen in bij de module-instellingen. Bezoek daarna de relevante sitepagina's en vernieuw de editor. De catalogus bewaart namen, typen en de structuur van variabelen, maar geen echte waarden of persoonsgegevens. Ontbreekt een variabele, bezoek dan de pagina waarop die voorkomt opnieuw.

## Editor en beperkingen

Open het Smarty-blok in de pagina-editor en kies variabelen uit de catalogus. Gebruik toegestane voorwaarden en lussen; voeg `|escape` toe bij dynamische tekst. PHP, SQL, methodeaanroepen, bestanden invoegen en `nofilter` zijn niet toegestaan. Sla de pagina op en controleer de openbare uitvoer.

## resources/available_vars/

De catalogus is alleen een gids voor variabelen die op een pagina zijn gezien: hij maakt ze niet beschikbaar op een andere pagina. Code wordt bij opslaan en vóór uitvoer gecontroleerd; het blok krijgt een geïsoleerde kopie van toegestane waarden. Voorwaarden, `foreach`, lokale `assign` en modifiers zoals `escape`, `default`, `count` en `date_format` zijn toegestaan. Uitvoerwaarden worden automatisch ge-escaped; schrijf gewenste HTML in de sjabloon. Als gegevens ontbreken of code faalt, blijft het blok leeg en komt de fout in het PHP-logboek.

De catalogus in `resources/available_vars/` bewaart namen, typen, structuur en kunstmatige voorbeelden, maar geen echte waarden. Hij toont waar een variabele is gezien zonder die op andere pagina's beschikbaar te maken. Open de editor door op het Smarty-blok te dubbelklikken. `Ctrl+Space` zoekt variabelen, `Ctrl+S` past code toe en `F11` opent het volledige scherm. De code draait geïsoleerd; bij ontbrekende gegevens blijft het blok leeg en verschijnt een waarschuwing in het PHP-logboek.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instructies

- **Smarty-variabelen verzamelen** — Schakel het verzamelen van Smarty-variabelen in of uit.
- **Verzamelde Smarty-variabelen gebruiken** — Schakel het gebruik van verzamelde Smarty-variabelen in de pagina-editor in of uit.
- Smarty-variabele (PHP)
- Smarty: PHP, objectmethoden, statische aanroepen en nofilter zijn niet toegestaan.
- Het Smarty-sjabloon is te groot.
- Smarty
- Smarty-editor
