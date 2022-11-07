FROM php:8.1.10-apache
COPY ports.conf /etc/apache2/ports.conf
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
RUN pecl install redis && docker-php-ext-enable redis && service apache2 restart