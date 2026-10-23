# Redirecționări

Introduceți URL-ul vechi și pe cel nou. Folosiți 301 pentru mutări permanente și 302 pentru cele temporare; testați sursa și evitați redirecționarea către sine.

## HTTP

Regulile acceptă codurile HTTP `301`, `302`, `303`, `307` și `308` și se aplică doar cererilor `GET`/`HEAD` care ajung la WHMCS. Sursa este comparată exact cu calea și, dacă sunt precizați, cu parametrii de interogare; parametrii destinației îi înlocuiesc pe cei vechi. Managerul păstrează regulile în `zm_pb_redirects`, dar nu creează tabelul în timpul unei cereri: folosiți **Baza de date a modulului**. Coloanele URL existente au limita de 128 de octeți.

Regulile manuale au prioritate față de cele automate. Schimbarea slug-ului unei pagini publicate poate crea un `301` automat pentru fiecare limbă activă după întârzierea stabilită; publicarea unei ciorne nu îl creează. Redenumirile ulterioare actualizează destinațiile vechi. O regulă cu parametri de interogare are prioritate față de regula doar pentru cale. URL-ul sursă trebuie să aparțină acestui site și să nu conțină fragment `#`.

## Instrucțiuni

- Adrese exacte: sursă → destinație. Sursa este o cale de la rădăcina site-ului sau un URL de pe acest site. Destinația este o cale sau un URL HTTP(S) complet. O regulă fără parametri de interogare se aplică și solicitărilor care îi conțin; destinația este utilizată exact așa cum a fost introdusă. Regulile se aplică solicitărilor GET/HEAD care ajung la WHMCS.
- Sursă
- Destinație
- Activat
- Dezactivat
- Implicit: 14 zile. Se calculează de la ultima modificare a paginii publicate sau a traducerilor sale active; dacă nu a fost modificată niciodată, de la creare. Setați 0 pentru a elimina întârzierea. Regulile automate folosesc HTTP 301.
- Adresele paginilor care suprascriu pagini de sistem redirecționează automat către paginile de sistem pe care le înlocuiesc. Dacă o suprascriere are mai multe destinații, este utilizată prima configurată. Aceste redirecționări funcționează ori de câte ori suprascrierile sunt activate, independent de regulile Managerului de redirecționări.
- Introduceți o cale validă care începe cu / sau un URL HTTP(S) complet. Sursa trebuie să aparțină acestui site; fragmentele # nu sunt acceptate.
