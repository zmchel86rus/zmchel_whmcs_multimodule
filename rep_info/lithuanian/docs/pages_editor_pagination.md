# Puslapiavimas ir filtrai

Spustelėkite sąrašo bloką. Esc atšaukia pasirinkimą. Puslapiavimo blokas turi būti už pasirinkto bloko ribų.

Naudodami Smarty nurodykite viso sąrašo kintamąjį. Jei kintamasis nenurodytas, puslapiais skirstomi konteinerio HTML elementai; prireikus nurodykite eilučių klasę arba žymą tr. Nuorodose išsaugomi count, sort ir filtrai. Palaikomi keli nepriklausomi sąrašai.

Elementų skaičiaus puslapyje pasirinkiklis: 10, 25, 50, 100, 250

Puslapio dydžio pasirinkiklį galite nuvilkti į puslapiavimo bloką arba kitus puslapio blokus. Jis liks susietas su šiuo puslapiavimu.

Pasirinkite Smarty sąrašo bloką. Paieška ir puslapiavimas turi būti susieti su tuo pačiu bloku.

Nurodykite viso sąrašo kintamąjį. Paieška tikrina bet kurį pasirinktą lauką, o filtrai taikomi kartu. Sąlygos pritaikomos prieš skaičiuojant puslapius; pritaikius arba atstačius filtrus grįžtama į pirmą puslapį. Jei puslapiavimas jau susietas, naudojamas jo kintamasis.

Puslapiavimą ir filtrus susiekite su tuo pačiu sąrašu. Pasirinkite rezultatų skaičių ir URL formą; patikrinkite antrą puslapį bei filtrą.

## Nuorodos ir sąrašo šaltinis

Puslapių skaidymą dėkite už sąrašo bloko ribų ir pasirinkite tą bloką kaip taikinį. Smarty sąrašui nurodykite kintamąjį su visais elementais; kitu atveju skaidomi konteinerio HTML elementai. Pasirinkite nuorodų formatą pagal modulio nustatymą, `/page/2/` arba `?page=2`. Kelio formatui reikia rewrite taisyklių. Nepriklausomi sąrašai naudoja atskirus parametrus; nuorodos išsaugo kalbą, filtrus ir rikiavimą.

## Puslapio dydis, SEO ir filtrai

Nustatykite elementų skaičių ir prireikus įjunkite 10/25/50/100/250 pasirinkimą. Pakeitus dydį sąrašas grįžta į pirmą puslapį. Noindex taikomas tik nuo antro puslapio; patikrinkite antraštę ir kanoninį URL. Susiekite filtrus su tuo pačiu sąrašu ir viešoje svetainėje išbandykite antrą puslapį bei filtruotą rezultatą.

## page / count / pager

Smarty sąrašui nurodykite kintamąjį su visais elementais ir palikite `{foreach}` ciklą: modulis pats padalija sąrašą, todėl nepridėkite antro `array_slice`. Be kintamojo dalijami konteinerio HTML elementai; galima nurodyti eilutės klasę arba žymą `tr`, o `thead` ir `tfoot` lieka. Mygtukų skaičių aplink esamą puslapį nustatykite atskirai kompiuteriui ir telefonui. Tiesioginiams PHP maršrutams naudokite `?page=2`; `/page/2/` reikia rewrite taisyklių. Kiti puslapiai turi savo canonical ir gali gauti `noindex`.

Jei yra keli nepriklausomi sąrašai, pirmasis naudoja `page`, `count` ir `sort`, o kiti — parametrus su bloko ID. Kelyje `/page/N/` `pager` nurodo, kuriam sąrašui priklauso numeris. Smarty bloke `$zm_pagination` pateikia `total`, `page`, `pages`, `count` ir `offset`. `count` apribojamas iki 10–250. Kai sąrašas tuščias arba telpa viename puslapyje, puslapiavimo juosta paslepiama.

## YYYY-MM-DD

Filtrai veikia tą patį sąrašą kaip puslapiavimas. Teksto paieška gali tikrinti kelis kableliais atskirtus laukus; datų intervalas naudoja `YYYY-MM-DD` ir apima visą paskutinę dieną.

## Flex / Grid

Rinkitės Flex arba Grid ir nustatykite pločius bei stulpelius pagal įrenginį. Pritaikius arba išvalius filtrą grįžtama į pirmą puslapį. Rezultatų skaičiaus parinkiklį galima perkelti neprarandant ryšio; dubliuotas skydelis valdo tą patį sąrašą.

## Instrukcijos

- Neindeksuoti antro ir vėlesnių puslapių
- Nuorodų formatas
- Numatytasis elementų skaičius puslapyje
