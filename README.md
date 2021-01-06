1. docker-compose up -d

2. Регистрируемся на сайте

3. Проникаем в базу docker-compose exec postgres bash 

4. По умолчанию, при регистрации пользователю даётся сатус User, вставляем этот запрос и меняем роль на Admin.

set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    UPDATE users SET role='Admin' WHERE id=1;
EOSQL
