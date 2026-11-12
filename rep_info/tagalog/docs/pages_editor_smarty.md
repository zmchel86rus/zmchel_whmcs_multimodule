# Smarty block at talaan ng variable

Paganahin muna sa Module settings ang pagkolekta at paggamit ng Smarty variables. Ang ZM_PB_COLLECT_VARS ang gumagawa ng talaan; pinahihintulutan ng ZM_PB_USE_COLLECT_VARS ang block na lumabas. Bisitahin ang mga kaugnay na pampublikong pahina at i-reload ang editor upang makakita ng bagong mga mungkahi.

## Talaan

Nasa resources/available_vars/ ang mga file ayon sa theme at template. Itinatala ang pangalan, uri, nested na istruktura, at yugto ng pagkakita, hindi ang tunay na halaga. Ipinapahiwatig ng sampled at truncated ang limitadong koleksiyon. Ang password, token, at personal na datos ay redacted. Kung wala ang field sa talaan, hindi nito pinatutunayang wala ito sa lahat ng request. Hindi pinapatakbo ang mga getter, relasyon ng model, o dagdag na database query. Protektado ang folder ng .htaccess, ngunit wala pa ring tunay na halaga kahit hindi ginagamit ng Nginx ang .htaccess.

## Editor

Pindutin ang **Edit code** sa toolbar o i-double-click ang Smarty block upang buksan ang CodeMirror. Ang Ctrl+Space ay panghanap ng variable, Ctrl+S ay paglalapat ng code, F11 ay full screen, at Escape ay paglabas. Para sa available na koleksiyon, gamitin ang {foreach $items as $item}; ilabas ang field bilang {$item.title|escape}. Maghanda rin ng output para sa listahang walang laman at subukan ang tunay na datos ng pahina.

## Halimbawa ng foreach

Kung available na ang listahan sa pahina, gamitin ang {foreach $items as $item} at ilabas ang pamagat bilang {$item.title|escape}. Maglagay din ng mensahe para sa listahang walang item. Tinutulungan ka ng talaan na hanapin ang pangalan ng variable ngunit hindi ito kumukuha ng data mula sa ibang pahina.

## Pagpapatakbo at limitasyon

Sinusuri ang code sa pag-save at bago ilabas. Pinahihintulutan ang limitadong if, foreach, lokal na assign, capture, at modifiers gaya ng escape, default, count, at date_format. Ipinagbabawal ang PHP, SQL, object methods, anumang function, pag-include ng file, network resources, at nofilter. Awtomatikong ini-escape ang mga halaga; ang sinadyang HTML ay isulat sa template. Kung may error o kulang ang datos, mananatiling walang laman ang block at isusulat ang error sa PHP log. Inaalis muna ang mga access-restricted zone bago patakbuhin ang Smarty block.
