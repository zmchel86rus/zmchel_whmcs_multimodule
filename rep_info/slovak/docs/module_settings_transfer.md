# Import a export

Pred veľkými zmenami exportujte potrebné časti. Po importe skontrolujte stránky, ponuky a médiá, samostatne použite pravidlá prepisovania a obnovte mapu. To nenahrádza zálohu WHMCS. Pri importe sú podporované aj súbory JSON.

## ZIP

Export môže obsahovať stránky a príspevky s prekladmi, obsahom, SEO a CSS/JS; ponuky s hierarchiou a umiestnením; nastavenia, presmerovania, vlastné pravidlá a mediálnu knižnicu so súbormi. História revízií, zhromaždené premenné Smarty, účty a tajné údaje WHMCS ani súbory témy sa neexportujú. Súbor ZIP má limit 128 MiB; platia aj limity PHP `upload_max_filesize` a `post_max_size`. Pri presune ponúk na iný web importujte aj stránky a vopred vyriešte rovnaké názvy ponúk.

Exportovaný súbor používa formát `zmchel_whmcs_multimodule` (verzia 2). Pri importe sa URL zdrojového webu upravia podľa `SystemURL` cieľa, externé odkazy zostanú zachované. Import nevytvára tabuľky: pripravte ich najprv v Databáze modulu. Pred začiatkom sa vyžiada potvrdenie; záznamy sa menia v transakcii a nahradené súbory sa pri chybe obnovia.
