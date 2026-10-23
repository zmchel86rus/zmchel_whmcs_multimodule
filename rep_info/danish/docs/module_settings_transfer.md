# Import og eksport

Eksportér valgte sektioner før større ændringer. Kontrollér sider, menuer og medier efter import, anvend omskrivningsregler særskilt, og generér sitemappet igen. Dette erstatter ikke en WHMCS-backup.

## JSON

Eksporten kan omfatte sider og indlæg med oversættelser, indhold, SEO og CSS/JS; menuer med hierarki og placeringer; indstillinger, omdirigeringer, egne regler og mediebiblioteket med filer. Revisionshistorik, indsamlede Smarty-variabler, WHMCS-konti og hemmeligheder samt temafiler er udeladt. JSON-filen er begrænset til 32 MiB; PHP-grænserne `upload_max_filesize` og `post_max_size` gælder også. Når menuer flyttes til et andet websted, skal siderne importeres med, og ens menunavne afklares på forhånd.

Eksportfilen bruger formatet `zmchel_whmcs_multimodule` (version 1). Ved import tilpasses kildewebstedets URL'er til destinationswebstedets `SystemURL`, mens eksterne links bevares. Import opretter ikke tabeller: forbered dem først under Modulets database. Der vises en bekræftelse før start; poster ændres i en transaktion, og erstattede filer gendannes ved fejl.

## Vejledning

- Én JSON-fil til alle eller udvalgte sektioner, op til 32 MiB (PHP's uploadgrænser gælder også). Matchende sider opdateres ud fra slug og adgangstype, og menuer ud fra navn. Andre poster forbliver uændrede. Medtag sider ved import af menuer til et nyt website. Valgte sektioner, som ikke findes i filen, springes over.
- CSS/JS medtages sammen med siderne, og billeder og andre uploadede filer med mediebiblioteket. Revisionshistorik, indsamlede Smarty-variabler og fortrolige WHMCS-oplysninger eksporteres ikke. Generér sitemappet igen efter import, og anvend omskrivningsreglerne i Omskrivningsstyring.
- Sider og indlæg (oversættelser, indhold, SEO, sitemapindstillinger, CSS/JS-blokke)
- Menuer og placeringer
- Modulindstillinger, sideoverstyringer, head/footer, robots.txt
- Omdirigeringer
- Brugerdefinerede omskrivningsregler
- Mediebibliotek (filer og beskrivelser)
- Matchende poster i de valgte sektioner opdateres fra filen. Vil du fortsætte?
