# サイトマップ

## XML

XML には有効な言語の相互の代替 URL と、既定言語の住所に対する x-default が入ります。リダイレクト元は loc と代替言語リンクから除外されます。代替内容を使った場合は実際の内容の言語を記します。ページと記事のファイルは XHTML の名前空間を宣言し、URL ごとに言語リンクを含めます。

生成処理は lib/sitemap.php、補助関数は inc/sitemap_manager.php、AfterCronJob フックは hooks/sitemap.php にあります。ZM_PB_ENABLE_SITEMAP が無効なら自動・手動の生成はどちらも使えません。cron 後には ZM_PB_SITEMAP_LASTUPD と ZM_PB_SITEMAP_UPDFREQ を比較します。空または未知の頻度は毎日扱いで、**Generate** はすぐ実行します。最後の成功時刻だけを保存します。

サイトのルートには sitemap_index.xml、sitemap_pages.xml、sitemap_posts.xml を作ります。一つの分類が 50,000 URL または 50 MB を超えた場合は続きのファイルに分割されます。インデックスには他の正しいルート urlset も含めますが、別のインデックスは入れません。モジュールが更新・削除するのは自分のページ・記事ファイルだけです。空の分類にはファイルを作りません。

公開済みで一般に閲覧でき、lang_active が有効な翻訳だけを含めます。WHMCS ページの上書きはビルダーの slug ではなく元の公開 URL を使います。既定言語の任意接頭辞も反映されます。サイトルート、resources/、inc/editable_consts.php の書き込み権限が必要です。不足テーブルは Module database で修復してください。失敗時は以前のファイルに戻し、最終成功時刻は更新しません。
