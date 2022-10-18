FROM php:8.1.9-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS postgresql-dev \
    && pecl install xdebug-3.1.5 \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-enable xdebug

COPY --from=composer:2.4.0 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/
EXPOSE 9000
CMD ["php-fpm"]
