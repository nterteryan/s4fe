#!/usr/bin/env bash

#installation steps

#install composer dependence
composer update

# migrate tables
php artisan migrate

#install passport
php artisan passport:install

#change mode of storage folder
chmod -R 777 storage

#generate docs
#php artisan swagger-lume:generate