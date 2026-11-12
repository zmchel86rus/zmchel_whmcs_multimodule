# Pravila prepisovanja URL

## .htaccess

Odprite upravljalnik in primerjajte pravila z glavno datoteko `.htaccess` spletnega mesta. Za lastno pravilo shranite vzorec URL, cilj in zastavice, nato izberite **Dodaj ali posodobi pravila**, da se blok zapiše pred pravila WHMCS. Znova preverite stanje in odprite objavljeno stran v privzetem ter še enem jeziku. Preširok vzorec lahko vpliva na druge strani. V povezavi Nginx → Apache pravila veljajo le za zahteve, posredovane Apacheju.

## 1. Namestitev in dostop

V WHMCS aktivirajte dodatni modul in dodelite dostop pooblaščenim skrbnikom. V zbirki podatkov modula preverite potrebne tabele. Preglejte prijazne URL-je, jezikovne poti in položaje menijev. Apache uporablja .htaccess; v Nginxu enakovredna strežniška pravila nastavite posebej.
