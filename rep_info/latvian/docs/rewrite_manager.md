# URL pārrakstīšanas noteikumi

## .htaccess

Atveriet pārvaldnieku un salīdziniet noteikumus ar vietnes galveno `.htaccess` failu. Savām kārtulām saglabājiet URL paraugu, galamērķi un karogus, tad spiediet **Pievienot vai atjaunināt noteikumus**, lai bloku ierakstītu pirms WHMCS noteikumiem. Pārbaudiet statusu vēlreiz un atveriet publicētu lapu noklusējuma un vēl vienā valodā. Pārāk plašs paraugs var ietekmēt citas lapas. Nginx → Apache vidē noteikumi darbojas tikai Apache nodotajiem pieprasījumiem.

## 1. Uzstādīšana un piekļuve

Aktivizējiet papildmoduli WHMCS un piešķiriet piekļuvi pilnvarotajiem administratoriem. Moduļa datubāzes sadaļā pārbaudiet nepieciešamās tabulas. Pārskatiet glītās URL adreses, valodu maršrutus un izvēļņu vietas. Apache izmanto .htaccess; Nginx gadījumā atbilstošie servera noteikumi jākonfigurē atsevišķi.
