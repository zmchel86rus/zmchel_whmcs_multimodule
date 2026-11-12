# 模組設定

先啟用需要的語言，再選擇 URL 格式與語言路由並儲存。若路由設定改變，請更新 Apache 的 Rewrite Manager 規則或 Nginx 的對應設定。分別開啟預設語言與另一個啟用語言的公開頁面，確認結果。大幅修改設定或匯入資料前，先匯出備份。

## 可用分頁

- **Import / export：** 將選取的模組資料備份為 ZIP，或匯入 ZIP、JSON。匯入前請閱讀[資料轉移指南](module_settings_transfer.md)。
- **Editable constants：** 調整 URL、路由、輸出、媒體、維護模式及 Smarty 等開關。閱讀每個欄位說明並在公開網站測試。
- **Supported languages：** 建立頁面前先啟用語言。若要停用原本的 WHMCS 預設語言，應先在 WHMCS 變更預設值。
- **Redirects 與 Sitemap：** 管理儲存的重新導向、自動重新導向、XML 產生時間；個別規則與檔案請到相應管理頁面查看。
- **Header、Footer、Robots：** 修改網站頭尾輸出及 robots.txt，儲存後確認實際頁面或檔案。

依賴伺服器路由的設定必須有對應規則。Apache 使用 .htaccess，Nginx 則使用獨立的伺服器組態。
