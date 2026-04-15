#!/bin/bash

# Iniciar PHP-FPM en background
php-fpm &

# Esperar un poco
sleep 3

# Generar key si no existe
#php artisan key:generate --force

# Migraciones (opcional)
php artisan migrate --force

# Cachear config
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar nginx
nginx -g "daemon off;"
