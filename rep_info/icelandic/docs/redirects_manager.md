# Áframsendingar

Nákvæmar slóðir: uppruni → áfangastaður. Uppruninn er slóð frá rót vefsins eða vefslóð á þessum vef. Áfangastaðurinn er slóð eða full HTTP(S)-vefslóð. Regla án fyrirspurnarbreyta samsvarar einnig beiðnum sem innihalda þær; áfangastaðurinn er notaður nákvæmlega eins og hann er skráður. Reglurnar gilda um GET/HEAD-beiðnir sem berast til WHMCS.

Sjálfgefið: 14 dagar. Talið frá síðustu breytingu á birtri síðu eða virkum þýðingum hennar; hafi henni aldrei verið breytt er talið frá stofnun. Stilltu á 0 til að hafa enga bið. Sjálfvirkar reglur nota HTTP 301.

Vefslóðir yfirskrifaðra síðna beina sjálfkrafa á kerfissíðurnar sem þær koma í staðinn fyrir. Ef yfirskrifun hefur marga áfangastaði er sá fyrsti sem er skilgreindur notaður. Þessar endurbeiningar virka þegar yfirskrifanir eru virkar, óháð reglum umsjónar með endurbeiningum.

Sláðu inn gilda slóð sem byrjar á / eða fulla HTTP(S)-vefslóð. Uppruninn verður að tilheyra þessum vef; # brot eru ekki studd.

## HTTP

Reglurnar styðja HTTP-kóðana `301`, `302`, `303`, `307` og `308` og gilda aðeins fyrir `GET`/`HEAD`-beiðnir sem berast WHMCS. Uppruninn er borinn nákvæmlega saman við slóð og tilgreindar fyrirspurnarfæribreytur; færibreytur áfangastaðar koma í stað þeirra gömlu. Stjórinn geymir reglur í `zm_pb_redirects` en býr ekki til töfluna við beiðni: notaðu **Gagnagrunn einingar**. Núverandi URL-dálkar takmarkast við 128 bæti.

Handvirkar reglur ganga framar sjálfvirkum. Breyting á slug birtrar síðu getur eftir stillta bið búið til sjálfvirka `301` beiningu fyrir hvert virkt tungumál; birting draga gerir það ekki. Síðari endurnefningar uppfæra eldri áfangastaði. Regla með fyrirspurnarbreytum hefur forgang fram yfir reglu sem á aðeins við slóðina. Upprunaleg URL verður að tilheyra þessum vef og má ekki innihalda `#`-brot.

## Leiðbeiningar

- Uppruni
- Áfangastaður
- Virkt
- Óvirkt
