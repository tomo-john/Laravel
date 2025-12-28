# MySQL関連

## テーブル確認

MySQLにて:

```sql
DESC テーブル名;
```

または

```sql
DESCRIBE テーブル名;
```

これで、カラム名やデータ型、Null許すか、主キーかなどが一覧で確認できる。

もしくはLaravelコマンドでも確認可能。

```
php artisan db:table テーブル名;
```

ただし、PHPの拡張機能である`intl`(インターナショナル)が入っていないと怒られる。

