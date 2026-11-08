# Import i eksport

Eksportuj potrzebne sekcje przed dużymi zmianami. Po imporcie sprawdź strony, menu i media, osobno zastosuj reguły przepisywania i odtwórz mapę witryny. To nie zastępuje kopii zapasowej WHMCS. Podczas importu obsługiwane są również pliki JSON.

## ZIP

Eksport może obejmować strony i wpisy z tłumaczeniami, treścią, SEO i CSS/JS; menu z hierarchią i pozycjami; ustawienia, przekierowania, własne reguły i bibliotekę mediów z plikami. Pomijane są historia wersji, zebrane zmienne Smarty, konta i sekrety WHMCS oraz pliki motywu. Limit pliku ZIP to 128 MiB; obowiązują również limity PHP `upload_max_filesize` i `post_max_size`. Przy przenoszeniu menu do innej witryny zaimportuj także strony i wcześniej rozwiąż konflikt jednakowych nazw menu.

Plik eksportu ma format `zmchel_whmcs_multimodule` (wersja 2). Podczas importu adresy URL witryny źródłowej są dostosowywane do `SystemURL` witryny docelowej, natomiast linki zewnętrzne pozostają bez zmian. Import nie tworzy tabel: przygotuj je wcześniej w Bazie danych modułu. Przed rozpoczęciem pojawia się potwierdzenie; rekordy zmieniają się w transakcji, a zastąpione pliki są przywracane w razie błędu.
