# cake_sample

CakePHP 5 の社員管理サンプル（ログイン・一覧・登録・更新）。

## セットアップ

```bash
composer install
cp config/app_local.example.php config/app_local.php
bin/cake migrations migrate
```

Web のドキュメントルートは `webroot` を指定してください。

## 主な URL

| URL | 内容 |
|-----|------|
| `/` | ログイン |
| `/list` | 一覧 |
| `/regist_input` | 新規登録 |
| `/update_input` | 更新 |
