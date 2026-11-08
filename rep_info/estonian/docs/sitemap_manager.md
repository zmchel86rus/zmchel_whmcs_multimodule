# Saidikaardid

Automaatne genereerimine käivitub pärast WHMCS-i croni, kui uuendamise aeg on käes. Käsitsi genereerimine algab kohe. Kaasatakse külalistele kättesaadavad aktiivsed lehed ja postitused koos nende aktiivsete keeleversioonidega. Asendused kasutavad nende asendatavate lehtede avalikke URL-e.

## XML

XML sisaldab aktiivsete keelte vastastikuseid linke ja vaikekeele aadressi jaoks `x-default`-i. Ümbersuunamiste lähteaadresse ei lisata `loc`-i ega keelealternatiividesse; varutõlge märgitakse sisu tegeliku keelega. Lehe- ja postitusfailid deklareerivad XHTML-nimeruumi.

Hook `AfterCronJob` võrdleb vahemikku `ZM_PB_SITEMAP_UPDFREQ` viimase õnnestunud loomise ajaga `ZM_PB_SITEMAP_LASTUPD`; kui saidikaart on välja lülitatud, pole ka käsitsi loomine võimalik. Keeleversioone valitakse `lang_active`. Lisafailid saavad lõpud `_2`, `_3` jne. Tõrke korral taastatakse eelmised failid ja õnnestumise aeg ei muutu. Kontrollige kirjutusõigust saidi juurkausta, `resources/` ja `inc/editable_consts.php`; tabeleid parandatakse eraldi mooduli andmebaasis.

Automaatne loomine sõltub WHMCS-i cronist ja määratud ajavahemikust; nupp käivitab selle kohe. Kaasatakse ainult külalistele nähtavad avaldatud lehed ja postitused koos aktiivsete tõlgetega. Kui leht asendab süsteemilehte, kasutatakse süsteemilehe avalikku URL-i, mitte asenduslehe slug-i. Üle 50 000 URL-i või 50 MB suurused failid jagatakse osadeks. Indeks säilitab muud kehtivad saidikaardid.

Moodul kirjutab saidi juurkataloogi failid `sitemap_index.xml`, `sitemap_pages.xml` ja `sitemap_posts.xml`; tühja kategooria jaoks faili ei tehta. Ühist faili `sitemap.xml` ei looda. Pärast lehtede või keelte muutmist genereeri kaardid uuesti ja ava indeks brauseris. Tõrke korral kontrolli juurkataloogi kirjutusõigust; viimase õnnestunud genereerimise aeg ei muutu.
