# Setările modulului

- [Import și export](module_settings_transfer.md)

## Instrucțiuni

- Alegeți limbile pe care le poate folosi modulul. Dezactivarea unei limbi nu îi șterge conținutul.
- Dacă folosiți URL-uri prietenoase pe Apache, actualizați regulile din Rewrite Manager după modificarea limbilor.
- **URL-uri prietenoase** — Activează URL-urile prietenoase, inclusiv URL-urile de sistem.
- **Rutare după limbă** — Activează sau dezactivează rutele pentru limbi. Când sunt activate, paginile sunt disponibile sub /de/, /en/, /es/ și alte prefixe de limbă acceptate. Când sunt dezactivate, un singur URL al paginii afișează conținutul în limba configurată de utilizator.
- **Ruta limbii implicite** — Adaugă un prefix URL limbii implicite și redirecționează către acesta paginile modulului fără prefix.
- **Mod de mentenanță (modul)** — Activează sau dezactivează modul de mentenanță al modulului. Acest mod mai puțin restrictiv permite executarea hook-urilor WHMCS și a altor componente, spre deosebire de modul de mentenanță al sistemului.
- **Colectează variabile Smarty** — Activează sau dezactivează colectarea variabilelor Smarty.
- **Folosește variabilele Smarty colectate** — Activează sau dezactivează utilizarea variabilelor Smarty colectate în editorul de pagini.
- **Suprascrieri ale paginilor** — Activează sau dezactivează suprascrierile paginilor.
- **Frecvența actualizării** — Dacă nu este selectată nicio opțiune, harta site-ului este actualizată zilnic.
- **Hartă HTML a site-ului** — Când opțiunea este activată, /html-sitemap afișează harta site-ului ca pagină HTML obișnuită; sitemap.xml nu este afectat.
- **Antetul site-ului** — HTML personalizat pentru secțiunea <head>, inclusiv <script> și <style>.
- **Subsolul site-ului** — HTML personalizat înainte de </body>, inclusiv <script> și <style>.
- **Editează robots.txt**

## 1. Instalare și acces

Activați modulul suplimentar în WHMCS și acordați acces administratorilor autorizați. În Baza de date a modulului verificați tabelele necesare. Revizuiți apoi URL-urile prietenoase, rutele lingvistice și pozițiile meniurilor. Apache folosește .htaccess; în Nginx configurați separat regulile echivalente.
