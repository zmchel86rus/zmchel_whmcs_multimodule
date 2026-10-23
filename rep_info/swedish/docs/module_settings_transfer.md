# Import och export

En JSON-fil för alla eller valda avsnitt, upp till 32 MiB (PHP:s uppladdningsgränser gäller också). Matchande sidor uppdateras efter slug och åtkomsttyp, menyer efter namn. Övriga poster lämnas oförändrade. Inkludera sidor när du importerar menyer till en ny webbplats. Valda avsnitt som saknas i filen hoppas över.

CSS/JS inkluderas med sidorna och bilder samt andra uppladdade filer med mediebiblioteket. Versionshistorik, insamlade Smarty-variabler och känsliga WHMCS-uppgifter exporteras inte. Generera webbplatskartan på nytt efter importen och tillämpa omskrivningsreglerna i Hanteraren för omskrivningsregler.

Sidor och inlägg (översättningar, innehåll, SEO, inställningar för webbplatskarta, CSS/JS-block)

Matchande poster i de valda avsnitten kommer att uppdateras från filen. Vill du fortsätta?

## JSON

Exporten kan omfatta sidor och inlägg med översättningar, innehåll, SEO och CSS/JS; menyer med hierarki och platser; inställningar, omdirigeringar, egna regler och mediebiblioteket med filer. Revisionshistorik, insamlade Smarty-variabler, WHMCS-konton och hemligheter samt temafiler utelämnas. JSON-filen är begränsad till 32 MiB; även PHP-gränserna `upload_max_filesize` och `post_max_size` gäller. När menyer flyttas till en annan webbplats ska sidorna importeras samtidigt och lika menynamn lösas i förväg.

Exportfilen använder formatet `zmchel_whmcs_multimodule` (version 1). Vid import anpassas källwebbplatsens URL:er till målets `SystemURL`, medan externa länkar behålls. Import skapar inga tabeller: förbered dem först under Modulens databas. En bekräftelse krävs innan start; poster ändras i en transaktion och ersatta filer återställs om ett fel uppstår.

## Instruktioner

- Menyer och placeringar
- Modulinställningar, åsidosättningar, sidhuvud/sidfot, robots.txt
- Omdirigeringar
- Anpassade omskrivningsregler
- Mediebibliotek (filer och beskrivningar)
