#!/usr/bin/env bash
set -e
role=${CONTAINER_ROLE:-app}
if [ "$role" = "app" ]; then
    exec apache2-foreground
elif [ "$role" = "queue" ]; then
    echo "Running the queue..."
    php /var/www/html/artisan queue:work --verbose
elif [ "$role" = "cron" ]; then
    while [ true ]
    do
      php /var/www/html/artisan schedule:run --verbose --no-interaction &
      sleep 60
    done
else
    echo "Could not match the container role \"$role\""
    exit 1
fi
