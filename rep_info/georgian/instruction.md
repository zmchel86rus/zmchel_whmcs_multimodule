[![მიმდევრები](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%E1%83%9B%E1%83%98%E1%83%9B%E1%83%93%E1%83%94%E1%83%95%E1%83%A0%E1%83%94%E1%83%91%E1%83%98)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![ვარსკვლავები](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%E1%83%95%E1%83%90%E1%83%A0%E1%83%A1%E1%83%99%E1%83%95%E1%83%9A%E1%83%90%E1%83%95%E1%83%94%E1%83%91%E1%83%98)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![ფორკები](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%E1%83%A4%E1%83%9D%E1%83%A0%E1%83%99%E1%83%94%E1%83%91%E1%83%98)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![საკითხები](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%E1%83%A1%E1%83%90%E1%83%99%E1%83%98%E1%83%97%E1%83%AE%E1%83%94%E1%83%91%E1%83%98)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule-ის გამოყენების ინსტრუქცია

**zmchel WHMCS Multimodule უფასო მოდულია.** WHMCS-ის ადმინისტრირების პანელიდან შეგიძლიათ მართოთ გვერდები ვიზუალური რედაქტორით, მრავალენოვანი შიგთავსი, მენიუები, მედიათეკა, SEO მეტამონაცემები, XML საიტის რუკები, გადამისამართებები, rewrite წესები და მონაცემთა იმპორტი ან ექსპორტი.

## პირველ გამოყენებამდე

**გახსენით მოდულის პარამეტრები → მხარდაჭერილი ენები და ჩართეთ თქვენთვის საჭირო ენები.** ენის გამორთვა უკვე შექმნილ შიგთავსს არ შლის.

ყოველი გააქტიურებისას მოდული ახალ salt მნიშვნელობებს ქმნის და module_init.php-ში წერს: ZM_PB_ADMIN_SALT, ZM_PB_SECURE_SALT და ZM_PB_NONCE_SALT. შეამოწმეთ, რომ სამივე მნიშვნელობა შევსებულია.

## შემოწმებული თავსებადობა და მუშაობა

- **PHP:** 7.4, 8.0, 8.1, 8.2, 8.3, 8.4, 8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3 და 4

## ვებსერვერთან თავსებადობა

Apache სრულად არის მხარდაჭერილი. მოდულმა შეიძლება Nginx-ზეც იმუშაოს, თუმცა მთავარ გვერდზე ენების მარშრუტიზაციას დამატებითი კონფიგურაცია და შემოწმება შეიძლება დასჭირდეს.

## მოდულის პარამეტრები

აირჩიეთ ენები, URL-ების ფორმატი და ენების მარშრუტები. Apache-ზე Rewrite Manager-ით შეამოწმეთ და გამოიყენეთ წესები. Nginx .htaccess ფაილს არ კითხულობს, ამიტომ შესაბამისი წესები სერვერზე დააყენეთ. შემდეგ გახსენით გამოქვეყნებული გვერდი ნაგულისხმევ და კიდევ ერთ აქტიურ ენაზე.

## გვერდების მართვა

შექმენით გვერდი შიდა სახელით და slug-ით, რომელიც მხოლოდ ლათინურ ასოებს, ციფრებსა და დეფისებს შეიცავს. მიუთითეთ ენები და წვდომა ავტორიზებული მომხმარებლებისთვის, სტუმრებისთვის ან ყველასთვის. შენახვის შემდეგ რედაქტორში დაამატეთ შიგთავსი და მეტამონაცემები, გამოაქვეყნეთ და გადაამოწმეთ საჯარო URL. საიტის რუკა ხელით შექმენით ან დაელოდეთ WHMCS-ის დაგეგმილ დავალებას.

## განყოფილებების სახელმძღვანელოები

- [გვერდების მენეჯერი](docs/pages_manager.md)
- [გვერდების რედაქტორი](docs/pages_editor.md)
- [მედიამენეჯერი](docs/media_manager.md)
- [მენიუები](docs/menu_manager.md)
- [ენების მენეჯერი](docs/langs_manager.md)
- [გადამისამართებები](docs/redirects_manager.md)
- [საიტის რუკები](docs/sitemap_manager.md)
- [Rewrite Manager](docs/rewrite_manager.md)
- [მოდულის პარამეტრები](docs/module_settings.md)
- [მოდულის მონაცემთა ბაზა](docs/module_db.md)

## დამატებითი დოკუმენტაცია

- [გვერდებად დაყოფა და ფილტრები](docs/pages_editor_pagination.md)
- [Smarty და ცვლადების კატალოგი](docs/pages_editor_smarty.md)
- [Schema.org სტრუქტურირებული მონაცემები](docs/module_structured_data.md)
- [იმპორტი და ექსპორტი](docs/module_settings_transfer.md)
