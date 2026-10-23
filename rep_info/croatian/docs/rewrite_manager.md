# Pravila prepisivanja URL-ova

## WHMCS

Pravila za jezične URL-ove, uključujući stranice pod /ru/, /en/ i drugim prefiksima. Jezici se učitavaju iz supported_langs.php; pravila se umeću u .htaccess ispred pravila WHMCS-a.

Nginx ne čita .htaccess pa ova pravila ondje ne rade. Konfigurirajte odgovarajuća pravila u nginxu.

Otkrivena je konfiguracija nginx → Apache. Ova pravila rade samo za zahtjeve proslijeđene Apacheu; nginx ne čita .htaccess.

Nakon dodavanja ili brisanja pravila kliknite „Dodaj ili ažuriraj pravila” da biste primijenili promjene u .htaccess.

## .htaccess

Otvorite upravitelj i usporedite pravila s glavnom datotekom `.htaccess`. Za vlastito pravilo spremite URL uzorak, odredište i oznake, zatim kliknite **Dodaj ili ažuriraj pravila** kako bi se blok zapisao prije pravila WHMCS-a. Ponovno provjerite stanje i otvorite objavljenu stranicu na glavnom i još jednom jeziku. Preširok uzorak može utjecati na druge stranice. U postavi Nginx → Apache pravila vrijede samo za zahtjeve proslijeđene Apacheu.

## Upute

- Provjeri pravila
- Dodaj ili ažuriraj pravila
- Ukloni sva pravila iz .htaccess
- Uzorak URL-a
- Cilj
- Oznake
