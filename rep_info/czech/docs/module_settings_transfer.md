# Import a export

Jeden soubor JSON pro všechny nebo vybrané sekce, maximálně 32 MiB (platí také limity PHP pro nahrávání). Odpovídající stránky se aktualizují podle slugu a typu přístupu, nabídky podle názvu. Ostatní záznamy zůstanou beze změny. Při importu nabídek na nový web zahrňte také stránky. Vybrané sekce, které v souboru chybí, budou přeskočeny.

CSS/JS se exportují spolu se stránkami; obrázky a další nahrané soubory s knihovnou médií. Historie revizí, shromážděné proměnné Smarty a tajné údaje WHMCS se neexportují. Po importu znovu vygenerujte mapu webu; pravidla přepisu použijte ve Správci pravidel přepisu.

Stránky a příspěvky (překlady, obsah, SEO, nastavení mapy webu, bloky CSS/JS)

Odpovídající záznamy ve vybraných sekcích budou aktualizovány podle souboru. Pokračovat?

## JSON

Export může zahrnovat stránky a příspěvky s překlady, obsahem, SEO a CSS/JS; nabídky s hierarchií a umístěním; nastavení, přesměrování, vlastní pravidla a mediální knihovnu se soubory. Historie revizí, shromážděné proměnné Smarty, účty a tajné údaje WHMCS ani soubory šablony se neexportují. Soubor JSON je omezen na 32 MiB; platí také limity PHP `upload_max_filesize` a `post_max_size`. Při přenosu nabídek na jiný web importujte i stránky a předem vyřešte shodné názvy nabídek.

Exportovaný soubor používá formát `zmchel_whmcs_multimodule` (verze 1). Při importu se URL zdrojového webu upraví podle `SystemURL` cílového webu; externí odkazy zůstanou zachovány. Import nevytváří tabulky: připravte je předem v Databázi modulu. Před spuštěním se zobrazí potvrzení; záznamy se mění v transakci a nahrazené soubory se při chybě obnoví.

## Pokyny

- Nabídky a umístění
- Nastavení modulu, nahrazení stránek, hlavička/patička, robots.txt
- Přesměrování
- Vlastní pravidla přepisu URL
- Knihovna médií (soubory a popisy)
