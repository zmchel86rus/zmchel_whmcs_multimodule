# Puslapių redaktorius

- [Puslapiavimas ir filtrai](pages_editor_pagination.md)
- [Smarty ir kintamieji](pages_editor_smarty.md)
- [Struktūrizuoti duomenys](module_structured_data.md)

## 3. Turinio redagavimas

Kiekvienai kalbai užpildykite Turinio, Metaduomenų ir Svetainės schemos skirtukus. Nuvilkite blokus į rengyklę, pakeiskite tekstą bei paveikslėlius ir išsaugokite kiekvieną skirtuką. Kopijavimas su turiniu suteikia pradinį variantą, o struktūros kopijavimas paruošia išdėstymą vertimui. Tekstas automatiškai neverčiamas.

## 4. Nuorodos ir skelbimas

Nuorodoms į išverstus modulio puslapius įjunkite dabartinės kalbos pridėjimą prie URL. Išjunkite jį išorinėms nuorodoms, el. paštui ir WHMCS maršrutams be kalbinių versijų. Paskelbę patikrinkite puslapį kaip svečias ir klientas, kompiuteryje ir telefone, bent dviem kalbomis.

## SEO

Pagrindiniuose nustatymuose patikrinkite pavadinimą, slug, tipą, būseną, prieigą ir kalbas. Numatytoji WHMCS kalba turi būti įjungta modulyje; paskelbtame puslapyje turi būti turinys rodoma kalba. Kiekvienai kalbai užpildykite pavadinimą ir aprašymą, tada patikrinkite canonical, robots, Open Graph, naršymo kelią ir Schema. Svetainės žemėlapio skirtuke pasirinkite viešo nesisteminio puslapio dažnį ir prioritetą. Išsaugokite bei patikrinkite viešą URL ir XML.

## Kontaktų forma

Pridėkite bloką **Kontaktų forma**. Pasirinkite **WHMCS užklausą** ir pagalbos skyrių arba **el. laišką** ir gavėją; įrašykite antraštę, aprašymą, temą ir mygtuko tekstą. Kiekvienam laukui nustatykite pavadinimą, tipą, privalomumą ir tikrinimą. Svečio užklausai reikia laukų su siuntėjo vardo ir el. pašto vaidmenimis. Išskleidžiamojo sąrašo variantus rašykite po vieną eilutėje, pavyzdžiui `sales : Pardavimai`. Kiekvienam sutikimui kurkite atskirą lauką ir naudokite WHMCS CAPTCHA. Išsaugokite ir pateikite tikrą bandymą kaip svečias; patikrinkite užklausą ar pristatymą, klaidas ir formos išvalymą. Žalia redaktoriaus būsena pristatymo nepatvirtina; jei `mail()` neveikia, nustatykite WHMCS SMTP.

## Instrukcijos

- Įdėtinis lankstaus išdėstymo (Flex) konteineris. Vilkite kitus blokus į jo vidų.
- Įdėtinis CSS Grid konteineris. Vilkite kitus blokus į jo vidų.
- Įdėtinė „Bootstrap“ karuselė. Vilkite blokus į jos vidų; kiekvienas taps skaidre.
- Visi blokai, esantys po šiuo bloku, rodomi tik prisijungusiems naudotojams. Veikia tik tada, kai puslapio prieigos tipas yra mišrus.
- Visi blokai, esantys po šiuo bloku, rodomi tik svečiams. Veikia tik tada, kai puslapio prieigos tipas yra mišrus.
- **Puslapio antraštė**
- **Metaaprašymas**
- **Kanoninis URL**
- **Paieškos sistemų robotai** — index, follow / noindex, nofollow. Valdo indeksavimą.
- **„Schema“ tipas** — Išjungus šiame puslapyje negeneruojamas Schema.org JSON žymėjimas.
