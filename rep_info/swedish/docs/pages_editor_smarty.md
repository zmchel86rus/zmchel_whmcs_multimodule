# Smarty

- **Modulinställningar → Samla in Smarty-variabler → Använd insamlade Smarty-variabler → Sidredigerare.**

## Variabelkatalog

Aktivera insamling och användning av Smarty-variabler i modulinställningarna. Besök sedan relevanta sidor på webbplatsen och ladda om redigeraren. Katalogen sparar variablernas namn, typer och struktur, men inga verkliga värden eller personuppgifter. Om en variabel saknas, besök sidan där den används igen.

## Redigerare och begränsningar

Öppna Smarty-blocket i sidredigeraren och välj variabler ur katalogen. Använd tillåtna villkor och loopar; lägg till `|escape` när du visar dynamisk text. PHP, SQL, metodanrop, filinkludering och `nofilter` är inte tillåtna. Spara sidan och kontrollera den offentliga visningen.

## resources/available_vars/

Katalogen är bara en guide till variabler som har observerats på en sida: den gör dem inte tillgängliga på en annan. Koden valideras vid sparning och före visning; blocket får en isolerad kopia av tillåtna värden. Villkor, `foreach`, lokal `assign` och modifierare som `escape`, `default`, `count`, `date_format` är tillåtna. Utvärden HTML-kodas automatiskt; skriv avsedd HTML i mallen. Om data saknas eller koden misslyckas blir blocket tomt och felet skrivs i PHP-loggen.

Katalogen i `resources/available_vars/` sparar namn, typer, struktur och konstgjorda exempel, men inga verkliga värden. Den visar var en variabel har observerats utan att göra den tillgänglig på en annan sida. Öppna redigeraren genom att dubbelklicka på Smarty-blocket. `Ctrl+Space` söker variabler, `Ctrl+S` tillämpar koden och `F11` öppnar helskärm. Koden körs isolerat; om data saknas blir blocket tomt och en varning skrivs i PHP-loggen.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instruktioner

- **Samla in Smarty-variabler** — Aktivera eller inaktivera insamling av Smarty-variabler.
- **Använd insamlade Smarty-variabler** — Aktivera eller inaktivera användning av insamlade Smarty-variabler i sidredigeraren.
- Smarty-variabel (PHP)
- Smarty: PHP, objektmetoder, statiska anrop och nofilter är förbjudna.
- Smarty-mallen är för stor.
- Smarty
- Smarty-redigerare

