# Struktūrizuoti duomenys

- **Puslapių redaktorius → Metaduomenų nustatymai → „Schema“ tipas → Išsaugoti.**

Kiekvienai kalbai užpildykite metaduomenis ir tinkamą puslapio tipą: WebPage, straipsnio tipą arba ContactPage. Paskelbę patikrinkite JSON-LD ir kanoninį URL.

## Ką modulis žymi

Meniu ir turinys gali sukurti `SiteNavigationElement`, matomi klausimai ir atsakymai `FAQPage`, o kelių dalių naršymo kelias `BreadcrumbList`. Išdėstymo blokams, mygtukams ir filtrams turinio tipas automatiškai nepriskiriamas. Puslapiui pasirinktas Schema tipas valdo jo JSON-LD; išjungus tipą šis žymėjimas nerodomas.

## Patikra po paskelbimo

Viešajame puslapyje patikrinkite JSON-LD, kanoninį URL, kalbą ir iš tikrųjų matomą turinį. Tinkamas žymėjimas negarantuoja išplėstinio paieškos rezultato.

## Schema.org

`SiteNavigationElement` naudoja tik iš tikrųjų matomas meniu nuorodas ir pavadinimus; turinys gali pridėti `WebPageElement` realiai puslapyje esantiems antraščių adresams. `FAQPage` įtraukia tik lankytojui matomus pilnus klausimus ir atsakymus: paslėpti blokai ir paprasti akordeonai neįtraukiami. `BreadcrumbList` kuriamas tik esant bent dviem elementams. Organizacijos duomenys gaunami iš WHMCS; kontaktinės kalbos yra `ContactPoint.availableLanguage` BCP 47 formatu. Filtrams, puslapiavimui, formoms ir nuosavam HTML Schema tipas neatspėjamas.

## Instrukcijos

- **„Schema“ tipas** — Išjungus šiame puslapyje negeneruojamas Schema.org JSON žymėjimas.
- **Naršymo kelias** — Puslapio pavadinimas naršymo kelyje
- **Kanoninis URL**
- **Puslapio antraštė**
- **Metaaprašymas**
- **„Open Graph“ antraštė** — Jei laukas tuščias, naudojama puslapio antraštė.
- **„Open Graph“ aprašymas** — Jei laukas tuščias, naudojamas metaaprašymas.
- **„Open Graph“ vaizdas** — Jei laukas tuščias, naudojamas puslapio vaizdas.
