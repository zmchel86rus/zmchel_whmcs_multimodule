# Gestor d'idiomes

El Gestor d'idiomes permet editar els textos d'idioma de WHMCS i dels mòduls des de l'administració. Aquesta funció encara està en desenvolupament. Només hi pot treballar el superadministrador del mòdul, i PHP necessita permís d'escriptura als directoris corresponents.

## Triar una secció i un idioma

Activeu primer els idiomes necessaris a **Configuració del mòdul → Idiomes admesos**. A **Gestor d'idiomes → Seccions**, trieu els idiomes de la part client o administrativa de WHMCS, d'aquest mòdul o d'un altre mòdul detectat. La taula mostra quants idiomes hi ha, quants estan desactivats i quants es poden afegir. A **Idiomes**, seleccioneu un fitxer existent o afegiu-ne un de nou. El fitxer nou pren els textos d'un idioma de referència: això no vol dir que ja estigui traduït. La marca de no traduït indica que encara no té traduccions pròpies.

## Editar i intercanviar traduccions

A **Traduccions**, **Original** mostra el text real del fitxer d'origen de l'idioma seleccionat, sense els canvis de l'usuari. Si encara no hi ha traducció pròpia, la columna es diu **Referència**. Cerqueu per clau o text, filtreu entre totes les claus, les originals i les afegides, i deseu cada fila per separat. Podeu afegir una clau personalitzada dins de la secció escollida i després canviar-ne el nom o suprimir-la. Alguns catàlegs de tercers només es poden consultar si el seu format no es pot desar amb seguretat.

**Exportar JSON** descarrega les claus i traduccions de la secció i l'idioma seleccionats. **Importar JSON** només actualitza claus existents; les desconegudes i les repetides s'ometen i apareixen al resultat. Manteniu els identificadors de secció i idioma i les rutes de les claus. El fitxer pot tenir com a màxim 8 MiB.

## Fitxers i idioma predeterminat

Podeu desactivar i tornar a activar un fitxer d'idioma; encara es pot editar quan està desactivat. L'anglès base i l'idioma predeterminat actual de WHMCS estan protegits. Per als idiomes de client i administrador de WHMCS afegits pel gestor, es desen còpies que permeten restaurar-los després d'una actualització. Si a **Seccions** apareix una correcció de nom de fitxer, reviseu el nom nou i premeu **Corregir**; afecta totes les seccions detectades.

Per canviar l'idioma predeterminat, activeu primer el nou idioma a la configuració del mòdul, canvieu després el valor predeterminat de WHMCS i finalment desactiveu l'antic. Comproveu els textos tant a l'administració com a la part client.
