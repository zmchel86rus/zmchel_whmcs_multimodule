# Skipulögð gögn

- **Síðaritill → Stillingar lýsigagna → Tegund Schema → Vista.**

## Hvað einingin merkir

Valmyndir og efnisyfirlit geta myndað `SiteNavigationElement`, sýnilegar spurningar og svör `FAQPage` og brauðmolar með fleiri en einum lið `BreadcrumbList`. Útlitsblokkir, hnappar og síur fá ekki sjálfkrafa efnisgerð. Valin Schema-gerð stjórnar JSON-LD síðunnar; þegar hún er óvirk er sú merking ekki birt.

## Athugun eftir birtingu

Athugaðu JSON-LD, kanóníska vefslóð, tungumál og það efni sem sést í raun á opinberu síðunni. Rétt merking tryggir ekki auðgaða niðurstöðu í leitarvél.

## Schema.org

`SiteNavigationElement` notar þá valmyndartengla og heiti sem eru í raun sýnileg; efnisyfirlit getur líka bætt við `WebPageElement` fyrir fyrirsagnir sem finnast á síðunni. `FAQPage` tekur aðeins með fullar spurningar og svör sem gestur sér: faldar blokkir og venjulegar fellilistaeiningar eru undanskildar. `BreadcrumbList` verður aðeins til ef atriðin eru að minnsta kosti tvö. Upplýsingar um fyrirtæki koma úr WHMCS; tungumál tengiliða eru í `ContactPoint.availableLanguage` á BCP 47 sniði. Schema-gerð er ekki giskuð fyrir síur, síðuskiptingu, eyðublöð eða sérsniðið HTML.

## Leiðbeiningar

- **Tegund Schema** — Þegar þetta er óvirkt eru Schema.org JSON-gögn ekki birt fyrir þessa síðu.
- **Brauðmolar** — Heiti síðu í brauðmolum
- **Vefslóð með kanónískri tilvísun**
- **Titill síðu**
- **Lýsigagnalýsing**
- **Open Graph-titill** — Ef reiturinn er auður er titill síðunnar notaður.
- **Open Graph-lýsing** — Ef reiturinn er auður er lýsigagnalýsingin notuð.
- **Open Graph-mynd** — Ef reiturinn er auður er mynd síðunnar notuð.
