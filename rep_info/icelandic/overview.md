# Ókeypis fjölþætt eining fyrir WHMCS

**Áður en einingin er notuð skaltu setja einstök salt-gildi í `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` og `ZM_PB_NONCE_SALT`.** Einingin var þróuð og prófuð með **WHMCS 8.13.1–8.13.7**. Samhæfni við **PHP 7.4–8.5** hefur verið yfirfarin. Apache er studdur að fullu (100%); Nginx gæti þurft viðbótarstillingar fyrir tungumálaleiðir á forsíðu.

**Áður en einingin er notuð skaltu opna Stillingar einingar → Studd tungumál og virkja þau tungumál sem þú þarft.**

**zmchel WHMCS Multimodule er ókeypis.** Í stjórnborði WHMCS geturðu stjórnað fjöltyngdum síðum með sjónrænum ritli, valmyndum, miðlasafni, SEO-lýsigögnum, XML-vefkortum, áframsendingum, rewrite-reglum og inn- og útflutningi. Sjá [leiðbeiningar](instruction.md) til að hefjast handa.

## Framtíðaráform

- Bæta við undirsíðum og flokkum eða efnissviðum.
- Skipta stórri kóðaeiningu upp í samstarfandi hluta.
- Búa til réttindastýringu fyrir stjórnendur og fjölga sjálfgefnum tungumálum í `supported_langs.php`.
- Búa til kóðaritil fyrir `.tpl`-skrár einingarinnar og notendaþemu WHMCS, en ekki stjórnendaþemað.
- Þróa tungumálastýringu fyrir skrár einingarinnar og WHMCS og bæta miðlastýringu.
- Búa til fullbúna, betur fínstillta SEO-stýringu með innblæstri frá Yoast SEO.
- Bæta við fjöltyngdum vefkortum og HTML-vefkortssíðu.
- Bæta notkunartölfræði við síðustýringu.
- Búa til stýringu fyrir smækkun JS, CSS og HTML, skyndiminni fyrir heilar síður og fínstillingu taflna einingarinnar og WHMCS.
- Búa til traust uppfærslukerfi fyrir eininguna.

Þetta eru **hugmyndir fyrir framtíðina, ekki föst útgáfuáætlun**.

## Leggðu til hugmynd eða spurðu

[Sendu tillögu](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) eða [spurningu](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) á `ackirkin@gmail.com`.
