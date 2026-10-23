# Smarty

- **Modulinnstillinger → Samle inn Smarty-variabler → Bruk innsamlede Smarty-variabler → Sideredigerer.**

## Variabelkatalog

Aktiver innsamling og bruk av Smarty-variabler i modulinnstillingene, besøk deretter de aktuelle sidene og last inn redigeringsprogrammet på nytt. Katalogen lagrer variablenes navn, typer og struktur, men ikke faktiske verdier eller personopplysninger. Mangler en variabel, besøk siden der den brukes, en gang til.

## Redigering og begrensninger

Åpne Smarty-blokken i sideredigeringen og velg variabler fra katalogen. Bruk tillatte betingelser og løkker; legg til `|escape` når du viser dynamisk tekst. PHP, SQL, metodekall, filinkludering og `nofilter` er ikke tillatt. Lagre siden og kontroller den offentlige visningen.

## resources/available_vars/

Katalogen viser bare variabler som er observert på en side: den gjør dem ikke tilgjengelige på en annen. Koden valideres når den lagres og før visning; blokken får en isolert kopi av tillatte verdier. Betingelser, `foreach`, lokal `assign` og modifikatorer som `escape`, `default`, `count` og `date_format` er tillatt. Utverdier escapes automatisk; skriv tilsiktet HTML i malen. Hvis data mangler eller koden feiler, blir blokken tom, og feilen skrives i PHP-loggen.

Katalogen i `resources/available_vars/` lagrer navn, typer, struktur og kunstige eksempler, men ikke faktiske verdier. Den viser hvor en variabel ble observert uten å gjøre den tilgjengelig på andre sider. Åpne redigereren ved å dobbeltklikke på Smarty-blokken. `Ctrl+Space` søker etter variabler, `Ctrl+S` tar i bruk koden og `F11` åpner fullskjerm. Koden kjøres isolert; ved manglende data blir blokken tom og en advarsel skrives i PHP-loggen.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instruksjoner

- **Samle inn Smarty-variabler** — Aktiver eller deaktiver innsamling av Smarty-variabler.
- **Bruk innsamlede Smarty-variabler** — Aktiver eller deaktiver bruk av innsamlede Smarty-variabler i sideredigereren.
- Smarty-variabel (PHP)
- Smarty: PHP, objektmetoder, statiske kall og nofilter er ikke tillatt.
- Smarty-malen er for stor.
- Smarty
- Smarty-redigerer

