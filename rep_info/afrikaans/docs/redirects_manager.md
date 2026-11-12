# Herleidings en sitemap-tale

## HTTP

Herleidingsbestuurder skep presiese bron → bestemming-reëls met HTTP 301, 302, 303, 307 of 308. Jy kan reëls wysig, afskakel en uitvee; die lys wys 50 per bladsy. 'n Bron is 'n pad wat met / begin of 'n absolute URL op dieselfde webwerf. Die bestemming mag 'n pad of HTTP(S)-adres wees.

'n Eindskuinsstreep is gelykwaardig vir passing, maar die bestemming behou sy eie vorm. 'n Reël vir 'n spesifieke query geniet voorkeur bo 'n padreël; 'n padreël pas ook op versoeke met parameters. Bestemmingsparameters vervang dié van die bron. Reëls hanteer GET- en HEAD-versoeke wat WHMCS bereik voordat die page builder loop. Hulle verander nie .htaccess, die taalsessie of die kliëntprofiel nie. ZM_PB_ENABLE_REDIRECTS_MANAGER skakel gestoorde reëls aan.

'n Outomatiese 301 ontstaan wanneer 'n gepubliseerde bladsy se slug verander en dit gepubliseer bly. Die eerste publikasie van 'n konsep skep nie 'n herleiding nie. ZM_PB_AUTO_REDIRECT_DAYS bepaal die wagtyd, standaard 14 dae; 0 skakel dit uit. Latere hernoemings werk historiese bestemmings by, en 'n terugkeer na 'n ou slug verwyder selfherleiding. Handmatige reëls kry voorkeur. 'n Oorskryfalias kan steeds na sy oorspronklike WHMCS-adres wys.

Reëls word in zm_pb_redirects gestoor. Versoeke herstel nie ontbrekende tabelle nie: gebruik Module database. Bestaande URL-kolomme aanvaar 128 bytes. sitemap_pages.xml en sitemap_posts.xml bevat taalalternatiewe en x-default, maar nie herleidingsbronne nie. Genereer die XML-lêers weer nadat jy adresse verander het.
