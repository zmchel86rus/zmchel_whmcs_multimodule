# Managerul de limbi

Managerul de limbi permite editarea textelor WHMCS și ale modulelor din zona de administrare. Funcția este încă în dezvoltare. Accesul aparține superadministratorului modulului, iar PHP trebuie să poată scrie în directoarele de limbi corespunzătoare.

## Alegerea secțiunii și a limbii

Activați mai întâi limbile necesare în **Setările modulului → Limbi acceptate**. În **Managerul de limbi → Secțiuni**, alegeți limbile pentru clienții sau administratorii WHMCS, acest modul ori alt modul detectat. Tabelul arată limbile existente, dezactivate și disponibile pentru adăugare. În fila **Limbi**, alegeți un fișier sau adăugați o limbă lipsă. Fișierul nou folosește inițial textele unei limbi de referință; încă nu este o traducere completă. Marcajul „netradus” înseamnă că nu are traduceri proprii.

## Editarea traducerilor

În **Traduceri**, coloana **Original** arată textul din fișierul original al limbii alese, fără modificările dvs. Dacă limba nu are încă texte proprii, coloana devine **Referință**. Căutați după cheie sau text, filtrați toate cheile, pe cele originale sau adăugate și salvați fiecare rând separat. Puteți adăuga o cheie personalizată într-o secțiune selectată, apoi să o redenumiți sau să o ștergeți. Unele cataloage ale altor module sunt doar pentru citire dacă formatul lor nu poate fi salvat în siguranță.

**Export JSON** descarcă cheile și traducerile secțiunii și limbii selectate. **Import JSON** actualizează numai chei existente. Cheile necunoscute sau duplicate sunt omise și enumerate în rezultat. Păstrați identificatorii secțiunii și limbii și căile cheilor. Dimensiunea maximă a fișierului este 8 MiB.

## Fișiere și limba implicită

Un fișier de limbă poate fi dezactivat și reactivat; poate fi editat și când este dezactivat. Fișierul de bază în engleză și limba implicită curentă din WHMCS sunt protejate. Pentru limbile de client și administrator WHMCS adăugate prin manager se păstrează copii pentru restaurarea după o actualizare. Dacă în **Secțiuni** apare o corecție de nume, verificați noul nume și apăsați **Corectează**; schimbarea se aplică secțiunilor detectate.

Pentru a schimba limba implicită, activați mai întâi noua limbă în setările modulului, apoi schimbați limba implicită în WHMCS și abia după aceea dezactivați limba veche. Verificați textele atât în administrare, cât și în zona clientului.
