# Të dhënat e strukturuara

- **Redaktori i faqeve → Cilësimet e metadatave → Lloji i skemës → Ruaj.**

## Çfarë shënon moduli

Menytë dhe tabela e përmbajtjes mund të japin `SiteNavigationElement`; pyetjet dhe përgjigjet e dukshme japin `FAQPage`, ndërsa një shteg navigimi me disa elemente jep `BreadcrumbList`. Blloqet e paraqitjes, butonat dhe filtrat nuk marrin automatikisht një lloj përmbajtjeje. Lloji Schema i zgjedhur për faqen kontrollon JSON-LD e saj; kur është çaktivizuar, kjo shënim nuk shfaqet.

## Kontrolli pas publikimit

Hapni faqen publike dhe kontrolloni JSON-LD, URL-në kanonike, gjuhën dhe përmbajtjen që shihet vërtet. Mos e trajtoni shënimin e vlefshëm si garanci për një rezultat të pasur në kërkim.

## Schema.org

`SiteNavigationElement` përdor lidhjet dhe titujt realë të dukshëm të menusë; përmbajtja e faqes mund të shtojë edhe `WebPageElement` për titujt që ekzistojnë vërtet. `FAQPage` merr vetëm pyetje e përgjigje të plota që shihen nga vizitori: blloqet e fshehura dhe akordionët e zakonshëm përjashtohen. `BreadcrumbList` krijohet vetëm me të paktën dy pika. Të dhënat e organizatës vijnë nga WHMCS; gjuhët e kontaktit vendosen te `ContactPoint.availableLanguage` në formatin BCP 47. Për filtra, faqëzim, forma dhe HTML të personalizuar nuk hamendësohet një tip Schema.

## Udhëzime

- **Lloji i skemës** — Kur çaktivizohet, shënimi JSON i Schema.org nuk shfaqet për këtë faqe.
- **Gjurmët e navigimit** — Emri i faqes në gjurmët e navigimit
- **URL kanonike**
- **Titulli i faqes**
- **Përshkrimi meta**
- **Titulli Open Graph** — Nëse lihet bosh, përdoret titulli i faqes.
- **Përshkrimi Open Graph** — Nëse lihet bosh, përdoret përshkrimi meta.
- **Imazhi Open Graph** — Nëse lihet bosh, përdoret imazhi i faqes.
