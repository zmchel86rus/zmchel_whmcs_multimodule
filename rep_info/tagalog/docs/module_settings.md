# Mga setting ng module

Unahin ang pagpapagana ng mga wikang kailangan mo. Piliin ang URL format at language routing, i-save, at subukan ang nailathalang mga pahina. Kung binago ang route, i-update ang Apache rules sa Rewrite Manager o ang katumbas na Nginx configuration. Mag-export ng backup bago gumawa ng malalaking pagbabago o mag-import ng data.

## Mga tab na available

- **Import / export:** gumawa ng ZIP backup ng napiling module data o mag-import ng ZIP at JSON. Basahin ang [gabay sa paglilipat](module_settings_transfer.md) bago mag-import.
- **Editable constants:** baguhin ang mga setting para sa URL, routing, output, media, maintenance, at Smarty. Basahin ang paliwanag ng bawat field at suriin ang epekto sa pampublikong pahina.
- **Supported languages:** paganahin ang wika bago lumikha ng pahina. Panatilihing aktibo ang WHMCS default hangga't hindi pa ito napapalitan sa WHMCS.
- **Redirects at Sitemap:** itakda ang stored at automatic redirects at oras ng paglikha ng XML. Ang mga indibidwal na rule ay nasa kani-kanilang manager.
- **Header, Footer, Robots:** baguhin ang nilalaman ng head, footer, at robots.txt, at tingnan ang aktuwal na pahina o file matapos mag-save.

Ang mga setting na umaasa sa server route ay nangangailangan ng kaakibat na configuration. Gumamit ng .htaccess sa Apache at hiwalay na server rule sa Nginx.
