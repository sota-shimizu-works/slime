# slime
## テーマ概要
カスタマイズ前提のWordPressテーマです。
コーポ―レートサイトやサービスサイトを想定していますが、SEOなど最低限の設定を行っているものになるのである程度どのタイプのサイトでも対応できます。

## 機能
### Chronos 2.3
chronos2.3が同梱されています。

https://github.com/cakephp/chronos

### Contact form
プラグインに依存せず使用できるコンタクトフォームが同梱されています。<br>
WordPress管理画面から有効にすることで使用可能になります。<br>
必要な固定ページの生成やSMTPの設定を行うことができます。また、メールテンプレートを使用することでHTMLメールの送信も可能です。

https://github.com/sota-shimizu-works/slime/tree/main/contact-form


### アーカイブページの絞り込み機能
アーカイブページで決まったGETパラメータでアクセスすることでパラメータに指定された内容で投稿を絞り込みます。
```php
// https://example.com/post?categorise=catA,catB&year=2022

$query->set('category_name', 'catA,catB');
$query->set('year', '2022');
```

### metaタグ設定
- og:site_name
- og:title
- og:type
- og:url
- og:image
- og:description
- twitter_card
- description

上記のmetaタグが自動的に入ります。<br>
``og_image``はサムネイルが設定されているページでのみ適用され、サムネイルがないページでは挿入されません。デフォルトを設定することでサムネイルが無い場合のみ他の画像を表示するように変更できます。<br>
``fb_app_id``と``twitter_site``はデフォルトで``false``になっているのでデフォルト値を変更することで有効化できます。
``twitter_card``の初期値は``summary``になっています。
```php
<head>
... 省略

    <?php if (the_ogp() != '') echo the_ogp() ?>

</head>
```
OGP出力用関数はヘッダーに入っており、引数に配列でオプションを設定することで初期値から値を変更します。<br>
```php
/**
 * 
 * @param ary $options                      OGPの情報の初期値です。空で渡した場合適当な内容が設定されます。
 * @param strng $options['site_name']       初期値(サイト名):WordPress設定サイト名
 * @param strng $options['og_type']         初期値(OGタイプ):website
 * @param strng $options['og_url']          初期値(URL):トップページURL
 * @param strng $options['og_image']        初期値(URL):false(サムネイルが無いページでは使用しないため初期値はfalse) 
 * @param strng $options['og_description']  初期値(サイト説明):WordPress設定説明文
 * @param strng $options['fb_app_id']       初期値(ID):fasle
 * @param strng $options['twitter_card']    初期値(type):summary
 * @param strng $options['twitter_site']    初期値(URL):false
 */
```