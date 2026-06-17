# Furima App

フリマアプリを模したECサイトです。

## 環境構築

### Dockerビルド

```bash
docker-compose up -d --build
```

### Laravel環境構築

```bash
docker-compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## 使用技術

- PHP 8.x
- Laravel 10.x
- MySQL 8.x
- Docker
- nginx
- Stripe

## ER図

![ER図](images/furima_er.png)

## URL

- 開発環境：http://localhost:8080
- phpMyAdmin：http://localhost:8081

## 機能一覧

- ユーザー登録
- ログイン
- メール認証
- 商品一覧表示
- 商品詳細表示
- 商品検索
- 商品出品
- 商品購入
- Stripe決済
- コメント機能
- いいね機能
- マイリスト機能
- プロフィール編集
- 配送先変更

メール認証機能を実装しています。
認証メールはMailHogで確認できます。

MailHog:
http://localhost:8025
