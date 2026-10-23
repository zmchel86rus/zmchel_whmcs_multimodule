# Redaktori i faqeve

- [faqëzimi](pages_editor_pagination.md)
- [Smarty](pages_editor_smarty.md)
- [të dhënat e strukturuara](module_structured_data.md)

## Redaktori dhe gjuhët

Zgjidhni gjuhën në skedën e përmbajtjes, tërhiqni blloqet GrapesJS në hapësirën e punës dhe ndryshoni tekstin, figurat dhe cilësimet. Ka seksione, kolona, tabela, FAQ, formular kontakti, lista, faqëzim dhe zona për vizitorë ose anëtarë. Mund të kopjoni strukturën në një gjuhë tjetër dhe të përktheni tekstin para publikimit. Blloqet e lidhjeve dhe butonave mund t'i shtojnë gjuhën aktuale URL-së së brendshme; çaktivizojeni për lidhje të jashtme, skedarë, `mailto:` dhe rrugë WHMCS pa përkthim.

Me URL të bukura dhe rrugëzim gjuhësh aktiv, gjuha kryesore përdor rrugë të shkurtër si `/sq/`, ose pa prefiks nëse rruga e gjuhës së parazgjedhur është çaktivizuar. Variantet rajonale përdorin locale BCP 47. Testoni lidhjet në disa gjuhë.

## WHMCS

Te cilësimet kryesore kontrolloni emrin, slug-un, llojin, gjendjen, qasjen dhe gjuhët. Gjuha e parazgjedhur e WHMCS duhet të jetë e aktivizuar te gjuhët e modulit; faqja e publikuar duhet të ketë përmbajtje në gjuhën që shfaqet.

## SEO

Për çdo gjuhë plotësoni titullin dhe përshkrimin, pastaj kontrolloni canonical, robots, Open Graph, breadcrumb dhe Schema. Në skedën e hartës zgjidhni frekuencën dhe përparësinë për faqen publike jo-sistemore. Ruajeni dhe kontrolloni URL-në dhe XML-në publike.

## Formular kontakti

Shtoni bllokun **Formular kontakti**. Zgjidhni **tiket WHMCS** dhe departament mbështetjeje, ose **email** dhe marrës; plotësoni titullin, përshkrimin, subjektin dhe butonin. Jepini çdo fushe emër, lloj, detyrim dhe kontroll. Tiketat nga vizitorët kërkojnë fusha për emrin dhe email-in e dërguesit. Për listën zbritëse shkruani një zgjedhje për rresht, p.sh. `sales : Shitje`. Krijoni fusha të veçanta për çdo pëlqim dhe përdorni CAPTCHA e WHMCS. Ruani dhe dërgoni një provë si vizitor; kontrolloni tiketën ose email-in, gabimet dhe pastrimin e formularit. Shenja jeshile e redaktorit nuk provon dorëzimin; nëse `mail()` dështon, konfiguroni SMTP në WHMCS.

## Udhëzime

- Kontejner i futur me strukturë Flex. Tërhiqni blloqe të tjera brenda tij.
- Kontejner i futur CSS Grid. Tërhiqni blloqe të tjera brenda tij.
- Karusel i futur Bootstrap. Tërhiqni blloqet brenda tij; secili bëhet një diapozitiv.
- Të gjitha blloqet poshtë këtij blloku shfaqen vetëm për përdoruesit e identifikuar. Funksionon vetëm kur lloji i qasjes në faqe është I përzier.
- Të gjitha blloqet poshtë këtij blloku shfaqen vetëm për vizitorët. Funksionon vetëm kur lloji i qasjes në faqe është I përzier.
- **Titulli i faqes**
- **Përshkrimi meta**
- **URL kanonike**
- **Robotët** — index, follow / noindex, nofollow. Kontrollon indeksimin.
- **Lloji i skemës** — Kur çaktivizohet, shënimi JSON i Schema.org nuk shfaqet për këtë faqe.
