# Kalbų tvarkytuvė

- **Skyriai → Kalbos → Vertimai.** Kiekvienas mygtukas Išsaugoti išsaugo tik vieną vertimą.

Kalbų tvarkytuvė leidžia administravimo srityje redaguoti WHMCS ir modulių kalbinius tekstus. Ši funkcija dar kuriama. Ja gali naudotis modulio superadministratorius; PHP taip pat turi turėti rašymo teises atitinkamuose kalbų kataloguose.

## Skyriaus ir kalbos pasirinkimas

Pirmiausia **Modulio nustatymai → Palaikomos kalbos** įjunkite reikalingas kalbas. Tada **Kalbų tvarkytuvė → Skyriai** pasirinkite WHMCS klientų ar administravimo kalbas, šį modulį arba kitą rastą modulį. Lentelėje matysite esamas, išjungtas ir dar pridedamas kalbas. Skiltyje **Kalbos** pasirinkite failą arba pridėkite trūkstamą kalbą. Naujas failas iš pradžių naudoja atskaitos kalbos tekstus; tai dar nėra paruoštas vertimas. Žyma „neišversta“ reiškia, kad savų vertimų nėra.

## Vertimų redagavimas

Skiltyje **Vertimai** stulpelis **Originalas** rodo pasirinktos kalbos pirminio failo tekstą be jūsų pakeitimų. Jei kalba dar neturi savų tekstų, stulpelis vadinasi **Atskaita**. Ieškokite pagal raktą ar tekstą, filtruokite visus, originalius arba pridėtus raktus ir kiekvieną eilutę išsaugokite atskirai. Galite pridėti savo raktą pasirinktame skyriuje, o vėliau jį pervardyti ar ištrinti. Kai kuriuos kitų modulių katalogus galima tik peržiūrėti, jei jų formato neįmanoma saugiai išsaugoti.

## JSON

**Eksportuoti JSON** atsisiunčia pasirinkto skyriaus ir kalbos raktus bei vertimus. **Importuoti JSON** atnaujina tik jau esančius raktus. Nežinomi ir pasikartojantys raktai praleidžiami ir pateikiami rezultate. Nekeiskite skyriaus ir kalbos identifikatorių bei raktų kelių. Failas negali viršyti 8 MiB.

## Failai ir numatytoji kalba

Kalbos failą galima išjungti ir vėl įjungti; net išjungtą jį galima redaguoti. Bazinis anglų kalbos failas ir dabartinė numatytoji WHMCS kalba yra apsaugoti. Tvarkytuvės pridėtiems WHMCS klientų ir administravimo kalbų failams saugomos kopijos, kad po atnaujinimo juos būtų galima atkurti. Jei **Skyriai** rodo failo vardo taisymą, patikrinkite naują vardą ir spauskite **Taisyti**; taisymas taikomas rastiems skyriams.

Norėdami pakeisti numatytąją kalbą, pirma įjunkite naują kalbą modulio nustatymuose, tada pakeiskite numatytąją WHMCS kalbą ir tik po to išjunkite senąją. Patikrinkite tekstus administravimo ir klientų srityse.

## Instrukcijos

- Skyriai
- Kalbos
- Vertimai
- Ši kalba išjungta, bet jos vertimus vis dar galima redaguoti.
- Palyginimo kalba
- Kiekvienas mygtukas Išsaugoti išsaugo tik vieną vertimą.
- Neišversta
- Rodyti pradinius
- Rodyti pridėtus
- Šie vertimų raktai nebuvo importuoti:
- nežinomas raktas
- pasikartojantis raktas
