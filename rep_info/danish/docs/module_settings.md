# Modulindstillinger

- [Import og eksport](module_settings_transfer.md)

## Vejledning

- Vælg de sprog, modulet kan bruge. Deaktivering sletter ikke indholdet.
- Hvis du bruger pæne URL-adresser på Apache, skal du opdatere reglerne i Rewrite Manager efter sprogændringer.
- **Læsevenlige URL'er** — Aktivér læsevenlige URL'er, herunder system-URL'er.
- **Sprogrouting** — Aktivér eller deaktiver sprogruter. Når funktionen er aktiveret, er sider tilgængelige under /de/, /en/, /es/ og andre understøttede sprogpræfikser. Når den er deaktiveret, viser én side-URL indhold på brugerens valgte sprog.
- **Rute for standardsprog** — Giver standardsproget sit eget URL-præfiks og omdirigerer modulsider uden præfiks til det.
- **Vedligeholdelsestilstand (modul)** — Aktivér eller deaktiver modulets vedligeholdelsestilstand. Denne mere lempelige tilstand tillader WHMCS-hooks og andre komponenter at køre, i modsætning til systemets vedligeholdelsestilstand.
- **Indsaml Smarty-variabler** — Aktivér eller deaktiver indsamling af Smarty-variabler.
- **Brug indsamlede Smarty-variabler** — Aktivér eller deaktiver brugen af indsamlede Smarty-variabler i sideeditoren.
- **Sideoverstyringer** — Aktivér eller deaktiver sideoverstyringer.
- **Opdateringshyppighed** — Hvis intet er valgt, opdateres sitemappet dagligt.
- **HTML-sitemap** — Når funktionen er aktiveret, viser /html-sitemap sitemappet som en almindelig HTML-side; sitemap.xml påvirkes ikke.
- **Websiteheader** — Brugerdefineret HTML til sektionen <head>, herunder <script> og <style>.
- **Websitefooter** — Brugerdefineret HTML før </body>, herunder <script> og <style>.
- **Rediger robots.txt**

## 1. Installation og adgang

Aktivér tilføjelsesmodulet i WHMCS, og giv relevante medarbejdere adgang. Kontrollér de nødvendige tabeller under Moduldatabase. Gennemgå derefter pæne URL'er, sprogruter og menuområder. Apache bruger .htaccess; på Nginx skal tilsvarende serverregler konfigureres særskilt.
