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
| fail_time  | datatime |  ログインに失敗した時間 |

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
| check_password.php     | ユーザーがパスワード変更を行う確認画面|
| delete.php             | ユーザーがアカウント削除を行うファイル　|
| menu.php               | ユーザーがログインに成功したときに飛ぶファイル | 
| update_password.php    | ユーザーのパスワード変更を実行するファイル |
| ---- | ---- |
| 汎用　| ログイン前にアクセスできるファイル|  
| login.php              | ログイン画面 |
| logout.php             | ログアウトを行うファイル|
| check_user.php         | アカウントの認証を行うファイル|
| register.php           | 入力されたメールアドレスとパスワードを確認し、アカウント登録するファイル|
| sign_up.php            | メールアドレスとパスワードを入力してもらうファイル　|
