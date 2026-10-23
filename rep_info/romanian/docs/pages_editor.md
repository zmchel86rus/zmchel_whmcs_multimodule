# Editor de pagini

- [Paginare și filtre](pages_editor_pagination.md)
- [Smarty și variabile](pages_editor_smarty.md)
- [Date structurate](module_structured_data.md)

## 3. Editarea conținutului

Pentru fiecare limbă completați filele Conținut, Metadate și Sitemap. Trageți blocuri în editor, modificați textul și imaginile și salvați fiecare filă. Copierea cu conținut oferă un punct de pornire; copierea structurii pregătește aspectul pentru traducere. Textul nu este tradus automat.

## 4. Linkuri și publicare

Activați adăugarea limbii curente în URL pentru linkuri către pagini traduse ale modulului. Dezactivați opțiunea pentru URL-uri externe, adrese de e-mail și rute WHMCS fără variante lingvistice. După publicare, verificați pagina ca vizitator și client, pe desktop și mobil, în cel puțin două limbi.

## SEO

În setările de bază verificați numele, slug-ul, tipul, starea, accesul și limbile. Limba implicită WHMCS trebuie activată în modul; o pagină publicată are nevoie de conținut în limba afișată. Pentru fiecare limbă completați titlul și descrierea, apoi verificați canonical, robots, Open Graph, navigarea ierarhică și Schema. În fila hărții site-ului alegeți frecvența și prioritatea pentru o pagină publică nesistem. Salvați și verificați URL-ul public și XML-ul.

## Formular de contact

Adăugați blocul **Formular de contact**. Alegeți un **tichet WHMCS** și un departament de asistență sau **e-mail** și destinatar; completați titlul, descrierea, subiectul și textul butonului. Stabiliți pentru fiecare câmp numele, tipul, obligativitatea și validarea. Tichetul unui vizitator necesită câmpuri cu rolurile numelui și adresei de e-mail ale expeditorului. Scrieți câte o opțiune pe rând în lista derulantă, de exemplu `sales : Vânzări`. Creați câmp separat pentru fiecare consimțământ și folosiți CAPTCHA configurat în WHMCS. Salvați și trimiteți un test real ca vizitator; verificați tichetul sau livrarea, erorile și golirea formularului. Indicatorul verde al editorului nu confirmă livrarea; configurați SMTP în WHMCS dacă `mail()` eșuează.

## Instrucțiuni

- Container de aspect flexibil imbricat. Trageți alte blocuri în interior.
- Container CSS Grid imbricat. Trageți alte blocuri în interior.
- Carusel Bootstrap imbricat. Trageți blocuri în interior; fiecare devine un diapozitiv.
- Toate blocurile de sub acest bloc sunt afișate numai utilizatorilor autentificați. Funcționează numai când tipul de acces al paginii este Mixt.
- Toate blocurile de sub acest bloc sunt afișate numai vizitatorilor neautentificați. Funcționează numai când tipul de acces al paginii este Mixt.
- **Titlul paginii**
- **Meta descriere**
- **URL canonic**
- **Robots** — index, follow / noindex, nofollow. Controlează indexarea.
- **Tip Schema** — Când opțiunea este dezactivată, marcajul JSON Schema.org nu este generat pentru această pagină.
