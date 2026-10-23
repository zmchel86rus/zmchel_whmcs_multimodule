# Ümberkirjutamise reeglid

## WHMCS

Keelepõhiste URL-ide reeglid, sealhulgas lehed prefiksite /ru/, /en/ ja teiste all. Keeled võetakse failist supported_langs.php; reeglid lisatakse faili .htaccess enne WHMCS-i reegleid.

Nginx ei loe faili .htaccess, seega need reeglid seal ei tööta. Seadistage vastavad reeglid nginxis.

Tuvastati nginx → Apache seadistus. Need reeglid toimivad ainult Apachele edastatud päringute puhul; nginx ei loe faili .htaccess.

Pärast reegli lisamist või kustutamist klõpsake muudatuste rakendamiseks failis .htaccess nupul „Lisa või uuenda reegleid”.

## .htaccess

Ava haldur ja võrdle reegleid saidi peamise `.htaccess`-failiga. Oma reegli jaoks salvesta URL-i muster, siht ja lipud ning seejärel vajuta **Lisa või uuenda reegleid**, et plokk kirjutataks enne WHMCS-i reegleid. Kontrolli olekut uuesti ja ava avaldatud leht vaikekeeles ning veel ühes keeles. Liiga lai muster võib mõjutada muid lehti. Nginx → Apache seadistuses kehtivad need reeglid ainult Apachele edasi antud päringutele.

## Juhised

- Kontrolli reegleid
- Lisa või uuenda reegleid
- Eemalda kõik reeglid failist .htaccess
- URL-i muster
- Sihtkoht
- Lipud
