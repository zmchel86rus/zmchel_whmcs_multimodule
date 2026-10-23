# Leheredaktor

- [Lehitsemine](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [Struktureeritud andmed](module_structured_data.md)

## Sisu ja keeled

Vahekaardil Sisu vali keel ja lohista GrapesJS-i plokid tööalale. Muuda valitud ploki teksti, pilte ja seadeid ning salvesta see keel. Saad kasutada jaotisi, veerge, tabeleid, KKK-plokke, akordione, kontaktivorme, loendeid, lehitsemist, külaliste/klientide alasid ja kohandatud koodi. Kopeeri paigutus või sisu teise keelde ning tõlgi tekst enne avaldamist.

Ilusate URL-ide ja keelesuunamise korral kasutab vaikekeel `/contact/` ainult siis, kui vaikekeele eraldi marsruut on välja lülitatud, teised keeled eesliidet nagu `/et/contact/`. Lingi ja nupu plokis lülita praeguse keele lisamine sisse ainult tõlgitud saidilehtede jaoks. Jäta see välja väliste linkide, failide, `mailto:`, `tel:` ja tõlketa WHMCS-i aadresside puhul. Kontrolli linke mitmes keeles.

## WHMCS

Põhiseadetes kontrolli nime, slug'i, tüüpi, olekut, ligipääsu ja keeli. WHMCS-i vaikekeel peab moodulis olema sisse lülitatud; avaldatud lehel peab olema kuvatavas keeles sisu.

## SEO

Täida iga keele pealkiri ja kirjeldus ning kontrolli canonical, robots, Open Graph, asukoharada ja Schema. Saidikaardi vahekaardil määra avaliku mittesüsteemse lehe sagedus ja prioriteet. Salvesta ning kontrolli avalikku URL-i ja XML-i.

## Kontaktvorm

Lisa plokk **Kontaktvorm**. Vali **WHMCS-i tugipilet** ja tugiosakond või **e-kiri** ja saaja; täida pealkiri, kirjeldus, teema ja nupu tekst. Määra igale väljale nimi, tüüp, kohustuslikkus ja kontroll. Külalise piletil peavad olema saatja nime ja e-posti rolliga väljad. Rippmenüü valikud kirjuta ükshaaval ridadele, näiteks `sales : Müük`. Lisa iga nõusoleku jaoks eraldi väli ja kasuta WHMCS-is määratud CAPTCHA-t. Salvesta ja saada päris proovisõnum külalisena; kontrolli piletit või kohaletoimetamist, vigu ja vormi lähtestamist. Redaktori roheline olek ei tõenda kohaletoimetamist; kui `mail()` ebaõnnestub, seadista WHMCS-is SMTP.

## Juhised

- Pesastatud paindlik paigutuskonteiner. Lohistage teised plokid selle sisse.
- Pesastatud CSS Gridi konteiner. Lohistage teised plokid selle sisse.
- Pesastatud Bootstrapi karussell. Lohistage plokid selle sisse; igaühest saab slaid.
- Kõik selle ploki all olevad plokid kuvatakse ainult sisseloginud kasutajatele. Toimib ainult juhul, kui lehe juurdepääsu tüüp on Segatud.
- Kõik selle ploki all olevad plokid kuvatakse ainult külalistele. Toimib ainult juhul, kui lehe juurdepääsu tüüp on Segatud.
- **Lehe pealkiri**
- **Meta-kirjeldus**
- **Kanooniline URL**
- **Robotid** — index, follow / noindex, nofollow. Määrab indekseerimise.
- **Schema tüüp** — Kui see on keelatud, ei väljastata selle lehe kohta Schema.org JSON-märgistust.
