# Rewrite Manager

## WHMCS

Sinusuri at inilalagay ng Rewrite Manager ang mga Apache rule ng module sa pangunahing .htaccess ng website. May lugar din dito para sa sariling rewrite rules. Ang karaniwang paglipat mula isang URL patungo sa iba ay hiwalay na pinamamahalaan sa [Redirect Manager](redirects_manager.md), sapagkat magkaiba ang layunin at yugto ng dalawang mekanismo.

## Suriin at ilapat ang rules

Buksan ang manager at tingnan ang status ng mga route para sa aktibong wika. Isinusulat ng **Add or update rules** ang buong bloke ng module sa .htaccess. Suriin muli ang status at buksan ang isang published na pahina sa default na wika at isa pa sa ibang aktibong wika. Inaalis naman ng **Remove all rules** ang buong bloke kapag mayroon.

Para sa sariling rule, ilagay ang URL pattern, destination, at flags. I-save at muling ilapat ang rules. Suriing mabuti ang malawak na pattern dahil maaaring maapektuhan ang ibang pahina. Binabasa ng Apache ang .htaccess; hindi ito binabasa ng nginx, kaya kailangan ang katumbas na server configuration. Subukan muli ang dati nang mga URL matapos magbago ng mga tuntunin.
