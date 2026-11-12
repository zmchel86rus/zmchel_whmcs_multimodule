# Redirect at mga wika sa sitemap

## HTTP

Gumagawa ang Redirect Manager ng tiyak na source → destination rule na may HTTP 301, 302, 303, 307, o 308. Maaaring baguhin, patayin, at burahin ang mga rule; 50 ang makikita sa bawat pahina ng listahan. Ang source ay path na nagsisimula sa / o buong URL sa parehong site. Ang destination ay maaaring path o HTTP(S) URL.

Magkatumbas ang may at walang trailing slash sa pagtutugma, ngunit mananatili ang sariling slash ng destination. Mas nauuna ang rule na may partikular na query kaysa simpleng path rule; ang path rule ay tumutugma rin sa request na may query. Pinapalitan ng destination parameters ang source parameters. Hinahawakan ng rule ang GET at HEAD na dumarating sa WHMCS bago ang page builder. Hindi nito binabago ang .htaccess, language session, o profile. Ang ZM_PB_ENABLE_REDIRECTS_MANAGER ang nagpapagana sa naka-save na rules.

May automatic 301 kapag nagbago ang slug ng published na pahina habang nananatili itong published. Walang redirect sa unang pag-publish ng draft. Ang ZM_PB_AUTO_REDIRECT_DAYS ay may default na 14 araw; 0 ang nag-aalis ng paghihintay. Ina-update ng susunod na pagpapalit ng pangalan ang dating destination at inaalis ang self-redirect kapag bumalik sa lumang slug. Mas nauuna ang manual rule. Ang alias ng override ay maaaring tumuro sa orihinal na WHMCS page.

Nasa zm_pb_redirects ang mga rule. Hindi gumagawa ng table ang isang request; gamitin ang Module database kapag kulang ito. Ang kasalukuyang URL columns ay may limit na 128 bytes. Ang sitemap_pages.xml at sitemap_posts.xml ay may alternatibong wika at x-default, ngunit hindi isinasama ang redirect source. Muling i-generate ang XML matapos magbago ng URL.
