# Przekierowania

Podaj stary i nowy URL. Użyj 301 do trwałych zmian, a 302 do tymczasowych; sprawdź adres źródłowy i unikaj przekierowania do niego samego.

## HTTP

Reguły obsługują kody HTTP `301`, `302`, `303`, `307`, `308` i dotyczą tylko żądań `GET`/`HEAD`, które docierają do WHMCS. Źródło jest dopasowywane dokładnie według ścieżki i podanych parametrów zapytania; parametry celu zastępują stare. Menedżer zapisuje reguły w `zm_pb_redirects`, lecz nie tworzy tabeli podczas żądania: użyj **Bazy danych modułu**. Istniejące kolumny URL mają limit 128 bajtów.

Reguły ręczne mają pierwszeństwo przed automatycznymi. Zmiana slugu opublikowanej strony może po ustawionym czasie utworzyć automatyczne przekierowanie `301` dla każdego aktywnego języka; publikacja szkicu tego nie robi. Późniejsze zmiany nazwy aktualizują stare cele. Reguła z parametrami zapytania ma pierwszeństwo przed regułą dotyczącą samej ścieżki. Źródłowy URL musi należeć do tej witryny i nie może zawierać fragmentu `#`.
