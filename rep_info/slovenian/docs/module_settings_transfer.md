# Uvoz in izvoz

Pred večjimi spremembami izvozite želene razdelke. Po uvozu preverite strani, menije in medije, posebej uporabite pravila za prepisovanje in osvežite zemljevid. To ne nadomesti varnostne kopije WHMCS. Pri uvozu so podprte tudi datoteke JSON.

## ZIP

Izvoz lahko vključuje strani in objave s prevodi, vsebino, SEO in CSS/JS; menije s hierarhijo in mesti; nastavitve, preusmeritve, lastna pravila in medijsko knjižnico z datotekami. Zgodovina popravkov, zbrane spremenljivke Smarty, računi in skrivnosti WHMCS ter datoteke teme niso vključeni. Datoteka ZIP je omejena na 128 MiB; veljata tudi omejitvi PHP `upload_max_filesize` in `post_max_size`. Pri prenosu menijev na drugo spletno mesto uvozite tudi strani in vnaprej razrešite podvojena imena menijev.

Izvožena datoteka uporablja obliko `zmchel_whmcs_multimodule` (različica 2). Pri uvozu se URL-ji izvornega mesta prilagodijo ciljnemu `SystemURL`, zunanje povezave pa ostanejo enake. Uvoz ne ustvarja tabel: najprej jih pripravite v Podatkovni zbirki modula. Pred začetkom je potrebna potrditev; zapisi se spreminjajo v transakciji, zamenjane datoteke pa se ob napaki obnovijo.
