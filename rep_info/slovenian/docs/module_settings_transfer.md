# Uvoz in izvoz

Pred večjimi spremembami izvozite želene razdelke. Po uvozu preverite strani, menije in medije, posebej uporabite pravila za prepisovanje in osvežite zemljevid. To ne nadomesti varnostne kopije WHMCS.

## JSON

Izvoz lahko vključuje strani in objave s prevodi, vsebino, SEO in CSS/JS; menije s hierarhijo in mesti; nastavitve, preusmeritve, lastna pravila in medijsko knjižnico z datotekami. Zgodovina popravkov, zbrane spremenljivke Smarty, računi in skrivnosti WHMCS ter datoteke teme niso vključeni. Datoteka JSON je omejena na 32 MiB; veljata tudi omejitvi PHP `upload_max_filesize` in `post_max_size`. Pri prenosu menijev na drugo spletno mesto uvozite tudi strani in vnaprej razrešite podvojena imena menijev.

Izvožena datoteka uporablja obliko `zmchel_whmcs_multimodule` (različica 1). Pri uvozu se URL-ji izvornega mesta prilagodijo ciljnemu `SystemURL`, zunanje povezave pa ostanejo enake. Uvoz ne ustvarja tabel: najprej jih pripravite v Podatkovni zbirki modula. Pred začetkom je potrebna potrditev; zapisi se spreminjajo v transakciji, zamenjane datoteke pa se ob napaki obnovijo.

## Navodila

- Ena datoteka JSON za vse ali izbrane razdelke, velika največ 32 MiB (veljajo tudi omejitve nalaganja v PHP). Ujemajoče se strani se posodobijo glede na URL-oznako (slug) in vrsto dostopa, meniji pa glede na ime. Drugi zapisi ostanejo nespremenjeni. Pri uvozu menijev na novo spletno mesto vključite tudi strani. Izbrani razdelki, ki jih ni v datoteki, se preskočijo.
- CSS/JS se izvozita skupaj s stranmi, slike in druge naložene datoteke pa s knjižnico predstavnostnih datotek. Zgodovina revizij, zbrane spremenljivke Smarty in skrivni podatki WHMCS se ne izvozijo. Po uvozu znova ustvarite zemljevid spletnega mesta; pravila prepisovanja uporabite v upravljalniku pravil prepisovanja.
- Strani in objave (prevodi, vsebina, SEO, nastavitve zemljevida spletnega mesta, bloki CSS/JS)
- Meniji in položaji
- Nastavitve modula, nadomestitve strani, glava/noga, robots.txt
- Preusmeritve
- Pravila prepisovanja URL po meri
- Knjižnica predstavnostnih datotek (datoteke in opisi)
- Ujemajoči se zapisi v izbranih razdelkih bodo posodobljeni iz datoteke. Želite nadaljevati?
