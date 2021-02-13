# A/B Queue

TLDR; 
This project is about generating public claimable data which will expire after a short period of time.

TS;WM
This project is about generating discount coupons into a pool, so a user is able to collect a subset of them. These coupons are just available of a set time. After this time, they expire, go back into the pool, so they are public to be collected again. It is also possible to "use" or "claim" them. After this, these coupons will be invalid for ever.


## first start

1. `docker-compose build`
2. `docker-compose up`
3. `docker-compose exec php /bin/sh`
4. `bin/console doctrine:migrations:migrate`
5. `bin/console abqueue:generate:testdata`
6. visit http://localhost:8080


## Adjust settings
By default, a discount is available for 10 Minutes. If you want to adjust this,
you may edit the parameter `default_expiry_time_in_minutes` in the config/services.yaml file.
In the future, this may be added to the .env. For now, this is kept only inside this file,
because every change will lead to restart the container in order to take effect.
