# Import og eksport

Eksportér valgte sektioner før større ændringer. Kontrollér sider, menuer og medier efter import, anvend omskrivningsregler særskilt, og generér sitemappet igen. Dette erstatter ikke en WHMCS-backup. JSON-filer kan også importeres.

## ZIP

Eksporten kan omfatte sider og indlæg med oversættelser, indhold, SEO og CSS/JS; menuer med hierarki og placeringer; indstillinger, omdirigeringer, egne regler og mediebiblioteket med filer. Revisionshistorik, indsamlede Smarty-variabler, WHMCS-konti og hemmeligheder samt temafiler er udeladt. ZIP-filen er begrænset til 128 MiB; PHP-grænserne `upload_max_filesize` og `post_max_size` gælder også. Når menuer flyttes til et andet websted, skal siderne importeres med, og ens menunavne afklares på forhånd.

Eksportfilen bruger formatet `zmchel_whmcs_multimodule` (version 2). Ved import tilpasses kildewebstedets URL'er til destinationswebstedets `SystemURL`, mens eksterne links bevares. Import opretter ikke tabeller: forbered dem først under Modulets database. Der vises en bekræftelse før start; poster ændres i en transaktion, og erstattede filer gendannes ved fejl.
