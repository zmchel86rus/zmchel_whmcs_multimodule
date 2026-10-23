# Moduļa datubāze

- **Moduļa datubāze:** `MISSING` → Atlasīt → Labot Atlasītie vienumi.
- **Dzēst Atlasītie vienumi** — Šo darbību nevar atsaukt.

Lapa **Moduļa datubāze** rāda nepieciešamās tabulas un kolonnas un to stāvokli. Tai var piekļūt tikai norādītais superadministrators. Atveriet to, ja cita sadaļa ziņo par trūkstošu tabulu vai kolonnu. Pārskatiet sarakstu, atlasiet tikai labojamos vienumus un noklikšķiniet uz **Labot atlasītos**. Dažām kolonnām automātisks labojums nav pieejams; pēc darbības pārbaudiet stāvokli vēlreiz.

**Dzēst atlasītos** neatgriezeniski noņem izvēlētos datubāzes objektus. Pirms dzēšanas eksportējiet moduļa datus un izveidojiet datubāzes rezerves kopiju.

## Instrukcijas

- Piekļuve liegta. Moduļa datubāzes lapu var izmantot tikai galvenais administrators (ID …).
- Labot
- Atlasītie vienumi
- Dzēst
- Šo darbību nevar atsaukt.
- Izvēļņu tabulas vēl nav izveidotas. Pievienojiet tās moduļa datubāzē.
- Vispirms moduļa tabulu pārvaldniekā pievienojiet kolonnu optimization_attempted.

## 1. Uzstādīšana un piekļuve

Aktivizējiet papildmoduli WHMCS un piešķiriet piekļuvi pilnvarotajiem administratoriem. Moduļa datubāzes sadaļā pārbaudiet nepieciešamās tabulas. Pārskatiet glītās URL adreses, valodu maršrutus un izvēļņu vietas. Apache izmanto .htaccess; Nginx gadījumā atbilstošie servera noteikumi jākonfigurē atsevišķi.
