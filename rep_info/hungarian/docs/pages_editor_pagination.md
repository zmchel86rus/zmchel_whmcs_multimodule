# Lapozás

Kattintson a listát tartalmazó blokkra. Esc — megszakítás. Az oldalszámozásnak a kiválasztott blokkon kívül kell lennie.

Smarty esetén adja meg a teljes lista változóját. Változó nélkül a tároló HTML-elemei kerülnek oldalakra osztásra; szükség esetén adja meg a sorok osztályát vagy a tr címkét. A hivatkozások megőrzik a count, sort paramétereket és a szűrőket. Több független lista is támogatott.

Az elemszámválasztó az oldalszámozáson belül és az oldal más blokkjaiba is áthúzható. Továbbra is ehhez az oldalszámozáshoz kapcsolódik.

Válasszon egy listát tartalmazó Smarty-blokkot. A keresésnek és az oldalszámozásnak ugyanahhoz a blokkhoz kell kapcsolódnia.

Adja meg a teljes lista változóját. A keresés a megadott mezők bármelyikében keres, a szűrők együttesen érvényesülnek. A feltételek az oldalak számának meghatározása előtt kerülnek alkalmazásra; az alkalmazás és a visszaállítás az első oldalra lép. Ha már van oldalszámozás, annak változóját használja a rendszer.

## Hivatkozások és listaadatok

Helyezze a lapozást a listablokkon kívülre, és válassza a blokkot célként. Smarty-listánál adja meg az összes elemet tartalmazó változót; egyébként a tároló HTML-elemei oszlanak oldalakra. Válassza a hivatkozás formáját a modulbeállítás szerint, `/page/2/` vagy `?page=2` alakban. Az útvonalas forma rewrite-szabályokat igényel. A független listák külön paramétereket használnak; a linkek megtartják a nyelvet, a szűrőket és a rendezést.

## Oldalméret, SEO és szűrők

Adja meg az elemszámot, és szükség esetén kapcsolja be a 10/25/50/100/250 választót. A méret módosítása visszavisz az első oldalra. A noindex csak a második oldaltól érvényes; ellenőrizze a címet és a kanonikus URL-t. Kapcsolja a szűrőket ugyanahhoz a listához, majd próbálja ki a második oldalt és egy szűrt eredményt a nyilvános oldalon.

## page / count / pager

Smarty-listánál adja meg az összes elemet tartalmazó változót, és tartsa meg a `{foreach}` ciklust: a listát a modul szeleteli, ne adjon hozzá még egy `array_slice`-ot. Változó nélkül a tároló HTML-elemei lapozódnak; megadható sorkategória vagy `tr` elem, a `thead` és `tfoot` érintetlen marad. Az aktuális oldal körüli gombok számát asztali és mobil nézethez külön állítsa be. Közvetlen PHP-útvonalon `?page=2` kell; a `/page/2/` rewrite-szabályokat igényel. A további oldalak saját canonical címet kapnak, és `noindex` állítható be.

Több független listánál az első a `page`, `count` és `sort` paramétert használja, a többi a blokkazonosítóval bővített paramétereket. A `/page/N/` útvonalnál a `pager` jelzi, melyik listához tartozik a szám. A Smarty-blokkban a `$zm_pagination` értékei: `total`, `page`, `pages`, `count`, `offset`. A `count` 10–250 közé korlátozott. Üres vagy egylapos listánál a lapozó rejtve marad.

## YYYY-MM-DD

A szűrők ugyanarra a listára hatnak, mint a lapozás. A szöveges keresés több, vesszővel elválasztott mezőt vizsgálhat; a dátumtartomány `YYYY-MM-DD` alakú, és az utolsó nap egészét magában foglalja.

## Flex / Grid

Válasszon Flex vagy Grid elrendezést, az eszközökhöz külön szélességet és oszlopokat. Szűrő alkalmazása vagy törlése az első oldalra visz. Az elemszám-választó a kapcsolat elvesztése nélkül mozgatható; a másolt panel ugyanazt a listát vezérli.

## Útmutató

- Elemszám kiválasztása: 10, 25, 50, 100, 250
- A 2. és további oldalak indexelésének tiltása
- Hivatkozások formátuma
- Elemek alapértelmezett száma
