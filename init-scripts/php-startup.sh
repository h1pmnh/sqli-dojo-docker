#!/bin/bash

# for sql server
# apt-get update && apt-get install -y unixodbc-dev && pecl install pdo_sqlsrv

## required for mysql, ideally we could bake this into a custom container
docker-php-ext-install pdo pdo_mysql

## populate the database, if you don't want this to happen by default just remove it from this script
## or set the `FILTER_CHARACTERS` environment variable in the docker compose file to whatever you do want
## the defaults to be
php /var/init-scripts/init.php

## start the PHP FPM module to handle requests from nginx
/usr/local/sbin/php-fpm
