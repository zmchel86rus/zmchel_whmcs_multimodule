# Import a export

Pred veľkými zmenami exportujte potrebné časti. Po importe skontrolujte stránky, ponuky a médiá, samostatne použite pravidlá prepisovania a obnovte mapu. To nenahrádza zálohu WHMCS.

## JSON

Export môže obsahovať stránky a príspevky s prekladmi, obsahom, SEO a CSS/JS; ponuky s hierarchiou a umiestnením; nastavenia, presmerovania, vlastné pravidlá a mediálnu knižnicu so súbormi. História revízií, zhromaždené premenné Smarty, účty a tajné údaje WHMCS ani súbory témy sa neexportujú. Súbor JSON má limit 32 MiB; platia aj limity PHP `upload_max_filesize` a `post_max_size`. Pri presune ponúk na iný web importujte aj stránky a vopred vyriešte rovnaké názvy ponúk.

Exportovaný súbor používa formát `zmchel_whmcs_multimodule` (verzia 1). Pri importe sa URL zdrojového webu upravia podľa `SystemURL` cieľa, externé odkazy zostanú zachované. Import nevytvára tabuľky: pripravte ich najprv v Databáze modulu. Pred začiatkom sa vyžiada potvrdenie; záznamy sa menia v transakcii a nahradené súbory sa pri chybe obnovia.

## Pokyny

- Jeden súbor JSON pre všetky alebo vybrané sekcie s veľkosťou do 32 MiB (platia aj limity nahrávania v PHP). Zhodné stránky sa aktualizujú podľa slugu a typu prístupu, ponuky podľa názvu. Ostatné záznamy zostanú nezmenené. Pri importe ponúk na novú lokalitu zahrňte aj stránky. Vybrané sekcie, ktoré v súbore chýbajú, sa preskočia.
- CSS/JS sú zahrnuté v stránkach; obrázky a ostatné nahrané súbory v knižnici médií. História revízií, zhromaždené premenné Smarty a citlivé údaje WHMCS sa neexportujú. Po importe znova vygenerujte mapu stránok; pravidlá prepisovania URL použite v Správcovi pravidiel prepisovania.
- Stránky a príspevky (preklady, obsah, SEO, nastavenia mapy stránok, bloky CSS/JS)
- Ponuky a umiestnenia
- Nastavenia modulu, nahradenia stránok, hlavička/pätička, robots.txt
- Presmerovania
- Vlastné pravidlá prepisovania URL
- Knižnica médií (súbory a popisy)
- Zhodné záznamy vo vybraných sekciách sa aktualizujú podľa súboru. Pokračovať?
