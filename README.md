[![License: GPL v2](https://img.shields.io/badge/License-GPL_v2-lightgreen.svg?style=for-the-badge)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
[![WHMCS](https://img.shields.io/badge/WHMCS-8.0%2B-blue.svg?style=for-the-badge)](https://www.whmcs.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg?style=for-the-badge)](https://www.php.net/)

# ZMChel WHMCS Multimodule — free page builder and site tools for WHMCS

**ZMChel WHMCS Multimodule** is a free add-on for WHMCS. It combines a visual page builder with multilingual pages, menus, a media library, SEO fields, XML sitemaps, redirects and rewrite management. It is intended for site owners who want to manage content from the WHMCS admin area.

**Before use:** generate unique salts and put them in `module_init.php` (`ZM_PB_ADMIN_SALT`, `ZM_PB_SECURE_SALT`, `ZM_PB_NONCE_SALT`). The module was developed and tested on **WHMCS 8.13.1–8.13.7** and has **full Apache support (100%)**. It can also work with Nginx, but language routing on the home page may need additional configuration and testing.

**PHP compatibility checked:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, and 8.5. All PHP files passed syntax checks on each version; standalone tests were also run.

**Before first use:** open Module settings → Supported languages and enable the languages you need. On activation, the module enables the WHMCS default language automatically; all other languages start disabled.

**Language Manager (in development):** In the WHMCS admin area, select a language section and edit translations one row at a time, or export and import existing keys as JSON. New language files use the reference until translated. The manager can enable or disable language files and correct legacy filenames. To change the default language, enable the replacement in Module settings, change the WHMCS default, then disable the old language.

**Activation report:** On activation, the module sends the WHMCS `SystemURL` domain and `module_start_using: true`. The receiver also records the connecting IP address. The report is encrypted before transmission and sent over HTTPS. Delivery is best effort and does not affect module activation. This report is solely to let the author know that someone is using the module. The module does not display any copyright notices or information about its use on your website.

## Instructions / Инструкции

| Language | Instructions |
| --- | --- |
| English | [Instructions](rep_info/english/instruction.md) |
| Bahasa Indonesia | [Petunjuk](rep_info/indonesian/instruction.md) |
| Kiswahili | [Maelekezo](rep_info/swahili/instruction.md) |
| Tiếng Việt | [Hướng dẫn](rep_info/vietnamese/instruction.md) |
| Bahasa Melayu | [Panduan](rep_info/malay/instruction.md) |
| O‘zbekcha | [Yo‘riqnoma](rep_info/uzbek/instruction.md) |
| Azərbaycanca | [Təlimat](rep_info/azerbaijani/instruction.md) |
| Қазақша | [Нұсқаулық](rep_info/kazakh/instruction.md) |
| Íslenska | [Leiðbeiningar](rep_info/icelandic/instruction.md) |
| Беларуская | [Інструкцыя](rep_info/belarusian/instruction.md) |
| Shqip | [Udhëzime](rep_info/albanian/instruction.md) |
| Gaeilge | [Treoracha](rep_info/irish/instruction.md) |
| Русский | [Инструкция](rep_info/russian/instruction.md) |
| Deutsch | [Anleitung](rep_info/german/instruction.md) |
| Español | [Instrucciones](rep_info/spanish/instruction.md) |
| Українська | [Інструкція](rep_info/ukrainian/instruction.md) |
| Français | [Instructions](rep_info/french/instruction.md) |
| Português (Portugal) | [Instruções](rep_info/portuguese-pt/instruction.md) |
| Português (Brasil) | [Instruções](rep_info/portuguese-br/instruction.md) |
| Italiano | [Istruzioni](rep_info/italian/instruction.md) |
| Hrvatski | [Upute](rep_info/croatian/instruction.md) |
| Čeština | [Návod](rep_info/czech/instruction.md) |
| Eesti | [Juhend](rep_info/estonian/instruction.md) |
| Norsk (bokmål) | [Bruksanvisning](rep_info/norwegian/instruction.md) |
| Svenska | [Instruktioner](rep_info/swedish/instruction.md) |
| Türkçe | [Talimatlar](rep_info/turkish/instruction.md) |
| Magyar | [Útmutató](rep_info/hungarian/instruction.md) |
| Nederlands | [Handleiding](rep_info/dutch/instruction.md) |
| Dansk | [Vejledning](rep_info/danish/instruction.md) |
| Македонски | [Упатство](rep_info/macedonian/instruction.md) |
| Română | [Instrucțiuni](rep_info/romanian/instruction.md) |
| Català | [Instruccions](rep_info/catalan/instruction.md) |
| Suomi | [Ohjeet](rep_info/finnish/instruction.md) |
| Polski | [Instrukcja](rep_info/polish/instruction.md) |
| Български | [Инструкции](rep_info/bulgarian/instruction.md) |
| Српски | [Упутство](rep_info/serbian/instruction.md) |
| Lietuvių | [Instrukcija](rep_info/lithuanian/instruction.md) |
| Latviešu | [Instrukcija](rep_info/latvian/instruction.md) |
| Slovenščina | [Navodila](rep_info/slovenian/instruction.md) |
| Slovenčina | [Návod](rep_info/slovak/instruction.md) |

## Module overview / Общее описание

| Language | Overview |
| --- | --- |
| English | [Overview](rep_info/english/overview.md) |
| Bahasa Indonesia | [Gambaran umum](rep_info/indonesian/overview.md) |
| Kiswahili | [Muhtasari](rep_info/swahili/overview.md) |
| Tiếng Việt | [Tổng quan](rep_info/vietnamese/overview.md) |
| Bahasa Melayu | [Gambaran keseluruhan](rep_info/malay/overview.md) |
| O‘zbekcha | [Umumiy ma’lumot](rep_info/uzbek/overview.md) |
| Azərbaycanca | [Ümumi məlumat](rep_info/azerbaijani/overview.md) |
| Қазақша | [Шолу](rep_info/kazakh/overview.md) |
| Íslenska | [Yfirlit](rep_info/icelandic/overview.md) |
| Беларуская | [Агляд](rep_info/belarusian/overview.md) |
| Shqip | [Përmbledhje](rep_info/albanian/overview.md) |
| Gaeilge | [Forbhreathnú](rep_info/irish/overview.md) |
| Русский | [Описание](rep_info/russian/overview.md) |
| Deutsch | [Beschreibung](rep_info/german/overview.md) |
| Español | [Descripción](rep_info/spanish/overview.md) |
| Українська | [Опис](rep_info/ukrainian/overview.md) |
| Français | [Présentation](rep_info/french/overview.md) |
| Português (Portugal) | [Descrição](rep_info/portuguese-pt/overview.md) |
| Português (Brasil) | [Descrição](rep_info/portuguese-br/overview.md) |
| Italiano | [Descrizione](rep_info/italian/overview.md) |
| Hrvatski | [Opis](rep_info/croatian/overview.md) |
| Čeština | [Popis](rep_info/czech/overview.md) |
| Eesti | [Ülevaade](rep_info/estonian/overview.md) |
| Norsk (bokmål) | [Oversikt](rep_info/norwegian/overview.md) |
| Svenska | [Översikt](rep_info/swedish/overview.md) |
| Türkçe | [Genel bakış](rep_info/turkish/overview.md) |
| Magyar | [Áttekintés](rep_info/hungarian/overview.md) |
| Nederlands | [Overzicht](rep_info/dutch/overview.md) |
| Dansk | [Oversigt](rep_info/danish/overview.md) |
| Македонски | [Преглед](rep_info/macedonian/overview.md) |
| Română | [Prezentare generală](rep_info/romanian/overview.md) |
| Català | [Descripció general](rep_info/catalan/overview.md) |
| Suomi | [Yleiskuvaus](rep_info/finnish/overview.md) |
| Polski | [Opis](rep_info/polish/overview.md) |
| Български | [Общ преглед](rep_info/bulgarian/overview.md) |
| Српски | [Преглед](rep_info/serbian/overview.md) |
| Lietuvių | [Apžvalga](rep_info/lithuanian/overview.md) |
| Latviešu | [Pārskats](rep_info/latvian/overview.md) |
| Slovenščina | [Pregled](rep_info/slovenian/overview.md) |
| Slovenčina | [Prehľad](rep_info/slovak/overview.md) |

## Suggest an idea
Suggest an idea / Предложить идею

Send feedback or a feature suggestion to [ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%9F%D1%80%D0%B5%D0%B4%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B5%20%D0%BF%D0%BE%20%D0%BC%D1%83%D0%BB%D1%8C%D1%82%D0%B8%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) (subject: «Предложение по мультимодулю»).

## Ask a question
Ask a question / Задать вопрос

Have a question about the module? [Email ackirkin@gmail.com](mailto:ackirkin@gmail.com?subject=%D0%97%D0%B0%D0%B4%D0%B0%D1%82%D1%8C%20%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%20%D0%BF%D0%BE%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8E) (subject: «Задать вопрос по модулю»).

## Support the project / Поддержать проект

The module is free. If it helps your site, you can support its development. Wallet addresses will be added here.

| Currency | Wallet address |
| --- | --- |
| USDT (TRC20) | `TSBMvPqZkVVA1eYSHuLDGgSx6XxhGYLCmr` |
| Bitcoin (BTC) | `bc1qkfphgxuz4wdvyqgutkc3evl6zw5x7qxwg6clwz` |
| Litecoin (LTC) | `LYtWMEk2wuxCCKBFiRasazGZbFsBWHkxWM` |
| Ethereum (ETH) | `0x20DF9883AA016E5387280827328667806C0562B1` |
| Dogecoin (DOGE) | `DEvhmmtp2p9QyyPRazndxFvuLgptR5Tr3p` |
