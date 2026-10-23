# Nabídky

Vytvořte nabídku, přidejte stránky nebo vlastní odkazy a seřaďte položky přetažením. Pro podnabídku vyberte nadřazenou položku; nastavte popisky podle jazyka, viditelnost pro hosty či klienty a zařízení. Přiřaďte umístění: na každém místě může být jen jedna nabídka. U interních odkazů zvolte, zda se má URL přizpůsobit aktuálnímu jazyku. Veřejnou nabídku zkontrolujte na počítači i telefonu.

U každé položky lze nastavit titulek, popis, třídy CSS, `rel`, ikonu a otevření v nové kartě; zveřejněné stránky lze přidávat automaticky. Pro počítač a mobil zvlášť zvolte, zda nabídka rozšíří, nebo nahradí navigaci WHMCS. Odkaz na stránku modulu se přepočítává podle aktuálního slugu, jazyka a režimu URL; prázdný štítek použije přeložený titulek nebo název stránky. Návštěva stránky nemění jazyk v profilu klienta. Server odmítá nebezpečná schémata URL a HTML ve štítcích.

## WHMCS

V nastavení modulu zapněte požadované pozice nabídek WHMCS. Na každé pozici může být jedna nabídka, stejnou nabídku však lze přiřadit více pozicím. Zobrazení pro počítač se používá od šířky 768 px, mobilní zobrazení na užších obrazovkách. Vypnutá pozice ponechá běžnou nabídku WHMCS beze změny.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Na systémových trasách WHMCS bez jazykového směrování modulu používají popisky nabídek uložený jazyk klienta; stránky modulu používají jazyk URL. Zapnete-li vlastní trasu výchozího jazyka, dostane také předponu. Jednoduchá URL má tvar `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Vlastní odkaz může zůstat bez lokalizace, například `clientarea.php`. Skrytí nadřazené položky skryje celou větev.

URL položky stránky se znovu sestaví podle aktuálního slugu a zveřejněného překladu. Chybí-li překlad, použije se zveřejněná verze ve výchozím jazyce. Vlastní odkaz může zachovat zadanou URL; externí adresy, mailto, tel a kotvy nedostávají jazykový prefix. Koncepty, smazané a nepřístupné stránky se nezobrazují.

## zm_pb_menus

Údaje jsou v tabulkách `zm_pb_menus`, `zm_pb_menu_items` a `zm_pb_menu_locations`. Tabulky vytvořte nebo opravte v části Databáze modulu. Strom umožňuje nejvýše 10 úrovní a 300 položek; při odstranění rodiče se jeho potomci posunou o úroveň výše.

## Pokyny

- Vytvořit nabídku
- Přidejte stránky, příspěvky nebo vlastní odkazy.
- Přetažením změníte pořadí položek. Vnoření nastavte výběrem nadřazené položky nebo tlačítky pro přesun.
- Použít jazyk aktuální stránky
- Použít zadanou URL beze změny
- Popisky v jiných jazycích
- Viditelné pro
- Zařízení
- Každé umístění může mít jednu nabídku. Výběrem umístění se sem přesune jeho přiřazení z jiné nabídky.
- Položky nejvyšší úrovně se stanou sloupci a vnořené položky odkazy. Pro nadpis bez odkazu použijte URL #.
- Tabulky nabídek dosud nebyly vytvořeny. Přidejte je v Databázi modulu.

