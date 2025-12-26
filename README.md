# dog_app

Laravel検証用 App :dog:

- Laravel: 12.42.0
- PHP: 5.18.0

---

# memo

```
# プロジェクト作成
composer create-project laravel/laravel dog_app
```

```
# MySQL設定(rootにて)
sudo mysql -u root

CREATE DATABASE dog_app CHARACTER SET utf8mb4;
# CREATE USER 'john'@'localhost' IDENTIFIED BY 'john1234'; # ユーザーはすでに作成済みの為不要
GRANT ALL PRIVILEGES ON dog_app.* TO 'john'@'localhost';
FLUSH PRIVILEGES;
```

```
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dog_app
DB_USERNAME=john
DB_PASSWORD=john1234
```

# npm

```
npm install
```

=> `npm run dev`で実行

=> viewファイルのヘッダーに`@vite('resources/css/app.css')``

