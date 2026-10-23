# Valodu pārvaldnieks

- **Sadaļas → Valodas → Tulkojumi.** Katra poga Saglabāt saglabā tikai vienu tulkojumu.

Valodu pārvaldniekā var rediģēt WHMCS un moduļu valodu tekstus administrācijas vidē. Funkcija vēl tiek izstrādāta. To var izmantot moduļa superadministrators; PHP nepieciešamas rakstīšanas tiesības attiecīgajās valodu mapēs.

## Sadaļas un valodas izvēle

Vispirms **Moduļa iestatījumi → Atbalstītās valodas** ieslēdziet vajadzīgās valodas. Pēc tam **Valodu pārvaldnieks → Sadaļas** izvēlieties WHMCS klienta vai administrācijas valodas, šo moduli vai citu atrastu moduli. Tabulā ir redzamas esošās, izslēgtās un pievienojamās valodas. Cilnē **Valodas** izvēlieties failu vai pievienojiet trūkstošu valodu. Jauns fails sākumā izmanto atsauces valodas tekstus; tas vēl nav gatavs tulkojums. Atzīme par netulkotu valodu norāda, ka tai nav savu tulkojumu.

## Tulkojumu rediģēšana

Cilnē **Tulkojumi** kolonna **Oriģināls** rāda izvēlētās valodas sākotnējā faila tekstu bez jūsu labojumiem. Ja šai valodai nav savu tekstu, kolonnas nosaukums ir **Atsauce**. Meklējiet pēc atslēgas vai teksta, filtrējiet visas, sākotnējās vai pievienotās atslēgas un saglabājiet katru rindu atsevišķi. Varat pievienot savu atslēgu izvēlētā sadaļā un vēlāk to pārdēvēt vai dzēst. Dažu citu moduļu katalogi ir tikai lasāmi, ja to formātu nevar droši saglabāt.

## JSON

**Eksportēt JSON** lejupielādē izvēlētās sadaļas un valodas atslēgas un tulkojumus. **Importēt JSON** atjaunina tikai jau esošas atslēgas. Nezināmās un atkārtotās atslēgas tiek izlaistas un uzskaitītas rezultātā. Nemainiet sadaļas un valodas identifikatorus vai atslēgu ceļus. Augšupielādes limits ir 8 MiB.

## Faili un noklusējuma valoda

Valodas failu var izslēgt un atkal ieslēgt; to var rediģēt arī izslēgtā stāvoklī. Angļu pamatfails un pašreizējā WHMCS noklusējuma valoda ir aizsargāti. Pārvaldnieka pievienotajiem WHMCS klienta un administrācijas valodu failiem tiek glabātas kopijas atjaunošanai pēc atjauninājuma. Ja cilnē **Sadaļas** redzams faila nosaukuma labojums, pārbaudiet jauno nosaukumu un nospiediet **Labot**; labojums attiecas uz atrastajām sadaļām.

Lai mainītu noklusējuma valodu, vispirms ieslēdziet jauno valodu moduļa iestatījumos, pēc tam nomainiet WHMCS noklusējuma valodu un tikai tad izslēdziet veco. Pārbaudiet tekstus administrācijas un klienta daļā.

## Instrukcijas

- Sadaļas
- Valodas
- Tulkojumi
- Šī valoda ir atspējota, taču tās tulkojumus joprojām var rediģēt.
- Atsauces valoda
- Katra poga Saglabāt saglabā tikai vienu tulkojumu.
- Nav tulkojuma
- Rādīt sākotnējos
- Rādīt pievienotos
- Šīs tulkojumu atslēgas netika importētas:
- nezināma atslēga
- dublēta atslēga
