# Impostazioni del modulo

## WHMCS

Scegli le lingue utilizzabili dal modulo. Disattivare una lingua non ne elimina i contenuti. Se usi URL semplificati con Apache, aggiorna le regole nel Rewrite Manager dopo aver modificato le lingue.

- [Importazione ed esportazione](module_settings_transfer.md)

## Istruzioni

- **URL leggibili** — Abilita gli URL leggibili, inclusi quelli di sistema.
- **Instradamento delle lingue** — Attiva o disattiva gli URL specifici per lingua. Quando è attivo, le pagine sono disponibili sotto /de/, /en/, /es/ e altri prefissi delle lingue supportate. Quando è disattivato, un unico URL mostra il contenuto nella lingua configurata dall’utente.
- **Percorso della lingua predefinita** — Aggiunge un prefisso alla lingua predefinita e vi reindirizza le pagine del modulo senza prefisso.
- **Modalità manutenzione (modulo)** — Attiva o disattiva la modalità manutenzione del modulo. Questa modalità meno restrittiva consente il funzionamento degli hook WHMCS e degli altri componenti, a differenza della modalità manutenzione di sistema.
- **Raccogli variabili Smarty** — Attiva o disattiva la raccolta delle variabili Smarty.
- **Usa le variabili Smarty raccolte** — Attiva o disattiva l’utilizzo delle variabili Smarty raccolte nell’editor delle pagine.
- **Sostituzioni delle pagine** — Attiva o disattiva le sostituzioni delle pagine.
- **Frequenza di aggiornamento** — Se non viene selezionato nulla, la sitemap viene aggiornata ogni giorno.
- **Sitemap HTML** — Quando è attiva, /html-sitemap mostra la sitemap come una normale pagina HTML; sitemap.xml non viene modificato.
- **Intestazione del sito** — HTML personalizzato per la sezione \<head>, inclusi \<script> e \<style>.
- **Piè di pagina del sito** — HTML personalizzato prima di \</body>, inclusi \<script> e \<style>.
- **Modifica robots.txt**
