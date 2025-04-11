FROM php:8.4-fpm

COPY php.ini /usr/local/etc/php/
EXPOSE 9000

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip \
    default-mysql-client \
    && apt-get clean \

ENV PYTHONHOME=/usr/local/lib/python3.8

RUN docker-php-ext-install zip pdo_mysql

RUN curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN composer global require "laravel/installer"

RUN curl -fsSL https://deb.nodesource.com/setup_current.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest
RUN node --version
RUN npm --version

WORKDIR /var/www/src

RUN chown www-data:www-data /var/www

USER root
