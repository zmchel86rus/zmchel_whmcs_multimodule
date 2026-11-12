# Page Editor

Binubuksan ang Page Editor matapos gumawa ng pahina sa [Page Manager](pages_manager.md). May magkahiwalay itong tab para sa pangunahing setting, nilalaman, metadata, at sitemap. Pumili muna ng aktibong wika bago baguhin ang isinaling nilalaman. Bawat tab ay may sariling pag-save; ang **Save all** ay nagse-save ng mga seksyon nang sabay. Pagkatapos, tingnan ang resulta sa pampublikong pahina.

## Pangunahing setting

Suriin ang panloob na pangalan, slug, uri, publikasyon, access mode, at mga aktibong wika. Kahit published ang pahina, kailangan pa rin nito ng nilalaman sa wikang ipapakita. Kapag hindi aktibo sa module ang default na wika ng WHMCS, paganahin muna ito sa Module settings bago mag-save. Suriin din ang aktibong salin kapag wala ang inaasahang URL.

## Nilalaman

Pumili ng wika at i-drag ang mga GrapesJS block sa canvas. Piliin ang block upang baguhin ang setting nito; gumagamit ng TinyMCE ang rich text. Ang Sections, Columns, Flex, at Grid ay para sa layout. Maaaring kumopya ng nilalaman o istruktura ang mga tool ng wika, ngunit kailangan pa ring isalin ang kopya. Tingnan ang mga gabay sa [pagination at filter](pages_editor_pagination.md), [Smarty](pages_editor_smarty.md), at [structured data](module_structured_data.md) para sa mga espesyal na block.

## Metadata at sitemap

Maglagay ng hiwalay na pamagat at paglalarawan para sa bawat wika. Suriin ang canonical, robots, social metadata, breadcrumbs, at Schema type kung kailangan. Sa Sitemap settings, itakda ang dalas ng pagbabago at priority ng published na hindi sistemang pahina. Ang [Sitemap Manager](sitemap_manager.md) ang lumilikha ng XML files; i-check ang nalikhang URL pagkatapos mag-save.

## Contact Form

Magdagdag ng **Contact Form** block. Pumili ng WHMCS ticket at support department o email at tatanggap. Itakda ang pamagat, paksa, button, pangalan ng bawat field, uri, required status, at validation. Ang guest ticket ay nangangailangan ng field na nakatalaga sa pangalan at email ng sender. Maglagay ng isang dropdown option bawat linya at magkahiwalay na field para sa magkakaibang pahintulot. Gamitin ang CAPTCHA na naka-configure sa WHMCS. Magsumite ng totoong pagsubok bilang bisita at tiyaking dumating ang ticket o email. Hindi patunay ng delivery ang berdeng status sa editor. I-set up ang WHMCS SMTP kung pumalya ang PHP mail().
