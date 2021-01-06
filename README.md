1. docker-compose up -d

2. docker-compose exec postgres bash

3. Update user role

set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    UPDATE users SET role='Admin' WHERE id=1;
EOSQL
