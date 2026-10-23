# Vietnes kartes

Ieslēdziet vietnes karti un ģenerējiet XML failus. Pārbaudiet publicētās valodu versijas sitemap_index.xml; ja atjauninājumu nav, pārbaudiet WHMCS cron un rakstīšanas tiesības.

## XML

XML ietver savstarpējas saites aktīvajām valodām un `x-default` noklusējuma valodas adresei. Pāradresāciju avoti nav iekļauti `loc` vai valodu alternatīvās; rezerves tulkojumu marķē ar satura faktisko valodu. Lapu un ierakstu faili deklarē XHTML nosaukumtelpu.

`AfterCronJob` āķis salīdzina intervālu `ZM_PB_SITEMAP_UPDFREQ` ar pēdējās veiksmīgās izveides laiku `ZM_PB_SITEMAP_LASTUPD`; ja karte ir izslēgta, manuālā izveide arī nav pieejama. Valodu versijas izvēlas pēc `lang_active`, nevis `lang_status`. Papildu daļām pievieno piedēkļus `_2`, `_3` utt. Kļūmes gadījumā iepriekšējos failus atjauno un veiksmes laiks nemainās. Pārbaudiet rakstīšanas tiesības saknē, `resources/` un `inc/editable_consts.php`; tabulas labo atsevišķi moduļa datubāzē.

Automātiskā izveide ir atkarīga no WHMCS cron un iestatītā intervāla; poga to sāk uzreiz. Iekļauj tikai publicētas, viesiem pieejamas lapas un ierakstus ar aktīvajiem tulkojumiem. Ja lapa aizstāj sistēmas lapu, izmanto sistēmas lapas publisko URL, nevis aizstājošās lapas slug. Failus virs 50 000 URL vai 50 MB sadala daļās. Indekss saglabā citas derīgas vietņu kartes.

Modulis vietnes saknē ieraksta `sitemap_index.xml`, `sitemap_pages.xml` un `sitemap_posts.xml`; tukšai kategorijai fails netiek veidots. Kopīgs `sitemap.xml` netiek ģenerēts. Pēc lapu vai valodu maiņas ģenerējiet kartes vēlreiz un atveriet indeksu pārlūkā. Kļūdas gadījumā pārbaudiet rakstīšanas tiesības saknē; pēdējās veiksmīgās ģenerēšanas laiks nemainās.

## Instrukcijas

- Automātiskā ģenerēšana tiek veikta pēc WHMCS cron izpildes, kad pienācis atjaunināšanas laiks. Manuālā ģenerēšana sākas nekavējoties.
- Tiek iekļautas aktīvās lapas un ieraksti, kas pieejami viesiem, tostarp to publicētās valodu versijas. Aizstājējlapām tiek izmantoti aizstājamo lapu publiskie URL.
- Ģenerēt vietnes kartes
- Faili vietnes saknes direktorijā
- Pēdējā veiksmīgā ģenerēšana
- Nākamā atjaunināšana ne agrāk kā
- Ja nekas nav atlasīts, vietnes karte tiek atjaunināta katru dienu.
- Ja iespējots, /html-sitemap rāda vietnes karti kā parastu HTML lapu; sitemap.xml netiek ietekmēts.
- **Atjaunināšanas biežums** — Ja lauks ir tukšs, noklusējuma vērtība ir 'monthly'.
- **Atjaunināšanas prioritāte** — Ja lauks ir tukšs, noklusējuma vērtība ir '0.5'.
