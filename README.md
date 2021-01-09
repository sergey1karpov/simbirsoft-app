1. docker-compose up -d

2. docker-compose exec app bash

3. php artisan migrate и возможно config:cache

3.5 exit

4. Заходим на сайт localhost и регистрируемся 

5. Проникаем в базу docker-compose exec postgres bash 

6. По умолчанию, при регистрации пользователю даётся сатус User, вставляем этот запрос и роль меняется на Admin.

```
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    UPDATE users SET role='Admin' WHERE id=1;
EOSQL
```

Add ad


7. Go to PgAdmin http://localhost:5050 and insert into cities and regions
Pg login pgadmin4@pgadmin.org
Pg pass secret

```
INSERT INTO cities (id, name, region_id, slug) VALUES
(1,	'Авсюнино',	50,	'avsyunino'),
(2,	'Андреевка',	50,	'andreevka'),
(3,	'Апрелевка',	50,	'aprelevka'),
```
```
INSERT INTO regions (id, name) VALUES
(1,	'Республика Адыгея (Адыгея)'),
(2,	'Республика Башкортостан'),
(3,	'Республика Бурятия'),
```
8. You can now add your ad