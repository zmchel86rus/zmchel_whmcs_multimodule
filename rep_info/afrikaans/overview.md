# Gratis multimodule vir WHMCS

**zmchel WHMCS Multimodule is gratis.** Dit bied visuele bladsy- en blokredigering, veeltalige inhoud, kieslyste, mediabestuur, SEO-metadata, XML-werfkaarte, herleidings, rewrite-reëls en invoer of uitvoer vanuit die WHMCS-administrasie. Lees die [aanwysings](instruction.md) vir daaglikse gebruik.

## Voor die eerste gebruik

**Open Module settings → Supported languages en aktiveer die tale wat jy gaan gebruik.**

Die module skep by elke aktivering nuwe waardes vir ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT en ZM_PB_NONCE_SALT in module_init.php. Kontroleer dat al drie ingevul is.

Die module is ontwikkel en getoets op **WHMCS 8.13.0–9.1.0**. **Apache word ten volle ondersteun (100%)**. Nginx kan ook werk, maar die tuisblad se taalroetes kan ekstra konfigurasie en toetsing vereis.

**PHP-versoenbaarheid nagegaan:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 en 8.5. Alle PHP-lêers het sintakskontrole geslaag en selfstandige toetse is ook uitgevoer.

## Toekomstige ontwikkeling

- Voeg geneste bladsye en bladsykategorieë of afdelings by.
- Verdeel die huidige monoliet in komponente wat saamwerk.
- Skep 'n bestuurder vir admin-toegangsregte in die module.
- Brei die verstektaallys in supported_langs.php uit.
- Voeg 'n koderedigeerder vir module-.tpl-lêers en WHMCS-kliëntetemas by, maar nie die admin-tema nie.
- ~~Voeg 'n taalbestuurder vir hierdie module, ander modules en WHMCS-lêers by.~~
- Verbeter die mediabestuurder.
- Bou 'n volledige, doeltreffender SEO-bestuurder geïnspireer deur Yoast SEO.
- ~~Voeg veeltalige sitemap-generering en 'n HTML-werfkaartbladsy by.~~
- Voeg 'n HTML-werfkaartbladsy by.
- Voeg gebruikstatistiek by die bladsybestuurder.
- Skep 'n optimaliseringsbestuurder vir JS/CSS/HTML-minifisering, volbladkas en optimalisering van module- en WHMCS-tabelle.
- Voeg 'n behoorlike module-opdateringstelsel by.

Dit is **idees vir die toekoms, nie 'n vaste padkaart nie**.

## Stel 'n idee voor

[Stuur 'n voorstel](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) met onderwerp «Предложение по мультимодулю».

## Vra 'n vraag

[Stuur jou vraag](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) met onderwerp «Задать вопрос по модулю».
