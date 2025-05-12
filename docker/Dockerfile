FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    librabbitmq-dev \
    libssl-dev \
    git \
    unzip \
    && pecl install amqp \
    && docker-php-ext-enable amqp \
    && docker-php-ext-install pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD ["php-fpm"]
