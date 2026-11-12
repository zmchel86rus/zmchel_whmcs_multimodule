# Tuonti ja vienti

Vie tarvittavat osiot ennen suuria muutoksia. Tarkista tuonnin jälkeen sivut, valikot ja media, ota URL-säännöt käyttöön erikseen ja luo sivustokartta uudelleen. Tämä ei korvaa WHMCS:n varmuuskopiota. Tuonnissa tuetaan myös JSON-tiedostoja.

## ZIP

Vientiin voi sisällyttää sivut ja artikkelit käännöksineen, sisältöineen, SEO-tietoineen ja CSS/JS-koodeineen; valikot rakenteineen ja sijainteineen; asetukset, uudelleenohjaukset, omat säännöt ja mediakirjaston tiedostot. Versiohistoriaa, kerättyjä Smarty-muuttujia, WHMCS-tilejä tai salaisuuksia eikä teeman tiedostoja viedä. ZIP-tiedoston raja on 128 MiB; myös PHP:n `upload_max_filesize` ja `post_max_size` rajoittavat tuontia. Kun siirrät valikot toiselle sivustolle, tuo myös sivut ja selvitä samannimiset valikot etukäteen.

Vientitiedoston muoto on `zmchel_whmcs_multimodule` (versio 2). Tuonnissa lähdesivuston URL-osoitteet sovitetaan kohteen `SystemURL`-arvoon, mutta ulkoiset linkit säilyvät. Tuonti ei luo tauluja: valmistele ne ensin moduulin tietokantaosiossa. Ennen aloitusta pyydetään vahvistus; tietueet muuttuvat transaktion sisällä ja korvatut tiedostot palautetaan virheen sattuessa.
