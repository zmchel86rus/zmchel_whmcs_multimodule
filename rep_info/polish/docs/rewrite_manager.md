# Reguły przepisywania adresów

## .htaccess

Otwórz menedżer i porównaj reguły z głównym plikiem `.htaccess` witryny. Dla własnej reguły zapisz wzorzec URL, cel i flagi, a następnie kliknij **Dodaj lub zaktualizuj reguły**, aby blok trafił przed reguły WHMCS. Ponownie sprawdź stan i otwórz opublikowaną stronę w języku domyślnym oraz innym języku. Zbyt szeroki wzorzec może objąć inne strony. W układzie Nginx → Apache reguły działają tylko dla żądań przekazanych do Apache.

## 1. Instalacja i dostęp

Włącz dodatek w WHMCS i przyznaj dostęp uprawnionym administratorom. Sprawdź wymagane tabele w sekcji bazy danych modułu. Przejrzyj przyjazne adresy, trasy językowe i miejsca menu. Apache korzysta z .htaccess; w Nginx równoważne reguły trzeba skonfigurować osobno.
