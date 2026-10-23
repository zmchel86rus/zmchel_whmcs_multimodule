# Importació i exportació

Exporteu les seccions necessàries abans de canvis importants. Després de la importació, reviseu pàgines, menús i fitxers multimèdia, apliqueu les regles de reescriptura per separat i regenereu el mapa. Això no substitueix una còpia de seguretat de WHMCS.

## JSON

L’exportació pot incloure pàgines i entrades amb traduccions, contingut, SEO i CSS/JS; menús amb jerarquia i ubicacions; configuració, redireccions, regles pròpies i fitxers de la mediateca. Se n’exclouen l’historial de revisions, les variables Smarty recollides, els comptes i secrets de WHMCS i els fitxers del tema. El JSON té un límit de 32 MiB; també s’apliquen `upload_max_filesize` i `post_max_size` de PHP. Per traslladar menús a un altre lloc, importeu també les pàgines i resoleu abans els noms de menú duplicats.

El fitxer d'exportació té el format `zmchel_whmcs_multimodule` (versió 1). En importar, els URL del lloc d'origen s'adapten al `SystemURL` del lloc de destinació; els enllaços externs es conserven. La importació no crea taules: prepareu-les abans a Base de dades del mòdul. Abans de començar es demana confirmació; els registres es canvien dins d'una transacció i els fitxers substituïts es restauren si hi ha un error.

## Instruccions

- Un únic fitxer JSON per a totes les seccions o només les seleccionades, de fins a 32 MiB (també s'apliquen els límits de pujada de PHP). Les pàgines coincidents s'actualitzen segons el slug i el tipus d'accés, i els menús segons el nom. La resta de registres es mantenen intactes. Incloeu les pàgines quan importeu menús a un lloc nou. S'ometran les seccions seleccionades que no estiguin incloses al fitxer.
- Els blocs CSS/JS s'inclouen amb les pàgines; les imatges i la resta de fitxers pujats, amb la biblioteca multimèdia. No s'exporten l'historial de revisions, les variables de Smarty recopilades ni els secrets de WHMCS. Torneu a generar el mapa del lloc després de la importació i apliqueu les regles de reescriptura al gestor de reescriptura.
- Pàgines i entrades (traduccions, contingut, SEO, configuració del mapa del lloc, blocs CSS/JS)
- Menús i ubicacions
- Configuració del mòdul, substitucions, capçalera/peu de pàgina, robots.txt
- Redireccions
- Regles de reescriptura personalitzades
- Biblioteca multimèdia (fitxers i descripcions)
- Els registres coincidents de les seccions seleccionades s'actualitzaran a partir del fitxer. Voleu continuar?
