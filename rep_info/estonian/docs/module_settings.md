# Mooduli seaded

## WHMCS

Valige keeled, mida moodul saab kasutada. Keele väljalülitamine ei kustuta selle sisu. Kui kasutate Apache'is ilusaid URL-e, uuendage pärast keelte muutmist reegleid Rewrite Manageris.

- [Import ja eksport](module_settings_transfer.md)

## Juhised

- **Ilusad URL-id** — Luba ilusad URL-id, sealhulgas süsteemi URL-id.
- **Keelepõhine suunamine** — Luba või keela keelepõhised marsruudid. Kui need on lubatud, on lehed saadaval prefiksite /de/, /en/, /es/ ja muude toetatud keelte all. Kui need on keelatud, kuvab üks lehe URL sisu kasutaja seadistatud keeles.
- **Vaikekeele marsruut** — Lisab vaikekeelele oma URL-i prefiksi ja suunab prefiksita moodulilehed sellele.
- **Hooldusrežiim (moodul)** — Luba või keela mooduli hooldusrežiim. See leebem režiim lubab WHMCS-i hook'idel ja muudel komponentidel edasi töötada, erinevalt süsteemi hooldusrežiimist.
- **Kogu Smarty muutujad** — Luba või keela Smarty muutujate kogumine.
- **Kasuta kogutud Smarty muutujaid** — Luba või keela kogutud Smarty muutujate kasutamine leheredaktoris.
- **Lehtede asendused** — Luba või keela lehtede asendused.
- **Uuendamise sagedus** — Kui midagi pole valitud, uuendatakse saidikaarti iga päev.
- **HTML-saidikaart** — Kui see on lubatud, kuvatakse aadressil /html-sitemap saidikaart tavalise HTML-lehena; sitemap.xml jääb muutmata.
- **Saidi päis** — Kohandatud HTML jaotise \<head> jaoks, sealhulgas \<script> ja \<style>.
- **Saidi jalus** — Kohandatud HTML enne \</body> märgendit, sealhulgas \<script> ja \<style>.
- **Muuda robots.txt**
