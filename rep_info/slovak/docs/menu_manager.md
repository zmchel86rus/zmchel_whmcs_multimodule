# Ponuky

Vytvorte ponuku, pridajte stránky alebo vlastné odkazy a usporiadajte položky presúvaním. Pre podponuku vyberte nadradenú položku; nastavte názvy podľa jazyka, viditeľnosť pre hostí alebo klientov a zariadenia. Priraďte umiestnenie: na každom môže byť len jedna ponuka. Pri interných odkazoch zvoľte, či sa má URL riadiť aktuálnym jazykom. Verejnú ponuku skontrolujte na počítači aj telefóne.

Pri každej položke môžete nastaviť názov, opis, triedy CSS, `rel`, ikonu a otvorenie v novej karte; zverejnené stránky možno pridávať automaticky. Pre počítač a mobil zvlášť vyberte, či ponuka dopĺňa alebo nahrádza navigáciu WHMCS. Odkaz na stránku modulu sa prepočíta podľa aktuálneho slugu, jazyka a režimu URL; prázdny štítok použije preložený názov alebo meno stránky. Návšteva stránky nemení jazyk profilu klienta. Server odmieta nebezpečné schémy URL a HTML v štítkoch.

## WHMCS

V nastaveniach modulu zapnite potrebné pozície ponuky WHMCS. Každá pozícia prijíma jednu ponuku, tú istú ponuku však možno priradiť viacerým pozíciám. Zobrazenie pre počítač platí od šírky 768 px, mobilné zobrazenie na užších obrazovkách. Vypnutá pozícia ponechá štandardnú ponuku WHMCS nezmenenú.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Na systémových trasách WHMCS bez jazykového smerovania modulu používajú štítky ponuky uložený jazyk klienta; stránky modulu používajú jazyk URL. Ak má predvolený jazyk vlastnú trasu, dostane aj predponu. Bežná URL je `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Vlastný odkaz možno nechať bez lokalizácie, napríklad `clientarea.php`. Skrytie nadradenej položky skryje celú vetvu.

URL položky stránky sa znovu zostaví podľa aktuálneho slugu a zverejneného prekladu. Ak preklad chýba, použije sa zverejnená verzia v predvolenom jazyku. Vlastný odkaz môže ponechať zadanú URL; externé adresy, mailto, tel a kotvy nedostávajú jazykový prefix. Koncepty, zmazané a neprístupné stránky sa nezobrazujú.

## zm_pb_menus

Údaje sú v tabuľkách `zm_pb_menus`, `zm_pb_menu_items` a `zm_pb_menu_locations`. Vytvorte alebo opravte ich v časti Databáza modulu. Strom umožňuje najviac 10 úrovní a 300 položiek; po odstránení rodiča sa jeho potomkovia posunú o úroveň vyššie.

## Pokyny

- Vytvorte ponuku, pridajte stránky alebo vlastné odkazy a usporiadajte položky presúvaním.
