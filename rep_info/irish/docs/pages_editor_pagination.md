# Uimhriú leathanach

Cliceáil ar an mbloc liosta. Brúigh Esc chun cealú. Cuir an t-uimhriú leathanach lasmuigh den spriocbhloc.

I gcás Smarty, cuir isteach athróg an liosta iomláin. Gan athróg, roinntear míreanna HTML an choimeádáin ina leathanaigh; is féidir aicme ró nó clib tr a shonrú. Coinníonn na naisc na paraiméadair count, sort agus na scagairí. Tacaítear le roinnt liostaí neamhspleácha.

Roghnóir líon míreanna in aghaidh an leathanaigh: 10, 25, 50, 100, 250

Tarraing an roghnóir méid leathanaigh isteach san uimhriú leathanach nó i mbloic eile ar an leathanach. Fanfaidh sé nasctha leis an uimhriú leathanach seo.

Ná hinnéacsaigh leathanach 2 ná na leathanaigh ina dhiaidh

Roghnaigh an bloc liosta Smarty. Caithfidh an cuardach agus an t-uimhriú leathanach díriú ar an mbloc céanna.

Socraigh athróg an liosta iomláin. Meaitseálann an cuardach aon réimse roghnaithe; cuirtear na scagairí le chéile. Cuirtear na coinníollacha i bhfeidhm sula gcomhairtear leathanaigh; filleann cur i bhfeidhm nó athshocrú ar an gcéad leathanach. Úsáidtear an athróg ón uimhriú leathanach atá nasctha cheana, más ann dó.

## Naisc agus foinse an liosta

Cuir an leathanú lasmuigh de bhloc an liosta agus roghnaigh an bloc mar sprioc. Do liosta Smarty, sonraigh an athróg ina bhfuil gach mír; murach sin roinntear eilimintí HTML an choimeádáin. Roghnaigh formáid na nasc de réir shocrú an mhodúil, `/page/2/` nó `?page=2`. Teastaíonn rialacha rewrite ón bhformáid chosáin. Úsáideann liostaí neamhspleácha paraiméadair ar leith; coimeádann na naisc teanga, scagairí agus sórtáil.

## Méid an leathanaigh, SEO agus scagairí

Socraigh líon na míreanna agus cumasaigh an roghnóir 10/25/50/100/250 más gá. Filleann athrú méide an liosta ar an gcéad leathanach. Ní bhaineann noindex ach leis an dara leathanach agus na cinn ina dhiaidh; seiceáil teideal agus URL canónach. Ceangail na scagairí leis an liosta céanna, ansin tástáil an dara leathanach agus toradh scagtha ar an suíomh poiblí.

## page / count / pager

I gcás liosta Smarty, sonraigh an athróg ina bhfuil gach mír agus coinnigh an lúb `{foreach}`: roinneann an modúl an liosta, mar sin ná cuir an dara `array_slice` leis. Gan athróg, roinntear eilimintí HTML an choimeádáin; is féidir aicme ró nó clib `tr` a roghnú, agus coinnítear `thead` agus `tfoot`. Socraigh líon na gcnaipí timpeall an leathanaigh reatha ar leithligh don ríomhaire agus don fhón. Bain úsáid as `?page=2` ar bhealaí díreacha PHP; teastaíonn rialacha rewrite ó `/page/2/`. Tá canonical dá gcuid féin ag leathanaigh ina dhiaidh agus is féidir `noindex` a chur orthu.

Má bhíonn roinnt liostaí neamhspleácha ann, úsáideann an chéad cheann `page`, `count` agus `sort`; úsáideann na cinn eile paraiméadair le haitheantas an bhloic. Le cosán `/page/N/`, léiríonn `pager` cén liosta lena mbaineann an uimhir. I mbloc Smarty, tugann `$zm_pagination` `total`, `page`, `pages`, `count` agus `offset`. Teorannaítear `count` go 10–250. Má tá liosta folamh nó aon leathanach amháin ann, folaítear an painéal leathanachaithe.

## YYYY-MM-DD

Oibríonn na scagairí ar an liosta céanna leis an leathanachú. Féadann cuardach téacs roinnt réimsí scartha le camóga a sheiceáil; úsáideann raon dátaí `YYYY-MM-DD` agus áirítear an lá deireanach ina iomláine.

## Flex / Grid

Roghnaigh Flex nó Grid agus socraigh leithead agus colúin do ghléasanna. Filleann cur i bhfeidhm nó glanadh scagaire ar an gcéad leathanach. Is féidir roghnóir an líon torthaí a bhogadh gan an nasc a chailleadh; rialaíonn painéal dúblach an liosta céanna.

## Treoracha

- Formáid na nasc
- Líon réamhshocraithe míreanna in aghaidh an leathanaigh
