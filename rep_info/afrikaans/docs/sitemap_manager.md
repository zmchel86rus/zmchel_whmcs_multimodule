# Werfkaart

## XML

Die XML toon wederkerige alternatiewe vir aktiewe tale en x-default vir die verstektaal se adres. Herleidingsbronne verskyn nie in loc of taalalternatiewe nie; fallback-inhoud gebruik sy werklike taal. Die bladsy- en artikelwerfkaarte verklaar die XHTML-naamruimte sodat taalverwysings per URL beskikbaar is.

Die generator is in lib/sitemap.php, helpers in inc/sitemap_manager.php en die AfterCronJob-hook in hooks/sitemap.php. As ZM_PB_ENABLE_SITEMAP af is, werk nóg die hook nóg handmatige generering. Ná cron vergelyk die module die huidige tyd met ZM_PB_SITEMAP_LASTUPD en ZM_PB_SITEMAP_UPDFREQ. 'n Onbekende frekwensie beteken daagliks; **Generate** begin onmiddellik. Slegs die laaste suksesvolle tyd word gestoor.

Die webwerfwortel kry sitemap_index.xml, sitemap_pages.xml en sitemap_posts.xml. Meer as 50 000 URLs of 50 MB word in bykomende lêers verdeel. Die indeks neem ander geldige root-urlset-lêers in, sonder om indekse in te sluit. Die module verander of verwyder net sy eie bladsy- en artikelwerfkaarte. Leë kategorieë lewer geen lêer nie.

Slegs aktiewe, gepubliseerde, openbare bladsye en artikels met lang_active word ingesluit. 'n WHMCS-bladsyvervanging gebruik die oorspronklike openbare URL en laat die layout se slug weg. Die opsionele verstektaalvoorvoegsel geld ook hier. Skryftoegang tot die webwerfwortel, resources/ en inc/editable_consts.php is nodig. Ontbrekende tabelle moet in Module database herstel word; by 'n fout word vorige lêers teruggesit en die suksesvolle tyd bly onveranderd.
