# Smarty

- **Postavke modula → Prikupljaj Smarty varijable → Koristi prikupljene Smarty varijable → Uređivač stranica.**

## Katalog varijabli

U postavkama modula uključite prikupljanje i upotrebu Smarty varijabli, zatim otvorite odgovarajuće stranice web-mjesta i osvježite uređivač. Katalog sprema nazive, vrste i strukturu varijabli, ali ne stvarne vrijednosti ni osobne podatke. Ako varijabla nedostaje, ponovno posjetite stranicu na kojoj se koristi.

## Uređivač i ograničenja

Otvorite blok Smarty u uređivaču stranica i odaberite varijable iz kataloga. Koristite dopuštene uvjete i petlje; pri prikazu dinamičkog teksta dodajte `|escape`. PHP, SQL, pozivi metoda, uključivanje datoteka i `nofilter` nisu dopušteni. Spremite stranicu i provjerite javni prikaz.

## resources/available_vars/

Katalog služi samo kao vodič kroz varijable opažene na stranici: ne omogućuje ih na drugoj stranici. Kod se provjerava pri spremanju i prije prikaza; blok dobiva izoliranu kopiju dopuštenih vrijednosti. Dopušteni su uvjeti, `foreach`, lokalni `assign` i modifikatori poput `escape`, `default`, `count` i `date_format`. Izlazne se vrijednosti automatski escapiraju; željeni HTML napišite u predlošku. Ako podaci nedostaju ili kod ne uspije, blok ostaje prazan, a pogreška ide u PHP zapisnik.

Katalog u `resources/available_vars/` čuva nazive, vrste, strukturu i umjetne primjere, ali ne stvarne vrijednosti. Pokazuje gdje je varijabla opažena, no ne čini je dostupnom na drugoj stranici. Uređivač otvorite dvostrukim klikom na blok Smarty. `Ctrl+Space` traži varijable, `Ctrl+S` primjenjuje kod, a `F11` uključuje cijeli zaslon. Kod se izvodi izdvojeno; bez potrebnih podataka blok ostaje prazan, a upozorenje ide u PHP zapisnik.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Upute

- **Prikupljaj Smarty varijable** — Omogućite ili onemogućite prikupljanje Smarty varijabli.
- **Koristi prikupljene Smarty varijable** — Omogućite ili onemogućite korištenje prikupljenih Smarty varijabli u uređivaču stranica.
- Smarty (PHP) varijabla
- Smarty: PHP, metode objekata, statički pozivi i nofilter nisu dopušteni.
- Smarty predložak je prevelik.
- Smarty
- Smarty uređivač

