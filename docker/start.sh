#!/bin/bash

php artisan config:clear
php artisan route:clear
php artisan view:clear

rm -rf public/storage
php artisan storage:link

php artisan migrate --force

apache2-foreground