# Smarty

- **Socruithe an mhodúil → Bailigh athróga Smarty → Úsáid athróga Smarty a bailíodh → Eagarthóir Leathanach.**

## Catalóg na n-athróg

Cumasaigh bailiú agus úsáid athróg Smarty i socruithe an mhodúil, ansin oscail leathanaigh ábhartha an tsuímh agus athlódáil an t-eagarthóir. Coinníonn an catalóg ainmneacha, cineálacha agus struchtúr na n-athróg, ach ní choinníonn sí fíorluachanna ná sonraí pearsanta. Má tá athróg ar iarraidh, tabhair cuairt arís ar an leathanach a úsáideann í.

## Eagarthóir agus teorainneacha

Oscail an bloc Smarty san eagarthóir leathanaigh agus roghnaigh athróga ón gcatalóg. Úsáid coinníollacha agus lúba ceadaithe; cuir `|escape` leis nuair a thaispeánann tú téacs dinimiciúil. Ní cheadaítear PHP, SQL, glaonna modhanna, comhaid a áireamh ná `nofilter`. Sábháil an leathanach agus seiceáil an toradh poiblí.

## resources/available_vars/

Níl sa chatalóg ach treoir do na hathróga a chonacthas ar leathanach: ní chuireann sé ar fáil iad ar leathanach eile. Seiceáiltear an cód agus é á shábháil agus roimh aschur; faigheann an bloc cóip ar leith de na luachanna ceadaithe. Ceadaítear coinníollacha, `foreach`, `assign` áitiúil agus modhnóirí amhail `escape`, `default`, `count` agus `date_format`. Déantar luachanna aschuir a escape-áil go huathoibríoch; scríobh an HTML atá uait sa teimpléad. Má bhíonn sonraí ar iarraidh nó má theipeann ar an gcód, fanann an bloc folamh agus scríobhtar an earráid i log PHP.

Coinníonn an catalóg i `resources/available_vars/` ainmneacha, cineálacha, struchtúr agus samplaí saorga, ach ní choinníonn sé fíorluachanna. Léiríonn sé cá bhfacthas athróg gan í a chur ar fáil ar leathanach eile. Cliceáil faoi dhó ar bhloc Smarty chun an t-eagarthóir a oscailt. Aimsíonn `Ctrl+Space` athróga, cuireann `Ctrl+S` an cód i bhfeidhm agus osclaíonn `F11` lánscáileán. Ritheann an cód ar leithligh; mura bhfuil sonraí ann, fágfar an bloc folamh agus scríobhtar rabhadh sa loga PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Treoracha

- **Bailigh athróga Smarty** — Cumasaigh nó díchumasaigh bailiú athróg Smarty.
- **Úsáid athróga Smarty a bailíodh** — Cumasaigh nó díchumasaigh úsáid athróg Smarty a bailíodh san eagarthóir leathanach.
- Athróg Smarty (PHP)
- Smarty: tá cosc ar PHP, modhanna oibiachtaí, glaonna statacha agus nofilter.
- Tá an teimpléad Smarty rómhór.
- Smarty
- Eagarthóir Smarty

