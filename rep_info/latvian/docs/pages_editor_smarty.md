# Smarty un mainīgie

- **Moduļa iestatījumi → Apkopot Smarty mainīgos → Izmantot apkopotos Smarty mainīgos → Lapu redaktors.**

Pirms bloka pievienošanas ieslēdziet Smarty mainīgos. Izmantojiet tikai atļautos mainīgos, apstrādājiet dinamiskās vērtības ar escape un neatklājiet personas datus; PHP un SQL nav atļauti.

## Mainīgo katalogs

Moduļa iestatījumos ieslēdziet Smarty mainīgo vākšanu un izmantošanu, pēc tam atveriet attiecīgās vietnes lapas un atsvaidziniet redaktoru. Katalogā saglabājas mainīgo nosaukumi, tipi un struktūra, bet ne reālās vērtības vai personas dati. Ja mainīgais trūkst, vēlreiz apmeklējiet lapu, kurā tas tiek izmantots.

## Redaktors un ierobežojumi

Lapu redaktorā atveriet Smarty bloku un izvēlieties mainīgos no kataloga. Izmantojiet atļautos nosacījumus un ciklus; izvadot dinamisku tekstu, pievienojiet `|escape`. PHP, SQL, metožu izsaukumi, failu iekļaušana un `nofilter` nav atļauti. Saglabājiet lapu un pārbaudiet publisko rezultātu.

## resources/available_vars/

Katalogs ir tikai norāde uz lapā novērotajiem mainīgajiem: tas tos nepadara pieejamus citā lapā. Kodu pārbauda saglabājot un pirms attēlošanas; bloks saņem atļauto vērtību izolētu kopiju. Atļauti nosacījumi, `foreach`, lokāls `assign` un modifikatori, piemēram, `escape`, `default`, `count`, `date_format`. Izvades vērtības tiek automātiski escapētas; vajadzīgo HTML ierakstiet veidnē. Ja datu nav vai kods kļūdains, bloks paliek tukšs un kļūda nonāk PHP žurnālā.

Katalogs `resources/available_vars/` glabā nosaukumus, tipus, struktūru un mākslīgus piemērus, nevis īstās vērtības. Tas rāda, kur mainīgais novērots, bet nepadara to pieejamu citā lapā. Atveriet redaktoru, veicot dubultklikšķi uz Smarty bloka. `Ctrl+Space` meklē mainīgos, `Ctrl+S` lieto kodu un `F11` atver pilnekrānu. Kods darbojas izolēti; trūkstošu datu gadījumā bloks paliek tukšs un brīdinājums nonāk PHP žurnālā.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instrukcijas

- **Apkopot Smarty mainīgos** — Iespējot vai atspējot Smarty mainīgo apkopošanu.
- **Izmantot apkopotos Smarty mainīgos** — Iespējot vai atspējot apkopoto Smarty mainīgo izmantošanu lapu redaktorā.
- Smarty (PHP) mainīgais
- Smarty: PHP, objektu metodes, statiskie izsaukumi un nofilter ir aizliegti.
- Smarty veidne ir pārāk liela.
- Smarty
- Smarty redaktors
