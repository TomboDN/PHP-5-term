FROM php:8.1.10-apache

RUN apt-get update

COPY ports.conf /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get install -y sendmail libpng-dev zlib1g-dev libzip-dev unzip libfreetype6-dev libmcrypt-dev libjpeg-dev
RUN docker-php-ext-install iconv zip gd
RUN docker-php-ext-configure gd --with-freetype=/usr/include/freetype2 --with-jpeg=/usr/include

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN docker-php-ext-enable gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN pecl install redis && docker-php-ext-enable redis && service apache2 restart

RUN composer require fzaninotto/faker
RUN composer require symfony/polyfill
