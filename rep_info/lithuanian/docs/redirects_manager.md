# Peradresavimai

Įveskite seną ir naują URL. Nuolatiniam perkėlimui naudokite 301, laikinam — 302; patikrinkite pradinį adresą ir venkite nukreipimo į save.

## HTTP

Taisyklės palaiko HTTP kodus `301`, `302`, `303`, `307`, `308` ir taikomos tik `GET`/`HEAD` užklausoms, pasiekiančioms WHMCS. Šaltinis tiksliai atitinka kelią ir, jei nurodyta, užklausos parametrus; paskirties parametrai pakeičia senuosius. Tvarkyklė saugo taisykles `zm_pb_redirects` lentelėje, bet užklausos metu jos nesukuria: naudokite **Modulio duomenų bazę**. Esamų URL stulpelių riba yra 128 baitai.

Rankinės taisyklės turi pirmenybę prieš automatines. Pakeitus paskelbto puslapio slug, po nustatyto laukimo gali būti sukurtas automatinis `301` kiekvienai aktyviai kalbai; juodraščio paskelbimas to nedaro. Vėlesni pervadinimai atnaujina senų taisyklių paskirties vietas. Taisyklė su užklausos parametrais turi pirmenybę prieš taisyklę tik keliui. Šaltinio URL turi priklausyti šiai svetainei ir neturėti `#` fragmento.

## Instrukcijos

- Tikslūs adresai: šaltinis → paskirties adresas. Šaltinis – kelias nuo svetainės šakninio katalogo arba šios svetainės URL. Paskirties adresas – kelias arba visas HTTP(S) URL. Taisyklė be užklausos parametrų taip pat atitinka užklausas su parametrais; paskirties adresas naudojamas toks, koks įvestas. Taisyklės taikomos GET/HEAD užklausoms, pasiekiančioms WHMCS.
- Šaltinis
- Paskirties adresas
- Įjungta
- Išjungta
- Numatytoji reikšmė: 14 dienų. Skaičiuojama nuo paskutinio paskelbto puslapio arba jo aktyvių vertimų pakeitimo; jei niekada nekeista – nuo sukūrimo. Nustatykite 0, jei nereikia laukti. Automatinės taisyklės naudoja HTTP 301.
- Perrašomų puslapių adresai automatiškai nukreipia į sistemos puslapius, kuriuos jie pakeičia. Jei perrašymas turi kelis paskirties adresus, naudojamas pirmasis sukonfigūruotas. Šie peradresavimai veikia, kai įjungtas puslapių perrašymas, nepriklausomai nuo peradresavimų tvarkytuvės taisyklių.
- Įveskite tinkamą kelią, prasidedantį /, arba visą HTTP(S) URL. Šaltinis turi priklausyti šiai svetainei; # fragmentai nepalaikomi.
