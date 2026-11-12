# Bladsyredigeerder

Die redigeerder open nadat jy 'n bladsy in [Bladsybestuurder](pages_manager.md) geskep het. Daar is afsonderlike oortjies vir hoofinstellings, inhoud, metadata en sitemap. Kies 'n aktiewe taal voordat jy vertaalde inhoud wysig. Elke oortjie het sy eie stoorknoppie; **Save all** stoor die afdelings saam. Besoek die openbare bladsy om die resultaat na te gaan.

## Hoofinstellings

Kontroleer die naam, slug, tipe, status, toegangsmodus en aktiewe tale. 'n Gepubliseerde bladsy benodig steeds inhoud in die taal wat jy wil wys. As die WHMCS-verstektaal nie deur die module geaktiveer is nie, skakel dit in Module settings aan voordat jy stoor. Sien ook of 'n taalvertaling aktief is voordat jy 'n ontbrekende openbare roete ondersoek.

## Inhoud

Kies 'n taal, sleep GrapesJS-blokke op die doek en kies 'n blok om sy eienskappe te redigeer. Verrykte teks gebruik TinyMCE. Sections, columns, Flex en Grid bepaal uitleg. Taalgereedskap kan inhoud of struktuur na 'n ander taal kopieer, maar vertaal die teiken voordat jy publiseer. Lees die afsonderlike gidse oor [paginering en filters](pages_editor_pagination.md), [Smarty](pages_editor_smarty.md) en [gestruktureerde data](module_structured_data.md).

## Metadata en sitemap

Gee elke taal sy eie titel en beskrywing. Kontroleer canonical, robots, sosiale metadata, breadcrumbs en die Schema-tipe waar nodig. Stel in die sitemap-oortjie veranderingsfrekwensie en prioriteit vir 'n gepubliseerde nie-stelselbladsy in. Die [Sitemapbestuurder](sitemap_manager.md) skep die XML-lêers.

## Kontakvorm

Voeg 'n **Contact Form**-blok by. Kies 'n WHMCS-ticket met ondersteuningsafdeling of 'n email met ontvanger. Stel opskrif, onderwerp, knoppie, veldname, vereiste velde en validering op. Vir gaskaartjies moet naam en e-pos as afsenderrolle toegeken wees. Plaas een keuselysopsie per reël en gebruik afsonderlike velde vir verskillende toestemmings. Gebruik die CAPTCHA wat WHMCS ingestel het. Stuur self 'n toets as gas; 'n groen redigeerderstatus bewys nie aflewering nie. Stel WHMCS SMTP op indien PHP mail() misluk.
