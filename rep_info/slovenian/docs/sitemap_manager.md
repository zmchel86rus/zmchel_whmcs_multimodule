# Zemljevidi spletnega mesta

Vključite zemljevid in ustvarite datoteke XML. Preverite objavljene jezikovne različice v sitemap_index.xml; ob manjkajočih posodobitvah preverite WHMCS cron in dovoljenja za pisanje.

## XML

XML vsebuje vzajemne povezave za aktivne jezike in `x-default` za naslov privzetega jezika. Viri preusmeritev niso vključeni v `loc` ali jezikovne različice; nadomestni prevod je označen z dejanskim jezikom vsebine. Datoteke strani in objav deklarirajo imenski prostor XHTML.

Kavelj `AfterCronJob` primerja interval `ZM_PB_SITEMAP_UPDFREQ` s časom zadnjega uspešnega ustvarjanja `ZM_PB_SITEMAP_LASTUPD`; ko je zemljevid izklopljen, tudi ročno ustvarjanje ni na voljo. Jezikovne različice se izberejo po `lang_active`, ne po `lang_status`. Dodatni deli dobijo končnice `_2`, `_3` in naprej. Če ustvarjanje ne uspe, se prejšnje datoteke obnovijo, čas uspeha pa se ne spremeni. Preverite pisanje v koren, `resources/` in `inc/editable_consts.php`; tabele popravite posebej v bazi modula.

Samodejno ustvarjanje je odvisno od opravila cron WHMCS in nastavljenega intervala; gumb ga sproži takoj. Vključene so le objavljene strani in prispevki, dostopni gostom, skupaj z aktivnimi prevodi. Če stran nadomesti sistemsko stran, se uporabi javni URL sistemske strani in ne slug nadomestne strani. Datoteke z več kot 50.000 URL-ji ali 50 MB se razdelijo. Kazalo ohrani druge veljavne zemljevide mesta.

Modul v koren spletnega mesta zapiše `sitemap_index.xml`, `sitemap_pages.xml` in `sitemap_posts.xml`; prazna kategorija ne ustvari datoteke. Združenega `sitemap.xml` ne ustvari. Po spremembi strani ali jezikov znova ustvarite zemljevide in odprite indeks v brskalniku. Ob napaki preverite pravico pisanja v korenski imenik; čas zadnjega uspešnega ustvarjanja ostane enak.

## Navodila

- Samodejno ustvarjanje se izvede po opravilu WHMCS cron, ko je čas za posodobitev. Ročno ustvarjanje se začne takoj.
- Vključene so aktivne strani in objave, dostopne gostom, skupaj z njihovimi objavljenimi jezikovnimi različicami. Nadomestitve uporabljajo javne URL-je strani, ki jih nadomeščajo.
- Ustvari zemljevide spletnega mesta
- Datoteke v korenskem imeniku spletnega mesta
- Zadnje uspešno ustvarjanje
- Naslednja posodobitev ne prej kot
- Če ni izbrana nobena možnost, se zemljevid spletnega mesta posodablja vsak dan.
- Ko je možnost omogočena, /html-sitemap prikazuje zemljevid spletnega mesta kot običajno stran HTML; sitemap.xml ostane nespremenjen.
- **Pogostost posodabljanja** — Če je polje prazno, je privzeta vrednost 'monthly'.
- **Prednost posodabljanja** — Če je polje prazno, je privzeta vrednost '0.5'.
