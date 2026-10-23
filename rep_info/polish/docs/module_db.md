# Baza danych modułu

- **Baza danych modułu:** `MISSING` → Wybierz → Napraw Wybrane elementy.
- **Usuń Wybrane elementy** — Tej operacji nie można cofnąć.

Strona **Baza danych modułu** pokazuje wymagane tabele i kolumny oraz ich stan. Dostęp ma tylko wyznaczony superadministrator. Otwórz ją, gdy inna sekcja zgłasza brak tabeli lub kolumny. Przejrzyj listę, zaznacz wyłącznie elementy do naprawy i kliknij **Napraw zaznaczone**. Niektórych kolumn nie można naprawić automatycznie; po operacji sprawdź stan ponownie.

**Usuń zaznaczone** trwale usuwa wybrane obiekty bazy danych. Przed usunięciem wyeksportuj dane modułu i wykonaj kopię zapasową bazy.

## Instrukcje

- Odmowa dostępu. Ze strony Baza danych modułu może korzystać wyłącznie Super Administrator (ID …).
- Napraw
- Wybrane elementy
- Usuń
- Tej operacji nie można cofnąć.
- Tabele menu nie zostały jeszcze utworzone. Dodaj je w sekcji Baza danych modułu.
- Najpierw dodaj kolumnę optimization_attempted w menedżerze tabel modułu.

## 1. Instalacja i dostęp

Włącz dodatek w WHMCS i przyznaj dostęp uprawnionym administratorom. Sprawdź wymagane tabele w sekcji bazy danych modułu. Przejrzyj przyjazne adresy, trasy językowe i miejsca menu. Apache korzysta z .htaccess; w Nginx równoważne reguły trzeba skonfigurować osobno.
