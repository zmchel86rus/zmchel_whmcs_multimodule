# Base de dades del mòdul

- **Base de dades del mòdul:** `MISSING` → Selecciona → Corregeix Elements seleccionats.
- **Suprimeix Elements seleccionats** — Aquesta acció no es pot desfer.

La pàgina **Base de dades del mòdul** mostra les taules i columnes necessàries i el seu estat. Només hi pot accedir el superadministrador designat. Obriu-la quan una altra secció indiqui que falta una taula o columna. Reviseu la llista, seleccioneu només els elements que cal reparar i feu clic a **Corregeix els seleccionats**. Algunes columnes no tenen reparació automàtica; torneu a comprovar l'estat després de l'operació.

**Suprimeix els seleccionats** elimina irreversiblement els objectes triats de la base de dades. Abans d'eliminar-los, exporteu les dades del mòdul i feu una còpia de seguretat de la base de dades.

## Instruccions

- Accés denegat. Només el superadministrador (ID …) pot utilitzar la pàgina Base de dades del mòdul.
- Corregeix
- Elements seleccionats
- Suprimeix
- Aquesta acció no es pot desfer.
- Encara no s'han creat les taules dels menús. Afegiu-les a Base de dades del mòdul.
- Afegiu primer la columna optimization_attempted al gestor de taules del mòdul.

## 1. Instal·lació i accés

Activeu el complement a WHMCS i doneu accés als administradors autoritzats. Comproveu les taules necessàries a la base de dades del mòdul. Reviseu els URL amigables, les rutes d'idioma i les ubicacions dels menús. Apache utilitza .htaccess; amb Nginx cal configurar les regles equivalents al servidor.
