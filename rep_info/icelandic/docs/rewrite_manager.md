# Endurskrifunarreglur

## WHMCS

Reglur fyrir tungumálavefslóðir, þar á meðal síður undir /ru/, /en/ og öðrum forskeytum. Tungumálin koma úr supported_langs.php; reglunum er bætt í .htaccess á undan WHMCS-reglum.

Nginx les ekki .htaccess og því virka þessar reglur ekki þar. Settu samsvarandi reglur upp í nginx.

Nginx → Apache-uppsetning fannst. Þessar reglur virka aðeins fyrir beiðnir sem sendar eru áfram til Apache; nginx les ekki .htaccess.

Eftir að þú bætir við eða eyðir reglu skaltu smella á „Bæta við eða uppfæra reglur“ til að virkja breytingarnar í .htaccess.

## .htaccess

Opnaðu umsjónina og berðu reglurnar saman við aðal `.htaccess` skrá vefsins. Fyrir eigin reglu skaltu vista URL-mynstur, áfangastað og flögg, síðan velja **Bæta við eða uppfæra reglur** svo blokkin sé skrifuð á undan WHMCS-reglum. Athugaðu stöðuna aftur og opnaðu birta síðu á sjálfgefnu máli og öðru tungumáli. Of vítt mynstur getur haft áhrif á aðrar síður. Með Nginx → Apache gilda reglurnar aðeins um beiðnir sem berast Apache.

## Leiðbeiningar

- Athuga reglur
- Bæta við eða uppfæra reglur
- Fjarlægja allar reglur úr .htaccess
- Mynstur vefslóðar
- Markslóð
- Flögg
