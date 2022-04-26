# debug-kit
変数確認などを行うツールです。
ダンプした内容を上部に固定されたフィールドにタブ付きで表示するため、狭いスペースに変数内容をダンプして見にくい、ダンプすることによって崩れる、ループ内でダンプし見にくいなどで困っている場合は重宝するかと思います。
恐らく他のテーマでも動きますが、自己責任で導入してください。



![21f3c58f2501df2706fcf0102f339a91](https://user-images.githubusercontent.com/101615872/165248546-22293611-2757-4726-92a7-7a10f66ded21.png)

## 使用方法
### STEP1. debugモードにする
```
// wp-config.php

define('WP_DEBUG', true);
```

wp-config.phpを編集してdebugモードに変更してください。

### STEP2. require
```
// functions.php

require 'debug-kit/require.php';
```
テーマ内のfunctions.phpで読み込んでください。

### STEP3. 確認したい変数にdebug関数を使用する
```
$ary = ['Im Sota.', 'I LOVE WordPress! 😘'];
debug($ary);
```
確認したい変数をdebug関数の第一引数に設定してください。
他の箇所で使用するとタブが増えていきます。


### STEP4. ブラウザで確認する

![eefb0d10de7ae11e9f40542e58c54a3a](https://user-images.githubusercontent.com/101615872/165250929-9fb15077-c5c9-4565-8ed2-3d21d5467fa0.png)

管理バーのコードマークを押すとトグルで表示を切り替えます。

## グループ化
1つのタブ内で複数の変数を確認したい場合はグループ化ができます。

```
for ($i = 0; $i < 5; $i++) {
    debug($i, 'group');
}
```
debug関数の第二引数にグループ名を入力すると、同じグループ名の場合は1つのタブに表示されます。
第二引数に設定するグループ名は必ずString型の値を入れてください。

![48fb10ade9299304e8e471832700370b](https://user-images.githubusercontent.com/101615872/165251993-6b31a470-b6e0-4bbf-9109-bec4ac91b8f1.png)
