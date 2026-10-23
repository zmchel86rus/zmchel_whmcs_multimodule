# Import și export

Exportați secțiunile dorite înaintea modificărilor mari. După import verificați paginile, meniurile și media, aplicați separat regulile de rescriere și regenerați sitemap-ul. Aceasta nu înlocuiește un backup WHMCS.

## JSON

Exportul poate include pagini și articole cu traduceri, conținut, SEO și CSS/JS; meniuri cu ierarhie și poziții; setări, redirecționări, reguli personalizate și biblioteca media cu fișiere. Istoricul reviziilor, variabilele Smarty colectate, conturile și datele secrete WHMCS și fișierele temei sunt excluse. Fișierul JSON este limitat la 32 MiB; se aplică și limitele PHP `upload_max_filesize` și `post_max_size`. La mutarea meniurilor pe alt site, importați și paginile și rezolvați în prealabil numele identice ale meniurilor.

Fișierul exportat folosește formatul `zmchel_whmcs_multimodule` (versiunea 1). La import, URL-urile site-ului sursă sunt adaptate la `SystemURL` al site-ului destinație, iar linkurile externe rămân neschimbate. Importul nu creează tabele: pregătiți-le înainte în Baza de date a modulului. Înainte de pornire se cere confirmare; înregistrările se modifică într-o tranzacție, iar fișierele înlocuite se restaurează la eroare.

## Instrucțiuni

- Un singur fișier JSON pentru toate secțiunile sau doar pentru cele selectate, de până la 32 MiB (se aplică și limitele PHP pentru încărcarea fișierelor). Paginile corespunzătoare sunt actualizate după slug și tipul de acces, iar meniurile după nume. Celelalte înregistrări rămân neschimbate. Includeți paginile atunci când importați meniuri pe un site nou. Secțiunile selectate care lipsesc din fișier sunt omise.
- CSS/JS sunt incluse împreună cu paginile, iar imaginile și celelalte fișiere încărcate, împreună cu biblioteca media. Istoricul reviziilor, variabilele Smarty colectate și datele secrete WHMCS nu sunt exportate. Regenerați harta site-ului după import; aplicați regulile de rescriere în Managerul regulilor de rescriere.
- Pagini și articole (traduceri, conținut, SEO, setări pentru harta site-ului, blocuri CSS/JS)
- Meniuri și poziții
- Setările modulului, suprascrieri, antet/subsol, robots.txt
- Redirecționări
- Reguli personalizate de rescriere a URL-urilor
- Bibliotecă media (fișiere și descrieri)
- Înregistrările corespunzătoare din secțiunile selectate vor fi actualizate din fișier. Continuați?
