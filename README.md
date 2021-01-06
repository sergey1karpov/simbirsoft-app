1. docker-compose up -d

2. docker-compose exec app bash

3. php artisan migrate и возможно config:cache
3.5 exit

4. Регистрируемся на сайте

5. Проникаем в базу docker-compose exec postgres bash 

6. По умолчанию, при регистрации пользователю даётся сатус User, вставляем этот запрос и роль меняется на Admin.

set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    UPDATE users SET role='Admin' WHERE id=1;

EOSQL

7. localhost

