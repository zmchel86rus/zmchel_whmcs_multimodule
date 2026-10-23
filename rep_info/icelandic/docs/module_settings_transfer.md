# Gagnaflutningur

Ein JSON-skrá fyrir alla eða valda hluta, að hámarki 32 MiB (takmarkanir PHP á skráaupphleðslu gilda einnig). Samsvarandi síður eru uppfærðar eftir vefslóðarheiti og aðgangstegund og valmyndir eftir heiti. Aðrar færslur haldast óbreyttar. Taktu síður með þegar valmyndir eru fluttar inn á nýjan vef. Völdum hlutum sem vantar í skrána er sleppt.

CSS/JS fylgja síðum; myndir og aðrar upphlaðnar skrár fylgja miðlasafninu. Útgáfusaga, safnaðar Smarty-breytur og leynigögn WHMCS eru ekki flutt út. Búðu til vefkortið aftur eftir innflutning og virkjaðu endurskrifunarreglur í Umsjón með endurskrifunarreglum.

Síður og færslur (þýðingar, efni, SEO, stillingar vefkorts og CSS/JS-blokkir)

Samsvarandi færslur í völdum hlutum verða uppfærðar úr skránni. Halda áfram?

## JSON

Útflutningur getur innihaldið síður og færslur með þýðingum, efni, SEO og CSS/JS; valmyndir með stigskiptingu og staðsetningum; stillingar, áframsendingar, eigin reglur og miðlasafn með skrám. Útgáfusaga, safnaðar Smarty-breytur, WHMCS-reikningar og leyndarmál og þemuskrár eru ekki flutt út. JSON-skráin má vera allt að 32 MiB; PHP-mörkin `upload_max_filesize` og `post_max_size` gilda líka. Þegar valmyndir eru fluttar á annan vef þarf einnig að flytja inn síður og leysa árekstra í valmyndanöfnum fyrirfram.

Útflutta skráin notar sniðið `zmchel_whmcs_multimodule` (útgáfa 1). Við innflutning eru slóðir upprunavefsins lagaðar að `SystemURL` markvefsins, en ytri tenglar haldast óbreyttir. Innflutningur býr ekki til töflur: undirbúðu þær fyrst í gagnagrunni einingarinnar. Staðfestingar er óskað áður en byrjað er; færslum er breytt í færsluviðskiptum og yfirskrifaðar skrár endurheimtar ef villa kemur upp.

## Leiðbeiningar

- Valmyndir og staðsetningar
- Stillingar einingar, yfirskrifanir, haus/fótur, robots.txt
- Endurbeiningar
- Sérsniðnar endurskrifunarreglur
- Miðlasafn (skrár og lýsingar)
