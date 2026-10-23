# Hartat e faqes

Përfshihen faqet dhe postimet aktive që mund të shihen nga vizitorët, së bashku me versionet e tyre të publikuara në gjuhë të ndryshme. Zëvendësimet përdorin URL-të publike të faqeve që zëvendësojnë.

## XML

XML përfshin lidhje reciproke për gjuhët aktive dhe `x-default` për adresën e gjuhës së parazgjedhur. Burimet e ridrejtimeve nuk përfshihen në `loc` ose në alternativat gjuhësore; një përkthim që përdor rezervën shënohet me gjuhën reale të përmbajtjes. Skedarët e faqeve dhe postimeve deklarojnë hapësirën XHTML.

Hook-u `AfterCronJob` kontrollon intervalin `ZM_PB_SITEMAP_UPDFREQ` kundrejt kohës së gjenerimit të fundit të suksesshëm `ZM_PB_SITEMAP_LASTUPD`; kur sitemap është çaktivizuar, nuk ofrohet as gjenerimi manual. Gjuhët merren vetëm nga versionet aktive (`lang_active`), jo nga `lang_status`. Pjesët shtesë marrin prapashtesat `_2`, `_3` e kështu me radhë. Nëse gjenerimi dështon, skedarët e mëparshëm rikthehen dhe koha e suksesit nuk ndryshon. Përveç rrënjës së sitit, kontrolloni shkrimin në `resources/` dhe `inc/editable_consts.php`; tabelat riparohen veçmas në bazën e të dhënave të modulit.

Gjenerimi automatik varet nga cron-i i WHMCS dhe intervali i caktuar në modul; butoni i gjenerimit e nis menjëherë. Përfshihen vetëm faqet dhe postimet e publikuara që mund të shihen nga vizitorët, bashkë me përkthimet aktive. Nëse një faqe zëvendëson një faqe sistemi, përdoret URL-ja publike e faqes së sistemit. Skedarët me mbi 50 000 URL ose 50 MB ndahen në pjesë. Indeksi ruan hartat e tjera të vlefshme të faqes.

Moduli shkruan `sitemap_index.xml`, `sitemap_pages.xml` dhe `sitemap_posts.xml` në rrënjën e faqes; kategoritë pa URL nuk krijojnë skedar. Ai nuk krijon një `sitemap.xml` të përbashkët. Pas ndryshimit të faqeve ose gjuhëve, gjenerojini sërish dhe hapni indeksin në shfletues. Nëse shfaqet gabim, kontrolloni lejen e shkrimit në rrënjë; koha e gjenerimit të suksesshëm nuk përditësohet kur operacioni dështon.

## Udhëzime

- Gjenerimi automatik kryhet pas cron-it të WHMCS kur është koha për përditësim. Gjenerimi manual nis menjëherë.
- Gjenero hartat e sajtit
- Skedarët në rrënjën e sajtit
- Gjenerimi i fundit i suksesshëm
- Përditësimi i ardhshëm jo më herët se
- Nëse nuk përzgjidhet asgjë, harta e sajtit përditësohet çdo ditë.
- Kur aktivizohet, /html-sitemap e shfaq hartën e sajtit si faqe normale HTML; sitemap.xml mbetet i pandryshuar.
- **Frekuenca e përditësimit** — Nëse lihet bosh, përdoret vlera e parazgjedhur 'monthly'.
- **Përparësia e përditësimit** — Nëse lihet bosh, përdoret vlera e parazgjedhur '0.5'.
