# A/B Queue

## first start

1. `docker-compose up`
2. `docker-compose exec php /bin/sh`
3. `bin/console doctrine:migrations:migrate`
4. `bin/console abqueue:generate:testdata` OR execute docker/db/init.sql
5. visit http://localhost:8080
