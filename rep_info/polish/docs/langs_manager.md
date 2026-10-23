# Menedżer języków

- **Sekcje → Języki → Tłumaczenia.** Każdy przycisk Zapisz zapisuje tylko jedno tłumaczenie.

Menedżer języków umożliwia edycję tekstów językowych WHMCS i modułów z poziomu panelu administracyjnego. Funkcja jest nadal rozwijana. Dostęp ma superadministrator modułu, a PHP musi mieć prawo zapisu w odpowiednich katalogach językowych.

## Wybór sekcji i języka

Najpierw włącz potrzebne języki w **Ustawienia modułu → Obsługiwane języki**. Następnie w **Menedżer języków → Sekcje** wybierz języki części klienta lub panelu administracyjnego WHMCS, tego modułu albo innego wykrytego modułu. Tabela pokazuje języki istniejące, wyłączone i możliwe do dodania. Na karcie **Języki** wybierz plik lub dodaj brakujący język. Nowy plik początkowo korzysta z tekstów języka odniesienia; nie jest jeszcze gotowym tłumaczeniem. Oznaczenie „nieprzetłumaczone” wskazuje brak własnych tłumaczeń.

## Edycja tłumaczeń

Na karcie **Tłumaczenia** kolumna **Oryginał** pokazuje tekst z pierwotnego pliku wybranego języka, bez Twoich zmian. Jeżeli język nie ma własnych tekstów, kolumna nosi nazwę **Odniesienie**. Szukaj według klucza lub tekstu, filtruj wszystkie, oryginalne lub dodane klucze i zapisuj każdy wiersz osobno. Możesz dodać własny klucz w wybranej sekcji, a później zmienić jego nazwę lub go usunąć. Niektóre katalogi innych modułów są tylko do odczytu, jeśli ich formatu nie da się bezpiecznie zapisać.

## JSON

**Eksport JSON** pobiera klucze i tłumaczenia wybranej sekcji i języka. **Import JSON** aktualizuje tylko istniejące klucze. Nieznane i powtórzone klucze są pomijane oraz wymieniane w wyniku. Nie zmieniaj identyfikatorów sekcji i języka ani ścieżek kluczy. Limit pliku wynosi 8 MiB.

## Pliki i język domyślny

Plik językowy można wyłączyć i ponownie włączyć; pozostaje edytowalny także po wyłączeniu. Bazowy plik angielski i obecny język domyślny WHMCS są chronione. Dla języków klienta i administracji WHMCS dodanych przez menedżer przechowywane są kopie pozwalające odtworzyć je po aktualizacji. Jeśli w **Sekcje** pojawi się poprawka nazwy pliku, sprawdź nową nazwę i kliknij **Popraw**; poprawka obejmuje wykryte sekcje.

Aby zmienić język domyślny, najpierw włącz nowy język w ustawieniach modułu, następnie zmień domyślny język w WHMCS i dopiero potem wyłącz stary. Sprawdź teksty w panelu administracyjnym i części klienta.

## Instrukcje

- Sekcje
- Języki
- Tłumaczenia
- Ten język jest wyłączony, ale nadal można edytować jego tłumaczenia.
- Język odniesienia
- Każdy przycisk Zapisz zapisuje tylko jedno tłumaczenie.
- Nieprzetłumaczone
- Pokaż oryginalne
- Pokaż dodane
- Nie zaimportowano następujących kluczy tłumaczeń:
- nieznany klucz
- zduplikowany klucz
