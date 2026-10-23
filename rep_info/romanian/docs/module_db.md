# Baza de date a modulului

- **Baza de date a modulului:** `MISSING` → Selectează → Remediază Elemente selectate.
- **Șterge Elemente selectate** — Această acțiune nu poate fi anulată.

Pagina **Baza de date a modulului** arată tabelele și coloanele necesare și starea lor. Este disponibilă numai superadministratorului desemnat. Deschideți-o când altă secțiune semnalează o tabelă sau o coloană lipsă. Verificați lista, selectați doar elementele de reparat și apăsați **Remediază elementele selectate**. Unele coloane nu au o procedură de reparare automată; verificați din nou starea după operație.

**Șterge elementele selectate** elimină definitiv obiectele alese din baza de date. Înainte de ștergere, exportați datele modulului și faceți o copie de siguranță a bazei.

## Instrucțiuni

- Acces refuzat. Numai Superadministratorul (ID …) poate utiliza pagina Bază de date a modulului.
- Remediază
- Elemente selectate
- Șterge
- Această acțiune nu poate fi anulată.
- Tabelele meniurilor nu au fost încă create. Adăugați-le în Baza de date a modulului.
- Adăugați mai întâi coloana optimization_attempted în managerul tabelelor modulului.

## 1. Instalare și acces

Activați modulul suplimentar în WHMCS și acordați acces administratorilor autorizați. În Baza de date a modulului verificați tabelele necesare. Revizuiți apoi URL-urile prietenoase, rutele lingvistice și pozițiile meniurilor. Apache folosește .htaccess; în Nginx configurați separat regulile echivalente.
