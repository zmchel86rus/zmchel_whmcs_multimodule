# Smarty in spremenljivke

- **Nastavitve modula → Zbiranje spremenljivk Smarty → Uporaba zbranih spremenljivk Smarty → Urejevalnik strani.**

Pred dodajanjem bloka vključite spremenljivke Smarty. Uporabljajte le dovoljene spremenljivke, dinamične vrednosti zaščitite s filtrom escape in ne prikazujte osebnih podatkov; PHP in SQL nista dovoljena.

## Katalog spremenljivk

V nastavitvah modula vklopite zbiranje in uporabo spremenljivk Smarty, nato odprite ustrezne strani spletnega mesta in osvežite urejevalnik. Katalog shrani imena, vrste in strukturo spremenljivk, ne pa dejanskih vrednosti ali osebnih podatkov. Če spremenljivka manjka, znova obiščite stran, kjer se uporablja.

## Urejevalnik in omejitve

Odprite blok Smarty v urejevalniku strani in izberite spremenljivke iz kataloga. Uporabljajte dovoljene pogoje in zanke; pri prikazu dinamičnega besedila dodajte `|escape`. PHP, SQL, klici metod, vključevanje datotek in `nofilter` niso dovoljeni. Shranite stran in preverite javni prikaz.

## resources/available_vars/

Katalog je le vodnik po spremenljivkah, opaženih na strani: ne omogoči njihove uporabe na drugi strani. Koda se preveri ob shranjevanju in pred prikazom; blok dobi ločeno kopijo dovoljenih vrednosti. Dovoljeni so pogoji, `foreach`, lokalni `assign` in modifikatorji, kot so `escape`, `default`, `count`, `date_format`. Izhodne vrednosti se samodejno escapajo; želeni HTML napišite v predlogi. Če podatki manjkajo ali koda odpove, blok ostane prazen, napaka pa se zapiše v dnevnik PHP.

Katalog v `resources/available_vars/` hrani imena, vrste, zgradbo in umetne primere, ne pa pravih vrednosti. Pokaže, kje je bila spremenljivka opažena, vendar je ne naredi dostopne na drugi strani. Urejevalnik odprite z dvojnim klikom na blok Smarty. `Ctrl+Space` išče spremenljivke, `Ctrl+S` uporabi kodo, `F11` odpre celozaslonski način. Koda teče ločeno; če podatkov ni, blok ostane prazen, opozorilo pa gre v dnevnik PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Navodila

- **Zbiranje spremenljivk Smarty** — Omogočite ali onemogočite zbiranje spremenljivk Smarty.
- **Uporaba zbranih spremenljivk Smarty** — Omogočite ali onemogočite uporabo zbranih spremenljivk Smarty v urejevalniku strani.
- Spremenljivka Smarty (PHP)
- Smarty: PHP, metode objektov, statični klici in nofilter so prepovedani.
- Predloga Smarty je prevelika.
- Smarty
- Urejevalnik Smarty
