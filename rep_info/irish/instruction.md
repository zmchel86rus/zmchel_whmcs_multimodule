# Treoracha do zmchel WHMCS Multimodule

**Sula n-úsáideann tú an modúl, cruthaigh luachanna salt uathúla agus cuir i `module_init.php` iad: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` agus `ZM_PB_NONCE_SALT`.** Forbraíodh agus tástáladh an modúl ar **WHMCS 8.13.1–8.13.7**. Seiceáladh comhoiriúnacht le **PHP 7.4–8.5**. Tacaítear go hiomlán le Apache; d'fhéadfadh cumraíocht bhreise a bheith ag teastáil ó Nginx le haghaidh ródú teanga ar an leathanach baile. **Tá an modúl saor in aisce.**

**Sula n-úsáidtear an modúl den chéad uair, oscail Socruithe an Mhodúil → Teangacha Tacaithe agus cumasaigh na teangacha atá uait.**

## Bainisteoir Teangacha (á fhorbairt)

Oscail Bainisteoir Teangacha i riarachán WHMCS agus roghnaigh rannóg (teangacha cliant nó riaracháin WHMCS, an modúl seo nó modúl eile) agus teanga. Cuir an bunleagan nó an tagairt i gcomparáid leis an aistriúchán, cuir líne amháin in eagar agus sábháil í; is féidir eochracha atá ann a easpórtáil agus a iompórtáil mar JSON freisin. Úsáideann teanga nua an tagairt go dtí go n-aistrítear í. Cumasaíonn nó díchumasaíonn an bainisteoir comhaid teanga agus ceartaíonn sé seanainmneacha; athraigh an teanga réamhshocraithe i WHMCS ar dtús.

→ [Bainisteoir Teangacha](../english/docs/language-manager.md) (English)

## Leathanaigh a chruthú

Oscail **Addons → zmchel WHMCS Multimodule** i limistéar riaracháin WHMCS. Easpórtáil socruithe an mhodúil sula n-athraíonn tú URLanna, atreoruithe nó rialacha freastalaí. I liosta na leathanach, cruthaigh leathanach le hainm inmheánach agus *slug* ar nós `futhainn`, gan fearann ná `.php`. Roghnaigh rochtain do chách, d'úsáideoirí sínithe isteach nó rochtain mheasctha; ansin roghnaigh dréacht nó foilsithe, cineál an leathanaigh agus na teangacha. Caithfidh teanga réamhshocraithe WHMCS a bheith i `supported_langs.php`.

Tar éis sábhála, oscail an leathanach agus líon isteach ábhar, meiteashonraí agus socruithe léarscáile suímh do gach teanga. Tá cnaipe Sábháil ar leith ag gach cuid. Seiceáil an teachtaireacht toraidh agus an leathanach poiblí. Bogann an chéad scriosadh an leathanach chuig an mbruscar; déantar scriosadh buan ansin.

## Eagarthóir agus teangacha

Roghnaigh teanga sa chluaisín ábhair, tarraing bloic GrapesJS chuig an chanbhás agus cuir téacs, íomhánna agus socruithe in eagar. Tá rannóga, colúin, táblaí, CCanna, foirm teagmhála, liostaí, uimhriú leathanach agus limistéir d'aíonna nó do bhaill ann. Is féidir an leagan amach a chóipeáil chuig teanga eile agus an téacs a aistriú roimh fhoilsiú. Is féidir le bloic naisc agus cnaipí an teanga reatha a chur le URLanna inmheánacha; múch é do naisc sheachtracha, comhaid, `mailto:` agus bealaí WHMCS gan aistriúchán.

Nuair atá URLanna áille agus ródú teanga ar siúl, úsáideann an phríomhtheanga bealach gearr ar nós `/ga/`, nó gan réimír má tá bealach na teanga réamhshocraithe múchta. Úsáideann leaganacha réigiúnacha locale BCP 47. Tástáil naisc i dteangacha éagsúla.

## SEO, meáin agus cothabháil

Líon isteach teideal, cur síos, robots, URL canónach agus sonraí sóisialta do gach teanga. Féadfar leathanach foilsithe nach leathanach córais é a áireamh sa léarscáil suímh XML. Uaslódáil íomhánna sa Media Manager, cuir téacs malartach leo agus seiceáil cáilíocht tar éis barrfheabhsaithe. Sa Menu Manager, socraigh leathanaigh agus naisc shaincheaptha, lipéid teanga, suíomh agus infheictheacht.

Cruthaíonn Redirect Manager atreoruithe buana `301` nó sealadacha `302`. Scríobhann Rewrite Manager rialacha `.htaccess` d'Apache; teastaíonn rialacha coibhéiseacha ar an bhfreastalaí ó Nginx. Easpórtáil JSON roimh iompórtáil mhór. Treoracha mionsonraithe i mBéarla: [roghchláir](../english/docs/menus.md), [uimhriú leathanach](../english/docs/pagination.md), [atreoruithe](../english/docs/redirects.md), [léarscáileanna suímh](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [sonraí struchtúrtha](../english/docs/structured-data.md), [aistriú sonraí](../english/docs/transfer.md).
