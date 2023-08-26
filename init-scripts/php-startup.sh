#!/bin/bash

# for sql server
# apt-get update && apt-get install -y unixodbc-dev && pecl install pdo_sqlsrv

docker-php-ext-install pdo pdo_mysql

## populate the database
php /var/init-scripts/init.php

/usr/local/sbin/php-fpm
