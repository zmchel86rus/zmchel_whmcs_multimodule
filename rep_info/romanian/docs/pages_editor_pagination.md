# Paginare și filtre

Conectați paginarea și filtrele la aceeași listă. Alegeți numărul de rezultate și forma URL-ului; testați pagina a doua și o valoare de filtrare.

## Linkuri și sursa listei

Plasați paginarea în afara blocului cu lista și alegeți acel bloc ca țintă. Pentru o listă Smarty, indicați variabila cu toate elementele; altfel sunt împărțite elementele HTML ale containerului. Alegeți formatul linkurilor după setarea modulului, `/page/2/` sau `?page=2`. Formatul cu cale cere reguli rewrite. Listele independente folosesc parametri separați; linkurile păstrează limba, filtrele și sortarea.

## Dimensiunea paginii, SEO și filtre

Stabiliți numărul de elemente și, dacă este nevoie, activați selectorul 10/25/50/100/250. Schimbarea dimensiunii readuce lista la prima pagină. Noindex se aplică numai de la pagina a doua; verificați titlul și URL-ul canonic. Asociați filtrele aceleiași liste, apoi testați a doua pagină și un rezultat filtrat pe site-ul public.

## page / count / pager

Pentru o listă Smarty indicați variabila cu toate elementele și păstrați bucla `{foreach}`: modulul împarte lista, deci nu adăugați un al doilea `array_slice`. Fără variabilă sunt paginate elementele HTML ale containerului; puteți alege clasa rândului sau eticheta `tr`, iar `thead` și `tfoot` rămân la locul lor. Stabiliți separat pentru desktop și mobil numărul de butoane din jurul paginii curente. Pe rutele PHP directe folosiți `?page=2`; `/page/2/` cere reguli rewrite. Paginile următoare au canonical propriu și pot primi `noindex`.

Când există mai multe liste independente, prima folosește `page`, `count` și `sort`, iar celelalte folosesc parametri cu ID-ul blocului. Pentru ruta `/page/N/`, `pager` indică lista căreia îi aparține numărul. În blocul Smarty, `$zm_pagination` oferă `total`, `page`, `pages`, `count` și `offset`. `count` este limitat la 10–250. Dacă lista este goală sau are o singură pagină, panoul de paginare este ascuns.

## YYYY-MM-DD

Filtrele acționează asupra aceleiași liste ca paginarea. Căutarea text poate verifica mai multe câmpuri separate prin virgulă; intervalul de date folosește `YYYY-MM-DD` și include întreaga ultimă zi.

## Flex / Grid

Alegeți Flex sau Grid și reglați lățimile și coloanele pentru fiecare dispozitiv. Aplicarea ori ștergerea filtrului revine la prima pagină. Selectorul numărului de rezultate poate fi mutat fără a pierde legătura; un panou duplicat controlează aceeași listă.
