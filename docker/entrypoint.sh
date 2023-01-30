#!/bin/sh
set -e

composer dump-autoload

echo 'clearing cache...' >&2
php artisan cache:clear
php artisan lighthouse:clear-cache

echo 'warming up cache...' >&2
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan lighthouse:cache

echo 'migrating database...' >&2
php artisan migrate --force
php artisan schedule-monitor:sync

if [ -z "$@" ]; then
  exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
else
  exec PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin $@
fi
