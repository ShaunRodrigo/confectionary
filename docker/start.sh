#!/usr/bin/env bash
set -euo pipefail

# ensure app directories exist
mkdir -p /app/storage/framework/{sessions,views,cache,testing}
mkdir -p /app/storage/logs
chown -R www-data:www-data /app/storage /app/bootstrap/cache /app/public
chmod -R a+rw /app/storage /app/bootstrap/cache /app/public

# replace default nginx listen port (10000) with $PORT if provided
if [ -n "${PORT:-}" ] && [ -f /etc/nginx/conf.d/default.conf ]; then
  sed -i "s/listen 10000;/listen ${PORT};/g" /etc/nginx/conf.d/default.conf || true
fi

# Ensure PHP-FPM listens on TCP 127.0.0.1:9000 (not a unix socket)
if [ -f /usr/local/etc/php-fpm.d/www.conf ]; then
  sed -i "s|^listen = .*|listen = 127.0.0.1:9000|g" /usr/local/etc/php-fpm.d/www.conf || true
fi

# Run migrations at startup (safe: will be skipped if already applied or fails)
php artisan migrate --force || true

# Run custom seeder to load data from .txt files
php artisan db:seed --class=ConfectionSeeder || true

# Clear Laravel caches to avoid stale APP_URL or asset paths
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true


# start php-fpm (background) and nginx (foreground)
php-fpm -D
nginx -g 'daemon off;' &

# Tail logs to stdout so Render shows them (helps debug without shell access)
tail -n +1 -F /var/log/nginx/error.log /var/log/nginx/access.log /app/storage/logs/laravel.log 2>/dev/null &
wait