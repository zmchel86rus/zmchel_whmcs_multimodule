# Gratis multimodul for WHMCS

**Før du bruker modulen, må du generere unike salter og legge dem inn i `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` og `ZM_PB_NONCE_SALT`.

**Før første bruk åpner du Modulinnstillinger → Støttede språk og aktiverer språkene du trenger.**

Modulen ble utviklet og testet med **WHMCS 8.13.1–8.13.7**. PHP-kompatibilitet ble kontrollert for **7.4–8.5**. Apache støttes fullt ut. Modulen kan også fungere med Nginx, men språkruting på forsiden kan kreve ekstra oppsett.

**zmchel WHMCS Multimodule er gratis.** Den inneholder en visuell sideredigerer, flerspråklig innhold, menyer, mediebibliotek, SEO-felt, XML-nettstedskart, viderekoblinger, omskrivingsregler og import/eksport. Les [bruksanvisningen](instruction.md).

## Videre utvikling

- Legge til nøstede sider og sidekategorier.
- Dele den nåværende modulen opp i komponenter.
- Legge til tilgangsstyring for administrasjonen.
- Utvide standardspråkene i `supported_langs.php`.
- Lage en koderedigerer for modulens `.tpl`-filer og WHMCS-klienttemaer.
- Lage en språkfilbehandler for modulen, andre moduler og WHMCS.
- Forbedre mediebehandleren og lage en mer fullstendig SEO-behandler.
- Legge til flerspråklige nettstedskart og en HTML-side for nettstedskart.
- Legge til bruksstatistikk i sidebehandleren.
- Legge til minifisering av JS/CSS/HTML, sidehurtigbuffer og tabelloptimalisering.
- Lage et skikkelig oppdateringssystem.

Dette er **ideer for fremtiden, ikke en fast plan**.

## Foreslå en idé

[Send et forslag](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) med emnet «Предложение по мультимодулю».

## Still et spørsmål

[Send spørsmålet ditt på e-post](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) med emnet «Задать вопрос по модулю».
