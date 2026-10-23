# Meniuri

Creați un meniu, adăugați pagini sau linkuri personalizate și ordonați elementele prin tragere. Alegeți un element părinte pentru submeniuri și stabiliți etichete pe limbi, vizibilitatea pentru vizitatori sau clienți și dispozitivele. Atribuiți o poziție; fiecare poziție poate folosi un singur meniu. Pentru linkurile interne, alegeți dacă URL-ul urmează limba curentă. Verificați meniul public pe calculator și telefon.

Pentru fiecare element puteți seta titlul, descrierea, clasele CSS, `rel`, pictograma și deschiderea într-o filă nouă; paginile publicate pot fi adăugate și automat. Alegeți separat pentru desktop și mobil dacă meniul completează sau înlocuiește navigarea WHMCS. Linkul către o pagină a modulului se recalculează după slug, limbă și modul URL actuale; o etichetă goală folosește titlul tradus sau numele paginii. Vizitarea paginii nu schimbă limba din profilul clientului. Serverul respinge schemele URL nesigure și HTML-ul din etichete.

## WHMCS

Activați pozițiile de meniu WHMCS necesare din setările modulului. Fiecare poziție acceptă un singur meniu, dar același meniu poate fi atribuit mai multor poziții. Afișarea pentru desktop începe de la 768 px lățime; pe ecrane mai înguste se folosește varianta mobilă. O poziție dezactivată lasă meniul standard WHMCS neschimbat.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Pe rutele de sistem WHMCS fără rutare lingvistică a modulului, etichetele meniului folosesc limba salvată a clientului; paginile modulului folosesc limba din URL. Dacă limba implicită primește propria rută, și ea are prefix. URL-ul simplu este `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Un link personalizat poate rămâne fără localizare, de exemplu `clientarea.php`. Ascunderea unui element părinte ascunde întreaga ramură.

URL-ul unui element de pagină este recalculat din slug-ul curent și traducerea publicată. Dacă traducerea lipsește, se folosește versiunea publicată în limba implicită. Un link personalizat poate păstra URL-ul introdus; adresele externe, mailto, tel și ancorele nu primesc prefix de limbă. Ciornele, paginile șterse și cele fără drept de acces nu sunt afișate.

## zm_pb_menus

Datele se află în tabelele `zm_pb_menus`, `zm_pb_menu_items` și `zm_pb_menu_locations`. Creați sau reparați aceste tabele din Baza de date a modulului. Arborele admite cel mult 10 niveluri și 300 de elemente; când se șterge un părinte, copiii acestuia urcă un nivel.

## Instrucțiuni

- Creați un meniu, adăugați pagini sau linkuri personalizate și ordonați elementele prin tragere.
