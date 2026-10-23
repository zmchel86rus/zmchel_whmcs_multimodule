# Meniu

Sukurkite meniu, pridėkite puslapių ar savų nuorodų ir surikiuokite elementus juos vilkdami. Submeniu pasirinkite tėvinį elementą, nustatykite užrašus pagal kalbą, matomumą svečiams ar klientams ir įrenginius. Priskirkite vietą: kiekvienoje vietoje gali būti tik vienas meniu. Vidinėms nuorodoms pasirinkite, ar URL turi sekti dabartinę kalbą. Patikrinkite viešą meniu kompiuteryje ir telefone.

Kiekvienam elementui galima nustatyti antraštę, aprašą, CSS klases, `rel`, piktogramą ir atvėrimą naujame skirtuke; paskelbtus puslapius galima pridėti automatiškai. Atskirai kompiuteriui ir telefonui pasirinkite, ar meniu papildo, ar pakeičia WHMCS navigaciją. Nuoroda į modulio puslapį perskaičiuojama pagal esamą slug, kalbą ir URL režimą; tuščia etiketė naudoja išverstą antraštę arba puslapio pavadinimą. Puslapio peržiūra nekeičia kliento profilio kalbos. Serveris atmeta nesaugias URL schemas ir HTML etiketėse.

## WHMCS

Modulio nustatymuose įjunkite reikalingas WHMCS meniu vietas. Vienai vietai galima priskirti vieną meniu, tačiau tą patį meniu galima naudoti keliose vietose. Kompiuterio rodinys taikomas nuo 768 px pločio, mobilusis — siauresniuose ekranuose. Išjungta vieta nekeičia įprasto WHMCS meniu.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

WHMCS sistemos maršrutuose be modulio kalbos maršrutizavimo meniu etiketės naudoja išsaugotą kliento kalbą; modulio puslapiai naudoja URL kalbą. Įjungus atskirą numatytosios kalbos maršrutą, ji taip pat gauna prefiksą. Paprastas URL yra `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Savą nuorodą galima palikti nelokalizuotą, pavyzdžiui, `clientarea.php`. Paslėpus pirminį elementą paslepiama visa jo šaka.

Puslapio elemento URL iš naujo sudaromas pagal dabartinį slug ir paskelbtą vertimą. Jei vertimo nėra, naudojama paskelbta numatytosios kalbos versija. Pasirinktinė nuoroda gali palikti įvestą URL nepakeistą; išoriniams adresams, mailto, tel ir inkarams kalbos priešdėlis nepridedamas. Juodraščiai, ištrinti ir neprieinami puslapiai nerodomi.

## zm_pb_menus

Duomenys laikomi lentelėse `zm_pb_menus`, `zm_pb_menu_items` ir `zm_pb_menu_locations`. Sukurkite arba pataisykite jas skiltyje Modulio duomenų bazė. Medis leidžia iki 10 lygių ir 300 elementų; pašalinus pirminį elementą, jo vaikai pakeliami vienu lygiu.

## Instrukcijos

- Sukurkite meniu, pridėkite puslapių ar savų nuorodų ir surikiuokite elementus juos vilkdami.
