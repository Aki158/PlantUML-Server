# PlantUML-Server

## 🌱概要
UML図を作成する練習ができるサービス

## 🏠URL
https://plantuml-server.aki158-website.blog

## ✨デモ
### 問題集から問題を選択する
![output](https://github.com/Aki158/PlantUML-Server/assets/119317071/35d5853c-73be-45bb-9cbc-8a8ccc001bdd)

### 問題を解いてダウンロードする
![output](https://github.com/Aki158/PlantUML-Server/assets/119317071/37e5a669-808d-48a7-914f-28350f7c5fa8)

## 📝説明
このサービスは、ソフトウェアエンジニアの学習をサポートするために作成したサービスです。

ソフトウェアエンジニアは、ソフトウェア製品を作成する場合、プログラミングをする前に設計という工程を実施します。

設計では、UML図(シーケンス図やクラス図など)という視覚的にソフトウェア製品の構造がわかる資料を作成することがあります。

このサービスでは、UML図に関するいくつかの問題を提供し、ユーザーが1からUML図を作成できるようになる手助けをすることができます。

[PlantUML](https://plantuml.com/ja/)のサイトでUML図の作成方法を学んだ後にアウトプットとして練習問題を解きたい場合に、役に立ちます。

基本的な機能として、問題集と問題の表示/UML図の作成/作成したUML図のダウンロードができます。

UML図の作成時には、わからなくなった時のためのチートシートとして、Answer UML と Answer Codeを用意しています。

作成したUML図は、下記ファイル形式のいづれかから選択してダウンロードすることができます。

- png
- svg
- txt(ASCII)

### 補足
[説明](#説明)で登場する用語について補足します。

用語の意味がわからない時は、下記表を確認してください。

| 用語 | 意味 |
| ------- | ------- |
| UML図 | ソフトウェア開発の過程でシステムの設計や構造を視覚化するために使用される標準的なモデリング言語です。 |
| ソフトウェア開発 | ユーザーが求めているソフトウェア製品を作成するための一連の工程です。 |
| エディタ | テキストやコードなどを作成、編集、表示するためのソフトウェアのことです。<br>このサービスでは、問題ページの左側にある「' ここから記述してください」と記載してある入力欄のことです。 |

## 🚀使用方法
1. [URL](#URL)にアクセスする
2. 問題集の中から練習したい問題を選びクリックする
3. エディタにコードを入力して、UML図を作成する
4. Answer UML と Answer Code を見て答え合わせする
5. 画像として出力したい場合は、ダウンロードする

## 🙋使用例
一通りの手順のイメージは[デモ](#デモ)を参考にしてください。

1. [URL](#URL)にアクセスする
2. 問題集の中から練習したい問題を選びクリックする。<br>今回は、シーケンス図を練習したいので、「ID:3 矢印の見た目を変える」をクリックします。
3. エディタにコードを入力して、UML図を作成する。<br>初めて解くので、Answer Code を見ながら進めます。<br>UML図の作成に慣れてきたら、Answer UMLのみを見て解いてみましょう!
4. Answer UML と Answer Code を見て答え合わせする
5. 画像として出力したいので、3つのファイル形式から「png」を選びクリックする

## 💾使用技術
<table>
<tr>
  <th>カテゴリ</th>
  <th>技術スタック</th>
</tr>
<tr>
  <td rowspan=5>フロントエンド</td>
  <td>HTML</td>
</tr>
<tr>
  <td>CSS</td>
</tr>
<tr>
  <td>JavaScript</td>
</tr>
<tr>
  <td>フレームワーク : Bootstrap</td>
</tr>
<tr>
  <td>ライブラリ(コードエディタ) : Monaco Editor</td>
</tr>
<tr>
  <td>バックエンド</td>
  <td>PHP</td>
</tr>
<tr>
  <td rowspan=4>インフラ</td>
  <td>Amazon EC2</td>
</tr>
<tr>
  <td>Nginx</td>
</tr>
<tr>
  <td>Ubuntu</td>
</tr>
<tr>
  <td>VirtualBox</td>
</tr>
<tr>
  <td rowspan=3>その他</td>
  <td>Git</td>
</tr>
<tr>
  <td>Github</td>
</tr>
<tr>
  <td>SSL/TLS証明書取得、更新、暗号化 : Certbot</td>
</tr>
</table>

## 👀機能一覧
### 問題集ページ
![image](https://github.com/Aki158/PlantUML-Server/assets/119317071/d25243fd-c623-4f37-b2b0-49eca9a7806e)

| 機能 | 内容 |
| ------- | ------- |
| 問題集の表示 | 1ページにつき5問を表示させています。<br>問題の情報として、ID/Title/Themeを表示させています。 |
| 問題ページへの遷移 | 問題集から練習したい問題をクリックすると、IDの問題ページに遷移します。 |
| Pageボタン | クリックしたページへ切り替えができます。 |

### 問題ページ
![image](https://github.com/Aki158/PlantUML-Server/assets/119317071/49bb7d0a-b421-402c-8105-30f2d4ccf896)

| 機能 | 内容 |
| ------- | ------- |
| 問題の表示 | 問題集ページでクリックされた問題の情報をもとに問題が表示されます。 |
| エディタ | [PlantUML](https://plantuml.com/ja/#google_vignette)の構文を記述することができます。 |
| Download | 作成したUML図は、下記ファイル形式のいづれかから選択してダウンロードすることができます。<br>Previewが「No image.」の時にクリックした場合は、ダウンロードできません。<br>また、注記「※Preview が No image. の場合は、出力できません！」が赤で強調されます。<br>・png<br>・svg<br>・txt(ASCII) |
| Preview | エディタのコードが変更されると、リアルタイムでUML図に変換して表示されます。<br>UML図に変換できない間は、「No image.」と表示されます。 |
| Answer UML | 答えのUML図が表示されます。<br>Answer Code ボタンと切り替えることができます。 |
| Answer Code | 答えのコードが表示されます。<br>Answer UML ボタンと切り替えることができます。 |
| 戻る | 問題集のページへ遷移します。 |

## 📮今後の実装したいもの
- [ ] ログイン機能
- [ ] ログインしたユーザーが解いた問題がわかるようにする
- [ ] 問題が正解したかテストできるようにする
- [ ] 練習できる問題の追加

## 📑参考文献
### 公式ドキュメント
- [Monaco Editor](https://microsoft.github.io/monaco-editor/)
- [Bootstrap](https://getbootstrap.jp/)
- [PHPマニュアル](https://www.php.net/manual/ja/index.php#index)

### 参考にしたサイト
- [PlantUML](https://plantuml.com/ja/#google_vignette)
