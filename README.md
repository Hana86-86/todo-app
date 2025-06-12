# 📝 ToDoアプリ（Docker + PHP + MySQL）

シンプルなToDoアプリケーションです。ユーザー登録・ログイン機能付き。Dockerで手軽にローカル開発環境を構築できます。

---

## 🚀 起動方法（初回）

```bash
git clone https://github.com/Hana86-86/todo-app.git
cd todo-app
docker-compose up -d

- アクセスURL
ログイン画面: http://localhost:8080/login.php

ユーザー登録: http://localhost:8080/register.php

🔧 使用技術
- PHP 8.x

- MySQL 8.x

- Docker / Docker Compose

- HTML + CSS（アースカラーデザイン）

- VS Code

✨ 機能一覧
- ユーザー登録・ログイン

- タスクの追加／編集／削除

- 完了／未完了の切り替え

- パスワード再設定画面（作成済み）

- セッション管理

🗂 ディレクトリ構成

todo.app/
├── docker-compose.yml
├── dockerfile
├── mysql/
│   └── my.cnf
├── sql/
│   ├── schema_todo.sql
│   └── seed_users.sql
├── public/
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php
│   ├── add.php
│   ├── edit.php / delete.php / toggle.php / update.php
│   ├── style.css
│   └── default.conf
└── README.md

🧠 学習メモ
password_hash() と password_verify() による安全な認証

prepare() + execute() によるSQLインジェクション対策

セッションの使い方（ログイン状態の維持）

🧠 学習メモ
password_hash() と password_verify() による安全な認証

prepare() + execute() によるSQLインジェクション対策

セッションの使い方（ログイン状態の維持）

✅ 今後の改善案
 ログアウト機能の実装

 エラーメッセージのデザイン統一

 レスポンシブ対応（スマホ対応）

 Laravelへの移行（応用編）