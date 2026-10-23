# Moduļa iestatījumi

- [Imports un eksports](module_settings_transfer.md)

## Instrukcijas

- Izvēlieties valodas, ko modulis var izmantot. Valodas izslēgšana neizdzēš tās saturu.
- Ja Apache izmantojat saprotamus URL, pēc valodu maiņas atjauniniet noteikumus pārrakstīšanas pārvaldniekā.
- **Vienkāršoti URL** — Iespējot vienkāršotus URL, tostarp sistēmas URL.
- **Valodu maršrutēšana** — Iespējot vai atspējot valodu maršrutus. Ja iespējots, lapas ir pieejamas ar /de/, /en/, /es/ un citiem atbalstīto valodu prefiksiem. Ja atspējots, viens lapas URL rāda saturu lietotāja konfigurētajā valodā.
- **Noklusējuma valodas maršruts** — Piešķir noklusējuma valodai URL prefiksu un pāradresē moduļa lapas bez prefiksa uz to.
- **Uzturēšanas režīms (modulis)** — Iespējot vai atspējot moduļa uzturēšanas režīmu. Šis saudzīgākais režīms ļauj darboties WHMCS āķiem (hooks) un citiem komponentiem, atšķirībā no sistēmas uzturēšanas režīma.
- **Apkopot Smarty mainīgos** — Iespējot vai atspējot Smarty mainīgo apkopošanu.
- **Izmantot apkopotos Smarty mainīgos** — Iespējot vai atspējot apkopoto Smarty mainīgo izmantošanu lapu redaktorā.
- **Lapu aizstāšana** — Iespējot vai atspējot lapu aizstāšanu.
- **Atjaunināšanas biežums** — Ja nekas nav atlasīts, vietnes karte tiek atjaunināta katru dienu.
- **HTML vietnes karte** — Ja iespējots, /html-sitemap rāda vietnes karti kā parastu HTML lapu; sitemap.xml netiek ietekmēts.
- **Vietnes galvene** — Pielāgots HTML sadaļai <head>, tostarp <script> un <style>.
- **Vietnes kājene** — Pielāgots HTML pirms </body>, tostarp <script> un <style>.
- **Rediģēt robots.txt**

## 1. Uzstādīšana un piekļuve

Aktivizējiet papildmoduli WHMCS un piešķiriet piekļuvi pilnvarotajiem administratoriem. Moduļa datubāzes sadaļā pārbaudiet nepieciešamās tabulas. Pārskatiet glītās URL adreses, valodu maršrutus un izvēļņu vietas. Apache izmanto .htaccess; Nginx gadījumā atbilstošie servera noteikumi jākonfigurē atsevišķi.
