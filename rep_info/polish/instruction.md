# Instrukcja zmchel WHMCS Multimodule

**Przed użyciem wygeneruj unikalne sole i wpisz ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT oraz ZM_PB_NONCE_SALT w module_init.php.** Moduł opracowano i przetestowano z WHMCS 8.13.1–8.13.7. Apache jest w pełni obsługiwany. Nginx może działać, lecz routing językowy strony głównej może wymagać dodatkowej konfiguracji.

**Sprawdzone wersje PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4 i 8.5.

**zmchel WHMCS Multimodule jest darmowy.** Pozwala zarządzać stronami i artykułami z panelu WHMCS. Zawiera edytor wizualny, tłumaczenia, menu, bibliotekę multimediów, pola SEO, mapy witryny XML, przekierowania i reguły przepisywania adresów.

## 1. Instalacja i dostęp

Włącz dodatek w WHMCS i przyznaj dostęp uprawnionym administratorom. Sprawdź wymagane tabele w sekcji bazy danych modułu. Przejrzyj przyjazne adresy, trasy językowe i miejsca menu. Apache korzysta z .htaccess; w Nginx równoważne reguły trzeba skonfigurować osobno.

## 2. Tworzenie stron

Otwórz listę stron i dodaj stronę. Podaj nazwę wewnętrzną i slug z liter łacińskich, cyfr oraz łączników, np. about-us. Wybierz dostęp dla wszystkich, tylko zalogowanych klientów albo tylko gości. Ustaw status i języki. Domyślny język WHMCS musi być obsługiwany przez moduł.

## 3. Edycja treści

Dla każdego języka uzupełnij zakładki Treść, Metadane i Mapa witryny. Przeciągaj bloki do edytora, zmieniaj tekst i obrazy, a następnie zapisuj każdą zakładkę. Kopiowanie z treścią daje punkt wyjścia, a kopiowanie struktury przygotowuje układ do tłumaczenia. Tekst nie tłumaczy się automatycznie.

## 4. Linki i publikacja

Dla linków do przetłumaczonych stron modułu włącz dodawanie bieżącego języka do URL. Wyłącz tę opcję dla zewnętrznych adresów, e-maili i tras WHMCS bez wersji językowej. Po publikacji sprawdź stronę jako gość i klient, na komputerze i telefonie, co najmniej w dwóch językach.

## 5. Zarządzanie i utrzymanie

Menedżer menu służy do nawigacji, a menedżer mediów do obrazów. Menedżer przekierowań tworzy reguły 301 i 302. Mapa witryny generuje pliki XML. Eksportuj ustawienia przed większymi zmianami; po zmianie reguł adresów zastosuj je ponownie i sprawdź mapę witryny.

## Szczegółowe tematy

- [Menu](docs/menus.md)
- [Stronicowanie i filtry](docs/pagination.md)
- [Przekierowania](docs/redirects.md)
- [Mapy witryny](docs/sitemaps.md)
- [Smarty i zmienne](docs/smarty.md)
- [Dane strukturalne](docs/structured-data.md)
- [Import i eksport](docs/transfer.md)
