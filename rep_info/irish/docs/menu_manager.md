# Roghchláir

Cruthaigh biachlár, cuir leathanaigh nó naisc shaincheaptha leis agus cuir na míreanna in ord trína dtarraingt. Roghnaigh mír thuismitheora d’fho-bhiachláir; socraigh lipéid de réir teanga, infheictheacht d’aíonna nó do chliaint agus gléasanna. Sann suíomh; ní féidir ach biachlár amháin a bheith i ngach suíomh. Roghnaigh an leanfaidh URL na nasc inmheánach an teanga reatha. Seiceáil an biachlár poiblí ar ríomhaire agus ar ghuthán.

Is féidir teideal, cur síos, aicmí CSS, `rel`, deilbhín agus oscailt i gcluaisín nua a shocrú do gach mír; is féidir leathanaigh fhoilsithe a chur leis go huathoibríoch freisin. Roghnaigh ar leithligh don ríomhaire agus don fhón an gcuireann an roghchlár le nascleanúint WHMCS nó an dtagann sé ina háit. Ríomhtar nasc le leathanach an mhodúil arís de réir an slug, na teanga agus an mhodha URL reatha; úsáideann lipéad folamh an teideal aistrithe nó ainm an leathanaigh. Ní athraíonn cuairt ar leathanach teanga phróifíl an chustaiméara. Diúltaíonn an freastalaí do scéimeanna URL neamhshábháilte agus HTML sna lipéid.

## WHMCS

Cumasaigh na suíomhanna roghchláir WHMCS atá uait i socruithe an mhodúil. Ní ghlacann gach suíomh ach le roghchlár amháin, ach is féidir an roghchlár céanna a úsáid i roinnt suíomhanna. Úsáidtear amharc deisce ó leithead 768 px amach agus amharc soghluaiste faoi bhun sin. Fágtar gnáthroghchlár WHMCS mar atá nuair atá suíomh múchta.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Ar bhealaí córais WHMCS nach bhfuil ródú teanga an mhodúil orthu, úsáideann lipéid an roghchláir teanga shábháilte an chustaiméara; úsáideann leathanaigh an mhodúil teanga an URL. Má chuirtear bealach ar leith ar fáil don teanga réamhshocraithe, faigheann sí réimír freisin. Is é `?m=zmchel_whmcs_multimodule&slug=...&lang=...` an URL simplí. Is féidir nasc saincheaptha, mar `clientarea.php`, a fhágáil gan logánú. Folaíonn mír tuismitheora fholaithe a brainse iomlán.

Ríomhtar URL míre leathanaigh arís ón slug reatha agus ón aistriúchán foilsithe. Mura bhfuil aistriúchán ann, úsáidtear an leagan foilsithe sa teanga réamhshocraithe. Is féidir le nasc saincheaptha an URL a iontráladh a choinneáil; ní chuirtear réimír teanga le seoltaí seachtracha, mailto, tel ná ancairí. Ní thaispeántar dréachtaí, leathanaigh scriosta ná leathanaigh nach bhfuil cead rochtana orthu.

## zm_pb_menus

Coinnítear na sonraí sna táblaí `zm_pb_menus`, `zm_pb_menu_items` agus `zm_pb_menu_locations`. Cruthaigh nó deisigh iad i mBunachar Sonraí an Mhodúil. Ceadaítear suas le 10 leibhéal agus 300 mír; nuair a scriostar mír thuismitheora, bogann a páistí leibhéal amháin suas.

## Treoracha

- Cruthaigh roghchlár
- Cuir leathanaigh, postálacha nó naisc shaincheaptha leis.
- Tarraing míreanna chun a n-ord a athrú. Socraigh neadú leis an roghnóir tuismitheora nó leis na cnaipí bogtha.
- Úsáid teanga an leathanaigh reatha
- Úsáid an URL a iontráladh gan athrú
- Lipéid i dteangacha eile
- Infheicthe ag
- Gléasanna
- Ní féidir ach roghchlár amháin a bheith ag gach suíomh. Má roghnaítear suíomh, aistrítear a shannadh anseo ó roghchlár eile.
- Déantar colúin de mhíreanna barrleibhéil agus naisc de mhíreanna neadaithe. Úsáid URL # le haghaidh ceannteidil gan nasc.
- Níl na táblaí roghchláir cruthaithe fós. Cuir leo i mBunachar Sonraí an Mhodúil.
