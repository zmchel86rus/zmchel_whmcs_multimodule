# zmchel WHMCS Multimodule: juhend

**Enne mooduli kasutamist genereeri unikaalsed soolad ja lisa need faili `module_init.php`**: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` ja `ZM_PB_NONCE_SALT`.

Moodul on loodud ja testitud **WHMCS-i versioonidel 8.13.1–8.13.7**; PHP ühilduvus on kontrollitud versioonidel **7.4–8.5**. Apache on täielikult toetatud. Nginx võib samuti töötada, kuid keelte suunamine avalehel võib vajada lisaseadistust. **Moodul on tasuta.**

## Juurdepääs ja lehed

Ava WHMCS-i halduses **Addons → zmchel WHMCS Multimodule**. Lehtede loendis saab lehti luua, otsida, muuta ja kustutada. *Slug* on aadressi osa pärast domeeni, näiteks `contact` aadressis `/contact/`. Enne URL-ide, ümbersuunamiste või serverireeglite muutmist ekspordi mooduli seaded.

Uue lehe jaoks sisesta sisemine nimi ja slug, milles on ladina tähed, numbrid ja sidekriipsud, kuid mitte domeen ega `.php`. Vali ligipääs külalistele, sisseloginud klientidele või kõigile. Seejärel vali olek (mustand, avaldatud, edasi lükatud või prügikast), tüüp (leht, artikkel või süsteemileht) ja keeled. WHMCS-i vaikekeel peab olema failis `supported_langs.php`; moodul lisab selle automaatselt.

Pärast salvestamist ava leht ning muuda **põhiseadeid**, **sisu**, **metaandmeid** ja **saidikaardi** seadeid. Igal vormil on oma Salvestamise nupp; „Salvesta kõik” töötleb kõiki vorme. Kontrolli õnnestumisteateid ja avalikku vaadet. Kustutamine viib lehe esmalt prügikasti; lõplik kustutamine toimub sealt.

## Sisu ja keeled

Vahekaardil Sisu vali keel ja lohista GrapesJS-i plokid tööalale. Muuda valitud ploki teksti, pilte ja seadeid ning salvesta see keel. Saad kasutada jaotisi, veerge, tabeleid, KKK-plokke, akordione, kontaktivorme, loendeid, lehitsemist, külaliste/klientide alasid ja kohandatud koodi. Kopeeri paigutus või sisu teise keelde ning tõlgi tekst enne avaldamist.

Ilusate URL-ide ja keelesuunamise korral kasutab vaikekeel `/contact/`, teised keeled eesliidet nagu `/et/contact/`. Lingi ja nupu plokis lülita praeguse keele lisamine sisse ainult tõlgitud saidilehtede jaoks. Jäta see välja väliste linkide, failide, `mailto:`, `tel:` ja tõlketa WHMCS-i aadresside puhul. Kontrolli linke mitmes keeles.

## SEO, meedia ja menüüd

Täida iga keele jaoks Metaandmete vahekaardil pealkiri, kirjeldus, suhtlusvõrgustiku pilt, kanooniline URL, robots-seaded ja Schema tüüp. Avaldatud mittesüsteemne leht võib kuuluda XML-saidikaardile. Laadi meediahalduris pildid üles, lisa sisukas asendustekst ja kontrolli pärast optimeerimist kvaliteeti.

Loo menüühalduris menüü, lisa lehti või kohandatud linke, järjesta üksused ning määra asukoht ja nähtavus. Igas asukohas saab olla üks menüü. WHMCS-i lehe asendamiseks avalda uus leht, seadista asendus lehtede loendis ja testi WHMCS-i algset URL-i nii külalise kui ka sisseloginud kliendina.

## Saidi tööriistad

Ümbersuunamiste halduris määra lähte- ja sihtaadress: `301` püsiva, `302` ajutise muudatuse jaoks. Ümberkirjutusreeglite haldur juhib ilusaid URL-e. Genereeri saidikaardid ja kontrolli faili `sitemap_index.xml`. Mooduli seaded juhivad ka menüüsid, Smartyt, hooldusrežiimi ning importi/eksporti. JSON-eksport ei asenda WHMCS-i täielikku varukoopiat.

Kontaktivorm saab saata WHMCS-i tugipileti või e-kirja. Määra väljad, adressaat või tugiosakond, nõusolekud ja CAPTCHA ning tee tegelik proovisaatmine. Puuduvate moodulitabelite jaoks kasuta Mooduli andmebaasi jaotist.

## Lisadokumentatsioon (English)

[Menüüd](../english/docs/menus.md) · [Smarty](../english/docs/smarty.md) · [Lehitsemine](../english/docs/pagination.md) · [Saidikaardid](../english/docs/sitemaps.md) · [Ümbersuunamised](../english/docs/redirects.md) · [Struktureeritud andmed](../english/docs/structured-data.md) · [Import ja eksport](../english/docs/transfer.md).
