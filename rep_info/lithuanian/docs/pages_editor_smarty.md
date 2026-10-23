# Smarty ir kintamieji

- **Modulio nustatymai → Rinkti „Smarty“ kintamuosius → Naudoti surinktus „Smarty“ kintamuosius → Puslapių redaktorius.**

Prieš pridėdami bloką įjunkite Smarty kintamuosius. Naudokite tik leidžiamus kintamuosius, dinamines reikšmes apdorokite escape filtru ir nerodykite asmens duomenų; PHP ir SQL draudžiami.

## Kintamųjų katalogas

Modulio nustatymuose įjunkite Smarty kintamųjų rinkimą ir naudojimą, tada atverkite atitinkamus svetainės puslapius ir atnaujinkite redaktorių. Kataloge saugomi kintamųjų pavadinimai, tipai ir struktūra, tačiau ne tikrosios reikšmės ar asmens duomenys. Jei kintamojo trūksta, dar kartą aplankykite puslapį, kuriame jis naudojamas.

## Redaktorius ir apribojimai

Puslapių redaktoriuje atverkite Smarty bloką ir pasirinkite kintamuosius iš katalogo. Naudokite leidžiamas sąlygas bei ciklus; išvesdami dinaminį tekstą pridėkite `|escape`. PHP, SQL, metodų iškvietimai, failų įtraukimas ir `nofilter` neleidžiami. Išsaugokite puslapį ir patikrinkite viešą rezultatą.

## resources/available_vars/

Katalogas tik parodo puslapyje pastebėtus kintamuosius: jis jų nepadaro pasiekiamų kitame puslapyje. Kodas tikrinamas išsaugant ir prieš rodymą; blokas gauna izoliuotą leidžiamų reikšmių kopiją. Galima naudoti sąlygas, `foreach`, vietinį `assign` ir modifikatorius, tokius kaip `escape`, `default`, `count`, `date_format`. Išvesties reikšmės automatiškai escapinamos; norimą HTML rašykite šablone. Jei trūksta duomenų arba kodas neveikia, blokas lieka tuščias, o klaida įrašoma PHP žurnale.

Katalogas `resources/available_vars/` saugo pavadinimus, tipus, struktūrą ir dirbtinius pavyzdžius, bet ne tikrąsias reikšmes. Jis rodo, kur kintamasis pastebėtas, tačiau nepadaro jo prieinamo kitame puslapyje. Dukart spustelėkite Smarty bloką, kad atvertumėte redaktorių. `Ctrl+Space` ieško kintamųjų, `Ctrl+S` pritaiko kodą, `F11` atveria visą ekraną. Kodas vykdomas atskirai; jei duomenų nėra, blokas lieka tuščias, o perspėjimas patenka į PHP žurnalą.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instrukcijos

- **Rinkti „Smarty“ kintamuosius** — Įjungti arba išjungti „Smarty“ kintamųjų rinkimą.
- **Naudoti surinktus „Smarty“ kintamuosius** — Įjungti arba išjungti surinktų „Smarty“ kintamųjų naudojimą puslapių redaktoriuje.
- „Smarty“ (PHP) kintamasis
- „Smarty“: PHP, objektų metodai, statiniai iškvietimai ir nofilter yra draudžiami.
- „Smarty“ šablonas per didelis.
- Smarty
- Smarty redaktorius
