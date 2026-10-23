# Faqëzimi

Për Smarty, jepni variablën e listës së plotë. Pa variabël, faqosen elementet HTML të kontejnerit; sipas nevojës, specifikoni një klasë rreshti ose etiketën tr. Lidhjet ruajnë count, sort dhe filtrat. Mbështeten disa lista të pavarura.

Tërhiqni përzgjedhësin e numrit të elementeve për faqe brenda faqosjes ose në blloqe të tjera të faqes. Ai mbetet i lidhur me këtë faqosje.

Përcaktoni variablën e listës së plotë. Kërkimi përputhet me cilëndo nga fushat e zgjedhura; filtrat kombinohen. Kushtet zbatohen përpara numërimit të faqeve; zbatimi ose rivendosja ju kthen në faqen e parë. Nëse faqosja është e lidhur tashmë, përdoret variabla e saj.

## Lidhjet dhe burimi i listës

Vendoseni faqëzimin jashtë bllokut të listës dhe zgjidhni atë bllok si objektiv. Për një listë Smarty, jepni variablën që përmban të gjithë elementet; përndryshe ndahen elementet HTML të kontejnerit. Zgjidhni formatin e lidhjes sipas cilësimit të modulit, `/page/2/` ose `?page=2`. Formati me shteg kërkon rregulla rewrite. Listat e pavarura përdorin parametra të veçantë; lidhjet ruajnë gjuhën, filtrat dhe renditjen.

## Madhësia e faqes, SEO dhe filtrat

Përcaktoni numrin e elementeve dhe, nëse duhet, aktivizoni përzgjedhësin 10/25/50/100/250. Zgjedhja e një madhësie tjetër e kthen listën në faqen e parë. Opsioni noindex zbatohet vetëm nga faqja e dytë e tutje; kontrolloni titullin dhe URL-në kanonike. Lidhni filtrat me të njëjtën listë, pastaj testoni faqen e dytë dhe një vlerë filtri në faqen publike.

## page / count / pager

Për listën Smarty vendosni ndryshoren që përmban të gjitha elementet dhe mbajeni ciklin `{foreach}`: moduli e ndan listën, ndaj mos shtoni `array_slice` të dytë. Pa ndryshore, ndahen elementet HTML të kontejnerit; mund të caktoni klasën ose etiketën `tr`, ndërsa `thead` dhe `tfoot` mbeten në vend. Numrin e butonave pranë faqes aktuale caktojeni veç për kompjuter dhe celular. Në rrugët e drejtpërdrejta PHP përdorni `?page=2`; rruga `/page/2/` kërkon rregulla rewrite. Faqet pas së parës kanë canonical të vetin dhe mund të marrin `noindex`.

Kur ka disa lista të pavarura, e para përdor parametrat `page`, `count` dhe `sort`; të tjerat marrin parametra me ID-në e bllokut. Me rrugën `/page/N/`, `pager` tregon cilës listë i përket numri. Në bllokun Smarty, `$zm_pagination` jep `total`, `page`, `pages`, `count` dhe `offset`. Vlera `count` kufizohet në 10–250. Kur lista është bosh ose ka vetëm një faqe, paneli i faqëzimit fshihet në faqen publike.

## YYYY-MM-DD

Filtrat punojnë mbi të njëjtën listë si faqëzimi. Kërkimi tekstual mund të kontrollojë disa fusha të ndara me presje; intervali i datave përdor `YYYY-MM-DD` dhe përfshin tërë ditën e fundit.

## Flex / Grid

Për paraqitjen zgjidhni Flex ose Grid dhe rregulloni gjerësitë e kolonat sipas pajisjes. Zbatimi ose heqja e filtrave kthen listën në faqen e parë. Zgjedhësi i numrit të rezultateve mund të zhvendoset pa humbur lidhjen me panelin; një panel i dyfishuar kontrollon po të njëjtën listë.

## Udhëzime

- Klikoni bllokun e listës. Esc anulon. Vendoseni faqosjen jashtë bllokut të synuar.
- Përzgjedhësi i elementeve për faqe: 10, 25, 50, 100, 250
- Mos indekso faqen 2 e tutje
- Zgjidhni bllokun e listës Smarty. Kërkimi dhe faqosja duhet të lidhen me të njëjtin bllok.
- Formati i lidhjeve
- Numri i parazgjedhur i elementeve për faqe
