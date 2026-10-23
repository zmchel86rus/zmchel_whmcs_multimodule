# URL pārrakstīšanas noteikumi

## .htaccess

Atveriet pārvaldnieku un salīdziniet noteikumus ar vietnes galveno `.htaccess` failu. Savām kārtulām saglabājiet URL paraugu, galamērķi un karogus, tad spiediet **Pievienot vai atjaunināt noteikumus**, lai bloku ierakstītu pirms WHMCS noteikumiem. Pārbaudiet statusu vēlreiz un atveriet publicētu lapu noklusējuma un vēl vienā valodā. Pārāk plašs paraugs var ietekmēt citas lapas. Nginx → Apache vidē noteikumi darbojas tikai Apache nodotajiem pieprasījumiem.

## Instrukcijas

- Valodu URL noteikumi, tostarp lapām ar /ru/, /en/ un citiem prefiksiem. Valodas tiek ņemtas no supported_langs.php; noteikumi tiek ievietoti .htaccess pirms WHMCS noteikumiem.
- Nginx nelasa .htaccess failus, tāpēc šie noteikumi tajā nedarbojas. Konfigurējiet līdzvērtīgus noteikumus nginx.
- Konstatēta nginx → Apache konfigurācija. Šie noteikumi darbojas tikai pieprasījumiem, kas pārsūtīti uz Apache; nginx nelasa .htaccess.
- Pārbaudīt noteikumus
- Pievienot vai atjaunināt noteikumus
- Noņemt visus noteikumus no .htaccess
- URL paraugs
- Mērķis
- Karodziņi
- Pēc noteikuma pievienošanas vai dzēšanas noklikšķiniet uz „Pievienot vai atjaunināt noteikumus”, lai piemērotu izmaiņas .htaccess failā.

## 1. Uzstādīšana un piekļuve

Aktivizējiet papildmoduli WHMCS un piešķiriet piekļuvi pilnvarotajiem administratoriem. Moduļa datubāzes sadaļā pārbaudiet nepieciešamās tabulas. Pārskatiet glītās URL adreses, valodu maršrutus un izvēļņu vietas. Apache izmanto .htaccess; Nginx gadījumā atbilstošie servera noteikumi jākonfigurē atsevišķi.
