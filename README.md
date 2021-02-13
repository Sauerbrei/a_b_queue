# A/B Queue

## first start
Since MariaDB needs to setup the user, you have to restart docker in order to migrate automatically:

1. `docker-compose up`
2. wait a bit
3. `docker-compose down`
4. `docker-compose up`
5. visit http://localhost:8080
