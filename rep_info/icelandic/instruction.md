# Leiðbeiningar fyrir zmchel WHMCS Multimodule

**Áður en einingin er notuð skaltu búa til einstök salt-gildi og setja þau í `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` og `ZM_PB_NONCE_SALT`.** Einingin var þróuð og prófuð með **WHMCS 8.13.1–8.13.7**. Samhæfni við **PHP 7.4–8.5** hefur verið yfirfarin. Apache er studdur að fullu; Nginx gæti þurft viðbótarstillingar fyrir tungumálaleiðir á forsíðu. **Einingin er ókeypis.**

**Áður en einingin er notuð skaltu opna Stillingar einingar → Studd tungumál og virkja þau tungumál sem þú þarft.**

## Tungumálastýring (í þróun)

Opnaðu Tungumálastýringu í WHMCS-stjórnborðinu og veldu hluta (tungumál viðskiptavina eða stjórnenda WHMCS, þessa einingu eða aðra) og tungumál. Berðu frumtexta eða viðmið saman við þýðinguna, breyttu einni línu og vistaðu; einnig má flytja núverandi lykla út og inn sem JSON. Ný tungumál nota viðmiðstexta þar til þau hafa verið þýdd. Stýringin virkjar eða slekkur á tungumálaskrám og leiðréttir gömul skráarnöfn; breyttu sjálfgefnu tungumáli fyrst í WHMCS.

→ [Tungumálastýring](../english/docs/language-manager.md) (English)

## Búa til síður

Opnaðu **Addons → zmchel WHMCS Multimodule** í stjórnborði WHMCS. Flyttu út stillingar einingarinnar áður en þú breytir vefslóðum, áframsendingum eða netþjónsreglum. Búðu til síðu með innra heiti og *slug*, til dæmis `um-okkur`, án léns eða `.php`. Veldu aðgang fyrir alla, innskráða notendur eða blandaðan hóp. Veldu svo drög eða birta síðu, síðugerð og tungumál. Sjálfgefið tungumál WHMCS verður að vera í `supported_langs.php`.

Eftir vistun opnarðu síðuna og fyllir út efni, lýsigögn og stillingar vefkorts fyrir hvert tungumál. Hver hluti hefur sinn eigin vistunarhnapp. Athugaðu niðurstöðuna og opinberu síðuna. Fyrsta eyðing færir síðu í ruslið; varanleg eyðing fer fram þar.

## Ritill og tungumál

Veldu tungumál á efnisflipanum, dragðu GrapesJS-einingar á vinnusvæðið og breyttu texta, myndum og stillingum. Til eru kaflar, dálkar, töflur, algengar spurningar, samskiptaform, listar, síðuskipting og svæði fyrir gesti eða meðlimi. Þú getur afritað uppbyggingu yfir á annað tungumál og þýtt textann áður en þú birtir. Tengla- og hnappaeiningar geta bætt tungumáli síðunnar við innri vefslóðir; slökktu á því fyrir ytri tengla, skrár, `mailto:` og WHMCS-leiðir án þýðinga.

Þegar læsilegar vefslóðir og tungumálaleiðir eru virkar notar aðaltungumálið stutta leið eins og `/is/`, eða enga forskeytaleið ef leið fyrir sjálfgefið tungumál er óvirk. Svæðisbundin afbrigði nota BCP 47 staðfærslu. Prófaðu tengla á fleiri en einu tungumáli.

## SEO, miðlar og viðhald

Fylltu út titil, lýsingu, robots-stillingu, kanóníska vefslóð og upplýsingar fyrir samfélagsmiðla fyrir hvert tungumál. Birt síða sem er ekki kerfissíða getur birst á XML-vefkorti. Hladdu myndum upp í Media Manager, settu inn alt-texta og skoðaðu gæði eftir fínstillingu. Raðaðu síðum og sérsniðnum tenglum í Menu Manager og stilltu tungumálaheiti og staðsetningu.

Redirect Manager býr til varanlegar `301` eða tímabundnar `302` áframsendingar. Rewrite Manager skrifar `.htaccess`-reglur fyrir Apache; Nginx þarf samsvarandi netþjónsstillingar. Flyttu út JSON áður en mikið magn gagna er flutt inn. Nánari enskar leiðbeiningar: [valmyndir](../english/docs/menus.md), [síðuskipting](../english/docs/pagination.md), [áframsendingar](../english/docs/redirects.md), [vefkort](../english/docs/sitemaps.md), [Smarty](../english/docs/smarty.md), [skipulögð gögn](../english/docs/structured-data.md), [gagnaflutningur](../english/docs/transfer.md).
