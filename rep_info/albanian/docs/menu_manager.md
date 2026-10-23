# Menytë

Krijoni një meny, shtoni faqe ose lidhje të personalizuara dhe renditini duke i tërhequr. Zgjidhni elementin prind për nënmeny, përcaktoni etiketat sipas gjuhës, qasjen e vizitorëve ose klientëve dhe pajisjet. Caktoni një vendndodhje; secila vendndodhje mund të përdorë vetëm një meny. Për lidhjet e brendshme zgjidhni nëse URL-ja duhet të ndjekë gjuhën aktuale. Kontrolloni menynë publike në desktop dhe telefon.

Për çdo element mund të vendosni titull, përshkrim, klasa CSS, `rel`, ikonë dhe hapjen në skedë të re; mund të shtoni edhe faqe të publikuara automatikisht. Zgjidhni nëse menuja plotëson apo zëvendëson navigimin e WHMCS veçmas për kompjuter dhe celular. Për një faqe të modulit, lidhja llogaritet sërish sipas slug-ut, gjuhës dhe mënyrës së URL-ve; një etiketë bosh përdor titullin e përkthyer ose emrin e faqes. Hapja e një faqeje nuk ndryshon gjuhën e profilit të klientit. Serveri refuzon skema të pasigurta URL-sh dhe HTML në etiketa.

## WHMCS

Në cilësimet e modulit aktivizoni vendet e menysë në WHMCS. Një vend pranon vetëm një meny, ndërsa e njëjta meny mund të përdoret në disa vende. Shfaqja për kompjuter fillon nga 768 px; në ekranet më të ngushta përdoret mënyra për celular. Kur vendi është i çaktivizuar, menyja standarde e WHMCS mbetet siç është.

| WHMCS | zmchel |
| --- | --- |
| ClientAreaPrimaryNavbar | ZM_PB_ENABLE_MAINNAV |
| ClientAreaSecondaryNavbar | ZM_PB_ENABLE_SECONDARYNAV |
| ClientAreaPrimarySidebar | ZM_PB_ENABLE_MAINSIDEBAR |
| ClientAreaSecondarySidebar | ZM_PB_ENABLE_SECONDARYSIDEBAR |

## URL

Në rrugët e sistemit WHMCS pa rrugezim nga moduli, etiketat e menusë përdorin gjuhën e ruajtur të klientit; faqet e modulit përdorin gjuhën e URL-së. Aktivizimi i rrugës së gjuhës së parazgjedhur shton edhe atje prefiksin. Në URL të thjeshta lidhja përdor `?m=zmchel_whmcs_multimodule&slug=...&lang=...`. Një lidhje e personalizuar mund të ruhet pa lokalizim; kjo është e dobishme për rrugë si `clientarea.php`. Fshehja e prindit fsheh gjithë degën.

Për lidhjet e faqeve moduli rindërton URL-në nga slug-u aktual dhe përkthimi i publikuar. Nëse përkthimi mungon, përdoret versioni i publikuar në gjuhën e parazgjedhur. Lidhjet e personalizuara mund të ruajnë URL-në e dhënë; adresat e jashtme, mailto, tel dhe ankorat nuk marrin prefiks gjuhe. Faqet draft, të fshira ose të paarritshme nuk shfaqen.

## zm_pb_menus

Të dhënat ruhen në tabelat `zm_pb_menus`, `zm_pb_menu_items` dhe `zm_pb_menu_locations`. Krijoni ose riparoni tabelat te Baza e të dhënave e modulit. Pema lejon deri në 10 nivele dhe 300 elemente; fshirja e një prindi i ngre fëmijët e tij një nivel më sipër.

## Udhëzime

- Krijo meny
- Shtoni faqe, postime ose lidhje të personalizuara.
- Tërhiqni elementet për të ndryshuar renditjen e tyre. Vendosni hierarkinë me përzgjedhësin e elementit prind ose me butonat e lëvizjes.
- Përdor gjuhën e faqes aktuale
- Përdor URL-në e dhënë pa ndryshime
- Etiketat në gjuhë të tjera
- I dukshëm për
- Pajisjet
- Çdo pozicion mund të ketë një meny. Përzgjedhja e një pozicioni e zhvendos caktimin e tij këtu nga një meny tjetër.
- Elementet e nivelit kryesor bëhen kolona, ndërsa elementet e futura bëhen lidhje. Përdorni URL-në # për një titull pa lidhje.
- Tabelat e menyve nuk janë krijuar ende. Shtojini te Baza e të dhënave e modulit.
