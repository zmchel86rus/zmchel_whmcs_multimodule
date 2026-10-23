# Modulinställningar

## WHMCS

Välj vilka språk modulen kan använda. Att stänga av ett språk raderar inte innehållet. Om du använder snygga URL:er med Apache, uppdatera reglerna i Rewrite Manager när du ändrar språk.

- [Import och export](module_settings_transfer.md)

## Instruktioner

- **Läsbara URL:er** — Aktivera läsbara URL:er, inklusive system-URL:er.
- **Språkrouting** — Aktivera eller inaktivera språkspecifika sökvägar. När funktionen är aktiverad är sidor tillgängliga under /de/, /en/, /es/ och andra språkprefix som stöds. När den är inaktiverad visas innehåll på användarens inställda språk på en och samma sid-URL.
- **Rutt för standardspråk** — Ger standardspråket ett eget URL-prefix och omdirigerar modulsidor utan prefix dit.
- **Underhållsläge (modul)** — Aktivera eller inaktivera modulens underhållsläge. Det här mindre ingripande läget låter WHMCS-hooks och andra komponenter köras, till skillnad från systemets underhållsläge.
- **Samla in Smarty-variabler** — Aktivera eller inaktivera insamling av Smarty-variabler.
- **Använd insamlade Smarty-variabler** — Aktivera eller inaktivera användning av insamlade Smarty-variabler i sidredigeraren.
- **Sidåsidosättningar** — Aktivera eller inaktivera sidåsidosättningar.
- **Uppdateringsfrekvens** — Om inget väljs uppdateras webbplatskartan dagligen.
- **HTML-webbplatskarta** — När funktionen är aktiverad visas webbplatskartan på /html-sitemap som en vanlig HTML-sida; sitemap.xml påverkas inte.
- **Webbplatsens sidhuvud** — Anpassad HTML för avsnittet \<head>, inklusive \<script> och \<style>.
- **Webbplatsens sidfot** — Anpassad HTML före \</body>, inklusive \<script> och \<style>.
- **Redigera robots.txt**
