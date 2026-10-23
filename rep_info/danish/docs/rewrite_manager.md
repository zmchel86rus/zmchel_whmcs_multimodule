# Omskrivningsregler

## .htaccess

Åbn administratoren, og sammenlign reglerne med webstedets primære `.htaccess`. Gem URL-mønster, mål og flag for din egen regel, og brug derefter **Tilføj eller opdater regler** til at skrive blokken før WHMCS-reglerne. Kontrollér status igen, og åbn en publiceret side på standardsproget og et andet sprog. Et for bredt mønster kan ramme andre sider. Ved Nginx → Apache gælder reglerne kun for anmodninger, der sendes videre til Apache.

## Vejledning

- Regler for sprog-URL'er, herunder sider under /ru/, /en/ og andre præfikser. Sprogene hentes fra supported_langs.php; reglerne indsættes i .htaccess før WHMCS-reglerne.
- Nginx læser ikke .htaccess, så disse regler virker ikke her. Konfigurér tilsvarende regler i nginx.
- Der blev registreret en opsætning med nginx → Apache. Disse regler virker kun for anmodninger, der videresendes til Apache; nginx læser ikke .htaccess.
- Kontrollér regler
- Tilføj eller opdater regler
- Fjern alle regler fra .htaccess
- URL-mønster
- Mål
- Flag
- Når du har tilføjet eller slettet en regel, skal du klikke på ”Tilføj eller opdater regler” for at anvende ændringerne i .htaccess.

## 1. Installation og adgang

Aktivér tilføjelsesmodulet i WHMCS, og giv relevante medarbejdere adgang. Kontrollér de nødvendige tabeller under Moduldatabase. Gennemgå derefter pæne URL'er, sprogruter og menuområder. Apache bruger .htaccess; på Nginx skal tilsvarende serverregler konfigureres særskilt.
