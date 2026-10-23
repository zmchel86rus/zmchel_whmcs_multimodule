# Strukturētie dati

- **Lapu redaktors → Metadatu iestatījumi → Schema veids → Saglabāt.**

Katrai valodai aizpildiet metadatus un piemērotu lapas tipu: WebPage, raksta tipu vai ContactPage. Pēc publicēšanas pārbaudiet JSON-LD un kanonisko URL.

## Ko modulis iezīmē

Izvēlnes un satura rādītājs var veidot `SiteNavigationElement`, redzami jautājumi un atbildes `FAQPage`, bet navigācijas ceļš ar vairākiem posmiem `BreadcrumbList`. Izkārtojuma bloki, pogas un filtri automātiski nesaņem satura tipu. Lapai izvēlētais Schema tips nosaka tās JSON-LD; ja tas ir izslēgts, šis marķējums netiek izvadīts.

## Pārbaude pēc publicēšanas

Publiskajā lapā pārbaudiet JSON-LD, kanonisko URL, valodu un faktiski redzamo saturu. Derīgs marķējums negarantē paplašinātu meklēšanas rezultātu.

## Schema.org

`SiteNavigationElement` izmanto tikai patiesi redzamas izvēlnes saites un nosaukumus; satura rādītājs var pievienot `WebPageElement` virsrakstiem, kas lapā tiešām ir. `FAQPage` ietver tikai apmeklētājam redzamus pilnus jautājumus un atbildes: paslēptus blokus un parastus akordeonus neiekļauj. `BreadcrumbList` veido tikai ar vismaz diviem ierakstiem. Organizācijas dati nāk no WHMCS; kontaktvalodas ir `ContactPoint.availableLanguage` BCP 47 formātā. Filtriem, lapošanai, veidlapām un paša HTML Schema tips netiek minēts.

## Instrukcijas

- **Schema veids** — Ja atspējots, šai lapai netiek izvadīts Schema.org JSON marķējums.
- **Navigācijas ceļš** — Lapas nosaukums navigācijas ceļā
- **Kanoniskais URL**
- **Lapas virsraksts**
- **Metaapraksts**
- **Open Graph virsraksts** — Ja lauks ir tukšs, tiek izmantots lapas virsraksts.
- **Open Graph apraksts** — Ja lauks ir tukšs, tiek izmantots metaapraksts.
- **Open Graph attēls** — Ja lauks ir tukšs, tiek izmantots lapas attēls.
