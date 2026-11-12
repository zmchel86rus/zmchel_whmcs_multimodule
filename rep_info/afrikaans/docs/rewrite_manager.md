# Rewrite Manager

## WHMCS

Rewrite Manager ondersoek en installeer die module se Apache-reëls in die hoof-.htaccess van die webwerf. Dit hou ook pasgemaakte herskryfreëls. Gewone URL-na-URL-herleidings behoort in die [Herleidingsbestuurder](redirects_manager.md), omdat die twee meganismes op verskillende punte toegepas word.

## Kontroleer en pas reëls toe

Open die bestuurder en kontroleer die status van taalroetes vir die aktiewe tale. **Add or update rules** skryf die module se blok reëls na .htaccess. Kontroleer weer, en open 'n gepubliseerde bladsy in die verstektaal en nog een taal. **Remove all rules** verwyder die hele moduleblok wanneer dit bestaan.

Vir 'n eie reël voer jy die URL-patroon, bestemming en flags in, stoor dit en pas die reëls weer toe. Hersien breë patrone voordat jy dit toepas, want dit kan onverwante bladsye raak. Apache lees .htaccess direk; nginx ignoreer dit en benodig gelykwaardige konfigurasie op die bediener. Toets ook bestaande roetes ná 'n verandering.
