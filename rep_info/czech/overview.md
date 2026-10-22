# Bezplatný multimodul pro WHMCS

**Před použitím modulu vygenerujte jedinečné soli a vložte je do `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` a `ZM_PB_NONCE_SALT`.

**Před prvním použitím otevřete Nastavení modulu → Podporované jazyky a zapněte jazyky, které potřebujete.**

Modul byl vyvinut a testován na **WHMCS 8.13.1–8.13.7**. Kompatibilita s PHP byla ověřena pro verze **7.4–8.5**. Apache je plně podporován. Modul může fungovat také na Nginxu, ale směrování jazyků na úvodní stránce může vyžadovat další nastavení.

**zmchel WHMCS Multimodule je zdarma.** Obsahuje vizuální editor stránek, vícejazyčný obsah, nabídky, knihovnu médií, pole SEO, XML mapy webu, přesměrování, pravidla přepisování a import/export. Přečtěte si [návod](instruction.md).

## Správce jazyků (ve vývoji)

V administraci WHMCS otevřete Správce jazyků a vyberte sekci (klientské nebo administrátorské jazyky WHMCS, tento či jiný modul) a jazyk. Porovnejte původní nebo referenční text s překladem, upravte řádek a uložte jej; existující klíče lze také exportovat a importovat jako JSON. Nové jazyky používají referenční text, dokud je nepřeložíte. Správce zapíná a vypíná jazykové soubory a opravuje staré názvy; výchozí jazyk nejprve změňte ve WHMCS.

## Plány do budoucna

- Přidat vnořené stránky a kategorie.
- Rozdělit současný modul na komponenty.
- Přidat správu přístupových práv v administraci.
- Rozšířit výchozí jazyky v `supported_langs.php`.
- Vytvořit editor kódu pro soubory `.tpl` modulu a klientské šablony WHMCS.
- Vytvořit správce jazykových souborů modulu, dalších modulů a WHMCS.
- Vylepšit správce médií a vytvořit úplnějšího správce SEO.
- Přidat vícejazyčné mapy webu a HTML stránku s mapou webu.
- Přidat statistiky používání správce stránek.
- Přidat minifikaci JS/CSS/HTML, mezipaměť celých stránek a optimalizaci tabulek.
- Vytvořit řádný systém aktualizací.

Jde o **nápady do budoucna, nikoli o pevný plán**.

## Navrhnout nápad

[Pošlete svůj návrh](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) s předmětem «Предложение по мультимодулю».

## Položit otázku

[Pošlete svůj dotaz e-mailem](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) s předmětem «Задать вопрос по модулю».
