# Sidhanterare

## Åtkomst och sidor

Öppna **Addons → zmchel WHMCS Multimodule** i WHMCS-administrationen. Sidlistan låter dig skapa, hitta, redigera och ta bort sidor. En *slug* är adressdelen efter domänen, till exempel `contact` i `/contact/`. Exportera modulinställningarna innan du ändrar URL:er, omdirigeringar eller serverregler.

När du skapar en sida anger du ett internt namn och en slug med latinska bokstäver, siffror och bindestreck, utan domän eller `.php`. Välj åtkomst för gäster, inloggade kunder eller alla. Välj därefter status (utkast, publicerad, uppskjuten eller papperskorg), typ (sida, artikel eller systemsida) och språk. Standardspråket i WHMCS måste finnas i `supported_langs.php`; modulen lägger till det automatiskt.

Öppna sidan efter att den sparats och redigera **huvudinställningar**, **innehåll**, **metadata** och **webbplatskarta**. Varje formulär har en egen Spara-knapp; ”Spara alla” behandlar dem tillsammans. Kontrollera bekräftelsen och besök den offentliga sidan. Borttagning flyttar först sidan till papperskorgen; permanent radering görs därifrån.

## URL

Filtrera listan efter namn, åtkomst, typ, status eller språk. **Besök** öppnar den publika URL:en. **Ta bort** flyttar först sidan till papperskorgen; permanent borttagning görs där. Om sidan inte öppnas, kontrollera publicering, aktivt språk och åtkomsttyp.

## WHMCS

För att ersätta en WHMCS-sida väljer du den befintliga systemadressen och en publicerad modulsida. Välj full ersättning, tillägg före eller efter det vanliga innehållet eller endast meta/SEO. Spara och testa den ursprungliga WHMCS-URL:en som gäst och som inloggad kund.

## Instruktioner

- Lägg till sida
- **Sidnamn** — Internt sidnamn
- **Sidans slug** — Endast latinska bokstäver, bindestreck och siffror är tillåtna.
- **Åtkomsttyp** — Inloggade användare: endast inloggade användare har åtkomst till sidan; Gäster: endast gäster har åtkomst; Blandad: alla har åtkomst, men synligheten styrs av blocken på sidan.
- **Sidtyp** — Systemsidor tas inte med i webbplatskartan och är inte tillgängliga för vanliga användare.
- **Sidans språk** — Standardspråket ingår alltid, oavsett vad du väljer.
- Fullständig åsidosättning ersätter det visade innehållet och metadata.\ Lägg till före placerar innehåll före det befintliga sidinnehållet.\ Lägg till efter placerar innehåll efter det befintliga sidinnehållet.\ Endast metadata/SEO ersätter sidans metadata.
- Navigering i sidlistan
