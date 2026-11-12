[![關注者](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%E9%97%9C%E6%B3%A8%E8%80%85)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![星標](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%E6%98%9F%E6%A8%99)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![複刻](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%E8%A4%87%E5%88%BB)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![議題](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%E8%AD%B0%E9%A1%8C)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule 使用指南

**zmchel WHMCS Multimodule 是免費模組。** 你可以在 WHMCS 管理介面中使用視覺化頁面與區塊編輯器，管理多語內容、選單、媒體庫、SEO 中繼資料、XML 網站地圖、重新導向、rewrite 規則，以及資料的匯入與匯出。

## 首次使用前

**請先開啟模組設定 → 支援的語言，啟用需要的語言。** 停用語言不會刪除已建立的內容。

每次啟用模組時，都會產生新的 salt 並寫入 module_init.php：ZM_PB_ADMIN_SALT、ZM_PB_SECURE_SALT 和 ZM_PB_NONCE_SALT。請確認三個值都已填入。

## 已測試的相容性與功能

- **PHP：** 7.4、8.0、8.1、8.2、8.3、8.4、8.5
- **WHMCS：** 8.13.0–9.1.0
- **Smarty：** 3 與 4

## 網頁伺服器相容性

完整支援 Apache。Nginx 也可能正常運作，但首頁的語言路由可能需要額外設定與測試。

## 模組設定

選擇要使用的語言、URL 格式與語言路由。使用 Apache 時，請在 Rewrite Manager 檢查並套用規則。Nginx 不會讀取 .htaccess，必須在伺服器上設定對應規則。儲存後，分別開啟預設語言和另一種已啟用語言的公開頁面，確認路由正確。

## 頁面管理

建立頁面時，輸入內部名稱和只含拉丁字母、數字及連字號的 slug。選擇語言，以及僅限已登入使用者、訪客或所有人存取的模式。儲存後在 Page Editor 加入內容與中繼資料，再發佈並檢查公開 URL。網站地圖可手動產生，亦可由 WHMCS 排程工作更新。

## 各區段指南

- [頁面管理員](docs/pages_manager.md)
- [頁面編輯器](docs/pages_editor.md)
- [媒體管理員](docs/media_manager.md)
- [選單](docs/menu_manager.md)
- [語言管理員](docs/langs_manager.md)
- [重新導向](docs/redirects_manager.md)
- [網站地圖](docs/sitemap_manager.md)
- [Rewrite Manager](docs/rewrite_manager.md)
- [模組設定](docs/module_settings.md)
- [模組資料庫](docs/module_db.md)

## 更多文件

- [分頁與篩選](docs/pages_editor_pagination.md)
- [Smarty 與變數目錄](docs/pages_editor_smarty.md)
- [Schema.org 結構化資料](docs/module_structured_data.md)
- [匯入與匯出](docs/module_settings_transfer.md)
