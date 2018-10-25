# Tasklist RPG

**途中までShisoumeの名前でコミットしています。  
このコミットを最後にRiku-1のアカウントに切り替える予定（GitHubに草を生やしたいので）**


## アプリURL
http://tasklist-rpg.herokuapp.com/

## このアプリについて
目標達成のためのロードマップをRPG風に整理するためのアプリです。  
Laravel勉強のために作りました。完成度は2018年10月13日時点で9割くらいです。

## 製作期間
１カ月

## 開発環境
* vagrant + homestead

## 使用技術
* Laravel 5.7.3 + php 7.7.9-1
* MySQL 14.14
* CSS: bootstrap 3.37
* JS: jQuery 1.12.4


## 使い方
大きく分けて４種類のページがあります。  
* **クエスト一覧ページ・クエスト詳細ページ**  
目標＝クエスト、目標のためのタスク＝モンスターとして扱います。  
クエスト詳細ページにはそのクエストを達成するためのタスク(モンスター)を設定できます。  
タスクの難易度によってモンスターの画像が変わるようになっています。  
現実のタスクの進行度に合わせてモンスターのHPを変えていってください。  
タスクを達成する(モンスターのHPを0にする）とガチャチケ(後述)を手に入れることができます。

* **ガチャページ**  
ガチャチケを消費して報酬(自分へのご褒美)を手に入れることができます。  
手に入る報酬はナビゲーションバーの一番右のプルダウンにある「報酬設定」から変更することができます。  
手に入れたアイテムは所持アイテムページに登録されます。  

* **所持アイテムページ**  
ガチャで手に入れたアイテムが表示されます。  
「消費する」ボタンを押すとアイテムが消費されます。  
ex) 報酬:ケーキを手に入れると、現実でケーキを食べる権利が与えられます。  
現実でケーキを食べたら「消費する」ボタンを押してください。ケーキの所持数が1減ります。

* **報酬設定ページ**  
ガチャで手に入る報酬を設定できます。  
(報酬にレアリティを設定できますが、現在未実装で反映されません。)

## 仕様・未実装
* モンスターの概要について表示スペースを作っていません。近い内に作成する予定です。

* 1クエスト内にモンスターは100までしか表示できません。  
そもそもモンスターが増えすぎるとドラッグ＆ドロップによる並び替えが難しくなるのでこの点については変えるつもりはありません。  
ただし、作成は100以上できてしまうので、将来的には100を超えると作成できなくなるようにするつもりです(優先度低)。  

* 報酬設定も100までしか表示できません。  
報酬設定には並び替えがないのでこちらはpaginationを作って100以上でも表示できるように修正するつもりです(優先度低)。

* 報酬にあるレアリティは未実装です。将来的にはレアリティによってガチャの出現率が
変わる予定です。  

* クエストやモンスターのタイトルが長い場合どう表示するかを考えていません。  
将来的には先頭10文字×3行くらいまで表示で、それ以降はマウスオーバーしている間だけ表示する予定です。
