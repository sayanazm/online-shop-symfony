# Используем официальный PHP-образ с Apache
FROM php:8.2-apache

# Устанавливаем зависимости
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install intl pdo_mysql

COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Копируем проект внутрь контейнера
WORKDIR /var/www/html
COPY . .

# Устанавливаем зависимости Symfony
RUN composer install

# Устанавливаем права
RUN chown -R www-data:www-data /var/www/html/var

# Открываем порт
EXPOSE 80
