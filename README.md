# login_system_php

# 目的
phpとsqlの理解を深めるため、また、セキュリティについての勉強するために作りました。


# 機能

- ログイン
- ログアウト
- アカウントロック
- パスワードの変更
- アカウントの削除
- アカウントの編集
- メニュー画面

# 対策
- SQLインジェクション
- CSRF攻撃
- クリックジャッキング
- セッションの固定化
- パスワードのハッシュ化


# 画面遷移図
![名称未設定ファイル drawio(1)](https://user-images.githubusercontent.com/50784988/222062762-1b0e3bce-04fe-4091-a348-b0d38fdb6442.png)

# データベース
使用したデータベース：Mysql

## データベーススキーマ
|   名称   |   データ型  　|   備考　 |
| ---- | ---- | ---- |
|  id  |  int  |  auto_increment, PRIMARY KEY  |
| mail | varchar(100) | |
| password | varchar(255) | | 
| auth_type  | tinyint |  デフォルトはNULL,1で管理者  |
| fail_count | tinyint | 指定した回数でアカウントをロック  |
| fail_time  | datatime |  デフォルトはNULL,ログインに失敗した時間 |

# ファイル一覧

|  ファイル名  |  内容  |
| ---- | ---- |
|  db/ |  データベースアクセスのフォルダ    |
|  admin.php  | 管理者用のデータベースアクセスをまとめたもの  |
|  db_access.php | データベースの認証情報 |
|  users.php  | ユーザー用のデータベースアクセスをまとめたもの　|
| ---- | ---- |
| 管理者 | 管理者がアクセスできるファイル |
| admin_check_delete.php |  ユーザーアカウントの削除確認画面  |
| admin_check_update.php | ユーザーアカウントの編集画面 |
| admin_delete.php       | 管理者がユーザーアカウントの削除を行うファイル |
| admin_menu.php         | 管理者の画面 |
| admin_update.php       | 管理者がユーザーアカウントの編集を行うファイル |
| user_edit.php              | 管理者が登録されているユーザーアカウントをすべて確認する画面 |
| ---- | ---- |
| ユーザー | ユーザーがアクセスできるファイル |
| check_delete.php       | ユーザーがアカウントの削除を行う確認画面|
| delete.php             | ユーザーがアカウント削除を行うファイル　|
| menu.php               | ユーザーがログインに成功したときに飛ぶファイル | 
| ---- | ---- |
| 汎用　|ファイル|  
| login.php              | ログイン画面 |
| logout.php             | ログアウトを行うファイル|
| check_user.php         | アカウントの認証を行うファイル|
| register.php           | 入力されたメールアドレスとパスワードを確認し、アカウント登録するファイル|
| sign_up.php            | メールアドレスとパスワードを入力してもらうファイル　|
| check_password.php     | パスワード変更を行う確認画面|
| update_password.php    | パスワード変更を実行するファイル |

# プログラムの流れ
プログラムの大まかな流れ。（下図）
![名称未設定ファイル drawio](https://user-images.githubusercontent.com/50784988/222427327-69aa7539-99d3-4a72-8d1a-c19ae9e57b0d.png)

# まとめ
単純なログイン機能を作るのは簡単だけど、セキュリティを考慮して作ろうとすると大変なことがわかった。フレームワークを利用すれば簡単に早くログイン機能作ることができるが、セキュリティの知識をつけにくいことがわかった。１からログイン機能を作ってよかったと思う。定期的にセキュリティを備えたログイン機能を作って、脆弱性を作らないようにしていきたい。

# 参考

[(amazon) 体系的に学ぶ 安全なWebアプリケーションの作り方 第2版 脆弱性が生まれる原理と対策の実践 ](https://www.amazon.co.jp/%E4%BD%93%E7%B3%BB%E7%9A%84%E3%81%AB%E5%AD%A6%E3%81%B6-%E5%AE%89%E5%85%A8%E3%81%AAWeb%E3%82%A2%E3%83%97%E3%83%AA%E3%82%B1%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%81%AE%E4%BD%9C%E3%82%8A%E6%96%B9-%E7%AC%AC2%E7%89%88-%E8%84%86%E5%BC%B1%E6%80%A7%E3%81%8C%E7%94%9F%E3%81%BE%E3%82%8C%E3%82%8B%E5%8E%9F%E7%90%86%E3%81%A8%E5%AF%BE%E7%AD%96%E3%81%AE%E5%AE%9F%E8%B7%B5-%E5%BE%B3%E4%B8%B8/dp/4797393165)

