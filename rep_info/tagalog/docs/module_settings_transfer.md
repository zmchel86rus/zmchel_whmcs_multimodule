# Pag-import at pag-export

## ZIP archive

Buksan ang Module settings → Import / export at piliin ang lahat o ilang seksyon. Lumilikha ang export ng ZIP na may manifest.json at magkakahiwalay na CSS/JS file ng pahina. Sinusuportahan din ang JSON import. Itago ang orihinal na archive bago maglipat ng site o magbago ng maraming setting.

- **Mga pahina at artikulo:** settings, salin, GrapesJS content, SEO, at sitemap settings. Muling nililikha ang CSS/JS para sa bagong page ID sa pag-import.
- **Mga menu:** hierarchy, isinaling label, lokasyon, at setting. Tinutugma ang pahina sa slug at auth_type; ang menu sa pangalan.
- **Mga setting:** editable constants, page override, header, footer, at robots.txt. Nananatili sa target ang URL mode at huling oras ng sitemap.
- **Redirect at rewrite:** manual rules, pagkakaugnay ng pahina, at custom rules. Ilapat muli ang rewrite rules pagkatapos mag-import.
- **Media:** rehistradong file, variant, at paglalarawan; hindi kasama ang walang kaugnayang WHMCS attachments.

Ina-update ng import ang mga tugma, nagdaragdag ng bago, at iniiwan ang ibang record. Nilalaktawan ang napiling seksyon kung wala ito sa file. Isama ang kaugnay na mga pahina kapag naglilipat ng menu o automatic redirect sa bagong site. Papalitan ng target address ang sariling URL ng lumang SystemURL, ngunit hindi binabago ang external URL. Piliin din ang media kung ililipat ang mga larawan ng pahina.

Hanggang 128 MiB ang ZIP at 32 MiB ang JSON. Isaalang-alang ang PHP upload_max_filesize at post_max_size; kailangan ang ZIP extension. Kapag wala o hindi mabasa ang generated CSS/JS, lalaktawan ito ng export at magpapakita ng babala. Hindi kasama ang history, nakolektang Smarty variables, WHMCS accounts at secrets, o theme files. Gumagamit ang import ng kasalukuyang mga table at hindi gumagawa ng schema.

May kumpirmasyon bago ma-update ang record. Isinasagawa sa transaction ang database changes at ibinabalik ang napalitang file kung may error. Pinipigilan ng file lock ang sabayang import. Pagkatapos magtagumpay, buuin muli ang sitemap at subukan ang mga pampublikong URL.
