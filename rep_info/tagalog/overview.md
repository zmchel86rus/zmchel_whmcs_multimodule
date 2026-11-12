# Libreng multimodule para sa WHMCS

**Libre ang zmchel WHMCS Multimodule.** Mula sa WHMCS admin, maaari kang mag-edit ng pahina at block, gumawa ng maraming wika, menu, media, SEO metadata, XML sitemap, redirect, rewrite rules, at mag-import o mag-export ng data. Basahin ang [gabay](instruction.md) para sa araw-araw na paggamit.

## Bago unang gamitin

**Buksan ang Module settings → Supported languages at paganahin ang mga wikang kailangan mo.**

Tuwing ina-activate ang module, gumagawa ito ng bagong ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT, at ZM_PB_NONCE_SALT sa module_init.php. Suriing may laman ang tatlo.

Binuo at sinubok ang module sa **WHMCS 8.13.0–9.1.0**. **Ganap na suportado ang Apache (100%)**. Maaari ring gumana sa Nginx, ngunit maaaring kailanganin ang dagdag na configuration at pagsubok para sa home page language routing.

**Nasuring PHP compatibility:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, at 8.5. Nakapasa sa syntax check ang lahat ng PHP file at pinatakbo rin ang standalone tests.

## Mga plano sa hinaharap

- Magdagdag ng nested pages at kategorya o seksyon ng pahina.
- Hatiin ang kasalukuyang monolith sa mga magkakaugnay na component.
- Gumawa ng tagapamahala ng karapatan sa admin ng module.
- Palawakin ang default na talaan ng wika sa supported_langs.php.
- Magdagdag ng code editor para sa mga .tpl ng module at client theme ng WHMCS, hindi para sa admin theme.
- ~~Magdagdag ng language manager para sa module, iba pang module, at WHMCS.~~
- Pagbutihin ang media manager.
- Gumawa ng mas mahusay na kumpletong SEO manager na hango sa Yoast SEO.
- ~~Magdagdag ng multilingual sitemap generation at HTML sitemap page.~~
- Magdagdag ng HTML sitemap page.
- Magdagdag ng usage statistics sa page manager.
- Gumawa ng optimization manager para sa JS/CSS/HTML minification, full-page cache, at module at WHMCS table optimization.
- Magdagdag ng maayos na module update system.

Mga **ideya ito para sa hinaharap, hindi nakapirming roadmap**.

## Magmungkahi ng ideya

[Magpadala ng mungkahi](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) na may paksang «Предложение по мультимодулю».

## Magtanong

[Magpadala ng tanong](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) na may paksang «Задать вопрос по модулю».
