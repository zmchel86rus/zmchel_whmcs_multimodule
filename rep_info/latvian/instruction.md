# zmchel WHMCS Multimodule instrukcija

**Pirms lietošanas ģenerējiet unikālus sāļus un ievietojiet ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT un ZM_PB_NONCE_SALT failā module_init.php.** Modulis izstrādāts un pārbaudīts ar WHMCS 8.13.1–8.13.7. Apache tiek pilnībā atbalstīts. Nginx var darboties, taču valodu maršrutēšanai sākumlapā var būt vajadzīga papildu konfigurācija.

**Pirms pirmās lietošanas atveriet Moduļa iestatījumi → Atbalstītās valodas un ieslēdziet nepieciešamās valodas.**

**Pārbaudītās PHP versijas:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 un 8.5.

**zmchel WHMCS Multimodule ir bezmaksas.** Tas ļauj pārvaldīt lapas un rakstus WHMCS administrācijā, izmantojot vizuālo redaktoru, tulkojumus, izvēlnes, mediju bibliotēku, SEO laukus, XML vietnes kartes, pāradresācijas un URL pārrakstīšanas noteikumus.

## Valodu pārvaldnieks (izstrādē)

WHMCS administrācijā atveriet Valodu pārvaldnieku un izvēlieties sadaļu (WHMCS klientu vai administratoru valodas, šo vai citu moduli) un valodu. Salīdziniet oriģinālu vai atsauci ar tulkojumu, rediģējiet vienu rindu un saglabājiet; esošās atslēgas var arī eksportēt un importēt JSON formātā. Jaunās valodas līdz tulkošanai izmanto atsauci. Pārvaldnieks ieslēdz un izslēdz valodu failus un labo vecos failu nosaukumus; vispirms mainiet noklusējuma valodu WHMCS.

## 1. Uzstādīšana un piekļuve

Aktivizējiet papildmoduli WHMCS un piešķiriet piekļuvi pilnvarotajiem administratoriem. Moduļa datubāzes sadaļā pārbaudiet nepieciešamās tabulas. Pārskatiet glītās URL adreses, valodu maršrutus un izvēļņu vietas. Apache izmanto .htaccess; Nginx gadījumā atbilstošie servera noteikumi jākonfigurē atsevišķi.

## 2. Lapas veidošana

Atveriet lapu sarakstu un pievienojiet lapu. Norādiet iekšējo nosaukumu un slug ar latīņu burtiem, cipariem un defisēm, piemēram, about-us. Izvēlieties piekļuvi visiem, tikai autorizētiem klientiem vai tikai viesiem. Norādiet statusu un valodas. WHMCS noklusējuma valodai jābūt moduļa atbalstītai.

## 3. Satura rediģēšana

Katrai valodai aizpildiet Satura, Metadatu un Vietnes kartes cilnes. Ievelciet blokus redaktorā, mainiet tekstu un attēlus un saglabājiet katru cilni. Kopēšana ar saturu dod sākuma versiju; struktūras kopēšana sagatavo izkārtojumu tulkošanai. Teksts netiek tulkots automātiski.

## 4. Saites un publicēšana

Saitēm uz tulkotām moduļa lapām ieslēdziet pašreizējās valodas pievienošanu URL. Izslēdziet to ārējām saitēm, e-pasta adresēm un WHMCS maršrutiem bez valodu versijām. Pēc publicēšanas pārbaudiet lapu kā viesis un klients, datorā un tālrunī, vismaz divās valodās.

## 5. Pārvaldība un uzturēšana

Izvēļņu pārvaldnieks kontrolē navigāciju, bet mediju pārvaldnieks — attēlus. Pāradresāciju pārvaldnieks izveido 301 un 302 noteikumus. Vietnes karte ģenerē XML failus. Pirms lielām izmaiņām eksportējiet iestatījumus; pēc pārrakstīšanas noteikumu maiņas tos piemērojiet no jauna un pārbaudiet karti.

## Detalizētas tēmas

- [Izvēlnes](docs/menus.md)
- [Lapošana un filtri](docs/pagination.md)
- [Pāradresācijas](docs/redirects.md)
- [Vietnes kartes](docs/sitemaps.md)
- [Smarty un mainīgie](docs/smarty.md)
- [Strukturētie dati](docs/structured-data.md)
- [Imports un eksports](docs/transfer.md)
