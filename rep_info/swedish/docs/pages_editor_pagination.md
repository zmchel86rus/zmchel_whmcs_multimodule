# Sidnumrering

Klicka på blocket som innehåller listan. Tryck på Esc för att avbryta. Sidnumreringen måste ligga utanför det valda blocket.

För Smarty anger du variabeln för hela listan. Utan variabel delas HTML-elementen i behållaren upp i sidor; ange vid behov en radklass eller taggen tr. Länkarna behåller count, sort och filtren. Oberoende listor stöds.

Väljaren för antal objekt kan dras inom sidnumreringen och till andra block på sidan. Den förblir kopplad till denna sidnumrering.

Välj ett Smarty-block som innehåller en lista. Sökning och sidnumrering måste vara kopplade till samma block.

Ange variabeln för hela listan. Sökningen kontrollerar alla angivna fält och filtren tillämpas tillsammans. Villkoren tillämpas före sidberäkningen; tillämpning och återställning går tillbaka till första sidan. Om sidnumrering redan finns används dess variabel.

## Länkar och listkälla

Placera pagineringen utanför listblocket och välj det blocket som mål. För en Smarty-lista anger du variabeln med alla poster; annars delas behållarens HTML-element. Välj länkformat enligt modulinställningen, `/page/2/` eller `?page=2`. Sökvägsformatet kräver rewrite-regler. Oberoende listor använder separata parametrar; länkarna behåller språk, filter och sortering.

## Sidstorlek, SEO och filter

Ange antal poster och aktivera vid behov valet 10/25/50/100/250. Ändrad storlek tar listan tillbaka till första sidan. Noindex gäller först från sida två; kontrollera titel och kanonisk webbadress. Koppla filtren till samma lista och testa sida två och ett filtrerat resultat på den publika webbplatsen.

## page / count / pager

För en Smarty-lista anger du variabeln med alla poster och behåller `{foreach}`-loopen: modulen delar listan, så lägg inte till ett andra `array_slice`. Utan variabel delas behållarens HTML-element; du kan ange en radklass eller taggen `tr`, medan `thead` och `tfoot` lämnas kvar. Ställ in antalet knappar kring aktuell sida separat för dator och mobil. Använd `?page=2` på direkta PHP-rutter; `/page/2/` kräver rewrite-regler. Senare sidor har egen canonical och kan få `noindex`.

Vid flera oberoende listor använder den första `page`, `count` och `sort`; de andra använder parametrar med blockets ID. Med sökvägen `/page/N/` anger `pager` vilken lista numret hör till. I Smarty-blocket ger `$zm_pagination` värdena `total`, `page`, `pages`, `count` och `offset`. `count` begränsas till 10–250. Är listan tom eller har en enda sida döljs pagineringspanelen.

## YYYY-MM-DD

Filter arbetar med samma lista som pagineringen. Textsökning kan kontrollera flera fält åtskilda med kommatecken; datumintervallet använder `YYYY-MM-DD` och omfattar hela sista dagen.

## Flex / Grid

Välj Flex eller Grid och ställ in bredder och kolumner per enhet. När ett filter används eller rensas återgår listan till första sidan. Antalsväljaren kan flyttas utan att kopplingen bryts; en dubblerad panel styr samma lista.

## Instruktioner

- Välj antal objekt: 10, 25, 50, 100, 250
- Indexera inte sida 2 och följande sidor
- Länkformat
- Standardantal objekt
