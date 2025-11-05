# ---------- Build frontend (Node) ----------
FROM node:22-bullseye AS node-builder
WORKDIR /app

# copy only files needed for npm install/build to take advantage of cache
COPY package*.json ./
COPY package-lock.json* ./
COPY vite.config.js ./
# copy resource files required by vite
COPY resources resources

RUN npm ci --silent
RUN npm run build

# ---------- Build PHP app ----------
FROM php:8.2-fpm-bullseye AS php-base
WORKDIR /app

# System dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nginx \
    ca-certificates \
  && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . /app

# Install PHP dependencies (no-dev) and optimize autoloader
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copy built frontend assets from node stage
COPY --from=node-builder /app/public/build /app/public/build

# Ensure storage & cache dirs exist and set permissions
RUN mkdir -p /app/storage /app/bootstrap/cache \
 && chown -R www-data:www-data /app/storage /app/bootstrap/cache /app/public \
 && chmod -R a+rw /app/storage /app/bootstrap/cache /app/public

# Copy nginx config and start script
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

# Default internal port (start.sh will replace this with $PORT if set)
ENV PORT=10000
EXPOSE 10000

# Run Laravel migrations automatically
RUN php artisan migrate --force || true

# Start php-fpm and nginx
CMD ["/start.sh"]

