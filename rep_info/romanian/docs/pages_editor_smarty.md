# Smarty și variabile

- **Setările modulului → Colectează variabile Smarty → Folosește variabilele Smarty colectate → Editor de pagini.**

Activați variabilele Smarty înainte de a adăuga un bloc. Folosiți doar variabile permise, aplicați escape valorilor dinamice și nu afișați date personale; PHP și SQL sunt interzise.

## Catalogul de variabile

Activați colectarea și utilizarea variabilelor Smarty în setările modulului, apoi vizitați paginile relevante ale site-ului și reîncărcați editorul. Catalogul păstrează numele, tipurile și structura variabilelor, dar nu valorile reale sau datele personale. Dacă lipsește o variabilă, vizitați din nou pagina care o folosește.

## Editorul și limitele

Deschideți blocul Smarty în editorul de pagini și alegeți variabile din catalog. Folosiți condițiile și buclele permise; adăugați `|escape` când afișați text dinamic. PHP, SQL, apelurile de metode, includerea fișierelor și `nofilter` nu sunt permise. Salvați pagina și verificați rezultatul public.

## resources/available_vars/

Catalogul este doar un ghid al variabilelor observate pe o pagină: nu le face disponibile pe alta. Codul este verificat la salvare și înainte de afișare; blocul primește o copie izolată a valorilor permise. Sunt acceptate condițiile, `foreach`, `assign` local și modificatori precum `escape`, `default`, `count` și `date_format`. Valorile afișate sunt escapate automat; scrieți în șablon HTML-ul pe care doriți să îl generați. Dacă datele lipsesc sau codul eșuează, blocul rămâne gol, iar eroarea este scrisă în jurnalul PHP.

Catalogul din `resources/available_vars/` păstrează nume, tipuri, structură și exemple artificiale, nu valorile reale. Arată unde a fost observată o variabilă, fără să o facă disponibilă pe altă pagină. Deschideți editorul prin dublu clic pe blocul Smarty. `Ctrl+Space` caută variabile, `Ctrl+S` aplică codul, iar `F11` activează ecranul complet. Codul rulează izolat; dacă datele lipsesc, blocul rămâne gol și avertismentul ajunge în jurnalul PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instrucțiuni

- **Colectează variabile Smarty** — Activează sau dezactivează colectarea variabilelor Smarty.
- **Folosește variabilele Smarty colectate** — Activează sau dezactivează utilizarea variabilelor Smarty colectate în editorul de pagini.
- Variabilă Smarty (PHP)
- Smarty: PHP, metodele obiectelor, apelurile statice și nofilter sunt interzise.
- Șablonul Smarty este prea mare.
- Smarty
- Editor Smarty
