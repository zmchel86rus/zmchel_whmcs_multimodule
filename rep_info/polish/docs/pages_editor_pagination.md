# Stronicowanie i filtry

Połącz stronicowanie i filtry z tą samą listą. Wybierz liczbę wyników oraz format URL; sprawdź drugą stronę i działanie filtra.

## Linki i źródło listy

Umieść paginację poza blokiem listy i wybierz ten blok jako cel. Dla listy Smarty wskaż zmienną zawierającą wszystkie elementy; w przeciwnym razie dzielone są elementy HTML kontenera. Wybierz format linków zgodny z ustawieniem modułu, `/page/2/` lub `?page=2`. Ścieżka wymaga reguł rewrite. Niezależne listy używają osobnych parametrów; linki zachowują język, filtry i sortowanie.

## Rozmiar strony, SEO i filtry

Ustaw liczbę elementów i w razie potrzeby włącz wybór 10/25/50/100/250. Zmiana rozmiaru przenosi listę na pierwszą stronę. Noindex działa dopiero od drugiej strony; sprawdź tytuł i kanoniczny URL. Połącz filtry z tą samą listą, a następnie przetestuj drugą stronę i filtrowany wynik w publicznej witrynie.

## page / count / pager

Dla listy Smarty podaj zmienną zawierającą wszystkie elementy i pozostaw pętlę `{foreach}`: moduł dzieli listę sam, więc nie dodawaj drugiego `array_slice`. Bez zmiennej dzielone są elementy HTML kontenera; można wskazać klasę wiersza lub znacznik `tr`, a `thead` i `tfoot` pozostają. Liczbę przycisków wokół bieżącej strony ustaw osobno dla komputera i telefonu. Na bezpośrednich trasach PHP użyj `?page=2`; `/page/2/` wymaga reguł rewrite. Kolejne strony mają własny canonical i mogą dostać `noindex`.

Przy kilku niezależnych listach pierwsza używa `page`, `count` i `sort`, a pozostałe parametrów z identyfikatorem bloku. Dla ścieżki `/page/N/` parametr `pager` wskazuje listę, do której należy numer. W bloku Smarty `$zm_pagination` udostępnia `total`, `page`, `pages`, `count` i `offset`. `count` jest ograniczany do 10–250. Gdy lista jest pusta lub mieści się na jednej stronie, panel paginacji jest ukrywany.

## YYYY-MM-DD

Filtry działają na tej samej liście co paginacja. Wyszukiwanie tekstowe może sprawdzać kilka pól oddzielonych przecinkami; zakres dat używa `YYYY-MM-DD` i obejmuje cały ostatni dzień.

## Flex / Grid

Wybierz Flex lub Grid oraz dostosuj szerokości i kolumny do urządzeń. Zastosowanie lub wyczyszczenie filtra wraca do pierwszej strony. Selektor liczby wyników można przesuwać bez utraty powiązania; zduplikowany panel steruje tą samą listą.
