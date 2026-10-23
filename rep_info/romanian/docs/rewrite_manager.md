# Reguli de rescriere

## .htaccess

Deschideți managerul și comparați regulile cu fișierul principal `.htaccess` al site-ului. Pentru o regulă proprie, salvați modelul URL, destinația și opțiunile; apoi apăsați **Adaugă sau actualizează regulile** pentru a scrie blocul înaintea regulilor WHMCS. Verificați din nou starea și deschideți o pagină publicată în limba implicită și în alta. Un model prea larg poate afecta alte pagini. În configurația Nginx → Apache, regulile se aplică doar cererilor trimise către Apache.

## Instrucțiuni

- Reguli pentru URL-urile localizate, inclusiv paginile de sub /ru/, /en/ și alte prefixe. Limbile sunt preluate din supported_langs.php; regulile sunt inserate în .htaccess înaintea regulilor WHMCS.
- Nginx nu citește .htaccess, astfel încât aceste reguli nu funcționează în Nginx. Configurați reguli echivalente în nginx.
- A fost detectată o configurație nginx → Apache. Aceste reguli funcționează numai pentru cererile transmise către Apache; nginx nu citește .htaccess.
- Verifică regulile
- Adaugă sau actualizează regulile
- Elimină toate regulile din .htaccess
- Model URL
- Destinație
- Indicatori
- După adăugarea sau ștergerea unei reguli, faceți clic pe „Adaugă sau actualizează regulile” pentru a aplica modificările în .htaccess.

## 1. Instalare și acces

Activați modulul suplimentar în WHMCS și acordați acces administratorilor autorizați. În Baza de date a modulului verificați tabelele necesare. Revizuiți apoi URL-urile prietenoase, rutele lingvistice și pozițiile meniurilor. Apache folosește .htaccess; în Nginx configurați separat regulile echivalente.
