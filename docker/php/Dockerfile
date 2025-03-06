FROM php:8.3-fpm

RUN apt-get -y update && apt-get -y upgrade
RUN apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip unzip \
    git \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY ../../project /var/www/html

RUN composer install
RUN composer --version
RUN chmod -R guo+w /var/www/html/storage

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


CMD ["php-fpm"]
