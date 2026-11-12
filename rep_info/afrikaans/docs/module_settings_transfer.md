# Invoer en uitvoer

## ZIP-argief

Open Module settings → Import / export en kies al die data of net bepaalde afdelings. Uitvoer lewer 'n ZIP met manifest.json en afsonderlike gegenereerde CSS/JS-lêers vir bladsye. JSON-lêers kan ook ingevoer word. Hou 'n afskrif van die argief voor 'n migrasie of groot instellingsverandering.

- **Bladsye en artikels:** instellings, vertalings, GrapesJS-inhoud, SEO en sitemap-instellings. CSS/JS word by invoer met die nuwe bladsy-ID's herskep.
- **Kieslyste:** hiërargie, etikette, plekke en instellings. Bladsye word volgens slug plus auth_type gepas; kieslyste volgens naam.
- **Instellings:** bewerkbare konstantes, bladsyvervangings, kop/voet en robots.txt. Die URL-modus en laaste sitemap-tyd bly plaaslik.
- **Herleidings en rewrite:** handmatige reëls, skakels na bladsye en pasgemaakte patrone. Pas rewrite-reëls ná invoer weer toe.
- **Media:** geregistreerde lêers, variante en beskrywings; onverwante WHMCS-attachments bly uit die argief.

Invoer werk passings by, voeg nuwe inskrywings by en laat onverwante data staan. Gekose afdelings wat in die argief ontbreek, word oorgeslaan. Sluit bladsye in wanneer jy kieslyste of outomatiese herleidings na 'n nuwe webwerf skuif. Die bron se SystemURL word vir eie skakels met die teikenadres vervang; eksterne URLs bly onveranderd. Kies media saam met bladsye om hul beelde oor te dra.

ZIP is beperk tot 128 MiB en JSON tot 32 MiB. Neem PHP se upload_max_filesize en post_max_size in ag; die ZIP-uitbreiding is nodig. As 'n gegenereerde CSS/JS-lêer ontbreek of nie leesbaar is nie, word dit oorgeslaan en as waarskuwing gewys. Hersienings, ingesamelde Smarty-veranderlikes, WHMCS-rekeninge en geheime, asook temalêers word nie uitgevoer nie. Invoer gebruik bestaande tabelle en verander nie die schema nie.

Die koppelvlak vra bevestiging voordat bestaande inskrywings opgedateer word. Databasisveranderings gebruik 'n transaksie en vervangde lêers word by fout herstel. 'n Lêerslot voorkom gelyktydige invoer. Genereer die werfkaart ná sukses weer en toets die openbare roetes.
