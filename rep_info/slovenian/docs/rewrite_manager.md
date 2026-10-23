# Pravila prepisovanja URL

## .htaccess

Odprite upravljalnik in primerjajte pravila z glavno datoteko `.htaccess` spletnega mesta. Za lastno pravilo shranite vzorec URL, cilj in zastavice, nato izberite **Dodaj ali posodobi pravila**, da se blok zapiše pred pravila WHMCS. Znova preverite stanje in odprite objavljeno stran v privzetem ter še enem jeziku. Preširok vzorec lahko vpliva na druge strani. V povezavi Nginx → Apache pravila veljajo le za zahteve, posredovane Apacheju.

## Navodila

- Pravila za jezikovne URL-je, vključno s stranmi s predponami /ru/, /en/ in drugimi. Jeziki so določeni v supported_langs.php; pravila se vstavijo v .htaccess pred pravili WHMCS.
- Nginx ne bere datoteke .htaccess, zato ta pravila v njem ne delujejo. Enakovredna pravila nastavite v nginx.
- Zaznana je bila postavitev nginx → Apache. Ta pravila delujejo le za zahteve, posredovane strežniku Apache; nginx ne bere datoteke .htaccess.
- Preveri pravila
- Dodaj ali posodobi pravila
- Odstrani vsa pravila iz .htaccess
- Vzorec URL-ja
- Cilj
- Zastavice
- Po dodajanju ali brisanju pravila kliknite »Dodaj ali posodobi pravila«, da uveljavite spremembe v .htaccess.

## 1. Namestitev in dostop

V WHMCS aktivirajte dodatni modul in dodelite dostop pooblaščenim skrbnikom. V zbirki podatkov modula preverite potrebne tabele. Preglejte prijazne URL-je, jezikovne poti in položaje menijev. Apache uporablja .htaccess; v Nginxu enakovredna strežniška pravila nastavite posebej.
