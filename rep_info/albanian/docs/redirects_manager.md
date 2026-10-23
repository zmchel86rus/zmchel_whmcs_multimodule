# Ridrejtimet

Adresa të sakta: burimi → destinacioni. Burimi është një shteg nga rrënja e sajtit ose një URL në këtë sajt. Destinacioni është një shteg ose një URL e plotë HTTP(S). Një rregull pa parametra kërkese përputhet edhe me kërkesat që i përmbajnë ato; destinacioni përdoret ashtu siç është dhënë. Rregullat zbatohen për kërkesat GET/HEAD që arrijnë te WHMCS.

Parazgjedhja: 14 ditë. Llogaritet nga ndryshimi i fundit i faqes së publikuar ose i përkthimeve të saj aktive; nëse nuk ka ndryshuar kurrë, nga krijimi. Vendosni 0 për të mos pasur vonesë. Rregullat automatike përdorin HTTP 301.

Adresat e faqeve zëvendësuese ridrejtojnë automatikisht te faqet e sistemit që ato zëvendësojnë. Nëse një zëvendësim ka disa destinacione, përdoret i pari i konfiguruar. Këto ridrejtime funksionojnë sa herë që zëvendësimet janë aktive, pavarësisht rregullave të Menaxherit të ridrejtimeve.

Shkruani një shteg të vlefshëm që fillon me / ose një URL të plotë HTTP(S). Burimi duhet t’i përkasë këtij sajti; fragmentet # nuk mbështeten.

## HTTP

Rregullat mbështesin kodet HTTP `301`, `302`, `303`, `307` dhe `308` dhe zbatohen vetëm për kërkesa `GET`/`HEAD` që arrijnë në WHMCS. Burimi përputhet saktësisht me rrugën dhe, kur janë dhënë, parametrat e kërkimit; parametrat e destinacionit zëvendësojnë të vjetrit. Menaxheri ruan rregullat në `zm_pb_redirects`, por nuk krijon tabelën gjatë një kërkese: përdorni **Baza e të dhënave e modulit**. Fushat ekzistuese të URL-së pranojnë deri në 128 bajte.

Rregullat manuale kanë përparësi ndaj atyre automatike. Ndryshimi i slug-ut të një faqeje të publikuar mund të krijojë ridrejtim automatik `301` për çdo gjuhë aktive pas vonesës së caktuar; publikimi i një drafti nuk e krijon. Riemërtimet e mëvonshme përditësojnë destinacionet e vjetra. Një rregull që përfshin parametrat e kërkesës ka përparësi ndaj rregullit vetëm për shtegun. URL-ja burimore duhet t'i përkasë këtij siti dhe të mos ketë fragment `#`.

## Udhëzime

- Burimi
- Destinacioni
- Aktivizuar
- Çaktivizuar
