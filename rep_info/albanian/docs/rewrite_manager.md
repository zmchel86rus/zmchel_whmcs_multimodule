# Rregullat e rishkrimit

## WHMCS

Rregulla për URL-të sipas gjuhëve, duke përfshirë faqet nën /ru/, /en/ dhe prefikse të tjera. Gjuhët merren nga supported_langs.php; rregullat futen në .htaccess përpara rregullave të WHMCS.

U zbulua një konfigurim nginx → Apache. Këto rregulla funksionojnë vetëm për kërkesat që i përcillen Apache; nginx nuk e lexon .htaccess.

## .htaccess

Hapni menaxherin dhe krahasoni rregullat me skedarin kryesor `.htaccess`. Për një rregull tuajin ruani modelin e URL-së, destinacionin dhe flamujt; më pas përdorni **Shto ose përditëso rregullat** që blloku të shkruhet para rregullave WHMCS. Kontrolloni gjendjen sërish dhe provoni një faqe të publikuar në gjuhën kryesore dhe në një tjetër. Modeli tepër i gjerë mund të prekë faqe të tjera. Në lidhjen Nginx → Apache, këto rregulla vlejnë vetëm për kërkesat që arrijnë te Apache.

## Udhëzime

- Nginx nuk e lexon skedarin .htaccess, prandaj këto rregulla nuk funksionojnë aty. Konfiguroni rregulla të barasvlershme në nginx.
- Kontrollo rregullat
- Shto ose përditëso rregullat
- Hiq të gjitha rregullat nga .htaccess
- Modeli i URL-së
- Objektivi
- Flamujt
- Pas shtimit ose fshirjes së një rregulli, klikoni “Shto ose përditëso rregullat” për të zbatuar ndryshimet në .htaccess.
