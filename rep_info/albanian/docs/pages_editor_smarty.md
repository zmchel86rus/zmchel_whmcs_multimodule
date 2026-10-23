# Smarty

- **Cilësimet e modulit → Mblidh variablat Smarty → Përdor variablat Smarty të mbledhura → Redaktori i faqeve.**

## Katalogu i variablave

Aktivizoni mbledhjen dhe përdorimin e variablave Smarty te cilësimet e modulit, pastaj hapni faqet përkatëse të sajtit dhe rifreskoni redaktorin. Katalogu ruan emrat, llojet dhe strukturën e variablave, jo vlerat reale ose të dhënat personale. Nëse një variabël mungon, vizitoni sërish faqen ku ajo shfaqet.

## Redaktori dhe kufizimet

Hapni bllokun Smarty në redaktorin e faqeve dhe zgjidhni variablat nga katalogu. Përdorni kushtet dhe ciklet e lejuara; shtoni `|escape` kur shfaqni tekst dinamik. PHP, SQL, thirrjet e metodave, përfshirja e skedarëve dhe `nofilter` nuk lejohen. Ruajeni faqen dhe kontrolloni daljen publike.

## resources/available_vars/

Katalogu është vetëm udhëzues për variablat e vërejtura në faqe: nuk i sjell ato në një faqe tjetër. Kodi kontrollohet kur ruhet dhe para shfaqjes; blloku merr një kopje të izoluar të vlerave të lejuara. Mund të përdorni kushte, `foreach`, `assign` lokale dhe modifikues si `escape`, `default`, `count` e `date_format`. Vlerat dalëse escaped automatikisht; shkruani HTML-në e synuar në shabllon. Nëse mungojnë të dhënat ose kodi dështon, blloku mbetet bosh dhe gabimi regjistrohet në log-un PHP.

Katalogu në `resources/available_vars/` ruan emrat, llojet, strukturën dhe shembujt artificialë, jo vlerat reale. Ai tregon ku është parë variabla, por nuk e bën atë të disponueshme në faqe të tjera. Hapni redaktorin me klik të dyfishtë mbi bllokun Smarty. `Ctrl+Space` kërkon variabla, `Ctrl+S` zbaton kodin dhe `F11` hap ekranin e plotë. Kodi ekzekutohet i izoluar; nëse mungojnë të dhënat, blloku mbetet bosh dhe paralajmërimi shkon në regjistrin PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Udhëzime

- **Mblidh variablat Smarty** — Aktivizoni ose çaktivizoni mbledhjen e variablave Smarty.
- **Përdor variablat Smarty të mbledhura** — Aktivizoni ose çaktivizoni përdorimin e variablave Smarty të mbledhura në redaktorin e faqeve.
- Variabël Smarty (PHP)
- Smarty: PHP, metodat e objekteve, thirrjet statike dhe nofilter janë të ndaluara.
- Shablloni Smarty është shumë i madh.
- Smarty
- Redaktori Smarty

