# Import i eksport

Eksportuj potrzebne sekcje przed dużymi zmianami. Po imporcie sprawdź strony, menu i media, osobno zastosuj reguły przepisywania i odtwórz mapę witryny. To nie zastępuje kopii zapasowej WHMCS.

## JSON

Eksport może obejmować strony i wpisy z tłumaczeniami, treścią, SEO i CSS/JS; menu z hierarchią i pozycjami; ustawienia, przekierowania, własne reguły i bibliotekę mediów z plikami. Pomijane są historia wersji, zebrane zmienne Smarty, konta i sekrety WHMCS oraz pliki motywu. Limit pliku JSON to 32 MiB; obowiązują również limity PHP `upload_max_filesize` i `post_max_size`. Przy przenoszeniu menu do innej witryny zaimportuj także strony i wcześniej rozwiąż konflikt jednakowych nazw menu.

Plik eksportu ma format `zmchel_whmcs_multimodule` (wersja 1). Podczas importu adresy URL witryny źródłowej są dostosowywane do `SystemURL` witryny docelowej, natomiast linki zewnętrzne pozostają bez zmian. Import nie tworzy tabel: przygotuj je wcześniej w Bazie danych modułu. Przed rozpoczęciem pojawia się potwierdzenie; rekordy zmieniają się w transakcji, a zastąpione pliki są przywracane w razie błędu.

## Instrukcje

- Jeden plik JSON dla wszystkich lub wybranych sekcji, o rozmiarze do 32 MiB (obowiązują również limity przesyłania plików PHP). Pasujące strony są aktualizowane na podstawie slugu i typu dostępu, a menu na podstawie nazwy. Pozostałe rekordy pozostają bez zmian. Podczas importowania menu do nowej witryny uwzględnij również strony. Wybrane sekcje nieobecne w pliku zostaną pominięte.
- CSS/JS są eksportowane razem ze stronami, a obrazy i inne przesłane pliki — z biblioteką multimediów. Historia wersji, zebrane zmienne Smarty i poufne dane WHMCS nie są eksportowane. Po imporcie wygeneruj ponownie mapę witryny i zastosuj reguły przepisywania adresów w menedżerze reguł.
- Strony i wpisy (tłumaczenia, treść, SEO, ustawienia mapy witryny, bloki CSS/JS)
- Menu i ich lokalizacje
- Ustawienia modułu, nadpisywanie stron, nagłówek/stopka, robots.txt
- Przekierowania
- Niestandardowe reguły przepisywania adresów
- Biblioteka multimediów (pliki i opisy)
- Pasujące rekordy w wybranych sekcjach zostaną zaktualizowane na podstawie pliku. Kontynuować?
