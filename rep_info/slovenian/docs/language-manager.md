# Upravitelj jezikov

Upravitelj jezikov omogoča urejanje jezikovnih besedil WHMCS in modulov v skrbniškem vmesniku. Funkcija je še v razvoju. Uporablja jo lahko superadministrator modula, PHP pa mora imeti dovoljenje za pisanje v ustrezne jezikovne imenike.

## Izbira razdelka in jezika

Najprej v **Nastavitve modula → Podprti jeziki** vključite želene jezike. Nato v **Upravitelj jezikov → Razdelki** izberite jezike odjemalskega ali skrbniškega dela WHMCS, tega modula ali drugega najdenega modula. Tabela kaže obstoječe, izključene in jezike, ki jih lahko dodate. Na zavihku **Jeziki** izberite datoteko ali dodajte manjkajoči jezik. Nova datoteka sprva uporablja besedilo referenčnega jezika; to še ni dokončan prevod. Oznaka »neprevedeno« pomeni, da nima lastnih prevodov.

## Urejanje prevodov

Na zavihku **Prevodi** stolpec **Izvirnik** prikazuje besedilo iz izvorne datoteke izbranega jezika brez vaših sprememb. Če jezik nima lastnega besedila, se stolpec imenuje **Referenca**. Iščite po ključu ali besedilu, filtrirajte vse, izvirne ali dodane ključe ter shranite vsako vrstico posebej. V izbrani razdelek lahko dodate lasten ključ ter ga pozneje preimenujete ali izbrišete. Nekateri katalogi drugih modulov so samo za branje, če njihove oblike ni mogoče varno shraniti.

**Izvoz JSON** prenese ključe in prevode izbranega razdelka in jezika. **Uvoz JSON** posodobi samo obstoječe ključe. Neznani in podvojeni ključi se preskočijo ter navedejo v rezultatu. Ne spreminjajte oznak razdelka in jezika ali poti ključev. Največja velikost datoteke je 8 MiB.

## Datoteke in privzeti jezik

Jezikovno datoteko lahko izključite in znova vključite; urejanje je mogoče tudi, ko je izključena. Osnovna angleška datoteka in trenutni privzeti jezik WHMCS sta zaščitena. Za jezike odjemalskega in skrbniškega dela WHMCS, dodane z upraviteljem, se hranijo kopije za obnovitev po posodobitvi. Če je na zavihku **Razdelki** na voljo popravek imena datoteke, preverite novo ime in kliknite **Popravi**; popravek zajame najdene razdelke.

Ko spreminjate privzeti jezik, najprej vključite novega v nastavitvah modula, nato spremenite privzeti jezik v WHMCS in šele potem izključite starega. Preverite besedila v skrbniškem in odjemalskem delu.
