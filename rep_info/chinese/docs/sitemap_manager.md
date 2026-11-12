# 網站地圖

## XML

XML 會為已啟用語言列出互相指向的替代連結，並為預設語言地址提供 x-default。重新導向來源不會出現在 loc 或替代連結中；使用回退內容時以實際內容語言為準。頁面和文章檔案宣告 XHTML 命名空間，使每筆 URL 都能含多語連結。

產生器位於 lib/sitemap.php，輔助程式在 inc/sitemap_manager.php，AfterCronJob hook 在 hooks/sitemap.php。ZM_PB_ENABLE_SITEMAP 關閉時，自動與手動產生都無法使用。cron 完成後會比較 ZM_PB_SITEMAP_LASTUPD 與 ZM_PB_SITEMAP_UPDFREQ；空白或未知頻率按每日處理。**Generate** 會立即執行。只保存最後一次成功產生的時間。

網站根目錄會有 sitemap_index.xml、sitemap_pages.xml、sitemap_posts.xml。單一類別超過 50,000 個 URL 或 50 MB 時會分割成後續檔案。索引也納入其他有效的根目錄 urlset，但不會巢狀加入其他索引。模組只更新或刪除自己的頁面及文章檔案，空類別不會建立檔案。

只有已發佈、公開可存取並具有 lang_active 翻譯的頁面和文章會列入。WHMCS 頁面覆寫使用原系統頁面的公開 URL，不使用建構器布局的 slug。預設語言可選的前綴也會反映在地址上。網站根目錄、resources/、inc/editable_consts.php 都需要寫入權限。缺少資料表時到 Module database 修復；失敗時會從暫存副本還原舊檔，成功時間不變。
