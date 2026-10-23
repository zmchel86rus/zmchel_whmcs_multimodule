# Smarty i variables

- **Configuració del mòdul → Recopila variables de Smarty → Utilitza les variables de Smarty recopilades → Editor de pàgines.**

Activeu les variables Smarty abans d'afegir un bloc. Useu només les variables permeses, escapeu els valors dinàmics i no mostreu dades personals; PHP i SQL no estan permesos.

## Catàleg de variables

Activeu la recopilació i l'ús de variables Smarty als paràmetres del mòdul; després visiteu les pàgines corresponents del lloc i actualitzeu l'editor. El catàleg desa noms, tipus i estructura de les variables, però no valors reals ni dades personals. Si falta una variable, torneu a visitar la pàgina on apareix.

## Editor i límits

Obriu el bloc Smarty a l'editor de pàgines i trieu variables del catàleg. Feu servir les condicions i els bucles permesos; afegiu `|escape` quan mostreu text dinàmic. PHP, SQL, crides a mètodes, inclusió de fitxers i `nofilter` no estan permesos. Deseu la pàgina i comproveu el resultat públic.

## resources/available_vars/

El catàleg només orienta sobre les variables observades en una pàgina: no les fa disponibles en una altra. El codi es valida en desar i abans de mostrar-lo; el bloc rep una còpia aïllada dels valors permesos. Es permeten condicions, `foreach`, `assign` local i modificadors com `escape`, `default`, `count` i `date_format`. Els valors de sortida s’escapen automàticament; escriviu l’HTML volgut a la plantilla. Si falten dades o el codi falla, el bloc queda buit i l’error s’anota al registre PHP.

El catàleg de `resources/available_vars/` desa noms, tipus, estructura i exemples artificials, però no valors reals. Indica on s'ha observat una variable sense fer-la disponible en una altra pàgina. Obriu l'editor fent doble clic al bloc Smarty. `Ctrl+Space` cerca variables, `Ctrl+S` aplica el codi i `F11` activa la pantalla completa. El codi s'executa aïlladament; si falten dades, el bloc queda buit i l'avís va al registre de PHP.

## foreach

```smarty
{foreach $your_list as $item}
    <span>{$item.title|escape}</span>
{/foreach}
```

## Instruccions

- **Recopila variables de Smarty** — Activa o desactiva la recopilació de variables de Smarty.
- **Utilitza les variables de Smarty recopilades** — Activa o desactiva l'ús de les variables de Smarty recopilades a l'editor de pàgines.
- Variable de Smarty (PHP)
- Smarty: es prohibeixen PHP, els mètodes d'objecte, les crides estàtiques i nofilter.
- La plantilla de Smarty és massa gran.
- Smarty
- Editor Smarty
