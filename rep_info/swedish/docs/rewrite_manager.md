# Omskrivningsregler

## WHMCS

Regler för språkspecifika URL:er, inklusive sidor under /ru/, /en/ och andra prefix. Språken hämtas från supported_langs.php; reglerna infogas i .htaccess före WHMCS-reglerna.

Nginx läser inte .htaccess, så de här reglerna fungerar inte där. Konfigurera motsvarande regler i nginx.

En konfiguration med nginx → Apache har upptäckts. Reglerna fungerar endast för förfrågningar som vidarebefordras till Apache; nginx läser inte .htaccess.

När du har lagt till eller tagit bort en regel klickar du på ”Lägg till eller uppdatera regler” för att tillämpa ändringarna i .htaccess.

## .htaccess

Öppna hanteraren och jämför reglerna med webbplatsens huvudfil `.htaccess`. Spara URL-mönster, mål och flaggor för en egen regel och välj sedan **Lägg till eller uppdatera regler** så att blocket skrivs före WHMCS-reglerna. Kontrollera status igen och öppna en publicerad sida på standardspråket och ett annat språk. Ett för brett mönster kan påverka andra sidor. Med Nginx → Apache gäller reglerna bara för förfrågningar som vidarebefordras till Apache.

## Instruktioner

- Kontrollera regler
- Lägg till eller uppdatera regler
- Ta bort alla regler från .htaccess
- URL-mönster
- Mål
- Flaggor
