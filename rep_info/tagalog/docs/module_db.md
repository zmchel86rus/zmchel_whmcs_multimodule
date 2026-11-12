# Database ng module

## WHMCS

Ipinapakita sa Module database ang mga table at column na kailangan ng module at kung mayroon na ang mga ito. Tanging ang nakatalagang Super Administrator ang may access. Buksan ito kapag may ibang bahagi ng module na nagsabing may nawawalang table o column; hindi ito pangkalahatang editor ng buong database ng WHMCS.

Basahin muna ang status table. Piliin lamang ang mga MISSING item na nais mong ayusin, saka pindutin ang **Fix Selected items**. I-reload ang pahina at tingnan kung matagumpay ang pagbabago. May ilang nawawalang column na walang awtomatikong paraan ng pag-aayos; maipapakita ng manager ang kakulangan ngunit hindi niya iyon maidaragdag.

Ang **Delete Selected items** ay permanenteng nag-aalis ng napiling mga object ng module sa database. Mag-export muna ng data ng module at gumawa ng backup ng database. Huwag pumili ng hindi kaugnay na row para lamang mawala ang babala. Pagkatapos mag-ayos, bumalik sa bahaging nag-ulat ng error at subukan muli ang gawain.
