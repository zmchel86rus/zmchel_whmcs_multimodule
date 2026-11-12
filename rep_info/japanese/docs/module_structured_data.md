# 出力される構造化データ

## Schema.org

Page Editor のメタデータで Schema タイプを選び、公開後に結果を確認します。メニューは実際のラベルと閲覧可能な URL を使う SiteNavigationElement を出力できます。目次は実在する見出しのアンカーから SiteNavigationElement と WebPageElement を作ります。画面に見える空でない質問と回答だけを FAQPage に含めます。クライアントテーマの breadcrumb が二つ以上なら BreadcrumbList を作成します。

組織と連絡先の情報は WHMCS から取得します。ページの言語は WebPage または ContactPage に設定し、連絡先で使える言語は BCP 47 の ContactPoint.availableLanguage に記録します。Organization の inLanguage を推測して追加しないでください。フィルター、入力欄、ページ件数の選択、問い合わせフォームは自動的に商品やサービスになりません。Flex/Grid、ボタン、通常のアコーディオンも表示形式だけで意味的な種類を決めません。

JSON-LD は訪問者に実際に見える内容を説明すべきです。形式が正しくても検索結果の特別表示は保証されません。作者が Smarty または HTML に書いた構造化マークアップは保持されます。公開ページのリンク、見出し、質問、回答と最終 JSON-LD を照合し、非表示のブロックが公開 FAQ に入らないよう確認します。

## JSON-LD の確認

ゲストとログイン済み顧客で同じ公開 URL を開き、メニューや breadcrumb の表示と記述が一致するか確認します。Schema.org の記述は見えるナビゲーションの代わりにはならず、検索エンジンでの強調表示を約束するものでもありません。

## ContactPoint.availableLanguage

連絡先の言語は WHMCS から取得し BCP 47 タグで表します。個々のページ言語は WebPage または ContactPage に置き、Organization に架空の inLanguage 値を追加しません。
