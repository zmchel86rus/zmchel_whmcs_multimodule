# Language Manager

Sa Language Manager, maaaring baguhin ang mga salin ng WHMCS client at admin, ng module na ito, at ng ibang natukoy na module. Kailangan ang Super Administrator ng module at pahintulot sa PHP na magsulat sa kaukulang folder. Ang daloy ay Sections → Languages → Translations; ang bawat **Save** ay nagse-save ng isang salin lamang.

## Magsimula

Paganahin muna ang mga wikang kailangan sa Module settings → Supported languages. Ito ang listahang nagtatakda ng maaaring idagdag sa manager at magamit sa mga pahina. Sa Sections, pumili ng WHMCS client, WHMCS admin, module na ito, o ibang module. Ipinapakita sa talahanayan ang bilang ng kasalukuyan, disabled, at maaaring idagdag. Ang bagong wika ay gumagamit muna ng mga string mula sa reference; hindi pa ito kumpletong salin. Ang **Untranslated** badge ay para sa katalogong wala pang sariling salin.

## Baguhin ang mga salin

Ipinapakita ng **Original** ang mga string na tunay na nasa orihinal na file ng napiling wika, hindi ang override. Kung walang orihinal na salin, **Reference** ang pangalan ng column at ipinapakita ang batayang wika. Maghanap ayon sa key o teksto at salain ang orihinal o idinagdag na key. May pagination ang mahahabang listahan. I-save ang bawat row nang hiwalay. Maaaring magdagdag ng custom key sa napiling parent, at maaari itong palitan ng pangalan o burahin; hindi maaalis sa ganitong paraan ang orihinal na key. Read-only ang format ng ibang module kapag hindi ito ligtas i-save.

## JSON export at import

Dinada-download ng **Export JSON** ang mga key at kasalukuyang salin ng napiling wika. Itabi ang kopya bago mag-edit nang maramihan. Ina-update lamang ng **Import JSON** ang kasalukuyang key at hindi gumagawa ng bago. Huwag baguhin ang section, language identifier, at key path. Nilalaktawan at inililista ang hindi kilala o dobleng key, habang nagpapatuloy ang mga wastong entry. Ang upload limit ay 8 MiB.

## Mga file at pangalan

Sa Languages, puwedeng patayin at muling paganahin ang file ng wika; maaari pa ring i-edit ang salin kapag disabled. Hindi maaaring patayin ang English base o kasalukuyang default ng WHMCS. May backup ang mga file ng WHMCS na ginawa ng manager upang maibalik matapos ang update. Kung may lumang filename, gamitin ang iisang pagwawasto sa Sections at suriin ang ipapakitang bagong pangalan. Para palitan ang default, paganahin muna ang bago sa Module settings, saka baguhin sa WHMCS, at pagkatapos patayin ang luma.
