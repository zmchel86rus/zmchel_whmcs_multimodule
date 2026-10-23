# Síðuskipting

Smelltu á listaeininguna. Esc hættir við. Síðuskiptingin verður að vera utan völdu einingarinnar.

Fyrir Smarty skaltu slá inn breytuna fyrir allan listann. Ef engin breyta er tilgreind er HTML-atriðum í ílátinu skipt á síður; þú getur valfrjálst tilgreint klasa fyrir raðir eða tr-tag. Tenglar varðveita count, sort og síur. Hægt er að nota marga óháða lista.

Val á fjölda á síðu: 10, 25, 50, 100, 250

Dragðu valið fyrir fjölda atriða á síðu inn í síðuskiptinguna eða aðra reiti á síðunni. Valið helst tengt þessari síðuskiptingu.

Veldu Smarty-listaeininguna. Leitin og síðuskiptingin verða að vísa í sömu einingu.

Tilgreindu breytuna fyrir allan listann. Leitin finnur samsvörun í hvaða völdu sviði sem er; síur eru notaðar saman. Skilyrðin gilda áður en síður eru taldar; þegar síur eru notaðar eða endurstilltar er farið á fyrstu síðu. Ef síðuskipting er þegar tengd fæst breytan þaðan.

## Tenglar og uppruni lista

Settu blaðsíðuskiptinguna utan listablokkarinnar og veldu blokkina sem markmið. Fyrir Smarty-lista tilgreinirðu breytuna sem inniheldur öll atriði; annars er HTML-einingum í gámnum skipt niður. Veldu tenglasnið samkvæmt stillingu einingarinnar, `/page/2/` eða `?page=2`. Slóðarsniðið krefst rewrite-reglna. Óháðir listar nota aðskildar færibreytur; tenglar varðveita tungumál, síur og röðun.

## Síðustærð, SEO og síur

Stilltu fjölda atriða og virkjaðu valið 10/25/50/100/250 ef þarf. Breytt stærð flytur listann aftur á fyrstu síðu. Noindex gildir aðeins frá síðu tvö; athugaðu titil og kanóníska vefslóð. Tengdu síur við sama lista og prófaðu aðra síðu og síaða niðurstöðu á opinberu síðunni.

## page / count / pager

Fyrir Smarty-lista skaltu tilgreina breytuna sem inniheldur öll atriði og halda `{foreach}`-lykkjunni: einingin skiptir listanum, svo ekki bæta við öðru `array_slice`. Án breytu er HTML-atriðum í ílátinu skipt niður; hægt er að velja línuklasa eða `tr`-merki, en `thead` og `tfoot` haldast óbreytt. Stilltu fjölda hnappa í kringum núverandi síðu sérstaklega fyrir tölvu og síma. Notaðu `?page=2` á beinum PHP-leiðum; `/page/2/` krefst rewrite-reglna. Seinni síður hafa eigið canonical og geta fengið `noindex`.

Ef fleiri en einn sjálfstæður listi er á síðu notar sá fyrsti `page`, `count` og `sort`; hinir nota breytur með auðkenni blokkar. Með slóðinni `/page/N/` segir `pager` hvaða lista númerið tilheyrir. Í Smarty-blokk gefur `$zm_pagination` gildin `total`, `page`, `pages`, `count` og `offset`. `count` er takmarkað við 10–250. Sé listinn tómur eða aðeins ein síða er síðuskiptingin falin.

## YYYY-MM-DD

Síur vinna með sama lista og síðuskiptingin. Textaleit getur skoðað nokkra reiti sem eru aðskildir með kommum; dagsetningabil notar `YYYY-MM-DD` og nær yfir allan síðasta daginn.

## Flex / Grid

Veldu Flex eða Grid og stilltu breiddir og dálka fyrir mismunandi tæki. Þegar síu er beitt eða hún hreinsuð fer listinn aftur á fyrstu síðu. Fjöldaval má færa án þess að tengingin rofni; afritað stjórnborð stýrir sama lista.

## Leiðbeiningar

- Setja noindex á síðu 2 og síðari síður
- Snið tengla
- Sjálfgefinn fjöldi atriða á síðu
