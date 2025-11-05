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

# start php-fpm and nginx
php-fpm -D
nginx -g 'daemon off;'