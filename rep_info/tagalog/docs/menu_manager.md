# Menu Manager

Sinusuportahan ng menu_manager ang maraming hiwalay na menu, paghahanap ng pahina at artikulo, custom link, at heading na may # URL. I-drag ang mga item upang baguhin ang pagkakasunod at magtakda ng parent para sa nesting. May label at mga salin, title, description, CSS classes, rel, icon, bagong tab, at guest o client visibility ang bawat item. Maaaring kusang idagdag ang bagong published na pahina. Maaaring palawakin o palitan ang WHMCS navigation sa desktop, mobile, o pareho.

## Lokasyon at switch

Ang WHMCS locations na ClientAreaPrimaryNavbar, ClientAreaSecondaryNavbar, ClientAreaPrimarySidebar, at ClientAreaSecondarySidebar ay kontrolado ng ZM_PB_ENABLE_MAINNAV, ZM_PB_ENABLE_SECONDARYNAV, ZM_PB_ENABLE_MAINSIDEBAR, at ZM_PB_ENABLE_SECONDARYSIDEBAR. Hindi nilo-load ang handler ng nakapatay na lokasyon. Kapag walang aktibong nakatalaga, hindi nagbabago ang likas na WHMCS menu. Iisang menu ang nasa bawat lokasyon, pero maaaring lumabas ang parehong menu sa marami. Kapag inilipat sa ibang menu ang okupadong lokasyon, mawawala ang dati nitong assignment.

## Wika at access

Sa karaniwang system route ng WHMCS, ang naka-save na wika ng user ang ginagamit sa label. Sa module page, wika ng URL ang ginagamit at hindi binabago ang profile. Para sa custom link, maaaring iwan ng **Link URL language** ang URL nang walang pagbabago habang isinasalin ang label. Nasa zm_pb_menu_items.localize_url ang setting. Binubuo muli ang URL ng page item mula sa kasalukuyang slug, published na salin, at pretty URL setting. Ang plain URL ay ?m=zmchel_whmcs_multimodule&slug=...&lang=.... Kung walang label, gagamit ng breadcrumb, meta title, o pangalan. Hindi ipinapakita ang draft, deleted, o ipinagbabawal na pahina. Walang language prefix ang external URL, mailto, tel, at anchor.

## Mga table at code

Ang zm_pb_menus ay para sa setting, zm_pb_menu_items para sa hierarchy, at zm_pb_menu_locations para sa lokasyon. Sa Module database ginagawa ang paglikha at pag-ayos ng schema; mga record lamang ang binabago ng menu manager. Kapag binura ang parent, umaakyat sa antas nito ang mga anak. Hanggang 10 antas at 300 item ang isang menu; gumagamit ng isang transaction ang pag-save. Subukan ang huling resulta sa mobile at desktop, bilang bisita at customer.
