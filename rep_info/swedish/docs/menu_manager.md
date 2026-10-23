# Menyer

Skapa en meny, lägg till sidor eller egna länkar och sortera objekten genom att dra dem. Välj ett överordnat objekt för undermenyer och ange etiketter per språk, synlighet för gäster eller kunder samt enheter. Tilldela en plats; varje plats kan bara ha en meny. Välj om interna länkars URL ska följa det aktuella språket. Kontrollera den publika menyn på dator och telefon.

För varje post kan du ange titel, beskrivning, CSS-klasser, `rel`, ikon och öppning i ny flik; publicerade sidor kan också läggas till automatiskt. Välj separat för dator och mobil om menyn kompletterar eller ersätter WHMCS-navigeringen. En länk till en modulsida räknas om utifrån aktuell slug, språk och URL-läge; en tom etikett använder översatt titel eller sidans namn. Ett sidbesök ändrar inte språket i kundens profil. Servern avvisar osäkra URL-scheman och HTML i etiketter.

## WHMCS

Aktivera önskade WHMCS-menyplatser i modulens inställningar. Varje plats kan ha en meny, medan samma meny kan användas på flera platser. Datorvyn gäller från 768 px bredd och mobilvyn på smalare skärmar. En inaktiverad plats lämnar WHMCS standardmeny oförändrad.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

På WHMCS-systemrutter utan modulens språkstyrning använder menyetiketter kundens sparade språk; modulsidor använder språket i URL:en. Om standardspråket får en egen rutt får det också ett prefix. En vanlig URL är `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. En egen länk kan lämnas utan lokalisering, till exempel `clientarea.php`. Att dölja ett överordnat objekt döljer hela grenen.

URL:en för ett sidobjekt beräknas om från aktuell slug och publicerad översättning. Om översättningen saknas används den publicerade versionen på standardspråket. En anpassad länk kan behålla angiven URL; externa adresser, mailto, tel och ankare får inget språkprefix. Utkast, borttagna och otillgängliga sidor visas inte.

## zm_pb_menus

Data finns i tabellerna `zm_pb_menus`, `zm_pb_menu_items` och `zm_pb_menu_locations`. Skapa eller reparera tabellerna under Modulens databas. Trädet har högst 10 nivåer och 300 objekt; när en överordnad post tas bort flyttas dess underposter upp en nivå.

## Instruktioner

- Skapa meny
- Lägg till sidor, inlägg eller anpassade länkar.
- Dra objekt för att ändra ordningen. Ange hierarki med valet av överordnat objekt eller flyttknapparna.
- Använd den aktuella sidans språk
- Använd den angivna URL:en oförändrad
- Etiketter på andra språk
- Synlig för
- Enheter
- Varje placering kan ha en meny. Om du väljer en placering flyttas tilldelningen hit från en annan meny.
- Objekt på toppnivå blir kolumner och underordnade objekt blir länkar. Använd URL # för en rubrik utan länk.
- Menytabellerna har inte skapats ännu. Lägg till dem i Moduldatabas.

