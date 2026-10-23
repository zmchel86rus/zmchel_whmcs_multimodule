# Gratis multimodul för WHMCS

**Innan du använder modulen måste du skapa unika salts och lägga dem i `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` och `ZM_PB_NONCE_SALT`.

**Öppna Modulinställningar → Språk som stöds och aktivera de språk du behöver innan du börjar använda modulen.**

Modulen utvecklades och testades med **WHMCS 8.13.1–8.13.7**. PHP-kompatibilitet kontrollerades för **7.4–8.5**. Apache stöds fullt ut. Modulen kan även fungera med Nginx, men språkstyrningen på startsidan kan kräva ytterligare inställningar.

**zmchel WHMCS Multimodule är gratis.** Den innehåller en visuell sidredigerare, flerspråkigt innehåll, menyer, mediebibliotek, SEO-fält, XML-webbplatskartor, omdirigeringar, omskrivningsregler samt import och export. Läs [instruktionerna](instruction.md).

## Framtida utveckling

- Lägga till nästlade sidor och sidkategorier.
- Dela upp den nuvarande modulen i komponenter.
- Lägga till behörighetshantering i administrationen.
- Utöka standardspråken i `supported_langs.php`.
- Skapa en kodredigerare för modulens `.tpl`-filer och WHMCS klientteman.
- Skapa en språkfilshanterare för modulen, andra moduler och WHMCS.
- Förbättra mediehanteraren och bygga en mer komplett SEO-hanterare.
- Lägga till flerspråkiga webbplatskartor och en HTML-sida med webbplatskarta.
- Lägga till användningsstatistik i sidhanteraren.
- Lägga till minifiering av JS/CSS/HTML, sidcache och tabelloptimering.
- Skapa ett ordentligt uppdateringssystem.

Detta är **idéer för framtiden, inte en fast tidsplan**.

## Föreslå en idé

[Skicka ditt förslag](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) med ämnet «Предложение по мультимодулю».

## Ställ en fråga

[Skicka din fråga via e-post](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) med ämnet «Задать вопрос по модулю».
