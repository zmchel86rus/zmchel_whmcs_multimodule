# Smarty

- **Mooduli seaded → Kogu Smarty muutujad → Kasuta kogutud Smarty muutujaid → Leheredaktor.**

## Muutujate kataloog

Lülitage mooduli seadetes sisse Smarty muutujate kogumine ja kasutamine, seejärel avage asjakohased saidilehed ning värskendage redaktorit. Kataloog salvestab muutujate nimed, tüübid ja struktuuri, kuid mitte tegelikke väärtusi ega isikuandmeid. Kui muutuja puudub, külastage selle kasutuslehte uuesti.

## Redaktor ja piirangud

Avage leheredaktoris Smarty plokk ja valige kataloogist muutujad. Kasutage lubatud tingimusi ja tsükleid; lisage dünaamilise teksti kuvamisel `|escape`. PHP, SQL, meetodite väljakutsed, failide kaasamine ja `nofilter` pole lubatud. Salvestage leht ja kontrollige avalikku tulemust.

## resources/available_vars/

Kataloog on ainult lehel nähtud muutujate juhend: see ei tee neid teisel lehel kättesaadavaks. Koodi kontrollitakse salvestamisel ja enne kuvamist; plokk saab lubatud väärtuste eraldatud koopia. Lubatud on tingimused, `foreach`, kohalik `assign` ning muutjad nagu `escape`, `default`, `count` ja `date_format`. Väljundi väärtused escapetakse automaatselt; vajalik HTML kirjutage malli. Kui andmed puuduvad või kood ei tööta, jääb plokk tühjaks ja viga läheb PHP logisse.

Kataloog `resources/available_vars/` salvestab nimed, tüübid, struktuuri ja väljamõeldud näited, kuid mitte päris väärtusi. See näitab, kus muutujat nähti, ent ei tee seda teisel lehel kättesaadavaks. Ava redaktor Smarty-plokil topeltklõpsuga. `Ctrl+Space` otsib muutujaid, `Ctrl+S` rakendab koodi ja `F11` avab täisekraani. Kood töötab eraldi; puuduvate andmete korral jääb plokk tühjaks ja hoiatus läheb PHP logisse.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Juhised

- **Kogu Smarty muutujad** — Luba või keela Smarty muutujate kogumine.
- **Kasuta kogutud Smarty muutujaid** — Luba või keela kogutud Smarty muutujate kasutamine leheredaktoris.
- Smarty (PHP) muutuja
- Smarty: PHP, objektimeetodid, staatilised väljakutsed ja nofilter on keelatud.
- Smarty mall on liiga suur.
- Smarty
- Smarty redaktor

