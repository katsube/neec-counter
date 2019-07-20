# アクセスカウンター
日本工学院八王子専門学校 ゲーム科 実習用PHPサンプル。

## What is this
代表的な3種類のアクセスカウンターを同梱しています。

<dl>
 <dt>counter1.php</dt>
 <dd>データファイルから取得した内容をそのまま表示し、カウントアップします。</dd>

 <dt>counter2.php</dt>
 <dd>表示を1桁毎に`img`タグで行います。</dd>

 <dt>counter3.php</dt>
 <dd>必要な画像をGDで1枚に合成した上で表示。HTMLではなく画像そのものを出力します。</dd>
</dl>

## Quick Start
### 準備
適当なディレクトリに`git clone`するかダウンロードしてください。

```
$ git clone https://github.com/katsube/neec-counter.git counter
```

### ドキュメントルート下へ移動
Webサーバ上で公開されるディレクトリの下に移動(コピー)します。

```
$ cp -r counter /var/www/html/
```

### パーミッションを変更
データファイルのパーミションを適切な物に変更してください。
```
$ chmod 0666 /var/www/html/counter/data/counter.txt
```

* ファイルの所有者をWebサーバと同じ物にする方法もあります。

### 実行する
実際にWebブラウザからアクセスしてみてください。

```
http://example.com/counter
```

* `example.com`の部分は設置したサーバや環境の物に置き換えてください。

## 動作環境

* 一般的なLAMP環境での実行を想定しています。
* PHPは7.0以上、`counter3.php`の実行にはGDが有効になっている必要があります。
