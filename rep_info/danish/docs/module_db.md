# Moduldatabase

- **Moduldatabase:** `MISSING` → Vælg → Ret Valgte elementer.
- **Slet Valgte elementer** — Denne handling kan ikke fortrydes.

Siden **Moduldatabase** viser de nødvendige tabeller og kolonner samt deres status. Kun den udpegede superadministrator har adgang. Åbn siden, når et andet modulafsnit melder, at en tabel eller kolonne mangler. Gennemgå listen, vælg kun de elementer, der skal repareres, og klik på **Ret valgte**. Nogle kolonner kan ikke repareres automatisk; kontrollér status igen bagefter.

**Slet valgte** fjerner de valgte databaseobjekter permanent. Eksportér moduldata og tag en sikkerhedskopi af databasen, før du sletter noget.

## Vejledning

- Adgang nægtet. Kun superadministratoren (ID …) kan bruge modulets databaseside.
- Ret
- Valgte elementer
- Slet
- Denne handling kan ikke fortrydes.
- Menutabellerne er endnu ikke oprettet. Tilføj dem i Moduldatabase.
- Tilføj først kolonnen optimization_attempted i modulets tabelhåndtering.

## 1. Installation og adgang

Aktivér tilføjelsesmodulet i WHMCS, og giv relevante medarbejdere adgang. Kontrollér de nødvendige tabeller under Moduldatabase. Gennemgå derefter pæne URL'er, sprogruter og menuområder. Apache bruger .htaccess; på Nginx skal tilsvarende serverregler konfigureres særskilt.
