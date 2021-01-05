1. docker-compose exec postgres bash

2. Update user role

set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    UPDATE users SET role='Moderator' WHERE id=1;
EOSQL