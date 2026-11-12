[![Sekotāji](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=Sekot%C4%81ji)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![Zvaigznes](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=Zvaigznes)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![Atzari](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=Atzari)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![Pieteikumi](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=Pieteikumi)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule instrukcija

**zmchel WHMCS Multimodule ir bezmaksas.** Tas ļauj pārvaldīt lapas un rakstus WHMCS administrācijā, izmantojot vizuālo redaktoru, tulkojumus, izvēlnes, mediju bibliotēku, SEO laukus, XML vietnes kartes, pāradresācijas un URL pārrakstīšanas noteikumus.

## Pirms pirmās lietošanas

**Pirms pirmās lietošanas atveriet Moduļa iestatījumi → Atbalstītās valodas un ieslēdziet nepieciešamās valodas.**

Katrā aktivizēšanas reizē modulis automātiski izveido jaunas sāls vērtības un ieraksta tās failā `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). Pārbaudiet, vai visas trīs sāls vērtības ir aizpildītas.

## Pārbaudīta saderība un darbība

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3, 4

## Saderība ar tīmekļa serveriem

Apache tiek pilnībā atbalstīts. Nginx var darboties, taču valodu maršrutēšanai sākumlapā var būt vajadzīga papildu konfigurācija.

## Moduļa iestatījumi

Izvēlieties valodas, ko modulis var izmantot. Valodas izslēgšana neizdzēš tās saturu.

- **Moduļa iestatījumi → Atbalstītās valodas → Iespējot**
- **Moduļa datubāze → Labot Atlasītie vienumi**
- **URL pārrakstīšanas noteikumi → Pārbaudīt noteikumus → Pievienot vai atjaunināt noteikumus**

Nginx nelasa .htaccess failus, tāpēc šie noteikumi tajā nedarbojas. Konfigurējiet līdzvērtīgus noteikumus nginx.

## Lapu pārvaldnieks

- **Pievienot lapu → Lapas nosaukums → Lapas URL identifikators (slug) → Saglabāt**
- **Lapu redaktors → Satura iestatījumi → Metadatu iestatījumi → Lapas vietnes kartes iestatījumi → Saglabāt visu**
- **Lapu pārvaldnieks → Apmeklēt**
- **Vietnes karte → Ģenerēt vietnes kartes**

Atļauti tikai latīņu burti, defises un cipari.

Pieteikušies lietotāji: lapai var piekļūt tikai pieteikušies lietotāji; Viesi: tikai viesi; Jaukta piekļuve: lapai var piekļūt visi, bet redzamību kontrolē lapas bloki.

Automātiskā ģenerēšana tiek veikta pēc WHMCS cron izpildes, kad pienācis atjaunināšanas laiks. Manuālā ģenerēšana sākas nekavējoties.

## Sadaļu ceļveži

- [Lapu pārvaldnieks](docs/pages_manager.md)
- [Lapu redaktors](docs/pages_editor.md)
- [Multivides pārvaldnieks](docs/media_manager.md)
- [Izvēlnes](docs/menu_manager.md)
- [Valodu pārvaldnieks](docs/langs_manager.md)
- [Pāradresācijas](docs/redirects_manager.md)
- [Vietnes kartes](docs/sitemap_manager.md)
- [URL pārrakstīšanas noteikumi](docs/rewrite_manager.md)
- [Moduļa iestatījumi](docs/module_settings.md)
- [Moduļa datubāze](docs/module_db.md)

## Papildu materiāli

- [Lapošana un filtri](docs/pages_editor_pagination.md)
- [Smarty un mainīgie](docs/pages_editor_smarty.md)
- [Strukturētie dati](docs/module_structured_data.md)
- [Imports un eksports](docs/module_settings_transfer.md)
