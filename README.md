# A/B Queue

## first start

1. `docker-compose up`
2. `docker-compose exec php /bin/sh`
3. `bin/console doctrine:migrations:migrate`
4. `bin/console abqueue:generate:testdata` OR execute docker/db/init.sql
5. visit http://localhost:8080


## Adjust settings
By default, a discount is available for 10 Minutes. If you want to adjust this,
you may edit the parameter `default_expiry_time_in_minutes` in the config/services.yaml file.
In the future, this may be added to the .env. For now, this is kept only inside this file,
because every change will lead to restart the container in order to take effect.