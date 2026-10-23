# Lehtede haldur

## Juurdepääs ja lehed

Ava WHMCS-i halduses **Addons → zmchel WHMCS Multimodule**. Lehtede loendis saab lehti luua, otsida, muuta ja kustutada. *Slug* on aadressi osa pärast domeeni, näiteks `contact` aadressis `/contact/`. Enne URL-ide, ümbersuunamiste või serverireeglite muutmist ekspordi mooduli seaded.

Uue lehe jaoks sisesta sisemine nimi ja slug, milles on ladina tähed, numbrid ja sidekriipsud, kuid mitte domeen ega `.php`. Vali ligipääs külalistele, sisseloginud klientidele või kõigile. Seejärel vali olek (mustand, avaldatud, edasi lükatud või prügikast), tüüp (leht, artikkel või süsteemileht) ja keeled. WHMCS-i vaikekeel peab olema failis `supported_langs.php`; moodul lisab selle automaatselt.

Pärast salvestamist ava leht ning muuda **põhiseadeid**, **sisu**, **metaandmeid** ja **saidikaardi** seadeid. Igal vormil on oma Salvestamise nupp; „Salvesta kõik” töötleb kõiki vorme. Kontrolli õnnestumisteateid ja avalikku vaadet. Kustutamine viib lehe esmalt prügikasti; lõplik kustutamine toimub sealt.

## URL

Filtreeri loendit nime, ligipääsu, tüübi, oleku või keele järgi. **Külasta** avab avaliku URL-i. **Kustuta** viib lehe esmalt prügikasti; lõplik kustutamine toimub seal. Kui leht ei avane, kontrolli avaldamist, aktiivset keelt ja ligipääsu tüüpi.

## WHMCS

WHMCS-i lehe asendamiseks vali olemasolev süsteemiaadress ja avaldatud moodulileht. Vali täielik asendus, sisu lisamine enne või pärast tavapärast sisu või ainult meta/SEO. Salvesta ja kontrolli WHMCS-i algset URL-i külalise ning sisseloginud kliendina.

## Juhised

- Lisa leht
- **Lehe nimi** — Sisemine lehe nimi
- **Lehe püsiviide** — Lubatud on ainult ladina tähed, sidekriipsud ja numbrid.
- **Juurdepääsu tüüp** — Sisseloginud kasutajad: lehele pääsevad ligi ainult sisseloginud kasutajad; külalised: lehele pääsevad ligi ainult külalised; segatud: lehele pääsevad ligi kõik, kuid nähtavust juhitakse lehe plokkide kaudu.
- **Lehe tüüp** — Süsteemilehti ei lisata saidikaardile ja need pole tavakasutajatele kättesaadavad.
- **Lehe keeled** — Vaikimisi keel kaasatakse alati, olenemata teie valikust.
- Täielik asendus asendab kuvatava sisu ja metaandmed.\ Lisa ette paigutab sisu olemasoleva lehe sisu ette.\ Lisa järele paigutab sisu olemasoleva lehe sisu järele.\ Ainult metaandmed/SEO asendab lehe metaandmed.
- Lehtede loendi navigeerimine
