FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN cp .env.example .env \
    && php artisan key:generate \
    && touch database/database.sqlite \
    && php artisan migrate --force \
    && php artisan db:seed --force

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80