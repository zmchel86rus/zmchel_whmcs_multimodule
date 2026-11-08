# Import og eksport

Én ZIP-fil for alle eller utvalgte seksjoner, opptil 128 MiB (ta hensyn til PHPs opplastingsgrenser). Samsvarende sider oppdateres etter slug og tilgangstype, menyer etter navn. Andre oppføringer forblir uendret. Ta med sider når du importerer menyer til et nytt nettsted. Valgte seksjoner som mangler i filen, hoppes over. JSON-filer støttes også ved import.

CSS/JS tas med sammen med sidene, mens bilder og andre opplastede filer tas med i mediebiblioteket. Revisjonshistorikk, innsamlede Smarty-variabler og hemmelige WHMCS-data eksporteres ikke. Generer nettstedskartet på nytt etter importen, og bruk omskrivingsreglene i Behandling av omskrivingsregler.

Sider og innlegg (oversettelser, innhold, SEO, innstillinger for nettstedskart, CSS/JS-blokker)

Samsvarende oppføringer i de valgte seksjonene blir oppdatert fra filen. Vil du fortsette?

## ZIP

Eksporten kan omfatte sider og innlegg med oversettelser, innhold, SEO og CSS/JS; menyer med hierarki og plasseringer; innstillinger, omdirigeringer, egne regler og mediebiblioteket med filer. Revisjonshistorikk, innsamlede Smarty-variabler, WHMCS-kontoer og hemmeligheter og temafiler er utelatt. ZIP-filen er begrenset til 128 MiB; PHP-grensene `upload_max_filesize` og `post_max_size` gjelder også. Ved flytting av menyer til et annet nettsted må sidene importeres samtidig, og like menynavn avklares på forhånd.

Eksportfilen bruker formatet `zmchel_whmcs_multimodule` (versjon 2). Ved import tilpasses URL-ene fra kilden til målets `SystemURL`, mens eksterne lenker beholdes. Import oppretter ikke tabeller: klargjør dem først under Modulens database. Du må bekrefte før start; poster endres i en transaksjon, og erstattede filer gjenopprettes hvis en feil oppstår.
