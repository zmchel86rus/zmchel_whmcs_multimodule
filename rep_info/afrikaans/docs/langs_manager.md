# Taalbestuurder

Taalbestuurder wysig vertalings van WHMCS, hierdie module en ander ontdekte modules. Die module se Super Administrator en skryftoegang tot die betrokke taalgidse is nodig. Die werkvloei is Sections → Languages → Translations; elke **Save**-knoppie stoor slegs een vertaling.

## Begin

Aktiveer die tale wat jy nodig het in Module settings → Supported languages. Daardie lys bepaal watter tale die bestuurder kan byvoeg en watter tale modulebladsye mag gebruik. Kies die WHMCS-kliënt- of administrasieafdeling, hierdie module of 'n ander ontdekte module. Die tabel wys bestaande, gedeaktiveerde en beskikbare tale. 'n Pas bygevoegde taal gebruik eers verwysingstekste en is nog nie 'n voltooide vertaling nie. Die **Untranslated**-kenteken merk 'n katalogus sonder eie vertalings.

## Wysig vertalings

Die **Original**-kolom wys die gekose taal se oorspronklike lêer, sonder override-wysigings. Wanneer daar geen oorspronklike vertaling is nie, wys **Reference** die basistaal. Soek volgens sleutel of teks en filtreer oorspronklike of bygevoegde sleutels; lang lyste het bladsye. Stoor elke ry apart. Jy kan 'n eie sleutel onder 'n gekose ouer byvoeg en later hernoem of uitvee; oorspronklike sleutels kan nie so verwyder word nie. Derdepartykatalogusse wat nie veilig geskryf kan word nie, bly leesalleen.

## JSON-uitvoer en invoer

**Export JSON** laai die gekose taal se sleutels en huidige waardes af. Hou 'n afskrif voor groot wysigings. **Import JSON** verander slegs bestaande sleutels en skep nie nuwes nie. Behou afdeling, taal en sleutelpad. Onbekende en dubbele sleutels word oorgeslaan en in die resultaat genoem, terwyl geldige inskrywings steeds ingevoer word. Die oplaailimiet is 8 MiB.

## Lêers en name

Jy kan 'n afdeling se taallêer deaktiveer en weer aktiveer; 'n gedeaktiveerde taal bly redigeerbaar. Die Engelse basis en huidige WHMCS-verstektaal kan nie afgeskakel word nie. Die bestuurder maak rugsteunkopieë van WHMCS-lêers wat hy geskep het en kan dit ná 'n opdatering herstel. Sections toon 'n gedeelde hulpmiddel om ou lêername reg te stel, terwyl versoenbare ou name steeds werk. Aktiveer 'n nuwe verstektaal eers in Module settings, verander dan WHMCS en deaktiveer die vorige taal daarna.
