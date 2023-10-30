# PlantUML-Server
動的ウェブアプリケーションの開発および本番環境へのリリースを理解するためのプロジェクトです。

このプロジェクトでは、下記のような実装を可能にする技術への理解が必要になります。

- UML問題集
  - JSONファイルを読み込み動的にPageボタンとTableを作成し表示させる
  - Pageボタンをクリックすることで動的にTableの表示を切り替える
  - TableをクリックすることでIDのPageへ遷移させる
- UML問題
  - JSONファイルを読み込んだデータを元にUML問題のPageを動的に作成する
  - Previewに表示された画像をファイル形式を選択してDownloadさせる

また、誰でもウェブを通じてアクセスできるようにウェブアプリケーションとして本番環境にリリースさせる必要があります。

## 概要
ソフトウェアエンジニアは、ソフトウェアの設計とモデル化のために図を使用します。

このプロジェクトでは、様々な図をPlantUML Server プログラムを使って簡易的なテキストから

図に変換させるサービスを提供します。

UML問題集を通じてユーザーがPlantUMLについて理解し自ら図を作成できるようにする手助けをします。

また、作成した図は下記ファイル形式から選択してDownloadすることができます。

- png
- svg
- txt(ASCII)

## output
### UML問題集
![image](https://github.com/Aki158/PlantUML-Server/assets/119317071/2db6a936-0e58-4c26-9746-fce4ab846b11)

### UML問題
![image](https://github.com/Aki158/PlantUML-Server/assets/119317071/07c4bb64-0b87-45f6-a052-91b227b2508d)

## 使用方法
https://plantuml-server.aki158-website.blog
