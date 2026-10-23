# Przekierowania

Podaj stary i nowy URL. Użyj 301 do trwałych zmian, a 302 do tymczasowych; sprawdź adres źródłowy i unikaj przekierowania do niego samego.

## HTTP

Reguły obsługują kody HTTP `301`, `302`, `303`, `307`, `308` i dotyczą tylko żądań `GET`/`HEAD`, które docierają do WHMCS. Źródło jest dopasowywane dokładnie według ścieżki i podanych parametrów zapytania; parametry celu zastępują stare. Menedżer zapisuje reguły w `zm_pb_redirects`, lecz nie tworzy tabeli podczas żądania: użyj **Bazy danych modułu**. Istniejące kolumny URL mają limit 128 bajtów.

Reguły ręczne mają pierwszeństwo przed automatycznymi. Zmiana slugu opublikowanej strony może po ustawionym czasie utworzyć automatyczne przekierowanie `301` dla każdego aktywnego języka; publikacja szkicu tego nie robi. Późniejsze zmiany nazwy aktualizują stare cele. Reguła z parametrami zapytania ma pierwszeństwo przed regułą dotyczącą samej ścieżki. Źródłowy URL musi należeć do tej witryny i nie może zawierać fragmentu `#`.

## Instrukcje

- Dokładne adresy: źródło → cel. Źródłem jest ścieżka od katalogu głównego witryny lub adres URL w tej witrynie. Celem jest ścieżka albo pełny adres URL HTTP(S). Reguła bez parametrów zapytania pasuje również do żądań zawierających takie parametry; adres docelowy jest używany bez zmian. Reguły dotyczą żądań GET/HEAD docierających do WHMCS.
- Źródło
- Cel
- Włączone
- Wyłączone
- Domyślnie: 14 dni. Liczone od ostatniej zmiany opublikowanej strony lub jej aktywnych tłumaczeń; jeśli nie było zmian — od utworzenia. Ustaw 0, aby wyłączyć opóźnienie. Reguły automatyczne używają HTTP 301.
- Adresy stron zastępujących automatycznie przekierowują do zastępowanych przez nie stron systemowych. Jeśli strona zastępuje kilka adresów, używany jest pierwszy skonfigurowany. Te przekierowania działają zawsze, gdy włączone jest zastępowanie stron, niezależnie od reguł menedżera przekierowań.
- Wprowadź prawidłową ścieżkę zaczynającą się od / lub pełny adres URL HTTP(S). Adres źródłowy musi należeć do tej witryny; fragmenty # nie są obsługiwane.
