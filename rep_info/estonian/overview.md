# Tasuta multimoodul WHMCS-i jaoks

**Enne mooduli kasutamist genereeri unikaalsed soolad ja lisa need faili `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` ja `ZM_PB_NONCE_SALT`.

**Enne esimest kasutuskorda ava Mooduli seaded → Toetatud keeled ja lülita vajalikud keeled sisse.**

Moodul on loodud ja testitud **WHMCS-i versioonidel 8.13.1–8.13.7**. PHP ühilduvust on kontrollitud versioonidel **7.4–8.5**. Apache on täielikult toetatud. Moodul võib töötada ka Nginxiga, kuid keelte suunamine avalehel võib vajada lisaseadistust.

**zmchel WHMCS Multimodule on tasuta.** See sisaldab visuaalset leheredaktorit, mitmekeelset sisu, menüüsid, meediakogu, SEO välju, XML-saidikaarte, ümbersuunamisi, ümberkirjutusreegleid ning importi ja eksporti. Loe [juhendit](instruction.md).

## Keelehaldur (arendamisel)

Ava WHMCS-i halduses Keelehaldur ning vali jaotis (WHMCS-i kliendi- või halduskeeled, see moodul või muu moodul) ja keel. Võrdle algteksti või võrdlusteksti tõlkega, muuda üht rida ja salvesta see; olemasolevaid võtmeid saab ka JSON-failina eksportida ja importida. Uus keel kasutab tõlkimiseni võrdlusteksti. Haldur lülitab keelefaile sisse ja välja ning parandab vanu failinimesid; vaikekeel muuda esmalt WHMCS-is.

## Edasised plaanid

- Lisada pesastatud lehed ja lehekategooriad.
- Jagada praegune moodul komponentideks.
- Lisada administraatori kasutusõiguste haldus.
- Laiendada faili `supported_langs.php` vaikimisi keelte loendit.
- Lisada koodiredaktor mooduli `.tpl` failide ja WHMCS-i klienditeemade jaoks.
- Lisada mooduli, teiste moodulite ja WHMCS-i keelefailide haldur.
- Täiendada meediahaldurit ja luua põhjalikum SEO haldur.
- Lisada mitmekeelsed saidikaardid ja HTML-saidikaardi leht.
- Lisada lehehaldurile kasutusstatistika.
- Lisada JS/CSS/HTML-i minimeerimine, lehtede vahemälu ja tabelite optimeerimine.
- Luua korralik mooduli uuendussüsteem.

Need on **tulevikuideed, mitte kindel tegevuskava**.

## Paku idee

[Saada ettepanek](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) teemaga «Предложение по мультимодулю».

## Esita küsimus

[Saada küsimus e-postiga](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) teemaga «Задать вопрос по модулю».
