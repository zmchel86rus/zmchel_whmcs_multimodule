# Gestruktureerde data in die uitset

## Schema.org

Kies die Schema-tipe in Page Editor se metadata en kontroleer die gepubliseerde bladsy. Kieslyste kan SiteNavigationElement met werklike etikette, tale en toeganklike URLs lewer. 'n Inhoudsopgawe gebruik SiteNavigationElement en WebPageElement vir ankers wat in werklike opskrifte voorkom. Sigbare, nie-leë vrae en antwoorde kan FAQPage vorm. BreadcrumbList word vir minstens twee kliëntetema-krummels gegenereer.

Organisasie- en kontakbesonderhede kom van WHMCS. Die bladsytaal hoort op WebPage of ContactPage; beskikbare tale van 'n kontakpunt hoort as BCP 47 in ContactPoint.availableLanguage. Moenie inLanguage op Organization raai nie. Filters, invoervelde, bladsygrootte en kontakvorms word nie vanself produkte, dienste of soekdienste nie. Uitlegblokke soos Flex/Grid, knoppies en gewone accordions bepaal nie outomaties 'n inhoudstipe nie.

JSON-LD moet werklik sigbare inhoud beskryf; geldige kode waarborg nie 'n spesiale soekresultaat nie. Die module behou doelbewus geskryfde Smarty- of HTML-opmaak. Vergelyk die finale JSON-LD met sigbare kieslyste, opskrifte, vrae en antwoorde. Versteekte toegangsblokke behoort nie as openbare vrae ingesluit te word nie.

## Kontroleer JSON-LD

Open die gepubliseerde adres as gas en as kliënt. Vergelyk die skakels en breadcrumbs in die bladsy met hul JSON-LD-inskrywings. 'n Geldige Schema.org-entiteit is 'n beskrywing van inhoud, nie 'n belofte dat 'n soekenjin 'n uitgebreide resultaat sal vertoon nie.

## ContactPoint.availableLanguage

Kontaktale kom uit WHMCS en gebruik BCP 47-tags. Die taal van die bepaalde bladsy hoort op WebPage of ContactPage. Voeg geen onbedinkte inLanguage-waarde by Organization nie.
