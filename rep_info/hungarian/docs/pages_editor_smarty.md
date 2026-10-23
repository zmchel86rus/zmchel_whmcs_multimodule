# Smarty

- **Modulbeállítások → Smarty-változók gyűjtése → Összegyűjtött Smarty-változók használata → Oldalszerkesztő.**

## Változókatalógus

Engedélyezze a Smarty-változók gyűjtését és használatát a modul beállításaiban, majd nyissa meg a webhely érintett oldalait, és frissítse a szerkesztőt. A katalógus a változók nevét, típusát és szerkezetét tárolja, tényleges értékeket és személyes adatokat nem. Ha hiányzik egy változó, látogassa meg újra azt az oldalt, ahol szerepel.

## Szerkesztő és korlátok

Nyissa meg a Smarty-blokkot az oldalszerkesztőben, és válasszon változókat a katalógusból. Használja az engedélyezett feltételeket és ciklusokat; dinamikus szöveg megjelenítéséhez adjon hozzá `|escape` módosítót. PHP, SQL, metódushívások, fájlbeillesztés és `nofilter` nem engedélyezett. Mentés után ellenőrizze a nyilvános oldalt.

## resources/available_vars/

A katalógus csak az adott oldalon megfigyelt változók útmutatója: másik oldalon nem teszi őket elérhetővé. A kód mentéskor és megjelenítés előtt ellenőrzést kap; a blokk az engedélyezett értékek elkülönített másolatát kapja. Feltételek, `foreach`, helyi `assign` és például `escape`, `default`, `count`, `date_format` módosítók használhatók. A kimeneti értékek automatikusan escape-elődnek; a kívánt HTML-t írja a sablonba. Hiányzó adat vagy hibás kód esetén a blokk üres marad, a hiba a PHP naplóba kerül.

A `resources/available_vars/` katalógus neveket, típusokat, szerkezetet és mesterséges példákat tárol, valódi értékeket nem. Jelzi, hol figyelt meg egy változót, de ettől az más oldalon nem válik elérhetővé. A Smarty-blokkra duplán kattintva nyissa meg a szerkesztőt. `Ctrl+Space` változót keres, `Ctrl+S` alkalmazza a kódot, `F11` teljes képernyőre vált. A kód elkülönítve fut; hiányzó adatoknál a blokk üres, a figyelmeztetés a PHP naplóba kerül.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Útmutató

- **Smarty-változók gyűjtése** — A Smarty-változók gyűjtésének be- vagy kikapcsolása.
- **Összegyűjtött Smarty-változók használata** — Az összegyűjtött Smarty-változók használatának be- vagy kikapcsolása az oldalszerkesztőben.
- Smarty (PHP) változó
- Smarty: a PHP, az objektummetódusok, a statikus hívások és a nofilter használata tiltott.
- A Smarty-sablon túl nagy.
- Smarty
- Smarty-szerkesztő

