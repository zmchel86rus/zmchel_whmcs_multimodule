# Multimodul gratuit pentru WHMCS

**zmchel WHMCS Multimodule este gratuit.** Permite administrarea paginilor și articolelor din panoul WHMCS, cu editor vizual, traduceri, meniuri, fișiere media, câmpuri SEO, sitemap-uri XML, redirecționări și reguli de rescriere.

## Înainte de prima utilizare

**Înainte de prima utilizare, deschideți Setările modulului → Limbi acceptate și activați limbile necesare.**

La fiecare activare, modulul generează automat valori salt noi și le scrie în `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Verificați dacă toate cele trei valori salt sunt completate.

php.** Modulul a fost dezvoltat și testat pe WHMCS 8.13.0–9.1.0. Apache este acceptat integral. Nginx poate funcționa, dar rutarea limbilor pe pagina principală poate necesita configurare suplimentară.

**Versiuni PHP verificate:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 și 8.5.

## Dezvoltare viitoare

- Adăugarea paginilor imbricate și a categoriilor de pagini.
- Împărțirea monolitului actual în componente care colaborează.
- Un manager de drepturi de acces pentru administrarea modulului.
- Extinderea limbilor implicite din supported_langs.php.
- Un editor de cod pentru șabloanele modulului și temele client, fără tema de administrare.
- ~~Un manager de limbi pentru fișierele WHMCS și ale altor module.~~
- Îmbunătățirea managerului media.
- Un manager SEO complet și eficient, inspirat de Yoast SEO.
- ~~Sitemap-uri XML multilingve și o pagină HTML de sitemap.~~
- Adăugarea unei pagini HTML cu harta site-ului.
- Statistici de utilizare în managerul de pagini.
- Minificarea JS, CSS și HTML, cache pentru pagini întregi și optimizarea tabelelor modulului și WHMCS.
- Un sistem adecvat de actualizare a modulului.

Acestea sunt idei, nu un calendar ferm.

## Propuneți o idee

Trimiteți o sugestie prin e-mail. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)

## Puneți o întrebare

Trimiteți o întrebare despre modul prin e-mail. [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E)
