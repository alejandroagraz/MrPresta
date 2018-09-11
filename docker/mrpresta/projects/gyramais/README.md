# New docker image

***If you already have your database***

```sh
    cp devops/data devops/local/
```

***If you don't have your database***

```sh
    mysql -u root -p -h db acclink < /var/www/html/sql/acclink.sql
```

**You must go to devops/local directory and execute the following commands**

```sh
    cd devops/local
```

```sh
    sudo chmod 777 -Rf data

    cp docker-compose.yml.dist docker-compose.yml
    docker-compose build
    docker-compose up -d

    docker exec -it acclinklocal-develop-app bash
```