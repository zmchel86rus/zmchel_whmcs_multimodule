# Edytor stron

- [Stronicowanie i filtry](pages_editor_pagination.md)
- [Smarty i zmienne](pages_editor_smarty.md)
- [Dane strukturalne](module_structured_data.md)

## 3. Edycja treści

Dla każdego języka uzupełnij zakładki Treść, Metadane i Mapa witryny. Przeciągaj bloki do edytora, zmieniaj tekst i obrazy, a następnie zapisuj każdą zakładkę. Kopiowanie z treścią daje punkt wyjścia, a kopiowanie struktury przygotowuje układ do tłumaczenia. Tekst nie tłumaczy się automatycznie.

## 4. Linki i publikacja

Dla linków do przetłumaczonych stron modułu włącz dodawanie bieżącego języka do URL. Wyłącz tę opcję dla zewnętrznych adresów, e-maili i tras WHMCS bez wersji językowej. Po publikacji sprawdź stronę jako gość i klient, na komputerze i telefonie, co najmniej w dwóch językach.

## SEO

W ustawieniach podstawowych sprawdź nazwę, slug, typ, stan, dostęp i języki. Domyślny język WHMCS musi być włączony w module; opublikowana strona potrzebuje treści w języku wyświetlania. Dla każdego języka wpisz tytuł i opis, a następnie sprawdź canonical, robots, Open Graph, okruszki nawigacyjne i Schema. Na karcie mapy witryny wybierz częstotliwość i priorytet publicznej strony niesystemowej. Zapisz i sprawdź publiczny URL oraz XML.

## Formularz kontaktowy

Dodaj blok **Formularz kontaktowy**. Wybierz **zgłoszenie WHMCS** i dział pomocy albo **e-mail** i odbiorcę; uzupełnij nagłówek, opis, temat i tekst przycisku. Dla każdego pola ustaw nazwę, typ, wymagalność i walidację. Zgłoszenie od gościa wymaga pól z rolami imienia i e-maila nadawcy. Opcje listy rozwijanej wpisuj po jednej w wierszu, np. `sales : Sprzedaż`. Utwórz oddzielne pole dla każdej zgody i użyj CAPTCHA ustawionej w WHMCS. Zapisz i wyślij prawdziwą próbę jako gość; sprawdź zgłoszenie lub doręczenie, błędy i wyczyszczenie formularza. Zielony stan edytora nie potwierdza doręczenia; jeśli `mail()` zawodzi, ustaw SMTP w WHMCS.

## Instrukcje

- Zagnieżdżony kontener układu Flex. Przeciągnij inne bloki do środka.
- Zagnieżdżony kontener układu CSS Grid. Przeciągnij inne bloki do środka.
- Zagnieżdżona karuzela Bootstrap. Przeciągnij bloki do środka; każdy z nich stanie się slajdem.
- Wszystkie bloki poniżej tego bloku są wyświetlane tylko zalogowanym użytkownikom. Działa tylko wtedy, gdy typ dostępu do strony to Mieszany.
- Wszystkie bloki poniżej tego bloku są wyświetlane tylko gościom. Działa tylko wtedy, gdy typ dostępu do strony to Mieszany.
- **Tytuł strony**
- **Opis meta**
- **Kanoniczny adres URL**
- **Robots** — index, follow / noindex, nofollow. Określa indeksowanie.
- **Typ schematu** — Po wyłączeniu znaczniki JSON Schema.org nie są generowane dla tej strony.
