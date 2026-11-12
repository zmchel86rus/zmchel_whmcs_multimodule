# Strukturált adatok

- **Oldalszerkesztő → Metaadat-beállítások → Schema típusa → Mentés.**

## Mit jelöl a modul

A menük és a tartalomjegyzék `SiteNavigationElement`, a látható kérdések és válaszok `FAQPage`, a több elemből álló morzsaútvonal pedig `BreadcrumbList` jelölést hozhat létre. Az elrendezési blokkok, gombok és szűrők nem kapnak automatikus tartalomtípust. Az oldalhoz választott Schema-típus szabályozza a JSON-LD kimenetet; kikapcsolva ez a jelölés nem jelenik meg.

## Ellenőrzés közzététel után

A nyilvános oldalon ellenőrizze a JSON-LD-t, a kanonikus URL-t, a nyelvet és a ténylegesen látható tartalmat. A helyes jelölés nem garantál kibővített keresési találatot.

## Schema.org

A `SiteNavigationElement` a valóban látható menühivatkozásokat és címeket használja; a tartalomjegyzék a tényleges oldalcímekhez `WebPageElement` jelölést is adhat. A `FAQPage` csak a látogató számára látható, teljes kérdés-válasz párokat veszi fel: rejtett blokkok és közönséges harmonikák kimaradnak. A `BreadcrumbList` legalább két elemnél jön létre. A szervezet adatai a WHMCS-ből származnak; a kapcsolat nyelvei a `ContactPoint.availableLanguage` mezőben BCP 47 alakúak. Szűrőkhöz, lapozáshoz, űrlapokhoz és egyéni HTML-hez nem talál ki Schema-típust.
