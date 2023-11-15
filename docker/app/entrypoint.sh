#!/bin/bash

# initialize port
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# initialize laravel
cd /var/www/html
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run Apache in "foreground" mode (the default mode that runs in Docker)
apache2-foreground
