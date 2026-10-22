# Bezplatný multifunkčný modul pre WHMCS

**Pred použitím vytvorte jedinečné soli a vložte ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT a ZM_PB_NONCE_SALT do module_init.php.** Modul bol vyvinutý a testovaný s WHMCS 8.13.1–8.13.7. Apache je plne podporovaný. Nginx môže fungovať, ale jazykové smerovanie na úvodnej stránke môže vyžadovať ďalšie nastavenie.

**Pred prvým použitím otvorte Nastavenia modulu → Podporované jazyky a zapnite jazyky, ktoré potrebujete.**

**Overené verzie PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 a 8.5.

**zmchel WHMCS Multimodule je bezplatný.** Umožňuje spravovať stránky a články v administrácii WHMCS pomocou vizuálneho editora, prekladov, ponúk, knižnice médií, polí SEO, máp stránok XML, presmerovaní a pravidiel prepisovania URL.

## Správca jazykov (vo vývoji)

V administrácii WHMCS otvorte Správcu jazykov a vyberte sekciu (klientske alebo administrátorské jazyky WHMCS, tento či iný modul) a jazyk. Porovnajte originál alebo referenčný text s prekladom, upravte jeden riadok a uložte ho; existujúce kľúče možno aj exportovať a importovať ako JSON. Nové jazyky používajú referenčný text, kým ich nepreložíte. Správca zapína a vypína jazykové súbory a opravuje staré názvy; predvolený jazyk najskôr zmeňte vo WHMCS.

## Ďalší vývoj

- Pridať vnorené stránky a kategórie stránok.
- Rozdeliť súčasný monolit na spolupracujúce komponenty.
- Zaviesť správu prístupových práv v administrácii modulu.
- Rozšíriť predvolené jazyky v supported_langs.php.
- Pridať editor kódu pre šablóny modulu a klientské témy, okrem administrátorskej témy.
- Vytvoriť správcu jazykových súborov WHMCS a ďalších modulov.
- Vylepšiť správcu médií.
- Vyvinúť plnohodnotného a efektívneho správcu SEO podľa vzoru Yoast SEO.
- Pridať viacjazyčné mapy XML a stránku s mapou webu v HTML.
- Pridať štatistiky používania do správcu stránok.
- Minifikovať JS, CSS a HTML, ukladať celé stránky do vyrovnávacej pamäte a optimalizovať tabuľky modulu a WHMCS.
- Pridať spoľahlivý systém aktualizácií modulu.

Sú to plány, nie pevný harmonogram.

## Navrhnúť nápad

Pošlite návrh e-mailom. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)

## Položiť otázku

Pošlite otázku o module e-mailom. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)
