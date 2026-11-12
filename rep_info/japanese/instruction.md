[![ウォッチ](https://img.shields.io/github/watchers/zmchel86rus/zmchel_whmcs_multimodule?label=%E3%82%A6%E3%82%A9%E3%83%83%E3%83%81)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/watchers)
[![スター](https://img.shields.io/github/stars/zmchel86rus/zmchel_whmcs_multimodule?label=%E3%82%B9%E3%82%BF%E3%83%BC)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/stargazers)
[![フォーク](https://img.shields.io/github/forks/zmchel86rus/zmchel_whmcs_multimodule?label=%E3%83%95%E3%82%A9%E3%83%BC%E3%82%AF)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/network/members)
[![課題](https://img.shields.io/github/issues/zmchel86rus/zmchel_whmcs_multimodule?label=%E8%AA%B2%E9%A1%8C)](https://github.com/zmchel86rus/zmchel_whmcs_multimodule/issues)

# zmchel WHMCS Multimodule の使い方

**zmchel WHMCS Multimodule は無料です。** WHMCS の管理画面から、ページとブロックのビジュアル編集、多言語コンテンツ、メニュー、メディアライブラリ、SEO メタデータ、XML サイトマップ、リダイレクト、rewrite ルール、データのインポートとエクスポートを管理できます。

## 初回利用前の準備

**モジュール設定 → 対応言語を開き、必要な言語を有効にしてください。** 言語を無効にしても、作成済みのコンテンツは削除されません。

モジュールを有効化するたびに、新しい salt が生成され、module_init.php の ZM_PB_ADMIN_SALT、ZM_PB_SECURE_SALT、ZM_PB_NONCE_SALT に書き込まれます。三つとも値が入っていることを確認してください。

## 動作確認済みの環境

- **PHP:** 7.4、8.0、8.1、8.2、8.3、8.4、8.5
- **WHMCS:** 8.13.0–9.1.0
- **Smarty:** 3 と 4

## Web サーバーとの互換性

Apache に完全対応しています。Nginx でも動作する場合がありますが、トップページの言語ルーティングには追加の設定と検証が必要になることがあります。

## モジュール設定

使用する言語、URL の形式、言語ルーティングを選びます。Apache では Rewrite Manager でルールを確認して適用してください。Nginx は .htaccess を読み込まないため、対応する設定をサーバー側に追加します。保存後、既定の言語と別の有効な言語で公開ページを開いて確認してください。

## ページ管理

内部名と、ラテン文字・数字・ハイフンだけを使った slug を入力してページを作成します。言語と、ログインユーザーのみ・ゲストのみ・全員のアクセス区分を選びます。保存後に Page Editor で本文とメタデータを編集し、公開 URL を確認します。サイトマップは手動で生成するか、WHMCS の定期処理による更新を待てます。

## 機能別ガイド

- [ページ管理](docs/pages_manager.md)
- [ページ編集](docs/pages_editor.md)
- [メディア管理](docs/media_manager.md)
- [メニュー](docs/menu_manager.md)
- [言語管理](docs/langs_manager.md)
- [リダイレクト](docs/redirects_manager.md)
- [サイトマップ](docs/sitemap_manager.md)
- [Rewrite Manager](docs/rewrite_manager.md)
- [モジュール設定](docs/module_settings.md)
- [モジュールのデータベース](docs/module_db.md)

## 詳細資料

- [ページ分割とフィルター](docs/pages_editor_pagination.md)
- [Smarty と変数一覧](docs/pages_editor_smarty.md)
- [Schema.org の構造化データ](docs/module_structured_data.md)
- [インポートとエクスポート](docs/module_settings_transfer.md)
