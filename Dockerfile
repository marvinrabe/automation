ARG php=8.2

FROM composer:latest AS composer
WORKDIR /var/www/html

# Install Composer dependencies
COPY composer.json composer.lock ./
RUN composer install \
  --ignore-platform-reqs \
  --no-ansi \
  --no-dev \
  --no-interaction \
  --no-scripts \
  --optimize-autoloader

FROM node:lts AS node
WORKDIR /var/www/html

# Install npm dependencies
COPY package.json package-lock.json ./
RUN npm ci

# Build application files
COPY . .
RUN npm run build

FROM php:${php}-fpm-buster AS php

RUN apt-get update && apt-get --yes install supervisor

# Install PHP extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions bcmath opcache pcntl pdo_pgsql redis swoole zip

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Setup system configuration
COPY docker /

# Setup directories and volumes
RUN mkdir -p /var/www/html /run \
  && chown -R www-data:www-data /var/www \
  && chown -R www-data:www-data /run \
  && chmod +x /entrypoint.sh

WORKDIR /var/www/html

COPY --chown=www-data . .
COPY --chown=www-data --from=composer /var/www/html/vendor ./vendor
COPY --chown=www-data --from=node /var/www/html/public ./public

VOLUME /var/www/html/bootstrap/cache
VOLUME /var/www/html/storage

# Switch to use a non-root user from here on
USER www-data

EXPOSE 8080

ENTRYPOINT ["/entrypoint.sh"]

HEALTHCHECK --start-period=5s --interval=2s --timeout=5s --retries=8 CMD php artisan octane:status || exit 1
