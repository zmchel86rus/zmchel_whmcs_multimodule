# Smarty i zmienne

- **Ustawienia modułu → Zbieraj zmienne Smarty → Używaj zebranych zmiennych Smarty → Edytor stron.**

Włącz zmienne Smarty przed dodaniem bloku. Używaj tylko dozwolonych zmiennych, stosuj escape do danych dynamicznych i nie wyświetlaj danych osobowych; PHP i SQL są zabronione.

## Katalog zmiennych

Włącz zbieranie i używanie zmiennych Smarty w ustawieniach modułu, następnie otwórz odpowiednie strony witryny i odśwież edytor. Katalog przechowuje nazwy, typy i strukturę zmiennych, ale nie rzeczywiste wartości ani dane osobowe. Jeśli brakuje zmiennej, odwiedź ponownie stronę, na której jest używana.

## Edytor i ograniczenia

Otwórz blok Smarty w edytorze stron i wybierz zmienne z katalogu. Korzystaj z dozwolonych warunków i pętli; dodawaj `|escape` przy wyświetlaniu dynamicznego tekstu. PHP, SQL, wywołania metod, dołączanie plików i `nofilter` są niedozwolone. Zapisz stronę i sprawdź publiczny wynik.

## resources/available_vars/

Katalog jest tylko przewodnikiem po zmiennych zaobserwowanych na stronie: nie udostępnia ich na innej stronie. Kod jest sprawdzany przy zapisie i przed wyświetleniem; blok dostaje odizolowaną kopię dozwolonych wartości. Można używać warunków, `foreach`, lokalnego `assign` i modyfikatorów takich jak `escape`, `default`, `count`, `date_format`. Wartości wyjściowe są automatycznie escapowane; zamierzony HTML wpisz w szablonie. Jeśli danych brakuje lub kod zawiedzie, blok pozostaje pusty, a błąd trafia do dziennika PHP.

Katalog w `resources/available_vars/` przechowuje nazwy, typy, strukturę i sztuczne przykłady, lecz nie prawdziwe wartości. Pokazuje, gdzie zaobserwowano zmienną, ale nie udostępnia jej na innej stronie. Otwórz edytor podwójnym kliknięciem bloku Smarty. `Ctrl+Space` wyszukuje zmienne, `Ctrl+S` stosuje kod, a `F11` przełącza na pełny ekran. Kod działa w izolacji; przy braku danych blok pozostaje pusty, a ostrzeżenie trafia do dziennika PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instrukcje

- **Zbieraj zmienne Smarty** — Włącz lub wyłącz zbieranie zmiennych Smarty.
- **Używaj zebranych zmiennych Smarty** — Włącz lub wyłącz używanie zebranych zmiennych Smarty w edytorze stron.
- Zmienna Smarty (PHP)
- Smarty: PHP, metody obiektów, wywołania statyczne i nofilter są zabronione.
- Szablon Smarty jest zbyt duży.
- Smarty
- Edytor Smarty
