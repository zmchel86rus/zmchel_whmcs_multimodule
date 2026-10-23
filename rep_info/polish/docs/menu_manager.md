# Menu

Utwórz menu, dodaj strony lub własne odnośniki i uporządkuj elementy przeciąganiem. Wybierz element nadrzędny dla podmenu, ustaw etykiety według języka, widoczność dla gości lub klientów oraz urządzenia. Przypisz lokalizację; w każdej może działać tylko jedno menu. Dla linków wewnętrznych wybierz, czy adres URL ma podążać za bieżącym językiem. Sprawdź publiczne menu na komputerze i telefonie.

Każdej pozycji można nadać tytuł, opis, klasy CSS, `rel`, ikonę i otwieranie w nowej karcie; opublikowane strony można też dodawać automatycznie. Oddzielnie dla komputera i telefonu wybierz, czy menu uzupełnia, czy zastępuje nawigację WHMCS. Link do strony modułu jest przeliczany według bieżącego slugu, języka i trybu URL; pusta etykieta używa przetłumaczonego tytułu lub nazwy strony. Wejście na stronę nie zmienia języka profilu klienta. Serwer odrzuca niebezpieczne schematy URL i HTML w etykietach.

## WHMCS

W ustawieniach modułu włącz potrzebne pozycje menu WHMCS. Każdej pozycji można przypisać jedno menu, ale to samo menu może działać w kilku pozycjach. Widok komputerowy obowiązuje od szerokości 768 px, a na węższych ekranach używany jest widok mobilny. Wyłączona pozycja nie zmienia standardowego menu WHMCS.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Na trasach systemowych WHMCS bez kierowania językowego modułu etykiety menu używają zapisanego języka klienta; strony modułu używają języka z URL. Jeśli język domyślny ma własną trasę, również otrzymuje prefiks. Zwykły URL ma postać `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Własny link można pozostawić bez lokalizacji, na przykład `clientarea.php`. Ukrycie elementu nadrzędnego ukrywa całą gałąź.

Adres URL elementu strony jest wyliczany ponownie z aktualnego slugu i opublikowanego tłumaczenia. Gdy tłumaczenia nie ma, używana jest opublikowana wersja w języku domyślnym. Własny link może zachować wpisany URL; adresy zewnętrzne, mailto, tel i kotwice nie otrzymują prefiksu języka. Szkice, strony usunięte i niedostępne nie są wyświetlane.

## zm_pb_menus

Dane są przechowywane w tabelach `zm_pb_menus`, `zm_pb_menu_items` i `zm_pb_menu_locations`. Utwórz lub napraw je w sekcji Baza danych modułu. Drzewo obsługuje maksymalnie 10 poziomów i 300 elementów; po usunięciu rodzica jego dzieci przesuwają się o poziom wyżej.

## Instrukcje

- Utwórz menu, dodaj strony lub własne odnośniki i uporządkuj elementy przeciąganiem.
