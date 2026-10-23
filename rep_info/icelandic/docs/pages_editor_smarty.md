# Smarty

- **Stillingar einingar → Safna Smarty-breytum → Nota safnaðar Smarty-breytur → Síðaritill.**

## Breytuskrá

Virkjaðu söfnun og notkun Smarty-breyta í stillingum einingarinnar, opnaðu síðan viðeigandi síður vefsins og endurhladdu ritilinn. Skráin geymir nöfn, gerðir og byggingu breyta, en ekki raunveruleg gildi eða persónuupplýsingar. Ef breytu vantar skaltu heimsækja síðuna þar sem hún er notuð aftur.

## Ritill og takmarkanir

Opnaðu Smarty-blokkina í ritli síðunnar og veldu breytur úr skránni. Notaðu leyfð skilyrði og lykkjur; bættu `|escape` við þegar kvikur texti er birtur. PHP, SQL, aðferðaköll, innlestur skráa og `nofilter` eru ekki leyfð. Vistaðu síðuna og athugaðu opinberu birtinguna.

## resources/available_vars/

Skráin er aðeins leiðarvísir um breytur sem sáust á síðu: hún gerir þær ekki aðgengilegar á annarri síðu. Kóði er yfirfarinn við vistun og fyrir birtingu; reiturinn fær einangrað afrit leyfðra gilda. Skilyrði, `foreach`, staðbundið `assign` og breytar á borð við `escape`, `default`, `count` og `date_format` eru leyfðir. Úttaksgildi eru escape-uð sjálfkrafa; skrifaðu ætlað HTML í sniðmátið. Ef gögn vantar eða kóðinn bregst verður reiturinn tómur og villan skráð í PHP-atvikaskrá.

Skráin í `resources/available_vars/` geymir heiti, gerðir, uppbyggingu og tilbúin dæmi, ekki raunveruleg gildi. Hún sýnir hvar breyta sást en gerir hana ekki tiltæka á annarri síðu. Tvísmelltu á Smarty-blokkina til að opna ritilinn. `Ctrl+Space` leitar að breytum, `Ctrl+S` beitir kóðanum og `F11` opnar allan skjáinn. Kóðinn keyrir einangraður; vanti gögn verður blokkin tóm og viðvörun fer í PHP-atvikaskrá.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Leiðbeiningar

- **Safna Smarty-breytum** — Virkja eða óvirkja söfnun Smarty-breyta.
- **Nota safnaðar Smarty-breytur** — Virkja eða óvirkja notkun safnaðra Smarty-breyta í síðaritlinum.
- Smarty (PHP)-breyta
- Smarty: PHP, aðferðir hluta, kyrrstæð köll og nofilter eru bönnuð.
- Smarty-sniðmátið er of stórt.
- Smarty
- Smarty-ritill

