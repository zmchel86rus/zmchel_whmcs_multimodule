# Omskrivningsregler

## .htaccess

Åbn administratoren, og sammenlign reglerne med webstedets primære `.htaccess`. Gem URL-mønster, mål og flag for din egen regel, og brug derefter **Tilføj eller opdater regler** til at skrive blokken før WHMCS-reglerne. Kontrollér status igen, og åbn en publiceret side på standardsproget og et andet sprog. Et for bredt mønster kan ramme andre sider. Ved Nginx → Apache gælder reglerne kun for anmodninger, der sendes videre til Apache.

## 1. Installation og adgang

Aktivér tilføjelsesmodulet i WHMCS, og giv relevante medarbejdere adgang. Kontrollér de nødvendige tabeller under Moduldatabase. Gennemgå derefter pæne URL'er, sprogruter og menuområder. Apache bruger .htaccess; på Nginx skal tilsvarende serverregler konfigureres særskilt.
