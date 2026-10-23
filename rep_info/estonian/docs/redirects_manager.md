# Ümbersuunamised

Täpsed aadressid: lähteaadress → sihtaadress. Lähteaadress on tee saidi juurkataloogist või selle saidi URL. Sihtaadress on tee või täielik HTTP(S)-URL. Päringuparameetriteta reegel vastab ka neid sisaldavatele päringutele; sihtaadressi kasutatakse sisestatud kujul. Reeglid kehtivad WHMCS-i jõudvatele GET/HEAD-päringutele.

Vaikimisi: 14 päeva. Arvestatakse avaldatud lehe või selle aktiivsete tõlgete viimasest muudatusest; kui muudatusi pole olnud, siis loomisest. Viivituse keelamiseks määrake 0. Automaatreeglid kasutavad HTTP 301.

Asendatud lehtede aadressid suunatakse automaatselt ümber süsteemilehtedele, mida need asendavad. Kui asendusel on mitu sihtaadressi, kasutatakse esimest seadistatud aadressi. Need ümbersuunamised toimivad alati, kui lehtede asendused on lubatud, sõltumata ümbersuunamiste halduri reeglitest.

Sisestage korrektne tee, mis algab märgiga /, või täielik HTTP(S)-URL. Lähteaadress peab kuuluma sellele saidile; #-fragmente ei toetata.

## HTTP

Reeglid toetavad HTTP-koode `301`, `302`, `303`, `307`, `308` ja kehtivad ainult WHMCS-i jõudvatele `GET`/`HEAD` päringutele. Lähteaadressi võrreldakse täpselt tee ja vajaduse korral päringuparameetrite järgi; sihtkoha parameetrid asendavad vanad. Haldur salvestab reeglid tabelisse `zm_pb_redirects`, kuid ei loo tabelit päringu ajal: kasutage **Mooduli andmebaasi**. Olemasolevad URL-veerud on piiratud 128 baidiga.

Käsitsi lisatud reeglid on automaatsetest tähtsamad. Avaldatud lehe slug'i muutus võib pärast määratud ooteaega luua iga aktiivse keele jaoks automaatse `301`; mustandi avaldamine seda ei tee. Järgmised ümbernimetamised uuendavad vanade reeglite sihte. Päringuparameetritega reegel on ainult teele vastavast reeglist tähtsam. Lähte-URL peab kuuluma sellele saidile ega tohi sisaldada `#`-fragmenti.

## Juhised

- Lähteaadress
- Sihtaadress
- Lubatud
- Keelatud
