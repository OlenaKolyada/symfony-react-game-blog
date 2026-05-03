#!/bin/bash
set -e

composer install --no-interaction

mkdir -p /var/www/var
chown -R www-data:www-data /var/www/var

max_attempts=30
attempt=1

until php bin/console doctrine:query:sql "SELECT 1" >/dev/null 2>&1; do
  if [ "$attempt" -ge "$max_attempts" ]; then
    echo "Database is not available after $max_attempts attempts."
    echo "Check DATABASE_URL, MySQL credentials, secrets, and db container logs."
    exit 1
  fi

  echo "Waiting for database... attempt $attempt/$max_attempts"
  attempt=$((attempt + 1))
  sleep 2
done

apache2-foreground