# Import și export

Exportați secțiunile dorite înaintea modificărilor mari. După import verificați paginile, meniurile și media, aplicați separat regulile de rescriere și regenerați sitemap-ul. Aceasta nu înlocuiește un backup WHMCS. La import sunt acceptate și fișiere JSON.

## ZIP

Exportul poate include pagini și articole cu traduceri, conținut, SEO și CSS/JS; meniuri cu ierarhie și poziții; setări, redirecționări, reguli personalizate și biblioteca media cu fișiere. Istoricul reviziilor, variabilele Smarty colectate, conturile și datele secrete WHMCS și fișierele temei sunt excluse. Fișierul ZIP este limitat la 128 MiB; se aplică și limitele PHP `upload_max_filesize` și `post_max_size`. La mutarea meniurilor pe alt site, importați și paginile și rezolvați în prealabil numele identice ale meniurilor.

Fișierul exportat folosește formatul `zmchel_whmcs_multimodule` (versiunea 2). La import, URL-urile site-ului sursă sunt adaptate la `SystemURL` al site-ului destinație, iar linkurile externe rămân neschimbate. Importul nu creează tabele: pregătiți-le înainte în Baza de date a modulului. Înainte de pornire se cere confirmare; înregistrările se modifică într-o tranzacție, iar fișierele înlocuite se restaurează la eroare.
