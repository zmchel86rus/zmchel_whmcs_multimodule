# Síðaritill

- [síðuskipting](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [skipulögð gögn](module_structured_data.md)

## Ritill og tungumál

Veldu tungumál á efnisflipanum, dragðu GrapesJS-einingar á vinnusvæðið og breyttu texta, myndum og stillingum. Til eru kaflar, dálkar, töflur, algengar spurningar, samskiptaform, listar, síðuskipting og svæði fyrir gesti eða meðlimi. Þú getur afritað uppbyggingu yfir á annað tungumál og þýtt textann áður en þú birtir. Tengla- og hnappaeiningar geta bætt tungumáli síðunnar við innri vefslóðir; slökktu á því fyrir ytri tengla, skrár, `mailto:` og WHMCS-leiðir án þýðinga.

Þegar læsilegar vefslóðir og tungumálaleiðir eru virkar notar aðaltungumálið stutta leið eins og `/is/`, eða enga forskeytaleið ef leið fyrir sjálfgefið tungumál er óvirk. Svæðisbundin afbrigði nota BCP 47 staðfærslu. Prófaðu tengla á fleiri en einu tungumáli.

## WHMCS

Í grunnstillingum skaltu athuga heiti, slug, gerð, stöðu, aðgang og tungumál. Sjálfgefið tungumál WHMCS verður að vera virkt í einingunni; birt síða þarf efni á því tungumáli sem sýnt er.

## SEO

Fylltu út titil og lýsingu fyrir hvert tungumál og athugaðu canonical, robots, Open Graph, brauðmola og Schema. Á vefkortaflipa velurðu tíðni og forgang fyrir opinbera síðu sem er ekki kerfissíða. Vistaðu og skoðaðu opinbera URL og XML.

## Tengiliðaeyðublaði

Bættu við **Tengiliðaeyðublaði**. Veldu **WHMCS-beiðni** og þjónustudeild eða **tölvupóst** og viðtakanda; fylltu út fyrirsögn, lýsingu, efni og hnappatexta. Hver reitur þarf heiti, gerð, skyldu og staðfestingu. Beiðni frá gesti þarf reiti með hlutverki nafns og netfangs sendanda. Settu einn valkost á hverja línu í fellilista, til dæmis `sales : Sala`. Búðu til sér reit fyrir hvert samþykki og notaðu CAPTCHA sem er stillt í WHMCS. Vistaðu og sendu alvöru prófun sem gestur; athugaðu beiðni eða afhendingu, villur og hreinsun eyðublaðs. Græn staða í ritli staðfestir ekki afhendingu; stilltu SMTP í WHMCS ef `mail()` bregst.

## Leiðbeiningar

- Hreiðraður gámur með sveigjanlegu útliti. Dragðu aðrar blokkir inn í hann.
- Hreiðraður CSS Grid-gámur. Dragðu aðrar blokkir inn í hann.
- Innfaldin Bootstrap-myndasýning. Dragðu blokkir inn; hver blokk verður að skyggnu.
- Allar blokkir fyrir neðan þessa blokk birtast aðeins innskráðum notendum. Virkar aðeins þegar aðgangstegund síðunnar er Blandað.
- Allar blokkir fyrir neðan þessa blokk birtast aðeins gestum. Virkar aðeins þegar aðgangstegund síðunnar er Blandað.
- **Titill síðu**
- **Lýsigagnalýsing**
- **Vefslóð með kanónískri tilvísun**
- **Robots** — index, follow / noindex, nofollow. Stýrir skráningu í leitarvélum.
- **Tegund Schema** — Þegar þetta er óvirkt eru Schema.org JSON-gögn ekki birt fyrir þessa síðu.
