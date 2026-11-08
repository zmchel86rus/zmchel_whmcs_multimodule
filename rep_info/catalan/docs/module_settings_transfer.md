# Importació i exportació

Exporteu les seccions necessàries abans de canvis importants. Després de la importació, reviseu pàgines, menús i fitxers multimèdia, apliqueu les regles de reescriptura per separat i regenereu el mapa. Això no substitueix una còpia de seguretat de WHMCS. La importació també admet fitxers JSON.

## ZIP

L’exportació pot incloure pàgines i entrades amb traduccions, contingut, SEO i CSS/JS; menús amb jerarquia i ubicacions; configuració, redireccions, regles pròpies i fitxers de la mediateca. Se n’exclouen l’historial de revisions, les variables Smarty recollides, els comptes i secrets de WHMCS i els fitxers del tema. El ZIP té un límit de 128 MiB; també s’apliquen `upload_max_filesize` i `post_max_size` de PHP. Per traslladar menús a un altre lloc, importeu també les pàgines i resoleu abans els noms de menú duplicats.

El fitxer d'exportació té el format `zmchel_whmcs_multimodule` (versió 2). En importar, els URL del lloc d'origen s'adapten al `SystemURL` del lloc de destinació; els enllaços externs es conserven. La importació no crea taules: prepareu-les abans a Base de dades del mòdul. Abans de començar es demana confirmació; els registres es canvien dins d'una transacció i els fitxers substituïts es restauren si hi ha un error.
