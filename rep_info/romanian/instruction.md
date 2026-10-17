# Instrucțiuni pentru zmchel WHMCS Multimodule

**Înainte de utilizare, generați săruri unice și introduceți ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT și ZM_PB_NONCE_SALT în module_init.php.** Modulul a fost dezvoltat și testat pe WHMCS 8.13.1–8.13.7. Apache este acceptat integral. Nginx poate funcționa, dar rutarea limbilor pe pagina principală poate necesita configurare suplimentară.

**Versiuni PHP verificate:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 și 8.5.

**zmchel WHMCS Multimodule este gratuit.** Permite administrarea paginilor și articolelor din panoul WHMCS, cu editor vizual, traduceri, meniuri, fișiere media, câmpuri SEO, sitemap-uri XML, redirecționări și reguli de rescriere.

## 1. Instalare și acces

Activați modulul suplimentar în WHMCS și acordați acces administratorilor autorizați. În Baza de date a modulului verificați tabelele necesare. Revizuiți apoi URL-urile prietenoase, rutele lingvistice și pozițiile meniurilor. Apache folosește .htaccess; în Nginx configurați separat regulile echivalente.

## 2. Crearea paginilor

Deschideți lista de pagini și alegeți adăugarea unei pagini. Introduceți un nume intern și un slug cu litere latine, cifre și cratime, de exemplu about-us. Alegeți accesul public, doar pentru clienți autentificați sau doar pentru vizitatori. Selectați starea și limbile. Limba implicită a WHMCS trebuie să fie acceptată de modul.

## 3. Editarea conținutului

Pentru fiecare limbă completați filele Conținut, Metadate și Sitemap. Trageți blocuri în editor, modificați textul și imaginile și salvați fiecare filă. Copierea cu conținut oferă un punct de pornire; copierea structurii pregătește aspectul pentru traducere. Textul nu este tradus automat.

## 4. Linkuri și publicare

Activați adăugarea limbii curente în URL pentru linkuri către pagini traduse ale modulului. Dezactivați opțiunea pentru URL-uri externe, adrese de e-mail și rute WHMCS fără variante lingvistice. După publicare, verificați pagina ca vizitator și client, pe desktop și mobil, în cel puțin două limbi.

## 5. Administrare și întreținere

Managerul de meniuri controlează navigarea, iar managerul media controlează imaginile. Managerul de redirecționări creează reguli 301 și 302. Sitemap generează fișiere XML. Exportați setările înaintea modificărilor importante; după schimbarea regulilor de rescriere, aplicați-le din nou și verificați sitemap-ul.

## Subiecte detaliate

- [Meniuri](docs/menus.md)
- [Paginare și filtre](docs/pagination.md)
- [Redirecționări](docs/redirects.md)
- [Sitemap-uri](docs/sitemaps.md)
- [Smarty și variabile](docs/smarty.md)
- [Date structurate](docs/structured-data.md)
- [Import și export](docs/transfer.md)
