#!/bin/sh
set -e

container_mode=${CONTAINER_MODE:-app}
echo "Container mode: $container_mode"

initialStuff() {
    php artisan optimize; \
    php artisan package:discover --ansi; \
    php artisan event:cache; \
    php artisan config:cache; \
    php artisan route:cache; \
    php artisan view:cache; \
    php artisan migrate --force
}

if [ "$1" != "" ]; then
    exec "$@"
elif [ "$container_mode" = "app" ]; then
    initialStuff
    exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
else
    echo "Container mode mismatched."
    exit 1
fi
