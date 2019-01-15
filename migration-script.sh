#!/bin/bash
./wait-for-it.sh 127.0.0.1:3306 -t 30
php artisan migrate:refresh --seed
