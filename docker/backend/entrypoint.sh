#!/bin/bash
set -e

# Установка зависимостей, если vendor не существует
if [ ! -d ./vendor ]; then
    composer install --no-interaction
    chown -R www-data:www-data ./var
fi

php bin/console assets:install --env=prod
mkdir -p /var/www/var/cache/prod
chown -R www-data:www-data ./var

# Запуск сервера Apache
apache2-foreground