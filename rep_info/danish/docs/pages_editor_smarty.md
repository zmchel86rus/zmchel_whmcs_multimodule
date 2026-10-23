# Smarty og variabler

- **Modulindstillinger → Indsaml Smarty-variabler → Brug indsamlede Smarty-variabler → Sideeditor.**

Aktivér Smarty-variabler før en Smarty-blok indsættes. Brug kun tilladte variabler, escape dynamiske værdier, og vis ikke persondata; PHP og SQL er ikke tilladt.

## Variabelkatalog

Aktivér indsamling og brug af Smarty-variabler i modulindstillingerne, besøg derefter de relevante sider på webstedet, og genindlæs editoren. Kataloget gemmer variablernes navne, typer og struktur, men ikke deres faktiske værdier eller personoplysninger. Mangler en variabel, så besøg siden, hvor den bruges, igen.

## Editor og begrænsninger

Åbn Smarty-blokken i sideeditoren, og vælg variabler fra kataloget. Brug de tilladte betingelser og løkker; tilføj `|escape`, når du viser dynamisk tekst. PHP, SQL, metodekald, filinkludering og `nofilter` er ikke tilladt. Gem siden, og kontrollér den offentlige visning.

## resources/available_vars/

Kataloget er kun en vejledning til variabler, der er set på en side: det gør dem ikke tilgængelige på en anden. Koden valideres ved gemning og før visning; blokken får en isoleret kopi af tilladte værdier. Betingelser, `foreach`, lokal `assign` og modifikatorer som `escape`, `default`, `count` og `date_format` er tilladt. Outputværdier escapes automatisk; skriv tilsigtet HTML i skabelonen. Hvis data mangler eller koden fejler, er blokken tom, og fejlen skrives i PHP-loggen.

Kataloget i `resources/available_vars/` gemmer navne, typer, struktur og kunstige eksempler, men ikke faktiske værdier. Det viser, hvor en variabel er set, uden at gøre den tilgængelig på en anden side. Åbn editoren med dobbeltklik på Smarty-blokken. `Ctrl+Space` søger efter variabler, `Ctrl+S` anvender koden, og `F11` viser fuld skærm. Koden køres isoleret; mangler data, forbliver blokken tom, og advarslen skrives i PHP-loggen.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Vejledning

- **Indsaml Smarty-variabler** — Aktivér eller deaktiver indsamling af Smarty-variabler.
- **Brug indsamlede Smarty-variabler** — Aktivér eller deaktiver brugen af indsamlede Smarty-variabler i sideeditoren.
- Smarty-variabel (PHP)
- Smarty: PHP, objektmetoder, statiske kald og nofilter er ikke tilladt.
- Smarty-skabelonen er for stor.
- Smarty
- Smarty-editor
