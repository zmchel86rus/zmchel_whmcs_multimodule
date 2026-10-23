# URL perrašymo taisyklės

## .htaccess

Atverkite tvarkytuvę ir palyginkite taisykles su pagrindiniu svetainės `.htaccess` failu. Savo taisyklei išsaugokite URL šabloną, paskirtį ir žymas, tada spauskite **Pridėti arba atnaujinti taisykles**, kad blokas būtų įrašytas prieš WHMCS taisykles. Dar kartą patikrinkite būseną ir atverkite paskelbtą puslapį numatytąja bei kita kalba. Per platus šablonas gali paveikti kitus puslapius. Nginx → Apache aplinkoje taisyklės taikomos tik Apache perduodamoms užklausoms.

## Instrukcijos

- Kalbinių URL taisyklės, įskaitant puslapius su /ru/, /en/ ir kitais prefiksais. Kalbos imamos iš supported_langs.php; taisyklės įterpiamos į .htaccess prieš WHMCS taisykles.
- Nginx neskaito .htaccess, todėl šios taisyklės jame neveikia. Lygiavertes taisykles sukonfigūruokite nginx.
- Aptikta nginx → Apache konfigūracija. Šios taisyklės veikia tik užklausoms, persiunčiamoms į Apache; nginx neskaito .htaccess.
- Patikrinti taisykles
- Pridėti arba atnaujinti taisykles
- Pašalinti visas taisykles iš .htaccess
- URL šablonas
- Paskirties adresas
- Vėliavėlės
- Pridėję arba ištrynę taisyklę, spustelėkite „Pridėti arba atnaujinti taisykles“, kad pakeitimai būtų pritaikyti .htaccess.

## 1. Diegimas ir prieiga

Įjunkite papildomą modulį WHMCS ir suteikite prieigą įgaliotiems administratoriams. Modulio duomenų bazės skiltyje patikrinkite būtinas lenteles. Peržiūrėkite tvarkingus URL, kalbų maršrutus ir meniu vietas. Apache naudoja .htaccess; Nginx atveju atitinkamas serverio taisykles nustatykite atskirai.
