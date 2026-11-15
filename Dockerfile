# Stage 1: Build Frontend Assets
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY resources/ ./resources/
COPY vite.config.js ./
COPY public/ ./public/
RUN npm run build

# Stage 2: Production PHP Application
FROM php:8.3-fpm-alpine

# Install system utilities & web servers
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    sqlite

# Install PHP extensions safely using official extension installer
ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql pdo_sqlite mbstring bcmath gd zip opcache intl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application code
COPY . .

# Copy compiled frontend assets from Stage 1
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies without dev packages
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

# Setup directory permissions and sqlite file
RUN mkdir -p storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             storage/logs \
             bootstrap/cache \
             database \
    && touch database/database.sqlite \
    && chown -R www-data:www-data storage bootstrap/cache database \
    && chmod -R 775 storage bootstrap/cache database

# Copy Nginx & Supervisor configuration
COPY deploy/docker/nginx.conf /etc/nginx/http.d/default.conf
COPY deploy/docker/supervisord.conf /etc/supervisord.conf
COPY deploy/docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 10000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
