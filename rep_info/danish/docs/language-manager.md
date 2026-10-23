# Sprogstyring

Sprogstyring lader dig redigere WHMCS' og modulernes sproglige tekster i administrationen. Funktionen er stadig under udvikling. Kun modulets superadministrator har adgang, og PHP skal kunne skrive i de relevante sprogmapper.

## Vælg område og sprog

Aktivér først de ønskede sprog under **Modulindstillinger → Understøttede sprog**. Vælg derefter **Sprogstyring → Områder** og åbn sprogfiler for WHMCS' klientdel eller administration, dette modul eller et andet fundet modul. Tabellen viser eksisterende, deaktiverede og tilføjelige sprog. Under **Sprog** kan du vælge en fil eller tilføje et manglende sprog. En ny fil henter i første omgang tekst fra et referencesprog; den er endnu ikke oversat. Markeringen for uoversat betyder, at filen ikke har egne oversættelser.

## Redigér oversættelser

Under **Oversættelser** viser **Original** teksten fra det valgte sprogs oprindelige fil uden dine ændringer. Når sproget ikke har egne tekster, hedder kolonnen **Reference**. Søg efter nøgle eller tekst, filtrér mellem alle, oprindelige og tilføjede nøgler, og gem hver række for sig. Du kan oprette en egen nøgle under en valgt sektion og senere omdøbe eller slette den. Nogle tredjepartsmoduler kan kun læses, hvis deres filformat ikke kan gemmes sikkert.

**Eksportér JSON** henter nøgler og oversættelser for det valgte område og sprog. **Importér JSON** opdaterer kun eksisterende nøgler. Ukendte og gentagne nøgler springes over og vises i resultatet. Behold område- og sprogidentifikatorer samt nøglestier. Uploadgrænsen er 8 MiB.

## Sprogfiler og standardsprog

Du kan deaktivere og genaktivere en sprogfil; den kan stadig redigeres, mens den er deaktiveret. Den engelske basisfil og WHMCS' aktuelle standardsprog kan ikke deaktiveres. For klient- og administratorsprog oprettet i WHMCS gemmer modulet kopier, som kan gendannes efter en WHMCS-opdatering. Hvis **Områder** viser en rettelse af filnavn, skal du kontrollere det nye navn og vælge **Ret**; rettelsen gælder de fundne områder.

Ved skift af standardsprog skal du først aktivere det nye sprog i modulindstillingerne, derefter ændre standardsproget i WHMCS og til sidst deaktivere det gamle. Kontrollér tekster i både administrationen og klientdelen.
