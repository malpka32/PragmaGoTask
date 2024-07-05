FROM php:8.3 AS base
RUN mkdir "/app"
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app

FROM base AS tests
RUN apt-get update
RUN apt-get install -y libzip-dev zip
RUN docker-php-ext-install zip
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY . .
RUN composer install

FROM base AS example
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY . .
RUN composer install --no-dev
RUN rm -rf /usr/bin/composer
