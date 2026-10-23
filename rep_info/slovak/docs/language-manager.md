# Správca jazykov

Správca jazykov umožňuje upravovať jazykové texty WHMCS a modulov v administrácii. Funkcia je stále vo vývoji. Prístup má superadministrátor modulu a PHP potrebuje oprávnenie zapisovať do príslušných jazykových adresárov.

## Výber sekcie a jazyka

Najprv zapnite požadované jazyky v **Nastavenia modulu → Podporované jazyky**. Potom v **Správca jazykov → Sekcie** vyberte klientské alebo administračné jazyky WHMCS, tento modul či iný nájdený modul. Tabuľka ukazuje existujúce, vypnuté a dostupné jazyky. Na karte **Jazyky** vyberte súbor alebo pridajte chýbajúci jazyk. Nový súbor najskôr používa texty referenčného jazyka; ešte nejde o hotový preklad. Označenie „nepreložené“ znamená, že nemá vlastné preklady.

## Úprava prekladov

Na karte **Preklady** stĺpec **Originál** zobrazuje text z pôvodného súboru vybraného jazyka bez vašich zmien. Ak jazyk nemá vlastné texty, stĺpec sa volá **Referencia**. Hľadajte podľa kľúča alebo textu, filtrujte všetky, pôvodné či pridané kľúče a každý riadok uložte osobitne. Môžete pridať vlastný kľúč do zvolenej sekcie a neskôr ho premenovať alebo zmazať. Niektoré katalógy iných modulov možno len čítať, ak ich formát nie je možné bezpečne ukladať.

**Export JSON** stiahne kľúče a preklady zvolenej sekcie a jazyka. **Import JSON** aktualizuje iba existujúce kľúče. Neznáme a duplicitné kľúče sa preskočia a vypíšu vo výsledku. Nemeňte identifikátory sekcie a jazyka ani cesty ku kľúčom. Maximálna veľkosť súboru je 8 MiB.

## Súbory a predvolený jazyk

Jazykový súbor môžete vypnúť a znova zapnúť; aj vypnutý zostáva upraviteľný. Základný anglický súbor a aktuálny predvolený jazyk WHMCS sú chránené. Pre klientské a administračné jazyky WHMCS pridané správcom sa ukladajú kópie na obnovenie po aktualizácii. Ak sa na karte **Sekcie** objaví oprava názvu súboru, skontrolujte nový názov a kliknite na **Opraviť**; zmena sa vzťahuje na nájdené sekcie.

Pri zmene predvoleného jazyka najskôr zapnite nový jazyk v nastaveniach modulu, potom zmeňte predvolený jazyk vo WHMCS a až následne vypnite starý. Skontrolujte texty v administrácii aj klientskom rozhraní.
