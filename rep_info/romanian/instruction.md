# Instrucțiuni pentru zmchel WHMCS Multimodule

**Înainte de utilizare, generați săruri unice și introduceți ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT și ZM_PB_NONCE_SALT în module_init.php.** Modulul a fost dezvoltat și testat pe WHMCS 8.13.1–8.13.7. Apache este acceptat integral. Nginx poate funcționa, dar rutarea limbilor pe pagina principală poate necesita configurare suplimentară.

**Înainte de prima utilizare, deschideți Setările modulului → Limbi acceptate și activați limbile necesare.**

**Versiuni PHP verificate:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 și 8.5.

**zmchel WHMCS Multimodule este gratuit.** Permite administrarea paginilor și articolelor din panoul WHMCS, cu editor vizual, traduceri, meniuri, fișiere media, câmpuri SEO, sitemap-uri XML, redirecționări și reguli de rescriere.

## Setările modulului

Alegeți limbile pe care le poate folosi modulul. Dezactivarea unei limbi nu îi șterge conținutul.

- **Setările modulului → Limbi acceptate → Activează**
- **Baza de date a modulului → Remediază Elemente selectate**
- **Reguli de rescriere → Verifică regulile → Adaugă sau actualizează regulile**

Nginx nu citește .htaccess, astfel încât aceste reguli nu funcționează în Nginx. Configurați reguli echivalente în nginx.

## Manager de pagini

- **Adaugă pagină → Numele paginii → Slug-ul paginii → Salvează**
- **Editor de pagini → Setări de conținut → Setări pentru metadate → Setările hărții site-ului pentru pagină → Salvează tot**
- **Manager de pagini → Vizitează**
- **Hartă a site-ului → Generează hărțile site-ului**

Sunt permise numai litere latine, cratime și cifre.

Utilizatori autentificați: numai cei autentificați pot accesa pagina; Vizitatori: numai vizitatorii neautentificați o pot accesa; Mixt: toți o pot accesa, iar vizibilitatea este controlată de blocurile din pagină.

Generarea automată rulează după cron-ul WHMCS când este necesară o actualizare. Generarea manuală începe imediat.

## Ghiduri pe secțiuni

- [Manager de pagini](docs/pages_manager.md)
- [Editor de pagini](docs/pages_editor.md)
- [Manager media](docs/media_manager.md)
- [Meniuri](docs/menu_manager.md)
- [Managerul de limbi](docs/langs_manager.md)
- [Redirecționări](docs/redirects_manager.md)
- [Sitemap-uri](docs/sitemap_manager.md)
- [Reguli de rescriere](docs/rewrite_manager.md)
- [Setările modulului](docs/module_settings.md)
- [Baza de date a modulului](docs/module_db.md)

## Materiale suplimentare

- [Paginare și filtre](docs/pages_editor_pagination.md)
- [Smarty și variabile](docs/pages_editor_smarty.md)
- [Date structurate](docs/module_structured_data.md)
- [Import și export](docs/module_settings_transfer.md)
