# Editor de pàgines

- [Paginació i filtres](pages_editor_pagination.md)
- [Smarty i variables](pages_editor_smarty.md)
- [Dades estructurades](module_structured_data.md)

## 3. Edició del contingut

Per a cada idioma, ompliu les pestanyes Contingut, Metadades i Mapa del lloc. Arrossegueu blocs a l'editor, modifiqueu textos i imatges i deseu cada pestanya. Copiar amb contingut proporciona una base; copiar l'estructura prepara la disposició per traduir-la. El text no es tradueix automàticament.

## 4. Enllaços i publicació

Activeu l'opció d'afegir l'idioma actual a l'URL per als enllaços a pàgines traduïdes del mòdul. Desactiveu-la per a URL externs, correu electrònic i rutes de WHMCS sense versió lingüística. Després de publicar, comproveu la pàgina com a visitant i com a client, en mòbil i ordinador, i en dos idiomes.

## SEO

A la configuració principal comproveu el nom, slug, tipus, estat, accés i idiomes. L'idioma predeterminat de WHMCS ha d'estar activat al mòdul; una pàgina publicada necessita contingut en l'idioma mostrat. Per a cada idioma definiu títol i descripció i reviseu canonical, robots, Open Graph, fil d'Ariadna i Schema. A la pestanya del mapa del lloc trieu freqüència i prioritat per a una pàgina pública no sistèmica. Deseu i comproveu l'URL i l'XML públics.

## Formulari de contacte

Afegiu el bloc **Formulari de contacte**. Trieu **tiquet WHMCS** i departament de suport, o **correu electrònic** i destinatari; definiu títol, descripció, assumpte i text del botó. Per a cada camp indiqueu nom, tipus, obligatorietat i validació. Un tiquet de visitant necessita camps amb els rols de nom i correu del remitent. A la llista desplegable, escriviu una opció per línia, per exemple `sales : Vendes`. Creeu un camp separat per a cada consentiment i useu el CAPTCHA configurat a WHMCS. Deseu i envieu una prova real com a visitant; comproveu tiquet o lliurament, errors i reinici del formulari. L'estat verd de l'editor no confirma el lliurament; si falla `mail()`, configureu SMTP a WHMCS.

## Instruccions

- Contenidor flex imbricat. Arrossegueu-hi altres blocs a dins.
- Contenidor CSS Grid imbricat. Arrossegueu-hi altres blocs a dins.
- Carrusel Bootstrap imbricat. Arrossegueu-hi blocs a dins; cadascun es converteix en una diapositiva.
- Tots els blocs situats a sota d'aquest bloc només es mostren als usuaris amb sessió iniciada. Només funciona quan el tipus d'accés de la pàgina és Mixt.
- Tots els blocs situats a sota d'aquest bloc només es mostren als visitants. Només funciona quan el tipus d'accés de la pàgina és Mixt.
- **Títol de la pàgina**
- **Metadescripció**
- **URL canònic**
- **Robots** — index, follow / noindex, nofollow. Controla la indexació.
- **Tipus de Schema** — Quan està desactivat, no es genera el marcatge JSON de Schema.org per a aquesta pàgina.
