# zmchel WHMCS Multimodule: instruktioner

**Innan du använder modulen måste du skapa unika salts och lägga dem i `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` och `ZM_PB_NONCE_SALT`.

**Öppna Modulinställningar → Språk som stöds och aktivera de språk du behöver innan du börjar använda modulen.**

Modulen utvecklades och testades med **WHMCS 8.13.1–8.13.7**; PHP-kompatibilitet kontrollerades för **7.4–8.5**. Apache stöds fullt ut. Nginx kan också fungera, men språkstyrningen på startsidan kan kräva ytterligare inställningar. **Modulen är gratis.**

## Språkhanterare (under utveckling)

Öppna Språkhanteraren i WHMCS-administrationen och välj en del (WHMCS klient- eller administratörsspråk, den här modulen eller en annan) och ett språk. Jämför originalet eller referensen med översättningen, redigera en rad och spara den; befintliga nycklar kan också exporteras och importeras som JSON. Nya språk använder referensen tills de har översatts. Hanteraren aktiverar eller inaktiverar språkfiler och rättar gamla filnamn; ändra först standardspråk i WHMCS.

## Åtkomst och sidor

Öppna **Addons → zmchel WHMCS Multimodule** i WHMCS-administrationen. Sidlistan låter dig skapa, hitta, redigera och ta bort sidor. En *slug* är adressdelen efter domänen, till exempel `contact` i `/contact/`. Exportera modulinställningarna innan du ändrar URL:er, omdirigeringar eller serverregler.

När du skapar en sida anger du ett internt namn och en slug med latinska bokstäver, siffror och bindestreck, utan domän eller `.php`. Välj åtkomst för gäster, inloggade kunder eller alla. Välj därefter status (utkast, publicerad, uppskjuten eller papperskorg), typ (sida, artikel eller systemsida) och språk. Standardspråket i WHMCS måste finnas i `supported_langs.php`; modulen lägger till det automatiskt.

Öppna sidan efter att den sparats och redigera **huvudinställningar**, **innehåll**, **metadata** och **webbplatskarta**. Varje formulär har en egen Spara-knapp; ”Spara alla” behandlar dem tillsammans. Kontrollera bekräftelsen och besök den offentliga sidan. Borttagning flyttar först sidan till papperskorgen; permanent radering görs därifrån.

## Innehåll och språk

Välj ett språk på fliken Innehåll och dra GrapesJS-block till arbetsytan. Redigera text, bilder och inställningar för det valda blocket och spara språket. Det finns sektioner, kolumner, tabeller, vanliga frågor, dragspel, kontaktformulär, listor, sidnumrering, gäst-/kundzoner och egen kod. Kopiera struktur eller innehåll till ett annat språk och översätt texten före publicering.

Med snygga URL:er och språkstyrning använder standardspråket `/contact/`, medan andra språk har prefix som `/sv/contact/`. Slå på aktuellt språk i Länk- och Knapp-block endast för översatta sidor på webbplatsen. Låt det vara av för externa adresser, filer, `mailto:`, `tel:` och WHMCS-rutter utan översättning. Testa länkar på flera språk.

## SEO, medier och menyer

Ange titel, beskrivning, social bild, kanonisk URL, robots-inställningar och Schema-typ för varje språk under Metadata. En publicerad sida som inte är en systemsida kan ingå i XML-webbplatskartan. Ladda upp bilder i mediehanteraren, ange användbar alternativtext och granska kvaliteten efter optimering.

I menyhanteraren skapar du en meny, lägger till sidor eller egna länkar, ordnar posterna och väljer plats och synlighet. Varje plats kan ha en meny. För att ersätta en WHMCS-sida publicerar du först den nya sidan, ställer in ersättningen i sidlistan och testar den ursprungliga WHMCS-URL:en som gäst och inloggad kund.

## Webbplatsverktyg

I omdirigeringshanteraren anger du källa och mål: `301` för permanent flytt, `302` för tillfällig. Omskrivningshanteraren styr reglerna för snygga URL:er. Generera webbplatskartor och kontrollera `sitemap_index.xml`. Modulinställningarna styr också menyer, Smarty, underhåll och import/export. En JSON-export ersätter inte en fullständig WHMCS-säkerhetskopia.

Kontaktformuläret kan skicka ett WHMCS-supportärende eller e-post. Ställ in fält, mottagare eller supportavdelning, samtycken och CAPTCHA och gör ett verkligt testutskick. Använd Moduldatabas om modultabeller saknas.

## Mer dokumentation (English)

[Menyer](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Sidnumrering](../english/docs/pagination.md) · [Webbplatskartor](../english/docs/sitemaps.md) · [Omdirigeringar](../english/docs/redirects.md) · [Strukturerad data](../english/docs/structured-data.md) · [Import och export](../english/docs/transfer.md).
