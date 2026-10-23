# Leiðbeiningar fyrir zmchel WHMCS Multimodule

**Áður en einingin er notuð skaltu setja einstök salt-gildi í `module_init.php`: `ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT` og `ZM_PB_NONCE_SALT`.** Einingin var þróuð og prófuð með **WHMCS 8.13.1–8.13.7**. Samhæfni við **PHP 7.4–8.5** hefur verið yfirfarin. Apache er studdur að fullu (100%); Nginx gæti þurft viðbótarstillingar fyrir tungumálaleiðir á forsíðu.

**Áður en einingin er notuð skaltu opna Stillingar einingar → Studd tungumál og virkja þau tungumál sem þú þarft.**

**zmchel WHMCS Multimodule er ókeypis.** Í stjórnborði WHMCS geturðu stjórnað fjöltyngdum síðum með sjónrænum ritli, valmyndum, miðlasafni, SEO-lýsigögnum, XML-vefkortum, áframsendingum, rewrite-reglum og inn- og útflutningi.

## Stillingar einingar

Veldu hvaða tungumál einingin má nota. Ef tungumál er gert óvirkt eyðist efni þess ekki.

- **Stillingar einingar → Studd tungumál → Virkja**
- **Gagnagrunnur einingar → Lagfæra Valin atriði**
- **Endurskrifunarreglur → Athuga reglur → Bæta við eða uppfæra reglur**

Nginx les ekki .htaccess og því virka þessar reglur ekki þar. Settu samsvarandi reglur upp í nginx.

## Umsjón með síðum

- **Bæta við síðu → Heiti síðu → Vefslóðarheiti síðu → Vista**
- **Síðaritill → Efnisstillingar → Stillingar lýsigagna → Vefkortsstillingar síðu → Vista allt**
- **Umsjón með síðum → Heimsækja**
- **Vefkort → Búa til vefkort**

Aðeins latneskir bókstafir, bandstrik og tölustafir eru leyfð.

Innskráðir notendur: aðeins innskráðir notendur hafa aðgang að síðunni; Gestir: aðeins gestir hafa aðgang að henni; Blandað: allir hafa aðgang, en sýnileika er stýrt með blokkum innan síðunnar.

Sjálfvirk myndun fer fram eftir WHMCS-cron þegar komið er að uppfærslu. Handvirk myndun hefst samstundis.

## Leiðbeiningar eftir hlutum

- [Umsjón með síðum](docs/pages_manager.md)
- [Síðaritill](docs/pages_editor.md)
- [Umsjón með miðlum](docs/media_manager.md)
- [valmyndir](docs/menu_manager.md)
- [Tungumálastýring](docs/langs_manager.md)
- [áframsendingar](docs/redirects_manager.md)
- [vefkort](docs/sitemap_manager.md)
- [Endurskrifunarreglur](docs/rewrite_manager.md)
- [Stillingar einingar](docs/module_settings.md)
- [Gagnagrunnur einingar](docs/module_db.md)

## Viðbótarefni

- [síðuskipting](docs/pages_editor_pagination.md)
- [Smarty](docs/pages_editor_smarty.md)
- [skipulögð gögn](docs/module_structured_data.md)
- [gagnaflutningur](docs/module_settings_transfer.md)
