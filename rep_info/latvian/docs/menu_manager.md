# Izvēlnes

Izveidojiet izvēlni, pievienojiet lapas vai savas saites un sakārtojiet vienumus velkot. Apakšizvēlnei izvēlieties vecākelementu, nosakiet uzrakstus katrai valodai, redzamību viesiem vai klientiem un ierīces. Piešķiriet atrašanās vietu: katrā vietā var būt tikai viena izvēlne. Iekšējām saitēm izvēlieties, vai URL pielāgot pašreizējai valodai. Pārbaudiet publisko izvēlni datorā un tālrunī.

Katram vienumam var norādīt virsrakstu, aprakstu, CSS klases, `rel`, ikonu un atvēršanu jaunā cilnē; publicētas lapas var pievienot arī automātiski. Atsevišķi datoram un tālrunim izvēlieties, vai izvēlne papildina vai aizstāj WHMCS navigāciju. Saite uz moduļa lapu tiek pārrēķināta pēc pašreizējā slug, valodas un URL režīma; tukša etiķete izmanto tulkoto virsrakstu vai lapas nosaukumu. Lapas apmeklējums nemaina klienta profila valodu. Serveris noraida nedrošas URL shēmas un HTML etiķetēs.

## WHMCS

Moduļa iestatījumos ieslēdziet vajadzīgās WHMCS izvēlnes vietas. Katrā vietā var piesaistīt vienu izvēlni, bet vienu izvēlni drīkst izmantot vairākās vietās. Datora skats darbojas no 768 px platuma, mobilais skats — šaurākos ekrānos. Izslēgta vieta nemaina WHMCS standarta izvēlni.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

WHMCS sistēmas maršrutos bez moduļa valodas maršrutēšanas izvēlnes etiķetes izmanto klienta saglabāto valodu; moduļa lapas izmanto URL valodu. Ja noklusējuma valodai ieslēdz savu maršrutu, arī tai ir prefikss. Parasts URL ir `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Savu saiti var atstāt bez lokalizācijas, piemēram, `clientarea.php`. Vecākelementa paslēpšana paslēpj visu zaru.

Lapas vienuma URL tiek pārrēķināts no pašreizējā slug un publicētā tulkojuma. Ja tulkojuma nav, izmanto publicēto noklusējuma valodas versiju. Pielāgota saite var saglabāt ievadīto URL nemainītu; ārējām adresēm, mailto, tel un enkuriem valodas prefiksu nepievieno. Melnraksti, dzēstas un nepieejamas lapas netiek rādītas.

## zm_pb_menus

Dati glabājas tabulās `zm_pb_menus`, `zm_pb_menu_items` un `zm_pb_menu_locations`. Izveidojiet vai salabojiet tās sadaļā Moduļa datubāze. Kokam var būt līdz 10 līmeņiem un 300 vienumiem; dzēšot vecāku, tā bērni pārvietojas vienu līmeni augstāk.

## Norādījumi

- Izveidojiet izvēlni, pievienojiet lapas vai savas saites un sakārtojiet vienumus velkot.
