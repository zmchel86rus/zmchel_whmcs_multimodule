# Transferimi i të dhënave

Një skedar ZIP për të gjitha seksionet ose për seksionet e përzgjedhura, deri në 128 MiB (merrni parasysh kufijtë e ngarkimit të PHP-së). Faqet përkatëse përditësohen sipas slug-ut dhe llojit të qasjes, ndërsa menytë sipas emrit. Regjistrimet e tjera mbeten të pandryshuara. Përfshini faqet kur importoni meny në një sajt të ri. Seksionet e përzgjedhura që mungojnë në skedar anashkalohen. Gjatë importit mbështeten edhe skedarët JSON.

CSS/JS përfshihen së bashku me faqet; imazhet dhe skedarët e tjerë të ngarkuar përfshihen me bibliotekën e mediave. Historiku i rishikimeve, variablat Smarty të mbledhura dhe të dhënat sekrete të WHMCS nuk eksportohen. Rigjeneroni hartën e faqes pas importimit; zbatoni rregullat e rishkrimit te Menaxheri i rishkrimit.

## ZIP

Eksporti mund të përfshijë faqet dhe postimet me përkthimet, përmbajtjen, SEO dhe CSS/JS; menutë me renditjen dhe vendet; cilësimet, ridrejtimet, rregullat e personalizuara dhe bibliotekën e medias me skedarët. Historiku i rishikimeve, ndryshoret e mbledhura Smarty, llogaritë dhe sekretet WHMCS dhe skedarët e temës përjashtohen. Skedari ZIP ka kufi 128 MiB, ndërsa vlejnë edhe kufijtë PHP `upload_max_filesize` dhe `post_max_size`. Për menutë në një sajt tjetër, importoni edhe faqet; zgjidhni paraprakisht emrat e dyfishtë të menuve.

Skedari i eksportit përdor formatin `zmchel_whmcs_multimodule` (versioni 2). Gjatë importit URL-të e sitit burim përshtaten me `SystemURL` të sitit pritës, ndërsa lidhjet e jashtme ruhen. Importi nuk krijon tabela: përgatitini më parë te Baza e të dhënave e modulit. Para nisjes shfaqet konfirmim; regjistrimet ndryshohen brenda një transaksioni dhe skedarët e zëvendësuar rikthehen nëse ndodh gabim.
