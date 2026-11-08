# Sitemap-uri

Activați sitemap-ul și generați fișierele XML. Verificați variantele lingvistice publicate în sitemap_index.xml; dacă actualizările lipsesc, verificați cron-ul WHMCS și drepturile de scriere.

## XML

XML-ul include linkuri reciproce pentru limbile active și `x-default` pentru adresa limbii implicite. Sursele redirecționărilor nu intră în `loc` sau în variantele lingvistice; conținutul de rezervă este marcat cu limba sa reală. Fișierele de pagini și articole declară spațiul de nume XHTML.

Hook-ul `AfterCronJob` compară intervalul `ZM_PB_SITEMAP_UPDFREQ` cu data ultimei generări reușite `ZM_PB_SITEMAP_LASTUPD`; când sitemap-ul este dezactivat, nici generarea manuală nu este disponibilă. Versiunile lingvistice sunt alese după `lang_active`. Părțile suplimentare primesc sufixele `_2`, `_3` și așa mai departe. Dacă generarea eșuează, fișierele vechi sunt restabilite și data succesului rămâne neschimbată. Verificați drepturile de scriere în rădăcină, `resources/` și `inc/editable_consts.php`; tabelele se repară separat în baza de date a modulului.

Generarea automată depinde de cron-ul WHMCS și de intervalul configurat; butonul o pornește imediat. Sunt incluse doar paginile și articolele publicate, accesibile vizitatorilor, împreună cu traducerile lor active. Dacă o pagină suprascrie o pagină de sistem, se folosește URL-ul public al paginii de sistem, nu slug-ul paginii de înlocuire. Fișierele de peste 50.000 de URL-uri sau 50 MB sunt împărțite. Indexul păstrează celelalte sitemap-uri valide.

Modulul scrie `sitemap_index.xml`, `sitemap_pages.xml` și `sitemap_posts.xml` în rădăcina site-ului; o categorie goală nu produce fișier. Nu creează un `sitemap.xml` combinat. După modificarea paginilor sau limbilor, generați din nou hărțile și deschideți indexul în browser. Dacă apare o eroare, verificați dreptul de scriere în rădăcină; data ultimei generări reușite rămâne neschimbată.
