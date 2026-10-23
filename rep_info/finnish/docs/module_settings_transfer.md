# Tuonti ja vienti

Vie tarvittavat osiot ennen suuria muutoksia. Tarkista tuonnin jälkeen sivut, valikot ja media, ota URL-säännöt käyttöön erikseen ja luo sivustokartta uudelleen. Tämä ei korvaa WHMCS:n varmuuskopiota.

## JSON

Vientiin voi sisällyttää sivut ja artikkelit käännöksineen, sisältöineen, SEO-tietoineen ja CSS/JS-koodeineen; valikot rakenteineen ja sijainteineen; asetukset, uudelleenohjaukset, omat säännöt ja mediakirjaston tiedostot. Versiohistoriaa, kerättyjä Smarty-muuttujia, WHMCS-tilejä tai salaisuuksia eikä teeman tiedostoja viedä. JSON-tiedoston raja on 32 MiB; myös PHP:n `upload_max_filesize` ja `post_max_size` rajoittavat tuontia. Kun siirrät valikot toiselle sivustolle, tuo myös sivut ja selvitä samannimiset valikot etukäteen.

Vientitiedoston muoto on `zmchel_whmcs_multimodule` (versio 1). Tuonnissa lähdesivuston URL-osoitteet sovitetaan kohteen `SystemURL`-arvoon, mutta ulkoiset linkit säilyvät. Tuonti ei luo tauluja: valmistele ne ensin moduulin tietokantaosiossa. Ennen aloitusta pyydetään vahvistus; tietueet muuttuvat transaktion sisällä ja korvatut tiedostot palautetaan virheen sattuessa.

## Ohjeet

- Yksi JSON-tiedosto kaikille tai valituille osioille, enintään 32 MiB (myös PHP:n latausrajoitukset koskevat sitä). Vastaavat sivut päivitetään URL-tunnisteen ja käyttöoikeustyypin perusteella, valikot nimen perusteella. Muut tietueet säilyvät ennallaan. Sisällytä sivut, kun tuot valikoita uuteen sivustoon. Tiedostosta puuttuvat valitut osiot ohitetaan.
- CSS/JS sisältyvät sivuihin ja kuvat sekä muut ladatut tiedostot mediakirjastoon. Versiohistoriaa, kerättyjä Smarty-muuttujia ja WHMCS:n salaisia tietoja ei viedä. Luo sivustokartta uudelleen tuonnin jälkeen ja ota uudelleenkirjoitussäännöt käyttöön uudelleenkirjoitussääntöjen hallinnassa.
- Sivut ja artikkelit (käännökset, sisältö, hakukoneoptimointi, sivustokartan asetukset, CSS/JS-lohkot)
- Valikot ja sijainnit
- Moduulin asetukset, sivujen korvaukset, head/footer, robots.txt
- Uudelleenohjaukset
- Mukautetut uudelleenkirjoitussäännöt
- Mediakirjasto (tiedostot ja kuvaukset)
- Valittujen osioiden vastaavat tietueet päivitetään tiedostosta. Jatketaanko?
