# chx

A simple CRUD/E-commerce

## Prerequisites

* docker version 18.06.0-ce+
* docker-compose version 1.8.0+

## How to enjoy!

#### 1 - configure the example.env file and rename to .env

#### 2 - start docker-compose and composer php

```
$ cd /docker

# start docker-compose
$ docker-compose up

# install composer php
$ docker exec -ti chx_apache bash
$ (container) cd var/www/html
$ (container) composer install
```

### 3 - run chx.sql

## Author

* **Christian Murata** - [christianmurata](https://github.com/christianmurata)
