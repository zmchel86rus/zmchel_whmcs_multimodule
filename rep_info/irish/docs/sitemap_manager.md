# Léarscáileanna suímh

Ritheann giniúint uathoibríoch tar éis cron WHMCS nuair a bhíonn nuashonrú dlite. Tosaíonn giniúint de láimh láithreach.

Cuirtear leathanaigh agus postálacha gníomhacha atá ar fáil do chuairteoirí san áireamh, mar aon lena leaganacha teanga foilsithe. Úsáideann sáruithe URLanna poiblí na leathanach a gcuirtear ina n-ionad iad.

Mura roghnaítear rud ar bith, nuashonraítear léarscáil an tsuímh gach lá.

Nuair atá sé cumasaithe, taispeánann /html-sitemap léarscáil an tsuímh mar ghnáthleathanach HTML; ní dhéantar aon athrú ar sitemap.xml.

## XML

Cuimsíonn an XML naisc chómhalartacha do theangacha gníomhacha agus `x-default` do sheoladh na teanga réamhshocraithe. Ní chuirtear foinsí atreoraithe i `loc` ná sna malairtí teanga; marcáiltear aistriúchán cúltaca le fíortheanga an ábhair. Dearbhaíonn comhaid na leathanach agus na bpostálacha spás ainmneacha XHTML.

Déanann hook `AfterCronJob` comparáid idir an t-eatramh `ZM_PB_SITEMAP_UPDFREQ` agus am an ratha deiridh `ZM_PB_SITEMAP_LASTUPD`; nuair atá an léarscáil díchumasaithe, níl giniúint láimhe ar fáil ach oiread. Roghnaítear leaganacha teanga de réir `lang_active`, ní `lang_status`. Faigheann codanna eile na hiarmhíreanna `_2`, `_3` agus araile. Má theipeann ar an nginiúint, aisghabhtar na seanchomhaid agus ní athraíonn am an ratha. Seiceáil cead scríofa san fhréamh, in `resources/` agus in `inc/editable_consts.php`; deisítear táblaí ar leithligh i mbunachar sonraí an mhodúil.

Braitheann giniúint uathoibríoch ar cron WHMCS agus ar an eatramh socraithe; tosaíonn an cnaipe í láithreach. Ní chuirtear san áireamh ach leathanaigh agus postálacha foilsithe atá ar fáil d’aíonna, mar aon lena n-aistriúcháin ghníomhacha. Má thagann leathanach in áit leathanach córais, úsáidtear URL poiblí leathanach an chórais seachas slug an ionadaí. Roinntear comhaid os cionn 50,000 URL nó 50 MB. Coinníonn an t-innéacs léarscáileanna bailí eile den suíomh.

Scríobhann an modúl `sitemap_index.xml`, `sitemap_pages.xml` agus `sitemap_posts.xml` i bhfréamh an tsuímh; ní chruthaítear comhad do chatagóir fholamh. Ní chruthaítear `sitemap.xml` comhcheangailte. Tar éis leathanaigh nó teangacha a athrú, gin na léarscáileanna arís agus oscail an t-innéacs sa bhrabhsálaí. Má tharlaíonn earráid, seiceáil cead scríofa na fréimhe; ní athraítear am na giniúna rathúla deireanaí.

## Treoracha

- Gin léarscáileanna suímh
- Comhaid i bhfréamh an tsuímh
- An ghiniúint rathúil dheireanach
- An chéad nuashonrú eile tráth nach luaithe ná
- **Minicíocht nuashonraithe** — Má tá sé folamh, is é 'monthly' an réamhshocrú.
- **Tosaíocht nuashonraithe** — Má tá sé folamh, is é '0.5' an réamhshocrú.
